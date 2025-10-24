<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/books', name: 'book_list')]
    public function listBooks(BookRepository $repo, Request $request): Response
    {
        $ref = $request->query->get('ref'); // valeur du champ "ref"

        $books = $ref ? $repo->searchBookByRef($ref) : $repo->findAll();

        return $this->render('book/list.html.twig', [
            'books' => $books,
            'ref' => $ref,
        ]);
    }

    #[Route('/books/by-author', name: 'book_list_by_author')]
    public function listByAuthor(BookRepository $repo): Response
    {
        $books = $repo->booksListByAuthors(); // tous les livres triés par auteur

        return $this->render('book/list.html.twig', [
            'books' => $books,
            'ref' => null,
        ]);
    }
   #[Route('/books/special', name: 'book_special_list')]
public function specialBooks(BookRepository $repo): Response
{
    $books = $repo->findBooksBefore2023ByProlificAuthors();

    return $this->render('book/list.html.twig', [
        'books' => $books,
    ]);
}    
    
    #[Route('/books/update-category', name: 'book_update_category')]
public function updateCategory(EntityManagerInterface $em, BookRepository $repo): Response
{
    // Get all books with category 'Science-Fiction'
    $books = $repo->findBy(['category' => 'Science-Fiction']);

    foreach ($books as $book) {
        $book->setCategory('Romance'); // change category
    }

    $em->flush(); // save changes

    // Redirect back to book list
    return $this->redirectToRoute('book_list');
}






}
