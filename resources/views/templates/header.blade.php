<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <title>mp4Host</title>
    @yield('styles')
</head>

<body>
    <header>
        <div class="container">
            <div class="header">
                <div class="header-logo"><span>mp4</span>Host</div>

                <nav class="header-menu">
                    <a href="{{ route('home') }}">Главная страница</a>
                    <a href="{{ route('video.my-video') }}">Мои видео</a>
                    @if (auth()->user())
                        <a href="{{ route('auth.logout') }}">Выход</a>     
                        <a href="{{ route('account', ['accountId' => auth()->user()->id]) }}">Аккаунт</a>     
                    @endif
                </nav>

				@if (!auth()->user())
					<div class="header-auth">
						<a href="{{ route('auth.register') }}">Регистрация</a>
						<a href="{{ route('auth.login') }}">Вход</a>
					</div>
				@endif
            </div>
        </div>
    </header>
