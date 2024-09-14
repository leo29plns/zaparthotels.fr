<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use Doctrine\ORM\EntityManager;
use App\Security\Voter\PostVoter;
use Symfony\UX\Turbo\TurboBundle;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[IsGranted(PostVoter::CREATE)]
    #[Route('/nouveau-billet', name: 'app.post.create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $post = new Post();
        $user = $this->getUser();

        $post->setUser($user);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app.post.index', ['slug' => $post->getSlug()]);
        }

        return $this->render('post/create.html.twig', [
            'form' => $form
        ]);
    }

    #[IsGranted(PostVoter::EDIT, subject: 'post')]
    #[Route('/billet/{slug:post}/editer', name: 'app.post.edit')]
    public function edit(Post $post, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app.post.index', ['slug' => $post->getSlug()]);
        }
    
        return $this->render('post/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/billet/{slug:post}', name: 'app.post.index')]
    public function index(Post $post, Request $request, CommentRepository $commentRepository, EntityManagerInterface $em): Response
    {
        $formComment = null;
        
        if ($this->getUser()) {
            $comment = new Comment();
            $comment->setUser($this->getUser());
            $comment->setPost($post);
    
            $formComment = $this->createForm(CommentType::class, $comment);
            $formComment->handleRequest($request);
    
            if ($formComment->isSubmitted() && $formComment->isValid()) {
                $em->persist($comment);
                $em->flush();
    
                $commentsPage = $request->query->getInt('page', 1);
                $limit = 10;
                $comments = $commentRepository->paginateComments($post, $commentsPage, $limit);
                $maxCommentsPage = ceil($comments->count() / $limit);

                if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
                    $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
                    
                    return $this->render('post/turbo/comments.html.twig', [
                        'formComment' => $formComment,
                        'comments' => $comments,
                        'maxCommentsPage' => $maxCommentsPage
                    ]);
                }
            }
        }
    
        $commentsPage = $request->query->getInt('page', 1);
        $limit = 10;
        $comments = $commentRepository->paginateComments($post, $commentsPage, $limit);
        $maxCommentsPage = ceil($comments->count() / $limit);
    
        return $this->render('post/index.html.twig', [
            'post' => $post,
            'formComment' => $formComment,
            'comments' => $comments,
            'maxCommentsPage' => $maxCommentsPage
        ]);
    }

    #[Route('/billets/{username?:user}', name: 'app.post.posts')]
    public function posts(?User $user, PostRepository $postRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 10;

        $posts = $postRepository->paginatePosts($page, $limit, $user);
        $maxPage = ceil($posts->count() / $limit);

        return $this->render('post/posts.html.twig', [
            'posts' => $posts,
            'page' => $page,
            'maxPage' => $maxPage
        ]);
    }
}
