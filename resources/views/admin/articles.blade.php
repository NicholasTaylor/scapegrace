<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        @can('create categories')
            <a
                href="{{ route('article.create') }}"
            >
                Create New Article
            </a>
        @endcan
        <h1>
            Articles
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
            @can('edit articles')
                <div
                    style="flex: 1 1 17%"
                >
                </div>
            @endcan
            @can('delete articles')
                <div
                    style="flex: 1 1 17%"
                >               
                </div>
            @endcan 
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

            @can('edit articles')
                <div
                    style="flex: 1 1 17%"
                >
                    <a href="{{ route('article.edit', $article->id)}}">{{ _('Edit') }}</a>
                </div>
            @endcan
            @can('delete articles')
                <div
                    style="flex: 1 1 17%"
                >
                    <a href="{{ route('article.delete', $article->id)}}">{{ _('Delete') }}</a>
                </div>
            @endcan 
            </div>

        @endforeach
    </body>
</html>