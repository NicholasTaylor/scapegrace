<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <nav>
            @if(Gate::check('create articles') || Gate::check('edit articles') || Gate::check('delete articles'))
                <div>
                    <a href="{{ route('article.index') }}">Articles</a>
                </div>
            @endif
            @if(Gate::check('create categories') || Gate::check('edit categories') || Gate::check('delete categories'))
                <div>
                    <a href="{{ route('category.index') }}">Categories</a>
                </div>
            @endif
            @if(Gate::check('create roles') || Gate::check('edit roles'))
                <div>
                    <a href="{{ route('role.index') }}">Roles</a>
                </div>
            @endif
            @if(Gate::check('edit users') ||  Gate::check('delete users') || Gate::check('change roles'))
                <div>
                    <a href="{{ route('user.index') }}">Users</a>
                </div>
            @endif
            <div>
                <a href="{{ route('user.editProfile') }}">Profile</a>
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