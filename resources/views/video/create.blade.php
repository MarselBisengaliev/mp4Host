@extends('main')

@section('content')
    <section class="register">
        <div class="register-block">
            <div class="register-block__logo"><span>mp4</span>Host</div>
            <form class="register-block__form" action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" placeholder="Название ролика" name="name" id="">
                <textarea type="text" placeholder="Описание" name="description" id=""></textarea>
                <select name="status" id="">
                    <option value="null">Нет ограничений</option>
                    <option value="1">Нарушение</option>
                    <option value="2">Теневой бан</option>
                    <option value="3">Бан</option>
                </select>
                <input accept=".mp4" type="file" name="file" id="">
                <input type="submit" value="Войти" name="" id="">
            </form>
        </div>
    </section>
@endsection
