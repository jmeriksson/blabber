<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use DB;

class InteractionsController extends Controller
{
    public function likeArticle(Request $request)
    {
        $currentUserId = auth()->user()->id;
        $articleId = $request->input('articleId');
        $currentPosition = $request->input('currentPosition');

        $addLikeQuery =
        "INSERT INTO is_liked_by (articleId, authorId)
        VALUES ('$articleId', '$currentUserId')";

        DB::insert($addLikeQuery);
        return redirect($currentPosition);
    }

    public function unlikeArticle(Request $request)
    {
        $currentUserId = auth()->user()->id;
        $articleId = $request->input('articleId');
        $currentPosition = $request->input('currentPosition');

        $removeLikeQuery =
        "DELETE
        FROM is_liked_by
        WHERE articleId = '$articleId' AND authorId = '$currentUserId'";
        
        DB::delete($removeLikeQuery);
        return redirect($currentPosition);
    }
}
