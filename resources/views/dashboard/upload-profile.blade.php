@extends('layout')

@section('content')
    <div class="container pt-5">
        <div class="card d-block m-auto p-3">
    
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
              </ul>
            </div>
          @endif
            <div id="contact" class="container">
           {{-- fungsi encytype untuk mengambil identitas dari file yang di upload --}}
            <form action="{{route('todo.detail.change')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="image_upload">Pilih Gambar</label>
                    <input type="file" name="image_profile" class="form-control" id="image_upload">
                </div>
               <button type="submit" class="btn btn-primary me-4 ms-3 col-4">Ubah</button>
                <a href="/todo/detail" class="btn btn-secondary col-5">Kembali</a>
            </form>
        </div>
        </div>
   @endsection