@extends('layouts.app')

@section('content')
  <a href="/articles" role="button" class="btn btn-dark">Go back</a>
  <h1>{{$article->title}}</h1>
    <small>Written on {{$article->created_at}}</small>
    <div>
      {{$article->content}}
    </div>
@endsection