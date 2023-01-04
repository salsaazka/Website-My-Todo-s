@extends('layout')
@section('content')
    <div class="container pt-5 " style="height: 100vh; width: 100%" >
        <img src="{{ asset('assets/img/404.png') }}" alt="" srcset="" width="300" class="d-block m-auto pt-2">
        <h4 class="text-center ">Anda tidak diperbolehkan mengakses halaman ini</h4>
        <div class="d-flex justify-content-center mt-3">
        <a href="/todo" class="btn btn-primary "> Kembali</a>
        </div>
    </div>

@endsection