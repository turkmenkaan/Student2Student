@extends('includes.master')

@section('navbar')
    @include('includes.landing-navbar')
@endsection

@section('content')
<div class="container">

    @if( $errors->any() )
        <br>
        <div class="notification is-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ ucwords($error) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>
    <role-choser @set-student="showStudentForm = true" @set-teacher="showTeacherForm = true" v-if="!showStudentForm && !showTeacherForm"></role-choser>
    <div class="columns justify-content-center" v-if="showStudentForm">
        <div class="column is-6 is-offset-3">
            <br>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Kayıt Ol</p>
                </header>

                <div class="card-content">
                    <form method="POST" action="{{ route('registerStudent') }}">
                    @csrf

                    <!-- Name/Surname Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label for="name" class="label">Ad Soyad</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="text" id="teacherName" class="input{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Email</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- School Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Okul</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="text" class="input" placeholder="Okul Adı" name="school" required>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label for="password" class="label">Şifre</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="password" class="input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Şifrenizi Giriniz" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control">
                                        <input type="password" class="input" name="password_confirmation" placeholder="Şifrenizi Tekrar Giriniz" required>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-link">
                                    Kayıt Ol
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="columns" v-if="showTeacherForm">
        <div class="column is-6 is-offset-3">
            <br>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Kayıt Ol</p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('registerTeacher') }}">
                        @csrf

                        <!-- Name/Surname Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label for="name" class="label">Ad Soyad</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="text" id="teacherName" class="input{{ $errors->has('teacherName') ? ' is-invalid' : '' }}" name="name" value="{{ old('teacherName') }}" required autofocus>
                                        @if ($errors->has('teacherName'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('teacherName') }}</strong>
                                    </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                            <!-- Email Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Email</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="email" class="input" name="email" required>
                                    </p>
                                </div>
                            </div>
                        </div>
                            <!-- School Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Okul</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="text" class="input" placeholder="Okul Adı" name="school" required>
                                    </p>
                                </div>

                            </div>
                        </div>

                            <!-- Password Field -->
                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label for="password" class="label">Şifre</label>
                                </div>
                                <div class="field-body">
                                    <div class="field">
                                        <p class="control">
                                            <input type="password" class="input" name="password" placeholder="Şifrenizi Giriniz" required>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <p class="control">
                                            <input type="password" class="input" name="password_confirmation" placeholder="Şifrenizi Tekrar Giriniz" required>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Graduation Year Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">

                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="integer" class="input" placeholder="Mezuniyet Yılı" name="grad-year">
                                    </p>
                                </div>
                                <div class="field is-expanded">
                                    <div class="control select">
                                        <select name="class">
                                            <option value="" disabled selected>Sınıfınız...</option>
                                            <option value="9">Lise 1</option>
                                            <option value="10">Lise 2</option>
                                            <option value="11">Lise 3</option>
                                            <option value="12">Lise 4</option>
                                            <option value="1">Üniversite 1</option>
                                            <option value="2">Üniversite 2</option>
                                            <option value="3">Üniversite 3</option>
                                            <option value="4">Üniversite 4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- Region Field -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Bölge</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input type="text" class="input" name="district" placeholder="İlçe">
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control">
                                        <input type="search" class="input" name="city" placeholder="Şehir" id="city" autocomplete="new-password">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Ücret</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-expanded">
                                    <p class="control">
                                        <input type="integer" class="input" name="cost" placeholder="Ders Başına Alınacak Ücret" required>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input type="submit" value="Kayıt Ol" class="button is-primary" style="margin-left: 80%;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
