@extends('applayout') @section('main_content')

<h2>
    <a href='{{url("articles/create")}}'>Create a New Article</a>
</h2>

<h3>List of Articles</h3>

<ul>
    @foreach($articles as $article)
    <li>
        <a href='{{url("/articles/$article->id")}}'>{{ $article->title }}</a>
        <a href='{{url("/articles/$article->id/delete")}}'>
            <button>Delete This Article</button>
        </a>
    </li>
    @endforeach
</ul>

@endsection