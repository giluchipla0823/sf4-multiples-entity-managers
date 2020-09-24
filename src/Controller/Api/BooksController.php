<?php

namespace App\Controller\Api;

use App\Services\Books\BookService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends ApiController
{

    /**
     * @var BookService
     */
    private $bookService;

    public function __construct(BookService $bookService){
        $this->bookService = $bookService;
    }

    /**
     * Lista de libros.
     *
     * @Route("/books", name="books")
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = $this->bookService->all();

        return $this->successResponse($books);
    }

    /**
     * Lista de libros.
     *
     * @Route("/books/{id}", name="books-show")
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $book = $this->bookService->findOrFail($id);

        return $this->successResponse($book);
    }
}
