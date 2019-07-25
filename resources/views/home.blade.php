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
    <section class="home-banner-area" id="search-area">
        <div class="columns">
            <div id="main" class="column is-8 is-offset-2 fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content">
                    <h3 class="wow fadeIn" id="course-search" data-wow-duration="4s">{{ config('app.name') }}'da Almak İstediğiniz Dersi Arayın</h3>
                    <div class="input-wrap">
                        <form action="{{ route('search') }}" method="POST" class="form-box d-flex justify-content-between">
                            @csrf
                            <input type="text" placeholder="Ders Arayın" class="form-control" name="search">
                            <button type="submit" class="btn search-btn">Ara</button>
                        </form>
                        @if (session('status'))
                            <div class="not-found">
                                <p>
                                    {{ session('status') }}
                                </p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="columns">
            <div class="column is-6 is-offset-3" id="instructions-div">
                <h3 id="instructions-title">Nasıl Ders Alırım?</h3>
                <p>
                    Arama alanına istediğiniz ders adını yazarak ya da dersler bölümünü
                    görüntüleyerek mevcut derslerimize göz atabilirsiniz. Eğer istediğiniz bir
                    ders listelerimizde bulunmuyorsa, dersler bölümündeki ders talep et
                    bölümünden yeni ders talebinde bulunabilirsiniz.
                </p>
                <p>
                    İstediğiniz dersi bulmanız durumunda istediğiniz dersin yanındaki takvim
                    butonuna basarak tarih ve saat seçebilir, rezervasyon talebinde bulunabilirsiniz.
                    Rezervasyon talebiniz dersi veren kişiye gönderilecek, kendisi tarafından
                    onaylanması durumunda size onay maili gelecektir.
                </p>
            </div>
        </div>
    </section>
    <section class="home-banner-area">
        <div class="columns">
            <div class="column is-10 is-offset-1 populars">
                <h4 class="title">Popüler Hocalar</h4>
                <div id="teacher-images">
                    @foreach ($popularTeachers as $teacher)
                        <figure>
                            <img src="{{ asset($teacher->photoUrl) }}" class="image is-256x256" alt="Hoca 1" height="190" width="178">
                            <figcaption>{{ $teacher->name }}</figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="columns">
            <div class="column is-10 is-offset-1 populars">
                <h4 class="title">Popüler Dersler</h4>
                <table class="table">
                    @foreach ($popularCourses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td><a href="#">{{ $course->teacher->name }}</a></td>
                            <td>{{ $course->cost }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>

@endsection
