<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_liste")
     */
    public function listeArticles(ArticleRepository $repo)
    {
        //chercher l'ensemble des articles et on le stock
        $articles=$repo->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles //on va le donner dans twig
        ]);
    }

    /**
     * @Route("/ArticleAdmin/add", name="articles_add")
     */
    public function ajouteArticles(Request $request, ObjectManager $manager)
    {
        $article  = new Article();
        $form = $this->CreateForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($article);
            $manager->flush();
            $this->addFlash(
                "success","L'annonce <strong>{$article->getLibelle()}</strong> a bien été enregistrée !"
            );
            return $this->redirectToRoute('article_show');
        }
        return $this->render('Article/addArticle.html.twig',[
            'form'=> $form->createView()
            ]);
        }
    /**
     * @Route("/article/delete/{id}", name="article_delete")
     * @param  Article $article
     * @param ObjectManager $manager
     * @return Reponse
     */
    public function deleteArticle( ObjectManager $manager,Article $article)
    {

            $manager->remove($article);
            $manager->flush();
        
      $this->addFlash(
            'success','Votre article a été supprimé'
        );
        return $this->redirectToRoute('article_show');
  
    }

    /**
     * @Route("/ArticleAdmin", name="article_show")
     */
    public function showArticle(ArticleRepository $repo)
    {
        $articles=$repo->findAll();
        return $this->render('article/showArticle.html.twig', [
            'articles' => $articles //on va le donner dans twig
        ]);
    }



    /**
     * @Route("/article/{id}", name="article_affiche")
     */
    public function afficheArticle(Article $article)
    {
        return $this->render('article/afficheArticle.html.twig', [
            'article' => $article
        ]);
    }
    /**
     * Update article
     * 
     * @Route("/article/update/{id}", name="article_update")
     * 
     */
      public function updateArticle(Request $request, ObjectManager $manager){
        $article= new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success','Votre article a bien été modifié'
            );
            return $this->redirectToRoute('article_show');
            
        }
        return $this->render('article/updateArticle.html.twig',[
            'form'=> $form->createView()
        ]);
        }



    /**
     * @Route("/", name="menu_page")
     */
    public function Menu()
    {
        return $this->render('article/menu.html.twig');
    }
}
