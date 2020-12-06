<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //così ritorna anche tutte le righe delle foto
        //$albums = Album::orderBy('id', 'DESC')->with('photos')->get();
        $albums = Album::orderBy('id', 'DESC')->withCount('photos')->get();
        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $album = new Album();
        return view('albums.create', ['album' => $album]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

        $valuesToSave = [
            'album_name' => request()->get('album_name'),
            'description' => request()->get('description'),
            'user_id' => 1,
        ];

        if (request()->hasFile("album_thumb")) {
            $file = request()->file('album_thumb');

            if ($file->isValid()) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs("public/" . env('ALBUM_THUMB_DIR'), $fileName);
                $valuesToSave['album_thumb'] = env('ALBUM_THUMB_DIR') . $fileName;
            }
        }

        $result = Album::create($valuesToSave);

        $msg = ($result ? "Album Aggiunto" : "Album non Aggiunto");
        session()->flash('message', $msg);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Album $album
     * @return Response
     */
    public function show(Album $album): Response
    {
        return $album->getAttribute('album_name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Album $album
     * @return Application|Factory|View|Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit', ['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $album
     * @return RedirectResponse
     */
    public function update($album): RedirectResponse
    {
        $valuesToSave = [
            'album_name' => request()->get('album_name'),
            'description' => request()->get('description'),
        ];

        if (request()->hasFile("album_thumb")) {
            $file = request()->file('album_thumb');

            if ($file->isValid()) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs("public/" . env('ALBUM_THUMB_DIR'), $fileName);
                $valuesToSave['album_thumb'] = env('ALBUM_THUMB_DIR') . $fileName;
            }
        }

        $result = Album::where('id', $album)->update($valuesToSave);

        $msg = ($result === 1 ? "Album Aggiornato" : "Album non Aggiornato");
        session()->flash('message', $msg);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     **
     * @param $album
     * @return int
     */
    public function destroy(Album $album): int
    {
        $thumbnail = $album->album_thumb;

        $res = $album->delete();

        if ($res && !empty($thumbnail) && Storage::exists("public/" . $thumbnail)){
            Storage::delete("public/" . $thumbnail);
        }

        return $res;
    }

    public function getPhotos(Album $album){

       return $images = Photo::where('album_id', $album->id)->get();

    }
}
