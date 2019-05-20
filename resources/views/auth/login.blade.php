@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('navbar')
    @include('includes.landing-navbar')
@endsection

@section('content')
    <div class="container">
        <div id="login">
            <div class="login-card">

                <div class="card-title">
                    <h1>Lütfen Giriş Yapın</h1>
                </div>

                <div class="content">
                    <form method="POST" action="#">
                        @csrf

                        <input id="email" type="email" name="email" title="email" placeholder="Email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif

                        <input id="password" type="password" name="password" title="password" placeholder="Şifre" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                        <div class="level options">
                            <div class="checkbox level-left">
                                <input type="checkbox" id="checkbox" class="regular-checkbox">
                                <label for="checkbox"></label>
                                <span>Beni Hatırla</span>
                            </div>

                            <a class="btn btn-link level-right" href="{{ route('password.request') }}">Şifremi Unuttum</a>
                        </div>

                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
