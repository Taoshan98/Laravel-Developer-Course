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
        /*$sql = "INSERT INTO `albums` (`album_name`, `description`, user_id) VALUES (:album_name, :description, :id)";
        $resultQuery = DB::insert($sql, [':id' => 1, ":album_name" => $request->get('album_name'), ":description" => $request->get('description')]);*/

        /*$album = new Album();
        $album->album_name = request()->get('album_name');
        $album->description = request()->get('description');
        $album->user_id = 1;
        $album->album_thumb = '/';
        $result = $album->save();*/

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
        /*$data = request()->only(['album_name', 'description']);
        $sql = "UPDATE albums set album_name = :album_name, description = :description WHERE id = :id";
        $resultQuery = DB::update($sql, [":id" => $album->getAttribute('id'), ":description" => $data['description'], ":album_name" => $data['album_name']]);*/

        /*$result = Album::where('id', $album)->update(
            [
                'album_name' => request()->get('album_name'),
                'description' => request()->get('description'),
            ]
        );*/

        $albumO = Album::find($album);

        $albumO->album_name = request()->get('album_name');
        $albumO->description = request()->get('description');
        $albumO->user_id = 1;
        $albumO->album_thumb = '/';
        $result = $albumO->save();

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
        /*$sql = "DELETE FROM albums WHERE id=:id";
        return DB::delete($sql, [":id" => $album->getAttribute('id')]);
        return $album->delete();*/

        //return DB::table('albums')->where('id', $album)->delete();

        /** Meglio così */
        return  Album::destroy($album);
    }
}
