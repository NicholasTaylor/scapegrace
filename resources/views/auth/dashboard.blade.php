<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <nav>
            <div>
                <a href="">Articles</a>
            </div>
            <div>
                <a href="{{ route('category.index') }}">Categories</a>
            </div>
            <div>
                <a href="">Profile</a>
            </div>
        </nav>
        <div>
            <h1>
                {{ __('Dashboard') }}
            </h1>
            <h2>
                Hello, {{ auth()->user()->name }}
            </h2>
            <ul>
                <li>
                    <a href="{{ route('article.create') }}">Create a article</a>
                </li>
            </ul>
            <h1>
                Your Recent Articles
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
            @foreach ($articles as $article)
                <div
                    style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
                >
                    <div
                        style="flex: 2 1 33%"
                    >
                        {{ $article->title }}
                    </div>
                    <div
                        style="flex: 2 1 33%"
                    >
                        {{ $article->excerpt }}
                    </div>
                    <div
                        style="flex: 1 1 17%"
                    >
                        <a href="{{ route('article.edit', $article->id)}}">{{ _('Edit') }}</a>
                    </div>
                    <div
                        style="flex: 1 1 17%"
                    >
                        <a href="{{ route('article.delete', $article->id)}}">{{ _('Delete') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>