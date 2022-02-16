<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('category.destroy', $category->id) }}" />
            @method('DELETE')
            @csrf
                <h1>
                    Delete Category?
                </h1>
                <div>
                    Are you sure you want to delete this category? This could impact multiple articles.
                </div>
                <div>
                    <strong>{{ _('Name') }}</strong>
                </div>
                <div>
                    {{ $category->name }}"
                </div>
                <div>
                    <strong>{{ _('Description') }}</strong>
                </div>
                <div>
                    {{ $category->description }}"
                </div>
                <div>
                    <button>
                        {{ __('Delete') }}
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