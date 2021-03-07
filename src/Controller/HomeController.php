<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article ; 
class HomeController extends AbstractController
{
/**
 * @Route("/" , name="home")
 */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class) ; 

        $articles = $repo->findAll() ; 
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles'=> $articles 
        ]);
    }
  /**
   * @Route("/home/add", name="ajoute_article")
   */
    public function add(Request $request, EntityManagerInterface $manager)
    {
        dump($request) ; 
        if($request->request->count() > 0)
        {
           $article = new Article() ; 
           $article->setLibelle($request->request->get('libelle'))
                    ->setImg($request->request->get('img'))
                    ->setDescription($request->request->get('description'))
                    ->setCategorie($request->request->get('categorie'))
                    ->setQuantite($request->request->get('quantite'))
                    ->setPrice($request->request->get('prix'));
                    $manager->persist($article); 
                    $manager->flush() ; 
                    return $this->redirectTORoute('home');
        }
        
        return $this->render('home/ajoute.html.twig') ; 
    }

  /**
   * @route ("/home/{id}" , name="detail_article")
   */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class) ; 

        $article = $repo->find($id) ; 
        
        return $this->render('home/Show.html.twig',[
            'article' => $article 
        ]);
    }
  


}
