<?php

namespace App\Controller;

use App\Repository\PopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PopRepository $popRepository): Response
    {
        $pops = $popRepository->findNewPops();

        return $this->render('home.html.twig', [
            'pops' => $pops
        ]);
    }
}
