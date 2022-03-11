<!DOCTYPE html>
<html>
    <?php 
        $mode = Route::currentRouteName() == 'asset.edit' ? 'edit' : 'create';
    ?>
    <head>
    </head>
    <body>
        <form 
            method="POST" action="{{ $mode == 'edit' ? route('asset.update', $id) : route('asset.store') }}" enctype="multipart/form-data" />
            @if ($mode == 'edit')
                @method('PATCH')
            @endif
            @csrf
                <input type="hidden" id="media_type" name="media_type" value="image">

                <h1>
                    Asset Upload Proof of Concept
                </h1>

                <div>
                    <label for="name">
                        {{ __('Name') }}
                    </label>
                    <input id="name" type="text" name="name" value="{{ $mode == 'edit' ? $asset->title : old('name') }}" required autofocus />
                </div>
                
                <div>
                    <label for="upload">
                        {{ __('Choose an image') }}
                    </label>
                    <input id="upload" type="file" name="upload" value="" />
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