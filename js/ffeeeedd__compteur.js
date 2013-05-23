/* == @section Ajouter un compteur de caractères au champ "Extrait" de l'administration ==================== */
  /**
   * @see Voir la fonction "ffeeeedd_compteur" dans functions.php
   */
jQuery(document).ready(function () {
  /* On crée le html du compteur et on l'affiche après le champ "Extrait" */
  jQuery( '#excerpt' ).after( '<p>Longueur de l\'extrait : <input type="text" value="0" maxlength="3" size="3" data-js="ffeeeedd__compteur" readonly> caractère(s). Nous vous recommandons de ne pas excéder 250 caractères. Soyez bref !</p>' );
  /* On insère le nombre de caractères dans le champ "Extrait" en valeur du champ du compteur */
  jQuery( '[data-js=ffeeeedd__compteur]' ).val( jQuery( '#excerpt' ).val().length );
  /* Et on incrémente la valeur à chaque fois que l'utilisateur relache une touche du clavier */
  jQuery( '#excerpt' ).keyup( function() {
    jQuery( '[data-js=ffeeeedd__compteur]' ).val(jQuery( '#excerpt' ).val().length );
  });
});