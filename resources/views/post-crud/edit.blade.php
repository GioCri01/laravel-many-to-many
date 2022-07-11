@extends("layouts.app")

@section("content")
<div class="container">
    <h1>Modifica Post</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif
    <form  action="{{ route("admin.post.update",$post) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="mb-3 ">
          <label for="exampleInputEmail1" class="form-label">Titolo</label>
          <input type="text" class="form-control @error("title")
              is-invalid
          @enderror" id="title" name="title" placeholder="Inserisci il Titolo" value="{{ old("title") }}" >
            @error("title")
                  <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Inserisci Contenuto</label>
            <textarea class="form-control @error("content")
                is-invalid
            @enderror" name="content" id="content" cols="30" rows="10" >{{ old("content") }}
            </textarea>
            @error("content")
                  <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <select class="form-select my-3" name="category_id">
            <option selected>selezione una categoria</option>
            @foreach ( $categories as $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach


        </select>




        <button type="submit" class="btn btn-primary d-block">Invia</button>
      </form>
</div>
@endsection
