<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 17/01/2019
 * Time: 17:10
 * Controleur servant pour la page Admin Home
 */

class AdminController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        return [
            '_form' => new LoginForm()
        ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        try {
            $userModel = new UsersModel();

            $email = trim($formFields['email']);
            $password = $formFields['password'];
            if (empty($email) OR empty($password))
                throw new DomainException('Veuillez remplir tous les champs');


            // test du login
            $user = $userModel->login($email, $password);

            // création de la session utilisateur
            $userSession = new UserSession();
            $userSession->create($user['id'], $user['name'], $user['role']);

            // création du message de confirmation
            $flashbag = new FlashBag();
            $flashbag->add('Vous êtes connecté');

        } catch (DomainException $exception) {
            // gestion des erreurs et renvoi des valeurs dans le formulaire
            $loginForm = new LoginForm();
            $loginForm->bind($formFields);
            $loginForm->setErrorMessage($exception->getMessage());

            return [
                '_form' => $loginForm
            ];
        }

        // redirection vers la page d'accueil
        $http->redirectTo('/admin/listingCompetences');


    }






}