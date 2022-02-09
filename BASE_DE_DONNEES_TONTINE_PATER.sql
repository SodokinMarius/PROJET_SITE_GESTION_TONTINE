CREATE DATABASE TONTINE;
CREATE TABLE IF NOT EXISTS TONTINE.CLIENT(
    matricule VARCHAR(255) PRIMARY KEY NOT NULL,
    nomClient VARCHAR(255) NOT NULL,
    prenomClient VARCHAR(255) NOT NULL,
    dateNaissance date NOT NULL,
    LieuNaissance VARCHAR(255)  NOT NULL,
    sexe ENUM('M','F'),
    profession VARCHAR(255) NOT NULL,
    AdressClient VARCHAR(255) NOT NULL,
    telephone VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS TONTINE.PAIEMENT(
    matricule VARCHAR(255) NOT NULL,
    numCarnet VARCHAR(255)  NOT NULL,
    idAgent VARCHAR(255) NOT NULL,
    date_paiement date,
    nature_paiement ENUM('NATURE','ESPECE','A DISTANCE'),
    montant_paye DECIMAL(6,2),
    PRIMARY KEY(matricule,numCarnet,idAgent),
    FOREIGN KEY matricule REFERENCES client(matricule),
    FOREIGN KEY numCarnet REFERENCES carnet(numCarnet),
    FOREIGN KEY idAgent REFERENCES Agent(idAgent)

);

CREATE TABLE IF NOT EXISTS TONTINE.CARNET(
    numCarnet VARCHAR(255) PRIMARY KEY NOT NULL,
    date_enregistrement date,
    prix_unit float,
    stock int NOT NULL
);

CREATE TABLE IF NOT EXISTS TONTINE.AGENT(
    idAgent VARCHAR(255) PRIMARY KEY NOT NULL,
    nomAgent VARCHAR(255) NOT NULL,
    prenomAgent VARCHAR(255) NOT NULL,
    dateNaissanceAg date NOT NULL,
    LieuNaissanceAg VARCHAR(255)  NOT NULL,
    poste ENUM('SUPERVISEUR','PRESIDENT','SECRETAIRE','TRESORIER(E)'),
    mot_de_passe VARCHAR(255) NOT NULL,
    AdressAg VARCHAR(255) NOT NULL,
    telephone VARCHAR(255)
);