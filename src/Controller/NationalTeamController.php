<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NationalTeamController extends AbstractController
{
    #[Route('/national/team', name: 'app_national_team')]
    public function index(): Response
    {
        return $this->render('national_team/index.html.twig', [
            'controller_name' => 'NationalTeamController',
        ]);
    }
}
