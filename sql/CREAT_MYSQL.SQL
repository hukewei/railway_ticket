	CREATE TABLE Villes (
	CP char(5) CHECK (char_length(cp) = 5),
	NomVille varchar(30),
	ZoneH integer,
	PRIMARY KEY(CP,NomVille),
	CHECK (CP LIKE REPLICATE('[0-9]', 10))
);


CREATE TABLE Gares (
	NomGare varchar(30),
	CP char(5),
	min_emploi_TP integer NOT NULL,
	Ville varchar(30),
	Adresse varchar(40) NOT NULL,
	PRIMARY KEY(NomGare,CP,Ville),
	UNIQUE(CP,Adresse),
	FOREIGN KEY(CP,Ville) REFERENCES Villes(CP,NomVille)
);

CREATE TABLE Hotels (
	Telephone char(10) CHECK (char_length(Telephone) = 10),
	Nom varchar(30) UNIQUE NOT NULL,
	Adresse varchar(40) UNIQUE NOT NULL,
	PRIMARY KEY(Telephone),
	UNIQUE (Nom, Adresse)
);

CREATE TABLE Hotel_Gare (
	Telephone char(10),
	Gare varchar(30),
	Ville varchar(30),
	CP char(5),
	PRIMARY KEY(Telephone),
	FOREIGN KEY(Telephone) REFERENCES Hotels(Telephone),
	FOREIGN KEY(Gare,CP,Ville) REFERENCES Gares(NomGare,CP,Ville)
);

CREATE TABLE Taxis (
Telephone char(10) CHECK (char_length(Telephone) = 10),
NomTaxi varchar(20),
Adresse varchar(40),
PRIMARY KEY(Telephone),
UNIQUE(NomTaxi, Adresse)
);


CREATE TABLE Taxi_Gare (
Telephone char(10),
Nom varchar(30),
Ville varchar(30),
CP char(5),
PRIMARY KEY(Telephone,Nom,Ville,CP),
FOREIGN KEY(Telephone) REFERENCES Taxis(Telephone),
FOREIGN KEY (Nom,Ville,CP) REFERENCES Gares(NomGare,Ville,CP)
);

CREATE TABLE Itineraires (
Numero integer,
PRIMARY KEY(Numero)
);

CREATE TABLE Type_Train (
Typ varchar(10),
Capacite integer,
Place1 integer,
Place2 integer,
VitesseMax integer,
CHECK (Place1+Place2=Capacite),
PRIMARY KEY(Typ)
);

CREATE TABLE Trains (
Numero integer,
Typ varchar(10),
PRIMARY KEY(Numero),
FOREIGN KEY(Typ) REFERENCES Type_Train(Typ)
);

