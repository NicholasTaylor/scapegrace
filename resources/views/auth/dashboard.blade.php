<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <nav>
            <div>
                <a href="">Articles</a>
            </div>
            @if(Gate::check('create categories') || Gate::check('edit categories') || Gate::check('delete categories'))
                <div>
                    <a href="{{ route('category.index') }}">Categories</a>
                </div>
            @endif
            @if(Gate::check('create roles') || Gate::check('edit roles') || Gate::check('delete roles') || Gate::check('assign roles') || Gate::check('remove roles'))
                <div>
                    <a href="{{ route('role.index') }}">Roles</a>
                </div>
            @endif
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
            @can('create articles')
                <ul>
                    <li>
                        <a href="{{ route('article.create') }}">Create an article</a>
                    </li>
                </ul>
            @endcan
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
        </div>
    </body>
</html>