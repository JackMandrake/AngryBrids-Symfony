<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function api()
    {
        $birdModel = new BirdModel();
        $birds = $birdModel->getBirds();

        // la methode json de AbstractController permet d'envoyer les données fournies encodée en JSON et avec les en-tete Content-type = "application/json"
        return $this->json($birds);
    }
}
