<?php

namespace App\Controller;


use App\Services\WeatherService;
use App\Repository\TitreRepository;
use App\Repository\ContactRepository;
use App\Repository\ParcoursRepository;
use App\Repository\CompetenceRepository;
use App\Repository\PresentationRepository;
use App\Repository\RealisationRepository;
use App\Repository\TechnologieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(WeatherService $weatherService, CompetenceRepository $competenceRepository, ContactRepository $contactRepository, ParcoursRepository $parcoursRepository, TitreRepository $titreRepository, PresentationRepository $presentationRepository, RealisationRepository $realisationRepository, TechnologieRepository $technologieRepository): Response
    {
        
        return $this->render('home/index.html.twig', [
            'weather' => $weatherService->api(),
            'controller_name' => 'HomeController',
            'competence' => $competenceRepository->findAll(),
            'contact' => $contactRepository->findAll(),
            'parcours' => $parcoursRepository->findAll(),
            'titre' => $titreRepository->findAll(),
            'presentation' => $presentationRepository->findAll(),
            'realisation' => $realisationRepository->findAll(),
            'technologie' => $technologieRepository->findAll(),
        ]);
    }



        




}