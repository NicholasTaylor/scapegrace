<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div>
            <h1>
                {{ __('Dashboard') }}
            </h1>
            <h2>
                Hello, {{ auth()->user()->name }}
            </h2>
            <ul>
                <li>
                    <a href="{{ route('post.create') }}">Create a post</a>
                </li>
            </ul>
            <h1>
                Your Posts
            </h1>
            <ul>
                @foreach ($posts as $post)
                    <li>
                        <a href="{{ route('post.edit', $post->id)}}">{{ $post->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </body>
</html>