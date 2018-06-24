<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    protected $uploads_dir = "/images/";

    //zwraca sciezke do pliku (accessor)
    public function getFileAttribute($photo)
    {
        return $this->uploads_dir . $photo;
    }
}
