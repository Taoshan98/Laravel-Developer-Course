<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('albums.albums', ['albums' => Album::all()]);
    }

    /**
     * Show the form for creating a new resource.
     **/
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

        $result = Album::create(
            [
                'album_name' => request()->get('album_name'),
                'description' => request()->get('description'),
                'user_id' => 1,
                'album_thumb' => '/',
            ]
        );

        $msg = ($result ? "Album Aggiunto" : "Album non Aggiunto");
        session()->flash('message', $msg);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album): \Illuminate\Http\Response
    {
        return $album->getAttribute('album_name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Album $album
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit', ['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $album
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($album): \Illuminate\Http\RedirectResponse
    {
        $valuesToSave = [
            'album_name' => request()->get('album_name'),
            'description' => request()->get('description'),
        ];

        if (request()->hasFile("album_thumb")) {
            $file = request()->file('album_thumb');
            $fileName = $album . '.' . $file->extension();
            $file->storeAs(env('IMG_DIR'), $fileName);
            $valuesToSave['album_thumb'] = $fileName;
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
    public function destroy($album): int
    {
        return Album::destroy($album);
    }
}
