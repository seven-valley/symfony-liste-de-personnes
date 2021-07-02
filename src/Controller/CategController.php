<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categ;
use App\Form\CategType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategController extends AbstractController
{
    /**
     * @Route("/categ", name="categ_liste")
     */
    public function liste(CategRepository $repo,Request $request,EntityManagerInterface $em): Response
    {
        $categ = new categ();
        $form = $this->createForm(CategType::class, $categ);
        $form->handleRequest($request); // recupere les donnes du form pour hydrater
        if ($form->isSubmitted()){
            $em->persist($categ);
            $em->flush(); // COMMIT
            return $this->redirectToRoute('categ_liste'); 
        }

        return $this->render('categ/liste.html.twig', [
            'formCateg'=> $form->createView(),
            'categs' => $repo->findAll(),
        ]);
    }
     /**
     * @Route("categ/edit/{id}", name="categ_edit")
     */
    public function edit(Categ $categ,Request $request,EntityManagerInterface $em ): Response
    {
      
        
        $form = $this->createForm(CategType::class, $categ); // j'associe le form
        $form->handleRequest($request); // recupere les donnes du form pour hydrater
        if ($form->isSubmitted()){
            $em->persist($categ);
            $em->flush(); // COMMIT
            return $this->redirectToRoute('categ_liste'); 
        }

       
       
        return $this->render('categ/edit.html.twig', [
            'formCateg' => $form->createView()
        ]);
    }
}
