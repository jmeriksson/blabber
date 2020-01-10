<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $query =
        "SELECT *
        FROM articles
        ORDER BY created_at DESC";
        $articles = DB::select($query); */
        $currentUserId = auth()->user()->id;
        $query =
        "SELECT articles.id AS articleId, screenName AS authorScreenName, username AS authorUsername, articles.created_at AS publishedAt, title, content
        FROM articles JOIN authors JOIN is_subscriber_to
        ON $currentUserId = subscriberId
        AND publisherId = articles.authorId
        AND authors.id = articles.authorId
        ORDER BY publishedAt DESC;
        ";
        $articles = DB::select($query);
        return view('dashboard')->with('articles', $articles);
    }
}
