<?php

namespace App\Services\Books;

use App\Repository\Books\BookRepositoryInterface;

class BookService
{
    /**
     * @var BookRepositoryInterface
     */
    private $objectRepository;

    public function __construct(BookRepositoryInterface $objectRepository){
        $this->objectRepository = $objectRepository;
    }

    public function all(){
        return $this->objectRepository->all();
    }

    public function find(int $id){
        return $this->objectRepository->find($id);
    }

    public function findOrFail(int $id){
        return $this->objectRepository->findOrFail($id);
    }
}