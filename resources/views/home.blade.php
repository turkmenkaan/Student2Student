@extends('includes.master')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('css/educature/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educature/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <section class="home-banner-area relative">
        <div class="columns">
            <div id="main" class="column is-8 fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content">
                    <h3 class="wow fadeIn" data-wow-duration="4s">{{ config('app.name') }}'da Almak İstediğiniz Dersi Arayın</h3>
                    <div class="input-wrap">
                        <form action="" class="form-box d-flex justify-content-between">
                            <input type="text" placeholder="Ders Arayın" class="form-control" name="search">
                            <button type="submit" class="btn search-btn">Ara</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="column is-4">
                <table class="table">
                    <tr><td>Favori Hoca 1</td></tr>
                    <tr><td>Favori Hoca 2</td></tr>
                    <tr><td>Favori Hoca 3</td></tr>
                </table>
                <table class="table">
                    <tr><td>Favori Ders 1</td></tr>
                    <tr><td>Favori Ders 2</td></tr>
                    <tr><td>Favori Ders 3</td></tr>
                </table>
            </div>
        </div>
    </section>

@endsection
