<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/about')]
class AboutController extends AbstractController
{

    #[Route('/', name: 'app_about_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('about/about.html.twig',);
    }

}