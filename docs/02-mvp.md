III. Mission 3 : Définir votre MVP
catégories :
a) Fonctionnalités obligatoires :
MVP
[ ] afficher ma liste ;
[ ] créer, modifier, supprimer un livres (c'est différentes fonctions);
[ ] rechercher un livre ;
[ ] enregistrer un prêt ;
[ ] emprunter un livre ;

b) Fonctionnalités bonus :
Bonus
[ ] notifications ;
[ ] images des livres + auteur ;
[ ] Sections descriptions de livres ;
[ ] les différente liste(par thème genre une liste science fiction )
1. CHECKPOINT 1 : Faites valider votre périmètre ;
Validé par le prof.

IV. Mission 4 : Identifier les données
1. Les entités :
    + Les Utilisateurs
    + Les livres
    + Les Prêts
    + Les retours
    + Les listes ;

2. Leurs propriétés :
+ Les Utilisateurs :
    * id
    * nom
    * numéro de tel
    * mail
+ Livre
    * id
    * nom
    * auteur
    * maison d'édition
+ Les prêts 
    * id
    * date_de_pret
    * date_de_retour
+ les retours
    * id
    * date_de_pret
    * date_de_retour
+ Les listes
    * id

3. Leurs relations :
    * Les utilisateurs + livres = emprunter(), restituer(), rechercher()
    * Les utilisateur + listes = rechercher
    * Les listes + livres = rajouter(), supprimer() 
    * les prêts + les utilisateur = regarder, faire un prêt()
    * Les retours + les utilisateur = regarder, faire un prêt()

V. Mission 5 : Construire le MCD
+ J'ai utilisé MCD-creator.