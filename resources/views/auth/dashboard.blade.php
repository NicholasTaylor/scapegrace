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
            <div
                style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
            >
                <div
                    style="flex: 2 1 33%"
                >
                    <strong>{{ _('Title') }}</strong>
                </div>
                <div
                    style="flex: 2 1 33%"
                >
                    <strong>{{ _('Excerpt') }}</strong>
                </div>
                <div
                    style="flex: 1 1 17%"
                >
                    
                </div>
                <div
                    style="flex: 1 1 17%"
                >
                    
                </div>
            </div>
            @foreach ($posts as $post)
                <div
                    style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
                >
                    <div
                        style="flex: 2 1 33%"
                    >
                        {{ $post->title }}
                    </div>
                    <div
                        style="flex: 2 1 33%"
                    >
                        {{ $post->excerpt }}
                    </div>
                    <div
                        style="flex: 1 1 17%"
                    >
                        <a href="{{ route('post.edit', $post->id)}}">{{ _('Edit') }}</a>
                    </div>
                    <div
                        style="flex: 1 1 17%"
                    >
                        <a href="{{ route('post.delete', $post->id)}}">{{ _('Delete') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>