ffeeeedd
========

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR] (http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*

Qu'est-ce que c'est ?
---------------------

Ce thème n'a pour prétention de départ que d'améliorer mon flux de travail et de création de thèmes WordPress. Beaucoup de bonnes intentions mais reste à produire la qualité !

L'objectif à moyen terme et de garder à disposition une base saine et souple de thème WordPress, enrichie de composants spécifiques récoltés, conçus et améliorés au fil de mes pérégrinations professionnelles.

Pourquoi ça existe ?
--------------------

L'intérêt - personnel - de ce projet est d'avoir une base riche : micro-données, performances, sémantique, robustesse. Des choses indispensables qui ne devraient pas être recrées lors de chaque projet, mais présent à la racine de chacun.

De plus, une approche accessible est amenée avec le soutien et les conseils de [Kloh](http://www.kloh.fr/ "Kloh.fr"), expert accessiweb.

Comment ça marche ?
-------------------

Afin de faciliter la personnalisation de ce thème et son adaptation à chaque projet, un micro-framework css est utilisé - basé sur [Knacss](http://knacss.com/ "Knaccs.com") par l'excellent [Raphaël Goetter](http://goetter.fr/ "Goetter.fr"). La version utilisée sur ffeeeedd est cependant légèrement retouchée, et sera enrichie de quelques astuces personnelles.

1. Installer le thème ffeeeedd et ses thèmes enfants.
2. Si besoin, importer du contenu factice : utiliser celui proposé par WordPress dans les [Theme Unit Test](http://codex.wordpress.org/Theme_Unit_Test).
3. Définir "ffeeeedd--prototype" comme thème actif pour prototyper l'ensemble du site.
 * Travailler dans `prototype.css` pour personnaliser le rythme vertical,
 * Ajouter ou modifier les zones et contenus à afficher : en premier lieu certains blocs seront factices, à savoir en HTML dans les templates de ffeeeedd,
 * Appliquer les classes définies dans `structure.css` pour agencer les blocs (il est possible d'ajouterdes classes),
 * Prévoir la version mobile dès cette étape.
4. Transférer les ajouts de `prototype.css` vers `kit.css` dans ffeeeedd.
5. Définir "ffeeeedd--developpement" comme thème actif
 * Certaines fonctions et blocs devront être ajoutés ou créés à ce moment-là, afin de populer les blocs factices créés lors du prototypage,
 * Activer le mode `WP_DEBUG` de WordPress
 * Vérifier les points remontés par `debug.css` régulièrement,
 * Personnaliser le `kit.css` : couleurs, typographies, classes spécifiques...
 * Ajouter les scripts utiles, ainsi que les plugins.
 * Effectuer une recette complète du site (cf "Recette générale" ci-après).
6. Concaténer et minifier les fichiers css (vers `style.css`, en omettant `debug.css`) et javascript (vers `script.js`) et les placer dans "ffeeeedd--production".
7. Définir "ffeeeedd--production" comme thème actif.
8. Recette générale :
 * Utiliser le plugin Theme-Check,
 * Auditer à l'aide des checklists d'Opquast,
 * Tester sur tous les navigateurs cibles,
 * Appliquer les conseils de sécurité et de performances préconisés.

==

Évolutions
----------

- [ ] Déplacer certaines fonctions (partage social, SEO) vers des plugins afin de ne pas créer de dépendance à ffeeeedd,
- [ ] Créer une flotte de plugin "ffeeeedd",
- [ ] Utiliser des transients pour certaines données,
- [ ] Améliorer le worklow afin de ne pas avoir à modifier le thème parent,
- [ ] Proposer à des personnes compétentes d'auditer le thème et le projet,
- [ ] Créer un fichier `kit.html` permettant de personnaliser l'ensemble du `kit.css` directement,
- [ ] Créer une liste de plugins recommandés,
- [ ] Créer une checklist qualité / méthodologie pour faciliter le suivi de chantier,
- [ ] Audit A11y.