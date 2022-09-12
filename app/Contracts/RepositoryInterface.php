<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function delete(int $id);

    public function get(int $id): array;

    public function update(int $id, array $data): array;

    public function save(array $data): array;

    public function all(): array;
}
