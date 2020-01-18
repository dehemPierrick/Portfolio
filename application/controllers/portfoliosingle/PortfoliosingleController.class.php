<?php
/**
 * Created by PhpStorm.
 * User: DEHEM-NOYON
 * Date: 07/01/2020
 * Time: 20:35
 */

class PortfoliosingleController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */

        // récupération des différents projets dans la bdd
        $projectsModel = new ProjectsModel();
        $projects = $projectsModel->getProject($queryFields['id']);

        return [
            'projects' => $projects
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