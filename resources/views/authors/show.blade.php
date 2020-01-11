@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <i class="fas fa-user-circle mb-2 text-center" style="font-size: 6rem;"></i>
          <h2 class="card-title">{{$author->screenName}}</h2>
          <h5 class="card-subtitle text-muted">&#64;{{$author->username}}</h4>
          @if(!Auth::guest() && Auth::user()->id !== $author->id)
            @if (in_array($author->id, $subscriptions))
              <button class="btn btn-primary mt-4 btn-disabled" disabled><i class="fas fa-check"></i> Subscribing</button>
              {!! Form::open(['action' => 'AuthorsController@unsubscribe', 'method' => 'POST']) !!}
                {{Form::text('publisherId', $author->id, ['style' => 'display:none'])}}
                {{Form::submit('Unsubscribe', ['class' => 'btn btn-outline-primary mt-1'])}}
              {!! Form::close() !!}
            @else
            {!! Form::open(['action' => 'AuthorsController@subscribe', 'method' => 'POST']) !!}
              {{Form::text('publisherId', $author->id, ['style' => 'display:none'])}}
              {{Form::submit('Subscribe', ['class' => 'btn btn-outline-primary mt-4'])}}
            {!! Form::close() !!}
            @endif
          @endif
        </div>
      </div>
  </div>
  <div class="col-md-8">
    @if(count($articles) > 0)
      @foreach($articles as $article)
        <div class="card mb-4">
          <div class="card-body">
            <h4 class="card-title">{{$article->title}}</h4>
            <small class="card-subtitle text-muted">Written {{$article->created_at}}</small>
            <hr>
            <p class="card-text">{{$article->excerpt}}... <a href="/articles/{{$article->id}}">Read more</a></p>
            <ul class="dashboard-article-icons pl-0 mt-2">
              <li class="mb-2">
                <a href="#"><i class="far fa-heart"></i></a>
                <span class="badge badge-secondary badge-pill">25</span>
              </li>
              <li class="mb-2">
                <a href="#"><i class="far fa-comment"></i></a>
                <span class="badge badge-secondary badge-pill">720</span>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    @else
      <div class="card">
        <div class="card-body">
            This author has not written any articles yet.
        </div>
      </div>
    @endif
  </div>
</div>
@endsection