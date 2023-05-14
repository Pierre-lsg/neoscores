<?php

namespace App\Controller;

use App\Entity\Rule;
use App\Form\RuleType;
use App\Repository\RuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rule')]
class RuleController extends AbstractController
{
    #[Route('/', name: 'app_rule_index', methods: ['GET'])]
    public function index(RuleRepository $ruleRepository): Response
    {
        return $this->render('rule/index.html.twig', [
            'rules' => $ruleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RuleRepository $ruleRepository): Response
    {
        $rule = new Rule();
        $form = $this->createForm(RuleType::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ruleRepository->save($rule, true);

            return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rule/new.html.twig', [
            'rule' => $rule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rule_show', methods: ['GET'])]
    public function show(Rule $rule): Response
    {
        return $this->render('rule/show.html.twig', [
            'rule' => $rule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rule $rule, RuleRepository $ruleRepository): Response
    {
        $form = $this->createForm(RuleType::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ruleRepository->save($rule, true);

            return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rule/edit.html.twig', [
            'rule' => $rule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rule_delete', methods: ['POST'])]
    public function delete(Request $request, Rule $rule, RuleRepository $ruleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rule->getId(), $request->request->get('_token'))) {
            $ruleRepository->remove($rule, true);
        }

        return $this->redirectToRoute('app_rule_index', [], Response::HTTP_SEE_OTHER);
    }
}
