<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'book' => [
                'name' => $this['name'],
                'isbn' => $this['isbn'],
                'authors' => $this['authors'],
                'publisher' => $this['publisher'],
                'country' => $this['country'],
                'release_date' => $this['release_date'],
                'number_of_pages' => $this['number_of_pages'],
            ]
        ];
    }
}
