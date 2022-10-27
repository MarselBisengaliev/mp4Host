@extends('main')

@section('content')
    <section class="oneVideo">
        <div class="container">
            @if (auth()->user() !== null && auth()->user()->email_verified_at !== null) 
                Вы успешно подтвердили ващ Email
                @else
                Подтвердите адрес электронной почты
            @endif
        </div>
    </section>
@endsection
