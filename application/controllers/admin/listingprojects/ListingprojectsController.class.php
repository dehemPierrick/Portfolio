<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 19/05/2019
 * Time: 21:00
 * Controleur servant pour la page Admin Listing Projects
 */

class ListingprojectsController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */

        // récupération des différents articles dans la bdd
        $projectsModel = new ProjectsModel();
        $listingProjects = $projectsModel->getProjectsAll();


        // test si l'utilisateur est logué
        if(!isset($_SESSION['isLogged'])){
            $http->redirectTo('/admin');
        }

        if(array_key_exists('action',$queryFields)){
            $action = $queryFields['action'];
            switch($action){
                case 'delete':
                    $projectsModel->removeProjects($queryFields['id']);
                    if(array_key_exists('ajax', $queryFields)){
                        // renvoi des données à ajax et exit du script pour ne pas afficher la vue;
                        echo $queryFields['id'];
                        exit;
                    } else {
                        $http->redirectTo('/admin/listingProjects');
                    }
                    break;

                case 'edit':
                    $id = $queryFields['id'];
                    $projectViews =  $projectsModel->getProject($id);

                    return[
                        'projectViews'=> $projectViews,
                        'listingProjects' => $listingProjects
                    ];

                    break;

                case 'view':
                    break;
            }
            if(array_key_exists('ajax', $queryFields)){
                // renvoi des données à ajax et exit du script pour ne pas afficher la vue;
                echo $queryFields['id'];
                exit;
            } else {
                $http->redirectTo('/admin/listingProjects');
            }
        }

        return [
            '_form' => new ExperiencesForm(),
            'listingProjects' => $listingProjects
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

        // filtrage des champs récupérés depuis le formulaire d'ajout d'un article
        $title = trim($formFields['title']);
        $content = trim($formFields['content']);
        $description = trim($formFields['description']);
        $langages = trim($formFields['langages']);
        $periode = trim($formFields['periode']);

        try {


            if (array_key_exists('add_project', $formFields)) {
                if (empty($title) OR empty($content) OR empty($description) OR empty($langages))
                    throw new DomainException("Les champs marqués d'une * sont obligatoires");

                // on test si le fichier est uploadable
                if ($http->hasUploadedFile('photo')) {
                    $photo = $http->moveUploadedFile('photo', '/images/projets/');
                } else {
                    $photo = "no-photo.png";
                }
                $path = 'images/projets';

                // ajout de la nouvelle compétence dans la Bdd
                $projectsModel = new ProjectsModel();
                $projectsModel->createProjects($title, $content, $photo, $periode, $path, $description, $langages) ;


                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre projet a bien été ajouté');
            }

            if (array_key_exists('update_project', $formFields)) {

                $projectsModel = new ProjectsModel();

                // filtrage des champs récupérés depuis le formulaire d'édition d'un article
                $title = trim($formFields['title']);
                $id = trim($formFields['id']);
                $content = trim($formFields['content']);
                $periode = trim($formFields['periode']);
                $test =$projectsModel->getProject($id);
                // on test si le fichier est uploadable
                if ($http->hasUploadedFile('photo')) {
                    $photo = $http->moveUploadedFile('photo', '/images/');
                } else {
                    $photo= $test[0]['photo'];
                }

                $path = $test[0]['path'];

                // update de la nouvelle compétence dans la Bdd
                $projectsModel->updateProjects($id, $title, $content, $photo, $periode, $path, $description, $langages);

                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre projet a bien été mise à jour');


            }


        } catch (DomainException $exception) {

            // instance de la classe UserForm et utilisation de la méthode bind afin de lui injecter les valeurs du formulaire
            $projectsForm = new ProjectsForm();
            $projectsForm->bind($formFields);
            $projectsForm->setErrorMessage($exception->getMessage());
            $projectsModel = new ProjectsModel();
            return [
                '_form' => new ExperiencesForm(),
                'listingProjects' => $projectsModel->getProjectsAll()
            ];
        }
        // redirection vers la page Admin/ListingCompetences
        $http->redirectTo('/admin/listingProjects');

    }
}