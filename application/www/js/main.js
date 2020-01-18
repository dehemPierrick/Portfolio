'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////


function checkFormsEmail(email){

    var emailRegExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var errorEmail = document.getElementById('errorEmail');

    if(emailRegExp.test(email.value)== false){
        event.preventDefault();
        errorEmail.textContent ="Veuillez renseigner un email valide comprenant un @ et un .";
        errorEmail.style.color = "red";
        email.focus();
    }else{
        errorEmail.textContent ="";
    }

}

function checkFormsTel(tel){
    //var phoneRegExp = /^\d{10}$/;
    var phoneRegExp = /^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$/;
   
    var errorTel = document.getElementById('errorTel');
    if(phoneRegExp.test(phone.value)== false){
        event.preventDefault();
        errorTel.textContent ="Veuillez un numéro de téléphone valide (exemple : 0320202020 ou 03-20-20-20-20.";
        errorTel.style.color = "red";
        tel.focus();
    }else{
        errorTel.textContent ="";
    }
}

function checkFormsSujet(sujet){

    var errorSujet = document.getElementById('errorSujet');

    if(sujet.value == ""){
        event.preventDefault();
        errorSujet.textContent ="Veuillez renseigner un sujet.";
        errorSujet.style.color = "red";
        sujet.focus();
    }else{
        errorSujet.textContent ="";
    }

}

function checkFormsFullName(fullname){
    var fullNameRegExp = /^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([-'\s][[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/;
  
    var errorFullname = document.getElementById('errorFullname');

    // si le champ fullname est vide
    if(fullname.validity.valueMissing){
        event.preventDefault();validationMessage
        errorFullname.textContent ="Veuillez saisir votre nom et prénom svp.";
        errorFullname.style.color = "red";
        fullname.focus();
    }else if(fullNameRegExp.test(fullname.value)== false){
        event.preventDefault();
        errorFullname.textContent ="Le Format est incorrect.";
        errorFullname.style.color = "red";
    }

}

function checkFormsMessage(message){
    var errorMessage = document.getElementById('errorMessage');

    if(message.value == ""){
        event.preventDefault();
        errorMessage.textContent ="Veuillez renseigner un message.";
        errorMessage.style.color = "red";
        message.focus();
    }else{
        errorMessage.textContent ="";
    }

}

function validationFormulaire(){
    var fullname = document.getElementById('fullname');
    var tel = document.getElementById('phone');
    var sujet = document.getElementById('sujet');
    var email = document.getElementById('email');
    var message = document.getElementById('message');
    checkFormsEmail(email);
    checkFormsTel(tel);
    checkFormsSujet(sujet);
    checkFormsFullName(fullname);
    checkFormsMessage(message);

}


/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function () {

    // affichage des erreurs dans les formulaires
    var errorMessage = $('.error-message');
    if (errorMessage.find('li').length > 0) {
        errorMessage.fadeIn();
    }

    // affichage du flashBag
    var notice = $('.notice');
    if (notice.find('p').length) {
        notice.delay(2345).fadeOut(3210);
    }

    var validForm = document.getElementById('btnContactSend');
    validForm.addEventListener('click', validationFormulaire);



});
