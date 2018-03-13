@extends('applayout')

@section('title')
    Create New Article
@endsection

@section('main_content')
    <h1>Create New Article</h1>
    <form method="POST">
        {{ csrf_field() }}
        Title: <input type="text" name="title" value="{{$article->title}}"><br>
        Content: <textarea name="content">{{$article->content}}</textarea><br>
        <input type="submit" name="submit" value="Submit">
    </form>
@endsection