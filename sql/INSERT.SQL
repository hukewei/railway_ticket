BEGIN TRANSACTION;
#insertion pour villes
INSERT INTO villes (CP,NomVille,ZoneH) VALUES ('60200','COMPIEGNE',1);
INSERT INTO villes (CP,NomVille,ZoneH) VALUES ('75010','PARIS',1);
INSERT INTO villes (CP,NomVille,ZoneH) VALUES ('60100','CREIL',1);

INSERT INTO Gares (nomgare,cp,min_emploi_tp,ville,adresse) VALUES ('COMPIEGNE GARE','60200',10,'COMPIEGNE','Pl. de la Gare');
INSERT INTO Gares (nomgare,cp,min_emploi_tp,ville,adresse) VALUES ('GARE DU NORD','75010',50,'PARIS','18 Rue de Dunkerque');
INSERT INTO Gares (nomgare,cp,min_emploi_tp,ville,adresse) VALUES ('CREIL GARE','60100',15,'CREIL','57 Rue Jules Juillet');

INSERT INTO Hotels (telephone,nom,adresse) VALUES ('0312432534','Hôtel du Louvre','Place André Malraux');
INSERT INTO Hotels (telephone,nom,adresse) VALUES ('0124642235','Campanile Hotel Compiegne','Avenue de Huy');
INSERT INTO Hotels (telephone,nom,adresse) VALUES ('0112424339','Campanile Creil','3 Rue du Marais');

INSERT INTO Hotel_Gare (Telephone,Gare,Ville,CP) VALUES ('0124642235','COMPIEGNE GARE','COMPIEGNE','60200');
INSERT INTO Hotel_Gare (Telephone,Gare,Ville,CP) VALUES ('0312432534','GARE DU NORD','PARIS','75010');
INSERT INTO Hotel_Gare (Telephone,Gare,Ville,CP) VALUES ('0112424339','CREIL GARE','CREIL','60100');


INSERT INTO Taxis (telephone,nomtaxi,adresse) VALUES ('0612475339','SuperTaxi','4 Rue du Marais');
INSERT INTO Taxis (telephone,nomtaxi,adresse) VALUES ('0612586038','hyperTaxi','45 Rue Jules Juillet');
INSERT INTO Taxis (telephone,nomtaxi,adresse) VALUES ('0712454563','CoolTaxi','Pl. de la Gare');

INSERT INTO Taxi_Gare (Telephone,Nom,Ville,CP) VALUES('0612475339','COMPIEGNE GARE','COMPIEGNE','60200');
INSERT INTO Taxi_Gare (Telephone,Nom,Ville,CP) VALUES('0612586038','COMPIEGNE GARE','COMPIEGNE','60200');
INSERT INTO Taxi_Gare (Telephone,Nom,Ville,CP) VALUES('0712454563','GARE DU NORD','PARIS','75010');


INSERT INTO Itineraires(Numero) VALUES(111111);
INSERT INTO Itineraires(Numero) VALUES(222222);
INSERT INTO Itineraires(Numero) VALUES(333333);

INSERT INTO Type_Train (Typ,Capacite,Place1,Place2,VitesseMax) VALUES ('TER',150,30,120,130);
INSERT INTO Type_Train (Typ,Capacite,Place1,Place2,VitesseMax) VALUES ('TGV',250,80,170,250);
INSERT INTO Type_Train (Typ,Capacite,Place1,Place2,VitesseMax) VALUES ('INTER',100,20,80,90);

INSERT INTO Trains (Numero,Typ) VALUES(800001,'TER');
INSERT INTO Trains (Numero,Typ) VALUES(800002,'TER');
INSERT INTO Trains (Numero,Typ) VALUES(200001,'TGV');
INSERT INTO Trains (Numero,Typ) VALUES(770001,'INTER');

INSERT INTO Itineraire_Horaire (Heure,Jour,NumItineraire,NumTrain) VALUES('12:30:00','Lundi',111111,800001);
INSERT INTO Itineraire_Horaire (Heure,Jour,NumItineraire,NumTrain) VALUES('14:40:00','Mardi',333333,200001);
INSERT INTO Itineraire_Horaire (Heure,Jour,NumItineraire,NumTrain) VALUES('21:00:00','Samedi',222222,770001);

/*ça marche car oussama est trompé sur l'ordre*/
INSERT INTO Trajets (Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee)
VALUES('2013-05-13','12:30:00','Lundi',111111,800001,'COMPIEGNE GARE','60200','COMPIEGNE','GARE DU NORD','PARIS','75010');
INSERT INTO Trajets (Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee)
VALUES('2013-05-20','12:30:00','Lundi',111111,800001,'COMPIEGNE GARE','60200','COMPIEGNE','GARE DU NORD','PARIS','75010');
INSERT INTO Trajets (Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee)
VALUES('2013-05-18','21:00:00','Samedi',222222,770001,'GARE DU NORD','75010','PARIS','CREIL GARE','CREIL','60100');


