<?php

namespace Neologicx\Photogallery\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'cover_image', 'date'];

    public function images(){
        return $this->hasMany('Neologicx\Photogallery\Models\Image', 'cat_id', 'id');
    }
    public function descimages(){
        return $this->hasMany('Neologicx\Photogallery\Models\Image', 'cat_id', 'id')->orderBy('id', 'DESC');
    }

    
}
