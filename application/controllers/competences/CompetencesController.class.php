<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierick
 * Date: 13/01/2019
 * Time: 18:17
 *  Controleur servant pour la page Competences
 */

class CompetencesController
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
        $competencesModel = new CompetencesModel();
        $competences = $competencesModel->getCompetencesAll();

        return [
            'competences' => $competences
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