<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 08/05/2019
 * Time: 10:01
 * Récupération des compétences dans la Bdd
 */

class CompetencesModel
{
    function getCompetence($competences_id){
        $db = new Database();
        return $db->query("SELECT id, title, photo, path FROM PortfolioCompetences WHERE id = ?", [$competences_id]);
    }

    function getCompetencesAll(){
        $db = new Database();
        return $db->query("SELECT id, title, photo, path FROM PortfolioCompetences");
    }

    function createCompetence($title, $photo, $path) {
        $sql = "INSERT INTO PortfolioCompetences (title, photo, path) 
                VALUES (?,?,?)";
        $db = new Database();
        $db->executeSql($sql, [$title, $photo, $path]);
    }

    function removeCompetence($competences_id){
        $db = new Database();
        $db->executeSql("DELETE FROM PortfolioCompetences WHERE id=?", [$competences_id]);
    }

    function updateCompetence($competences_id, $title, $photo, $path){
        $db = new Database();
        $sql = "UPDATE PortfolioCompetences SET title = ?, photo = ?, path = ?
                WHERE id = ?";
        $db->executeSql($sql, [$title, $photo, $path, $competences_id]);
    }

    function viewCompetence($competences_id){
        $db = new Database();
        return $db->queryOne("SELECT id, title, photo, path FROM PortfolioCompetences WHERE id = ?", [$competences_id]);

    }
}