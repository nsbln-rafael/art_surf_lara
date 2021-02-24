<?php

/** @noinspection PhpMissingParamTypeInspection */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class BeerResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $baseUrl = URL::to('/') . '/images/';

        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'photo'       => $baseUrl . $this->photo,
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
