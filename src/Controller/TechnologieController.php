<?php

namespace App\Controller;

use App\Entity\Technologie;
use App\Form\TechnologieType;
use App\Repository\TechnologieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/technologie')]
class TechnologieController extends AbstractController
{
    #[Route('/', name: 'technologie_index', methods: ['GET'])]
    public function index(TechnologieRepository $technologieRepository): Response
    {
        return $this->render('technologie/index.html.twig', [
            'technologies' => $technologieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'technologie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $technologie = new Technologie();
        $form = $this->createForm(TechnologieType::class, $technologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($technologie);
            $entityManager->flush();

            return $this->redirectToRoute('technologie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('technologie/new.html.twig', [
            'technologie' => $technologie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'technologie_show', methods: ['GET'])]
    public function show(Technologie $technologie): Response
    {
        return $this->render('technologie/show.html.twig', [
            'technologie' => $technologie,
        ]);
    }

    #[Route('/{id}/edit', name: 'technologie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Technologie $technologie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TechnologieType::class, $technologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('technologie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('technologie/edit.html.twig', [
            'technologie' => $technologie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'technologie_delete', methods: ['POST'])]
    public function delete(Request $request, Technologie $technologie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technologie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($technologie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('technologie_index', [], Response::HTTP_SEE_OTHER);
    }
}
