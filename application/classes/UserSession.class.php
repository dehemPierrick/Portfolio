<?php

class UserSession {

    function __construct() {
        // il faut vérifier que la session n'as pas déjà été démarré
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    function create($id, $name, $role = 0) {
        // génération de la session utilisateur
        $_SESSION['user'] = ['id' => $id, 'name' => $name];
        $_SESSION['isLogged'] = true;

        $_SESSION['isAdmin'] = $role  ? true : false; // test du role = 1 si oui true sinon false

    }

    function delete() {
        // purge de la session utilisateur
        $_SESSION = [];
        session_destroy();
    }


    /*****************************************************************
     *                          ENCAPSULATIONS
     *****************************************************************/
    function isLogged() {
        if (array_key_exists('isLogged', $_SESSION))
            return $_SESSION['isLogged'];
        return false;

    }

    function isAdmin() {
        if (array_key_exists('isAdmin', $_SESSION))
            return $_SESSION['isAdmin'];
        return false;

    }

}