<?php

namespace Neologicx\Photogallery\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = ['id', 'cat_id', 'image'];

    public function category(){
        return $this->belongsTO('Neologicx\Photogallery\Models\Category','cat_id','id');
    }
}
