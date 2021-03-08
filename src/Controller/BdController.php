<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
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
    function show($id, ProduitRepository $repo){

        $produits = $repo->findby(array("auteur" => $id));
        //$couvertures = ['BD000001','BD000007','BD000013'];
        $couvertures = array();
        $dir = "images/couverture/";
        if( $dossier = opendir($dir)){
            while(($item = readdir($dossier)) !== false){
                $pos_point = strpos($item, '.');
                $item = substr($item, 0, $pos_point);
                $couvertures[] = strtoupper($item);
            }
            closedir($dossier);
        }

        return $this->render('bd/show.html.twig', [
            'produits'=> $produits,
            'couvertures' => $couvertures
        ]);
    }
}
