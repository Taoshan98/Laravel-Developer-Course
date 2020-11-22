<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Album::all();

        /* $sql = 'SELECT * FROM `albums` where 1=1';

         $where = [];
         if ($request->has('id')) {
             $where['id'] = $request->get('id');
             $sql .= " AND id=:id";
         }

         if ($request->has('album_name')) {
             $where['album_name'] = $request->get('album_name');
             $sql .= " AND album_name=:album_name";
         }*/

        $albums = DB::table('albums')->orderBy('id', 'ASC');

        if ($request->has('id')) {
            // se stiamo confrontandu una colonna e quindi utiliziamo '='
            // possiamo anche ometterlo e passare solo la colonna e il valore
            $albums->where('id', '=', $request->input('id'));
        }

        if ($request->has('album_name')) {
            $albums->where('album_name', 'like', "%" . $request->input('album_name') . "%");
        }

        return view('albums.albums', ['albums' => $albums->get()]);
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

        $resultQuery = DB::table('albums')->insert(
            [
                'album_name' => request()->get('album_name'),
                'description' => request()->get('description'),
                'user_id' => 1,
            ]
        );

        $msg = ($resultQuery ? "Album Aggiunto" : "Album non Aggiunto");
        session()->flash('message', $msg);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return $album->getAttribute('album_name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
    public function update($album)
    {
        /*$data = request()->only(['album_name', 'description']);
        $sql = "UPDATE albums set album_name = :album_name, description = :description WHERE id = :id";
        $resultQuery = DB::update($sql, [":id" => $album->getAttribute('id'), ":description" => $data['description'], ":album_name" => $data['album_name']]);*/

        $resultQuery = DB::table('albums')->where('id', $album)->update(
            [
                'album_name' => request()->get('album_name'),
                'description' => request()->get('description'),
            ]
        );

        $msg = ($resultQuery === 1 ? "Album Aggiornato" : "Album non Aggiornato");
        session()->flash('message', $msg);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     **
     * @param $album
     * @return int
     */
    public function destroy($album)
    {
        /*$sql = "DELETE FROM albums WHERE id=:id";
        return DB::delete($sql, [":id" => $album->getAttribute('id')]);
        return $album->delete();*/
        return DB::table('albums')->where('id', $album)->delete();
    }
}
