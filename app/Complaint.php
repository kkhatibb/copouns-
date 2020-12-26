<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'name' , 'email' , 'description' , 'shop','coupon' , 'read_at'
    ];


    public function updateReadAt()
    {
        return $this->update([
            'read_at'   => now()
        ]);
    }
    public function scopeFilter($q, $search)
    {
        return $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('shop', 'like', '%' . $search . '%')
            ->orWhere('coupon', 'like', '%' . $search . '%');
    }

}
