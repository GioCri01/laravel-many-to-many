@extends("layouts.app")


@section("content")
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <p>Categoria: <strong>{{ $post->category ? $post->category->name : '-'}}</strong></p>
        @forelse ($post->tags as $tag )
        <h5 class="badge badge-info  "> {{ $tag->name }}</h5>
        @empty
             -
        @endforelse
        <div>
            <a class="btn btn-primary" href="{{ route("admin.post.index") }}">Torna indietro</a>
        </div>
    </div>
@endsection
