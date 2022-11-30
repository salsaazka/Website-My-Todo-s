@extends('layout')

@section('content')
<div class="wrapper bg-white">
          {{-- dari isGuest --}}
        @if (Session::get('notAllowed'))
          <div class="alert alert-danger w-100">
             {{ Session::get('notAllowed') }}
          </div>  
        @endif

            {{-- dari todo.index --}}
          @if (Session::get('successAdd'))
            <div class="alert alert-success w-100">
               {{ Session::get('successAdd') }}
            </div>  
          @endif
          @if (Session::get('successUpdate'))
          <div class="alert alert-success w-100">
             {{ Session::get('successUpdate') }}
          </div>  
        @endif
        @if (session('deleted'))
        <div class="alert alert-danger">
          {{ session('deleted') }}
        </div>
        @endif

    <div class="d-flex align-items-start justify-content-between">
        <div class="d-flex flex-column">
            <div class="h5">My Todo's</div>
            <p class="text-muted text-justify">
                Here's a list of activities you have to do
            </p>
            <br>
            <span>
                <a href="{{route('todo.create')}}" class="text-success"><i class="fa-solid fa-plus"></i> Create</a> | <a href="{{route('todo.complated')}}"><i class="fa-solid fa-check-to-slot"></i> Complated</a>
            </span>
        </div>
        <div class="info btn ml-md-4 ml-0">
            <span class="fas fa-info" title="Info"></span>
        </div>
    </div>
   
    <div class="work border-bottom pt-3">
        <div class="d-flex align-items-center py-2 mt-1">
            <div>
                <span class="text-muted fas fa-comment btn"></span>
            </div>
            <div class="text-muted">{{ !is_null($todos) ? count($todos): '-' }} Todo's here!</div>
            <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                data-target="#comments" aria-expanded="false" aria-controls="comments"></button>
        </div>
    </div>
    <div id="comments" class="mt-1">
        @foreach ($todos as $todo )
        <div class="comment d-flex align-items-start justify-content-between">
            <div class="mr-2">
                <form action="/todo/complated/{{ $todo['id'] }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="fa fa-check" style="background: #B9E0FF; padding: 8px !important;"></button>
                </form>
                {{-- <label class="option">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label> --}}
            </div>
            <div class="d-flex flex-column w-75">
                <a href="/todo/edit/{{$todo['id']}}" class="text-justify font-weight-bold">
                    {{ $todo['title'] }}
                </a>
                     {{-- complated: 1 true, on-progress:0 false --}}
                <p class="text-muted">{{ $todo['status'] ? 'Complated' : 'On-Progress'}} 
                <span class="date">{{ \Carbon\Carbon::parse ($todo['date'])->format('j F, Y') }}</span></p>
                    {{-- tanggal bulan, tahun --}}
                
            </div>
            <div class="ml-auto"> 
                {{-- ketika akan membuat fitur delete, harus menggunakan form, karena hal hal yang berhubungan dengan memodifikasi database harus menggunakan form  --}}
                    <form action="{{ route('todo.delete', $todo['id']) }}" method="POST">
                        @csrf
                        {{-- menimpa attribute method post pada form agar menjadi delete, karena method route nya delete --}}
                        @method('DELETE')
                        {{-- agar actionnya bisa dijalankan menggunakan type submit --}}
                    <button type="submit" class="fas fa-trash btn" ></button>
                </form>
            </div>
            <div class="ml-auto">
                <a href="/todo/edit/{{$todo['id']}}" >
                  <i class="fas fa-arrow-right btn"> </i>
                </a>
            </div>
        </div>            
     @endforeach
    </div>
</div>
@endsection