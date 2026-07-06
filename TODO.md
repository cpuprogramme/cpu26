DONE
----
 - passer en dotclear moderne
 - mettre les images d'illustrations e nvignette plutôt qu'en fond de texte
 - virer l'autoplay du cpu-audio : trop pénible
 - breadcrumb à tous les étages
 - banner incluant pré-écoutes
 - navigation en sidebar dépliables
 - commentaire en pop-up

TODO
----

 - uniformiser le padding left des éléments en sidebar
 - stylier les boutons de formulaire (pas d'arrondi, plus de padding horizontal)
 - dans les banner players, déplacer le player audio sous l'image et le titre en petite largeur
 - insérer le logo de la radio en svg ?
 - tester avec une page info en une  
 - tester avec un Teaser mis en exergue
 - Animer le liseret détachant les blocs header audio
 - Ajouter des images de fond (uniquement sur écrans larges)
 	- avec un effet css parallax ? https://css-tricks.com/bringing-back-parallax-with-scroll-driven-css-animations/
 - restyliser le champ recherche avec la couleur recherche
 - Si la recherche est vide, proposer des suggestions : tags, séries, catégories, etc


Vérifier sur :
 - Première émission
 - page des chroniques, (liste des types de chroniques)
 - vérifier que `issue57()` dans le code javascript marche toujours



Bugs dotclear et tickets ouverts : 
 - https://codeberg.org/Dotclear/dotclear/issues/164 `widgetcontainerformat` n'est jamais exploitée.
 - https://codeberg.org/Dotclear/dotclear/issues/165 Pouvoir ré-accéder aux variables front `$attach_f` et `$attach_i` , et donc -réécrire le plugin dotclear de CPUaudio
 - url `/tags` n'est plus là
 - https://codeberg.org/Dotclear/dotclear/issues/166 Créer un tag `<tpl:SysIfComment>`

Autres bugs notés :
 - Pas possible d'upgrader la css avec `light-dark()` car les webcomponents restent en light-mode