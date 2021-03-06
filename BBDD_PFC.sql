CREATE TABLE DATOS_BRUTOS (
ID_TABLA BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_BCN BIGINT NOT NULL,
ID_PRINCIP SMALLINT NOT NULL,
N_PRINCIP VARCHAR(50)CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_SECTOR SMALLINT NOT NULL,
N_SECTOR VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_GRUPACT SMALLINT NOT NULL,
N_GRUPACT VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_ACT INT NOT NULL,
N_ACT VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
N_LOCAL VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
SN_CARRER SMALLINT NOT NULL,
SN_MERCAT SMALLINT NOT NULL,
ID_MERCAT INT NOT NULL,
N_MERCAT VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
SN_GALERIA SMALLINT NOT NULL,
N_GALERIA VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
SN_CCOMERC SMALLINT NOT NULL,
ID_CCOMERC VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
N_CCOMERC VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
N_CARRER VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
NUM_POLICI VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
REF_CAD VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
DATA TIMESTAMP,
CODI_BARRI SMALLINT NOT NULL,
NOM_BARRI VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
CODI_DISTRICTE SMALLINT NOT NULL,
N_DISTRI VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
N_EIX  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
SN_EIX SMALLINT NOT NULL,
SEC_CENS SMALLINT NOT NULL,
Y_UTM_ETRS DOUBLE PRECISION,
X_UTM_ETRS DOUBLE PRECISION,
LATITUD DOUBLE PRECISION,
LONGITUD DOUBLE PRECISION
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IDIOMA(
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE APLICACION_WEB (
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE TEXTO (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_APLICACION SMALLINT UNSIGNED NOT NULL REFERENCES APLICACION_WEB(ID),
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
VARIABLE VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
TEXTO TEXT 
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE PERMISOS (
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
EXPONENTE SMALLINT NOT NULL,
VALOR BIGINT NOT NULL
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE USUARIO (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
APELLIDO_1 VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
APELLIDO_2 VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
EMAIL VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
LOGIN VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
PASSWORD VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ES_ADMIN Bool,
TELEFONO VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
TELEFONO_MOVIL VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ACTIVO Bool,
PERMISOS BIGINT,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE SECTOR (
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_SECTOR SMALLINT NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE GRUPO_ACTIVIDAD (
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_GRUPO_ACTIVIDAD SMALLINT NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE ACTIVIDAD (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_ACTIVIDAD INT NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
ID_GRUPO_ACTIVIDAD SMALLINT UNSIGNED NOT NULL REFERENCES GRUPO_ACTIVIDAD(id),
NOMBRE VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE NUMERO_EMPLEADOS (
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
EMPLEADOS VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE PAIS (
ID SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_PAIS SMALLINT NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE REGION (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_REGION INT UNSIGNED NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_PAIS SMALLINT UNSIGNED NOT NULL REFERENCES PAIS(ID_PAIS)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE PROVINCIA (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_PROVINCIA INT UNSIGNED NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_REGION INT UNSIGNED NOT NULL REFERENCES REGION(ID_REGION)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE CIUDAD (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_CIUDAD INT UNSIGNED NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_PROVINCIA INT UNSIGNED NOT NULL REFERENCES PROVINCIA(ID_PROVINCIA)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE CODIGO_POSTAL (
ID_CODIGO_POSTAL BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_PAIS SMALLINT UNSIGNED NOT NULL REFERENCES PAIS(ID_PAIS),
ID_CIUDAD INT UNSIGNED NOT NULL REFERENCES CIUDAD(ID_CIUDAD)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE DISTRITO (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_DISTRITO INT UNSIGNED NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_CIUDAD INT UNSIGNED NOT NULL REFERENCES CIUDAD(ID_CIUDAD)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE BARRIO (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_BARRIO INT UNSIGNED NOT NULL,
ID_IDIOMA SMALLINT UNSIGNED NOT NULL REFERENCES IDIOMA(id),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_DISTRITO INT UNSIGNED NOT NULL REFERENCES DISTRITO(ID_DISTRITO)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE CALLE (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_BARRIO INT UNSIGNED NOT NULL REFERENCES BARRIO(ID_BARRIO)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE NUMERO_CALLE (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_CALLE INT UNSIGNED NOT NULL REFERENCES CALLE(ID),
LATITUD DECIMAL(11,7),
LONGITUD DECIMAL(11,7)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE CENTRO_COMERCIAL (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_CIUDAD INT UNSIGNED NOT NULL REFERENCES CIUDAD(ID_CIUDAD),
ID_DISTRITO INT UNSIGNED NOT NULL REFERENCES DISTRITO(ID_DISTRITO),
ID_BARRIO INT UNSIGNED NOT NULL REFERENCES BARRIO(ID_BARRIO),
ID_CALLE INT UNSIGNED NOT NULL REFERENCES CALLE(ID),
ID_NUMERO_CALLE INT UNSIGNED NOT NULL REFERENCES NUMERO_CALLE(ID)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE GALERIA (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_CIUDAD INT UNSIGNED NOT NULL REFERENCES CIUDAD(ID_CIUDAD),
ID_DISTRITO INT UNSIGNED NOT NULL REFERENCES DISTRITO(ID_DISTRITO),
ID_BARRIO INT UNSIGNED NOT NULL REFERENCES BARRIO(ID_BARRIO),
ID_CALLE INT UNSIGNED NOT NULL REFERENCES CALLE(ID),
ID_NUMERO_CALLE INT UNSIGNED NOT NULL REFERENCES NUMERO_CALLE(ID)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE MERCADO (
ID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_CIUDAD INT UNSIGNED NOT NULL REFERENCES CIUDAD(ID_CIUDAD),
ID_DISTRITO INT UNSIGNED NOT NULL REFERENCES DISTRITO(ID_DISTRITO),
ID_BARRIO INT UNSIGNED NOT NULL REFERENCES BARRIO(ID_BARRIO),
ID_CALLE INT UNSIGNED NOT NULL REFERENCES CALLE(ID),
ID_NUMERO_CALLE INT UNSIGNED NOT NULL REFERENCES NUMERO_CALLE(ID)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE EMPRESA (
ID BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_TABLA_BRUTA BIGINT UNSIGNED NOT NULL REFERENCES DATOS_BRUTOS(ID_TABLA),
NOMBRE VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
ID_SECTOR SMALLINT UNSIGNED NOT NULL REFERENCES SECTOR(ID_SECTOR),
ID_GRUPO_ACTIVIDAD SMALLINT UNSIGNED NOT NULL REFERENCES GRUPO_ACTIVIDAD(ID_GRUPO_ACTIVIDAD),
ID_ACTIVIDAD SMALLINT UNSIGNED NOT NULL REFERENCES ACTIVIDAD(ID_ACTIVIDAD),
ID_MERCADO INT UNSIGNED NOT NULL REFERENCES MERCADO(ID),
ID_CENTRO_COMERCIAL INT UNSIGNED NOT NULL REFERENCES CENTRO_COMERCIAL(ID),
ID_GALERIA INT UNSIGNED NOT NULL REFERENCES GALERIA(ID),
ID_PAIS SMALLINT UNSIGNED NOT NULL REFERENCES PAIS(ID_PAIS),
ID_REGION INT UNSIGNED NOT NULL REFERENCES REGION(ID_REGION),
ID_PROVINCIA INT UNSIGNED NOT NULL REFERENCES PROVINCIA(ID_PROVINCIA),
ID_CIUDAD INT UNSIGNED NOT NULL REFERENCES CIUDAD(ID_CIUDAD),
ID_CODIGO_POSTAL INT UNSIGNED NOT NULL REFERENCES CODIGO_POSTAL(ID_CODIGO_POSTAL),
ID_DISTRITO INT UNSIGNED NOT NULL REFERENCES DISTRITO(ID_DISTRITO),
ID_BARRIO INT UNSIGNED NOT NULL REFERENCES BARRIO(ID_BARRIO),
ID_CALLE INT UNSIGNED NOT NULL REFERENCES CALLE(ID),
ID_NUMERO_CALLE INT UNSIGNED NOT NULL REFERENCES NUMERO_CALLE(ID),
ID_NUMERO_EMPLEADOS SMALLINT UNSIGNED NOT NULL REFERENCES NUMERO_EMPLEADOS(ID),
LATITUD DECIMAL(11,7),
LONGITUD DECIMAL(11,7),
ACTIVA Bool
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE AUDITORIA_LOGIN (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_USUARIO BIGINT UNSIGNED NOT NULL REFERENCES USUARIO(id),
CUANDO DATETIME DEFAULT CURRENT_TIMESTAMP,
ADMIN BOOL,
LOGIN BOOL,
LOGOUT BOOL,
IP VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
NAVEGADOR VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE AUDITORIA_BUSQUEDA (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_USUARIO BIGINT UNSIGNED NOT NULL REFERENCES USUARIO(id),
CUANDO DATETIME DEFAULT CURRENT_TIMESTAMP,
TIEMPO DECIMAL(11,7), 
RESULTADO INT
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE AUDITORIA_RESULTADO_BUSQUEDA (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_AUDITORIA_BUSQUEDA BIGINT UNSIGNED NOT NULL REFERENCES AUDITORIA_BUSQUEDA(id),
ID_EMPRESA BIGINT UNSIGNED NOT NULL REFERENCES EMPRESA(id)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE AUDITORIA_BUSQUEDA_DETALLE (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_AUDITORIA_BUSQUEDA BIGINT UNSIGNED NOT NULL REFERENCES AUDITORIA_BUSQUEDA(id),
CAMPO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
VALOR VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE AUDITORIA_CAMBIO_EMPRESA (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_EMPRESA BIGINT UNSIGNED NOT NULL REFERENCES EMPRESA(id),
CUANDO DATETIME DEFAULT CURRENT_TIMESTAMP,
CAMPO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
VIEJO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
NUEVO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE AUDITORIA_CAMBIO_USUARIO (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_USUARIO BIGINT UNSIGNED NOT NULL REFERENCES USUARIO(id),
CUANDO DATETIME DEFAULT CURRENT_TIMESTAMP,
CAMPO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
VIEJO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
NUEVO VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE AUDITORIA_POSICION (
ID BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
ID_USUARIO BIGINT UNSIGNED NOT NULL REFERENCES USUARIO(id),
CUANDO DATETIME DEFAULT CURRENT_TIMESTAMP,
CIUDAD VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
CODIGO_POSTAL VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
CALLE  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
NUMERO_CALLE VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci,
LATITUD DOUBLE PRECISION,
LONGITUD DOUBLE PRECISION
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
