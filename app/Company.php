<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    // povezava one-to-many s tabelo invoices 
    public function invoices()
    {
       return $this->hasMany('App\Invoice');
    }
}
