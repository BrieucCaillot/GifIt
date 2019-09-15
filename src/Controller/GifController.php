<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Entity\Gif;
use App\Form\GifAddForm;
use App\Repository\FavoriteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GifController extends AbstractController
{
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $gif = new Gif();
        $form = $this->createForm(GifAddForm::class, $gif, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($gif);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('gif/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function delete(Gif $gif,EntityManagerInterface $entityManager, FavoriteRepository $favoriteRepository, Request $request): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $gif_id = $request->attributes->get('gif');

//        $favorites = $favoriteRepository->findBy([
//            'gif' => $gif_id
//        ], ['id' => "DESC"], 10);
//
//        $entityManager->remove($favorites);

        $entityManager->find(Gif::class, $gif_id);
        $entityManager->remove($gif);
        $entityManager->flush();

        $referer = filter_var($request->headers->get('referer'), FILTER_SANITIZE_URL);

        return $this->redirect($referer);
    }

    public function favorite(FavoriteRepository $favoriteRepository, EntityManagerInterface $entityManager, Request $request)
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $gif_id = $request->attributes->get('gif');

        $fav_exists = $favoriteRepository->findBy([
            'user' => $this->getUser()->getId(),
            'gif' => $gif_id
        ]);

        if (empty($fav_exists)) {
            $gif = $entityManager->find(Gif::class, $gif_id);
            $favorite = new Favorite();
            $favorite->setUser($this->getUser());
            $favorite->setGif($gif);

            $entityManager->persist($favorite);
        } else {
            $fav = $entityManager->find(Favorite::class, $fav_exists[0]);
            $entityManager->remove($fav);
        }

        $entityManager->flush();

        $referer = filter_var($request->headers->get('referer'), FILTER_SANITIZE_URL);

        return $this->redirect($referer);
    }
}
