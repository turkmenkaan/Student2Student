@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/course-creation.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')

    <form class="form-horizontal" method="POST" action="{{ route('storeLesson') }}">
        <div class="columns">
            <div class="column is-6 is-offset-3" style="margin-top: 2%;margin-bottom: 2%">
                @if (session('error'))
                    <div class="notification is-danger">
                        <ul id="course-creation-error">
                            {{ session('error')  }}
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="field">
                    <input class="input" type="text" placeholder="Ders Adı" id="courseName" name="courseName">
                </div>
                <div class="field">
                    <textarea name="courseDescription" id="courseDescription" class="textarea" placeholder="Dersinizi kısaca tanıtınız..."></textarea>
                </div>
                <div class="field">
                    <p class="control has-icons-left">
                        <input type="number" name="cost" min="30" max="200" class="input" step="5" value="100" style="width: 20%;">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lira-sign"></i>
                        </span>
                    </p>
                    <button class="button is-success">Dersi Kaydet</button>
                </div>
            </div>

        </div>
    </form>
@endsection