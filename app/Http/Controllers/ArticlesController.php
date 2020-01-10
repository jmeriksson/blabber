<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use DB;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query =
        "SELECT *
        FROM articles
        ORDER BY created_at DESC";

        $articles = DB::select($query);
        return view('articles.index')->with('articles', $articles);
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

        // Create Article
        $article = new Article;
        $article->title =  $request->input('title');
        $article->content =  $request->input('body');
        $article->authorId =  1; // TODO: CHANGE TO CURRENT USER
        $article->published = true;
        $article->save(); // TODO: REPLACE WITH RAW SQL -> DB::INSERT

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
        $query =
        "SELECT *
        FROM articles
        WHERE id = '$id'";

        $article = DB::select($query);
        return view('articles.show')->with('article', $article[0]);
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

        $article = DB::select($query);
        return view('articles.edit')->with('article', $article[0]);
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
        /* $article->authorId =  1; // TODO: CHANGE TO CURRENT USER
        $article->published = true; */
        /* $article->save(); */

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
