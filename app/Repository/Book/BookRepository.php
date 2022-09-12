<?php

namespace App\Repository\Book;

use App\Contracts\RepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BookRepository implements RepositoryInterface
{

    public function __construct(public Book $book)
    {
        //
    }

    /**
     * @throws \Exception
     */
    public function delete(int $id)
    {
       $find = $this->book->findOrFail($id);
       $data = $find;

       $find->delete();

       return $data;
    }

    /**
     * @throws \Exception
     */
    public function get(int $id): array
    {
        return $this->book->findOrFail($id)->toArray();
    }

    public function update(int $id, array $data): array
    {
        $find = $this->book->findOrFail($id);
        $find->update($data);

        return $find->toArray();
    }

    public function save(array $data): array
    {
        return $this->book->query()->create($data)->toArray();
    }


    public function all(): array
    {
        return $this->book->all()->toArray();
    }
}
