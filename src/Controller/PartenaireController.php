<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Partenaire ;
class PartenaireController extends AbstractController
{
 
    public function index(): Response
    {    
        $repo = $this->getDoctrine()->getRepository(Partenaire::class) ;
        $partenaires = $repo->findAll() ;
        return $this->render('partenaire/index.html.twig', [
            'controller_name' => 'PartenaireController',
            'partenaires'=> $partenaires

        ]);
    }

}
