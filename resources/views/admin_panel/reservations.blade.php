@extends('admin')

@section ('resources')
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <table class="table is-striped is-hoverable is-fullwidth" id="users-table">
                <tr>
                    <th>ID</th>
                    <th>Teacher</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Timeslot</th>
                    <th>Edit/Delete</th>
                </tr>
                @foreach($pastReservations as $pastReservation)
                    <tr>
                        <td>{{ $pastReservation->id }}</td>
                        <td>{{ $pastReservation->teacher->name }}</td>
                        <td>{{ $pastReservation->student->name }}</td>
                        <td>{{ $pastReservation->course->name }}</td>
                        <td>{{ $pastReservation->timeslot->timeslot }}</td>
                        <td>
                            <a href=""><i class="far fa-edit"></i></a>
                            <a href=""><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $pastReservations->links() }}
        </div>
    </div>
    <div class="columns">
        <div class="column is-6">
            <table class="table is-striped is-hoverable is-fullwidth" id="users-table">
                <tr>
                    <th>ID</th>
                    <th>Teacher</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Timeslot</th>
                    <th>Edit/Delete</th>
                </tr>
                @foreach($futureReservations as $futureReservation)
                    <tr>
                        <td>{{ $futureReservation->id }}</td>
                        <td>{{ $futureReservation->teacher->name }}</td>
                        <td>{{ $futureReservation->student->name }}</td>
                        <td>{{ $futureReservation->course->name }}</td>
                        <td>{{ $futureReservation->timeslot->timeslot }}</td>
                        <td>
                            <a href=""><i class="far fa-edit"></i></a>
                            <a href=""><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $futureReservations->links() }}
        </div>
        <div class="column is-6">
            <table class="table is-striped is-hoverable is-fullwidth" id="users-table">
                <tr>
                    <th>ID</th>
                    <th>Teacher</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Timeslot</th>
                    <th>Edit/Delete</th>
                </tr>
                @foreach($cancelledReservations as $cancelledReservation)
                    <tr>
                        <td>{{ $cancelledReservation->id }}</td>
                        <td>{{ $cancelledReservation->teacher->name }}</td>
                        <td>{{ $cancelledReservation->student->name }}</td>
                        <td>{{ $cancelledReservation->course->name }}</td>
                        <td>{{ $cancelledReservation->timeslot->timeslot }}</td>
                        <td>
                            <a href=""><i class="far fa-edit"></i></a>
                            <a href=""><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $cancelledReservations->links() }}
        </div>
    </div>
@endsection