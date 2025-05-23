CREATE TABLE  tb_tickes(
    id_ticket                 INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente                VARCHAR (255) NULL,
    dni_ruc                       VARCHAR (255) NULL,
    Cuviculo                      VARCHAR (255) NULL,
    fecha_ingreso                 VARCHAR (255) NULL,
    hora_ingreso                  VARCHAR (255) NULL,
    user_sesion                   VARCHAR (255) NULL,
    
    fyh_creacion           DATETIME NULL,
    fyh_actualizacion      DATETIME NULL,
    fyh_eliminacion        DATETIME NULL,
    estado                 VARCHAR (10)
);