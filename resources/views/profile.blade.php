@extends('includes.master')

@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="columns">
        <div class="column is-3" id="leftProfile">
            <figure class="image is-image-128x128">
                <img src="{{ asset($user->photoUrl) }}" alt="{{ $user->name }}'s Profile Picture">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            {{ $user->name }}
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <small>{{ $user->description }}</small>
                        </div>
                        <div class="content">
                            <strong>Okul:</strong> {{ $user->school }}<br>
                            <strong>Sınıf:</strong> {{ $class }}<br>
                            <strong>Ücret:</strong> {{ $user->cost }} TL<br>
                            <strong>Puan: </strong><br>
                            {{-- Rating System --}}
                            <star-rating :read-only="true" :round-start-rating="false" :rating="{{ $user->rating }}" :star-size="25" :inline="true"></star-rating>
                        </div>
                        <footer class="card-footer">

                            @if ($user->id == Auth::user()->id)
                                <a href="#" class="card-footer-item" @click="showEditPanel = true">Profil Bilgilerini Güncelle</a>
                            @else
                                <a href="#" class="card-footer-item">Mesaj Gönder</a>
                                <a href="#" class="card-footer-item" @click="showRatePanel = true">Puan Ver</a>
                                <a href="#" class="card-footer-item" @click="showCommentPanel = true">Yorum Yap</a>
                            @endif

                            <rate v-if="showRatePanel" @close="showRatePanel = false" user-id="{{ $user->id }}"></rate>
                            <comment v-if="showCommentPanel" @close="showCommentPanel = false">
                                <form action="{{ route('comment', ['id' => $user->id]) }}" method="POST" id="commentForm">
                                    @csrf
                                    <section class="modal-card-body">
                                        <textarea class="textarea" placeholder="Hocanızı nasıl bilirdiniz?" form="commentForm" name="commentBody"></textarea>
                                    </section>
                                    <footer class="modal-card-foot">
                                        <input type="submit" value="Yorumu Gönder" class="button is-primary">
                                    </footer>
                                </form>
                            </comment>
                            <edit-profile v-if="showEditPanel" @close="showEditPanel = false" user-id="{{ $user->id }}" route="{{ route('updateProfile', ['id' => $user->id]) }}"></edit-profile>
                        </footer>
                    </div>
                </div>
                @if (!$user->id == Auth::user()->id)
                    <a class="button is-medium is-fullwidth is-success">Ders Al</a>
                @endif
            </figure>
        </div>
        <div class="column is-8" id="rightProfile">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Dersler</p>
                </header>
                <div class="card-content">
                    <ol type="I">
                        @foreach($courses as $course)
                            <li>{{ $course->name }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="card">
                <header class="card-header" @click="changeTimeTableStatus">
                    <p class="card-header-title">Uygun Saatler</p>
                </header>
                <div class="card-content" v-if="showTimes">
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
                    <timetable teacher-id="{{ $user->id }}" mode="profile" :selected-date="selectedDate" student="{{ auth()->user()->id }}" id="timetable"></timetable>
                    <p class="help" style="text-align: center">İstediğiniz tarihi seçerek hocanızın o tarihteki boş saatlerini görebilir, yeşil renkte gösterilen
                     boş saatlerin üstüne tıklayarak rezervasyon yapabilirsiniz.</p>
                </div>
            </div>
            <div class="card">
                <header class="card-header" @click="changeCommentsPanelStatus">
                    <p class="card-header-title">Yorumlar</p>
                </header>
                <div class="card-content" v-if="showComments">
                    @foreach($comments as $comment)
                        <p>
                            {{ $comment->content }}<br>
                            <small>- {{ $comment->author }}</small>
                        </p>
                        <hr>
                    @endforeach
                    @if (!$user->id == Auth::user()->id)
                        <a href="#" class="card-footer-item" @click="showCommentPanel = true">Hocanıza Yorum Yapın</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
