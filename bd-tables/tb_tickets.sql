CREATE TABLE  tb_tickes(
    id_ticket                 INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombres                VARCHAR (255) NULL,
    Dni_ruc                       VARCHAR (255) NULL,
    Cuviculo                      VARCHAR (255) NULL,
    Fecha_ingreso                 VARCHAR (255) NULL,
    Hora_ingreso                  VARCHAR (255) NULL,
    user_sesion                   VARCHAR (255) NULL,
    
    fyh_creacion           DATETIME NULL,
    fyh_actualizacion      DATETIME NULL,
    fyh_eliminacion        DATETIME NULL,
    estado                 VARCHAR (10)
);