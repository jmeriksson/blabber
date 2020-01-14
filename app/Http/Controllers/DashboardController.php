<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use DB;

class DashboardController extends Controller
{
    private $currentUserId = 0;
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
        if (Auth::check()) {
            $this->currentUserId = auth()->user()->id;
        }

        $getArticlesQuery =
        "SELECT articles.id AS articleId, screenName AS authorScreenName, username AS authorUsername, authors.id AS authorId, articles.createdAt AS publishedAt, title, LEFT(content, 250) AS excerpt, likes
        FROM articles JOIN authors JOIN is_subscriber_to
        ON subscriberId = $this->currentUserId
        AND publisherId = articles.authorId
        AND authors.id = articles.authorId
        LEFT JOIN no_of_likes
        ON articles.id = no_of_likes.articleId
        ORDER BY publishedAt DESC";

        $articles = DB::select($getArticlesQuery);

        $getLikedArticlesQuery =
        "SELECT articleId
        FROM is_liked_by
        WHERE authorID = $this->currentUserId";

        $likedArticles = array();
        foreach(DB::select($getLikedArticlesQuery) as $like) {
            array_push($likedArticles, $like->articleId);
        }

        return view('dashboard')->with([
            'articles' => $articles,
            'likedArticles' => $likedArticles
            ]);
    }
}
