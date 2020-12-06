<div class="form-group">
    <input type="file" class="form-control-file" id="album_thumb" name="album_thumb">
</div>

@if($album->album_thumb)
    <p>Preview</p>
    <div class="form-group">
        <img width="50%" height="50%" src="{{asset($album->path)}}" title="{{$album->album_name}}"
             alt="{{$album->album_name}}">
    </div>
@endif
