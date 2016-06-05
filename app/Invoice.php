<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    // povezava one to many s tabelo payment_instruments
    public function payment_instrument()
    {
       return $this->belongsTo('App\PaymentInstrument', 'payment_instrument_id');
    }

    // povezava one-to-many s tabelo companies 
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    // povezava one-to-many s tabelo items
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    
    //povezava many-to-many s tabelo files 
    public function files()
    {
        return $this->belongsToMany('App\File', 'files_invoices');
    }
    
}
