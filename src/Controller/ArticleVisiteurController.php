<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\User;
use App\Form\RechercheType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleVisiteurController
 * @package App\Controller
 * @Route("/accueil")
 */
class ArticleVisiteurController extends AbstractController
{
    /**
     * @Route("/", name="article_visiteur")
     */
    public function index(ArticlesRepository $articlesRepository, Request $request): Response
    {
        $article = new Articles();
        $user = new User();
        $utilisateur = $user->getEmail();

        $rechercheForm = $this->createForm(RechercheType::class,$article);
        $rechercheForm->handleRequest($request);


        $prix = $article->getPrixArticle();
        $cat = $article->getCategories();
        $region = $article->getRegion();


        return $this->render('article_visiteur/index.html.twig', [
            'rechercheForm'=> $rechercheForm->createView(),
            'articles' => $articlesRepository->rechercheParametre($prix,$cat,$region),

        ]);
    }
    /**
     * @Route("/detail/{slug}/{id}", name="articles_show_visteur")
     */
    public function show(Articles $article, ArticlesRepository $articlesRepository, $id): Response
    {
        $detail=$articlesRepository->find($id);
        return $this->render('article_visiteur/detail_visteurs.html.twig', [
            'article' => $detail,
        ]);
    }
}
