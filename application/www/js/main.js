'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

// fonction pour checker l'adresse email dans le formulaire de contact
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

// fonction pour checker le format du numéro de téléphone dans le formulaire de contact
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

// fonction pour checker qu'un sujet est préseant dans le formulaire de contact
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

// fonction pour checker le nom et prénom dans le formulaire de contact
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

// fonction pour checker le message entré dans le formulaire de contact
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

// fonction de validation de formulaire de contact
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



// fonction de retour d'ajax pour masquer le projet supprimé
function onAjaxDeleteProject(projects_id){
        $('#projects_id'+projects_id).fadeOut();
}

// fonction pour supprimer le projet sélectionné en ajax
function onClickDeleteProject(event){
	event.preventDefault();

	var confirmation = confirm("Etes vous sur de vouloir supprimer ce projet?");
	if (confirmation == true) {
		$.get(this.href, "ajax", onAjaxDeleteProject);
	}
}


// fonction de retour d'ajax pour masquer l'expérience supprimée
function onAjaxDeleteExperience(experiences_id){
        $('#experiences_id'+experiences_id).fadeOut();
}

// fonction pour supprimer l'expérience sélectionnée en ajax
function onClickDeleteExperience(event){
	event.preventDefault();
	var confirmation = confirm("Etes vous sur de vouloir supprimer cette expérience?");
	if (confirmation == true) {
		$.get(this.href, "ajax", onAjaxDeleteExperience);
	}
}

// fonction de retour d'ajax pour masquer l'education supprimé
function onAjaxDeleteEducation(educations_id){
        $('#educations_id'+educations_id).fadeOut();
}

// fonction pour supprimer l'education sélectionné en ajax
function onClickDeleteEducation(event){
	event.preventDefault();
	var confirmation = confirm("Etes vous sur de vouloir supprimer cette formation?");
	if (confirmation == true) {
		$.get(this.href, "ajax", onAjaxDeleteEducation);
	}
}

// fonction de retour d'ajax pour masquer la compétence supprimée
function onAjaxDeleteCompetence(competences_id){
        $('#competences_id'+competences_id).fadeOut();
}

// fonction pour supprimer la compétence sélectionnée en ajax
function onClickDeleteCompetence(event){
	event.preventDefault();
	var confirmation = confirm("Etes vous sur de vouloir supprimer cette compétence?");
	if (confirmation == true) {
		$.get(this.href, "ajax", onAjaxDeleteCompetence);
	}
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
