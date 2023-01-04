<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <title>Todos App</title>
   
</head>
<body>
@if (Auth::check())
<nav class="navbar navbar-light bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand text-white"><i class="fa-solid fa-pen-to-square"></i> TODO'S APP</a>

  <form class="d-flex" role="search">
    <div class="nav-item dropdown" >
      <a class="nav-link dropdown-toggle" href="#" role="button" style="color:white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user"> </i> {{Auth::user()->name}} 
    </a>
  
 <ul class="dropdown-menu">
  <li><a class="dropdown-item" href="/todo">
    <i class="fa-solid fa-house" style="color: rgb(240, 182, 57)"></i> Home
  </a></li>
   <li><a class="dropdown-item" href="/todo/detail">
     <i class="fa-solid fa-user" style="color: rgb(240, 182, 57)"></i> Profile Detail
    </a></li>
    @if (Auth::user()->role == 'admin')
      <li>
        <a class="dropdown-item" href="/todo/data" >
          <i class="fas fa-server" style="color: rgb(240, 182, 57)"></i> Data User
        </a>
      </li>
    @endif
    <li>
      <a class="dropdown-item" href="/logout" >
        <i class="fas fa-sign-out-alt" style="color: rgb(240, 182, 57)"></i>  Logout
      </a>
    </li>
   </ul>
  </div>
</form>
      
    </div>
   
  </div>
</nav>
 
@endif
 {{-- content tambahan di berbagai halaman --}}
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>