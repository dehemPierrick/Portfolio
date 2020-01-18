<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 24/03/2019
 * Time: 15:01
 * Récupération des expériences dans la Bdd
 */

class ExperiencesModel
{
    function getExperiences($experiences_id){
        $db = new Database();
        return $db->query("SELECT id, title, society, city,content, periode FROM PortfolioExperiences WHERE id = ?", [$experiences_id]);
    }

    function getExperiencesAll(){
        $db = new Database();
        return $db->query("SELECT id, title, society, city,content, periode FROM PortfolioExperiences");
    }

    function createExperiences($title, $society, $city, $content, $periode) {
        $sql = "INSERT INTO PortfolioExperiences (title, society, city,content, periode) 
                VALUES (?,?,?,?,?)";
        $db = new Database();
        $db->executeSql($sql, [$title, $society, $city, $content, $periode]);
    }

    function removeExperiences($experiences_id){
        $db = new Database();
        $db->executeSql("DELETE FROM PortfolioExperiences WHERE id=?", [$experiences_id]);
    }

    function updateExperiences($experiences_id, $title, $society, $city, $content, $periode){
        $db = new Database();
        $sql = "UPDATE PortfolioExperiences SET title = ?, society = ?, city = ?, content = ?, periode = ?
                WHERE id = ?";
        $db->executeSql($sql, [$title, $society, $city, $content, $periode ,$experiences_id]);
    }

    function viewExperiences(){
        $db = new Database();
        return $db->queryOne("SELECT id, title, society, city, content, periode FROM PortfolioExperiences WHERE id = ?", [$experiences_id]);

    }
}