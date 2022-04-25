<?php

namespace App\Controller;

use App\Entity\Attraction;
use App\Repository\AttractionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttractionController extends AbstractController
{
    /**
     * @Route(path="/attractions",methods={"GET"})
     *
     * @param AttractionRepository $attractionRepository
     * @return Response
     */
    public function index(AttractionRepository $attractionRepository): Response
    {
        $attractions = $attractionRepository->findAll();

        return $this->render('attraction/attractions.html.twig', [
            'attractions' => $attractions
        ]);
    }

    /**
     * @Route(path="/attraction/{id}",methods={"GET"})
     *
     * @param Attraction $attraction
     * @return Response
     */
    public function view(Attraction $attraction): Response
    {
        return $this->render('attraction/attraction.html.twig', [
            'attraction' => $attraction
        ]);
    }

    /**
     * @Route(path="/attractions/new")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod("POST")) {

            $name = $request->request->get("name");
            $shortDescription = $request->request->get("shortDescription");
            $fullDescription = $request->request->get("fullDescription");
            $score = $request->request->get("score");
            $createdAt = new \DateTimeImmutable('now');

            $attraction = new Attraction();
            $attraction->setName($name);
            $attraction->setShortDescription($shortDescription);
            $attraction->setFullDescription($fullDescription);
            $attraction->setScore($score);
            $attraction->setCreatedAt($createdAt);

            $entityManager->persist($attraction);
            $entityManager->flush();

        }

        return $this->render('attraction/createNewAttraction.html.twig');
    }

    /**
     * @Route(path="/attraction/{id}/edit")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Attraction $attraction, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod("POST")) {

            $name = $request->request->get("name");
            $shortDescription = $request->request->get("shortDescription");
            $fullDescription = $request->request->get("fullDescription");
            $score = $request->request->get("score");
            $updatedAt = new \DateTimeImmutable('now');

            $attraction->setName($name);
            $attraction->setShortDescription($shortDescription);
            $attraction->setFullDescription($fullDescription);
            $attraction->setScore($score);
            $attraction->setUpdatedAt($updatedAt);

            $entityManager->flush();

        }

        return $this->render('attraction/editAttraction.html.twig',
            ['attraction' => $attraction]);
    }

    /**
     * @Route(path="/attraction/{id}/delete")
     *
     * @param Attraction $attraction
     * @param AttractionRepository $attractionRepository
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Attraction $attraction, AttractionRepository $attractionRepository): Response
    {
        $attractionRepository->remove($attraction);

        return $this->redirectToRoute('/attractions');
    }

}