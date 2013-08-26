ffeeeedd
========

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR] (http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*

Qu'est-ce que c'est ?
---------------------

Ce thème n'a pour prétention de départ que d'améliorer mon flux de travail et de création de thèmes WordPress. Beaucoup de bonnes intentions mais reste à produire la qualité !

L'objectif à moyen terme est de garder à disposition une base saine et souple de thème WordPress, enrichie de composants spécifiques récoltés, conçus et améliorés au fil de mes pérégrinations professionnelles.

Pourquoi ça existe ?
--------------------

L'intérêt - personnel - de ce projet est d'avoir une base riche : micro-données, performances, sémantique, robustesse. Des choses indispensables qui ne devraient pas être recrées lors de chaque projet, mais présentes à la racine de chacun. Mon capital WordPress, en quelque sorte.

De plus, une approche accessible est amenée avec le soutien et les conseils de [Kloh](http://www.kloh.ch/ "Kloh.ch"), expert accessiweb.

Mode d'emploi
-------------

Afin de faciliter la personnalisation de ce thème et son adaptation à chaque projet, un micro-framework css est utilisé - basé sur [Knacss](http://knacss.com/ "Knaccs.com") par l'excellent [Raphaël Goetter](http://goetter.fr/ "Goetter.fr"). La version utilisée sur ffeeeedd est cependant légèrement retouchée, et sera enrichie de quelques astuces personnelles.

De plus un important travail de normalisation a été effectué : [une convention complète a été rédigée](https://github.com/ffoodd/Convention "La convention sur GitHub"), qui comprend les règles de nommage, les chartes d'écriture pour les langages utilisés et quelques explications.

1. Installer le thème ffeeeedd et ses thèmes enfants :
 * [ffeeeedd--prototype](https://github.com/ffoodd/ffeeeedd--prototype)
 * [ffeeeedd--developpement](https://github.com/ffoodd/ffeeeedd--developpement)
 * [ffeeeedd--production](https://github.com/ffoodd/ffeeeedd--production)
2. Si besoin, importer du contenu factice : utiliser celui proposé par WordPress dans les [Theme Unit Test](http://codex.wordpress.org/Theme_Unit_Test).
3. Définir "ffeeeedd--prototype" comme thème actif pour prototyper l'ensemble du site.
 * Travailler dans `prototype.css` pour personnaliser le rythme vertical,
 * Ajouter ou modifier les zones et contenus à afficher : en premier lieu certains blocs seront factices, à savoir en HTML dans les templates de ffeeeedd,
 * Appliquer les classes définies dans `structure.css` pour agencer les blocs (il est possible d'ajouter des classes dans `structure--etendue.css`),
 * Prévoir la version mobile dès cette étape, dans `structure--etendue.css`.
4. Définir "ffeeeedd--developpement" comme thème actif :
 * Rapatrier les ajouts et modifications effectués en phase de prototypage;
 * Activer les constantes `WP_DEBUG` et `SCRIPT_DEBUG` en les passant à `true`;
 * Créer les fonctions spécifiques en respectant les conventions d'écriture et les bonnes pratiques WordPress;
 * Vérifier les points remontés par `debug.css` régulièrement;
 * Personnaliser le `kit.css` : couleurs, typographies, classes spécifiques, etc;
 * Ajouter les scripts utiles, ainsi que les plugins - puis les personnaliser en suivant les bonnes pratiques actuelles;
 * Dans le cas de création de template ou de modification de templates, pensez à modifier les traductions s'il y en a (`/lang/fr_FR.mo` pour le français).
 * Concaténer et minifier les fichiers css (vers `style.min.css`, en omettant `debug.css`) et javascript (vers `script.min.js`) puis passer la constante `SCRIPT_DEBUG` à `false` afin de charger les fichiers minifiés.
 * Effectuer une recette complète du site :
  * Utiliser le plugin [Theme-Check](http://wordpress.org/plugins/theme-check/),
  * Auditer à l'aide des [outils d'Opquast](http://opquast.com/fr/#outils),
  * Tester sur tous les navigateurs cibles,
  * Appliquer les conseils de sécurité et de performances préconisés.
 * Concaténer et minifier les fichiers css (vers `style.min.css`, en omettant `debug.css`) et javascript (vers `script.min.js`) dans l'ordre suivant, pour les CSS :
  * `base.css` (ffeeeedd)
  * `structure.css` (ffeeeedd)
  * `formulaires.css` (ffeeeedd)
  * `navigation.css` (ffeeeedd)
  * `structure--etendue.css` (ffeeeedd--prototype)
  * `typographie.css` (ffeeeedd--prototype)
  * `adaptation.css` (ffeeeedd--prototype)
  * `modules.css` (ffeeeedd--developpement)
  * `ie.css` (ffeeeedd--developpement)
  * `impression.css` (ffeeeedd--developpement)
  * Commenter les appels dans `style.css` du thème parent.
6. Copier vers "ffeeeedd--production" :
 * les fichiers php ajoutés ou modifiés;
 * les fichiers de traduction s'ils ont été modifiés;
 * les fichiers `.max.`.
7. Définir "ffeeeedd--production" comme thème actif :
 * Ajouter `editeur.css` dans le répertoire "css" (en y insérant le contenu de `typographie.css` personnalisé dans "ffeeeedd--production", ainsi que la typographie appellée dans `modules.css`.
8. Effectuer une recette générale :
 * Utiliser le plugin Theme-Check,
 * Auditer à l'aide des checklists d'Opquast,
 * Tester sur tous les navigateurs cibles,
 * Appliquer les conseils de sécurité et de performances préconisés (notamment concernant le fichier `.htaccess`).

==

Évolutions
----------

- [ ] Déplacer certaines fonctions (partage social, SEO) vers des plugins afin de ne pas créer de dépendance à ffeeeedd,
- [ ] Créer une flotte de plugin "ffeeeedd",
- [ ] Utiliser des transients pour certaines données,
- [x] Améliorer le worklow afin de ne pas avoir à modifier le thème parent,
- [ ] Proposer à des personnes compétentes d'auditer le thème et le projet,
- [ ] Créer une liste de plugins recommandés, avec entre autres :
 - [Theme Check](http://wordpress.org/plugins/theme-check/)
 - [Google Sitemap Generator](http://wordpress.org/plugins/google-sitemap-generator/)
 - [ACF](http://www.advancedcustomfields.com/ 'Advanced Custom Fields')
- [ ] Créer une checklist qualité / méthodologie pour faciliter le suivi de chantier,
- [ ] Audit A11y.