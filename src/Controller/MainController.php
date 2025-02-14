<?php

namespace App\Controller;

use App\Repository\TagRepository;
use App\Entity\Book;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    // / pour dire que c'est la page d'accueil
    public function index(TagRepository $tagRepo): Response
    {
        // methode pour afficher la page d'accueil
        $tags = $tagRepo->findAll();
        return $this->render('main/home.html.twig', [
            'tags' => $tags
        ]);
    }
}