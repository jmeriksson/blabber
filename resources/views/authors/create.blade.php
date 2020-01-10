@extends('layouts.app')

@section('content')
  <h1>Register New Author</h1>
  {!!Form::open(['action' => 'AuthorsController@store', 'method' => 'POST'])!!}
    <div class="form-group">
      {{Form::label('username', 'Username')}}
      {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Select a username'])}}
    </div>
    <div class="form-group">
      {{Form::label('screenName', 'Screen name')}}
      {{Form::text('screenName', '', ['class' => 'form-control', 'placeholder' => 'Select a screen name'])}}
    </div>
    <div class="form-group">
      {{Form::label('email', 'E-mail')}}
      {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Enter your e-mail address'])}}
    </div>
    <div class="form-group">
      {{Form::label('password', 'Password')}}
      {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Choose a password'])}}
    </div>
    <div class="form-group">
      {{Form::label('repeatPassword', 'Repeat password')}}
      {{Form::password('repeatPassword', ['class' => 'form-control', 'placeholder' => 'Repeat your password'])}}
    </div>
    {{Form::submit('Register', ['class' => 'btn btn-outline-primary'])}}
  {!!Form::close() !!}
@endsection