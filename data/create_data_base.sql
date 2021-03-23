--##############################################################
--# Script SQL
--# Author: Groupe 35
--# Function: Création de la base de données du projet web
--###############################################################

-- If tables already exists
DROP TABLE IF EXISTS Utilisateur;

CREATE TABLE Utilisateur (
    id INTEGER CONSTRAINT user_unique_id PRIMARY KEY,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    password VARCHAR(256) NOT NULL,
    birthday DATE, --OU DATETIME
    mail VARCHAR(256) NOT NULL,
    profilePicture FILESTREAM,
    telephone VARCHAR(10),
    noteMoyenne FLOAT
);

DROP TABLE IF EXISTS Favoris;

CREATE TABLE Favoris (
    idUtilisateur INTEGER NOT NULL,
    idAnnonce INTEGER NOT NULL,
    PRIMARY KEY (idUtilisateur, idAnnonce),
    CONSTRAINT cle_etr_utilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(id),
    CONSTRAINT cle_etr_annonce FOREIGN KEY (idAnnonce) REFERENCES Annonce(id),
);

DROP TABLE IF EXISTS Annonce;

CREATE TABLE Annonce (
    id INTEGER CONSTRAINT annonce_unique_id UNIQUE PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    idUtilisateur INTEGER CONSTRAINT fk_annonce FOREIGN KEY REFERENCES Utilisateur(id),
    datePublication DATE NOT NULL,
    duree TIME,
    description VARCHAR,
    photo FILESTREAM,
    lieu VARCHAR(256),
    estDisponible BOOLEAN,

);

DROP TABLE IF EXISTS Notation;

CREATE TABLE Notation (
    id INTEGER CONSTRAINT notation_unique_id UNIQUE PRIMARY KEY,
    idEmetteur INTEGER CONSTRAINT fk_notation FOREIGN KEY REFERENCES Utilisateur(id),
    idReceveur INTEGER NOT NULL,
    valeur FLOAT,
);

DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    id INTEGER CONSTRAINT message_unique_id UNIQUE PRIMARY KEY,
    idEmetteur INTEGER CONSTRAINT fk_message FOREIGN KEY REFERENCES Utilisateur(id),
    idReceveur INTEGER CONSTRAINT fk_message FOREIGN KEY REFERENCES Utilisateur(id),
    datePublication DATE NOT NULL,
    description VARCHAR,
);

DROP TABLE IF EXISTS Image;

CREATE TABLE Image (
    id INTEGER CONSTRAINT image_unique_id UNIQUE PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    hauteur INTEGER,
    largeur INTEGER,
);

DROP TABLE IF EXISTS Commentaire;

CREATE TABLE Commentaire (
    id INTEGER CONSTRAINT commentaire_unique_id UNIQUE PRIMARY KEY,
    -- titre VARCHAR(100) NOT NULL,
    description VARCHAR NOT NULL,
    idEmetteur INTEGER CONSTRAINT fk_commentaire FOREIGN KEY REFERENCES Utilisateur(id),
    idReceveur INTEGER NOT NULL,
    datePublication DATE NOT NULL,
    
);

DROP TABLE IF EXISTS Reservation;

CREATE TABLE Reservation (
    idAnnonce INTEGER CONSTRAINT fk_annonce_reservation FOREIGN KEY REFERENCES Annonce(id),
    idUtilisateur INTEGER CONSTRAINT fk_user_reservation FOREIGN KEY REFERENCES Utilisateur(id),
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    CONSTRAINT pk_reservation PRIMARY KEY (idAnnonce,dateDebut,dateFin),
);

DROP TABLE IF EXISTS Localisation;

CREATE TABLE Localisation (
    lattitudeDegre FLOAT NOT NULL,
    lattitudeMinute FLOAT NOT NULL,
    longitudeDegre FLOAT NOT NULL,
    longitudeMinute FLOAT NOT NULL,
    CONSTRAINT pk_localisation PRIMARY KEY (lattitudeDegre,lattitudeMinute,longitudeDegre,longitudeMinute),
);

GRANT all privileges ON Utilisateur TO projet_web_grp35;
GRANT all privileges ON Favoris TO projet_web_grp35;
GRANT all privileges ON Annonce TO projet_web_grp35;
GRANT all privileges ON Notation TO projet_web_grp35;
GRANT all privileges ON Message TO projet_web_grp35;
GRANT all privileges ON Image TO projet_web_grp35;
GRANT all privileges ON Commentaire TO projet_web_grp35;
GRANT all privileges ON Reservation TO projet_web_grp35;
GRANT all privileges ON Localisation TO projet_web_grp35;