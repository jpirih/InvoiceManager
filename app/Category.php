<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    // povezava many-to-many s tabelo items 
    public function items()
    {
        return $this->belongsToMany('App\Item', 'categories_items');
    }
}
