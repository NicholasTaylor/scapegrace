<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        @can('create categories')
            <a
                href="{{ route('category.create') }}"
            >
                Create New Category
            </a>
        @endcan
        <h1>
            Your Categories
        </h1>

        <div
            style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
        >
            <div
                style="flex: 2 1 33%"
            >
                <strong>{{ _('Category Name') }}</strong>
            </div>
            <div
                style="flex: 2 1 33%"
            >
                <strong>{{ _('Description') }}</strong>
            </div>
            @can('edit categories')
                <div
                    style="flex: 1 1 17%"
                >
                </div>
            @endcan
            @can('delete categories')
                <div
                    style="flex: 1 1 17%"
                >               
                </div>
            @endcan 
        </div>
        @foreach ($categories as $category)
            <div
                style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
            >
                <div
                    style="flex: 2 1 33%"
                >
                    {{ $category->name }}
                </div>
                <div
                    style="flex: 2 1 33%"
                >
                    {{ $category->description }}
                </div>

            @can('edit categories')
                <div
                    style="flex: 1 1 17%"
                >
                    <a href="{{ route('category.edit', $category->id)}}">{{ _('Edit') }}</a>
                </div>
            @endcan
            @can('delete categories')
                <div
                    style="flex: 1 1 17%"
                >
                    <a href="{{ route('category.delete', $category->id)}}">{{ _('Delete') }}</a>
                </div>
            @endcan 
            </div>

        @endforeach
    </body>
</html>