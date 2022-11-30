@extends('layout')
@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        
      @endforeach
    </ul>
  </div>
  @endif

<section class="vh-100 ">
    <div class="container h-100">
      <div class=" row h-100">
        <div class="col-md-6 col-lg-6 col-xl-5 mt-5 pt-5">    
          <img src="{{ asset('assets/img/document.png') }}"
            class="col-12" alt="this Register" style="padding-top:10px">
        </div>
        <div class="col-md-7 col-lg-6 col-xl-6 offset-xl-1 mt-5">   
            <div class="text-center mt-3">
              <h1 style="color: #062568">Register</h1>
            </div>

            <form method="POST" action="{{ route('register.post') }}">
            @method('POST')
              @csrf

              <div class="form-outline mt-3 mb-3">
                <label class="form-label" for="form1Example13">Name</label>
              <input type="text" name="name" id="form1Example13" class="form-control form-control-lg" placeholder="Input Name" />
            </div>

            <div class="form-outline mt-3 mb-3">
              <label class="form-label" for="form1Example23">Username</label>
              <input type="text" name="username" class="form-control form-control-lg" placeholder="Input Username" />
            </div>
            
            <!-- Email input -->
            <div class="form-outline mt-3 mb-3">
                <label class="form-label" for="form1Example13">Email address</label>
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Input Email" />
            </div>
  
            <!-- Password input -->
            <div class="form-outline mt-3  mb-3">
                <label class="form-label" for="form1Example23">Password</label>
              <input type="password" name="password"  class="form-control form-control-lg" placeholder="Input Password"/>
            </div>
        
            <!-- Submit button -->
            <center>
              <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">Sign Up</button>
            </center>
            
            </form>
        </div>
      </div>
    </div>
  </section>
@endsection
 