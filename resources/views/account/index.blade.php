@extends('main')

@section('content')
    <div class="container">
        <ul>
            <h1>Все входы в аккаунт</h1>
            @foreach ($user->loginHistory as $item)
                <li>{{ $user->created_at->format('d:m:Y') }} {{ $user->created_at->format('h:m') }}</li>
            @endforeach
        </ul>
    </div>
    <section class="register">
        <div class="register-block">
            <div class="register-block__logo"><span>mp4</span>Host</div>
            <form class="register-block__form" action="{{ route('auth.authorization') }}">
                @csrf
                <input type="text" placeholder="Пароль" name="password" id="">

                <input type="submit" value="Обновить пароль" name="" id="">
            </form>
        </div>
    </section>
@endsection
