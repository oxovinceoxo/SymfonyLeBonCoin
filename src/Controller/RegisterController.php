<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        //construction du  formulaire
        //instance de la class entity user
        $user = new User();

        //Creation du formulaire
        $form = $this->createForm(RegisterType::class, $user);

        //traitement de la demande
        $form->handleRequest($request);

        if($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()){
            //recuperation et encodage de mot de passe
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());

            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            //Persiter les données
            $entityManager->persist($user);
            //Enregister le valeur du formumaire
            $entityManager->flush();

            //et si ca fonctionne je retourne
            return $this->redirectToRoute('articles_index');

        }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'user' => $user,
            'registerForm' => $form->createView()
        ]);
    }
}
