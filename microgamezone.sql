-----------------            BDD - MicroGameZone            -----------------
------------    Groupe Thomas CIANFARANI et Alexandre TOMASIA    ------------


-----------------------------------------------------------------------------
-- Clear previous information.
-----------------------------------------------------------------------------
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


-----------------------------------------------------------------------------
-- Initialize the structure.
-----------------------------------------------------------------------------
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
	ville VARCHAR,
	code_postal VARCHAR
    CONSTRAINT email_chk CHECK (((email)::text ~* '^[0-9a-zA-Z._-]+@[0-9a-zA-Z._-]{2,}[.][a-zA-Z]{2,4}$'::text)),
    PRIMARY KEY (email)
);

CREATE TABLE EDITEUR (
    id SERIAL NOT NULL ,
    nom VARCHAR NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE DEVELOPPEUR (
    id SERIAL NOT NULL ,
    nom VARCHAR NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE JEU (
    id SERIAL NOT NULL  ,
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
    id SERIAL NOT NULL,
    texte VARCHAR,
    note INTEGER NOT NULL,
    id_jeu INTEGER NOT NULL,
	email_client VARCHAR NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id),
	FOREIGN KEY (email_client) REFERENCES client(email)
);

CREATE TABLE COMMANDE (
    num_commande SERIAL NOT NULL,
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


-----------------------------------------------------------------------------
-- Insert some data.
-----------------------------------------------------------------------------
INSERT INTO DEVELOPPEUR (nom) 
VALUES 
    ('Rockstar Games'),
    ('Ubisoft Montreal'),
    ('BioWare'),
    ('DICE');


INSERT INTO PLATEFORME (nom_plateforme, date_de_sortie)
    VALUES
    ('PS4', '2013-11-15'),
    ('XBOX ONE', '2013-11-22'),
    ('PC', NULL);

INSERT INTO EDITEUR (nom)
    VALUES
    ('Take Two'),
    ('Ubisoft'),
    ('Electronic Arts');

INSERT INTO GENRE (libelle)
    VALUES
    ('Action'),
    ('Plateforme'),
    ('RPG'),
    ('FPS'),
    ('Aventure'),
    ('TPS');

INSERT INTO JEU (titre, prix, description, image, id_editeur, id_developpeur)
    VALUES
    ('Red Dead Redemption 2', 60, 'jeu de ouf', 'dummy/link.jpg', 1, 1),
    ('Battlefield 5', 70, 'piou piou piou', 'dummy/link.jpg', 3, 4),
    ('Assasins Creed Black Odyssey', 60, 'grimpe grimpe grimpe', 'dummy/link.jpg', 2, 2);
	
INSERT INTO STOCK (nom_plateforme, id_jeu, qte) 
	VALUES 
	('PS4', 1, 10),
	('XBOX ONE', 1, 8),
	('PS4', 2, 5),
	('XBOX ONE', 2, 6),
	('PC', 2, 2),
	('PS4', 3, 4),
	('XBOX ONE', 3, 5),
	('PC', 3, 5);
	
INSERT INTO GENRE_JEU (id_jeu, libelle_genre) 
	VALUES
	(1, 'RPG'),
	(1, 'Action'),
	(1, 'TPS'),
	(1, 'Aventure'),
	(2, 'Action'),
	(2, 'FPS'),
	(3, 'Action'),
	(3, 'Plateforme'),
	(3, 'RPG'),
	(3, 'Aventure');
	
INSERT INTO CLIENT (email, mot_de_passe, nom, prenom, adresse, ville, code_postal) 
	VALUES 
	('gzelinsky@gmail.com', 'azertyuiop', 'Zelinsky', 'Guillermo', '123 Via del torino', 'Rimenez', '55432'),
	('thebeard@hotmail.com', 'stepbacks', 'Harden', 'James', '13 Big baller street', 'Houston', '35556'),
	('futuregoat@gmail.com', 'bigmoney', 'Williamson', 'Zion',  '200 Wherever I Live', 'New Orleans', '12312'),
	('joejohn@gmail.com', 'ranchlife', 'John', 'Joe',  '19 The Right Stuff', 'Pasadena', '44777'),
	('robthebot@gmail.com', 'blipbloup', 'Bot', 'Rob',  '99 Factory Street', 'Detroit', '99999');
	
INSERT INTO AVIS (texte, note, id_jeu, email_client) 
	VALUES
	('What a great game, wonderful!', 95, 1, 'gzelinsky@gmail.com'),
	('Cool...', 80, 1, 'thebeard@hotmail.com'),
	('So good!', 88, 1, 'futuregoat@gmail.com'),
	('Great game.', 92, 1, 'joejohn@gmail.com'),
	('A bit overrated but still very good...', 70, 1, 'robthebot@gmail.com'),
	('Its ok.', 50, 2, 'gzelinsky@gmail.com'),
	('Its good.', 70, 2, 'thebeard@hotmail.com'),
	('Its great.', 90, 2, 'joejohn@gmail.com'),
	('It sucks.', 23, 2, 'robthebot@gmail.com'),
	('I just love it.', 95, 3, 'gzelinsky@gmail.com'),
	('Fedex sim.', 40, 3, 'thebeard@hotmail.com'),
	('Cool game.', 80, 3, 'joejohn@gmail.com'),
	('One of the best of the franchise.', 88, 3, 'robthebot@gmail.com');
	
INSERT INTO COMMANDE (date_commande, email_client) 
	VALUES 
	('2013-11-15', 'gzelinsky@gmail.com'),
	('2019-12-28', 'futuregoat@gmail.com'),
	('2019-12-27', 'gzelinsky@gmail.com'),
	('2019-12-28', 'joejohn@gmail.com'),
	('2019-12-26', 'robthebot@gmail.com'),
	('2019-12-25', 'joejohn@gmail.com'),
	('2019-12-24', 'gzelinsky@gmail.com'),
	('2019-12-23', 'robthebot@gmail.com'),
	('2019-12-22', 'thebeard@hotmail.com');
	
INSERT INTO VENTE (id_jeu, num_commande, qte) 
	VALUES 
	(1, 1, 1),
	(2, 1, 1),
	(1, 2, 1),
	(3, 3, 1),
	(2, 4, 2),
	(1, 5, 1),
	(2, 6, 3),
	(3, 7, 1),
	(1, 8, 1),
	(1, 9, 2);
	
-----------------------------------------------------------------------------
-- Functions and triggers.
-----------------------------------------------------------------------------	

-- Obtenir les jeux ordonnés par nombre de ventes
DROP FUNCTION IF EXISTS get_games_ordered_by_sales();
CREATE OR REPLACE FUNCTION get_games_ordered_by_sales()
returns table (titre varchar, ventes bigint) 
AS 
$$		
	BEGIN RETURN QUERY
		SELECT jeu.titre, sum(qte)
		FROM jeu INNER JOIN vente 
		ON jeu.id = vente.id_jeu
		GROUP BY jeu.titre
		ORDER BY sum(qte) DESC;
	END
$$ LANGUAGE plpgsql;

-- Obtenir tous les jeux d’un éditeur
DROP FUNCTION IF EXISTS get_games_by_editor();
CREATE OR REPLACE FUNCTION get_games_by_editor(editor varchar)
returns table (editeur varchar, jeu varchar) 
AS 
$$		
	BEGIN RETURN QUERY
		SELECT editeur.nom, jeu.titre
		FROM jeu INNER JOIN editeur
		ON jeu.id_editeur = editeur.id
		WHERE editeur.nom = editor;
	END
$$ LANGUAGE plpgsql;

-- Obtenir le genre le plus répandu
DROP FUNCTION IF EXISTS get_most_popular_genre();
CREATE OR REPLACE FUNCTION get_most_popular_genre()
returns table (genre varchar, nb_jeux bigint) 
AS 
$$		
	BEGIN RETURN QUERY
		SELECT libelle_genre, count(id_jeu)
		FROM genre_jeu
		GROUP BY libelle_genre
		HAVING count(id_jeu) = (
			SELECT max(t.nbJeux)
			FROM (SELECT libelle_genre, count(id_jeu) as nbJeux 
				  FROM genre_jeu 
				  GROUP BY libelle_genre) 
		t);
	END
$$ LANGUAGE plpgsql;

-- Obtenir une liste de jeux classés par leur note (voir les jeux les mieux notés)
DROP FUNCTION IF EXISTS get_games_by_rating();
CREATE OR REPLACE FUNCTION get_games_by_rating()
returns table (jeu varchar, average_rating numeric) 
AS 
$$		
	BEGIN RETURN QUERY
		SELECT titre, avg(avis.note) as avgNotes
		FROM avis INNER JOIN jeu
		ON avis.id_jeu = jeu.id
		GROUP BY titre
		ORDER BY avgNotes DESC;
	END
$$ LANGUAGE plpgsql;

-- Obtenir le jeu le mieux noté d’un éditeur
DROP FUNCTION IF EXISTS get_best_game_of_editor();
CREATE OR REPLACE FUNCTION get_best_game_of_editor(editor varchar)
returns table (jeu varchar, average_rating numeric) 
AS 
$$		
	BEGIN RETURN QUERY
		SELECT titre, avg(avis.note)
		FROM jeu INNER JOIN avis
		ON jeu.id = avis.id_jeu
		GROUP BY titre
		HAVING avg(avis.note) = (SELECT max(avgNotes) 
								 FROM (SELECT titre, avg(avis.note) as avgNotes
									   FROM avis INNER JOIN jeu
									   ON avis.id_jeu = jeu.id	
									   INNER JOIN editeur
									   ON jeu.id_editeur = editeur.id
									   WHERE editeur.nom = editor 
									   GROUP BY titre
									   ORDER BY avgNotes DESC) 
		t);
	END
$$ LANGUAGE plpgsql;