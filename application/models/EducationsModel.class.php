<?php
/**
 * User: DEHEM Pierrick
 * Date: 13/01/2019
 * Time: 18:21
 * Récupération des diplômes et formations dans la Bdd
 */

class EducationsModel
{

    function getEducationsAll(){
        $db = new Database();
        return $db->query("SELECT id, title, nameSchool, city, periode FROM PortfolioEducations");
    }

    function getEducations($educations_id){
        $db = new Database();
        return $db->query("SELECT id, title, nameSchool, city, periode FROM PortfolioEducations WHERE id = ?", [$educations_id]);
    }

    function createEducations($title, $nameSchool, $city, $periode) {
        $sql = "INSERT INTO PortfolioEducations (title, nameSchool, city, periode) 
                VALUES (?,?,?,?)";
        $db = new Database();
        $db->executeSql($sql, [$title, $nameSchool, $city, $periode]);
    }

    function removeEducation($educations_id){
        $db = new Database();
        $db->executeSql("DELETE FROM PortfolioEducations WHERE id=?", [$educations_id]);
    }


    function updateEducations($educations_id, $title, $nameSchool, $city, $periode){
        $db = new Database();
        $sql = "UPDATE PortfolioEducations SET title = ? ,nameSchool = ? , city = ?, periode = ?
                WHERE id = ?";
        $db->executeSql($sql, [$title, $nameSchool, $city, $periode,$educations_id]);
    }


    function viewEducations($educations_id){
        $db = new Database();
        return $db->queryOne("SELECT id, title, photo, path FROM PortfolioEducations WHERE id = ?", [$educations_id]);

    }
}