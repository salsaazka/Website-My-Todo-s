 @extends('layout')
{{-- 
@section('content')
<div class="wrapper bg-white">
    <a href="/todo/"><i class="fa-solid fa-backward"></i>  Back</a>
    <div class="card-body">
             
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{$message}}</strong>
        </div>
    @endif
    
   @if (is_null($user['image_profile']))
        <img src="{{ asset('assets/img/kosong.jpg') }}" alt="" width="100" style="border-radius: 50%" class="d-block m-auto">
        @else
            <img src="/assets/img/{{ Auth::user()->image_profile }}" alt="" width="100 " style="border-radius: 50%" class="d-block m-auto">
        @endif
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ route('todo.detail.upload') }}" class="btn btn-primary">Ubah Foto</a>
        </div>
        <p class="text-muted">Nama: {{ $user['name'] }}</p>
        <p class="text-muted">Username: {{ $user['username'] }}</p>
        <p class="text-muted">Email: {{ $user['email'] }}</p>
        {{-- <p>{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->username }}</p>
        <p>{{ Auth::user()->email }}</p> --}}
        
    {{-- </div>
</div>
</div>
@endsection   --}}


@section('content')
<div class="wrapper bg-white">
    <a href="/todo/"><i class="fa-solid fa-backward"></i>  Back</a>
    <div class="card-body">
             
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{$message}}</strong>
        </div>
        @endif
        @if (is_null($user['image_profile']))
         <img src="{{ asset('assets/img/kosong.jpg') }}" alt="" width="100" style="border-radius: 50%" class="d-block m-auto">
        @else
            <img src="{{ asset('assets/img/'.$user['image_profile']) }}" alt="" width="100 " style="border-radius: 50%" class="d-block m-auto">
        @endif
        <div class="d-flex justify-content-center mt-2">
            <a href="{{ route('todo.detail.upload') }}" class="btn btn-primary">Ubah Foto</a>
        </div>

        <p class="text-muted">Nama: {{ $user['name'] }}</p>
        <p class="text-muted">Username: {{ $user['username'] }}</p>
        <p class="text-muted">Email: {{ $user['email'] }}</p> 
        {{-- <p>{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->username }}</p>
        <p>{{ Auth::user()->email }}</p> --}}
    </div>
</div>
</div>
@endsection
