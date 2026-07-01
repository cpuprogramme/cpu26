DONE
----
 - passer en dotclear moderne
 - virer l'autoplay du cpu-audio : trop pénible. 

TODO
----

 - résoudre le problème des file_url doublés et avoir le $attach_f accessible pour cpuAudioPublic
  - moderniser 
 	- passer les CSS en nested notation
 - regrouper, simplifier les règles @media
 - refaire la liste des catégories sidebar, pour inclure la sous catégorie Chroniques
 - Mettre les images en vignette plutôt qu'en background
 - Reconstruire le layout depuis la une
 - passer le formulaire de commentaires en `<details>`
 - virer .calque ?
 - tester avec une page info en une
 - tester avec un Teaser mis en exergue
 - vérifier que `issue57()` dans le code javascript marche toujours
 - Animer le liseret détachant les blocs header audio
 - Ajouter des images de fond (uniquement sur écrans larges)
 	- avec un effet css parallax 
 - restyliser le champ recherche avec la couleur recherche
 - restyliser le header de résultat de recherche avec la couleurw


Vérifier sur :
 - Première émission
 - page des chroniques, (liste des types de chroniques)



Bugs dotclear notés : 
 - https://codeberg.org/Dotclear/dotclear/issues/164 `widgetcontainerformat` n'est jamais exploitée.
 - https://codeberg.org/Dotclear/dotclear/issues/165 Pouvoir ré-accéder aux variables front `$attach_f` et `$attach_i` 
 - url `/tags` n'est plus là

Autres bugs notés :
 - Pas possible d'upgrader la css avec `light-dark()` car les webcomponents restent en light-mode