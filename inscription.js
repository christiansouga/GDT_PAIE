let input = document.getElementById('monInputNIU');

input.addEventListener('input', function() {
  let value = input.value;
  if (/^[A-Za-z]\d{12}[A-Za-z]$/g.test(value)) {
    input.style.borderColor = 'green';
  } else {
    input.style.borderColor = 'red';
  }
});

let input_raison_commerciale = document.getElementById('RaisonCommerciale');

input_raison_commerciale.addEventListener('input', function() {
  let myvalue = input_raison_commerciale.value;
  
  if ((/[?,;\/\\:!{}"[\]=()<>]/g.test(myvalue))) {
    input_raison_commerciale.style.borderColor = 'red';
  } else {
    input_raison_commerciale.style.borderColor = 'green';
  }
});

let input_secteur_activité = document.getElementById('SecteurActivite');

input_secteur_activité.addEventListener('input', function() {
  let myvalue = input_secteur_activité.value;
  
  if ((/[?.;\/\\:!{}"[\]=()<>]/g.test(myvalue))) {
    input_secteur_activité.style.borderColor = 'red';
  } else {
    input_secteur_activité.style.borderColor = 'green';
  }
});







let passwordInput = document.getElementById('motDepasse');

passwordInput.addEventListener('input', function() {
    let password = passwordInput.value;
    let passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@])[A-Za-z\d@]{8,14}$/;

    if (passwordRegex.test(password)) {
        passwordInput.style.borderColor = 'green';
    } else {
        passwordInput.style.borderColor = 'red';
    }
});


let password2 = document.getElementById('confirmerLemotDepasse'); 

password2.addEventListener('input', function(){
  if (password2.value !== passwordInput.value){
    password2.style.borderColor = "red"; 
  }else {
    password2.style.borderColor = "green"; 
  }
});
