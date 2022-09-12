<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->books(),
        ];
    }

    private function books(): \Illuminate\Support\Collection
    {
        return $this->collection->map(function ($data) {
            return [
                'name' => $data['name'],
                'isbn' => $data['isbn'],
                'authors' => $data['authors'],
                'publisher' => $data['publisher'],
                'country' => $data['country'],
                'release_date' => isset($data['released']) ? $data['released'] : $data['release_date'],
                'number_of_pages' =>  isset($data['numberOfPages']) ? $data['numberOfPages'] : $data['number_of_pages']
            ];
        });
    }
}
