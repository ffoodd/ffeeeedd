Charte d'intégration
====================

@note À lire avant intervention sur le thème ffeeeedd

@author Gaël Poupard

@note Inspiré par la charte du projet Normandie et diverses chartes à citer également.

@see [Luc Poupard](http://www.kloh.fr "kloh.fr") [@klohFR](https://twitter.com/klohFR "@klohFR")

La présente charte détaille l'ensemble des règles et/ou recommandations à suivre pour créer ou modifier l'ensemble des fichiers du thème : HTML, CSS, microdonnées, microformats, javascript, images… Il s'agit de règles générales applicables à l'ensemble du thème. 


Généralités
-----------

* __Encodage :__ Tous les fichiers doivent être encodés en UTF-8 sans BOM
* __Indentation :__ Utiliser 2 espaces pour chaque niveau d'indentation.
* __Annotations :__ Citer les sources & références, et annoter autant que possible le code.


Charte CSS
----------

@note : seul le fichier kit.css est voué à être modifié.

* __Encodage :__ Déclarer le charset `@charset "UTF-8";` en tout début de fichier.

* __Indentation :__ Utiliser 2 espaces pour chaque niveau d'indentation.

* __Information :__ Les fichiers doivent débuter par une introduction rédigée en suivant le format [CSSdoc](http://cssdoc.net/ "CSSDoc").

* __Sectionnement :__ Scinder en sections majeures le fichier.

* __Chapitrage :__ Scinder en chapitres les sections principales.

* __Sommaire :__ Un sommaire doit récapituler et répertorier les sections et chapitres.

* __Annotations :__ Citer les sources & références, et annoter autant que possible le code.

* __Commentaires :__
 * Placer systématiquement le commentaire sur la ligne au dessus du sélecteur, lorsqu'il concerne l'ensemble du groupe de règles.
 * Commenter systématiquement les valeurs arbitraires ou issues d'un calcul, afin de permettre une bonne appréhension des styles.
 * Exception lorsque le commentaire concerne une règle particulière : il est placé à la suite de la règle, en fin de ligne.
 * Le format des commentaires respectera également le format CSSDoc.

==

* __Sélecteurs :__
 * Un seul sélecteur par ligne.
 * Une déclaration par ligne au sein du bloc de règles.
 * Les règles sont ferrées à gauche.
 * Un espace avant l'accolade ouvrante ` {`.
 * Un espace après les deux-points `: ` d'une règle.
 * Un point-virgule `;` à la fin de chaque règle.
 * L'accolade de fermeture `}` est placé à la ligne après la dernière règle et au même niveau d'indentation que le(s) sélecteur(s) au(x)quel(s) s'applique les déclarations.
 * Une ligne est sautée entre chaque bloc de règles.
 * Éviter de surqualifier les sélecteurs : *ne jamais indiquer l'élément HTML dans un sélecteur*.
 * Dans le cas des préfixes vendeurs, ferrer à gauche les règles *et* les valeurs ( après les deux points ).
 * Les sélecteurs d'attributs doivent utiliser des guillemets doubles ( `type="radio"` ). 

==
  
* __Classes et identifiants :__
 * Limiter au maximum l'utilisation d'identifiant.
 * Les classes et identifiants - et, de fait, les sélecteurs - doivent être écrits en minuscules. *NB :__ le CamelCase est interdit.
 * Le fichier structure.css met en place des classes réutilisables, basées sur [knacss](http://knacss.com/) et fortement inspirée de la pensée [OOCSS](http://oocss.org/ "oocss.org"). *Il n'est pas censé être modifié.*
 * Les sélecteurs composés dans le kit le seront suivant la [méthode BEM](http://bem.info/method/) ( documentation utile sur [CSS Wizardry](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/) ).

==

* __Valeurs :__
 * Toutes les propriétés doivent utiliser leur syntaxe raccourcie quand c'est possible.
 * La valeur des couleurs simples doit se faire en hexadécimal raccourci ( `#fff` pour le blanc )
 * Utiliser des bas de casses pour les valeurs hexadécimales.
 * La valeur des couleurs complexes doit se faire autant que possible en `hsl` / `hsla` avec un fallback en `rgb` pour *IE8 et -* . ( cf [l'article de Vincent De Oliveira](http://blog.iamvdo.me/post/46251119961/les-avantages-de-hsl-par-rapport-a-rgb) ).
 * Les corps de texte doivent être formulés en `rem` avec un fallback en `px` pour *IE8 et -*.
 * Les hauteurs doivent être formulées en `rem` afin de conserver le rythme vertical.
 * Les marges *verticales* ( margin et padding ) doivent également être formulées en `rem`.
 * Les largeurs doivent être formulées en `%` afin de simplifier les calculs de largeurs cumulées.
 * Les marges *horizontales* ( margin et padding ) doivent donc être formulées en `%` également.
 * Les chiffres magiques ( arbitraires, ex : 37px ) sont à bannir : toutes les valeurs doivent être exprimées de façon relative.
 * Ne pas préciser d'unité pour les valeurs nulles (0).
 * Ne pas précier le 0 dans les valeurs décimales inférieures à 1 ( 0.2 => .2 ).
 * Proscrire l'emploi de `!important`.

==

* __Typographies :__
 * Un rythme vertical est primordial : une portion du kit.css y est dédiée. Elle est personnalisable via [cet outil](http://soqr.fr/vertical-rhythm/ "Générateur de rythme vertical"). *Attention* : cet outil génère des valeurs en `em`, pas en `rem` !
 * L'utilisation de polices exotiques doit se faire à l'aide de `@font-face` ou de servces tels que [Typekit](https://typekit.com/ "Typekit").
 * Un fallback correct doit être fourni pour chaque police exotique. Deux outils à votre secours : le [font-stack builder](http://www.codestyle.org/servlets/FontStack?stack=Palatino%20Linotype,Palatino,FreeSerif&generic= "CodeStyle") et [FFFALLBACK](http://ffffallback.com/"Le bookmarklet FFFALLBACK").

==

* __Exceptions :__
 * Dans le cas d'une déclaration contenant une seule règle, ne pas la mettre à la ligne mais préférer insérer un espace avant et après les accolades.
 * Dans le cas d'une valeur complexe, il convient de la scinder en plusieurs lignes avec une indentation supplémentaire pour en faciliter la lecture ( notamment les gradient ).

==

* __Compatibilité :__
 * Dans le cas de règles expérimentales ou anciennes, ajouter un commentaire pour spécifier le navigateur / version ciblé ( CSSDoc prévoit @bugfix ).
 * Les styles spécifiques à IE8 et inférieur doivent être exclus dans un fichier css externe.
 * Aucun hack n'est autorisé : chaque problème appelle une solution propre.
 * Une classe js / no-js permet d'appliquer des styles en focntion de l'activation du javascript.

==

* __Ordres des déclarations :__ @see [CSSLisibile](https://github.com/Darklg/CSSLisible/blob/master/inc/valeurs.php "Le rangement des valeurs selon CSSLisible").
 1. Contenu ( "content" pour les pseudo-éléments )
 2. Positionnnement ( display, float, position, top, bottom, left, right )
 3. Modèle de boîte ( width, height, margin, padding, overflow, border )
 4. Texte ( font, text-align, text-shadow, text-decoration, letter-spacing, word-spacing )
 5. Décoration ( color, opacity, background, box-shadow, outline )
 6. Transformation & transitions ( animation, transition, transformation )
 7. Comportements ( cursor )
 
==

* Exemple :

```css



/* Un commentaire sur le bloc */
.exemple,
.exemple--2 {
  display: block;
  background: #fff; /* Un commentaire sur la règle */
}

.exemple--2::after {
  content: "Mon contenu";
  display: block;
  position: relative;
  box-shadow: 
    1px 1px 0 #333,
    2px 2px 0 #444,
    3px 3px 0 #555;
  -webkit-transition: all 1s linear; /* Chrome 26-, Safari, Ios Safari, Androïd, Blackberry */
  transition:         all 1s linear;
}

.exemple--3 { display: none; }
```

Convention HTML
---------------

* __Encodage :__ Spécifier l'encodage via la balise meta dédiée `<meta charset="utf-8">`.

* __Organisation du `<head>` :__ 
 * La `<meta charset="utf-8">` doit être le premier enfant du `<head>`.
 * La balise `<title>` doit venir en deuxième position.
 * Ajouter la balise `<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">` en vue d'améliorer le rendu sur IE.
 * La balise `<base>` est également primordiale et doit être spécifiée.

==

* __Indentation :__ Utiliser 2 espaces pour chaque niveau d'indentation.

* __Écriture :__ Les balises et attributs doivent être rédigés en minuscules ( CamelCase prohibé ).

* __Retours chariots :__ Revenir à la ligne à chaque ouverture de balise, et indenter en conséquence.

* __Doctype :__ Utiliser le doctype HTML5 `<!DOCTYPE html>`.

* __Sémantique :__ Utiliser les balises en fonction de leur signification et non de leur mise en forme : le choix des balises doit se faire indépendamment de la présentation et du comportement.

* __Validation :__ Créer du code validé par le [W3C Validator](http://validator.w3.org/ "Validator") dans la mesure du possible.

* __Commentaires :__ Commenter la fermeture de chaque balise en HTML, puis sauter une ligne.

* __Multimédias :__ Fournir des alternatives aux médias ( attributs alt, sous-titres, etc...).

* __Fermeture de balise :__ Chaque balise doit être correctement fermée; les balises auto-fermantes doivent contenir un espace avant le slash de fermeture.

* __Attributs :__ 
 * Ne pas fournir l'attribut `type` pour les styles et scripts.
 * Utiliser des guillemets doubles pour cerner les valeurs des attributs.
 * Appliquer les *rôles ARIA* dès que possible.
 * Ajouter les *microdonnées* lorsque c'est utile ( cf: [schema.org](http://schema.org/docs/full.html "Liste des microdonnées").
 * L'attribut style ne doit pas être utilisé.
 
== 

* __Métadonnées :__
 * Ajouter le profil [DublinCore](http://dublincore.org/documents/2008/08/04/dc-html/ "Profil DublinCore") sur `<html>`.
 * Les métas DublinCore, OpenGraph et TwitterCard doivent être renseignées.
 * Les favicon, Apple icon et tuiles Windows doivent être fournis aux formats demandés.
 
== 

* __Annotations :__ Citer les sources & références, et annoter autant que possible le code.

* __Compatibilité :__ 
 * S'appuyer sur des commentaires conditionnels pour cibler les versions d'IE.
 * Une classe no-js doit être présente sur `<html>` afin de tester l'activation du js.
 
==

* Exemple :

```html
<header role="banner">
  <h1 itemprop="name">Exemple</h1>
</header>
<!-- /header -->

<hr />
<main role="main">
</main>
<!-- /main -->
```


Convention Javascript
---------------------

Ça n'est pas ma spécialité : en conséquence les scripts actuels s'appuient sur la librairie [jQuery](http://www.jquery.com "jquery.com") et les plugins utiles.

* _Indentation :_ Utiliser 2 espaces pour chaque niveau d'indentation.

* __Retours chariots :__ Revenir à la ligne entre chaque fonction, et indenter en conséquence.

* __Ligne seule :__ Rester sur une seule ligne si une seule action est executée dans un `if`, `for` ou `while`.

* __Commentaires :__ Commenter la fermeture de chaque fonction.

* __Annotations :__ Citer les sources & références, et annoter autant que possible le code.

* __Organisation :__ Chaque script doit être isolé à l'aide d'un bloc de commentaires respectant CSSDoc. 

* __Sommaire :__ Si plusieurs scripts sont accumulés, on créera un sommaire détaillant leur ordre d'apparition dans le fichier.

* __Guillemets :__ Toujours utiliser des guillemets doubles.

Je garde bon espoir de me passer d'une librairie ou - à défaut - de baser ce thème sur [Zepto](http://zeptojs.com/ "En savoir plus sur Zepto") plutôt que jQuery.



Convention PHP
--------------

* __Respect de WordPress :__ Pour des raisons évidentes, le code doit respecter les conventions inhérentes à WordPress..

* __Indentation :__ Utiliser 2 espaces pour chaque niveau d'indentation.

* __Retours chariots :__ Revenir à la ligne entre chaque fonction, et indenter en conséquence.

* __Commentaires :__ 
 * Commenter la fermeture de chaque fonction.
 * Un commentaire d'introduction pour chaque fonction fonction est bienvenu.
 * Un commentaire sur une seule ligne commence par `//`.
 * Un commentaire sur plusieurs lignes débute par `/*` et se termine par `*/`.
 * Les commentaires servent également à baliser les fichiers et créer un sommaire, à l'instar des fichiers css.

==

* __Annotations :__ Citer les sources & références, et annoter autant que possible le code.

* __Guillemets :__ Toujours utiliser des guillemets doubles.

* __Nommage :__ Les fonctions du thème doivent être préfixées par `ffeeeedd__` et disposer d'un intitulé clair, en français.

* __Écriture :__
 * Les fonctions sont ferrées à gauche.
 * Un espace doit être placé avant l'accolade ouvrante.
 * Un retour chariot est nécessaire après l'accolade ouvrante.
 * Les fonctions / éléments imbriqués doivent être indentés en conséquence.
 



Mise en Production
------------------

*Attention :__ chaque concaténation / minification doit se faire après avoir dupliqué les fichiers sources.

* __Optimisation CSS :__
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

==

* __Minification :__ Le code HTML doit être minifé pour le navigateur ( ffeeeedd intègre une fonction dans ce but ).

* __Optimisation js :__
 * Les scripts sont basés sur jQuery ( en attendant un éventuel passage à Zepto ).
 * Les scripts doivent être minifiés :
  * Concaténer les fichiers ( à l'exception de la lib ).
  * Supprimer les commentaires.
 * L'outil [jsCompress](http://jscompress.com/ "jscompress.com") peut-être utilisé pour cette opération.


Les fichiers .php sont légèrement optimisés : tous les doubles espaces ont été remplacés par des espaces simples, dans le but de minifier le code html généré.
Cela a des conséquences sur la lisibilité du code, mais tous les commentaires ( php et html ) ont été conservés.
