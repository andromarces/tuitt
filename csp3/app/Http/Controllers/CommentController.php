<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $comment = new Comment;
        $comment->description = $request->comment;
        $comment->event_id = $request->event_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
    }

    public function editComment(Request $request)
    {
        $edit_comment = Comment::find($request->id);
        $edit_comment->description = $request->description;
        $edit_comment->save();
    }

    public function deleteComment(Request $request)
    {
        Comment::find($request->id)->delete();
    }
}
