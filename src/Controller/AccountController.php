<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account', methods: ['GET', 'POST'])]
    public function index(Request $request, UserRepository $ur, UserPasswordHasherInterface $passwordHasher): Response
    {
//        $user = new User();
        $user =  $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($user);
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPlainPassword()));
            $user->eraseCredentials();
            $ur->save($user, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('account/index.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
