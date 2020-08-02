<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// Ce use permet d'utiliser l'annotation @Route dans un doc block
use Symfony\Component\Routing\Annotation\Route;

// C'est une classe Controller qui peut conteenir des methodes de controller pour plusieurs pages
// faire heriter ma classe de la clase Symfony AbstractController lui permet
// de recupérer plein de fonctionnalités qui ont été créées pour moi
class DefaultController extends AbstractController {

    // Cette fonction est une methode de controleur
    // elle doit obligatoirement renvoyer un objet de type Response
    /**
     * L'annotation Route permet de dire a symfony qu'une nouvelle route existe et qu'il faudra appeler la methode située juste en dessous
     * 
     * @Route("/")
     */
    public function homepage(): Response
    {
        // je crée une reponse toute simple et je la renvoi (return)
        //return new Response("Coucou");
        
        // la methode render va interpreter ma template recupérer le contenu et le mettre dans une Response puis me la retourne
        // je n'ai plus qu'a retourner cette reponse
        return $this->render(
            "homepage.html.twig"
        );
    }
}