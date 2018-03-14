<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use App\Comment;
use App\Admin;
use App\User;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // redirects user to login.blade when not logged in or registered
    // public function __construct()
    // {
    //     $this->middleware("auth");
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset(Auth::user()->id)) {
            if (DB::table("admins")->where("user_id", "=", Auth::user()->id)->exists()) {
                $admin = 1;
            } else {
                $admin = 0;
            }
            $admins = Admin::pluck("user_id")->all();
            $users = User::whereNotIn("id", $admins)->get();
        } else {
            $admin = 0;
            $users = "";
        }
        $comments = Comment::all();
        $events = Event::where("id", ">", 0)->orderBy("date", "desc")->get();
        return view("home", compact("admin", "events", "comments", "users"));
    }
}
