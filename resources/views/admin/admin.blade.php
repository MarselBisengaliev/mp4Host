@extends('main')

@section('content')
    <section class="video">
        <div class="video-content">

            @foreach ($videos as $video)
                <div class="video-content__item">
                    <video controls src="{{ asset('storage/' . $video->file) }}"></video>
                    <p class="video-content__item-name">{{ $video->name }}</p>
                    <p class="video-content__item-date">{{ $video->created_at->format('d:m:Y') }} {{ $video->created_at->format('h:m') }}</p>

                    <a href="{{ route('video.one-video', ['videoId' => $video->id]) }}" class="video-content__item-btn">Перейти на видео</a>

                    <form action="{{ route('video.update', ['videoId' => $video->id]) }}" method="post">
                        @csrf
                        <select name="status" id="">
                            <option value="null">Нет ограничений</option>
                            <option {{ $video->status == 1 ? 'selected' : '' }} value="1">Нарушение</option>
                            <option  {{ $video->status == 2 ? 'selected' : '' }} value="2">Теневой бан</option>
                            <option  {{ $video->status ===3 ? 'selected' : '' }} value="3">Бан</option>
                        </select>

                        <input type="submit" value="Сохранить">
                    </form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
