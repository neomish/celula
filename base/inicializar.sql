DROP TABLE `usuario_juega_rol`;
DROP TABLE `rol`;
DROP TABLE `usuario`;

CREATE TABLE `usuario` (
    `id`     INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `nombre` TEXT    NOT NULL                           UNIQUE,
    `clave`  TEXT    NOT NULL
);

CREATE TABLE `rol` (
    `id`          INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    `nombre`      TEXT    NOT NULL                           UNIQUE,
    `descripcion` TEXT    NOT NULL
);

CREATE TABLE `usuario_juega_rol` (
    `idusuario` INTEGER NOT NULL,
    `idrol`     INTEGER NOT NULL,
    PRIMARY     KEY(`idusuario`,`idrol`),
    FOREIGN     KEY(`idusuario`) REFERENCES usuario(id),
    FOREIGN     KEY(`idrol`)     REFERENCES rol(id)
);
