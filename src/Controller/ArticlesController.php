<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\User;
use App\Form\ArticlesType;
use App\Form\RechercheType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticlesController
 * @package App\Controller
 * @Route("/articles")
 */

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles_index")
     */
    public function index(ArticlesRepository $articlesRepository, Request $request): Response
    {
        $article = new Articles();


        $rechercheForm = $this->createForm(RechercheType::class, $article);
        $rechercheForm->handleRequest($request);

        $prix = $article->getPrixArticle();
        $cat = $article->getCategories();
        $region = $article->getRegion();


        return $this->render('articles/index.html.twig', [
            'rechercheForm'=> $rechercheForm->createView(),
            //'articles' => $articlesRepository->rechercheParametre($prix,$cat,$region,$utilisateur),
            'articles' => $articlesRepository->findAll()
        ]);
    }
    /**
     * @Route("/detail/{slug}/{id}", name="articles_show")
     */
    public function show(Articles $article, ArticlesRepository $articlesRepository, $id): Response
    {
        $detail=$articlesRepository->find($id);
        return $this->render('articles/show.html.twig', [
            'article' => $detail,
        ]);
    }

    /**
     * @Route("/new", name="articles_new")
     */
    public function new(Request $request): Response
    {

        $article = new Articles();
        $user = new User();
        $article->setUser($this->getUser());

        /*$userId=$this->getUser();
        $test = $article->setUser($user);
        //dd($userId);
        */

        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photoArticle']->getData();
            if(!is_string($file)){
                $fileName=$file->getClientOriginalName();
                $file->move(
                    $this->getParameter('dossier_photos'),
                    $fileName
                );
                $article->setPhotoArticle($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="articles_delete")
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }

    /**
     * @Route("/edit/{id}", name="articles_edit")
     */
    public function edit(Request $request, Articles $article): Response
    {
        $image=$article->getPhotoArticle();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photoArticle']->getData();
            if(!is_string($file)){
                $fileName=$file->getClientOriginalName();
                $file->move(
                    $this->getParameter('dossier_photos'),
                    $fileName
                );
                $article->setPhotoArticle($fileName);
            }else{
                $article->setPhotoArticle($image);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }


}
