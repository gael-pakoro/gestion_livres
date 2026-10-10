-- Extension pour UUID
CREATE EXTENSION IF NOT EXISTS "pgcrypto";


CREATE TABLE liste (
    id_liste UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    nom VARCHAR(255)
    id_utilisateur UUID,
    CONSTRAINT fk_liste_utilisateur FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
);

CREATE TABLE liste_livre (
    id_liste UUID REFERENCES liste(id_liste) ON DELETE CASCADE,
    id_livre UUID REFERENCES livre(id_livre) ON DELETE CASCADE,
    PRIMARY KEY (id_liste, id_livre)
);


CREATE TABLE utilisateur (
    id_utilisateur UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    nom VARCHAR(255),
    numero_telephone VARCHAR(20),
    mail VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255)
);

CREATE TABLE livre (
    id_livre UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    nom VARCHAR(255),
    auteur VARCHAR(255),
    maison_d_edition VARCHAR(255),
    id_liste UUID,
    CONSTRAINT fk_livre_liste FOREIGN KEY (id_liste)
        REFERENCES liste(id_liste) ON DELETE SET NULL
);

CREATE TABLE pret (
    id_pret UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    date_de_pret TIMESTAMP,
    date_de_retour TIMESTAMP,
    id_utilisateur UUID,
    id_livre UUID,

    CONSTRAINT fk_pret_utilisateur FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,

    CONSTRAINT fk_pret_livre FOREIGN KEY (id_livre)
        REFERENCES livre(id_livre) ON DELETE CASCADE
);

CREATE TABLE emprunt (
    id_emprunt UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    date_de_pret TIMESTAMP,
    date_de_retour TIMESTAMP,
    id_utilisateur UUID,
    id_livre UUID,

    CONSTRAINT fk_emprunt_utilisateur FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,

    CONSTRAINT fk_emprunt_livre FOREIGN KEY (id_livre)
        REFERENCES livre(id_livre) ON DELETE CASCADE
);
