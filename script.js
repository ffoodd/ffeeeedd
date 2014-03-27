/* Tester l’activation du js
 * @author Gaël Poupard
 * @see https://twitter.com/ffoodd_fr
 * @note Inspiré par Modernizr
 * @author http://modernizr.com/
 * @see http://modernizr.github.io/Modernizr/annotatedsource.html#section-103
*/
document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/g,'')+' js';
