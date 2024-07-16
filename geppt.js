$(document).ready(function() {
    $('.hidden').each(function(index) {
      var delay = index * 300; // Définir le délai en millisecondes (par exemple, 300 pour 0,5 seconde)
      var element = $(this);
      setTimeout(function() {
        element.removeClass('hidden');
      }, delay);
    });
  });

