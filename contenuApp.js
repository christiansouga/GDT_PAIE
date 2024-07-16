

//Animation de l'icone hamburger
$(document).ready(function () {
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
       isClosed = false;
  
      trigger.click(function () {
        hamburger_cross();      
      });
  
      function hamburger_cross() {
  
        if (isClosed == true) {          
          overlay.hide();
          trigger.removeClass('is-open');
          trigger.addClass('is-closed');
          isClosed = false;
        } else {   
          overlay.show();
          trigger.removeClass('is-closed');
          trigger.addClass('is-open');
          isClosed = true;
        }
    }
    
    $('[data-toggle="offcanvas"]').click(function () {
          $('#wrapper').toggleClass('toggled');
    });  
  });

  //recharge du contenu des pages insére un employé.php et modifier ou désactiver un employé sur la page contenuApp.php 
  
  $(document).ready(function() {
    $(".reload-content").click(function(event) {
      event.preventDefault();
      var page = $(this).attr("href");
      if ($(this).attr("data-page")) {
        page = $(this).attr("data-page");
      }
      loadContent(page);
    });
  
    $("#insertionemployé").submit(function(event) {
      event.preventDefault();
      var form = $(this);
      var url = form.attr("action");
      var formData = form.serialize();
      submitForm(url, formData);
    });
  });
  
  function loadContent(page) {
    $.ajax({
      url: page,
      success: function(response) {
        $('#page-content-wrapper').html(response);
        $('#page-content-wrapper form').addClass('content-with-margin');
        $('#page-content-wrapper table').addClass('content-with-margin');
      },
      error: function() {
        console.log('Erreur lors du chargement du contenu de la page.');
      }
    });
  }
  
  function submitForm(url, formData) {
    $.ajax({
      url: "",
      method: "POST",
      data: formData,
      success: function(response) {
        loadContent('insérer un employé.php');
        loadContent('modifier ou désactiver un employé.php');
        loadContent('.php');
        
      },
      error: function() {
        console.log('Erreur lors de la soumission du formulaire.');
      }
    });
  }





  