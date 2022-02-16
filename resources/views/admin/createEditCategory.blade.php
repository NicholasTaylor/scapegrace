<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ Route::currentRouteName() == 'category.edit' ? route('category.update', $category->id) : route('category.store') }}" />
            @if (Route::currentRouteName() == 'category.edit')
                @method('PATCH')
            @endif
            @csrf
                <h1>
                    Create Category
                </h1>
                <div>
                    <label for="name">
                        {{ __('Category Name') }}
                    </label>
                    <input id="name" type="text" name="name" value="{{ Route::currentRouteName() == 'category.edit' ? $category->name : old('name') }}" required autofocus />
                </div>
                
                <div>
                    <label for="description">
                        {{ __('Description') }}
                    </label>
                    <input id="description" type="text" name="description" value="{{ Route::currentRouteName() == 'category.edit' ? $category->description : old('description') }}" />
                </div>

                <div>
                    <button>
                        {{ __('Create') }}
                    </button>
                </div>

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
        </form>
        <script src="{{ asset('js/ckeditor.js') }}"></script>
        <script src="{{ asset('js/wysiwyg.js') }}"></script>
    </body>
</html>