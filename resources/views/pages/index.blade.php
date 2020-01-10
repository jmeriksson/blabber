@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
      <h1>Welcome to Blabber</h1>
      <p>Blabber is a social media platform for writers and journalists. Here, you can follow your favorite authors and journalists. You can also publish your own articles for the world to see.</p>
      <p><a href="/login" role="button" class="btn btn-primary btn-lg">Login</a> <a href="/authors/create" role="button" class="btn btn-secondary btn-lg">Register</a></p>
  </div>
@endsection