<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    public function index(Post $post){
        $comments= $post->comments()->with('user')->latest()->get();
        return response()->json($comments);
    }


    public function store(Request $request ,Post $post){
        $comment=$post->comments()->create([
            'body'=>$request->body,
            'user_id'=>Auth::id(),
        ]);
        

        $comment=Comment::find($comment->id)->with('user');
        return $comment->toJson();
    }
}
