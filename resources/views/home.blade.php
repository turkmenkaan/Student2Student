@extends('includes.master')

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h1 style="text-align:center; margin-top: 35%">Welcome To Our New Site, {{ ucwords(Auth::user()->name) }}</h1>
        </div>
    </div>
@endsection
