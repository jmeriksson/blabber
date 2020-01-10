@extends('layouts.app')

@section('content')
  <h1>Login</h1>
  {!!Form::open(['action' => 'LoginController@login', 'method' => 'POST'])!!}
    <div class="input-group mb-2">
      <div class="input-group-prepend" style="width: 40px;">
        <span class="input-group-text">
          <i class="fas fa-user"></i>
        </span>
      </div>
      {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username'])}}
    </div>
    <div class="input-group mb-2">
      <div class="input-group-prepend" style="width: 40px;">
        <span class="input-group-text">
          <i class="fas fa-key"></i>
        </span>
      </div>
      {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password'])}}
    </div>
    {{Form::submit('Login', ['class' => 'btn btn-outline-primary'])}}
  {!!Form::close() !!}
@endsection