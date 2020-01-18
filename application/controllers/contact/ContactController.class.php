<?php
/**
 * Created by PhpStorm.
 * User: DEHEM Pierrick
 * Date: 17/01/2019
 * Time: 14:13
 * Controleur servant pour la page Contact
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class ContactController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP GET
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
         */


    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */

        // filtrage des champs récupérés depuis le formulaire de contact
        $fullName = trim($formFields['FullName']);
        $phone = trim($formFields['Phone']);
        $email = strtolower(trim($formFields['Email']));
        $subject = trim($formFields['Subject']);
        $messages = trim($formFields['Message']);


        function sendConfirmation($fullName, $phone, $email, $subject,$messages,$params) {

            $template = file_get_contents(WWW_PATH."/ConfirmationMail.phtml");
            $templateHTML = file_get_contents(WWW_PATH."/ConfirmationMail_html.phtml");

            foreach($params as $key => $value)
            {
                $template = str_replace('{{ '.$key.' }}', $value, $template);
                $templateHTML = str_replace('{{ '.$key.' }}', $value, $templateHTML);
            }
            
            
            //PHPMailer Object

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host='ssl0.ovh.net';
            $mail->Port = 465;
            $mail->Username = 'portfolio@pierrickdehem.ovh';
            $mail->Password = 'test1234';
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPSecure = 'ssl';
            //adresse de l'expéditeur
            $mail->SetFrom($email, $fullName);
            // adresse de destination
            $mail->AddAddress("portfolio@pierrickdehem.ovh", 'DEHEM Pierrick Developpement');

            // adresse expéditeur en cc
            $mail->addCC($email, $fullName);
            $mail->Subject = $subject;
            $mail->isHTML( true );
            $mail->Body = $templateHTML ;
            $mail->AltBody = $template ;
            $mail->CharSet = "UTF-8";
            $mail->addCustomHeader('MIME-version', "1.0");

            
            if(!$mail->send()){

                $flashBag = new FlashBag();
                $flashBag->add("Mail non envoyé!");
            }else {
                $flashBag = new FlashBag();
                $flashBag->add("Mail envoyé!");
                return true;
            }

        }



        try {

            if (empty($fullName) OR empty($phone) OR empty($email) OR empty($subject)OR empty($messages))
                throw new DomainException("Merci de remplir tout les champs");

            // test du champ email
            if (preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $email ) == false)
               throw new DomainException("L'adresse eMail est invalide");

            // test du champ phone
            if(preg_match ( " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# " , $phone) == false )
                throw new DomainException( "Le téléphone est invalide");

            // Envoi du mail de confirmation
            $params = [
                'fullName' => $fullName,
                'phone' => $phone,
                'email' => $email,
                'subject' => $subject,
                'messages' => $messages
            ];
            sendConfirmation($fullName, $phone, $email, $subject,$messages,$params);


        } catch (DomainException $exception) {
           // gestion des erreurs et renvoi des valeurs dans le formulaire
            $contactForm = new ContactForm();
            $contactForm->bind($formFields);
            $contactForm->setErrorMessage($exception->getMessage());
            return [
                '_form' => $contactForm
            ];
        }



    }


}