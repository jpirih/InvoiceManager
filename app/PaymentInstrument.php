<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInstrument extends Model
{
    protected $table = 'payment_instruments';

    // povezava one-to-many s tabelo invoices 
    public function invoices()
    {
         return $this->hasMany('App\Invoice');
    }
}
