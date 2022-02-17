<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('article.destroy', $article->id) }}" />
            @method('DELETE')
            @csrf
                <h1>
                    Delete Article?
                </h1>
                <div>
                    Are you sure you want to delete this article?
                </div>
                <div>
                    <strong>{{ _('Title') }}</strong>
                </div>
                <div>
                    {{ $article->title }}"
                </div>
                <div>
                    <strong>{{ _('Excerpt') }}</strong>
                </div>
                <div>
                    {{ $article->excerpt }}"
                </div>
                <div>
                    <strong>{{ _('Body') }}</strong>
                </div>
                <div>
                    {!! $article->body !!}
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