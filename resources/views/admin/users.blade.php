<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>
            Users
        </h1>

        <div
            style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
        >
            <div
                style="flex: 1 1 25%"
            >
                <strong>{{ _('Name') }}</strong>
            </div>
            <div
                style="flex: 2 1 25%"
            >
                <strong>{{ _('Roles') }}</strong>
            </div>
            @if(Gate:: check('edit users') || Gate::check('change roles'))
                <div
                    style="flex: 1 1 25%"
                >
                </div>
            @endif
            @can('delete users')
                <div
                    style="flex: 1 1 25%"
                >
                </div>
            @endcan
        </div>
        @foreach ($users as $user)
            <?php
                $roles = $user->roles()->get()->all();
            ?>
            <div
                style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
            >
                <div
                    style="flex: 1 1 25%"
                >
                    {{ $user->name }}
                </div>
                <div
                    style="flex: 2 1 25%"
                >
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <span style="display:block;">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    @endif
                </div>
                @if((Gate::check('edit users') || Gate::check('change roles')))
                    <div
                        style="flex: 1 1 25%"
                    >
                        @if((!(in_array('Super-Admin',$user->roles()->get()->pluck('name')->all())) || $user->id == auth()->user()->id))
                            <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                        @else
                            &nbsp;
                        @endif
                    </div>
                @endif
                @if(Gate::check('delete users'))
                    <div
                        style="flex: 1 1 25%"
                    >
                        @if(!(in_array('Super-Admin',$user->roles()->get()->pluck('name')->all())))
                            <a href="{{ route('user.delete', $user->id) }}">Delete</a>
                        @else
                            &nbsp;
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </body>
</html>