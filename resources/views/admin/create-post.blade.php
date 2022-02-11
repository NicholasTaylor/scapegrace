<!DOCTYPE html>
<html>
    <?php 
        use Carbon\Carbon;
    ?>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('post.firstSave') }}" />
            @csrf
                <h1>
                    Create Post
                </h1>
                <div>
                    <label for="title">
                        {{ __('Title') }}
                    </label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required autofocus />
                </div>
                
                <div>
                    <label for="excerpt">
                        {{ __('Excerpt') }}
                    </label>
                    <input id="excerpt" type="text" name="excerpt" value="{{ old('excerpt') }}" />
                </div>
                
                <div>
                    <label for="body">
                        {{ __('Body') }}
                    </label>
                    <textarea id="body" name="body" value="{{ old('body') }}" />
                    </textarea>
                </div>
                
                @if (count($categories) > 0)
                    <div>
                        <label for="category">
                            {{ __('Category') }}
                        </label>
                        <select id="category_id" name="category_id">
                            <option value="">None</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div>
                    <label for="published_at">
                        {{ __('Publish Date') }}
                    </label>
                    <input id="published_at" type="datetime-local" name="published_at" value="{{ Carbon::now()->toDateTimeString(); }}" required />
                </div>

                <div>
                    <button>
                        {{ __('Post') }}
                    </button>
                </div>

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
    </body>
</html>