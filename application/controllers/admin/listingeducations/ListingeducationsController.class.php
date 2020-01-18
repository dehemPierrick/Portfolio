<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 19/05/2019
 * Time: 20:14
 * Controleur servant pour la page Admin Listing Education
 */

class ListingeducationsController
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
        $educationsModel = new EducationsModel();
        $listingEducations = $educationsModel->getEducationsAll();

        // test si l'utilisateur est logué
        if(!isset($_SESSION['isLogged'])){
            $http->redirectTo('/admin');
        }

        if(array_key_exists('action',$queryFields)){
            $action = $queryFields['action'];
            switch($action){
                case 'delete':
                    $educationsModel->removeEducation($queryFields['id']);
                    if(array_key_exists('ajax', $queryFields)){
                        // renvoi des données à ajax et exit du script pour ne pas afficher la vue;
                        echo $queryFields['id'];
                        exit;
                    } else {
                        $http->redirectTo('/admin/listingEducations');
                    }
                    break;


                case 'edit':
                    $id = $queryFields['id'];
                    $educationViews =  $educationsModel->getEducations($id);

                    return[
                        'educationViews'=> $educationViews,
                        'listingEducations' => $listingEducations
                    ];

                case 'view':
                   break;
            }
            if(array_key_exists('ajax', $queryFields)){
                // renvoi des données à ajax et exit du script pour ne pas afficher la vue;
                echo $queryFields['id'];
                exit;
            } else {
                $http->redirectTo('/admin/listingEducations');
            }
        }


        return[
            '_form' => new EducationsForm(),
            'listingEducations' => $listingEducations
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
        $schoolName = trim($formFields['schoolName']);
        $city = trim($formFields['city']);
        $periode = trim($formFields['periode']);

        try {


            if (array_key_exists('add_education', $formFields)) {
                if (empty($title)OR empty($schoolName)OR empty($city)OR empty($periode))
                    throw new DomainException("Les champs marqués d'une * sont obligatoires");

                // ajout de la nouvelle formation dans la Bdd
                $educationsModel = new EducationsModel();
                $educationsModel->createEducations($title,$schoolName, $city, $periode);


                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre Formation a bien été ajouté');
            }

            if (array_key_exists('update_education', $formFields)) {

                $educationsModel = new EducationsModel();

                // filtrage des champs récupérés depuis le formulaire d'édition d'un article
                $title = trim($formFields['title']);
                $nameSchool = trim($formFields['schoolName']);
                $city = trim($formFields['city']);
                $periode = trim($formFields['periode']);
                $id = trim($formFields['id']);

                // update de la nouvelle formation dans la Bdd
                $educationsModel->updateEducations($id, $title, $nameSchool, $city, $periode);

                // création du message de confirmation
                $flashbag = new FlashBag();
                $flashbag->add('Votre compétence a bien été mise à jour');


            }


        } catch (DomainException $exception) {

            // instance de la classe UserForm et utilisation de la méthode bind afin de lui injecter les valeurs du formulaire
            $educationsForm = new EducationsForm();
            $educationsForm->bind($formFields);
            $educationsForm->setErrorMessage($exception->getMessage());
            $educationsModel = new EducationsModel();
            return [
                '_form' => new EducationsForm(),
                'listingEducations' => $educationsModel->getEducationsAll()
            ];
        }
        // redirection vers la page Admin/ListingCompetences
        $http->redirectTo('/admin/listingEducations');
    }

}