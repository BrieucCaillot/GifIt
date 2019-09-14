<?php


namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    public function index(AlbumRepository $albumRepository) {

        $latest_albums = $albumRepository->findBy([], ['id' => "DESC"], 10);

        return $this->render('index.html.twig', [
            'latest_albums' => $latest_albums
        ]);
    }
}
