@extends('layouts.app')

@section('content')
    <div style="background-color: #f9c5d1; background-image: linear-gradient(315deg, #f9c5d1 0%, #9795ef 74%); height: 100vh; width: 100%; display: flex; justify-content: center; align-items: center; flex-direction: column">
        <h1>Авторизация</h1>
        <form action="{{ route('login_process') }}" style="width: 400px" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail2">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Введите email">
                @error('email')
                <span id="emailHelp" style="color: red" class="form-text">{{ $message }}</span>

                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword2">Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Пароль">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>

@endsection
