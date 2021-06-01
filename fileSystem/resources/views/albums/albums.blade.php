@extends('template.layout')

@section('content')

    <h1>Albums</h1>

    @if(session()->has('message'))
        <x-alert>
            @slot('info',  'primary')
            @slot('message',  session()->get('message'))
        </x-alert>
    @endif

    <form>
        {{csrf_field()}}
        <ul class="list-group">
            @foreach($albums as $album)
                <li class="list-group-item d-flex justify-content-between">
                    ({{$album->id}}) {{$album->album_name}}

                    @if($album->album_thumb)
                        <img width="15%" height="15%" src="{{asset($album->path)}}" title="{{$album->album_name}}"
                             alt="{{$album->album_name}}">
                    @endif
                    <div>
                        <a href="/albums/{{$album->id}}/edit" class="editAlbumBtn btn btn-sm btn-primary">Edit</a>

                        @if($album->photos_count > 0)
                            <a href="/albums/{{$album->id}}/photos" class="editAlbumBtn btn btn-sm btn-primary">({{$album->photos_count}}) View Photos</a>
                        @endif
                        <button data-album="{{$album->id}}" class="deleteAlbumBtn btn btn-sm btn-danger">Delete</button>
                    </div>
                </li>
            @endforeach
        </ul>

        <br>
        <a href="{{route('albums.create')}}" class="addAlbumBtn btn btn-primary">Add New</a>

    </form>

@endsection
@section('footer')
    @parent

    <script>

        $('document').ready(function () {

            $('div.alert').fadeOut(3000);

            $('.deleteAlbumBtn').on('click', function () {

                let currentBtn = $(this);

                $.ajax({
                    url: '/albums/' + currentBtn.data('album'),
                    method: 'DELETE',
                    data: {'_token': $("input[name='_token']").val()},
                    success: function (response) {

                        console.log(response);
                        if (response === '1') {
                            currentBtn.closest('li').remove()
                        } else {
                            alert("Non è stato possibile cancellare L'album")
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        alert("Non è stato possibile cancellare L'album")
                    }
                });
            });
        });

    </script>

@endsection
