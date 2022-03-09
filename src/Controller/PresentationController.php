<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


#[Route('/presentation')]
#[IsGranted("ROLE_ADMIN")]
class PresentationController extends AbstractController
{
    #[Route('/', name: 'presentation_index', methods: ['GET'])]
    public function index(PresentationRepository $presentationRepository): Response
    {
        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'presentation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $presentation = new Presentation();
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $photo = $form->get('photo_presentation')->getData();
            if ($photo) {
            $originalFilename = pathinfo($photo->getClientOriginalName(),
            PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

            try {
            $photo->move(
            $this->getParameter('photos_directory'),
            $newFilename
            );
            } catch (FileException $e) {}
                
            $presentation->setPhotoPresentation($newFilename);
        }

            $entityManager->persist($presentation);
            $entityManager->flush();

            return $this->redirectToRoute('presentation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentation/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'presentation_show', methods: ['GET'])]
    public function show(Presentation $presentation): Response
    {
        return $this->render('presentation/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    #[Route('/{id}/edit', name: 'presentation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presentation $presentation, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $photo = $form->get('photo_presentation')->getData();
            if ($photo) {
            $originalFilename = pathinfo($photo->getClientOriginalName(),
            PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

            try {
            $photo->move(
            $this->getParameter('photos_directory'),
            $newFilename
            );
            } catch (FileException $e) {}
                
            $presentation->setPhotoPresentation($newFilename);
        }
            $entityManager->flush();

            return $this->redirectToRoute('presentation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'presentation_delete', methods: ['POST'])]
    public function delete(Request $request, Presentation $presentation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presentation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($presentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presentation_index', [], Response::HTTP_SEE_OTHER);
    }
}
