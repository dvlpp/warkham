## Warkham::oracle

- trouver un moyen de passer un json + un template (cf exemples "Open source projects by Twitter" [ici](http://twitter.github.io/typeahead.js/examples/)) dans le cas remote==false
- dans le cas remote==true, idem pour le template : pour le json, il sera de la responsibilité du code fonctionnel
- dans les 2 cas, l'item json doit obligatoirement avoir un attribut "id".
- ajouter méthode allowCreate([bool c=false]) pour autoriser la création d'un nouvel item s'il n'existe pas dans le dataset (local ou remote). Dans le cas d'une création, le champ prend la valeur du text plutôt qu'un ID. Evidemment, cette option ne sera à activer que pour les cas simples (fonctionnellement) où un simple text suffit à créer un élément (une ville par exemple, mais pas une adresse)
- s'assurer (je crois que ce n'est pas le cas) que la value du champ posté soit bien l'id, et pas le text, sauf dans le cas d'une création. Au besoin, passer par un hidden.
- [JS] dans le cas (courant) de allowCreate(false), pour bloquer la sélection, on peut utiliser [cette méthode](http://stackoverflow.com/questions/14827576/twitter-bootstrap-typeahead-force-selection) 

## Warkham::choice

- gérer la méthode ->multiple()

## Warkham::textarea

- ajouter les JS [Bootstrap-wysiwyg](http://mindmup.github.io/bootstrap-wysiwyg/) et [jQueryRain](http://www.jqueryrain.com/?VYAvkzCv)
