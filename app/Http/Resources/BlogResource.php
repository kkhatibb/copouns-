<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title'   => $this->title,
            'description'   => strip_tags(html_entity_decode($this->description)),
            'logo'   => url('image/' . $this->image ),
            'numOfViews'   => $this->numOfViews,
            'last_update'   => Carbon::parse($this->getOriginal('updated_at'))->diffForHumans(),
        ];
    }
}
