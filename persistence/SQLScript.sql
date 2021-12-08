CREATE TABLE Administrador (
	idAdministrador int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(45) NOT NULL,
	clave varchar(45) NOT NULL,
	foto varchar(45) DEFAULT NULL,
	telefono varchar(45) DEFAULT NULL,
	celular varchar(45) DEFAULT NULL,
	estado tinyint DEFAULT NULL,
	PRIMARY KEY (idAdministrador)
);

INSERT INTO Administrador(idAdministrador, nombre, apellido, correo, clave, telefono, celular, estado) VALUES 
	('1', 'Admin', 'Admin', 'admin@udistrital.edu.co', md5('123'), '123', '123', '1'); 

CREATE TABLE LogAdministrador (
	idLogAdministrador int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	administrador_idAdministrador int(11) NOT NULL,
	PRIMARY KEY (idLogAdministrador)
);

CREATE TABLE Areas (
	idAreas int(11) NOT NULL AUTO_INCREMENT,
	n_area varchar(200) NOT NULL,
	empleado_idEmpleado int(11) NOT NULL,
	PRIMARY KEY (idAreas)
);

CREATE TABLE Cargo (
	idCargo int(11) NOT NULL AUTO_INCREMENT,
	n_cargo varchar(200) NOT NULL,
	PRIMARY KEY (idCargo)
);

CREATE TABLE LogEmpleado (
	idLogEmpleado int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	empleado_idEmpleado int(11) NOT NULL,
	PRIMARY KEY (idLogEmpleado)
);

CREATE TABLE Empleado (
	idEmpleado int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	correo varchar(45) NOT NULL,
	clave varchar(45) NOT NULL,
	foto varchar(45) DEFAULT NULL,
	state tinyint NOT NULL,
	cargo_idCargo int(11) NOT NULL,
	PRIMARY KEY (idEmpleado)
);

ALTER TABLE LogAdministrador
 	ADD FOREIGN KEY (administrador_idAdministrador) REFERENCES Administrador (idAdministrador); 

ALTER TABLE Areas
 	ADD FOREIGN KEY (empleado_idEmpleado) REFERENCES Empleado (idEmpleado); 

ALTER TABLE LogEmpleado
 	ADD FOREIGN KEY (empleado_idEmpleado) REFERENCES Empleado (idEmpleado); 

ALTER TABLE Empleado
 	ADD FOREIGN KEY (cargo_idCargo) REFERENCES Cargo (idCargo); 

