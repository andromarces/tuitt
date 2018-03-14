<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Admin;
use App\Event;
use App\Comment;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function editPassword(Request $request)
    {
        $edit_user = User::find(Auth::user()->id);
        $rules = array(
            "password" => "required|string|min:6|confirmed",
        );
        $this->validate($request, $rules);
        $edit_user->password = bcrypt($request->password);
        $edit_user->save();
    }

    public function updateUser(Request $request)
    {
        $edit_user = User::find(Auth::user()->id);
        $rules = array(
            "username" => "required|string|max:255",
            "email" => "required|string|email|max:255",
        );
        $this->validate($request, $rules);
        $edit_user->username = $request->username;
        $edit_user->email = $request->email;
        $edit_user->save();
    }

    public function createAdmin(Request $request)
    {
        $rules = array(
            "username" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6|confirmed",
        );
        $this->validate($request, $rules);
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user_id = User::where("username", $request->username)->first();
        $admin = new Admin;
        $admin->user_id = $user_id->id;
        $admin->save();
    }

    public function deleteAccount()
    {
        Comment::where("user_id", Auth::user()->id)->delete();
        $events = Event::where("user_id", $request->id)->get();
        $comments = Comment::whereIn("event_id", $events)->delete();
        Event::where("user_id", Auth::user()->id)->delete();
        Admin::where("user_id", Auth::user()->id)->delete();
        User::find(Auth::user()->id)->delete();
    }

    public function deleteUser(Request $request)
    {
        Comment::where("user_id", $request->id)->delete();
        $events = Event::where("user_id", $request->id)->get();
        $comments = Comment::whereIn("event_id", $events)->delete();
        Event::where("user_id", $request->id)->delete();
        User::find($request->id)->delete();
    }

    public function checkEmail(Request $request)
    {
        if (DB::table("users")->where("email", "=", $request->email)->exists()) {
            if (isset(Auth::user()->email)) {
                if ($request->email == Auth::user()->email) {
                    return "2";
                } else {
                    return "1";
                }
            } else {
                return "1";
            }
        } else {
            return "2";
        }
    }

    public function checkUsername(Request $request)
    {
        if (DB::table("users")->where("username", "=", $request->username)->exists()) {
            if (isset(Auth::user()->username)) {
                if ($request->username == Auth::user()->username) {
                    return "2";
                } else {
                    return "1";
                }
            } else {
                return "1";
            }
        } else {
            return "2";
        }
    }
}
