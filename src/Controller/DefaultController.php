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
     * le name de l'annotation Route permet de "retrouver" facilement notre route (tres utile quand on voudra générer une URL vers cette route pour créer un lien HTML)
     * methode permet de limiter l'accès à cette route avec la methode GET dans cet exemple 
     * @Route("/", name="homepage", methods={"GET"})
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

    /**
     * {id} est la partie variable de ma route on pourra acceder a cette methode de controleur avec les url /bird/2 et /bird/6, etc ...
     * 
     * requirements permet de s'assurer que notre variable d'URL repond à la contrainte regex "\d+"
     * avec ca on est sur que id contiendra un nombre
     * 
     * @Route("/bird/{id}", name="bird_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function showBird(int $id)
    {
        dump($id);
        return $this->render(
            "show_bird.html.twig"
        );
    }


}