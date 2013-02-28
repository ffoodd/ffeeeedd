ffeeeedd
========

Ce projet est sous [CC BY 3.0 FR] (http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").

Un projet embryonnaire
----------------------

Ce thème n'a pour prétention de départ que d'améliorer mon flux de travail et de création de thèmes WordPress. Beaucoup de bonnes intentions mais la qualité et le résultat ne sont pas encore suffisants !

L'objectif à moyen terme et de garder à disposition une base saine et souple de thème WordPress, enrichie de composants spécifiques récoltés, conçus et améliorés au fil de mes pérégrinations professionnelles.

Un maitre-mot : qualité !
-------------------------

L'intérêt - personnel - de ce projet et d'avoir une base riche : micro-données, performances, sémantique, robustesse. Des choses indispensables qui ne devraient pas être recrées lors de chaque projet, mais présent à la racine de chacun.

De plus, une approche accessible est amenée avec le soutien et les conseils de [Kloh](http://www.kloh.fr/ "Kloh.fr"), expert accessiweb.

Organisation générale
---------------------

Afin de faciliter la personnalisation de ce thème et son adaaptation à chaque projet, un micro-framework css est utilisé - basé sur [Knacss](http://knacss.com/ "Knaccs.com") par l'excellent [Raphaël Goetter](http://goetter.fr/ "Goetter.fr"). 

La version utilisée sur ffeeeedd est cependant légèrement retouchée, et sera enrichie de quelques astuces personnelles. 

Les css sont donc architecturés comme suit :

* reset.css
* structure.css
* formulaires.css
* kit.css
* ie.css
* impression.css
* debug.css

Les trois premiers fichiers sont librement inspirés de Knacss et représentent une base solution, qui est destinée à ne pas être modifiée. Conformément aux pratiques en vigueur à l'heure actuelle, leur rédaction est fortement influencée par [OOCSS](http://oocss.org/ "oocss.org") et [SMACSS](http://smacss.com/ "smacss.com").

Le kit.css - et par extension ie.css - sont la partie personnelle, propre à chaque projet : on y définit les typographies, l'échelle typographique et le rythme vertical, ainsi que tous les éléments originaux. Étant donné leur vocation à être orginiaux et dépendants du projet, ces deux fichiers devront être complétés en suivant la méthode [BEM](http://bem.info/method/ "BEM.info"). qui s'avèrera plus souple, plus simple, plus performante et plus maintenable. 

Impression.css parle de lui-même, et debug.css est quant à lui fortement inspiré de [holmes.css](http://www.red-root.com/sandbox/holmes/ "Holmes.css"), qui a pour vocation de repérer et signaler les éléments obsolètes ou dépréciés, les attributs indispensables mais absents, et ce genre de détails repérables en css et garants d'un seuil de qualité optimal. Ce dernier fichier devrait être retiré lors d'un passage en production.

Évolution à venir
-----------------

Parmi les projets attachés à ffeeeedd, une version de base ( avant l'intégration du kit, e.g. ) pouvant servir à créer des wireframes fait son chemin dans mon petit crâne.

À suivre...