CREATE TABLE Itineraire_Horaire (
Heure time,
Jour ENUM ('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'),
NumItineraire integer,
NumTrain integer,
PRIMARY KEY(Heure,Jour,NumItineraire,NumTrain),
FOREIGN KEY(NumItineraire) REFERENCES Itineraires(Numero),
FOREIGN KEY(NumTrain) REFERENCES Trains(Numero) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Trajets (
Date_dep date,
Heure time,
Jour ENUM ('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'),
NumItineraire integer,
NumTrain integer,
GareDepartTrajet varchar(30),
CPDepart char(5),
VilleDepart varchar(30),
GareArriveeTrajet varchar(30),
VilleArrivee varchar(30),
CPArrivee char(5),
PRIMARY KEY(Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee),
FOREIGN KEY(Heure,Jour,NumItineraire,NumTrain) REFERENCES Itineraire_Horaire(Heure,Jour,NumItineraire,NumTrain) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(GareDepartTrajet,CPDepart,VilleDepart) REFERENCES Gares(NomGare,CP,Ville),
FOREIGN KEY(GareArriveeTrajet,CPArrivee,VilleArrivee) REFERENCES Gares(NomGare,CP,Ville)
);

CREATE TABLE Voyageur (
Nom varchar(30),
Prenom varchar(20),
Telephone char(10) CHECK (char_length(Telephone) = 10),
PRIMARY KEY (Nom,Prenom,Telephone)
);



CREATE TABLE Billets (
Numero integer,
Assurance boolean,
Moyen_paiement ENUM ('CB', 'Espèce', 'Chèque', 'Monéo', 'Paypal', 'Western Union', 'Virement'),
Mode_Achat ENUM ('Internet', 'Billeterie'),
Nom varchar(30),
Prenom varchar(20),
Telephone char(10),
status char(1), 
CHECK (status in ('V','A')),
PRIMARY KEY(Numero),
FOREIGN KEY(Nom,prenom,Telephone) REFERENCES Voyageur(Nom,Prenom,Telephone)
);


CREATE TABLE TrajetBillet (
Date_dep date,
Heure time,
Jour ENUM ('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'),
NumItineraire integer,
NumTrain integer,
GareDepartTrajet varchar(30),
CPDepart char(5),
VilleDepart varchar(30),
GareArriveeTrajet varchar(30),
VilleArrivee varchar(30),
CPArrivee char(5),
Numero integer,
PRIMARY KEY(Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee,Numero),
FOREIGN KEY(Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,CPArrivee,VilleArrivee) 
REFERENCES Trajets(Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,CPArrivee,VilleArrivee) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(Numero) REFERENCES Billets(Numero)
);

CREATE TABLE Membre_Personnel (
NumSecu char(13) UNIQUE NOT NULL,
Nom varchar(30),
Prenom varchar(20),
Telephone char(10),
PRIMARY KEY(Nom,Prenom,Telephone)
);


CREATE TABLE Personnel_Gare (
typ ENUM ('Aiguilleur', 'Guichetier','Directeur'),
Nom varchar(30),
Prenom varchar(20),
Telephone char(10),
NumSecu char(13) UNIQUE NOT NULL,
PRIMARY KEY(Nom,Prenom,Telephone,Typ),
FOREIGN KEY(Nom,Prenom,Telephone) REFERENCES Membre_Personnel(Nom,Prenom,Telephone) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(NumSecu) REFERENCES Membre_Personnel(NumSecu) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Conducteur (
Nom varchar(30),
Prenom varchar(20),
Telephone char(10),
NumSecu char(13) UNIQUE NOT NULL,
PRIMARY KEY(Nom,Prenom,Telephone),
FOREIGN KEY(Nom,Prenom,Telephone) REFERENCES Membre_Personnel(Nom,Prenom,Telephone) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(NumSecu) REFERENCES Membre_Personnel(NumSecu) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE TrainConducteur (
Numero integer,
Nom varchar(30),
Prenom varchar(20),
Telephone char(10),
PRIMARY KEY(Numero,Nom,Prenom,Telephone),
FOREIGN KEY(Numero) REFERENCES Trains(Numero) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(Nom,Prenom,Telephone) REFERENCES Conducteur(Nom,Prenom,Telephone) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Dessert(
	HorrairePassage time,
	Numero integer,
	Nom varchar(30),
	Ville varchar(30),
	CP char(5),
	PRIMARY KEY(HorrairePassage,Numero,Nom, Ville, CP),
	FOREIGN KEY (Numero) REFERENCES Itineraires(Numero),
	FOREIGN KEY (Nom,Ville,CP) REFERENCES Gares(NomGare,Ville,CP)
);


CREATE TABLE Contrat_Travail(
	Type_Contrat ENUM ('Aiguilleur', 'Guichetier','Directeur'),
	Nom varchar(30),
	Prenom varchar(20),
	Telephone char(10),
	Gare varchar(30),
	Ville varchar(30),
	CP char(5),
	Typ_pers ENUM ('Mi-temps', 'Plein temps'),
	PRIMARY KEY(Type_Contrat,Nom, Prenom, Telephone, Ville,CP, Typ_pers),
	FOREIGN KEY (Gare,Ville,CP) REFERENCES Gares(NomGare,Ville,CP),
	FOREIGN KEY(Typ_pers,Nom,Prenom,Telephone) REFERENCES Personnel_Gare(typ,Nom,Prenom,Telephone) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE SEQUENCE serial_num_billet START 123003;
