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
        $prefillHTML = $mode == 'edit' ? $article->body : ''
    ?>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                    <div id="editArticle" data-article="{{ $prefillHTML }}"></div>
                    <div class="wysiwyg__Modal">
                        <div class="wysiwyg__ModalLink">
                            <div class="wysiwyg__ModalLinkContainer">
                                <div class="wysiwygModal__close">
                                </div>
                                <div class="wysiwyg__ModalLinkContent">
                                    <h2>Add a Link</h2>
                                    <input type="text" id="linkValue" placeholder="https://www.something.com">
                                    <label for="linkValue">Link URL</label>
                                    <input type="checkbox" id="new-tab">
                                    <label for="new-tab">Open in new Tab?</label>
                                    <button class="done">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <input id="published_at" type="datetime-local" name="published_at" required value="{{ $mode == 'edit' ? date( 'Y-m-d\TH:i:s', strtotime( $article->published_at ) ) : $currentTime }}">
                </div>

                <div>
                    <button>
                        {{ __($mode == 'edit' ? 'Save' : 'Create') }}
                    </button>
                </div>

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
        </form>

        <div id="test">
            <form id="upload-img" />
                @csrf
                    <input type="hidden" id="media_type" name="media_type" value="image">
                    <h1>
                        Asset Upload Proof of Concept
                    </h1>
                    <div>
                        <label for="name">
                            {{ __('Name') }}
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    </div>
                    
                    <div>
                        <label for="upload">
                            {{ __('Choose an image') }}
                        </label>
                        <input id="upload" type="file" name="upload" value="" />
                    </div>
                    

                    <div>
                        <button id="btn-submit">
                            Upload
                        </button>
                    </div>

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif
            </form>
        </div>
        <script type="application/javascript" src="{{ asset('js/editArticleIndex.js') }}"></script>
    </body>
</html>