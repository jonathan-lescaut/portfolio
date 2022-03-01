<?php

namespace App\Controller;

use App\Entity\Realisation;
use App\Form\RealisationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RealisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/realisation')]
class RealisationController extends AbstractController
{
    #[Route('/', name: 'realisation_index', methods: ['GET'])]
    public function index(RealisationRepository $realisationRepository): Response
    {
        return $this->render('realisation/index.html.twig', [
            'realisations' => $realisationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'realisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imgRealisation = $form->get('image_realisation')->getData();
            if ($imgRealisation) {
            $originalFilename = pathinfo($imgRealisation->getClientOriginalName(),
            PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imgRealisation->guessExtension();

            try {
            $imgRealisation->move(
            $this->getParameter('photos_directory'),
            $newFilename
            );
            } catch (FileException $e) {}
                
            $realisation->setImageRealisation($newFilename);
        }


            $entityManager->persist($realisation);
            $entityManager->flush();

            return $this->redirectToRoute('realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('realisation/new.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'realisation_show', methods: ['GET'])]
    public function show(Realisation $realisation): Response
    {
        return $this->render('realisation/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'realisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Realisation $realisation, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgRealisation = $form->get('image_realisation')->getData();
            if ($imgRealisation) {
            $originalFilename = pathinfo($imgRealisation->getClientOriginalName(),
            PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imgRealisation->guessExtension();

            try {
            $imgRealisation->move(
            $this->getParameter('photos_directory'),
            $newFilename
            );
            } catch (FileException $e) {}
                
            $realisation->setImageRealisation($newFilename);
        }
            $entityManager->flush();

            return $this->redirectToRoute('realisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('realisation/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'realisation_delete', methods: ['POST'])]
    public function delete(Request $request, Realisation $realisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($realisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('realisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
