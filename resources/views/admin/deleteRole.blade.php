<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="{{ route('role.destroy', $role->id) }}" />
            @method('DELETE')
            @csrf
                <h1>
                    Delete Role?
                </h1>
                <div>
                    Are you sure you want to delete this role? Multiple users can lose access to vital permissions.
                </div>
                <div>
                    <strong>{{ _('Name') }}</strong>
                </div>
                <div>
                    {{ $role->name }}
                </div>
                <div>
                    <strong>{{ _('Permissions') }}</strong>
                </div>
                <ul>
                    @foreach ($role->permissions()->pluck('name') as $permission)
                        <li>
                            {{ $permission }}
                        </li>
                    @endforeach
                </ul>
                <div>
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