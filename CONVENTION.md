Charte d'intégration
====================

@note À lire avant intervention sur le thème ffeeeedd

@author Gaël Poupard

@note Inspiré par la charte du projet Normandie et diverses chartes à citer également.

@see [Luc Poupard](http://www.kloh.fr "kloh.fr") [@klohFR](https://twitter.com/klohFR "@klohFR")

La présente charte détaille l'ensemble des règles et/ou recommandations à suivre pour créer ou modifier l'ensemble des fichiers du thème : HTML, CSS, microdonnées, microformats, javascript, images… Il s'agit de règles générales applicables à l'ensemble du thème. 


Généralités
-----------

* *Encodage :* Tous les fichiers doivent être encodés en UTF-8 sans BOM
* *Indentation :* Utiliser 2 espaces pour chaque niveau d'indentation.


Charte CSS
----------

@note : seul le fichier kit.css est voué à être modifié.

* *Encodage :* Déclarer le charset ( @charset "UTF-8"; ).

* *Indentation :* Utiliser 2 espaces pour chaque niveau d'indentation.

* *Information :* Les fichiers doivent débuter par une introduction rédigée en suivant le format [CSSdoc](http://cssdoc.net/ "CSSDoc").

* *Sectionnement :* Scinder en sections majeures les fichier.

* *Chapitrage :* Scinder en chapitres les sections principales.

* *Sommaire :* Un sommaire doit récapituler et répertorier les sections et chapitres.

* *Commentaires :*
 * Placer systématiquement le commentaire sur la ligne au dessus du sélecteur, lorsqu'il concerne l'ensemble du groupe de règles.
 * Commenter systématiquement les valeurs arbitraires ou issues d'un calcul, afin de permettre une bonne appréhension des styles.
 * Exception lorsque le commentaire concerne une règle particulière : il est placé à la suite de la règle, en fin de ligne.
 * Le format des commentaires respectera également le format CSSDoc.
  
  
  
* *Sélecteurs :*
 * Un seul sélecteur par ligne.
 * Une déclaration par ligne au sein du bloc de règles.
 * Les règles sont ferrées à gauche.
 * Un espace après les deux-points (:) d'une règle.
 * Un point-virgule (;) à la fin de chaque règle.
 * L'accolade de fermeture (}) est placé à la ligne après la dernière règle et au même niveau d'indentation que le(s) sélecteur(s) au(x)quel(s) s'applique les déclarations.
 * Une ligne est sautée entre chaque bloc de règles.
 * Éviter de surqualifier les sélecteurs : *ne jamais indiquer l'élément HTML dans un sélecteur*..
 * Dans le cas des préfixes vendeurs, ferrées à gauche les règles *et* les valeurs ( après les deux points ).
 * Les sélecteurs d'attributs doivent utiliser des guillemets doubles ( ex : type="radio" ).
  
  
  
* *Classes et identifiants :*
 * Limiter au maximum l'utilisation d'identifiant.
 * Les classes et identifiants - et, de fait, les sélecteurs - doivent être écrits en minuscules. *NB :* le CamelCase est interdit.
 * Le fichier structure.css met en place des classes réutilisables, basées sur [knacss](http://knacss.com/) et fortement inspirée de la pensée [OOCSS](http://oocss.org/ "oocss.org"). *Il n'est pas censé être modifié.*
 * Les sélecteurs composés dans le kit le seront suivant la [méthode BEM](http://bem.info/method/) ( documentation utile sur [CSS Wizardry](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/) ).
 * Les sélecteurs utiles au javascript doivent être préfixés par "js--" et ne pas véhiculer de styles visuels.
  
  
  
* *Valeurs :*
 * Toutes les propriétés doivent utiliser leur syntaxe raccourcie quand c'est possible.
 * La valeur des couleurs simples doit se faire en hexadécimal raccourci ( #fff pour le blanc )
 * Utiliser des bas de casses pour les valeurs hexadécimales.
 * La valeur des couleurs complexes doit se faire autant que possible en *HSL* / *HSLA* avec un fallback en *rgb pour IE8 et -* . ( cf [l'article de Vincent De Oliveira](http://blog.iamvdo.me/post/46251119961/les-avantages-de-hsl-par-rapport-a-rgb) ).
 * Les corps de texte doivent être formulés en *rem* avec un fallback en *px pour IE8 et -*.
 * Les hauteurs doivent être formulées en *rem* afin de conserver le rythme vertical.
 * Les marges *verticales* ( margin et padding ) doivent également être formulées en *rem*.
 * Les largeurs doivent être formulées en *%* afin de simplifier les calculs de largeurs cumulées.
 * Les marges *horizontales* ( margin et padding ) doivent donc être formulées en *%* également.
 * Les chiffres magiques ( arbitraires, ex : 37px ) sont à bannir : toutes les valeurs doivent être exprimées de façon relative.
 * Ne pas préciser d'unité pour les valeurs nulles (0).
 * Ne pas précier le 0 dans les valeurs décimales inférieures à 1 ( 0.2 => .2 )
 * Proscrire l'emploi de "!important".
  
  
  
* *Typographies :*
 * Un rythme vertical est primordial : une portion du kit.css y est dédiée. Elle est personnalisable via [cet outil](http://soqr.fr/vertical-rhythm/ "Générateur de rythme vertical"). *Attention* : cet outil génère des valeurs en em, pas en rem !
 * L'utilisation de polices exotiques doit se faire à l'aide de @font-face ou de servces tels que [Typekit](https://typekit.com/ "Typekit").
 * Un fallback correct doit être fourni pour chaque police exotique. Deux outils à votre secours : le [font-stack builder](http://www.codestyle.org/servlets/FontStack?stack=Palatino%20Linotype,Palatino,FreeSerif&generic= "CodeStyle") et [FFFALLBACK](http://ffffallback.com/"Le bookmarklet FFFALLBACK").
  
  
  
* *Exceptions :*
 * Dans le cas d'une déclaration contenant une seule règle, ne pas la mettre à la ligne mais préférer insérer un espace avant et après ( .mon--selecteur { propriété: valeur; } ).
 * Dans le cas d'une valeur complexe, il convient de la scinder en plusieurs lignes pour en faciliter la lecture ( notamment les gradient ).
  
  
  
* *Ordres des déclarations :* @see [CSSLisibile](https://github.com/Darklg/CSSLisible/blob/master/inc/valeurs.php "Le rangement des valeurs selon CSSLisible").
 1. Contenu ( "content" pour les pseudo-éléments )
 2. Positionnnement ( display, float, position, top, bottom, left, right )
 3. Modèle de boîte ( width, height, margin, padding, overflow, border )
 4. Texte ( font, text-align, text-shadow, text-decoration, letter-spacing, word-spacing )
 5. Décoration ( color, opacity, background, box-shadow, outline )
 6. Transformation & transitions ( animation, transition, transformation )
 7. Comportements ( cursor )



Convention HTML
---------------

* *Encodage :* Spécifier l'encodage via la balise meta dédiée.

* *Indentation :* Utiliser 2 espaces pour chaque niveau d'indentation.

* *Retours chariots :* Revenir à la ligne à chaque ouverture de balise, et indenter en conséquence.

* *Doctype :* Utiliser le doctype HTML5.

* *Sémantique :* Utiliser les balises en fonction de leur signification et non de leur mise en forme : le choix des balises doit se faire indépendamment de la présentation et du comportement.

* *Validation :* Créer du code validé par le [W3C Validator](http://validator.w3.org/ "Validator") dans la mesure du possible.

* *Commentaires :* Commenter la fermeture de chaque balise en HTML.

* *Multimédias :* Fournir des alternatives aux médias ( attributs alt, sous-titres, etc...).

* *Attributs :* 
 * Ne pas fournir l'attribut type pour les styles et scripts.
 * Utiliser des guillemets doubles pour cerner les valeurs des attributs.



Mise en Production
------------------

* *Optimisation CSS :*
 * Les fichiers .css doivent être concaténés en un seul ( styles.css : notez bien le 's' final (!) attention aux *urls*).
 * Les fichiers .css doivent être conservés tels quels.
 * Le fichier final doit être minifié selon les règles suivantes :
  * Supprimer les espaces avant et après les accolades ouvrantes ( { ),
  * Supprimer les espaces avant et après les accolades fermantes ( } ),
  * Supprimer les espaces avant et après les deux points ( : ),
  * Supprimer les espaces avant et après les points-virgules ( ; ),
  * Supprimer le dernier point-virgule d'une règle ( ; } ),
  * Supprimer les retours à la ligne,
  * Supprimer les doubles espaces,
  * Supprimer les commentaires.
  * L'outil [CssCompressor](http://www.cssdrive.com/index.php/main/csscompressor "cssdrive.com") peut être utilisé avec les options suivantes: Super Compact, Strip all comments.

* *Minification :* Le code HTML doit être minifé pour le navigateur ( ffeeeedd intègre une fonction dans ce but ).


*** Pour le js :
            http://jscompress.com/
*** Fin du js

Les fichiers .php sont légèrement optimisés : tous les doubles espaces ont été remplacés par des espaces simples, dans le but de minifier le code html généré.
Cela a des conséquences sur la lisibilité du code, mais tous les commentaires ( php et html ) ont été conservés.
