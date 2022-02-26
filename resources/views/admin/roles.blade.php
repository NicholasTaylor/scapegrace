<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        @can('create roles')
            <a
                href="{{ route('role.create') }}"
            >
                Create New Role
            </a>
        @endcan
        <h1>
            Roles
        </h1>

        <div
            style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
        >
            <div
                style="flex: 2 1 33%"
            >
                <strong>{{ _('Role Name') }}</strong>
            </div>
            <div
                style="flex: 2 1 33%"
            >
                <strong>{{ _('Permissions') }}</strong>
            </div>
            @can('edit roles')
                <div
                    style="flex: 1 1 17%"
                >
                </div>
            @endcan
            @can('delete roles')
                <div
                    style="flex: 1 1 17%"
                >               
                </div>
            @endcan 
        </div>
        @foreach ($roles as $role)
            @if ($role->name != 'Super-Admin')
                <div
                    style="display:flex; flex-direction: row; flex-wrap: no-wrap;"
                >
                    <div
                        style="flex: 2 1 33%"
                    >
                        {{ $role->name }}
                    </div>
                    <div
                        style="flex: 2 1 33%"
                    >
                        @foreach ($role->permissions()->pluck('name') as $permission)
                            {{ $permission }}<br>
                        @endforeach
                    </div>

                @can('edit roles')
                    <div
                        style="flex: 1 1 17%"
                    >
                        <a href="{{ route('role.edit', $role->id)}}">{{ _('Edit') }}</a>
                    </div>
                @endcan
                @can('delete roles')
                    <div
                        style="flex: 1 1 17%"
                    >
                        <a href="{{ route('role.delete', $role->id)}}">{{ _('Delete') }}</a>
                    </div>
                @endcan 
                </div>
            @endif
        @endforeach
    </body>
</html>