INSERT INTO Voyageur (Nom,Prenom,Telephone) VALUES('dujardin','nicolas','0612344321');
INSERT INTO Voyageur (Nom,Prenom,Telephone) VALUES('dupont','julie','0712345980');
INSERT INTO Voyageur (Nom,Prenom,Telephone) VALUES('adams','kev','0616798321');

INSERT INTO Billets (Numero,Assurance,Moyen_paiement,Mode_Achat,Nom,Prenom,Telephone) VALUES(123001,TRUE,'CB','Internet','dujardin','nicolas','0612344321');
INSERT INTO Billets (Numero,Assurance,Moyen_paiement,Mode_Achat,Nom,Prenom,Telephone) VALUES(123002,TRUE,'Paypal','Internet','dupont','julie','0712345980');

/*ca marche maintenant*/
INSERT INTO TrajetBillet (Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee,Numero)
VALUES('2013-05-13','12:30:00','Lundi',111111,800001,'COMPIEGNE GARE','60200','COMPIEGNE','GARE DU NORD','PARIS','75010',123001);
INSERT INTO TrajetBillet (Date_dep,Heure,Jour,NumItineraire,NumTrain,GareDepartTrajet,CPDepart,VilleDepart,GareArriveeTrajet,VilleArrivee,CPArrivee,Numero)
VALUES('2013-05-18','21:00:00','Samedi',222222,770001,'GARE DU NORD','75010','PARIS','CREIL GARE','CREIL','60100',123002);

INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1122334455661','sud','thomas','0712398756');
INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1122334455772','jolie','paulina','0656573598');
INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1122334455883','hallo','isabel','0798761234');
INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1122334455995','smith','william','0623456743');
INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1100854455995','haggerty','ben','0609879865');
INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1199884455995','james','robin','0756734521');
INSERT INTO Membre_Personnel (NumSecu,Nom,Prenom,Telephone) VALUES ('1177884455995','spears','britney','0623456712');

INSERT INTO Personnel_Gare (typ,Nom,Prenom,Telephone,NumSecu) VALUES ('Aiguilleur','sud','thomas','0712398756','1122334455661');
INSERT INTO Personnel_Gare (typ,Nom,Prenom,Telephone,NumSecu) VALUES ('Guichetier','jolie','paulina','0656573598','1122334455772');
INSERT INTO Personnel_Gare (typ,Nom,Prenom,Telephone,NumSecu) VALUES ('Directeur','hallo','isabel','0798761234','1122334455883');
INSERT INTO Personnel_Gare (typ,Nom,Prenom,Telephone,NumSecu) VALUES ('Guichetier','smith','william','0623456743','1122334455995');


INSERT INTO Conducteur (Nom,Prenom,Telephone,NumSecu) VALUES ('haggerty','ben','0609879865','1100854455995');
INSERT INTO Conducteur (Nom,Prenom,Telephone,NumSecu) VALUES ('james','robin','0756734521','1199884455995');
INSERT INTO Conducteur (Nom,Prenom,Telephone,NumSecu) VALUES ('spears','britney','0623456712','1177884455995');


INSERT INTO TrainConducteur (Numero,Nom,Prenom,Telephone) VALUES (800001,'haggerty','ben','0609879865');
INSERT INTO TrainConducteur (Numero,Nom,Prenom,Telephone) VALUES (200001,'spears','britney','0623456712');
INSERT INTO TrainConducteur (Numero,Nom,Prenom,Telephone) VALUES (770001,'james','robin','0756734521');



INSERT INTO Dessert(HorrairePassage,Numero,Nom,Ville,CP) VALUES ('13:15:00',111111,'CREIL GARE','CREIL','60100');


INSERT INTO Contrat_Travail(Type_Contrat,Nom,Prenom,Telephone,Gare,Ville,CP,Typ_pers) VALUES ('Mi-temps','smith','william','0623456743','CREIL GARE','CREIL','60100','Guichetier');
INSERT INTO Contrat_Travail(Type_Contrat,Nom,Prenom,Telephone,Gare,Ville,CP,Typ_pers) VALUES ('Plein temps','hallo','isabel','0798761234','COMPIEGNE GARE','COMPIEGNE','60200','Directeur');
INSERT INTO Contrat_Travail(Type_Contrat,Nom,Prenom,Telephone,Gare,Ville,CP,Typ_pers) VALUES ('Plein temps','jolie','paulina','0656573598','GARE DU NORD','PARIS','75010','Guichetier');


COMMIT;
