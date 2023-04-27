CREATE DATABASE clinicaComunitarias;
USE clinicaComunitarias;

CREATE TABLE ciudades (
	idCiudad int not null primary key AUTO_INCREMENT,
    nombreCiudad varchar(100)
);

INSERT INTO ciudades VALUES (DEFAULT, "Tijuana"), (DEFAULT, "Tecate"), (DEFAULT, "Mexicali"), (DEFAULT, "Ensenada"), (DEFAULT, "Rosarito");

CREATE TABLE clinicas (
	idClinica int not null primary key AUTO_INCREMENT,
    nombreClinica varchar(100),
    direccionClinica text,
    donacionClinica int,
    idCiudad int not null
);

INSERT INTO clinicas VALUES
(DEFAULT, 'Premier', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d817.0744890902214!2d-117.02057123200284!3d32.524374215687004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d94845865a96ff%3A0xd105e1d1005f2e1f!2sCentro%20M%C3%A9dico%20Premier!5e0!3m2!1ses!2smx!4v1676312220589!5m2!1ses!2smx" width="250" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 1, 1),
(DEFAULT, "Angeles", '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3364.3029110195735!2d-117.01010228445936!3d32.51805590445078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d9480141af4fb7%3A0xd4400072dc537040!2sHospital%20Angeles%20Tijuana!5e0!3m2!1ses!2smx!4v1676312389551!5m2!1ses!2smx" width="250" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 1, 2);

CREATE TABLE presentacion
(
	idPresentacion int not null primary key AUTO_INCREMENT,
    nombrePresentacion varchar(100)
);
INSERT INTO presentacion VALUES (DEFAULT, "Tableta"), (DEFAULT, "Capsula"), (DEFAULT, "Supositorio"), (DEFAULT, "Pomada"), (DEFAULT, "Crema"), (DEFAULT, "Jarabe");

CREATE TABLE dosis
(
	idDosis int not null primary key AUTO_INCREMENT,
    nombreDosis varchar(20)
);
INSERT INTO dosis VALUES(DEFAULT, "Oral"), (DEFAULT,"Inyectada"), (DEFAULT,"Intravenosa");

CREATE TABLE medicamentos
(
	idMedicamento int not null primary key AUTO_INCREMENT,
    nombrecomercialMedicamento varchar(100),
    activoprincipalMedicamento varchar(100),
    idDosis int not null,
    idPresentacion int not null,
    controlMedicamento int
);

INSERT INTO medicamentos VALUES(DEFAULT, "Aspirina", "Ácido acetilsalicilico",1,1,0);

CREATE TABLE clinicatienemedicamento
(
	idClinica int not null,
    idMedicamento int not null,
    cantidadMedicamento int,
	loteMedicamento varchar(100),
	fechadecaducidadMedicamento datetime
);

INSERT INTO clinicatienemedicamento VALUES(1,1,40,"1456","31/01/04"), (2,1,34,"34","24/10/10");

CREATE TABLE usuarios
(
	idUsuario int not null primary key AUTO_INCREMENT,
    nombreUsuario varchar(60),
    cargo varchar(30),
    correo varchar(30),
    claveUsuario varchar(32),
    expiration_date date,
    user_role varchar(20)
);

SELECT nombrecomercialMedicamento, activoprincipalMedicamento, loteMedicamento, fechadecaducidadMedicamento, controlMedicamento, cantidadMedicamento, nombreDosis, nombrePresentacion, nombreClinica FROM clinicatienemedicamento
INNER JOIN clinicas ON clinicas.idClinica = clinicatienemedicamento.idClinica
INNER JOIN medicamentos ON medicamentos.idMedicamento = clinicatienemedicamento.idMedicamento
INNER JOIN dosis ON medicamentos.idDosis = dosis.idDosis
INNER JOIN presentacion ON medicamentos.idPresentacion = presentacion.idPresentacion;

INSERT INTO usuarios(correo, claveUsuario, user_role) values ('admin@mail.com', MD5('admin'), 'admin');