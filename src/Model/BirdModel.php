<?php

namespace App\Model;

// Cette classe permet de gérer les données concernant les oiseaux
class BirdModel
{
    // cette propriété contiendra tout les oiseaux sous forme d'un tableau PHP
    private $birds;

    // j'initialise les données dans ma propriété
    public function __construct()
    {
        $this->birds = [
            [
                'name' => 'White bird',
                'description' => 'The chubby white bird drops an egg bomb when players tap the screen after launching the creature from the slingshot.',
                'image' => 'white.png',
            ],
            [
                'name' => 'Black bird',
                'description' => 'Black birds act as bombs, which explode once they\'ve landed on a target, obliterating pigs and buildings around them.',
                'image' => 'black.png',
            ],
            [
                'name' => 'Red bird',
                'description' => 'The first avian missile players encounter when they start the game, the red bird follows a simple trajectory when launched.',
                'image' => 'red.png',
            ],
            [
                'name' => 'Blue bird',
                'description' => 'The blue bird splits into three smaller versions in mid-air when the screen is tapped.',
                'image' => 'blue.png',
            ],
            [
                'name' => 'Yellow bird',
                'description' => 'Tapping the screen after launching the yellow bird gives the critter a speed boost that makes it more deadly.',
                'image' => 'yellow.png',
            ],
            [
                'name' => 'Green bird',
                'description' => 'The green bird turns into a boomerang that doubles back to strike targets in otherwise protected locations.',
                'image' => 'green.png',
            ],
            [
                'name' => 'Big red bird',
                'description' => 'The big red bird is a flying wrecking bail that causes more damage than his smaller red cousin.',
                'image' => 'red-big.png',
            ],
        ];
    }

    // cette methode me permt de recupérer l'ensemble des oiseau (le tableau complet)
    public function getBirds(): array
    {
        return $this->birds;
    }

    // cette methode me permet de recupérer uniquement les info d'un oiseau
    // pour savoir quel oiseau recupérer j'attend en parametre l'id de l'oiseau
    public function getBird(int $id)
    {
        // si l'id n'existe pas dans mon tableau je renvoi faux plutot que d'avoir un erreur plus tard
        if(!isset($this->birds[$id])) {
            return false;
        }

        // si l'id existe on renvoi le contenu du tableau pour cet oiseau
        return $this->birds[$id];
    }
}
