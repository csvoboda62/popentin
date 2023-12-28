<?php

namespace App\Controller;

use App\Repository\PopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('search'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/search', name: 'search')]
    public function search(Request $request, PopRepository $repo)
    {
        $query = $request->request->all('form')['query'];

        if($query) {
            $pops = $repo->findPopBySearch($query);
        }
        return $this->render('search/index.html.twig', [
            'pops' => $pops
        ]);
    }


}
