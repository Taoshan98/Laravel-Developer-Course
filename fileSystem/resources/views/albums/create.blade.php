@extends('template.layout')

@section('content')

    <h1>Edit Album</h1>

    <form action="{{route('albums.store')}}" method="POST">
        {{csrf_field()}}

        <div class="form-group">
            <label for="album_name">Name</label>
            <input type="text" name="album_name" id="album_name" class="form-control" placeholder="Album Name"
                   aria-describedby="helpId" value="">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"
                      placeholder="Album Description" aria-describedby="helpId"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
