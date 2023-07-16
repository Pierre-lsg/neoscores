<?php

namespace App\Controller;

use App\Entity\CompetitionFly;
use App\Form\CompetitionFlyType;
use App\Repository\CompetitionFlyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/competition/fly')]
class CompetitionFlyController extends AbstractController
{
    #[Route('/list', name: 'app_competition_fly_index', methods: ['GET'])]
    public function index(CompetitionFlyRepository $competitionFlyRepository): Response
    {
        return $this->render('competition_fly/index.html.twig', [
            'competition_flies' => $competitionFlyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_competition_fly_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompetitionFlyRepository $competitionFlyRepository): Response
    {
        $competitionFly = new CompetitionFly();
        $form = $this->createForm(CompetitionFlyType::class, $competitionFly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competitionFlyRepository->save($competitionFly, true);

            return $this->redirectToRoute('app_competition_fly_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('competition_fly/new.html.twig', [
            'competition_fly' => $competitionFly,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competition_fly_show', methods: ['GET'])]
    public function show(CompetitionFly $competitionFly): Response
    {
        return $this->render('competition_fly/show.html.twig', [
            'competition_fly' => $competitionFly,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competition_fly_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompetitionFly $competitionFly, CompetitionFlyRepository $competitionFlyRepository): Response
    {
        $form = $this->createForm(CompetitionFlyType::class, $competitionFly);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* dd($competitionFly); */
            $competitionFlyRepository->save($competitionFly, true);

            return $this->redirectToRoute('app_competition_fly_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('competition_fly/edit.html.twig', [
            'competition_fly' => $competitionFly,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competition_fly_delete', methods: ['POST'])]
    public function delete(Request $request, CompetitionFly $competitionFly, CompetitionFlyRepository $competitionFlyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competitionFly->getId(), $request->request->get('_token'))) {
            $competitionFlyRepository->remove($competitionFly, true);
        }

        return $this->redirectToRoute('app_competition_fly_index', [], Response::HTTP_SEE_OTHER);
    }
}
