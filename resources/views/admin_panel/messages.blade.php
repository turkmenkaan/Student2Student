@extends('admin')

@section ('resources')
    @if (!empty($messages))
        <table class="table is-striped is-hoverable is-fullwidth" id="users-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Content</th>
            </tr>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->content }}</td>
                    <td>
                        <a href=""><i class="far fa-edit"></i></a>
                        <a href=""><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $messages->links() }}
    @endif
@endsection