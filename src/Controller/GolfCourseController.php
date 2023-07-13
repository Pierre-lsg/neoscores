<?php

namespace App\Controller;

use App\Entity\GolfCourse;
use App\Entity\Target;
use App\Form\GolfCourseType;
use App\Repository\GolfCourseRepository;
use App\Repository\TargetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/golf/course')]
class GolfCourseController extends AbstractController
{
    #[Route('/', name: 'app_golf_course_index', methods: ['GET'])]
    public function index(GolfCourseRepository $golfCourseRepository): Response
    {
        return $this->render('golf_course/index.html.twig', [
            'golf_courses' => $golfCourseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_golf_course_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GolfCourseRepository $golfCourseRepository): Response
    {
        $golfCourse = new GolfCourse();
        $form = $this->createForm(GolfCourseType::class, $golfCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $golfCourse->evalGolfCourse();
            $golfCourseRepository->save($golfCourse, true);

            return $this->redirectToRoute('app_golf_course_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('golf_course/new.html.twig', [
            'golf_course' => $golfCourse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_golf_course_show', methods: ['GET'])]
    public function show(GolfCourse $golfCourse): Response
    {
        return $this->render('golf_course/show.html.twig', [
            'golf_course' => $golfCourse,
            'targets' => $golfCourse->getTargets(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_golf_course_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GolfCourse $golfCourse, GolfCourseRepository $golfCourseRepository, TargetRepository $targetRepo): Response
    {

/*         $targets = $targetRepo->findAll();
        
        foreach ($targets as $target)
        {
           $golfCourse->getTargets()->add($target);
        }
 */ 

        $form = $this->createForm(GolfCourseType::class, $golfCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $golfCourse->evalGolfCourse();
            $golfCourseRepository->save($golfCourse, true);

            return $this->redirectToRoute('app_golf_course_index', [], Response::HTTP_SEE_OTHER);
        }

//        dd($form->createView());

        return $this->render('golf_course/edit.html.twig', [
            'golf_course' => $golfCourse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_golf_course_delete', methods: ['POST'])]
    public function delete(Request $request, GolfCourse $golfCourse, GolfCourseRepository $golfCourseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$golfCourse->getId(), $request->request->get('_token'))) {
            $golfCourseRepository->remove($golfCourse, true);
        }

        return $this->redirectToRoute('app_golf_course_index', [], Response::HTTP_SEE_OTHER);
    }
}
