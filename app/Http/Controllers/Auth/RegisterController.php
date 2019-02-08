<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $crypt = $this->hashMe($data['password'], $this->getSalt());
        return User::create([
            'username' => $data['username'],
            'password' => $crypt->hash,
            'salt' => $crypt->salt,
        ]);
    }

    function hashMe ($pass, $salt) {
        return (object)['hash' => md5($salt.$pass), 'salt' => $salt];
    }

    function getSalt() {
        $char = '0123456789qwertyuiopasdfghjklzxcvbnmASDFGHJKLQWERTYUIOPZXCVBNM';
        $length = 5;
        $charlength = strlen($char);
        $salt = '';

        for ($i=0; $i < $length ; $i++) { 
            $salt .= $char[rand(0, $charlength - 1)];    
        }

        return $salt;
    }
}
