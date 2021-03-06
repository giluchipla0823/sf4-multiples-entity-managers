<?php

namespace App\Controller\Api;

use App\Entity\Books\Book;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends ApiController
{
    /**
     * Lista de libros.
     *
     * @Route("/books", name="books")
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Book::class);
        $books = $repository->findBy([], [], 5);

        return $this->successResponse($books);
    }
}
