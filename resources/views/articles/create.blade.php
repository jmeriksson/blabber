@extends('layouts.app')

@section('content')
  <h1>Create Article</h1>
  {!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST']) !!}
    <div class="form-group">
      {{Form::label('title', 'Title')}}
      {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title...'])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body text...'])}}
    </div>
    {{Form::submit('Publish', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection