<?php

class LoginForm extends Form {

    function build() {
        $this->addFormField("email");
        $this->addFormField("password");
    }

}