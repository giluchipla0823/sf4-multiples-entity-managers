<?php

namespace App\Repository\Books;

use App\Entity\Books\Book;

interface BookRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Book;
    public function findOrFail(int $id): ?Book;
}