<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 19/05/2019
 * Time: 19:56
 * Controleur servant pour la page Admin Listing Expérience
 */

class ListingexperiencesController
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
        $experiencesModel = new ExperiencesModel();
        $listingExperiences = $experiencesModel->getExperiencesAll();

        // test si l'utilisateur est logué
        if(!isset($_SESSION['isLogged'])){
            $http->redirectTo('/admin');
        }

        if(array_key_exists('action',$queryFields)){
            $action = $queryFields['action'];
            switch($action){
                case 'delete':
                    $experiencesModel->removeExperiences($queryFields['id']);
                    if(array_key_exists('ajax', $queryFields)){
                        // renvoi des données à ajax et exit du script pour ne pas afficher la vue;
                        echo $queryFields['id'];
                        exit;
                    } else {
                        $http->redirectTo('/admin/listingExperiences');
                    }
                    break;

                case 'edit':
                    $id = $queryFields['id'];
                    $experienceViews =  $experiencesModel->getExperiences($id);

                    return[
                        'experienceViews'=> $experienceViews,
                        'listingExperiences' => $listingExperiences
                    ];

                    break;

                case 'view':

                    break;
            }


        }

        return [
            '_form' => new ExperiencesForm(),
            'listingExperiences' => $listingExperiences
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
        $society = trim($formFields['society']);
        $city = trim($formFields['city']);
        $content = trim($formFields['content']);
        $periode = trim($formFields['periode']);


        try {

            if (array_key_exists('add_experience', $formFields)) {
                if (empty($title)OR empty($society)OR empty($city)OR empty($periode)OR empty($content))
                    throw new DomainException("Les champs marqués d'une * sont obligatoires");

                // ajout de la nouvelle expérience dans la Bdd
                $experiencesModel = new ExperiencesModel();
                $experiencesModel->createExperiences($title,$society,$city,$content,$periode);


                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre Expérience a bien été ajouté');
            }


            if (array_key_exists('update_experience', $formFields)) {

                $experiencesModel = new ExperiencesModel();

                // filtrage des champs récupérés depuis le formulaire d'édition d'un article
                $title = trim($formFields['title']);
                $society = trim($formFields['society']);
                $city = trim($formFields['city']);
                $content = trim($formFields['content']);
                $periode = trim($formFields['periode']);
                $id = trim($formFields['id']);

                // update de la nouvelle compétence dans la Bdd
                $experiencesModel->updateExperiences($id, $title, $society, $city, $content, $periode);

                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre expérience a bien été mise à jour');


            }





        } catch (DomainException $exception) {

            // instance de la classe UserForm et utilisation de la méthode bind afin de lui injecter les valeurs du formulaire
            $experiencesForm = new ExperiencesForm();
            $experiencesForm->bind($formFields);
            $experiencesForm->setErrorMessage($exception->getMessage());
            $experiencesModel = new ExperiencesModel();
            return [
                '_form' => new ExperiencesForm(),
                'listingExperiences' => $experiencesModel->getExperiencesAll()
            ];
        }
        // redirection vers la page Admin/ListingCompetences
        $http->redirectTo('/admin/listingExperiences');

    }



}