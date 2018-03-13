<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function addComment(Request $request)
    {
        $rules = array(
            "comment" => "required | min:5",
        );
        $this->validate($request, $rules);
        $new_comment = new Comment();
        $new_comment->comments = $request->comment;
        $new_comment->user_id = Auth::user()->id;
        $new_comment->task_id = $request->task_id;
        $new_comment->save();
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id)->delete();
    }

    public function editComment(Request $request, $id)
    {
        $edit_comment = Comment::find($id);

        $rules = array(
            "comment" => "required | min:5",
        );
        $this->validate($request, $rules);

        $edit_comment->comments = $request->comment;
        $edit_comment->save();

    }

}
