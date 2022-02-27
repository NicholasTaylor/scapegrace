<!DOCTYPE html>
<html>
    <?php 
        $mode = Route::currentRouteName() == 'asset.edit' ? 'edit' : 'create';
    ?>
    <head>
    </head>
    <body>
        <form 
            method="POST" action="{{ $mode == 'edit' ? route('asset.update', $id) : route('asset.store', $id) }}" enctype="multipart/form-data" />
            @if ($mode == 'edit')
                @method('PATCH')
            @endif
            @csrf
                <input type="hidden" id="article_id" name="article_id" value="1">
                <input type="hidden" id="media_type" name="media_type" value="image">

                <h1>
                    Asset Upload Proof of Concept
                </h1>

                <div>
                    <label for="name">
                        {{ __('Name') }}
                    </label>
                    <input id="name" type="text" name="name" value="{{ $mode == 'edit' ? $article->title : old('name') }}" required autofocus />
                </div>
                
                <div>
                    <label for="image">
                        {{ __('Choose an Image') }}
                    </label>
                    <input id="image" type="file" name="image" value="" />
                </div>
                

                <div>
                    <button>
                        {{ __($mode == 'edit' ? 'Edit' : 'Upload') }}
                    </button>
                </div>

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
        </form>
    </body>
</html>