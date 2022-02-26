<!DOCTYPE html>
<html>
    <?php
        $roleIds = $user->roles()->get()->pluck('id')->all();
    ?>
    <head>
    </head>
    <body>
        <form method="POST" action="{{route('user.update', $user->id)}}" />
            @method('PATCH')
            @csrf
                <h1>
                    Edit User
                </h1>
                <div>
                    @if (Gate::check('edit users'))
                        <label for="name">
                            {{ __('Name') }}
                        </label>
                        <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus />
                    @else
                        {{ __('Name') }}: {{ $user->name }}
                        <input type="hidden" name="name" value="{{ $user->name }}">
                    @endif
                </div>
                
                <div>
                    @if (Gate::check('edit users'))
                        <label for="email">
                            {{ __('Email') }}
                        </label>
                        <input id="email" type="text" name="email" value="{{ $user->email }}" />
                    @else
                    {{ __('Email') }}: {{ $user->email }}
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    @endif
                </div>
                
                
                @if (count($allRoles) > 0)
                    <div>
                        <label for="roles">
                            {{ __('Roles') }}
                        </label>
                        <ul>
                            @foreach ($allRoles as $role)
                                <li>
                                    @if (Gate::check('change roles'))
                                        <input type="checkbox" id="{{ $role->name }}" value="{{ $role->name }}" name="roles[]"{{ in_array($role->id,$roleIds) ? 'checked' : '' }}>
                                        <label for="{{ $role->name }}">{{ ucwords($role->name) }}</label>
                                    @else
                                        {{ ucwords($role->name) }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div>
                        <label for="roles">
                            {{ __('Roles') }}
                        </label>
                        <p>
                            No assignable/removeable roles exist for this user.
                        </p>
                    </div>
                @endif

                @if (count($articles) > 0)
                    <div>
                        <h1>
                            {{ __('Articles Written') }}
                        </h1>
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
                    </div>
                @endif

                <div>
                    <button>
                        {{ __('Save') }}
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