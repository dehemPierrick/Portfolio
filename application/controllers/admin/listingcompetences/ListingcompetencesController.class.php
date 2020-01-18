<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 19/05/2019
 * Time: 19:14
 * Controleur servant pour la page Admin Listing Compétences
 */

class ListingcompetencesController
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
        $competencesModel = new CompetencesModel();
        $listingCompetences = $competencesModel->getCompetencesAll();

        // test si l'utilisateur est logué
        if(!isset($_SESSION['isLogged'])){
            $http->redirectTo('/admin');
        }

        if(array_key_exists('action',$queryFields)){
            $action = $queryFields['action'];
            switch($action){
                case 'delete':
                    $competencesModel->removeCompetence($queryFields['id']);
                    if(array_key_exists('ajax', $queryFields)){
                        // renvoi des données à ajax et exit du script pour ne pas afficher la vue;
                        echo $queryFields['id'];
                        exit;
                    } else {
                        $http->redirectTo('/admin/listingCompetences');
                    }
                    break;

                case 'edit':
                    $id = $queryFields['id'];
                    $competenceViews =  $competencesModel->getCompetence($id);

                    return[
                        'competenceViews'=> $competenceViews,
                        'listingCompetences' => $listingCompetences
                    ];

                    break;

                case 'view':
                   break;
            }



        }

        return[
            '_form' => new CompetencesForm(),
            'listingCompetences' => $listingCompetences
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        // filtrage des champs récupérés depuis le formulaire d'ajout d'un article
        $title = trim($formFields['title']);

        try {
            if (array_key_exists('add_competence', $formFields)) {
                if (empty($title))
                    throw new DomainException("Les champs marqués d'une * sont obligatoires");

                // on test si le fichier est uploadable
                if ($http->hasUploadedFile('photo')) {
                    $photo = $http->moveUploadedFile('photo', '/images/');
                } else {
                    $photo = "no-photo.png";
                }
                $path = 'images';

                // ajout de la nouvelle compétence dans la Bdd
                $competencesModel = new CompetencesModel();
                $competencesModel->createCompetence($title, $photo, $path);


                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre compétence a bien été ajouté');
            }

            if (array_key_exists('update_competence', $formFields)) {

                $competencesModel = new CompetencesModel();

                // filtrage des champs récupérés depuis le formulaire d'édition d'un article
                $title = trim($formFields['title']);
                $id = trim($formFields['id']);
                $test =$competencesModel->getCompetence($id);
                // on test si le fichier est uploadable
                if ($http->hasUploadedFile('photo')) {
                    $photo = $http->moveUploadedFile('photo', '/images/');
                } else {
                    $photo= $test[0]['photo'];
                }

                $path = $test[0]['path'];

                // update de la nouvelle compétence dans la Bdd
                $competencesModel->updateCompetence($id, $title, $photo, $path);

                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre compétence a bien été mise à jour');


            }
        } catch (DomainException $exception) {

            // instance de la classe UserForm et utilisation de la méthode bind afin de lui injecter les valeurs du formulaire
            $competencesForm = new CompetencesForm();
            $competencesForm->bind($formFields);
            $competencesForm->setErrorMessage($exception->getMessage());
            $competencesModel = new CompetencesModel();
            return [
                '_form' => new CompetencesForm(),
                'listingCompetences' => $competencesModel->getCompetencesAll()
            ];
        }
        // redirection vers la page Admin/ListingCompetences
        $http->redirectTo('/admin/listingCompetences');
    }
}