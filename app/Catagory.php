<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Catagory extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    public $translationModel = CatagoryTranslation::class;


    const FILLABLE = ['created_at'];
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

    public function scopeFilter($q , $search)
    {
        return $q->whereHas('translations' , function ($q) use ($search){
            return $q->where('name' , 'like' , '%'.$search.'%');
        });
    }
}
