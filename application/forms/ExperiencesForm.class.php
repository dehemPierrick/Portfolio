<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 25/05/2019
 * Time: 20:29
 */

class ExperiencesForm extends Form {

    function build()
    {
        $this->addFormField("title");
        $this->addFormField("society");
        $this->addFormField("city");
        $this->addFormField("content");
        $this->addFormField("periode");
    }

}