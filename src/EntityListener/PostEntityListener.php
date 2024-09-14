<?php

namespace App\EntityListener;

use App\Entity\Post;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, entity: Post::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Post::class)]
class PostEntityListener
{
    public function __construct(
        private SluggerInterface $slugger
    ) {}

    public function prePersist(Post $post)
    {
        $post->computeSlug($this->slugger);
    }

    public function preUpdate(Post $post)
    {
        $post->computeSlug($this->slugger);

    }
}