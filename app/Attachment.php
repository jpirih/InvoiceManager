<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';
    
    // povezava one-to-many s tabelo files
    public function files()
    {
        return $this->hasMany('App\File');
    }

}