<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 25/05/2019
 * Time: 20:29
 */

class EducationsForm extends Form {

    function build()
    {
        $this->addFormField("title");
        $this->addFormField("schoolName");
        $this->addFormField("city");
        $this->addFormField("periode");
    }

}