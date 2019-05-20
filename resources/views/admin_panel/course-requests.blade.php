@extends('admin')

@section ('resources')
    @if (!empty($requests))
        <table class="table is-striped is-hoverable is-fullwidth" id="requests-table">
            <tr>
                <th>ID</th>
                <th>Requester Name</th>
                <th>Course Name</th>
                <th>Course Description</th>
                <th>Edit/Delete</th>
            </tr>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->description }}</td>
                    <td>
                        <a href=""><i class="far fa-edit"></i></a>
                        <a href=""><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $requests->links() }}
    @endif
@endsection