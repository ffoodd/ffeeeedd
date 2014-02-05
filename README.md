ffeeeedd
========

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
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

Le travail sur les styles se fait désormais grâce à Sass et Compass. Un fichier de configuration du projet est fourni mais vous pouvez évidemment l’adapter à vos propres façons de travailler.

De plus un important travail de normalisation a été effectué : [une convention complète a été rédigée](https://github.com/ffoodd/Convention "La convention sur GitHub"), qui comprend les règles de nommage, les chartes d'écriture pour les langages utilisés et quelques explications. Ce sont également des choses à adapter à vos propres pratiques.

1. Installer le thème ffeeeedd et son thème enfant [ffeeeedd--sass](https://github.com/ffoodd/ffeeeedd--sass)
2. Si besoin, importer du contenu factice : utiliser celui proposé par WordPress dans les [Theme Unit Test](http://codex.wordpress.org/Theme_Unit_Test).
3. Définir "ffeeeedd--sass" comme thème actif.
 * Créer les fonctions spécifiques en respectant les conventions d'écriture et les bonnes pratiques WordPress;
 * Vérifier les points remontés par `a11y.css` régulièrement;
 * Personnaliser les fichiers partiels dans `sass/partials/` : couleurs, typographies, classes spécifiques, etc;
 * Ajouter les scripts utiles, ainsi que les plugins - puis les personnaliser en suivant les bonnes pratiques actuelles;
 * Dans le cas de création de template ou de modification de templates, pensez à modifier les traductions s'il y en a (`/lang/fr_FR.mo` pour le français).
8. Effectuer une recette générale :
 * Utiliser le plugin [Theme-Check](http://wordpress.org/plugins/theme-check/),
 * Auditer à l'aide des [outils d'Opquast](http://opquast.com/fr/#outils),
 * Tester sur tous les navigateurs cibles,
 * Appliquer les conseils de sécurité et de performances préconisés (notamment concernant le fichier `.htaccess`).

==

Évolutions
----------

- [x] Déplacer certaines fonctions (partage social, SEO) vers des plugins afin de ne pas créer de dépendance à ffeeeedd,
- [x] Créer une flotte de plugin "ffeeeedd",
- [ ] Utiliser des transients pour certaines données,
- [x] Améliorer le worklow afin de ne pas avoir à modifier le thème parent,
- [ ] Proposer à des personnes compétentes d'auditer le thème et le projet,
- [ ] Créer une liste de plugins recommandés, avec entre autres :
 - [Theme Check](http://wordpress.org/plugins/theme-check/)
 - [Google Sitemap Generator](http://wordpress.org/plugins/google-sitemap-generator/)
 - [ACF](http://www.advancedcustomfields.com/ 'Advanced Custom Fields')
 - [WP Rocket](http://wp-rocket.me/)
 - [Plugin Security Checker]('http://blog.secupress.fr/plugin-security-checker-nutilisez-pas-plugins-vulnerables-118.html')
 - [BBQ]('http://blog.secupress.fr/block-bad-queries-ou-bbq-pour-les-intimes-79.html')
 - [BAW Anti CSRF]('http://blog.secupress.fr/anti-csrf-ou-comment-se-premunir-de-la-faille-csrf-sous-wordpress-85.html')
 - [BAW More Secure Login]('http://blog.secupress.fr/more-secure-login-ajoutez-une-authentification-forte-a-votre-site-104.html')
 - [Move Login]('http://blog.secupress.fr/move-login-changer-url-page-login-32.html')
- [ ] Créer une checklist qualité / méthodologie pour faciliter le suivi de chantier,
- [x] Audit A11y.
