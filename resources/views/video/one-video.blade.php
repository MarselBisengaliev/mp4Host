@extends('main')

@section('content')
@if ($video->status != 3 && $video->status != 1)
<section class="oneVideo">
    <div class="container">
        <div class="oneVideo-content">
            <video controls src="{{ asset('storage/' . $video->file) }}"></video>
            <div class="oneVideo-content__top">
                <div class="oneVideo-content__top-name">{{ $video->name }}</div>
                <div class="oneVideo-content__top-date">
                    {{ $video->created_at->format('d:m:Y') }} {{ $video->created_at->format('h:m') }}
                </div>
            </div>
            <span class="desc">Категория</span>
            <p class="oneVideo-content__desc dop">{{ $video->status }}</p>

            <span class="desc">Ограничения</span>
            <p class="oneVideo-content__desc dop">{{ $video->status }}</p>

            <span class="desc">Оценки</span>
            <p class="oneVideo-content__desc dop"><span style="color: green;">Лайков:</span>
                {{ count($video->likes) }}<br><span style="color: red;">Дизлайков:</span> {{ count($video->dislikes) }}
            </p>


            <span class="desc">Описание</span>
            <p class="oneVideo-content__desc">{{ $video->description }}</p>

            <span class="desc">Комментарии | {{ count($video->comments) }}</span>

            <div class="oneVideo-content__comm">

                <div class="oneVideo-content__comm-inputs">
                    <form action="{{ route('comment.store', ['videoId' => $video->id]) }}" method="POST">
                        @csrf
                        <input type="text" autocomplete="off" name="text" id="">
                        <input type="submit" value="Оставить комментарий">
                    </form>
                </div>

                @foreach ($video->comments as $comment)
                    @if ($comment->user_id === $video->user_id)
                        <div class="oneVideo-content__comm-item myComm">
                            <span class="oneVideo-content__comm-item__name">{{ $comment->user->name }}</span>
                            <span class="oneVideo-content__comm-item__date"> |
                                {{ $comment->created_at->format('d:m:Y') }}
                                {{ $comment->created_at->format('h:m') }}</span>
                            <div class="oneVideo-content__comm-item__comm">{{ $comment->text }}</div>
                        </div>
                    @else
                        <div class="oneVideo-content__comm-item">
                            <span class="oneVideo-content__comm-item__name">{{ $comment->user->name }}</span>
                            <span class="oneVideo-content__comm-item__date"> |
                                {{ $comment->created_at->format('d:m:Y') }}
                                {{ $comment->created_at->format('h:m') }}</span>
                            <div class="oneVideo-content__comm-item__comm">{{ $comment->text }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

    @else
    Ролик не доступен
@endif

@endsection
