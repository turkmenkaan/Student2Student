@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/teacher_dashboard.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="columns">
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Planlanmış Derslerim
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <table class="table is-striped is-hoverable is-fullwidth">
                            <tr>
                                <th>Ders Adı</th>
                                <th>Öğrenci Adı</th>
                                <th>Tarihi</th>
                                <th>Saati</th>
                            </tr>
                            @foreach($futureReservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->course->name }}</td>
                                    <td>{{ $reservation->student->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($reservation->timeslot->date)) }}</td>
                                    <td>{{ $reservation->timeslot->hour }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Uygun Saatlerim
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label for="date" class="label">Tarih</label>
                            </div>
                            <div class="field-body">
                                <div class="select">
                                    <select name="date" id="picker" v-model="selectedDate">
                                        @foreach ($dates as $date)
                                            <option value="{{ $date->format('Y-m-d') }}">{{ $date->format('d/m/Y') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <timetable teacher-id="{{ auth()->user()->id }}" mode="dashboard" :selected-date="selectedDate"></timetable>
                        <p class="help" style="text-align: center">
                            Tabloda yeşil saatler uygun olduğunuz saatleri,
                            kırmızılar ise ders almak istemediğiniz saatleri göstermektedir.
                            <br>
                            Saatlere basarak uygunluk durumunu değiştirebilirsiniz.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Geçmiş Derslerim
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <table class="table is-striped is-hoverable is-fullwidth">
                            <tr>
                                <th>Ders Adı</th>
                                <th>Öğrenci Adı</th>
                                <th>Tarihi</th>
                                <th>Saati</th>
                            </tr>
                            @foreach($pastReservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->course->name }}</td>
                                    <td>{{ $reservation->student->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($reservation->timeslot->date)) }}</td>
                                    <td>{{ $reservation->timeslot->hour }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Hakkımdaki Yorumlar
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        @foreach($comments as $comment)
                            <p>
                                {{ $comment->content }}<br>
                                <small>- {{ $comment->author }}</small>
                            <hr>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection