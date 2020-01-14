<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use DB;

class ArticlesController extends Controller
{
    private $currentUserId = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $this->currentUserId = auth()->user()->id;
        }

        $getArticlesQuery =
        "SELECT articles.id AS articleId, screenName AS authorScreenName, username AS authorUsername, authors.id AS authorId, articles.createdAt AS publishedAt, title, LEFT(content, 250) AS excerpt
        FROM articles JOIN authors
        ON authors.id = articles.authorId
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

        $getNoOfLikesQuery =
        "SELECT articleId, COUNT(articleId) AS likes
        FROM is_liked_by
        GROUP BY articleId";

        $likes = DB::select($getNoOfLikesQuery);

        if (count($likes) > 0) {
            foreach($likes as $like) {
                foreach($articles as $article) {
                    if($like->articleId == $article->articleId) {
                        $article->noOfLikes = $like->likes;
                    }
                }
            }
        }

        foreach($articles as $article) {
            if (!array_key_exists('noOfLikes', $article)) {
                $article->noOfLikes = 0;
            }
        }

        return view('articles.index')->with([
            'articles' => $articles,
            'likedArticles' => $likedArticles
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $article = new Article;
        $article->title =  $request->input('title');
        $article->content =  $request->input('body');
        $article->authorId =  auth()->user()->id;
        $article->published = true;
        $article->publishedAt = now();

        $saveArticleQuery =
        "INSERT INTO articles (title, authorId, content, published, createdAt)
        VALUES ('$article->title', '$article->authorId', '$article->content', '1', '$article->publishedAt')";
        DB::insert($saveArticleQuery);

        return redirect('/articles')->with('success', 'Article Published');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $this->currentUserId = auth()->user()->id;
        }

        $getArticleQuery =
        "SELECT *
        FROM articles
        WHERE id = '$id'";

        $article = DB::select($getArticleQuery)[0];

        $getAuthorQuery =
        "SELECT *
        FROM authors
        WHERE id = $article->authorId";

        $author = DB::select($getAuthorQuery)[0];

        $getLikedArticlesQuery =
        "SELECT articleId
        FROM is_liked_by
        WHERE authorID = $this->currentUserId";

        $likedArticles = array();
        foreach(DB::select($getLikedArticlesQuery) as $like) {
            array_push($likedArticles, $like->articleId);
        }
        
        return view('articles.show')->with([
            'article' => $article,
            'author' => $author,
            'likedArticles' => $likedArticles
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query =
        "SELECT *
        FROM articles
        WHERE id = '$id'";

        $article = DB::select($query)[0];
        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $selectQuery =
        "SELECT *
        FROM articles
        WHERE id = '$id'";

        $article = DB::select($selectQuery)[0];
        $article->title =  $request->input('title');
        $article->content =  $request->input('body');

        $updateQuery =
        "UPDATE articles
        SET `title` = '$article->title', `content` = '$article->content'
        WHERE `id` = '$article->id'";
        DB::update($updateQuery);
        return redirect('/articles')->with('success', 'Article Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteQuery =
        "DELETE
        FROM articles
        WHERE id = '$id'";

        DB::delete($deleteQuery);

        return redirect('/articles')->with('success', 'Article Removed');
    }
}
