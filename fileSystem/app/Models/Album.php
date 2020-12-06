<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'album_name',
        'description',
        'user_id',
        'album_thumb',
    ];

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

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function getPathAttribute()
    {
        $url = $this->album_thumb;

        if (stripos($this->album_thumb, "http") === false) {
            $url = 'storage/' . $this->album_thumb;
        }

        return $url;
    }
}
