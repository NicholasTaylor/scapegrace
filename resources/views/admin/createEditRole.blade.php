<!DOCTYPE html>
<?php
    $rolePermissionsIds = [];
    $mode = Route::currentRouteName() == 'role.edit' ? 'edit' : 'create';
    if ($mode == 'edit')
        {
            $mode = 'edit';
            foreach ($role->permissions()->pluck('id') as $permissionId)
            {
                $rolePermissionsIds[] = $permissionId;
            }
        }
    else
        {
            $mode = 'create';
        }
?>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ $mode == 'edit' ? route('role.update', $role->id) : route('role.store') }}" />
            @if ($mode == 'edit')
                @method('PATCH')
            @endif
            @csrf
                <h1>
                    Create Role
                </h1>
                <div>
                    <label for="name">
                        {{ __('Role Name') }}
                    </label>
                    <input id="name" type="text" name="name" value="{{ $mode == 'edit' ? $role->name : old('name') }}" required autofocus />
                </div>
                
                @if (count($allPermissions) > 0)
                    <div>
                        <label for="permissions">
                            {{ __('Permissions') }}
                        </label>
                        <ul>
                            @foreach ($allPermissions as $permission)
                                <li>
                                    <input type="checkbox" id="{{ $permission->name }}" value="{{ $permission->name }}" name="permissions[]"{{ in_array($permission->id,$rolePermissionsIds) ? 'checked' : '' }}>
                                    <label for="{{ $permission->name }}">{{ ucwords($permission->name) }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <button>
                        {{ __('Create') }}
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