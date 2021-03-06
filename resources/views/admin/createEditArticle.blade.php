<!DOCTYPE html>
<html>
    <?php 
        if (isset($article->category_id)):
            $category_id_match = $article->category_id;
        else:
            $category_id_match = '';
        endif;

        $mode = Route::currentRouteName() == 'article.edit' ? 'edit' : 'create';

        if($mode == 'edit'):
            $user_id_match = $article->user_id;
        endif;
    ?>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ $mode == 'edit' ? route('article.update', $article->id) : route('article.store') }}" />
            @if ($mode == 'edit')
                @method('PATCH')
            @endif
            @csrf
                <h1>
                    Create Article
                </h1>
                @if ($mode == 'edit')
                    <div>
                        <label for="user">
                            {{ __('Author') }}
                        </label>
                        <select id="new_user_id" name="new_user_id">
                            <option value="">None</option>
                            @foreach ($allUsers as $user)
                                <option value="{{ $user->id }}"{{ $user_id_match == $user->id ? ' selected' : ''  }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div>
                    <label for="title">
                        {{ __('Title') }}
                    </label>
                    <input id="title" type="text" name="title" value="{{ $mode == 'edit' ? $article->title : old('title') }}" required autofocus />
                </div>
                
                <div>
                    <label for="excerpt">
                        {{ __('Excerpt') }}
                    </label>
                    <input id="excerpt" type="text" name="excerpt" value="{{ $mode == 'edit' ? $article->excerpt : old('excerpt') }}" />
                </div>
                
                <div>
                    <label for="body">
                        {{ __('Body') }}
                    </label>
                    <textarea id="body" name="body" value="{{ $mode == 'edit' ? $article->body : old('body') }}" />
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
                    <input id="published_at" type="datetime-local" name="published_at" value="{{ $mode == 'edit' ? $article->published_at : $currentTime }}" required />
                </div>

                <div>
                    <button>
                        {{ __('Article') }}
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