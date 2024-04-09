<?php

namespace App\Controller;

use App\Entity\NationalTeam;
use App\Form\NationalTeamType;
use App\Repository\NationalTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NationalTeamController extends AbstractController
{
    private $nationalTeamRepository;
    private $em;
    public function __construct(NationalTeamRepository $nationalTeamRepository, EntityManagerInterface $em)
    {
        $this->nationalTeamRepository = $nationalTeamRepository;
        $this->em = $em;
    }

    #[Route('/national-team', name: 'list_national_team')]
    public function listNationalTeamAction(): Response
    {
        $allNationalTeam = $this->nationalTeamRepository->findAll();

        return $this->render('national_team/index.html.twig', [
            'NationalTeams' => $allNationalTeam,
        ]);
    }

    #[Route('/delete-national-team/{id}', name: 'national_team_delete')]
    public function deleteNationalTeamAction(int $id)
    {
        $nationalTeamId = $this->nationalTeamRepository->find($id);
        $this->em->remove($nationalTeamId);
        $this->em->flush();
        $this->addFlash('success', 'Equipe nationale supprimé avec succès!');

        return $this->redirectToRoute('list_national_team');
    }

    #[Route('/create-national-team', name: 'national_team_create')]
    public function createNationalTeamAction(Request $request)
    {
        $nationalTeamId = new NationalTeam();
        $form = $this->createForm(NationalTeamType::class, $nationalTeamId);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form['name']->getData();

            $nationalTeamId->setName($name);

            $this->em->persist($nationalTeamId);
            $this->em->flush();
            $this->addFlash('success', 'Equipe nationale crée avec succès!');

            return $this->redirectToRoute('list_national_team');
        }

        return $this->render('national_team/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update-national-team/{id}', name: 'national_team_update')]
    public function updateNationalTeamAction(Request $request, int $id)
    {
        $nationalTeamId = $this->nationalTeamRepository->find($id);
        $form = $this->createForm(NationalTeamType::class, $nationalTeamId);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form['name']->getData();

            $nationalTeamId->setName($name);

            $this->em->persist($nationalTeamId);
            $this->em->flush();
            $this->addFlash('success', 'L\'équipe nationale a été modifié avec succès!');

            return $this->redirectToRoute('list_national_team');
        }

        return $this->render('national_team/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
