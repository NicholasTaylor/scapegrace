<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        @if(count($allAssets) > 0)
            <div style="">
                @foreach ($allAssets as $asset)
                    <div
                        style="width: 16%; padding: .75em; display: inline-block;"
                    >
                        <div>
                            {{ $asset->name }}
                        </div>
                        <div>
                            From {{ $asset->article()->get()->firstOrFail()->title }}
                        </div>
                        <img src="{{ asset($asset->path) }}" style="max-width: 100%; height: auto;" />
                    </div>
                @endforeach
            </div>
        @else
            No assets to show.
        @endif
    </body>
</html>