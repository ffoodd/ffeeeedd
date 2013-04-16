Convention d'écriture
=====================

@note À lire avant intervention sur le thème ffeeeedd
@author Gaël Poupard

Convention CSS
--------------

* *Indentation :* 2 espaces
* *Sectionnement :* scinder en sections majeures les fichier
* *Chapitrage :* scinder en chapitres les sections principales
* *Commentaires :* commenter les valeurs arbitraires ou issues d'un calcul


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
