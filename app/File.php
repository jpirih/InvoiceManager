<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed attachment
 */
class File extends Model
{
    protected $table = "files";
    
    // povezava many-to-many s tabelo  invoices 
    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'files_invoices');
    }
    
    // povezava one-to-many s tabelo attachments
    public function attachment()
    {
        return $this->belongsTo('App\Attachment');
    }
    
}
