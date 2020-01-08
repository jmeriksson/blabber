@extends('layouts.app')

@section('content')
  <h1>Edit Article</h1>
  {!! Form::open(['action' => ['ArticlesController@update', $article->id], 'method' => 'POST']) !!}
    <div class="form-group">
      {{Form::label('title', 'Title')}}
      {{Form::text('title', $article->title, ['class' => 'form-control', 'placeholder' => 'Title...'])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body', $article->content, ['class' => 'form-control', 'placeholder' => 'Body text...'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection