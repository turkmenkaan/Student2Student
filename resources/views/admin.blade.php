@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="columns" id="leftMenu">
        <aside class="menu column is-2">
            <ul class="menu-list">
                <li><a href="{{ route('ap_modal', ['modal' => 'dashboard']) }}"><i class="fas fa-chart-line"></i>Dashboard</a></li>
                <li><a href="{{ route('ap_modal', ['modal' => 'users']) }}"><i class="fas fa-users"></i>Kullanıcılar</a></li>
                <li><a href="{{ route('ap_modal', ['modal' => 'teachers']) }}"><i class="fas fa-chalkboard-teacher"></i>Hocalar</a></li>
                <li><a href="{{ route('ap_modal', ['modal' => 'courses']) }}"><i class="fas fa-book-open"></i>Dersler</a></li>
                <li><a href="{{ route('ap_modal', ['modal' => 'reservations']) }}"><i class="far fa-handshake"></i>Rezervasyonlar</a></li>
                <li><a href="{{ route('ap_modal', ['modal' => 'course-requests']) }}"><i class="fas fa-inbox"></i>Ders İstekleri</a></li>
                <li><a href="{{ route('ap_modal', ['modal' => 'messages']) }}"><i class="fas fa-inbox"></i>Mesajlar</a></li>
                <li><a><i class="fas fa-cogs"></i>Ayarlar</a></li>
            </ul>
        </aside>
        <div class=" column is-10">
            @yield('resources')

        </div>
    </div>
@endsection