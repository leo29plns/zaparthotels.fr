<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app.home.index')]
    public function index(PostRepository $postRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 3;

        $posts = $postRepository->paginatePosts($page, $limit);

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'page' => $page
        ]);
    }
}
