<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    protected $fillable = [
        'name' , 'email' , 'phone' , 'subject' ,'message' ,'read_at'
    ];



    public function getCreatedAtAttribute($createdAt)
    {
        return Carbon::createFromTimeString($createdAt)->format('Y-m-d');
    }

    public function updateReadAt()
    {
        return $this->update([
            'read_at'   => now()
        ]);
    }

    public function scopeFilter($q , $search)
    {
        return $q->where('email', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('subject', 'like', '%' . $search . '%')
                ->orWhere('message', 'like', '%' . $search . '%');
    }
}
