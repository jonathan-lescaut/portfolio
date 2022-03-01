<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/parcours')]
class ParcoursController extends AbstractController
{
    #[Route('/', name: 'parcours_index', methods: ['GET'])]
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('parcours/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'parcours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parcour = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parcour);
            $entityManager->flush();

            return $this->redirectToRoute('parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours/new.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'parcours_show', methods: ['GET'])]
    public function show(Parcours $parcour): Response
    {
        return $this->render('parcours/show.html.twig', [
            'parcour' => $parcour,
        ]);
    }

    #[Route('/{id}/edit', name: 'parcours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parcours $parcour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('parcours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'parcours_delete', methods: ['POST'])]
    public function delete(Request $request, Parcours $parcour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcour->getId(), $request->request->get('_token'))) {
            $entityManager->remove($parcour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parcours_index', [], Response::HTTP_SEE_OTHER);
    }
}
