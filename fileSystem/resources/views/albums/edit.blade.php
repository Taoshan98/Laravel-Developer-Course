@extends('template.layout')

@section('content')

    <h1>Edit Album</h1>

    <form action="/albums/{{$album->id}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" id="_method" value="PATCH">

        <div class="form-group">
            <label for="album_name">Name</label>
            <input type="text" name="album_name" id="album_name" class="form-control" placeholder="Album Name"
                   aria-describedby="helpId" value="{{$album->album_name}}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"
                      placeholder="Album Description" aria-describedby="helpId">{{$album->description}}</textarea>
        </div>

        @include("albums.partial.fileUpload")

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
