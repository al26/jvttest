@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Report - Peminjaman Buku</div>

                <div class="card-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Judul Buku</th>
                          <th scope="col">Pengarang</th>
                          <th scope="col">ISBN</th>
                          <th scope="col">Tahun Publikasi</th>
                          <th scope="col">Peminjam</th>
                          <th scope="col">Tanggal Pinjam</th>
                          <th scope="col">Tanggal Kembali</th>
                          <th scope="col">Status</th>
                          <th scope="col">Denda</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($books as $key => $book)

                          @php
                          $deadline = \Carbon\Carbon::parse($book->date_in);
                          $return  = $book->date_in_actual !== null ? \Carbon\Carbon::parse($book->date_in_actual) : \Carbon\Carbon::now();  

                          $diff   = $deadline->diffInDays($return);
                          $denda  = $diff*2000;
                          @endphp

                          <tr onclick="rowClick(this)" redirect="{{$book->date_in_actual === null ? route('book.return', ['book' => encrypt($book->id)]) : route('book.borrow', ['book' => encrypt($book->book->id)])}}" style="cursor: pointer">
                            <th scope="row">{{$key+=1}}</th>
                            <td>{{$book->book->title}}</td>
                            <td>{{$book->book->author}}</td>
                            <td>{{$book->book->isbn}}</td>
                            <td>{{$book->book->published}}</td>
                            <td>{{$book->member->fullname}}</td>
                            <td>{{$book->date_out}}</td>
                            <td>{{$book->date_in}}</td>
                            <td>{{$book->date_in_actual !== null ? 'sudah kembali' : 'belum kembali'}}</td>
                            <td>{{$denda}}</td>
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