@extends('layout')

@section('content')
<table class="table caption-top">
   
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Created</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user )
        <tr>
            <th scope="row">{{ ++$i}}</th>
            <td>{{ $user->name}}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ \Carbon\Carbon::parse ($user['created_at'])->format('j F, Y')  }}</td>
          </tr>
        
        @endforeach
      
    </tbody>
  </table>

@endsection