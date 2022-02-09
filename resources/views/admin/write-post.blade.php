<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('dashboard') }}" />
            @csrf
                <h1>
                    Create Post
                </h1>
                <div>
                    <label for="title">
                        {{ __('Title') }}
                    </label>
                    <input id="title" type="text" name="title" :value="old('title')" required autofocus />
                </div>
                
                <div>
                    <label for="excerpt">
                        {{ __('Excerpt') }}
                    </label>
                    <input id="excerpt" type="text" name="excerpt" :value="old('excerpt')" />
                </div>
                
                <div>
                    <label for="body">
                        {{ __('Body') }}
                    </label>
                    <textarea id="body" name="body" :value="old('body')" />
                    </textarea>
                </div>

                <div>
                    <button>
                        {{ __('Post') }}
                    </button>
                </div>
    </body>
</html>