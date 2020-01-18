<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 17/12/2019
 * Time: 20:29
 */

class ContactForm extends Form {

    function build()
    {
        $this->addFormField("FullName");
        $this->addFormField("Phone");
        $this->addFormField("Email");
        $this->addFormField("Subject");
        $this->addFormField("Message");
    }

}