@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(count($articles) > 0)
                @foreach($articles as $article)
                <div class="card mb-1">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <ul class="dashboard-article-icons">
                                <li class="mb-2 mt-2">
                                    <a href="#"><i class="fas fa-user-circle"></i></a>
                                </li>
                                <li class="mb-2">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <span class="badge badge-primary badge-pill">25</span>
                                </li>
                                <li class="mb-2">
                                    <a href="#"><i class="far fa-comment"></i></a>
                                    <span class="badge badge-primary badge-pill">720</span>
                                </li>
                            </ul> 
                        </div>
                        <div class="col-md-10">
                            <div class="card-body pl-0">
                                <h4>{{$article->authorScreenName}}</h6>
                                <small class="card-subtitle text-muted">{{$article->authorUsername}} | Written {{$article->publishedAt}}</small>
                                <hr class="my-2">
                                <h4 class="card-title"><a href="/articles/{{$article->articleId}}">{{$article->title}}</a></h4>
                                <p class="card-text">{{$article->content}}</p>
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
</div>
@endsection
