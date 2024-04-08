<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubTeamController extends AbstractController
{
    #[Route('/club/team', name: 'app_club_team')]
    public function index(): Response
    {
        return $this->render('club_team/index.html.twig', [
            'controller_name' => 'ClubTeamController',
        ]);
    }
}
