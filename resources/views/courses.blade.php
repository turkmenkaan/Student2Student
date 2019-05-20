@extends('includes.master')

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="columns" style="margin-top: 1%;">
        <div class="column is-10 is-offset-1">
            @if (session('success'))
                <div class="notification is-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Ders</th>
                        <th>Dersi Veren</th>
                        <th>Ücret</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->name }}</td>
                            <td><a href="{{ route('profile', ['id'=>$lesson->teacher->id]) }}">{{ $lesson->teacher->name }}</a></td>
                            <td>{{ $lesson->cost }}</td>
                            <td><a href="{{ route('reserveCourse', ['course' => $lesson, 'user' => Auth::user()]) }}" title="Dersi Al"><i class="far fa-calendar-check"></i></a></td>
                            <td><a href=""><i class="far fa-paper-plane"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (Auth::user()->isTeacher === 1)
                <div class="level-right">
                    <a class="button is-info level-item" href="{{ route('createLessonForm') }}">Ders Oluştur</a>
                </div>
            @else
                <div class="level-right">
                    <small style="margin-right: 15px">İstediğiniz ders bulunmuyorsa ders talebi açarak bize bildirebilirsiniz</small>
                    <a class="button is-info level-item" @click="showRequestLessonPanel = true">Ders Talep Et</a>
                    <request-lesson target="{{ route('requestCourse') }}" v-if="showRequestLessonPanel" @close="showRequestLessonPanel = false"></request-lesson>
                </div>
            @endif
            <reserve-timeslot v-if="showReservationPanel" @close="showReservationPanel = false"></reserve-timeslot>
        </div>
    </div>
@endsection