@extends('layouts.app')

@section('content')
  <h1>Articles</h1>
  @if(count($articles) > 0)
    @foreach($articles as $article)
      <div class="card mb-1">
        <div class="card-body">
          <h4 class="card-title"><a href="/articles/{{$article->id}}">{{$article->title}}</a></h4>
          <p class="card-subtitle mb-2 text-muted">{{$article->authorId}} | Written {{$article->created_at}}</h6>
          <p class="card-text">{{$article->content}}</p>
        </div>
      </div>
    @endforeach
  @else
    <p>No articles found.</p>
  @endif
@endsection