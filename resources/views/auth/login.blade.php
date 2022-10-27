@extends('main')

@section('content')
    <section class="register">
        <div class="register-block">
            <div class="register-block__logo"><span>mp4</span>Host</div>
            <form class="register-block__form" action="{{ route('auth.authorization') }}">
                @csrf
                <input type="text" placeholder="Почта" name="email" id="">
                <input type="text" placeholder="Пароль" name="password" id="">

                <input type="submit" value="Войти" name="" id="">
            </form>
        </div>
    </section>
@endsection
