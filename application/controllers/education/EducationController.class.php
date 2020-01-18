<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierick
 * Date: 24/03/2019
 * Time: 14:30
 *  Controleur servant pour la page Education
 */


class EducationController
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
        $educationsModel = new EducationsModel();
        $educations = $educationsModel->getEducationsAll();

        return [
            'educations' => $educations
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