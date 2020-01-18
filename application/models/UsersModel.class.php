<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 08/05/2019
 * Time: 14:55
 * Récupération des données de la table users dans la Bdd
 */

class UsersModel
{
    // fonction pour récupérer les données de l'utilisateur en fonction de l'id
    function getUser($id) {
        $db = new Database();
        $sql = "SELECT id, name, password, role, email, birthday FROM PortfolioUsers WHERE id = ?";
        $user = $db->queryOne($sql, [$id]);
        return $user;
    }

    // fonction pour calculer l'âge à partir de la date de naissance jj/mm/aaaa
    function Age($date)
    {
        //On déclare les dates à comparer
        $dateNais = new DateTime($date);
        $dateJour = new DateTime();

        //On calcule la différence
        $difference = $dateNais->diff($dateJour);

        //On retourne la différence en années
        return $difference->format('%Y');

    }

    // fonction pour loguer l'utilisateur
    function login($email, $password) {
        $sql = "SELECT id, name, password, role FROM PortfolioUsers WHERE email = ?";
        $db = new Database();
        $user = $db->queryOne($sql, [$email]);

        // si l'email à été trouvé dans la base ou que le mot de passe est différent
        if (!$user OR !$this->verifyPassword($password, $user['password']))
            throw new DomainException('Mauvais login ou mot de passe');

        return $user;
    }

    // fonction pour comparer le mot de passe entré et le mot de passe de la bdd associé à l'utilisateur
    private function verifyPassword($password, $hashedPassword) {
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

    // retourne l'email de l'utilisateur sélectionné
    function getEmail($id) {
        $user = $this->getUser($id);
        return $user['email'];
    }


    // retourne le nom de l'utilisateur en fonction du mail
    function getUserByEmail($email) {
        $db = new Database();
        $sql = "SELECT id, name FROM PortfolioUsers WHERE email = ?";
        $user = $db->queryOne($sql, [$email]);
        return $user;
    }

    // retourne l'âge de l'utilisateur sélectionné
    function getAge($id) {
        $user = $this->getUser($id);
        return $user['birthday'];
    }


}