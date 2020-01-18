<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 03/06/2019
 * Time: 22:09
 * Controleur servant pour la page Admin LOGOUT
 */

class LogoutController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $userSession = new UserSession();
        $userSession->delete();

        $http->redirectTo('/admin');

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}