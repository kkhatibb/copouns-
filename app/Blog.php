<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Blog extends Model
{
    use Translatable;

    const FILLABLE = ['image', 'numOfViews', 'visible'];
    public $translatedAttributes = ['title', 'description'];
    public $translationModel = BlogTranslation::class;

    protected $fillable = self::FILLABLE;

    protected $with = ['translations'];

    public function createTranslation(Request $request)
    {
        foreach (locales() as $key => $language) {
            foreach ($this->translatedAttributes as $attribute) {
                if ($request->get($attribute . '_' . $key) != null && !empty($request->$attribute . $key)) {
                    $this->{$attribute . ':' . $key} = $request->get($attribute . '_' . $key);
                }
            }
            $this->save();
        }
        return $this;
    }



    public function scopeFilter($q, $search)
    {
        return $q->whereHas('translations', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
    }


    public function scopeVisible($query, $type)
    {
        return $query->where('visible', $type);
    }

}
