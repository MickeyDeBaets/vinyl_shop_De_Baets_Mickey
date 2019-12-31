@extends('layouts.template')

@section('title', 'Users')

@section('main')
    <h1>Users</h1>
    @include('shared.alert')
    <form method="get" action="users" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="username" id="username"
                       value="{{ request()->username }}"
                       placeholder="Filter Name Or Email">
            </div>
            <div class="col-sm-6 mb-2">
                <select class="form-control" name="sorting" id="sorting">
                    <option VALUE="name_AZ" {{ (request()->sorting ==  "name_AZ" ? 'selected' : '') }}>Name (A ⇨ Z)</option>
                    <option value="name_ZA" {{ (request()->sorting ==  "name_ZA" ? 'selected' : '') }}>Name (Z ⇨ A)</option>
                    <option value="email_AZ" {{ (request()->sorting ==  "email_AZ" ? 'selected' : '') }}>Email (A ⇨ Z)
                    </option>
                    <option value="email_ZA" {{ (request()->sorting ==  "email_ZA" ? 'selected' : '') }}>Email (Z ⇨ A)
                    </option>
                    <option value="admin" {{ (request()->sorting ==  "admin" ? 'selected' : '') }}>Admin</option>
                    <option value="active" {{ (request()->sorting ==  "active" ? 'selected' : '') }}>Active</option>
                </select>
            </div>
        </div>
    </form>
    @if ($users->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any user or email with <b>'{{ request()->username }}'</b>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    <hr>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Admin</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->active==1)
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td>
                        @if($user->admin==1)
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td>
                        <form action="/admin/users/{{ $user->id }}" method="post" class="deleteForm" id="deleteForm{{$user->id}}">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/users/{{ $user->id }}/edit"
                                   class="btn btn-outline-success btn-edit" {{$user->id == $currentUser->id ? 'disabled' : ''}}
                                   data-toggle="tooltip"
                                   data-id="{{$user->id}}"
                                   data-name="{{$user->name}}"
                                   title="Edit {{$user->name}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-outline-danger"
                                        {{$user->id == $currentUser->id ? 'disabled' : ''}}
                                        data-toggle="tooltip"
                                        data-id="{{$user->id}}"
                                        data-name="{{$user->name}}"
                                        title="Delete {{ $user->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
@section('script_after')
    <script>
        $('#user_name').blur(function () {
        $('#searchForm').submit();
        });

        $('#sorting').change(function () {
        $('#searchForm').submit();
        });

        //show noty before deleting user
        $(function () {
            $('.deleteForm button').click(function () {
                let id = $(this).data('id');
                let formid = '#deleteForm'+ id;
                let name = $(this).data('name');
                console.log(id+name);
                // Show Noty
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: 'warning',
                    text: '<p>Delete user <b>'+name+'</b>?</p>',
                    buttons: [
                        Noty.button('Delete user', 'btn btn-danger', function () {
                            $(formid).submit();
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });
        })

    </script>
@endsection
