<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <a
            href="{{ route('category.create') }}"
        >
            Create New Category
        </a>
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
            <div
                style="flex: 1 1 17%"
            >
                
            </div>
            <div
                style="flex: 1 1 17%"
            >
                
            </div>
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
                <div
                    style="flex: 1 1 17%"
                >
                    <a href="{{ route('category.edit', $category->id)}}">{{ _('Edit') }}</a>
                </div>
                <div
                    style="flex: 1 1 17%"
                >
                    <a href="{{ route('category.delete', $category->id)}}">{{ _('Delete') }}</a>
                </div>
            </div>

        @endforeach
    </body>
</html>