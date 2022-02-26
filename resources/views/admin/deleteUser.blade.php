<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('user.destroy', $user->id) }}" />
            @method('DELETE')
            @csrf
                <h1>
                    Delete User?
                </h1>
                <div>
                    <strong>{{ _('Name') }}</strong>
                </div>
                <div>
                    {{ $user->name }}
                </div>
                <div>
                    Are you sure you want to delete this user? The user has written the following articles. Those will be deleted too!
                </div>
                <ul>
                    @foreach ($articles as $article)
                        <li>
                            {{ $article->title }}
                        </li>
                    @endforeach
                </ul>
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