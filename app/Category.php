<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $fillable = ['title', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);//uma categoria tem muitos posts
    }

    public function getRouteKeyName()
    {
        return 'slug';//pegar a slug na url e mostrar os dados
    }
}
