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

CREATE TABLE Annonce (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    idUtilisateur INTEGER,
    datePublication DATE NOT NULL,
    duree INTEGER,
    description VARCHAR,
    photo BOOLEAN,
    lieu VARCHAR(256),
    lat FLOAT,
    lng FLOAT,
    CONSTRAINT fk_annonce FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Favoris;

CREATE TABLE Favoris (
    fav_idUtilisateur INTEGER NOT NULL,
    fav_idAnnonce INTEGER NOT NULL,
    PRIMARY KEY (fav_idUtilisateur, fav_idAnnonce),
    CONSTRAINT cle_etr_utilisateur FOREIGN KEY (fav_idUtilisateur) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    CONSTRAINT cle_etr_annonce FOREIGN KEY (fav_idAnnonce) REFERENCES Annonce(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Conversation CASCADE;

CREATE TABLE Conversation (
    id SERIAL PRIMARY KEY,
    id1 INTEGER NOT NULL,
    id2 INTEGER NOT NULL,
    conv_idAnnonce INTEGER NOT NULL,
    CONSTRAINT fk_message_1 FOREIGN KEY (id1) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    CONSTRAINT fk_message_2 FOREIGN KEY (id2) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    CONSTRAINT cle_etr_annonce FOREIGN KEY (conv_idAnnonce) REFERENCES Annonce(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Message;

CREATE TABLE Message (
    id SERIAL PRIMARY KEY,
    ref_conv INTEGER NOT NULL,
    idAuteur INTEGER NOT NULL,
    datePublication DATE NOT NULL,
    demandeResa BOOLEAN,
    description VARCHAR,
    CONSTRAINT fk_ref_conv FOREIGN KEY (ref_conv) REFERENCES Conversation(id) ON DELETE CASCADE,
    CONSTRAINT fk_auteur FOREIGN KEY (idAuteur) REFERENCES Utilisateur(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Reservation;

CREATE TABLE Reservation (
    res_idAnnonce INTEGER NOT NULL,
    res_idUtilisateur INTEGER NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    CONSTRAINT pk_reservation PRIMARY KEY (res_idAnnonce,dateDebut,dateFin),
    CONSTRAINT fk_annonce_reservation FOREIGN KEY (res_idAnnonce) REFERENCES Annonce(id) ON DELETE CASCADE,
    CONSTRAINT fk_user_reservation FOREIGN KEY (res_idUtilisateur) REFERENCES Utilisateur(id) ON DELETE CASCADE
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

INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Geffroy','Craig','Barnabé','barnabe.geffroy@ensiie.fr','0670908741','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Clavel','Clemos','Clémence','clemence.clavel@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Gayet','Pipo','Constant','constant.gayet@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Harivel','Poulette','Alexia','alexia.harivel@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');
INSERT INTO "utilisateur" (nom, pseudo, prenom, email, telephone, password) VALUES ('Oustric','Choco','Lucas','lucas.oustric@ensiie.fr','0000000000','$2y$10$K/8woUpK/8RmfH5EdvwNi.ahLYsRfJtxs2TIyHy/2X2rxiHQ1w4Iq');

INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) VALUES ('Catan','1','2021-04-24', 2, 'Jeu de société très sympa, je ne le prête que pour une soirée ou un week-end.', FALSE, NULL);
INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) VALUES ('Livres informatique','2','2021-04-30', NULL, 'Idéal pour réaliser un site web comme ENTRAiiDe.', TRUE, NULL);
INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) VALUES ('Le JavaScript pour les nuls','3','2021-05-02', 30, 'Ayant fini mon projet web, je prête ce livre avec grand plaisir !', TRUE, NULL);
INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) VALUES ('Intégrale de How I met your mother','4','2021-05-01', 15, 'Très bonne série que je prête avec grand plaisir', TRUE, NULL);
INSERT INTO "annonce" (titre, idUtilisateur, datePublication, duree, description, photo, lieu) VALUES ('Trilogie du Seigneur des Anneaux','1','2021-05-04', NULL, '', TRUE, NULL);

INSERT INTO "reservation" (res_idAnnonce,res_idUtilisateur,dateDebut,dateFin) VALUES (4,1,'2021-05-11','2021-05-25');
INSERT INTO "reservation" (res_idAnnonce,res_idUtilisateur,dateDebut,dateFin) VALUES (3,5,'2021-05-26','2021-06-15');

