CREATE DATABASE SalonesPracticas;
USE SalonesPracticas;

CREATE TABLE salones(
    nombre_salon VARCHAR(50) PRIMARY KEY NOT NULL,
    lugares INT(3) NOT NULL
);

CREATE TABLE alumnos(
    alumno VARCHAR(50) PRIMARY KEY NOT NULL,
    solicitudes INT(3) NULL
);

CREATE TABLE solicitudes(
    id_solicitud INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    practica VARCHAR(50) NOT NULL,
    docente VARCHAR(50) NOT NULL,
    id_salon VARCHAR(50) NOT NULL,
    id_alumno VARCHAR(50) NOT NULL,
    FOREIGN KEY(id_salon) REFERENCES salones(nombre_salon),
    FOREIGN KEY(id_alumno) REFERENCES alumnos(alumno)
);

INSERT INTO salones (nombre_salon,lugares) VALUES ('Shiatsu',13);
INSERT INTO salones (nombre_salon,lugares) VALUES ('Holistico',2);
INSERT INTO salones (nombre_salon,lugares) VALUES ('LomiLomi',3);
INSERT INTO salones (nombre_salon,lugares) VALUES ('Body Paint',1);
INSERT INTO salones (nombre_salon,lugares) VALUES ('Colorimetria',13);
INSERT INTO salones (nombre_salon,lugares) VALUES ('Balayage',13);

INSERT INTO alumnos (alumno,solicitudes) VALUES ('Juanita Perez',1);
