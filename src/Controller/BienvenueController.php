<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Categorie;

class BienvenueController extends Controller
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
