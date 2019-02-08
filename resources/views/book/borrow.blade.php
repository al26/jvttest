@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Buku - Pinjam Buku</div>

                <div class="card-body">
                    <form method="post" action="{{route('book.borrowing', ['book' => encrypt($book->id)])}}">
                      @csrf
                      @method('POST')
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Judul Buku</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Judul Buku" value="{{$book->title}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="author" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="author" name="author" placeholder="Pengarang" value="{{$book->author}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="isbn" name="isbn" placeholder="isbn" value="{{$book->isbn}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="published" class="col-sm-2 col-form-label">Tahun Publikasi</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="published" name="published" placeholder="Tahun Publikasi" value="{{$book->published}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="member_id" class="col-sm-2 col-form-label">Peminjam</label>
                        <div class="col-sm-10">
                          <select class="custom-select" name="member_id" id="member_id">
                            <option selected> -- Pilih Peminjam -- </option>
                            @foreach($members as $member)
                              <option value="{{encrypt($member->id)}}">{{$member->fullname}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date_out" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="date_out" name="date_out" placeholder="Tanggal Pinjam">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date_in" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="date_in" name="date_in" placeholder="Tanggal Kembali">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col">
                          <button type="submit" class="btn btn-primary btn-md float-right">Pinjam</button>  
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection