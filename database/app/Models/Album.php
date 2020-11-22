<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    /**
     * laravel mappa il nome della tabella in base al nome della classe Model,
     * Il nome della classe debe essere con la lettera maiuscola ma al singolare,
     * nel nostro caso "Album",
     * nel caso in cui il nome della tabella non corrisponde
     * è necessario indicarlo con la proprietaà $table della classe
     *
     * stessa cosa per la primary key $primaryKey
     */
    //protected $table = "albums";

    protected $fillable = ['album_name', "description", 'user_id', 'album_thumb'];

    public function photo(){
        return $this->hasMany( Photo::class);
    }
}
