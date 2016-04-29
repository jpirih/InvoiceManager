<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    
    // povezava one-to-many s tabelo items
    public function items()
    {
        $this->hasMany('App\Item');
    }
}
