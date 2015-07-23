<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> <!-- JQUERY -->
<form id="form">
    <input name="chaine" type="text" id="chaine" value="Bonjour" />
    <input type="submit" value="Envoyer" id="handle" />
</form>
 
<div id="retour">
    <i>vide</i>
</div>
<script>
jQuery(document).ready(function($){
    $('#form').submit(function(e){
        // On désactive le comportement par défaut du navigateur
        // (qui consiste à appeler la page action du formulaire)
        e.preventDefault();
         
        // On envoi la requête AJAX
        $.getJSON(
            'test_ajax.php',
            {chaine: $('#chaine').val()},
            function(data){
                $('#retour').hide();
                $('#retour').html('')
                    .append('<b>Paramètre en majuscule</b> : '+data.chaine+'<br/>')
                    .append('<b>Date</b> : '+data.date+'<br/>')
                    .append('<b>Version PHP</b> : '+data.phpversion+'<br/>');
                $('#retour').fadeIn();
            }
        );
    });
});
</script>