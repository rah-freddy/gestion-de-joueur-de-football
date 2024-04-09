<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    private $playerRepository;
    private $em;
    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $em)
    {
        $this->playerRepository = $playerRepository;
        $this->em = $em;
    }

    #[Route('/player', name: 'list_player')]
    public function listPlayerAction(): Response
    {
        $allPlayer = $this->playerRepository->findAll();
        $allClub = $this->playerRepository->findDistinctsClub();
        $allNationalTeam = $this->playerRepository->findDistinctsNationalTeam();

        return $this->render('player/index.html.twig', [
            'players' => $allPlayer,
            'clubs' => $allClub,
            'teamNational' => $allNationalTeam,
        ]);
    }

    #[Route('/delete-player/{id}', name: 'player_delete')]
    public function deletePlayerAction(int $id)
    {
        $playerId = $this->playerRepository->find($id);
        $this->em->remove($playerId);
        $this->em->flush();
        $this->addFlash('success', 'Joueur supprimé avec succès!');

        return $this->redirectToRoute('list_player');
    }

    #[Route('/create-player', name: 'player_create')]
    public function createPlayerAction(Request $request)
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form['name']->getData();
            $birthDate = $form['birthDate']->getData();
            $nationality = $form['nationality']->getData();
            $course = $form['course']->getData();
            $goalsNumber = $form['goalsNumber']->getData();
            $clubTeam = $form['clubTeam']->getData();
            $nationalTeam = $form['nationalTeam']->getData();

            $player->setName($name);
            $player->setBirthDate($birthDate);
            $player->setNationality($nationality);
            $player->setCourse($course);
            $player->setGoalsNumber($goalsNumber);
            $player->setClubTeam($clubTeam);
            $player->setNationalTeam($nationalTeam);

            $this->em->persist($player);
            $this->em->flush();
            $this->addFlash('success', 'Joueur crée avec succès!');

            return $this->redirectToRoute('list_player');
        }

        return $this->render('player/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update-player/{id}', name: 'player_update')]
    public function updatePlayerAction(Request $request, int $id)
    {
        $playerId = $this->playerRepository->find($id);
        $form = $this->createForm(PlayerType::class, $playerId);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form['name']->getData();
            $birthDate = $form['birthDate']->getData();
            $nationality = $form['nationality']->getData();
            $course = $form['course']->getData();
            $goalsNumber = $form['goalsNumber']->getData();
            $clubTeam = $form['clubTeam']->getData();
            $nationalTeam = $form['nationalTeam']->getData();

            $playerId->setName($name);
            $playerId->setBirthDate($birthDate);
            $playerId->setNationality($nationality);
            $playerId->setCourse($course);
            $playerId->setGoalsNumber($goalsNumber);
            $playerId->setClubTeam($clubTeam);
            $playerId->setNationalTeam($nationalTeam);

            $this->em->persist($playerId);
            $this->em->flush();
            $this->addFlash('success', 'Le joueur a été modifié avec succès!');

            return $this->redirectToRoute('list_player');
        }

        return $this->render('player/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/detail-player/{id}', name: 'player_detail')]
    public function detailPlayerAction(int $id)
    {
        $player = $this->playerRepository->find($id);

        return $this->render('player/detail.html.twig', [
            'player' => $player,
        ]);
    }
}
