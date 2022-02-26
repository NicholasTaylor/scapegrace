<!DOCTYPE html>
<html>
    <?php
        $roles = $user->roles()->get()->pluck('name')->all();
    ?>
    <head>
    </head>
    <body>
        <form method="POST" action="{{route('user.updateProfile')}}" />
            @method('PATCH')
            @csrf
            <h1>
                Edit Profile
            </h1>
            <div>
                <label for="name">
                    {{ __('Name') }}
                </label>
                <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus />
            </div>
            
            <div>
                <label for="email">
                    {{ __('Email') }}
                </label>
                <input id="email" type="text" name="email" value="{{ $user->email }}" />
            </div>
            
            
            <div>
                <h1>
                    {{ __('Your Roles') }}
                </h1>
                @if (count($roles) > 0)
                    <ul>
                        @foreach ($roles as $role)
                            <li>
                                    {{ $role }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div>
                        <p>
                            You don't have any roles assigned to you yet.
                        </p>
                    </div>
                @endif

            </div>

        
            <div>
                <h1>
                    {{ __('Your Articles') }}
                </h1>
                @if (count($articles) > 0)
                    <div
                        style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
                    >
                        <div
                            style="flex: 1 1 25%"
                        >
                            <strong>{{ _('Title') }}</strong>
                        </div>
                        <div
                            style="flex: 2 1 75%"
                        >
                            <strong>{{ _('Excerpt') }}</strong>
                        </div>
                    </div>
                    @foreach ($articles as $article)
                        <div
                            style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
                        >
                            <div
                                style="flex: 1 1 25%"
                            >
                                {{ $article->title }}
                            </div>
                            <div
                                style="flex: 2 1 75%"
                            >
                                {{ $article->excerpt }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <p>
                            You haven't written any articles yet.
                        </p>
                    </div>
                @endif
            </div>

            <div>
                <button>
                    {{ __('Save') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{route('user.destroyProfile')}}" />
            @method('DELETE')
            @csrf
            <div>
                <h1>
                    {{ __('Delete Account') }}
                </h1>
                <p>
                    This can't be undone. You will be deleting your own account. Are you sure you wish to do this?
                </p>
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