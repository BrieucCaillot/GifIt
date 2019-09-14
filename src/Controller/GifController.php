<?php

namespace App\Controller;

use App\Entity\Gif;
use App\Form\GifAddForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GifController extends AbstractController
{
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gif = new Gif();
        $form = $this->createForm(GifAddForm::class, $gif, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $album = $request->attributes->get('album');

            $entityManager->persist($gif);
            $entityManager->flush();

            return $this->redirectToRoute('app_album_show', ['album' => $album]);
        }

        return $this->render('gif/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
