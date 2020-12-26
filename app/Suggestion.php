<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'email' , 'name' , 'coupon' , 'shop_id' , 'read_at'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

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
            ->orWhere('coupon', 'like', '%' . $search . '%')
            ->orWhereHas('shop' , function ($q) use ($search){
                return $q->filter($search);
            });
    }
}
