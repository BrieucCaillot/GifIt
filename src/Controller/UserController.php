<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function index(UserRepository $userRepository, AlbumRepository $albumRepository, Request $request)
    {
        $userId = $request->attributes->get('user');

        $user = $userRepository->find($userId);

        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }
}
