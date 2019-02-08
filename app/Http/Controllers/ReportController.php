<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['books'] = \App\Book::select('id','title', 'author', 'isbn', 'published')
                                    ->with('book_out')
                                    ->get();
        // dd(empty($data['books'][1]->book_out->id));
        return view('report.all', $data);
    }

    public function borrow() {
        $data['books'] = \App\Books_out::with(['book', 'member'])->get();
        // dd($data['books']);
        return view('report.borrow', $data);   
    }
}
