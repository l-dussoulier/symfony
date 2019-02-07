<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Emprunt;
use App\Entity\Emprunteur;

class TestEmpruntFin extends Controller
{
    /**
    *
    * @Route("/EmpruntFin",name="EmpruntFin")
    */


    public function EmpruntFin()
    {
        $em=$this->getDoctrine()->getManager();
        $emprunteur = $em->getRepository('DatabaseBundle:Emprunteur');
        $emprunt = $em->getRepository('DatabaseBundle:Emprunt');




        $query = $em->createQuery('SELECT  p.Nom, emprunt.DatePret
                                   FROM EnexgirDatabaseBundle:emprunteur e
                                   INNER JOIN  EnexgirDatabaseBundle:emprunt  WITH e.idEmprunteur = emprunt.idEmprunt
                                   ');

        //variable qui récupère la requête
        $emprunteur = $query->getResult();

        //vue correspondante à la visualisation de la situation des parcs affichant la requête
        return $this->render('affichageEmpruntFin.html.twig', array('test' => $emprunteur ));
    }

}
