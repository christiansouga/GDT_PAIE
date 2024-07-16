document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('btnAddInputs').addEventListener('click', function() {
      // Limiter le nombre de champs ajoutés à 4 au maximum
      var inputCount = Math.min(parseInt(document.getElementById('inputCount').value), 4);

      for (var i = 1; i <= inputCount; i++) {
          var inputHtml = '<div class="form-group">';
          inputHtml += '<input type="text" class="form-control" placeholder="Champ ' + i + '">';
          inputHtml += '</div>';

          document.getElementById('inputContainer').innerHTML += inputHtml;
      }
  });
});
