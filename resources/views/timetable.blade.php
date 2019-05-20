@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/timetable.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <timetable teacher="{{ auth()->user()->name }}"></timetable>
@endsection
