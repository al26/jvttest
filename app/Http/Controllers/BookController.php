<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
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
    public function book_borrowed()
    {
        $data['books'] = \App\Books_out::whereNull('date_in_actual')
                                        ->with(['book', 'member'])
                                        ->get();
        return view('book.borrowed', $data);
    }

    public function book_borrow($book) {
        $data['book'] = \App\Book::select('id','title', 'author', 'isbn', 'published')
                           ->where('id', decrypt($book))
                           ->first();
        $data['members'] = \App\Member::select('id','fullname')->get();
        return view('book.borrow', $data);
    }

    public function book_borrowing(Request $request, $book) {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'required|string',
            'published' => 'required|numeric',
            'member_id' => 'required',
            'date_out' => 'required|date',
            'date_in' => 'required|date',
        ]);

        // $request = $request->validated();

        $store = \App\Books_out::create([
            'member_id' => $request->member_id,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'published' => $request->published,
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
            'book_id' => decrypt($book)
        ]);

        if ($store) {
            $msg = 'Peminjaman buku berhasil';
            return redirect('/report/borrow')->with('success', $msg);
        } else {
            $msh = 'Terjadi Kesalahan. Peminjaman Buku Gagal !';
            return redirect('/report/borrow')->with('fail', $msg);
        }

        

        return redirect();
    }

    public function book_return($book) {
        $data['book'] = \App\Books_out::where('id', decrypt($book))
                           ->with(['member', 'book'])
                           ->first();
        // $data['members'] = \App\Member::select('id','fullname')->get();
        return view('book.return', $data);
    }
}