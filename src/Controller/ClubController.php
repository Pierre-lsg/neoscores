<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/club')]
class ClubController extends AbstractController
{
    #[Route('/', name: 'app_club_index', methods: ['GET'])]
    public function index(ClubRepository $clubRepository): Response
    {
        return $this->render('club/index.html.twig', [
            'clubs' => $clubRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_club_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClubRepository $clubRepository): Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clubRepository->save($club, true);

            $this->addFlash('success', 'New club ' . $club->getName() . ' added !');

            return $this->redirectToRoute('app_club_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('club/new.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_club_show', methods: ['GET'])]
    public function show(Club $club): Response
    {
        return $this->render('club/show.html.twig', [
            'club' => $club,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_club_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Club $club, ClubRepository $clubRepository): Response
    {
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clubRepository->save($club, true);

            $this->addFlash('success', '\'' . $club->getName() . '\' updated !');

            return $this->redirectToRoute('app_club_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('club/edit.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_club_delete', methods: ['POST'])]
    public function delete(Request $request, Club $club, ClubRepository $clubRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$club->getId(), $request->request->get('_token'))) {
            $clubRepository->remove($club, true);
        }

        return $this->redirectToRoute('app_club_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/teams', name: 'app_club_teams_index', methods: ['GET'])]
    public function listTeams(ClubRepository $clubRepository, int $id): Response
    {
        return $this->render('club/index.teams.html.twig', [
            'club' => $clubRepository->find($id),
        ]);
    }

    #[Route('/{id}/members', name: 'app_club_members_index', methods: ['GET'])]
    public function listMembers(ClubRepository $clubRepository, int $id): Response
    {
        return $this->render('club/index.members.html.twig', [
            'club' => $clubRepository->find($id),
        ]);
    }
}
