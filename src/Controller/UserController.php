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
 * @Route("/api/users", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/top", name="top", methods={"GET"})
     */
    public function top(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $topUsers = $userRepository->findTwoByKarma($_GET['order']);
        $jsonUsersTop = $serializer->serialize($topUsers, 'json');
        return new Response($jsonUsersTop, 200, ['Content-Type' => 'application/json']);
    }
}
