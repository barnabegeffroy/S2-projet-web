-- ##############################################################
-- # Script SQL
-- # Author: Groupe 35
-- # Function: Création de la base de données du projet web
-- ###############################################################

-- If tables already exists


DROP TABLE IF EXISTS Utilisateur;

CREATE TABLE Utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    password VARCHAR(256) NOT NULL,
    birthday DATE,
    mail VARCHAR(256) NOT NULL,
    profilePicture INTEGER,
    telephone VARCHAR(10),
    noteMoyenne FLOAT
);
DROP TABLE IF EXISTS Annonce;

CREATE TABLE Annonce (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    idUtilisateur INTEGER,
    datePublication DATE NOT NULL,
    duree TIME,
    description VARCHAR,
    photo INTEGER,
    lieu VARCHAR(256),
    estDisponible BOOLEAN,
    CONSTRAINT fk_annonce FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(id)

);

DROP TABLE IF EXISTS Favoris;

CREATE TABLE Favoris (
    idUtilisateur INTEGER NOT NULL,
    idAnnonce INTEGER NOT NULL,
    PRIMARY KEY (idUtilisateur, idAnnonce),
    CONSTRAINT cle_etr_utilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(id),
    CONSTRAINT cle_etr_annonce FOREIGN KEY (idAnnonce) REFERENCES Annonce(id)
);


DROP TABLE IF EXISTS Notation;

CREATE TABLE Notation (
    id SERIAL PRIMARY KEY,
    idEmetteur INTEGER NOT NULL,
    idReceveur INTEGER NOT NULL,
    valeur FLOAT,
    CONSTRAINT fk_notation FOREIGN KEY (idEmetteur) REFERENCES Utilisateur(id)
);

DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    id SERIAL PRIMARY KEY,
    idEmetteur INTEGER NOT NULL,
    idReceveur INTEGER NOT NULL,
    datePublication DATE NOT NULL,
    description VARCHAR,
    CONSTRAINT fk_message FOREIGN KEY (idEmetteur) REFERENCES Utilisateur(id),
    CONSTRAINT fk_message FOREIGN KEY (idReceveur) REFERENCES Utilisateur(id)
);

DROP TABLE IF EXISTS Image;

CREATE TABLE Image (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    adresse VARCHAR(256) NOT NULL,
    hauteur INTEGER,
    largeur INTEGER
);

DROP TABLE IF EXISTS Commentaire;

CREATE TABLE Commentaire (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    idEmetteur INTEGER NOT NULL,
    idReceveur INTEGER NOT NULL,
    datePublication DATE NOT NULL,
    CONSTRAINT fk_commentaire FOREIGN KEY (idEmetteur) REFERENCES Utilisateur(id)
);

DROP TABLE IF EXISTS Reservation;

CREATE TABLE Reservation (
    idAnnonce INTEGER NOT NULL,
    idUtilisateur INTEGER NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    CONSTRAINT pk_reservation PRIMARY KEY (idAnnonce,dateDebut,dateFin),
    CONSTRAINT fk_annonce_reservation FOREIGN KEY (idAnnonce) REFERENCES Annonce(id),
    CONSTRAINT fk_user_reservation FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(id)
);

DROP TABLE IF EXISTS Localisation;

CREATE TABLE Localisation (
    lattitudeDegre FLOAT NOT NULL,
    lattitudeMinute FLOAT NOT NULL,
    longitudeDegre FLOAT NOT NULL,
    longitudeMinute FLOAT NOT NULL,
    CONSTRAINT pk_localisation PRIMARY KEY (lattitudeDegre,lattitudeMinute,longitudeDegre,longitudeMinute)
);

GRANT all privileges ON Utilisateur TO administrateur;
GRANT all privileges ON Favoris TO administrateur;
GRANT all privileges ON Annonce TO administrateur;
GRANT all privileges ON Notation TO administrateur;
GRANT all privileges ON Message TO administrateur;
GRANT all privileges ON Image TO administrateur;
GRANT all privileges ON Commentaire TO administrateur;
GRANT all privileges ON Reservation TO administrateur;
GRANT all privileges ON Localisation TO administrateur;