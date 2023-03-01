<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    #[Route('/books', name: 'app_books_list', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $books = $this->bookRepository->findAll();

        return $this->json([
            'books' => array_map(fn(Book $book) => ['id' => $book->getId()], $books),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BookController.php',
        ]);
    }

    #[Route('/books', name: 'app_books_store', methods: ['POST'])]
    public function store(): JsonResponse
    {
        $book = new Book();
        $this->bookRepository->save($book, true);

        return $this->json(['id' =>$book->getId()]);
    }
}
