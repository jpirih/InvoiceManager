<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignCompany extends Model
{
    // table name
    protected $table = 'foreign_companies';

    // conection one-to-many with table foreign invoices
    public function  foreignInvoices()
    {
        return $this->hasMany('App\ForeignInvoice');
    }
}
