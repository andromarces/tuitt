@extends('layouts.app') @section('content')
<div class="container" id="mainContent">
    <div id="addEventParent">
        {{-- create event button --}} @auth
        <div class="row justify-content-center mb-4 mx-1" id="addEvent">
            <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#createEventForm">
                <i class="fa fa-plus" aria-hidden="true"> </i> Create Event</button>
        </div>
        @endauth
    </div>

    <div id="eventsParent">
        <div id="eventsContent">
            @if (count($events) > 0) @foreach($events as $event)
            <!--Card-->
            <div class="card col-12 mb-2">

                <!--Card image-->
                <img class="img-fluid" src="{{$event->image}}" alt="{{$event->name}}">

                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title mb-0">{{$event->name}}</h4>
                    <strong class="grey-text d-block mb-3">by {{$event->user->username}}</strong>
                    <!--Text-->
                    <small class="grey-text d-block">Venue:</small>
                    <p class="card-text text-dark">{{$event->place}}</p>
                    <small class="grey-text d-block">Date:</small>
                    <p class="card-text text-dark">{{date("F j, Y", strtotime($event->date))}}</p>
                    <small class="grey-text d-block">Time:</small>
                    <p class="card-text text-dark">{{$event->time}}</p>
                    <small class="grey-text d-block">Description:</small>
                    <p class="card-text text-dark">{!!nl2br($event->description)!!}</p>
                    <small class="grey-text">@if ($event->updated_at != $event->created_at) Edited @endif {{$event->updated_at->diffForHumans()}}.</small>
                    @auth
                    <div class="row col-12 mx-0 px-0 eventButtons">
                        @if ($event->user_id == Auth::user()->id)
                        <a href="" class="btn btn-primary ml-auto mr-0 btn-sm editEvent" data-name="{{$event->name}}" data-image="{{$event->image}}"
                            data-place="{{$event->place}}" data-date="{{$event->date}}" data-time="{{$event->time}}" data-description="{{$event->description}}"
                            data-id={{$event->id}} data-toggle="modal" data-target="#editEventForm">
                            <i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                        @endif @if ($event->user_id == Auth::user()->id || $admin == 1)
                        <a href="" class="btn btn-primary mr-0 btn-sm @if ($event->user_id !== Auth::user()->id && $admin == 1) ml-auto @endif deleteEvent">
                            <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        @endif
                    </div>
                    @endauth @if (count($comments) > 0) @foreach ($comments as $comment) @if ($comment->event_id == $event->id) @if ($loop->first)
                    <hr> @endif
                    <div class="col-11 ml-auto border border-primary rounded mb-1">
                        <h4 class="card-title">
                            <i class="fa fa-user" aria-hidden="true"></i> {{$comment->user->username}}</h4>
                        <!--Text-->
                        <p class="card-text mb-0 text-dark commentTxt">{!!nl2br($comment->description)!!}</p>
                        <form>
                            <textarea type="text" class="md-textarea form-control editCommentTxt" rows=1 required>{{$comment->description}}</textarea>
                            <small class="grey-text">@if ($comment->updated_at != $comment->created_at) Edited @endif {{$comment->updated_at->diffForHumans()}}.</small>
                            @auth
                            <div class="row col-12 mx-0 px-0 commentButtons">
                                @if ($comment->user_id == Auth::user()->id)
                                <button class="btn btn-primary ml-auto mr-0 btn-sm editComment px-1" data-event="{{$comment->event_id}}" data-id={{$comment->id}}>
                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                @endif @if ($comment->user_id == Auth::user()->id || $admin == 1)
                                <a href="" class="btn btn-primary mr-0 btn-sm @if ($comment->user_id !== Auth::user()->id && $admin == 1) ml-auto @endif deleteComment px-1">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                @endif
                            </div>
                            @endauth
                        </form>
                    </div>
                    @endif @endforeach @endif @auth
                    <hr>
                    <form class="addCommentForm">
                        <!--Textarea with icon prefix-->
                        <div class="row col-12 px-0 mx-0 d-flex align-items-center">
                            <div class="md-form amber-textarea active-amber-textarea-2 col mt-0">
                                <i class="fa fa-pencil prefix"></i>
                                <textarea type="text" class="md-textarea form-control commentContent pb-0" rows="1" required></textarea>
                                <label for="form24">Add Comment</label>
                                <input type="number" class="d-none commentEventID" value={{$event->id}} required>
                            </div>
                            <button class="btn btn-primary mr-0 btn-sm addComment text-center p-0 d-flex align-items-center justify-content-center">
                                <i class="fa fa-send" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                    @endauth
                </div>

            </div>
            <!--/.Card-->
            @endforeach @endif
        </div>
    </div>
</div>
@endsection