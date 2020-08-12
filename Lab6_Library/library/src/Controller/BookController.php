<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="book_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('index.html.twig', [
            'books' => $bookRepository->findByExample()
        ]);
    }

    /**
     * @Route("/book/new", name="book_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setUser($this->getUser());
            $book->setUpdateAtValue();
            //image
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('image')->getData();
            if($file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                // перемещает файл в каталог
                $file->move(
                    $this->getParameter('img_directory'),
                    $fileName
                );
                $book->setImage($fileName);
            }
            $file = $form->get('file')->getData();
            if($file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                // перемещает файл в каталог
                $file->move(
                    $this->getParameter('books_directory'),
                    $fileName
                );
                $book->setFile($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'bookForm' => $form->createView(),
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() уменьшает схожесть имён файлов, сгенерированных
        // uniqid(), которые основанный на временных отметках
        return md5(uniqid());
    }


    /**
     * @Route("/book/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {
        $file = new File($this->getParameter('img_dir') . '\\' . $book->getImage());
        $book->setImage($file->getFilename());

        $file = new File($this->getParameter('books_dir') . '\\' . $book->getFile());
        $book->setFile($file->getFilename());

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'bookForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/book/{id}/read", name="book_read")
     */
    public function read(Request $request, Book $book): Response
    {
        $book->setUpdateAtValue();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();
        return $this->redirect('http://library/assets/main/uploads/books/' . $book->getFile());
    }

    /**
     * @Route("/book/{id}", name="book_delete")
     */
    public function delete(Request $request, Book $book): Response
    {
        if($book) {
            $user = $book->getUser();
            $id = $book->getId();
            $user->removeBook($book);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }
}
