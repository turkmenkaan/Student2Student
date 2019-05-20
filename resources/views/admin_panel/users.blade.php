@extends('admin')

@section ('resources')
    @if (!empty($users))
        <table class="table is-striped is-hoverable is-fullwidth" id="users-table">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>School</th>
                <th>Class</th>
                <th>Description</th>
                <th>Edit/Delete</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->school }}</td>
                    <td>{{ $user->class }}</td>
                    <td id="desc">{{ $user->description }}</td>
                    <td>
                        <a href=""><i class="far fa-edit"></i></a>
                        <a href=""><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    @endif
@endsection