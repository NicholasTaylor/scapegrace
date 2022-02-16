<!DOCTYPE html>
<html>
    <?php 
        if (isset($post->category_id)):
            $category_id_match = $post->category_id;
        else:
            $category_id_match = '';
        endif;
    ?>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ Route::currentRouteName() == 'post.edit' ? route('post.update', $post->id) : route('post.store') }}" />
            @if (Route::currentRouteName() == 'post.edit')
                @method('PATCH')
            @endif
            @csrf
                <h1>
                    Create Post
                </h1>
                <div>
                    <label for="title">
                        {{ __('Title') }}
                    </label>
                    <input id="title" type="text" name="title" value="{{ Route::currentRouteName() == 'post.edit' ? $post->title : old('title') }}" required autofocus />
                </div>
                
                <div>
                    <label for="excerpt">
                        {{ __('Excerpt') }}
                    </label>
                    <input id="excerpt" type="text" name="excerpt" value="{{ Route::currentRouteName() == 'post.edit' ? $post->excerpt : old('excerpt') }}" />
                </div>
                
                <div>
                    <label for="body">
                        {{ __('Body') }}
                    </label>
                    <textarea id="body" name="body" value="{{ Route::currentRouteName() == 'post.edit' ? $post->body : old('body') }}" />
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
                                <option value="{{ $category->id }}"{{ $category_id_match == $category->id ? ' selected' : ''  }}>{{ ucwords($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div>
                    <label for="published_at">
                        {{ __('Publish Date') }}
                    </label>
                    <input id="published_at" type="datetime-local" name="published_at" value="{{ Route::currentRouteName() == 'post.edit' ? $post->published_at : $currentTime }}" required />
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
        </form>
        <script src="{{ asset('js/ckeditor.js') }}"></script>
        <script src="{{ asset('js/wysiwyg.js') }}"></script>
    </body>
</html>