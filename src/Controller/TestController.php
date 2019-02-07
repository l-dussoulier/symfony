<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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


}
