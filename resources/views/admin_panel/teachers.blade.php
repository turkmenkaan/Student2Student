@extends('admin')

@section ('resources')
    @if (!empty($teachers))
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
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->school }}</td>
                    <td>{{ $teacher->class }}</td>
                    <td id="desc">{{ $teacher->description }}</td>
                    <td>
                        <a href=""><i class="far fa-edit"></i></a>
                        <a href=""><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $teachers->links() }}
    @endif
@endsection