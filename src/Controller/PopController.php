<?php

namespace App\Controller;

use App\Entity\Pop;
use App\Form\PopType;
use App\Repository\PopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/pop')]
class PopController extends AbstractController
{
    #[Route('/', name: 'app_pop_index', methods: ['GET'])]
    public function index(PopRepository $popRepository): Response
    {
        return $this->render('pop/index.html.twig', [
            'pops' => $popRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pop = new Pop();
        $form = $this->createForm(PopType::class, $pop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pop);
            $entityManager->flush();

            return $this->redirectToRoute('app_pop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pop/new.html.twig', [
            'pop' => $pop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pop_show', methods: ['GET'])]
    public function show(Pop $pop): Response
    {
        return $this->render('pop/show.html.twig', [
            'pop' => $pop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pop_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pop $pop, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PopType::class, $pop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pop/edit.html.twig', [
            'pop' => $pop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pop_delete', methods: ['POST'])]
    public function delete(Request $request, Pop $pop, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pop->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pop_index', [], Response::HTTP_SEE_OTHER);
    }
}
