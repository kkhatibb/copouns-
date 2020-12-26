<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['owner_type' , 'owner_id' ,'name' , 'size' , 'path'];


    public function owner()
    {
        return $this->morphTo('owner');
    }
}
