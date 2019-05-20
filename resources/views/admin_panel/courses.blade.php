@extends('admin')

@section ('resources')
    @if (!empty($courses))
        <table class="table is-striped is-hoverable is-fullwidth" id="users-table">
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Teacher Name</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Edit/Delete</th>
            </tr>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->teacher->name }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->cost }}</td>
                    <td>
                        <a href=""><i class="far fa-edit"></i></a>
                        <a href=""><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $courses->links() }}
    @endif
@endsection