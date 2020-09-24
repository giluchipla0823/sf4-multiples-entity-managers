<?php

namespace App\Repository\Books;

use App\Entity\Books\Book;
use App\Repository\BaseRepository;

class BookRepository extends BaseRepository implements BookRepositoryInterface {

    protected function entityClass(): string
    {
        return Book::class;
    }

    public function all(): array
    {
        return $this->objectRepository->findAll();
    }

    public function find(int $id): ?Book
    {
        return $this->objectRepository->find($id);
    }

    public function findOrFail(int $id): ?Book
    {
        if(!$model = $this->find($id)){
            throw new \Exception("No se encontró información con el id {$id}");
        }

        return $model;
    }
}