@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Report - Semua Buku</div>

                <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Judul Buku</th>
                          <th scope="col">Pengarang</th>
                          <th scope="col">ISBN</th>
                          <th scope="col">Tahun Publikasi</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($books as $key => $book)
                          <tr onclick="rowClick(this)" redirect="{{!empty($book->book_out->id) ? route('book.return', ['book' => encrypt($book->book_out->id)]) : route('book.borrow', ['book' => encrypt($book->id)])}}" style="cursor: pointer">
                            <th scope="row">{{$key+=1}}</th>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->published}}</td>
                            <td>{{!empty($book->book_out->id) ? 'terpinjam' : 'tersedia'}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

