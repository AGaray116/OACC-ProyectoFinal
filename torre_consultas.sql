SET NAMES 'utf8';
DROP DATABASE IF EXISTS torre_consultas;
CREATE DATABASE IF NOT EXISTS torre_consultas DEFAULT CHARACTER SET utf8;
USE torre_consultas;

CREATE TABLE tipousuarios(
id_tus                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo_tus                  VARCHAR(13) NOT NULL
)DEFAULT CHARACTER SET utf8;

CREATE TABLE usuarios(
id_uss                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_tus_uss                INTEGER NOT NULL,
correo_uss                VARCHAR(60) NOT NULL,
contrasena_uss            VARCHAR(20) NOT NULL,
FOREIGN KEY (id_tus_uss) REFERENCES tipousuarios(id_tus)
)DEFAULT CHARACTER SET utf8;

CREATE TABLE horarios_doctores(
id_hds                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
horas_ini_hds             TIME NOT NULL,
horas_fin_hds             TIME NOT NULL
)DEFAULT CHARACTER SET utf8;

CREATE TABLE turnos(
id_tur                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_hds_tur                INTEGER NOT NULL,
turno_tur                 CHAR (10) NOT NULL,
FOREIGN KEY (id_hds_tur) REFERENCES horarios_doctores(id_hds)
)DEFAULT CHARACTER SET utf8;

CREATE TABLE consultorios(
id_cos                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
consultorios_cos          CHAR (5) NOT NULL,
CONSTRAINT consultorio_repetido UNIQUE(consultorios_cos),
CONSTRAINT notacion_no_valida CHECK (consultorios_cos LIKE '_-___') 
)DEFAULT CHARACTER SET utf8;

CREATE TABLE especialidades(
id_ess                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
especialidad_ess          VARCHAR(20) NOT NULL
)DEFAULT CHARACTER SET utf8;

CREATE TABLE doctores(
id_dos                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_uss_dos                INTEGER NOT NULL,
id_tur_dos                INTEGER NOT NULL,
id_cos_dos                INTEGER NOT NULL,
id_ess_dos                INTEGER NOT NULL,
nombre_dos                VARCHAR (25) NOT NULL,
apellido_dos              VARCHAR (25) NOT NULL,
foto_dos                  BLOB,
correo_dos                VARCHAR(60) NOT NULL,
fechaNacimiento_dos       DATE NOT NULL,
telefono_dos              CHAR (10) NOT NULL,
especialidad_dos          VARCHAR (25) NOT NULL,
informacionRelevante_dos  VARCHAR (200) NOT NULL,
FOREIGN KEY (id_uss_dos) REFERENCES usuarios(id_uss), 
FOREIGN KEY (id_tur_dos) REFERENCES turnos(id_tur),
FOREIGN KEY (id_cos_dos) REFERENCES consultorios(id_cos),
FOREIGN KEY (id_ess_dos) REFERENCES especialidades(id_ess),
CONSTRAINT correo_no_valido UNIQUE(correo_dos)
)DEFAULT CHARACTER SET utf8;

DELIMITER //

CREATE TRIGGER doctores_before_insert
BEFORE INSERT
   ON doctores FOR EACH ROW

BEGIN

   DECLARE idUsuario INTEGER;

   SELECT id_uss FROM usuarios WHERE correo_uss = NEW.correo_dos INTO idUsuario;

   SET NEW.id_uss_dos = idUsuario;

END; //

DELIMITER ;

CREATE TABLE dias_inhabiles(

   id_dis INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
   id_dos_dis INTEGER NOT NULL,
   dias_dis DATE NOT NULL UNIQUE,

   FOREIGN KEY (id_dos_dis) REFERENCES doctores(id_dos)

)DEFAULT CHARACTER SET utf8;

CREATE TABLE pacientes(
id_pas                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_uss_pas				  INTEGER NOT NULL,
nombre_pas                VARCHAR (25) NOT NULL,
apellido_pas              VARCHAR (25) NOT NULL,
foto_pas                  BLOB,
fechaNacimiento_pas       DATE NOT NULL,
telefono_pas              CHAR (10) NOT NULL,
correo_pas				  VARCHAR(60) NOT NULL,
FOREIGN KEY (id_uss_pas) REFERENCES usuarios(id_uss),
CONSTRAINT correo_no_valido UNIQUE(correo_pas)
)DEFAULT CHARACTER SET utf8;

DELIMITER //

