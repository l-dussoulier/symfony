<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Categorie;

class TestControllerLouis extends Controller
{
    /**
    *
    *
    * @Route("/test1",name="test1")
    */

    public function test1()
    {
        $tabLister = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('CategorieTest.html.twig',
  		    	array(
  					"message" => "Liste Categorie",
  					"listeJoueurs" => $tabLister
  		    	));
    }
}
