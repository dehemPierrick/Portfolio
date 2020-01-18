<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 25/05/2019
 * Time: 20:29
 */

class ProjectsForm extends Form {

    function build()
    {
        $this->addFormField("title");
        $this->addFormField("content");
        $this->addFormField("photo");
        $this->addFormField("path");
        $this->addFormField("description");
        $this->addFormField("langages");
    }

}