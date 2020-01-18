<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierick
 * Date: 24/03/2019
 * Time: 14:30
 *  Controleur servant pour la page Expériences
 */

class ExperiencesController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */

        // récupération des différentes compétences dans la bdd
        $experiencesModel = new ExperiencesModel();
        $experiences = $experiencesModel->getExperiencesAll();

        return [
            'experiences' => $experiences
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */
    }
}