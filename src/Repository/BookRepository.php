<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    // Rechercher un livre par ref
    public function searchBookByRef(string $ref): array
    {
        return $this->createQueryBuilder('b')
                    ->andWhere('b.ref = :ref')
                    ->setParameter('ref', $ref)
                    ->getQuery()
                    ->getResult();
    }

    // Tous les livres triés par auteur
    public function booksListByAuthors(): array
    {
        return $this->createQueryBuilder('b')
                    ->join('b.author', 'a')
                    ->orderBy('a.username', 'ASC')
                    ->getQuery()
                    ->getResult();
    }
    
    public function findBooksBefore2023ByProlificAuthors(): array
{
    return $this->createQueryBuilder('b')
        ->join('b.author', 'a')                        // link with author
        ->andWhere('b.publishDate < :date')            // books before 2023
        ->andWhere('a.nbBook > :nb')                   // authors with more than 10 books
        ->setParameter('date', new \DateTime('2023-01-01'))
        ->setParameter('nb', 10)
        ->orderBy('b.publishDate', 'ASC')
        ->getQuery()
        ->getResult();
}
    public function updateCategoryScienceFictionToRomance(): int
{
    return $this->createQueryBuilder('b')
        ->update()
        ->set('b.category', ':newCategory')
        ->where('b.category = :oldCategory')
        ->setParameter('newCategory', 'Romance')
        ->setParameter('oldCategory', 'Science-Fiction')
        ->getQuery()
        ->execute(); // returns number of affected rows
}

}
