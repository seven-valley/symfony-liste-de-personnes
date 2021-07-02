<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Repository\PersonneRepository;

use Symfony\Component\HttpFoundation\Request;
use App\Form\PersonneType;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function index(PersonneRepository $repo,Request $request,EntityManagerInterface $em ): Response
    {
      
        $personne = new Personne(); // je crée un objet à partir de l'Entity
        $form = $this->createForm(PersonneType::class, $personne); // j'associe le form
        $form->handleRequest($request); // recupere les donnes du form pour hydrater
        if ($form->isSubmitted()){
            $personne->setVenir(true);
            $em->persist($personne);
            $em->flush(); // COMMIT
           return $this->redirectToRoute('home'); 
        }

       
       
        return $this->render('main/home.html.twig', [
            'personnes' => $repo->findAll(),
            'formPersonne' => $form->createView()
        ]);
    }
    /**
     * @Route("/modify/{id}", name="personne_modify")
     */
    public function modify(Personne $p, EntityManagerInterface $em): Response
    {
        $p->setVenir(!$p->getVenir());
        $em->flush(); // COMMIT
        return $this->redirectToRoute('home'); 
        
    }
       /**
     * @Route("/delete/{id}", name="personne_delete")
     */
    public function delete(Personne $p, EntityManagerInterface $em): Response
    {
        $em->remove($p);
        $em->flush(); // COMMIT
        return $this->redirectToRoute('home'); 
        
    }
     /**
     * @Route("/edit/{id}", name="personne_edit")
     */
    public function edit(Personne $p,Request $request,EntityManagerInterface $em ): Response
    {
      
        
        $form = $this->createForm(PersonneType::class, $p); // j'associe le form
        $form->handleRequest($request); // recupere les donnes du form pour hydrater
        if ($form->isSubmitted()){
            $em->persist($p);
            $em->flush(); // COMMIT
            return $this->redirectToRoute('home'); 
        }

       
       
        return $this->render('main/edit.html.twig', [
            'formPersonne' => $form->createView()
        ]);
    }
 
}
