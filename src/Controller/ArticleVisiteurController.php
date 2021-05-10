<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Regions;
use App\Entity\User;
use App\Form\RechercheType;
use App\Repository\ArticlesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $prixMin = '';
        $prixMax = '';
        $cat = $article->getCategories();
        $region = $article->getRegion();
        $recherche = ['test'=>'test du form'];

        $rechercheForm = $this->createFormBuilder($recherche)
            ->add('categories',EntityType::class,[
                'class'=> Categories::class,
                'choice_label'=>'nomCategorie',
                'required'=> false
            ])

            ->add('region', EntityType::class,[
                'class' => Regions::class,
                'choice_label' => 'nomRegion',
                'required' => false

            ])
            ->add('prixMin', NumberType::class,[
                'label'=>'prix min',
                'required'=> false,

            ])
            ->add('prixMax', NumberType::class,[
                'label'=>'prix max',
                'required'=> false,

            ])

            ->add('recherche',SubmitType::class,[
                'label'=> 'recherche'
            ])
        ->getForm();

        $rechercheForm->handleRequest($request);

        if($request->isMethod('POST') && $rechercheForm->isValid()){
            $data = $rechercheForm->getData();
            //dd($data);
            $prixMin = $data['prixMin'];
            $prixMax = $data['prixMax'];
            $cat = $data['categories'];
            $region = $data['region'];
        }




        return $this->render('article_visiteur/index.html.twig', [
            'rechercheForm'=> $rechercheForm->createView(),
            'articles' => $articlesRepository->rechercheParametre($prixMin,$prixMax,$cat,$region),

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
