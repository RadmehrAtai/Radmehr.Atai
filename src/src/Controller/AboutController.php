<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route(path="/about",methods={"GET"})
     *
     * @return Response
     * @throws \Exception
     */
    public function index(): Response
    {
        return $this->render('about/about.html.twig',);
    }

}