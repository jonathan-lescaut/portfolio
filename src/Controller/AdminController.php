<?php

namespace App\Controller;

use App\Repository\TitreRepository;
use App\Repository\ContactRepository;
use App\Repository\ParcoursRepository;
use App\Repository\CompetenceRepository;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(CompetenceRepository $competenceRepository, ContactRepository $contactRepository, ParcoursRepository $parcoursRepository, TitreRepository $titreRepository, PresentationRepository $presentationRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'competence' => $competenceRepository->findAll(),
            'contact' => $contactRepository->findAll(),
            'parcours' => $parcoursRepository->findAll(),
            'titre' => $titreRepository->findAll(),
            'presentation' => $presentationRepository->findAll(),
        ]);
    }
}
