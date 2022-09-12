<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection->transform(function ($data) {
            return [
              'name' => $data['name'],
              'isbn' => $data['isbn'],
              'authors' => $data['authors'],
              'publisher' => $data['publisher'],
              'country' => $data['country'],
              'release_date' => $data['released'],
              'number_of_pages' => $data['numberOfPages'],
            ];
        });

        return [
            'data' => $collection,
        ];
    }


    public function with($request)
    {
        return [
            "status_code" => 200,
            "status" => "success",
        ];
    }
}
