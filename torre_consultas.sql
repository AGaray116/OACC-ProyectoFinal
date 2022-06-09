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

DELIMITER //
CREATE  PROCEDURE buscarDoctorCitas(in patron varchar(15))
BEGIN
	SELECT b.nombre_dos, b.apellido_dos, d.especialidad_ess, c.consultorios_cos, a.fecha_cts, e.horas_hcs, f.nombre_pas, f.apellido_pas FROM citas a INNER JOIN doctores b ON a.id_dos_cts = b.id_dos INNER JOIN consultorios c ON b.id_cos_dos = c.id_cos INNER JOIN especialidades d ON b.id_ess_dos = d.id_ess INNER JOIN horarios_citas e ON a.id_hcs_cts =e.id_hcs INNER JOIn pacientes f ON a.id_pas_cts = f.id_pas where nombre_dos like concat('%',patron,'%') or apellido_dos like concat('%',patron,'%');
END; //
DELIMITER ;

DELIMITER //
CREATE  PROCEDURE buscarDoctor(in patron varchar(15))
BEGIN
	SELECT a.id_dos, a.foto_dos, a.nombre_dos, a.apellido_dos, a.correo_dos, b.consultorios_cos, a.fechaNacimiento_dos, a.telefono_dos, a.informacionRelevante_dos, c.turno_tur, d.especialidad_ess FROM doctores a INNER JOIN consultorios b ON a.id_cos_dos = b.id_cos INNER JOIN turnos c ON a.id_tur_dos = c.id_tur INNER JOIN especialidades d ON id_ess_dos = id_ess where nombre_dos like concat('%',patron,'%') or apellido_dos like concat('%',patron,'%');
END; //
DELIMITER ;

DELIMITER //
CREATE  PROCEDURE buscarSecretarias(in patron varchar(15))
BEGIN
	SELECT a.id_ses, a.nombre_ses, a.apellido_ses, a.foto_ses, a.id_cos_ses, b.consultorios_cos , a.correo_ses, a.fechaNacimiento_ses , a.telefono_ses FROM secretarias a INNER JOIN consultorios b ON id_cos_ses = id_cos where nombre_ses like concat('%',patron,'%') or apellido_ses like concat('%',patron,'%');
END; //
DELIMITER ;

DELIMITER //
CREATE  PROCEDURE buscarDoctorDirectorio(in patron varchar(15))
BEGIN
   SELECT a.id_dos, a.nombre_dos, a.apellido_dos, a.correo_dos, b.consultorios_cos, a.fechaNacimiento_dos, a.telefono_dos, a.informacionRelevante_dos, c.turno_tur, d.especialidad_ess FROM doctores a INNER JOIN consultorios b ON a.id_cos_dos = b.id_cos INNER JOIN turnos c ON a.id_tur_dos = c.id_tur INNER JOIN especialidades d ON id_ess_dos = id_ess where nombre_dos like concat('%',patron,'%') or apellido_dos like concat('%',patron,'%');
END; //
DELIMITER ;

INSERT INTO consultorios(consultorios_cos) VALUES ('C-100');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-101');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-102');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-103');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-104');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-105');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-106');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-107');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-108');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-109');
INSERT INTO consultorios(consultorios_cos) VALUES ('C-110');

INSERT INTO especialidades(especialidad_ess) VALUES ("Nefrologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Cardiologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Pediatria");
INSERT INTO especialidades(especialidad_ess) VALUES ("Urologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Oftalmologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Psicologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Dermatologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Neumologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Oncologia");
INSERT INTO especialidades(especialidad_ess) VALUES ("Ginecologia");


INSERT INTO horarios_doctores (horas_ini_hds,horas_fin_hds) VALUES ('07:00', '14:00');
INSERT INTO horarios_doctores (horas_ini_hds,horas_fin_hds) VALUES ('14:00', '21:00');

INSERT INTO turnos (id_hds_tur, turno_tur) VALUES (1,'Matutino');
INSERT INTO turnos (id_hds_tur, turno_tur) VALUES (2,'Vespertino');

INSERT INTO tipousuarios (tipo_tus) VALUES ('Doctor');
INSERT INTO tipousuarios (tipo_tus) VALUES ('Admin');
INSERT INTO tipousuarios (tipo_tus) VALUES ('Secretaria');
INSERT INTO tipousuarios (tipo_tus) VALUES ('Paciente');

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


INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (1,'doctor@doctor.com','doctor');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (1,'doctor1@doctor.com','doctor1');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (2,'admin@admin.com','admin');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (2,'admin1@admin.com','admin1');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (3,'secre@secre.com','secre');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (3,'secre1@secre.com','secre1');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (4,'paciente@paciente.com','paciente');
INSERT INTO usuarios (id_tus_uss, correo_uss, contrasena_uss) VALUES (4,'paciente1@paciente.com','paciente1');

INSERT INTO doctores (id_uss_dos, id_tur_dos, id_cos_dos, id_ess_dos, nombre_dos, apellido_dos, foto_dos,  correo_dos, fechaNacimiento_dos, telefono_dos) VALUES (1,1,1,4,"Doc","Tor",NULL,"doctor@doctor.com", "1999-02-29", "5546382917");
INSERT INTO doctores (id_uss_dos, id_tur_dos, id_cos_dos, id_ess_dos, nombre_dos, apellido_dos, foto_dos,  correo_dos, fechaNacimiento_dos, telefono_dos) VALUES (1,2,10,4,"Doc","Tor",NULL,"doctor1@doctor.com", "1999-04-29", "5546383491");

INSERT INTO administradores (id_uss_ads, nombre_ads, apellido_ads, fechaNacimiento_ads, telefono_ads, correo_ads) VALUES (1,"Admin", "Istrador", "1990-09-18", "5536487762", "admin@admin.com");
INSERT INTO administradores (id_uss_ads, nombre_ads, apellido_ads, fechaNacimiento_ads, telefono_ads, correo_ads) VALUES (1,"Admin1", "Istrador1", "1989-07-07", "5519297762", "admin1@admin.com");

INSERT INTO secretarias (id_uss_ses, id_cos_ses, id_tur_ses, nombre_ses, apellido_ses, foto_ses, fechaNacimiento_ses, telefono_ses, correo_ses) VALUES (1,1,1,"Secre","Taria", NULL, "1999-02-29", "5548631208","secre@secre.com");
INSERT INTO secretarias (id_uss_ses, id_cos_ses, id_tur_ses, nombre_ses, apellido_ses, foto_ses, fechaNacimiento_ses, telefono_ses, correo_ses) VALUES (1,10,2,"Secre1","Taria1", NULL, "1980-04-29", "5548631158","secre1@secre.com");

INSERT INTO pacientes (id_uss_pas, nombre_pas, apellido_pas, foto_pas, fechaNacimiento_pas, telefono_pas, correo_pas) VALUES (1, "Paci", "Ente", NULL, "1985-01-06", "5513696996", "paciente@paciente.com");
INSERT INTO pacientes (id_uss_pas, nombre_pas, apellido_pas, foto_pas, fechaNacimiento_pas, telefono_pas, correo_pas) VALUES (1, "Paci1", "Ente1", NULL, "2005-07-07", "5596696996", "paciente1@paciente.com");