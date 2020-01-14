@extends('layouts.app')

@section('content')
  <h1>Our Latest Articles</h1>
  @if(count($articles) > 0)
    @foreach($articles as $article)
    <div class="card mb-1">
      <div class="card-body">
          <div class="row no-gutters">
              <div class="col-md-1 text-center">
                  <a href="/authors/{{$article->authorId}}" class="dashboard-user-icon mx-auto text-dark"><i class="fas fa-user-circle"></i></a>
              </div>
              <div class="col-md-11 pl-2">
              <h4 class="card-title mb-0 font-typewriter"><a href="/authors/{{$article->authorId}}" class ="text-dark">{{$article->authorScreenName}}</a></h4>
                  <small class="card-subtitle text-muted">{{$article->authorUsername}} | Written {{$article->publishedAt}}</small>
              </div>
          </div>
          <hr class="my-2">
          <div class="row no-gutters">
              <div class="col-12">
                  <h4 class="card-title"><a href="/articles/{{$article->articleId}}" class="text-dark">{{$article->title}}</a></h4>
                  <p class="card-text">{{$article->excerpt}}... <a href="/articles/{{$article->articleId}}">Read more</a></p>
              </div>
              <div class="col-12">
                  <ul class="dashboard-article-icons pl-0 mt-2">
                      <li class="mb-2">
                          @if(in_array($article->articleId, $likedArticles))
                            {!!Form::open(['action' => ['InteractionsController@unlikeArticle'], 'method' => 'POST', 'style' => 'display:inline-block;'])!!}
                                {{Form::text('articleId', $article->articleId, ['style' => 'display:none'])}}
                                {{Form::text('currentPosition', '/articles', ['style' => 'display:none'])}}
                                {{Form::button('<i class="fas fa-heart"></i>', ['type' => 'submit', 'style="background:none;border:none;padding:0;color:red;"'])}}
                            {!!Form::close()!!}
                          @else
                            {!!Form::open(['action' => ['InteractionsController@likeArticle'], 'method' => 'POST', 'style' => 'display:inline-block;'])!!}
                                {{Form::text('articleId', $article->articleId, ['style' => 'display:none'])}}
                                {{Form::text('currentPosition', '/articles', ['style' => 'display:none'])}}
                                {{Form::button('<i class="far fa-heart"></i>', ['type' => 'submit', 'style="background:none;border:none;padding:0;"'])}}
                            {!!Form::close()!!}
                          @endif
                            <span class="badge badge-secondary badge-pill">{{$article->noOfLikes}}</span>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
    @endforeach
  @else
    <p>No articles found.</p>
  @endif
@endsection