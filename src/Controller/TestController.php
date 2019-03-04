<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\VueMateriel;

use Symfony\Component\HttpFoundation\JsonResponse;


class TestController extends Controller
{
    /**
    *
    * @Route("/bienvenue",name="bienvenue")
    */
    public function bienvenue()
    {
        return $this->render("bienvenue.html.twig",array("message" => "Bienvenue!"));


    }


    /**
    *
    * @Route("/listeUser",name="listeUser")
    */
    public function user()
    {

          $tabMateriel = $this->getDoctrine()->getRepository(VueMateriel::class)->findAll();

          return $this->render('AfficherListeMateriel_user.html.twig',
    		    	array(
    					"message" => "liste des Materiels",
    					"listeMateriel" => $tabMateriel
    		    	));
      }

      




    /**
    *
    * @Route("/dashboard",name="dashboard")
    */
    public function dashboard()
    {
        return $this->render("dashboard.html.twig",array("message" => "Bienvenue!"));


    }


}
