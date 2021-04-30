-- ##############################################################
-- # Script SQL
-- # Author: Groupe 35
-- # Function: Création de la base de données du projet web
-- ###############################################################

-- If tables already exists


DROP TABLE IF EXISTS Utilisateur CASCADE;

CREATE TABLE Utilisateur (
    id SERIAL PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    pseudo VARCHAR(50),
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(256) UNIQUE NOT NULL,
    telephone VARCHAR(10),
    password VARCHAR(256) NOT NULL
);
DROP TABLE IF EXISTS Annonce CASCADE;

INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Geffroy','Craig','Barnabé','barnabe.geffroy@ensiie.fr','0670908741','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Clavel','Clemos','Clémence','clemence.clavel@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Gayet','Pipo','Constant','constant.gayet@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Harivel','Poulette','Alexia','alexia.harviel@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');

CREATE TABLE Annonce (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    idUtilisateur INTEGER,
    datePublication DATE NOT NULL,
    duree INTEGER,
    description VARCHAR,
    photo BOOLEAN,
    lieu VARCHAR(256),
    CONSTRAINT fk_annonce FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(id)
);

INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) VALUES ('Jeux de société','1','2021-04-24', NULL, 'Monopoly, Catan, ...', FALSE, NULL);
DROP TABLE IF EXISTS Favoris;

CREATE TABLE Favoris (
    fav_idUtilisateur INTEGER NOT NULL,
    fav_idAnnonce INTEGER NOT NULL,
    PRIMARY KEY (fav_idUtilisateur, fav_idAnnonce),
    CONSTRAINT cle_etr_utilisateur FOREIGN KEY (fav_idUtilisateur) REFERENCES Utilisateur(id),
    CONSTRAINT cle_etr_annonce FOREIGN KEY (fav_idAnnonce) REFERENCES Annonce(id)
);


DROP TABLE IF EXISTS Conversation;

CREATE TABLE Conversation (
    id SERIAL PRIMARY KEY,
    id1 INTEGER NOT NULL,
    id2 INTEGER NOT NULL,
    conv_idAnnonce INTEGER NOT NULL,
    CONSTRAINT fk_message_1 FOREIGN KEY (id1) REFERENCES Utilisateur(id),
    CONSTRAINT fk_message_2 FOREIGN KEY (id2) REFERENCES Utilisateur(id),
    CONSTRAINT cle_etr_annonce FOREIGN KEY (conv_idAnnonce) REFERENCES Annonce(id)
);

DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    id SERIAL PRIMARY KEY,
    ref_conv INTEGER NOT NULL,
    idAuteur INTEGER NOT NULL,
    datePublication DATE NOT NULL,
    description VARCHAR,
    CONSTRAINT fk_ref_conv FOREIGN KEY (ref_conv) REFERENCES Conversation(id),
    CONSTRAINT fk_auteur FOREIGN KEY (idAuteur) REFERENCES Utilisateur(id)
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
    res_idAnnonce INTEGER NOT NULL,
    res_idUtilisateur INTEGER NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    CONSTRAINT pk_reservation PRIMARY KEY (res_idAnnonce,dateDebut,dateFin),
    CONSTRAINT fk_annonce_reservation FOREIGN KEY (res_idAnnonce) REFERENCES Annonce(id),
    CONSTRAINT fk_user_reservation FOREIGN KEY (res_idUtilisateur) REFERENCES Utilisateur(id)
);

INSERT INTO "reservation" (res_idAnnonce,res_idUtilisateur,dateDebut,dateFin) VALUES (1,1,'2021-04-26','2021-04-29');
INSERT INTO "reservation" (res_idAnnonce,res_idUtilisateur,dateDebut,dateFin) VALUES (1,1,'2021-05-01','2021-05-05');

DROP TABLE IF EXISTS Localisation;

CREATE TABLE Localisation (
    lattitudeDegre FLOAT NOT NULL,
    lattitudeMinute FLOAT NOT NULL,
    longitudeDegre FLOAT NOT NULL,
    longitudeMinute FLOAT NOT NULL,
    CONSTRAINT pk_localisation PRIMARY KEY (lattitudeDegre,lattitudeMinute,longitudeDegre,longitudeMinute)
);

GRANT all privileges ON Utilisateur TO tpcurseurs;
GRANT all privileges ON utilisateur_id_seq TO tpcurseurs;
GRANT all privileges ON Favoris TO tpcurseurs;
GRANT all privileges ON Annonce TO tpcurseurs;
GRANT all privileges ON Annonce_id_seq TO tpcurseurs;
GRANT all privileges ON Message TO tpcurseurs;
GRANT all privileges ON Message_id_seq TO tpcurseurs;
GRANT all privileges ON Conversation TO tpcurseurs;
GRANT all privileges ON Conversation_id_seq TO tpcurseurs;
GRANT all privileges ON Commentaire TO tpcurseurs;
GRANT all privileges ON Commentaire_id_seq TO tpcurseurs;
GRANT all privileges ON Reservation TO tpcurseurs;
GRANT all privileges ON Localisation TO tpcurseurs;