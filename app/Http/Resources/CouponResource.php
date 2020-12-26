<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id ,
            'shop'  => (new ShopResource($this->shop)),
            'catagory'   => (new CatagoryResource($this->catagory)),
            'slider'   => (SliderImageResource::collection($this->sliderImages)),
            'coupon'   => $this->coupon,
            'description'   => $this->description,
            'numberOfUsage'   => $this->numberOfUsage,
            'last_update'   => Carbon::parse($this->getOriginal('updated_at'))->diffForHumans(),
            'is_fav'    =>$this->isUserFav(),
        ];
    }
}
