<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Author;
use DB;

class AuthorsController extends Controller
{
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

        Auth::login($author);

        return redirect('/dashboard')->with('success', 'Author created. Welcome to Blabber!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
