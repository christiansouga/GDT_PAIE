// Sélection de l'élément input de type "date"
let dateInput = document.getElementById('dateInput');

// Ajout d'un écouteur d'événement sur le changement de la date
dateInput.addEventListener('change', function() {
    // Récupération de la date saisie par l'utilisateur
    let userDate = new Date(dateInput.value);
    
    // Calcul de l'âge de l'utilisateur
    let ageDiffMs = Date.now() - userDate.getTime();
    let ageDate = new Date(ageDiffMs);
    let userAge = Math.abs(ageDate.getUTCFullYear() - 1970);

    // Vérification de l'âge et application des styles
    if (userAge < 18 || userAge > 70) {
        // Date invalide : bordure rouge et message d'erreur
        dateInput.style.border = "2px solid red";
        dateInput.setCustomValidity("L'âge doit être compris entre 18 et 70 ans.");
    } else {
        // Date valide : réinitialisation des styles et du message d'erreur
        dateInput.style.border = ""; // Réinitialisation de la bordure
        dateInput.setCustomValidity(""); // Réinitialisation du message d'erreur
    }
});


// Sélection de l'élément input
const customInput = document.getElementById('customInput');

// Ajout d'un écouteur d'événement sur la saisie
customInput.addEventListener('input', function() {
    // Expression régulière pour le format XXX-YYYYY-Z
    const regex = /^\d{10}\d$/;
    
    // Vérification de la saisie avec l'expression régulière
    if (regex.test(customInput.value)) {
        // Format valide : bordure verte et réinitialisation du message d'erreur
        customInput.style.border = "2px solid green";
        customInput.setCustomValidity("");
    } else {
        // Format invalide : bordure rouge et message d'erreur
        customInput.style.border = "2px solid red";
        customInput.setCustomValidity("Le format doit être XXXYYYYYZ (chiffres uniquement).");
    }
});