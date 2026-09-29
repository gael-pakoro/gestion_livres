VI. Mission 6 : Passer du MCD au MLD
+ 
Utilisateur
---------
id_utilisateur PK
nom
numéro
email
+ 
Livre
---------
id_livre PK
nom
auteur
maison_edition
id_utilisateur FK
+ 
Liste
---------
id_liste PK
id_utilisateur FK
+ 
prêts
---------
id_prêt PK
date_de_pret
date_de_retour
id_utilisateur_preteur FK 
id_utilisateur_receveur FK
id_livre FK
+ 
Emprunt
---------
id_emprunt PK
date_de_pret
date_de_retour
id_utilisateur FK
id_livre FK