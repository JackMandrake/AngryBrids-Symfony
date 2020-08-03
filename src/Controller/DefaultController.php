<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * 
     * SessionInterface est le type de l'un des services de Symfony
     * Si je "demande" (crée un parametre) de type SessionInterface
     * Alors Symfony va chercher parmis ses services si l'un d'eux est de ce type
     * Si il trouve un service (objet) de type SessionInterface, il l'envoi dans le parametre $session
     * 
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function homepage(SessionInterface $session): Response
    {
        // je crée une instance de mon model pour acceder à mes données
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();

        $lastSeenBirdId = $session->get('last_seen_bird_id');


        // je crée une reponse toute simple et je la renvoi (return)
        //return new Response("Coucou");
        
        // la methode render va interpreter ma template recupérer le contenu et le mettre dans une Response puis me la retourne
        // je n'ai plus qu'a retourner cette reponse
        return $this->render(
            "homepage.html.twig",
            [
                "birds" => $birds,
                "lastSeenBirdId" => $lastSeenBirdId 
            ]
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
    public function showBird(int $id, SessionInterface $session)
    {
        
        // je crée une instance de mon model pour acceder à mes données
        $birdModel = new BirdModel();
        $bird = $birdModel->getBird($id);

        if($bird === false) {
            // on a un pepin , l'oiseau demandé n'éxiste pas
            // on renvoi une erreur 404
            // https://symfony.com/doc/current/controller.html#managing-errors-and-404-pages
            throw $this->createNotFoundException('This bird does not exist');
        }
        // Ici j'ajoute en sessionn que je vient de consulter l'oiseau numero "$id"
        $session->set('last_seen_bird_id', $id);

        return $this->render("show_bird.html.twig", ["bird" => $bird]);
    }

    /**
     * @Route("/download-calendar", name="calendar_download")
     */
    public function downloadCalendar()
    {
        // cette methode est un raccourcis pour créer une Response qui contient le contenu du fichier fourni
        // cette reponse configure automatiquement les en-tete HTTP pour que le fichier sdoit telechargé par le navigateur
        // https://symfony.com/doc/current/controller.html#streaming-file-responses
        return $this->file('assets' . DIRECTORY_SEPARATOR .'files' . DIRECTORY_SEPARATOR .'angry_birds_2015_calendar.pdf');
    }


}