<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    
    // povezava one-to-many s tabelo units
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    
    // povezava one-to-many s tabelo invoices
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
    
    // povezava many-to-many s tabelo categories 
    public function categories()
    {
         return $this->belongsToMany('App\Category', 'categories_items');
    }
}