CREATE TRIGGER pacientes_before_insert
BEFORE INSERT
   ON pacientes FOR EACH ROW

BEGIN

   DECLARE idUsuario INTEGER;

   SELECT id_uss FROM usuarios WHERE correo_uss = NEW.correo_pas INTO idUsuario;

   SET NEW.id_uss_pas = idUsuario;

END; //

DELIMITER ;

CREATE TABLE secretarias(
id_ses                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_uss_ses				  INTEGER NOT NULL,
id_cos_ses				  INTEGER NOT NULL,
id_tur_ses				  INTEGER NOT NULL,
nombre_ses                VARCHAR (25) NOT NULL,
apellido_ses              VARCHAR (25) NOT NULL,
foto_ses                  BLOB,
fechaNacimiento_ses       DATE NOT NULL,
telefono_ses              CHAR (10) NOT NULL,
correo_ses				  VARCHAR(60) NOT NULL,
FOREIGN KEY (id_uss_ses) REFERENCES usuarios(id_uss),
FOREIGN KEY (id_cos_ses) REFERENCES consultorios(id_cos),
FOREIGN KEY (id_tur_ses) REFERENCES turnos(id_tur),
CONSTRAINT correo_no_valido UNIQUE(correo_ses)
)DEFAULT CHARACTER SET utf8;


DELIMITER //

CREATE TRIGGER secretarias_before_insert
BEFORE INSERT
   ON secretarias FOR EACH ROW

BEGIN

   DECLARE idUsuario INTEGER;

   SELECT id_uss FROM usuarios WHERE correo_uss = NEW.correo_ses INTO idUsuario;

   SET NEW.id_uss_ses = idUsuario;

END; //

DELIMITER ;

CREATE TABLE administradores(
id_ads                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_uss_ads				  INTEGER NOT NULL,
nombre_ads                VARCHAR (25) NOT NULL,
apellido_ads              VARCHAR (25) NOT NULL,
fechaNacimiento_ads       DATE NOT NULL,
telefono_ads              CHAR (10) NOT NULL,
correo_ads				  VARCHAR(60) NOT NULL,
FOREIGN KEY (id_uss_ads) REFERENCES usuarios(id_uss),
CONSTRAINT correo_no_valido UNIQUE(correo_ads)
)DEFAULT CHARACTER SET utf8;

DELIMITER //

CREATE TRIGGER administradores_before_insert
BEFORE INSERT
   ON administradores FOR EACH ROW

BEGIN

   DECLARE idUsuario INTEGER;

   SELECT id_uss FROM usuarios WHERE correo_uss = NEW.correo_ads INTO idUsuario;

   SET NEW.id_uss_ads = idUsuario;

END; //

DELIMITER ;

CREATE TABLE horarios_citas(
id_hcs                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
horas_hcs                 TIME NOT NULL
)DEFAULT CHARACTER SET utf8;

CREATE TABLE citas(
id_cts                    INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_hcs_cts                INTEGER NOT NULL,
id_dos_cts                INTEGER NOT NULL,
id_pas_cts                INTEGER NOT NULL,
fecha_cts                 DATE NOT NULL,
FOREIGN KEY (id_hcs_cts) REFERENCES horarios_citas(id_hcs),
FOREIGN KEY (id_dos_cts) REFERENCES doctores(id_dos),
FOREIGN KEY (id_pas_cts) REFERENCES pacientes(id_pas)
)DEFAULT CHARACTER SET utf8;

DELIMITER //
CREATE TRIGGER citas_before_insert
BEFORE INSERT
   ON citas FOR EACH ROW

BEGIN
	DECLARE cuenta_citas INTEGER;
    DECLARE turno INTEGER;
    DECLARE hora INTEGER;

    SELECT COUNT(*) FROM citas WHERE (id_dos_cts = NEW.id_dos_cts) AND (fecha_cts = NEW.fecha_cts) AND (id_hcs_cts = NEW.id_hcs_cts)
    INTO cuenta_citas;

    SELECT id_tur_dos FROM doctores WHERE id_dos = NEW.id_dos_cts INTO turno;
    
    SELECT id_hcs FROM horarios_citas WHERE horas_hcs = '14:00' INTO hora;
	IF (NEW.fecha_cts >= CURDATE()) THEN
		IF cuenta_citas = 0 THEN 
			IF (turno = 1 AND NEW.id_hcs_cts <= hora) OR (turno = 2 AND NEW.id_hcs_cts > hora) THEN
				SET NEW.id_hcs_cts = NEW.id_hcs_cts;
				SET NEW.id_dos_cts = NEW.id_dos_cts;
				SET NEW.id_pas_cts = NEW.id_pas_cts;
				SET NEW.fecha_cts = NEW.fecha_cts;
			ELSE
				SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT='El horario no coincide con el turno';	
			END IF;            
		END IF;
		
		IF cuenta_citas > 0 THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='Ya esta apartado ese horario';
		END IF;
	ELSE 
		SIGNAL SQLSTATE '45005' SET MESSAGE_TEXT='FECHA NO VALIDA';
	END IF;
