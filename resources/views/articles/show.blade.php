@extends('layouts.app')

@section('content')
  <h1>{{$article->title}}</h1>
    <div>
      {{$article->content}}
    </div>
    <hr>
    <p>Written by {{$author->screenName}}</p>
    <small>Written on {{$article->createdAt}}</small>
    <hr>
  <a href="/articles" role="button" class="btn btn-outline-info" style="display:inline-block;">Go back</a>
  @if(in_array($article->id, $likedArticles))
    {!!Form::open(['action' => ['InteractionsController@unlikeArticle'], 'method' => 'POST', 'style' => 'display:inline-block;'])!!}
      {{Form::text('articleId', $article->id, ['style' => 'display:none'])}}
      {{Form::text('currentPosition', "/articles/$article->id", ['style' => 'display:none'])}}
      {{Form::submit('Liked', ['class' => 'btn btn-primary'])}}
    {!!Form::close()!!}
  @else
    {!!Form::open(['action' => ['InteractionsController@likeArticle'], 'method' => 'POST', 'style' => 'display:inline-block;'])!!}
      {{Form::text('articleId', $article->id, ['style' => 'display:none'])}}
      {{Form::text('currentPosition', "/articles/$article->id", ['style' => 'display:none'])}}
      {{Form::submit('Like', ['class' => 'btn btn-outline-primary'])}}
    {!!Form::close()!!}
  @endif
  @if(Auth::check())
    @if(Auth::user()->id === $article->authorId)
      {!!Form::open(['action' => ['ArticlesController@destroy', $article->id], 'method' => 'POST', 'class' => 'float-right'])!!}

        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
      {!!Form::close()!!}

      <a href="/articles/{{$article->id}}/edit" class="btn btn-outline-success float-right mr-1">Edit</a>
    @endif
  @endif
@endsection