<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\Comment;

class EventController extends Controller
{
    public function createEvent(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->place = $request->place;
        $event->image = $request->image;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->description = $request->description;
        $event->user_id = Auth::user()->id;
        $event->save();
    }

    public function editEvent(Request $request)
    {
        $edit_event = Event::find($request->id);
        $edit_event->name = $request->name;
        $edit_event->place = $request->place;
        $edit_event->image = $request->image;
        $edit_event->date = $request->date;
        $edit_event->time = $request->time;
        $edit_event->description = $request->description;
        $edit_event->save();
    }

    public function deleteEvent(Request $request)
    {
        Comment::where("event_id", $request->id)->delete();
        Event::find($request->id)->delete();
    }
}
