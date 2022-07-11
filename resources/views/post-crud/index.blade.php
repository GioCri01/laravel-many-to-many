@extends("layouts.app")

@section("content")
<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">tags</th>
            <th scope="col">Option</th>


          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category ? $post->category->name : '-'}}</td>
                <td>
                    @forelse ($post->tags as $tag )
                         <span class="badge badge-info">{{ $tag->name }}</span>
                    @empty
                        -
                    @endforelse
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route("admin.post.show",$post) }}">Show</a>
                    <a class="btn btn-warning" href="{{ route("admin.post.edit",$post) }}">edit</a>
                    <form class="d-inline" action="{{ route("admin.post.destroy",$post) }}" method="POST" onsubmit="return confirm('vuoi eliminare {{ $post->title }}')"
                    >
                    @csrf
                    @method("DELETE")

                    <button class="btn btn-danger" type="submit">delete</button>
                </form>
                </td>

              </tr>
            @endforeach


        </tbody>
      </table>
      {{ $posts->links() }}
</div>
@endsection
