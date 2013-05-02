Charte d'intégration
====================

@note À lire avant intervention sur le thème ffeeeedd

@author Gaël Poupard

@note Inspiré par la charte du projet Normandie et diverses chartes à citer également.

@see [Luc Poupard](http://www.kloh.fr "kloh.fr") [@klohFR](https://twitter.com/klohFR "@klohFR")

@see [WordPress Theme Review](http://codex.wordpress.org/Theme_Review "Critères de conformité WordPress")

La présente charte détaille l'ensemble des règles et/ou recommandations à suivre pour créer ou modifier l'ensemble des fichiers du thème : HTML, CSS, microdonnées, microformats, javascript, images… Il s'agit de règles générales applicables à l'ensemble du thème. 


Généralités
-----------

* Encodage : Tous les fichiers doivent être encodés en UTF-8 sans BOM
* Indentation : Utiliser 2 espaces pour chaque niveau d'indentation.
* Annotations : Citer les sources & références, et annoter autant que possible le code.
* Espaces : Supprimer les espaces inutiles en bout de ligne.


Règle de nommage
----------------

Les règles suivantes sont valables pour tous les fichiers, à l'exception des fichiers php qui devront suivre les règles inhérentes à [la hiérarchie des templates WordPress](http://codex.wordpress.org/fr:Hi%C3%A9rarchie_de_modeles).

* Les noms de fichiers, classes, identifiants et fonctions doivent être :
 * En Français. Une future version anglaise fera l'objet d'un fork.
 * Explicites et pertinents ( proscrire les `.bloc` par exemple ).
 * Au singulier.
 * Aussi concis que possible.
 
==

* Les images apellées via CSS doivent être intitulées suivant l'élément qu'elles ornent ( par exemple: body.jpg ).


Charte CSS
----------

@note : seul le fichier kit.css est voué à être modifié.

* Encodage : Déclarer le charset `@charset "UTF-8";` en tout début de fichier.

* Indentation : Utiliser 2 espaces pour chaque niveau d'indentation. *Les tabluations sont proscrites.*

* Espaces : Supprimer les espaces inutiles en bout de ligne.

* Information : Les fichiers doivent débuter par une introduction rédigée en suivant le format [CSSdoc](http://cssdoc.net/ "CSSDoc").

* Sectionnement : Scinder en sections majeures le fichier, dont l'intitulé sera composé comme suit : `/* == @section ==================== */` ( 2 signes `=`, le tag `@section`, et 20 signes `=` )..

* Chapitrage : Scinder en chapitres les sections principales, dont l'intitulé sera composé de la même façon que celui des sections. Cependant le tag sera `@subsection` et le signe `=` est remplacé par le signe `-`.

* Sommaire : Un sommaire doit récapituler et répertorier les sections et chapitres, respectivement précédé d'un `==` ou d'un `=`.

* Annotations : Citer les sources & références, et annoter autant que possible le code.

* Commentaires :
 * Placer systématiquement le commentaire sur la ligne au dessus du sélecteur, lorsqu'il concerne l'ensemble du groupe de règles.
 * Commenter systématiquement les valeurs arbitraires ou issues d'un calcul, afin de permettre une bonne appréhension des styles.
 * Exception lorsque le commentaire concerne une règle particulière : il est placé à l'intérieur du bloc de règles, mais à la ligne précédant la règle concernée.
 * Le format des commentaires respectera également le format CSSDoc.

==

* Sélecteurs :
 * Un seul sélecteur par ligne.
 * Une déclaration par ligne au sein du bloc de règles.
 * Les règles sont ferrées à gauche.
 * Un espace avant l'accolade ouvrante ` {`.
 * Un espace après les deux-points `: ` d'une règle.
 * Un point-virgule `;` à la fin de chaque règle.
 * L'accolade de fermeture `}` est placé à la ligne après la dernière règle et au même niveau d'indentation que le(s) sélecteur(s) au(x)quel(s) s'applique les déclarations.
 * Une ligne est sautée entre chaque bloc de règles.
 * Éviter de surqualifier les sélecteurs : *ne jamais indiquer l'élément HTML dans un sélecteur*.
 * Les sélecteurs d'adjacence, d'enfant ou d'attributs doivent être évité autant que possible, car ils nuisent à la performance globale.
 * De même les sélecteurs doivent être courts, une seule cible par sélecteur est l'idéal.
 * Les sélecteurs d'attributs doivent utiliser des guillemets doubles ( `type="radio"` ).
 * Dans tous les cas utilisant des guillemets, préférer les guillemets doubles.
 * Exception : Dans le cas d'une déclaration contenant une seule règle, ne pas la mettre à la ligne mais préférer insérer un espace avant et après les accolades.

==
  
* Classes et identifiants :
 * Limiter au maximum l'utilisation d'identifiant.
 * Les classes et identifiants - et, de fait, les sélecteurs - doivent être écrits en minuscules. *NB :* le CamelCase est interdit.
 * Le fichier structure.css met en place des classes réutilisables, basées sur [knacss](http://knacss.com/) et fortement inspirée de la pensée [OOCSS](http://oocss.org/ "oocss.org"). *Il n'est pas censé être modifié.*
 * Les sélecteurs composés dans le kit le seront suivant la [méthode BEM](http://bem.info/method/) ( documentation utile sur [CSS Wizardry](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/) ).
  * Ex: `.block`
  * Ex: `.block--element`
  * Ex: `.block--element__modifier`

==

* Valeurs :
 * Toutes les propriétés doivent utiliser leur syntaxe raccourcie quand c'est possible.
 * La valeur des couleurs simples doit se faire en hexadécimal raccourci ( `#fff` pour le blanc )
 * Utiliser des bas de casses pour les valeurs hexadécimales.
 * La valeur des couleurs complexes doit se faire autant que possible en `hsl` / `hsla` avec un fallback en `rgb` pour *IE8 et -* . ( cf [l'article de Vincent De Oliveira](http://blog.iamvdo.me/post/46251119961/les-avantages-de-hsl-par-rapport-a-rgb) ).
 * Les corps de texte doivent être formulés en `em` avec un fallback en `px` pour *IE7 et -*.
 * Les hauteurs doivent être formulées en `em` afin de conserver le rythme vertical.
 * Les marges *verticales* ( margin et padding ) doivent également être formulées en `em`.
 * Les largeurs doivent être formulées en `%` afin de simplifier les calculs de largeurs cumulées.
 * Les marges *horizontales* ( margin et padding ) doivent donc être formulées en `%` également.
 * Les chiffres magiques ( arbitraires, ex : 37px ) sont à bannir : toutes les valeurs doivent être exprimées de façon relative.
 * Ne pas préciser d'unité pour les valeurs nulles (0) lorsque c'est autorisé.
 * Ne pas préciser le 0 dans les valeurs décimales inférieures à 1 ( 0.2 => .2 ).
 * Toujours ajouter une espace après une virgule dans les valeurs complexes ( comme `hsla`, Ex: `hsla( 0, 0, 0, .5)`.
 * Proscrire l'emploi de `!important`.
 * Dans le cas des préfixes vendeurs, ferrer à gauche les règles *et* les valeurs ( après les deux points ).
 * Exception : Dans le cas d'une valeur complexe, il convient de la scinder en plusieurs lignes avec une indentation supplémentaire pour en faciliter la lecture ( notamment les dégradés ).

==

* Liens :
 * Les liens doivent être stylés en suivant [la méthode LoVeHAte](http://meyerweb.com/eric/css/link-specificity.html "Article d'Eric Meyer") comme suit :
 * `a:link { }` : pour les liens non visités.
 * `a:visited { }` : pour les liens visités.
 * `a:hover { }` : pour les liens survolés.
 * `a:active { }` : pour les liens actifs.
 * `a { }`.
 
==

* Navigation : La navigation au clavier doit être facile et claire, la prise de `:focus` doit être visuellement indiquée.

* Media Queries :
 * Les requêtes médias doivent être situées à la fin du fichier afin d'éviter les conflits dans la cascade.
 * En phase de développement, il est envisageable d'ajouter un fichier `medias.css` appellé après le kit.
 * Les requêtes médias doivent être indentées logiquement, afin que leur imbrication soit visuellement parlante ( les déclarations au sein d'une requête auront un niveau d'indentation suplémentaire par rapport aux déclarations hors requêtes ).
 * Les requêtes médias sont ordonnées de la contrainte la plus basse à la contrainte la plus haute, de façon cumulative ( penser "Mobile First" ).

==

* Images :
 * Les images ajoutées via CSS doivent être purement décoratives.
 * Les images présentes sur l'ensemble des pages - ou presque - doivent être regroupées en sprite, au format .png de préférence.
 * Les png doivent être optimisés : en png-8 quand c'est possible, et avec des outils tels que [PngOptimizer](http://psydk.org/PngOptimizer.php "Optimisateur de png").
 * Les petites images spécifiques à certaines pages ne doivent pas être ajoutées au sprite, mais peuvent être converties en DataURI ( encodage en base64 ). Des sites comme [Duri.me](http://duri.me/ "Encoder une image en base64") permettent une conversion très simple.

==

* Typographies :
 * Un rythme vertical est primordial : une portion du kit.css y est dédiée. Elle est personnalisable via [cet outil](http://soqr.fr/vertical-rhythm/ "Générateur de rythme vertical"). *Attention* : cet outil génère des valeurs en `em`, pas en `rem` !
 * L'utilisation de polices exotiques doit se faire à l'aide de `@font-face` ou de services tels que [Typekit](https://typekit.com/ "Typekit").
 * Un fallback correct doit être fourni pour chaque police exotique. Deux outils à votre secours : le [font-stack builder](http://www.codestyle.org/servlets/FontStack?stack=Palatino%20Linotype,Palatino,FreeSerif&generic= "CodeStyle") et [FFFALLBACK](http://ffffallback.com/"Le bookmarklet FFFALLBACK").
 * Un dernier recours doit être fourni sous la forme d'une famille générique ( ex : `sans-serif` ).
 * Les formats .xwoff et .eot suffisent dans la plupart des cas.
 * Éviter l'emploi de faux-gras et faux-italiques ( id est : généré par le navigateur en l'absence de fichier dédié ). 
 * Il est fortement déconseillé d'utiliser plus de trois typographies ( leur déclinaison en graisse(s) est recommandée ).

==

* Compatibilité :
 * Dans le cas de règles expérimentales ou anciennes, ajouter un commentaire pour spécifier le navigateur / version ciblé ( CSSDoc prévoit @bugfix ).
 * Dégradés : un outil tel que [CSS Gradient Generator](http://www.colorzilla.com/gradient-editor/ "Générateur de dégradé") doit être utilisé pour les dégradés, afin de maximiser la compatibilité.
 * Les préfixes vendeurs doivent précéder la version non-préfixée.
 * Les styles spécifiques à IE8 et inférieur doivent être inclus dans le fichier final styles.css, afin d'en faciliter la maintenance.
 * Les styles spécifiques à IE8 et inférieur s'appuient sur des classes conditonnelles appliquées à `<html>`.
 * Une couleur de fond doit être appliquée au `<body>`, au cas ou un navigateur appliquerait une couleur incorrecte.
 * Aucun hack n'est autorisé : chaque problème appelle une solution propre.
 * Une classe js / no-js permet d'appliquer des styles en focntion de l'activation du javascript.
 * Éviter les filtres propriétaires de Microsoft : la transparence ou les dégradés sont souvent de simples onrements.
 * Si besoin de distinguer le premier élément plutôt que le dernier.

==

* Ordre des déclarations : @see [CSSLisible](https://github.com/Darklg/CSSLisible/blob/master/inc/valeurs.php "Le rangement des valeurs selon CSSLisible").
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
/* == @section Une section ==================== */
/* @note : Notes à propos de la section  */

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

==

* Références & Inspirations :
 * [WordPress CSS Coding Standards](http://make.wordpress.org/core/handbook/coding-standards/css/ "Le guide de contribution à WordPress")
 * [Google Style Guide](http://google-styleguide.googlecode.com/svn/trunk/htmlcssguide.xml "Recommandations Google")
 * [Interactive Guide to Blog Typography](http://www.kaikkonendesign.fi/typography/section/1 "Guide interactif de l'usage des typographies sur le web")
 * [Charte CSS](http://css.thenew.fr/ "Charte CSS par Rémy Barthez, intégrateur")  par Rémy Barthez
 * [Idiomatic CSS](https://github.com/DirtyF/idiomatic-css/tree/master/translations/fr-FR "Principes d'écriture pour des CSS cohérents et idiomatiques") par Nicolas Gallagher
 * [BBC's Standards & Guidelines](http://www.bbc.co.uk/guidelines/futuremedia/technical/css.shtml "V1.3")
 * [CSS Guidelines](https://github.com/csswizardry/CSS-Guidelines) par CSSWizardry
 * [CSSdoc](http://cssdoc.net/ "CSSDoc")
 * [knacss](http://knacss.com/) 
 * [OOCSS](http://oocss.org/ "oocss.org")
 * [BEM](http://bem.info/method/)
 * [CSS Wizardry](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/)
 * [Vincent De Oliveira sur hsla](http://blog.iamvdo.me/post/46251119961/les-avantages-de-hsl-par-rapport-a-rgb)
 * [LVHA par Eric Meyer](http://meyerweb.com/eric/css/link-specificity.html "Article d'Eric Meyer")
 * [Générateur de rythme vertical](http://soqr.fr/vertical-rhythm/ "Générateur de rythme vertical")
 * [Typekit](https://typekit.com/ "Typekit").
 * [Font-stack Builder](http://www.codestyle.org/servlets/FontStack)
 * [FFFALLBACK](http://ffffallback.com/"Le bookmarklet FFFALLBACK")
 * [CSS Gradient Generator](http://www.colorzilla.com/gradient-editor/ "Générateur de dégradé")
 * [CSSLisible](https://github.com/Darklg/CSSLisible/blob/master/inc/valeurs.php "Le rangement des valeurs selon CSSLisible")
 * [PngOptimizer](http://psydk.org/PngOptimizer.php "Optimisateur de png")
 * [Duri.me](http://duri.me/ "Encoder une image en base64")

Charte HTML
-----------

* Doctype : Utiliser le doctype HTML5 `<!DOCTYPE html>`.

* Encodage : Spécifier l'encodage via la balise meta dédiée `<meta charset="utf-8">`.

* Langue : Ma langue doit être spécifiée sur la balise `<html>` ( ex: `lang="fr-FR"` ).

* Organisation du `<head>` : 
 * La `<meta charset="utf-8">` doit être le premier enfant du `<head>`.
 * La balise `<title>` doit venir en deuxième position.
 * Ajouter la balise `<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">` en vue d'améliorer le rendu sur IE.
 * La balise `<base>` est également primordiale et doit être spécifiée.

==

* Indentation : Utiliser 2 espaces pour chaque niveau d'indentation.

* Espaces : Supprimer les espaces inutiles en bout de ligne.

* Écriture : Les balises et attributs doivent être rédigés en minuscules ( CamelCase prohibé ).

* Retours chariots : Revenir à la ligne à chaque ouverture de balise, et indenter en conséquence. Reformulé : une seule balise par ligne.

* Sémantique : Utiliser les balises en fonction de leur signification et non de leur mise en forme : le choix des balises doit se faire indépendamment de la présentation et du comportement. Un détail de chaque balise et de son sens est disponible sur [HTML5 Doctor](http://html5doctor.com/ "Index des éléments HTML5")

* Organisation : La hiérarchie des titres doit être cohérente et claire.

* Validation : Créer du code validé par le [W3C Validator](http://validator.w3.org/ "Validator") dans la mesure du possible.

* Commentaires : Commenter la fermeture de chaque balise importante en HTML, puis sauter une ligne. L'importance dépend du seul jugement de l'auteur, mais certains cas sont indispensables : par exemple `<main>` s'ouvre dans `header.php` et se ferme dans `footer.php`. *L'intérêt est de faciliter l'orientation dans le code source.*

* Multimédias : Fournir des alternatives aux médias ( attributs alt, sous-titres, etc...).

* Fermeture de balise : Chaque balise doit être correctement fermée; les balises auto-fermantes doivent contenir un espace avant le slash de fermeture.

* Attributs : 
 * Ne pas fournir l'attribut `type` pour les styles et scripts.
 * Utiliser des guillemets doubles pour cerner les valeurs des attributs.
 * Spécifier les *rôles ARIA* dès que possible ( cf: [WAI ARIA](http://www.w3.org/TR/wai-aria/ "La recommandation du W3C") ).
 * Ajouter les *microdonnées* lorsque c'est utile ( cf: [schema.org](http://schema.org/docs/full.html "Liste des microdonnées") ).
 * L'attribut style ne doit pas être utilisé.
 * Dans le cas de nombreux attributs, on envisagera de revenir à la ligne entre chaque attribut afin d'améliorer la lisibilité.
 
==

* Ordre des attributs :
 1. `class` : valoriser l'utilisation des classes par rapport aux IDs pour les CSS comme pour les JS.
 2. `id`
 3. `role`
 4. `data-*`
 5. `aria-*`
 6. autre.
 
== 

* Métadonnées :
 * Ajouter le profil [DublinCore](http://dublincore.org/documents/2008/08/04/dc-html/ "Profil DublinCore") sur `<html>`.
 * Les métas DublinCore, OpenGraph et TwitterCard doivent être renseignées.
 * Les favicon, Apple icon et tuiles Windows doivent être fournis aux formats demandés.

== 

* Formulaires :
 * Chaque champ est associé à un label, avec les attributs `for` et `aria-labelled-by`.
 * Le format attendu est indiqué sous forme de légende à côté du champ.
 * Les placeholders ne doivent pas être la seule indication du format attendu.
 * L'attribut `type` doit être utilisé efficacement.
 * Les champs obligatoires sont indiqués par une indication textuelle à côté du label, mais aussi via les attributs `required` et `aria-required`.
 * Les erreurs sont retournées champ par champ, avec un intitulé explicitant l'erreur.
 * Le succès d'une soumission est également explicitée textuellement.
 * Les contraintes de chaque champ sont indiquées à côté de celui-ci ( masque de saisie, sensibilité à la casse, nombre de caractères... ).
 
== 

* Tableaux :
 * Chaque tableau de données doit disposer d'un titre.
 * Les en-têtes sont correctement balisées (`<th>`).
 * Les cellules doivent être reliées à leur en-tête.
 
== 

* Liens :
 * Chaque lien est doté d'un intitulé utile, décrivant sa fonction ou sa cible.
 * Éviter les intitulés passe-partout (en savoir plus, cliquez ici).
 * Le soulignement est réservé aux liens, afin de les distinguer visuellement.
 * Les liens visités ont un style particulier, différenciant.
 * Les liens externes sont distingués visuellement.
 * Éviter l'emploi de `<a href="#">` comme bouton d'action; préferer `<button type="button">`.

== 

* Annotations : Citer les sources & références, et annoter autant que possible le code.

* La première occurrence d'un `<abbr>` doit permettre d'accéder à sa signification.

* La capitalisation à des fins décoratives doit être faite via CSS.

* Les mots ne comportent ni espaces ni balisage interne (`<span>`L`</span>`ettrine).

* Compatibilité : 
 * S'appuyer sur des commentaires conditionnels pour cibler les versions d'IE.
 * Une classe no-js doit être présente sur `<html>` afin de tester l'activation du js.
 
==

* Limiter au maximum la profondeur du DOM, ainsi que le nombre d'éléments.
 
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

==

* Références & Inspirations :
 * [WordPress HTML Coding Standards](http://make.wordpress.org/core/handbook/coding-standards/html/ "Le guide de contribution à WordPress")
 * [Google Style Guide](http://google-styleguide.googlecode.com/svn/trunk/htmlcssguide.xml "Recommandations Google")
 * [BBC's Standards & Guidelines](http://www.bbc.co.uk/guidelines/futuremedia/technical/xhtml_integrity.shtml)
 * [W3C Validator](http://validator.w3.org/ "Validator")
 * [schema.org](http://schema.org/docs/full.html "Liste des microdonnées")
 * [WAI ARIA](http://www.w3.org/TR/wai-aria/ "La recommandation du W3C")
 * [DublinCore](http://dublincore.org/documents/2008/08/04/dc-html/ "Profil DublinCore")
 * [Idiomatic HTML](https://github.com/necolas/idiomatic-html/)


Charte Javascript
-----------------

Ça n'est pas ma spécialité : en conséquence les scripts actuels s'appuient sur la librairie [jQuery](http://www.jquery.com "jquery.com") et les plugins utiles.

* Indentation : Utiliser 2 espaces pour chaque niveau d'indentation.

* Retours chariots : Revenir à la ligne entre chaque fonction, et indenter en conséquence.

* Accolades : L'accolade ouvrante doit être sur la même ligne que la définition de la fonction et précédée d'une espace; l'accolade fermante doit être isolée sur la ligne suivant la dernière déclaration de la fonction.

* Parenthèses : Toujours cerner les parenthèses d'espace `if ( this ) ` y compris dans les opérations. Ex: `i = ( 20 + 30 ) - 17`;.

* Espaces : Supprimer les espaces inutiles en bout de ligne.

* Ligne seule : Rester sur une seule ligne si une seule action est executée dans un `if`, `for` ou `while`.

* Commentaires : 
 * Commenter la fermeture de chaque fonction.
 * Annoter les fonctions et plugins particuliers ( cf point suivant "Annontations" ).
 * Expliquer les fonctions dont la lecture n'est pas naturelle.
 
== 

* Annotations : Citer les sources & références, et annoter autant que possible le code.

* Organisation : Chaque script doit être isolé à l'aide d'un bloc de commentaires respectant [JSDoc](http://usejsdoc.org/ "Documentation JSDoc"). 

* Sommaire : Si plusieurs scripts sont cumulés, on créera un sommaire détaillant leur ordre d'apparition dans le fichier.

* Guillemets : Toujours utiliser des guillemets doubles.

* Erreurs : Simple bon sens, le thème ne doit générer aucune erreur Javascript.

* Références & inspirations :
 * [WordPress JS Coding Standard](http://make.wordpress.org/core/handbook/coding-standards/javascript/)
 * [JSLint](http://www.jslint.com/)
 * [JSDoc](http://usejsdoc.org/ "Documentation JSDoc")
 * [jQuery](http://www.jquery.com "jquery.com")
 * [Zepto](http://zeptojs.com/ "En savoir plus sur Zepto")

Je garde bon espoir de me passer d'une librairie ou - à défaut - de baser ce thème sur [Zepto](http://zeptojs.com/ "En savoir plus sur Zepto") plutôt que jQuery.


Charte PHP
----------

* Respect de WordPress : Pour des raisons évidentes, le code doit respecter les conventions inhérentes à WordPress..

* Indentation : Utiliser 2 espaces pour chaque niveau d'indentation.

* Retours chariots : Revenir à la ligne entre chaque fonction, et indenter en conséquence.

* Accolades : L'accolade ouvrante doit être sur la même ligne que la définition de la fonction et précédée d'une espace; l'accolade fermante doit être isolée sur la ligne suivant la dernière déclaration de la fonction.

* Parenthèses : Toujours cerner les parenthèses d'espace `if ( this ) `.

* Ouverture de php : Toujours utiliser la version complète pour ouvrir php. Ex: `<?php .. ?>` au lieu de `<? ... ?>`.

* Espaces : Supprimer les espaces inutiles en bout de ligne.

* Virgules : Toujours ajouter une espace après une virgule.

* Commentaires : 
 * Commenter la fermeture de chaque fonction.
 * Un commentaire d'introduction pour chaque fonction fonction est bienvenu.
 * Un commentaire sur une seule ligne commence par `//`.
 * Un commentaire sur plusieurs lignes débute par `/*` et se termine par `*/`.
 * Les commentaires servent également à baliser les fichiers et créer un sommaire, à l'instar des fichiers css.

==

* Annotations : Citer les sources & références, et annoter autant que possible le code.

* Guillemets : Toujours utiliser des guillemets doubles.

* Nommage : Les fonctions du thème doivent être préfixées par `ffeeeedd` et disposer d'un intitulé clair, en français ( le cas échéant, dans la langue de l'auteur ).

* Ne jamais utiliser de CamelCase.
 
==

* Références & inspirations :
 * [WordPress PHP Coding Standard](http://make.wordpress.org/core/handbook/coding-standards/php/)
 * [PEAR Coding Standards](http://pear.php.net/manual/en/standards.php)


Mise en Production
------------------

Lorsque le développement et l'intégration sont terminées, une recette est nécessaire. Il s'agit de parcourir toutes les pages, vérifier toutes les fonctionnalités ainsi que la compatibilité navigateurs. Selon les contraintes du projet, des tests sur différents terminaux et un audit d'accessibilité peuvent être nécessaires. Différents outils peuvent nous y aider. On passera ensuite à l'optimisation technique en vue d'améliorer les performances du site, toujours bénéfique tant aux internautes qu'aux robots.

* Vérifications :
 * Des outils commes [les checklists d'Opquast](http://checklists.opquast.com/fr/ "Open Quality Standard") ou [WebDev Checklist](http://webdevchecklist.com/) devraient être utilisés pour garantir la qualité du projet.
 * Les pages doivent être validées à l'aide du Validator ( cf "Convention HTML" )
 * Selon les contraintes du projet, des tests de désactivation du css et / ou du js devront être effectués.
 * Procéder à des tests complets sur tous les navigateurs cibles, et le cas échéant les technologies d'assistance visées.
 * Vérifier l'agrandissement en mode Texte jusqu'à 200%.

*Attention :* chaque concaténation / minification doit se faire après avoir dupliqué les fichiers sources.

* Optimisation CSS :
 * Les fichiers .css doivent être concaténés en un seul ( `style.css` conseillé, conformément aux [conventions WordPress sur la déclaration des thèmes](http://codex.wordpress.org/Theme_Development#Theme_Stylesheet "Explications sur le Codex") ).
 * *Exception :* Le fichier `debug.css` ne doit pas être concaténé.
 * Les fichiers .css doivent être conservés tels quels dans le répertoire `/css` .
 * Le fichier final doit être minifié selon les règles suivantes :
  * Supprimer les espaces avant et après les accolades ouvrantes ( `{` ),
  * Supprimer les espaces avant et après les accolades fermantes ( `}` ),
  * Supprimer les espaces avant et après les deux points ( `:` ),
  * Supprimer les espaces avant et après les points-virgules ( `;` ),
  * Supprimer le dernier point-virgule d'une règle ( `; }` ),
  * Supprimer les retours à la ligne,
  * Supprimer les doubles espaces,
  * Supprimer les commentaires.
  * L'outil [CssCompressor](http://www.cssdrive.com/index.php/main/csscompressor "cssdrive.com") peut être utilisé avec les options suivantes: Super Compact, Strip all comments.

==

* Minification : Le code HTML doit être minifé pour le navigateur ( ffeeeedd intègre une fonction dans ce but ).

* Optimisation js :
 * Les scripts sont basés sur jQuery ( en attendant un éventuel passage à Zepto ).
 * Charger les scripts en fin de documents dès que possible ( WordPress intègre un paramètre booléen sur la fonction [wp_enqueue_script](http://codex.wordpress.org/Function_Reference/wp_enqueue_script "Un tour sur le codex, ça vous dit ?") ).
 * Charger les scripts en asynchrone dès que possible ( les attributs `async` et `defer` sont voués à ça )
 * Les scripts doivent être minifiés :
  * Concaténer les fichiers ( à l'exception de la lib' ).
  * Supprimer les commentaires.
 * L'outil [jsCompress](http://jscompress.com/ "jscompress.com") peut-être utilisé pour cette opération.


Les fichiers .php ne doivent en aucun cas être minifiés.

* Paramètres serveurs ( dans le cas d'un serveur Apache, en passant par le fichier .htaccess )
 * Activer la compression ( Gzip ou Deflate ),
 * Définir un type MIME correct pour chaque type de fichier utilisé,
 * Optimiser la mise en cache navigateur
 * Supprimer les Etags
 
* Sécurité :
 * chaque répertoire doit contenir un fichier index.php - vide s'il n'existe pas. 
 * Dans le .htaccess, protéger les index de répertoire : deux précautions valent mieux qu'une.
 
* Divers :
 * Personnaliser les pages d'erreurs les plus courantes ( 404, 403, 500 ).

==

* Références & outils :
 * [Conventions WordPress sur la déclaration des thèmes](http://codex.wordpress.org/Theme_Development#Theme_Stylesheet "Explications sur le Codex")
 * [PageSpeed](http://developers.google.com/speed/pagespeed/insights) ( existe également en extention pour Chrome et Firefox, ainsi qu'en module pour Apache et Nginx ).
 * [WebPageTest](http://www.webpagetest.org)
 * [GTMetrix](http://gtmetrix.com/)
 * [Pingdom Tools]](http://tools.pingdom.com/fpt/)
 * [jsCompress](http://jscompress.com/ "jscompress.com")
 * [CssCompressor](http://www.cssdrive.com/index.php/main/csscompressor "cssdrive.com")
 * [les checklists d'Opquast](http://checklists.opquast.com/fr/ "Open Quality Standard")
 * [WebDev Checklist](http://webdevchecklist.com/)
 * [bpi-checklist](https://github.com/inseo/bpi-checklist/blob/master/checklist.md "La checklist des 'Bonnes Pratiques de l'intégration Web'")
 * [.htaccess sur Seo-Mix](http://www.seomix.fr/guide-htaccess-performances-et-temps-de-chargement/)