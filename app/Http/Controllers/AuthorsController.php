<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Author;
use DB;

class AuthorsController extends Controller
{
    private $currentUserId = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if username or email is already registered
        $usernameExistsQuery =
        "SELECT *
        FROM authors
        WHERE username = '{$request->input('username')}'";

        $usernameExists = DB::select($usernameExistsQuery);

        $emailExistsQuery =
        "SELECT *
        FROM authors
        WHERE username = '{$request->input('email')}'";

        $emailExists = DB::select($emailExistsQuery);

        if(count($usernameExists) > 0) {
            return redirect('/authors/create')->with('error', "Username {$request->input('username')} is already taken");
        }

        if(count($emailExists) > 0) {
            return redirect('/authors/create')->with('error', "E-mail address {$request->input('email')} is already registered");
        }

        $this->validate($request, [
            'username' => 'required|unique:authors',
            'screenName' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'repeatPassword' => 'required|same:password',
        ]);

        $author = new Author;
        $author->username = $request->input('username');
        $author->screenName = $request->input('screenName');
        $author->email = $request->input('email');
        $author->password = Hash::make($request->input('password'));

        $storeUserQuery =
        "INSERT INTO authors (username, screenName, email, password)
        VALUES ('$author->username', '$author->screenName', '$author->email', '$author->password')";

        DB::insert($storeUserQuery);

        return redirect('/login')->with('success', 'Author created. Welcome to Blabber! You can now log in.');
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

        $getAuthorQuery =
        "SELECT id, username, screenName, COUNT(subscriberId) AS subscribes
        FROM authors LEFT JOIN is_subscriber_to
        ON publisherId = '$id' AND subscriberId = '$this->currentUserId'
        WHERE authors.id = '$id'
        GROUP BY id, username, screenName";

        $author = DB::select($getAuthorQuery)[0];

        $getArticlesQuery =
        "SELECT id, title, authorId, createdAt, LEFT(content, 250) AS excerpt, likes
        FROM articles LEFT JOIN no_of_likes
        ON articles.id = no_of_likes.articleId
        WHERE authorId = '$id'
        ORDER BY createdAt DESC";

        $articles = DB::select($getArticlesQuery);

        $getLikedArticlesQuery =
        "SELECT articleId
        FROM is_liked_by
        WHERE authorID = $this->currentUserId";

        $likedArticles = array();
        foreach(DB::select($getLikedArticlesQuery) as $like) {
            array_push($likedArticles, $like->articleId);
        }

        return view('authors.show')->with([
            'author' => $author,
            'articles' => $articles,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function subscribe(Request $request)
    {
        if (Auth::check()) {
            $this->currentUserId = auth()->user()->id;
        }
        $publisherId = $request->input('publisherId');

        $addSubscriptionQuery =
        "INSERT INTO is_subscriber_to (subscriberId, publisherId)
        VALUES ('$this->currentUserId', '$publisherId')";

        DB::insert($addSubscriptionQuery);
        return redirect("/authors/$publisherId");
    }

    public function unsubscribe(Request $request)
    {
        if (Auth::check()) {
            $this->currentUserId = auth()->user()->id;
        }
        $publisherId = $request->input('publisherId');

        $deleteSubscriptionQuery =
        "DELETE
        FROM is_subscriber_to
        WHERE subscriberId = '$this->currentUserId' AND publisherId = '$publisherId'";

        DB::delete($deleteSubscriptionQuery);

        return redirect("/authors/$publisherId");
    }
}
