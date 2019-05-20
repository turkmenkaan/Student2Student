@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="columns">
        <div class="column is-6 is-offset-3" id="main">
            @if (session('success'))
                <div class="notification is-success">
                    {{ session('success') }}
                </div>
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="notification is-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <article class="message">
                <div class="message-header">
                    Bizimle İletişime Geçin
                </div>
                <div class="message-body">
                    <form action="{{ route('sendContact') }}" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Ad Soyad</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input class="input" type="text" name="name">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        {{--<span class="icon is-small is-right">--}}
                                            {{--<i class="fas fa-check"></i>--}}
                                        {{--</span>--}}
                                    </p>
                                </div>
                            </div>
                            {{--<p class="help is-success">This username is available</p>--}}
                        </div>

                        <!-- Email Field -->
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Email</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input class="input" type="email" name="email">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Field -->
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Mesajınız</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <textarea class="textarea" name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button Field -->
                        <div class="field is-grouped is-grouped-right">
                            <p class="control">
                                <input type="submit" class="button is-primary is-right" value="Gönder">
                            </p>
                        </div>

                    </form>
                </div>
            </article>
        </div>
    </div>
@endsection
