--##############################################################
--# Script SQL
--# Author: Groupe 29
--# Function: Création des relations astro_personne et astro_signe
--###############################################################
-- If tables already exist
DROP TABLE IF EXISTS astro_personne;

DROP TABLE IF EXISTS astro_signe;

CREATE TABLE astro_signe (
    nom_signe_astro VARCHAR(10) CONSTRAINT dom_nom_signe_astro CHECK(
        nom_signe_astro IN (
            'Bélier',
            'Taureau',
            'Gémeaux',
            'Cancer',
            'Lion',
            'Vierge',
            'Balance',
            'Scorpion',
            'Sagittaire',
            'Capricorne',
            'Verseau',
            'Poisson'
        )
    ) PRIMARY KEY,
    jour_debut INTEGER,
    mois_debut INTEGER,
    jour_fin INTEGER,
    mois_fin INTEGER,
    element VARCHAR(10) CONSTRAINT dom_element CHECK(element IN ('Air','Terre','Eau','Feu'))
);

CREATE TABLE astro_personne (
    num_enregistrement VARCHAR CONSTRAINT cleprim_personne PRIMARY KEY,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    email VARCHAR(40),
    nom_signe_astro VARCHAR(10),
    CONSTRAINT cle_etr_Personne FOREIGN KEY (nom_signe_astro) REFERENCES astro_signe(nom_signe_astro)
);

INSERT INTO astro_signe VALUES('Bélier',21,3,20,4,'Feu');
INSERT INTO astro_signe VALUES('Taureau',21,4,20,5,'Terre');
INSERT INTO astro_signe VALUES('Gémeaux',22,5,21,6,'Air');
INSERT INTO astro_signe VALUES('Cancer',22,6,22,7,'Eau');
INSERT INTO astro_signe VALUES('Lion',23,7,22,8,'Feu');
INSERT INTO astro_signe VALUES('Vierge',23,8,22,9,'Terre');
INSERT INTO astro_signe VALUES('Balance',23,9,22,10,'Air');
INSERT INTO astro_signe VALUES('Scorpion',23,10,22,11,'Eau');
INSERT INTO astro_signe VALUES('Sagittaire',23,11,21,12,'Feu');
INSERT INTO astro_signe VALUES('Capricorne',22,12,20,1,'Terre');
INSERT INTO astro_signe VALUES('Verseau',21,1,18,2,'Air');
INSERT INTO astro_signe VALUES('Poisson',19,2,20,3,'Eau');

GRANT all privileges ON astro_personne TO tpcurseurs;
GRANT all privileges ON astro_signe TO tpcurseurs;