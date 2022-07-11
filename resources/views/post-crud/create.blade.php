@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Nuovo Post</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <form  action="{{ route("admin.post.store") }}" method="POST">
            @csrf
            <div class="mb-3 ">
              <label for="exampleInputEmail1" class="form-label">Titolo</label>
              <input type="text" class="form-control @error("title") is-invalid

              @enderror" id="title" name="title" placeholder="Inserisci il Titolo" value="{{ old("title") }}">
              @error("title")
                  <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Inserisci Contenuto</label>
                <textarea class="form-control @error("content")
                    is-invalid
                @enderror " name="content" id="content" cols="30" rows="10" >{{ old("content") }}</textarea>
                @error("content")
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <select class="form-select mt-3" name="category_id">
                    <option  value="">selezione una categoria</option>
                    @foreach ( $categories as $category )
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach


                </select>
            </div>

            <div class="mb-3">
                @foreach ( $tags as $tag )
                <input type="checkbox"
                name="tags[]"
                id="tag-{{ $loop->iteration }}"
                value="{{ $tag->id }}"
                @if (in_array($tag->id, old("tags",[]))) checked @endif>
                <label for="">{{ $tag->name }}</label>
                @endforeach
            </div>







            <button type="submit" class="btn btn-primary">Invia</button>
          </form>
    </div>
@endsection
