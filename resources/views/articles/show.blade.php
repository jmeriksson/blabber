@extends('layouts.app')

@section('content')
  <h1>{{$article->title}}</h1>
    <div>
      {{$article->content}}
    </div>
    <hr>
    <small>Written on {{$article->created_at}}</small>
    <hr>
  <a href="#" role="button" class="btn btn-primary" onclick="history.back()">Go back</a>
  
  {!!Form::open(['action' => ['ArticlesController@destroy', $article->id], 'method' => 'POST', 'class' => 'float-right'])!!}

    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
  {!!Form::close()!!}

  <a href="/articles/{{$article->id}}/edit" class="btn btn-outline-success float-right mr-1">Edit</a>
@endsection