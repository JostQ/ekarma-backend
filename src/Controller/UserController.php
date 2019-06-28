<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/api", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/users/top", name="top")
     */
    public function top(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $topUsers = $userRepository->findTwoByKarma($_GET['order']);
        $jsonMovies = $serializer->serialize($topUsers, 'json');
        return new Response($jsonMovies, 200, ['Content-Type' => 'application/json']);
    }
}
