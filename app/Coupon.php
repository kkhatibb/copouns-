<?php

namespace App;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Coupon extends Model
{
    use Translatable;

    public $translatedAttributes = ['description'];
    public $translationModel = CouponTranslation::class;


    const FILLABLE = [
        'shop_id', 'coupon', 'numberOfUsage', 'catagory_id'
    ];

    protected $fillable = self::FILLABLE;

    public function createTranslation(Request $request)
    {
        foreach (locales() as $key => $language) {
            foreach ($this->translatedAttributes as $attribute) {
                $this->{$attribute . ':' . $key} = $request->get($attribute . '_' . $key);
            }
            $this->save();
        }
        return $this;
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    public function catagory()
    {
        return $this->belongsTo(Catagory::class)->withDefault();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_users', 'coupon_id', 'user_id');
    }

    public function isUserFav()
    {
        return $this->users()->where('user_id', @auth('api')->id())->exists();
    }

    public function sliderImages()
    {
        return $this->morphMany(Image::class , 'owner');
    }
    public function scopeFilter($q, $search)
    {
        return $q->whereHas('translations', function ($q) use ($search) {
            return $q->where('description', 'like', '%' . $search . '%');
        })->orWhere('coupon', 'like', '%' . $search . '%')
            ->orWhereHas('shop', function ($q) use ($search) {
                return $q->filter($search);
            })
            ->orWhereHas('catagory', function ($q) use ($search) {
                return $q->filter($search);
            });
    }

    public function scopeFilterApi($q, $request)
    {
        if ($request->filled('search')) {
            $q->filter($request->get('search'));
        }

        if ($request->filled('shop_id')) {
            $q->where('shop_id', 'like', '%' . $request->get('shop_id') . '%');
        }

        if ($request->filled('catagory_id')) {
            $q->where('catagory_id', 'like', '%' . $request->get('catagory_id') . '%');
        }

        if ($request->filled('orderColumn')) {
            if ($request->orderColumn == 'numberOfUsage' || $request->orderColumn == 'coupon') {
                $col = $request->orderColumn;
            } else {
                $col = '"0"';
            }
            $dir = ($request->orderDir == 'asc' || $request->orderDir == 'desc') ?
                            $request->orderDir : 'desc';
            $q->orderBy($col, $dir);
        }

        return $q;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d g:i a');
    }

    public function updateNumberOfUsage()
    {
        $this->update([
            'numberOfUsage' => $this->numberOfUsage + 1
        ]);
    }

}
