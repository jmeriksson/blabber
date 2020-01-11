@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if(count($articles) > 0)
                @foreach($articles as $article)
                <div class="card mb-1">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-md-1 text-center">
                                <a href="#" class="dashboard-user-icon mx-auto text-dark"><i class="fas fa-user-circle"></i></a>
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
                    </div>
                </div>
                @endforeach
            @else
                <p>No articles found.</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">View your articles</a>
                        <a href="#" class="list-group-item list-group-item-action">Create new article</a>
                        <a href="#" class="list-group-item list-group-item-action">View your profile</a>
                        <a href="#" class="list-group-item list-group-item-action">Log out</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
