<?php

namespace App\Controller;

use App\Entity\Form;
use App\Repository\AttractionRepository;
use App\Repository\FormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/support')]
class FormController extends AbstractController
{

    #[Route('/', name: 'app_support_index', methods: ['GET','POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = new Form();

        $formBuilder = $this->createFormBuilder($form)
            ->add('name', TextType::class, ['label' => 'Name: ','required' => true])
            ->add('email', EmailType::class, ['label' => 'Email: ','required' => true])
            ->add('message', TextareaType::class, ['label' => 'Message: ','required' => true])
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $formBuilder->handleRequest($request);
        if ($formBuilder->isSubmitted() && $formBuilder->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $formBuilder->getData();

            // ... perform some action, such as saving the task to the database
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute("app_support_success");
        }

        return $this->render('form/index.html.twig', [
            'form' => $formBuilder->createView(),
        ]);
    }

    #[Route('/messages', name: 'app_support_view', methods: ['GET'])]
    public function show(FormRepository $formRepository): Response
    {
        $forms = $formRepository->findAll();

        return $this->render('form/messages.html.twig', [
            'forms' => $forms
        ]);
    }

    #[Route('/messages/{id}', name: 'app_support_show', methods: ['GET'])]
    public function view(Form $form): Response
    {
        return $this->render('form/message.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/form_success', name: 'app_support_success', methods: ['GET'])]
    public function success(): Response
    {
        return $this->render('form/success.html.twig');
    }
}
