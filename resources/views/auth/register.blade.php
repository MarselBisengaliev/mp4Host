@extends('main')

@section('content')
    <section class="register">
        <div class="register-block">
            <div class="register-block__logo"><span>mp4</span>Host</div>
            <form class="register-block__form" action="{{ route('auth.registration') }}" method="post">
                @csrf
                <input type="text" placeholder="Имя" name="name" id="name">
                <input type="text" placeholder="Почта" name="email" id="email">
                <input type="text" placeholder="Пароль" name="password" id="password">
                <input type="text" placeholder="Повторите пароль" 
                name="password_confirmation" id="password_confirmation">

                <input type="submit" value="Зарегистрироваться" name="" id="">
            </form>
        </div>
    </section>
@endsection
