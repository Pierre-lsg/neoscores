<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Form\CompetitionType;
use App\Repository\CompetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/competition')]
class CompetitionController extends AbstractController
{
    #[Route('/', name: 'app_competition_index', methods: ['GET'])]
    public function index(CompetitionRepository $competitionRepository): Response
    {
        return $this->render('competition/index.html.twig', [
            'competitions' => $competitionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_competition_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompetitionRepository $competitionRepository): Response
    {
        $competition = new Competition();
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competitionRepository->save($competition, true);

            $this->addFlash('success', 'New competition ' . $competition->getName() . ' added !');

            return $this->redirectToRoute('app_competition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competition/new.html.twig', [
            'competition' => $competition,
            'mode' => 'Competition',
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competition_show', methods: ['GET'])]
    public function show(Competition $competition): Response
    {
        return $this->render('competition/show.html.twig', [
            'competition' => $competition,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competition $competition, CompetitionRepository $competitionRepository): Response
    {
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competitionRepository->save($competition, true);

            $this->addFlash('success', '\'' . $competition->getName() . '\' updated !');

            return $this->redirectToRoute('app_competition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competition/edit.html.twig', [
            'competition' => $competition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competition_delete', methods: ['POST'])]
    public function delete(Request $request, Competition $competition, CompetitionRepository $competitionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competition->getId(), $request->request->get('_token'))) {
            $competitionRepository->remove($competition, true);
        }

        return $this->redirectToRoute('app_competition_index', [], Response::HTTP_SEE_OTHER);
    }
}
