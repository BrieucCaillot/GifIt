<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function index(UserRepository $userRepository, AlbumRepository $albumRepository, Request $request)
    {
        $userId = $request->attributes->get('user');

        $user = $userRepository->find($userId);

        $user_albums = $albumRepository->findBy([
            'user_id' => $userId
        ], ['id' => "DESC"], 10);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'user_albums' => $user_albums,
        ]);
    }
}
