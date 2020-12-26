<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $fillable = ['title' , 'description'];
    public $timestamps = false;
}
