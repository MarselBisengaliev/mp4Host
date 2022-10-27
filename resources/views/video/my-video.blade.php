@extends('main')

@section('content')
    <div class="btn">
        <a href="{{ route('video.create') }}" class="btn-add">+</a>
    </div>

    <section class="video">
        <div class="video-content">

            @foreach ($videos as $video)
                @if ($video->status != 3)
                    <div class="video-content__item">
                        <video controls src="{{ asset('storage/' . $video->file) }}"></video>
                        <p class="video-content__item-name">{{ $video->name }}</p>
                        <p class="video-content__item-date"> {{ $video->created_at->format('d:m:Y') }}
                            {{ $video->created_at->format('h:m') }}</p>

                        <a href="{{ route('video.one-video', ['videoId' => $video->id]) }}"
                            class="video-content__item-btn">Перейти на видео</a>
                    </div>
                    @else
                    <div class="video-content__item">
                        Ролик не доступен
                    </div>
                @endif
            @endforeach


        </div>
    </section>
@endsection
