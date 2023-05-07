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

INSERT INTO presentacion VALUES 
(DEFAULT, "Tableta"),
(DEFAULT, "Capsula"),
(DEFAULT, "Supositorio"),
(DEFAULT, "Pomada"),
(DEFAULT, "Crema"),
(DEFAULT, "Jarabe");

CREATE TABLE dosis
(
	idDosis int not null primary key AUTO_INCREMENT,
    nombreDosis varchar(20)
);
INSERT INTO dosis VALUES
(DEFAULT, "Oral"),
(DEFAULT,"Inyectada"),
(DEFAULT,"Intravenosa");

CREATE TABLE medicamentos
(
	idMedicamento int not null primary key AUTO_INCREMENT,
    nombrecomercialMedicamento varchar(100),
    activoprincipalMedicamento varchar(100),
    dosis varchar(30),
    idDosis int not null,
    idPresentacion int not null,
    controlMedicamento int
);

INSERT INTO medicamentos VALUES
(DEFAULT, "Aspirina", "Ácido acetilsalicilico", "300 mg", 1, 1,2),
(DEFAULT, "", "Metformina", "800 mg", 1, 1,2);

CREATE TABLE clinicatienemedicamento
(
	idClinica int not null default 1,
	idUsuario int not null,
    idMedicamento int not null,
    cantidadMedicamento int,
	loteMedicamento varchar(100),
    marca varchar(40),
	fechadecaducidadMedicamento date 
);

INSERT INTO clinicatienemedicamento VALUES
(DEFAULT, 1, 1, 20, "1456", "Pfizer", "2025-05-02"),
(DEFAULT, 1, 2, 15, "34", "Astrazeneca", "2024-12-24"),
(DEFAULT, 1, 2, 15, "34", "Astrazenecaa", "2023-06-24")
;

CREATE TABLE usuarios
(
	idUsuario int not null primary key AUTO_INCREMENT,
    nombreUsuario varchar(60),
    cargo varchar(30),
    correo varchar(100),
    claveUsuario varchar(32),
    expiration_date date,
    recibe_alertas int default 0
);

INSERT INTO usuarios(nombreUsuario, correo, claveUsuario, cargo, recibe_alertas) values
('Administrador del sistema', 'admin@mail.com', MD5('admin'), 'Administrador', 1);

/*************/
SELECT
    md.idMedicamento,
    md.nombrecomercialMedicamento,
    md.activoprincipalMedicamento,
    md.dosis,
    cm.loteMedicamento,
    cm.fechadecaducidadMedicamento,
    md.controlMedicamento,
    cm.cantidadMedicamento,
    cm.marca,
    d.nombreDosis,
    p.nombrePresentacion
FROM
	clinicatienemedicamento cm
    INNER JOIN medicamentos md
        ON md.idMedicamento = cm.idMedicamento
    INNER JOIN dosis d
        ON md.idDosis = d.idDosis
    INNER JOIN presentacion p
        ON md.idPresentacion = p.idPresentacion
;