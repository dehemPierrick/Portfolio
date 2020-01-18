<?php

/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 08/05/2019
 * Time: 10:01
 * Récupération des projets dans la Bdd
 */
class ProjectsModel
{
    function getProjectsAll(){
        $db = new Database();
        return $db->query("SELECT id, title, content, photo, periode, path, description, langages FROM PortfolioProjects ORDER BY id DESC");
    }

    function getProject($projects_id){
        $db = new Database();
        return $db->query("SELECT id, title, content, photo, periode, path, description, langages FROM PortfolioProjects WHERE id = ?", [$projects_id]);
    }

    function createProjects($title, $content, $photo, $periode,$path, $description, $langages) {
        $sql = "INSERT INTO PortfolioProjects (title, content, photo, periode,  path, description, langages) 
                VALUES (?,?,?,?,?,?,?)";
        $db = new Database();
        $db->executeSql($sql, [$title, $content, $photo, $periode,$path, $description, $langages]);
    }

    function removeProjects($projects_id){
        $db = new Database();
        $db->executeSql("DELETE FROM PortfolioProjects WHERE id=?", [$projects_id]);
    }

    function updateProjects($projects_id,$title, $content, $photo, $periode, $path, $description, $langages){
        $db = new Database();
        $sql = "UPDATE PortfolioProjects SET title = ?, content = ?, photo = ?,periode = ?, path = ?, description = ?, langages = ?
            WHERE id = ?";
        $db->executeSql($sql, [$title, $content, $photo, $periode, $path , $description, $langages ,$projects_id]);
    }


}