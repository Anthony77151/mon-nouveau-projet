<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Auteur;
use App\Repository\AuteurRepository;

class BdController extends AbstractController
{
    /**
     * @Route("/bd", name="bd")
     */
    function index(): Response
    {
        return $this->render('bd/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    function home()
    {
        return $this->render('bd/home.html.twig', [
            'title' =>"Bienvenue !",
            'age' => 30
        ]);
    }

    /**
     * @Route("/auteur", name="auteur")
     */
    function auteur(AuteurRepository $repo)
    {
        $auteurs  = $repo->findAll();
        return $this->render('bd/auteur.html.twig', [
            'liste' =>"Liste des auteurs:",
            'auteurs' => $auteurs
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    function show($id, AuteurRepository $repo){

        $auteur = $repo->find($id);
        return $this->render('bd/show.html.twig', [
            'auteur'=> $auteur
        ]);
    }
}
