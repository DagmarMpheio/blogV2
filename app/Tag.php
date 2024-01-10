<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    protected $fillable = [
        'name', 'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class); //varios posts pertencem a varias tags
    }

    public function getRouteKeyName()
    {
        return 'slug';//pegar a slug na url e mostrar os dados
    }

}
