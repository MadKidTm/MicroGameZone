DROP TABLE IF EXISTS PLATEFORME CASCADE;
DROP TABLE IF EXISTS GENRE CASCADE;
DROP TABLE IF EXISTS CLIENT CASCADE;
DROP TABLE IF EXISTS JEU CASCADE;
DROP TABLE IF EXISTS EDITEUR CASCADE;
DROP TABLE IF EXISTS DEVELOPPEUR CASCADE;
DROP TABLE IF EXISTS AVIS CASCADE;
DROP TABLE IF EXISTS COMMANDE CASCADE;
DROP TABLE IF EXISTS VENTE CASCADE;
DROP TABLE IF EXISTS STOCK CASCADE;
DROP TABLE IF EXISTS GENRE_JEU CASCADE;


CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;

CREATE TABLE PLATEFORME (
  nom_plateforme VARCHAR NOT NULL,
  date_de_sortie DATE,
  PRIMARY KEY (nom_plateforme)  
);

CREATE TABLE GENRE (
    libelle VARCHAR NOT NULL,
    description VARCHAR,
    PRIMARY KEY(libelle)
);

CREATE TABLE CLIENT (
    email VARCHAR NOT NULL,
    mot_de_passe VARCHAR NOT NULL,
    nom VARCHAR,
    prenom VARCHAR,
    adresse VARCHAR,
    CONSTRAINT email_chk CHECK (((email)::text ~* '^[0-9a-zA-Z._-]+@[0-9a-zA-Z._-]{2,}[.][a-zA-Z]{2,4}$'::text)),
    PRIMARY KEY (email)
);

CREATE TABLE EDITEUR (
    id INTEGER NOT NULL,
    nom VARCHAR NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE DEVELOPPEUR (
    id INTEGER NOT NULL,
    nom VARCHAR NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE JEU (
    id INTEGER NOT NULL,
    prix FLOAT NOT NULL,
    description VARCHAR,
    image VARCHAR NOT NULL,
    titre VARCHAR NOT NULL,
    id_editeur INTEGER NOT NULL,
    id_developpeur INTEGER NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY(id_editeur) REFERENCES editeur(id),
    FOREIGN KEY(id_developpeur) REFERENCES developpeur(id)
);

CREATE TABLE AVIS (
    id INTEGER NOT NULL,
    texte VARCHAR,
    note INTEGER NOT NULL,
    id_jeu INTEGER NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id)
);

CREATE TABLE COMMANDE (
    num_commande INTEGER NOT NULL,
    date_commande DATE NOT NULL,
    email_client VARCHAR NOT NULL,
    PRIMARY KEY (num_commande),
    FOREIGN KEY (email_client) REFERENCES client(email)
);

CREATE TABLE VENTE (
    id_jeu INTEGER NOT NULL,
    num_commande INTEGER NOT NULL,
    qte INTEGER NOT NULL,
    PRIMARY KEY (id_jeu, num_commande),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id),
    FOREIGN KEY (num_commande) REFERENCES commande(num_commande)
);

CREATE TABLE STOCK (
    nom_plateforme VARCHAR NOT NULL,
    id_jeu INTEGER NOT NULL,
    qte INTEGER NOT NULL,
    PRIMARY KEY (nom_plateforme, id_jeu),
    FOREIGN KEY (nom_plateforme) REFERENCES plateforme(nom_plateforme),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id) 
);

CREATE TABLE GENRE_JEU (
    id_jeu INTEGER NOT NULL,
    libelle_genre VARCHAR NOT NULL,
    PRIMARY KEY (id_jeu, libelle_genre),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id),
    FOREIGN KEY (libelle_genre) REFERENCES genre(libelle)
);