Charte d'intégration
====================

@note À lire avant intervention sur le thème ffeeeedd
@author Gaël Poupard
@note Inspiré par la charte du projet Normandie
@see [Luc Poupard](http://www.kloh.fr) [@klohFR](https://twitter.com/klohFR)

La présente charte détaille l'ensemble des règles et/ou recommandations à suivre pour créer ou modifier l'ensemble des fichiers du thème : HTML, CSS, microdonnées, microformats, javascript, images… Il s'agit de règles générales applicables à l'ensemble du thème.

Généralités
-----------

* *Encodage :* Tous les fichiers doivent être encodés en UTF-8 sans BOM
* *Indentation :* Utiliser 2 espaces pour chaque niveau d'indentation.


Charte CSS
----------

* *Encodage :* Déclarer le charset ( @charset "UTF-8"; ).
* *Information :* Les fichiers doivent débuter par une introduction rédigée en suivant le format [CSSdoc](http://cssdoc.net/).
* *Sectionnement :* Scinder en sections majeures les fichier.
* *Chapitrage :* Scinder en chapitres les sections principales.
* *Sommaire :* Un sommaire doit récapituler et répertorier les sections et chapitres.
* *Commentaires :* Toutes les règles concernant les commentaires :
 * *Commentaires :* Placer systématiquement le commentaire sur la ligne au dessus du sélecteur, lorsqu'il concerne l'ensemble du groupe de règles.
 * *Commentaires :* Commenter systématiquement les valeurs arbitraires ou issues d'un calcul, afin de permettre une bonne appréhension des styles.
 * *Commentaires :* Exception lorsque le commentaire concerne une règle particulière : il est placé à la suite de la règle, en fin de ligne.
 * *Commentaires :* Le format des commentaires respectera également le format CSSDoc.
* *Sélecteurs :* Toutes les règles concernant les sélecteurs :
 * *Sélecteurs :* Un seul sélecteur par ligne.
 * *Sélecteurs :* Une déclaration par ligne au sein du bloc de règles.
 * *Sélecteurs :* Un espace après les deux-points (:) d'une règle.
 * *Sélecteurs :* Un point-virgule (;) à la fin de chaque règle.
 * *Sélecteurs :* L'accolade de fermeture (}) est placé à la ligne après la dernière règle et au même niveau d'indentation que le(s) sélecteur(s) au(x)quel(s) s'applique les déclarations.
 * *Sélecteurs :* Une ligne est sautée entre chaque bloc de règles.
 * *Sélecteurs :* Les classes et identifiants - et, de fait, les sélecteurs - doivent être écrits en minuscules. *NB :* le CamelCase est interdit.
 * *Sélecteurs composés :* Les sélecteurs seront composés suivant la [méthode BEM](http://bem.info/method/) ( documentation utile sur [CSS Wizardry](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/) ).
* *Propriétés raccourcies :* Toutes les propriétés doivent utiliser leur syntaxe raccourcie quand c'est possible.



Convention HTML
--------------

* *Indentation :* 2 espaces
* *Commentaires :* commenter la fermeture de chaque balise en HTML


 * pas de single-line dans les fichiers .lisible

 * commenter autant que possible
 * se servir du sommaire dans les fichier css
 * pour les id et class : unquement des minuscules et tirets (-).

Tous les scripts et css sont minifiés, mais accessibles via un duplicata des fichiers avec l'extension .lisible.

Modifiez les .lisible en commentant vos ajouts / modifications, puis re-minifiez les fichiers.
Pour faire vos tests, vous pouvez remplacer temporairement les fichiers minifiés par les fichiers lisibles afin de gagner du temps, mais pensez bien à les re-minifier et
les ré-enregistrer en .lisible.

*** Pour le css :
            http://www.cssdrive.com/index.php/main/csscompressor
            avec les options suivantes: Super Compact, Strip all comments
          ! Attention, cet outil n'est pas parfait : il conserve les espaces après les ":", les ";" et les "{".
                Il sera donc apprécié de faire un rechercher / remplacer global - et plusieurs fois, pour chacun de ces caractères :
                ": " devient ":"
                "; " devient ";"
                "{ " devient "{"
                "} " devient "}"
                Et voila !
*** Fin du css

*** Pour le js :
            http://jscompress.com/
*** Fin du js

Les fichiers .php sont légèrement optimisés : tous les doubles espaces ont été remplacés par des espaces simples, dans le but de minifier le code html généré.
Cela a des conséquences sur la lisibilité du code, mais tous les commentaires ( php et html ) ont été conservés.
