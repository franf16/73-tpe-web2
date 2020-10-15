START TRANSACTION;

CREATE DATABASE IF NOT EXISTS tpe DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE tpe;

--
-- Tabla `usuario`
--
CREATE TABLE IF NOT EXISTS usuario (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(16) NOT NULL,
    email varchar(64) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (username),
    UNIQUE KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tabla `seccion`
--
CREATE TABLE IF NOT EXISTS seccion (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(32) NOT NULL,
    descripcion varchar(255) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tabla `noticia`
--
CREATE TABLE IF NOT EXISTS noticia (
    id int(11) NOT NULL AUTO_INCREMENT,
    titulo varchar(255) NOT NULL,
    descripcion varchar(500) DEFAULT NULL,
    texto text DEFAULT NULL,
    fecha datetime DEFAULT CURRENT_TIMESTAMP,
    id_seccion int(11) NOT NULL,
    visualizaciones int DEFAULT 0,
    PRIMARY KEY (id),
    KEY (id_seccion),
    FOREIGN KEY (id_seccion)
    REFERENCES seccion(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE VIEW noticia_full 
AS
    SELECT
        noticia.id,
        noticia.titulo,
        noticia.descripcion,
        noticia.texto,
        noticia.fecha,
        -- DATE(noticia.fecha) as date,
        noticia.id_seccion,
        noticia.visualizaciones,
        seccion.nombre as seccion
    FROM noticia
    INNER JOIN seccion 
        ON noticia.id_seccion = seccion.id;
    -- ORDER BY fecha DESC;

CREATE VIEW noticia_preview 
AS
    SELECT
        noticia.id,
        noticia.titulo,
        noticia.descripcion,
        noticia.fecha,
        -- DATE(noticia.fecha) as date,
        noticia.id_seccion,
        seccion.nombre as seccion,
        noticia.visualizaciones
    FROM noticia
    INNER JOIN seccion 
        ON noticia.id_seccion = seccion.id;
    -- ORDER BY fecha DESC;

COMMIT;