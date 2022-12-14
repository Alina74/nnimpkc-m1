@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                    <h1>Редактирование аккаунта</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Аккаунт успешно отредактирован!</div>
                    @endif
                <form method="post" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="inputFullname" class="form-label">ФИО:</label>
                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="inputFullname" placeholder="Наименование товара: Компьютер" aria-describedby="invalidInputFullname" value="{{\Illuminate\Support\Facades\Auth::user()->fullname}}">
                        @error('fullname')
                        <div id="invalidInputFullname" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputAddress" class="form-label">Адрес:</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="inputAddress" aria-describedby="invalidInputMade" value="{{\Illuminate\Support\Facades\Auth::user()->address}}">
                        @error('address')
                        <div id="invalidInputAddress" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <p class="small">При невводе пароля, изменения его не коснутся.</p>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Пароль:</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPrice" aria-describedby="invalidInputPassword">
                        @error('password')
                        <div id="invalidInputPassword" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPasswordConfirmation" class="form-label">Повтор пароля:</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="inputPasswordConfirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Редактировать аккаунт
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
