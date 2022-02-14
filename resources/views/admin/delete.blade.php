<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('post.destroy', $post->id) }}" />
            @method('DELETE')
            @csrf
                <h1>
                    Delete Post?
                </h1>
                <div>
                    Are you sure you want to delete this post?
                </div>
                <div>
                    <strong>{{ _('Title') }}</strong>
                </div>
                <div>
                    {{ $post->title }}"
                </div>
                <div>
                    <strong>{{ _('Excerpt') }}</strong>
                </div>
                <div>
                    {{ $post->excerpt }}"
                </div>
                <div>
                    <strong>{{ _('Body') }}</strong>
                </div>
                <div>
                    {!! $post->body !!}
                </div>
                <input type="hidden" name="_method" value="delete">
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