END; //
DELIMITER ;


INSERT INTO consultorios(consultorios_cos) VALUES ('C-101');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-102');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-103');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-104');

INSERT INTO especialidades(especialidad_ess) VALUES ("Nefrologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Cardiologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Pediatria");
INSERT INTO especialidades(especialidad_ess) VALUES ("Oftalmologo");


INSERT INTO horarios_doctores (horas_ini_hds,horas_fin_hds) VALUES ('07:00', '14:00');
INSERT INTO horarios_doctores (horas_ini_hds,horas_fin_hds) VALUES ('14:00', '21:00');

INSERT INTO turnos (id_hds_tur, turno_tur) VALUES (1,'Matutino');
INSERT INTO turnos (id_hds_tur, turno_tur) VALUES (2,'Vespertino');

INSERT INTO tipousuarios (tipo_tus) VALUES ('Doctor');
INSERT INTO tipousuarios (tipo_tus) VALUES ('Admin');
INSERT INTO tipousuarios (tipo_tus) VALUES ('Secretaria');
INSERT INTO tipousuarios (tipo_tus) VALUES ('Paciente');

INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (1,'algo@doctor.com','papidoctor');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (1,'algo@doctor1.com','papidoctor');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (1,'algo@doctor2.com','papidoctor');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (2,'algo@admin.com','papiadmin');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (2,'algo@admin1.com','papiadmin');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (3,'algo@secre.com','papisecre');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (3,'algo@secre1.com','papisecre');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (4,'algo@paciente.com','papipaciente');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (4,'algo@paciente1.com','papipaciente');

INSERT INTO doctores (id_uss_dos, id_tur_dos, id_cos_dos, id_ess_dos, nombre_dos, apellido_dos, foto_dos, fechaNacimiento_dos, telefono_dos, especialidad_dos, informacionRelevante_dos, correo_dos)
VALUES (0, 1, 1, 2,'Doctor', 'Ibarra', null, '2022-04-04', '5555103962', 'Ginecologo', 'Hola que hace', 'algo@doctor.com');
INSERT INTO doctores (id_uss_dos, id_tur_dos, id_cos_dos, id_ess_dos, nombre_dos, apellido_dos, foto_dos, fechaNacimiento_dos, telefono_dos, especialidad_dos, informacionRelevante_dos, correo_dos)
VALUES (0, 2, 1, 3, 'Doctor1', 'Ibarra1', null, '2022-04-05', '5555103962', 'Ginecologo1', 'Hola que hace1', 'algo@doctor1.com');
INSERT INTO doctores (id_uss_dos, id_tur_dos, id_cos_dos, id_ess_dos, nombre_dos, apellido_dos, foto_dos, fechaNacimiento_dos, telefono_dos, especialidad_dos, informacionRelevante_dos, correo_dos)
VALUES (0, 2, 2, 4, 'Doctor2', 'Ibarra2', null, '2022-04-05', '5555103962', 'Ginecologo1', 'Hola que hace1', 'algo@doctor2.com');

INSERT INTO pacientes (id_uss_pas, nombre_pas, apellido_pas, fechaNacimiento_pas, telefono_pas, correo_pas)
VALUES (0,'Paciente', 'Nfermo', '2022-04-04', '5563722987', 'algo@paciente.com');
INSERT INTO pacientes (id_uss_pas, nombre_pas, apellido_pas, fechaNacimiento_pas, telefono_pas, correo_pas)
VALUES (0,'Paciente1', 'Nfermo', '2022-04-04', '5563722987', 'algo@paciente1.com');

INSERT INTO secretarias (id_uss_ses, id_cos_ses, id_tur_ses, nombre_ses, apellido_ses, foto_ses, fechaNacimiento_ses, telefono_ses, correo_ses)
VALUES (3, 1, 1, 'Secre', 'Taria', null, '2022-04-04', '5555103962', 'algo@secre.com');
INSERT INTO secretarias (id_uss_ses, id_cos_ses, id_tur_ses, nombre_ses, apellido_ses, foto_ses, fechaNacimiento_ses, telefono_ses, correo_ses)
VALUES (3, 3, 2, 'Secre1', 'Taria1', null, '2022-04-04', '5555103962', 'algo@secre1.com');

