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

    #[Route('/book', name: 'app_book')]
    public function index(): JsonResponse
    {
        $book = new Book();
        $this->bookRepository->save($book, true);

        $books = $this->bookRepository->findAll();

        return $this->json([
            'books' => array_map(fn(Book $book) => ['id' => $book->getId()], $books),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BookController.php',
        ]);
    }
}
