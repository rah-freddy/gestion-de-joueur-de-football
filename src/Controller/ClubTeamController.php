<?php

namespace App\Controller;

use App\Entity\ClubTeam;
use App\Form\ClubType;
use App\Repository\ClubTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubTeamController extends AbstractController
{
    private $clubTeamRepository;
    private $em;
    public function __construct(ClubTeamRepository $clubTeamRepository, EntityManagerInterface $em)
    {
        $this->clubTeamRepository = $clubTeamRepository;
        $this->em = $em;
    }

    #[Route('/club', name: 'list_club')]
    public function listClubAction(): Response
    {
        $allClub = $this->clubTeamRepository->findAll();

        return $this->render('club_team/index.html.twig', [
            'clubs' => $allClub,
        ]);
    }

    #[Route('/delete-club/{id}', name: 'club_delete')]
    public function deleteClubAction(int $id)
    {
        $clubId = $this->clubTeamRepository->find($id);
        $this->em->remove($clubId);
        $this->em->flush();
        $this->addFlash('success', 'Equipe supprimé avec succès!');

        return $this->redirectToRoute('list_club');
    }

    #[Route('/create-club', name: 'club_create')]
    public function createClubAction(Request $request)
    {
        $club = new ClubTeam();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form['name']->getData();

            $club->setName($name);

            $this->em->persist($club);
            $this->em->flush();
            $this->addFlash('success', 'Equipe crée avec succès!');

            return $this->redirectToRoute('list_club');
        }

        return $this->render('club_team/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update-club/{id}', name: 'club_update')]
    public function updateClubAction(Request $request, int $id)
    {
        $clubId = $this->clubTeamRepository->find($id);
        $form = $this->createForm(ClubType::class, $clubId);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form['name']->getData();

            $clubId->setName($name);

            $this->em->persist($clubId);
            $this->em->flush();
            $this->addFlash('success', 'L\'équipe a été modifié avec succès!');

            return $this->redirectToRoute('list_club');
        }

        return $this->render('club_team/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