INSERT INTO administradores (id_uss_ads, nombre_ads, apellido_ads, fechaNacimiento_ads, telefono_ads, correo_ads)
VALUES (4, 'Adminis', 'Trador', '2022-04-04', '5555103962', 'algo@admin.com');
INSERT INTO administradores (id_uss_ads, nombre_ads, apellido_ads, fechaNacimiento_ads, telefono_ads, correo_ads)
VALUES (4, 'Adminis', 'Trador', '2022-04-04', '5555103962', 'algo@admin1.com');

INSERT INTO horarios_citas (horas_hcs) VALUES ('07:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('08:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('09:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('10:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('11:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('12:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('13:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('14:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('15:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('16:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('17:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('18:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('19:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('20:00');
INSERT INTO horarios_citas (horas_hcs) VALUES ('21:00');

INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (1, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (2, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (3, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (4, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (5, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (6, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (7, 1, 2, '2022-05-20');
INSERT INTO citas (id_hcs_cts, id_dos_cts, id_pas_cts , fecha_cts)
VALUES (8, 1, 2, '2022-05-20');



-- SELECT * from usuarios;
-- SELECT * from doctores;
-- SELECT * FROM tipousuarios;
-- SELECT * FROM pacientes;
-- SELECT * FROM citas
-- SELECT * FROM horarios_citas;
-- SELECT a.id_hcs from horarios_citas a inner JOIN citas b ON a.id_hcs = b.id_hcs_cts WHERE b.fecha_cts = '2023-04-04';
 -- SELECT id_hcs FROM horarios_citas WHERE id_hcs NOT IN (SELECT a.id_hcs from horarios_citas a inner JOIN citas b ON a.id_hcs = b.id_hcs_cts WHERE b.fecha_cts = '2023-04-04');
-- SELECT * FROM tipousuarios a INNER JOIN usuarios b ON a.id_tus = b.id_tus_uss INNER JOIN pacientes c ON b.id_uss = c.id_uss_pas;
-- SELECT * FROM tipousuarios a INNER JOIN usuarios b ON a.id_tus = b.id_tus_uss INNER JOIN doctores c ON b.id_uss = c.id_uss_dos;
-- SELECT * FROM tipousuarios a INNER JOIN usuarios b ON a.id_tus = b.id_tus_uss INNER JOIN secretarias c ON b.id_uss = c.id_uss_ses;
-- SELECT * FROM tipousuarios a INNER JOIN usuarios b ON a.id_tus = b.id_tus_uss INNER JOIN administradores c ON b.id_uss = c.id_uss_ads;
-- SELECT a.nombre_dos, a.apellido_dos, b.fecha_cts, d.horas_hcs, c.nombre_pas, c.apellido_pas FROM doctores a INNER JOIN citas b ON a.id_dos = b.id_dos_cts INNER JOIN horarios_citas d ON b.id_hcs_cts = d.id_hcs INNER JOIN pacientes c ON b.id_pas_cts = c.id_pas
-- SELECT * FROM horarios_doctores a INNER JOIN turnos b ON  a.id_hds = b.id_hds_tur INNER JOIN doctores c ON b.id_tur = c.id_tur_dos
-- SELECT a.consultorios_cos, b.nombre_dos, b.apellido_dos FROM consultorios a INNER JOIN doctores b ON  a.id_cos = b.id_cos_dos
-- SELECT a.id_ses, a.nombre_ses, a.apellido_ses, a.foto_ses, a.id_cos_ses, b.consultorios_cos , a.correo_ses, a.fechaNacimiento_ses , a.telefono_ses FROM secretarias a INNER JOIN consultorios b ON id_cos_ses = id_cos;
-- SELECT a.id_dos, a.nombre_dos, a.apellido_dos, a.correo_dos, b.consultorios_cos, a.fechaNacimiento_dos, a.telefono_dos, a.informacionRelevante_dos, c.turno_tur, d.especialidad_ess FROM doctores a INNER JOIN consultorios b ON a.id_cos_dos = b.id_cos INNER JOIN turnos c ON a.id_tur_dos = c.id_tur INNER JOIN especialidades d ON id_ess_dos = id_ess;

