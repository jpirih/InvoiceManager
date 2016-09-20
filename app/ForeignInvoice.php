<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignInvoice extends Model
{
    // table name
    protected $table = 'foreign_invoices';

    // one-to-many connection with talbe foreign companies
    public function foreignCompany()
    {
        return $this->belongsTo('App\ForeignCompany');
    }

    // one-to-many connection with table invoices
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }


}
