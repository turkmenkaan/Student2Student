@extends('includes.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/teachers.css') }}">
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('content')
    <div class="container">
        @foreach ($teachersArray as $teachers)
        <div class="row columns">
            @foreach ($teachers as $teacher)
                <div class="column is-3 teacherCard">
                    <div class="card">
                        <figure class="image is-128x128">
                            <img class="is-rounded" src="{{ asset($teacher->photoUrl) }}">
                        </figure>
                        <h4><a href="{{ route('profile', ['id' => $teacher->id ]) }}">{{ $teacher->name }}</a></h4>
                        <p>{{ $teacher->description }}</p>
                        <p><strong>Ücret: </strong>{{ $teacher->cost }} TL</p>
                        <p><strong>Okul: </strong>{{ $teacher->school }}</p>
                        <p><strong>Puan: </strong>
                            <star-rating :read-only="true" :round-start-rating="false" :rating="{{ $teacher->rating }}" :star-size="14" :show-rating="false" :inline="true"></star-rating>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection