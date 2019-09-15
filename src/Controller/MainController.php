<?php


namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\GifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    public function index(AlbumRepository $albumRepository, GifRepository $gifRepository) {

        $latest_albums = $albumRepository->findBy([], ['id' => "DESC"], 10);
        $lastest_gifs = $gifRepository->findBy([], ['id' => "DESC"], 10);

        return $this->render('index.html.twig', [
            'latest_albums' => $latest_albums,
            'lastest_gifs' => $lastest_gifs
        ]);
    }
}
