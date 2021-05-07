/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - contex
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`contex` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `contex`;

/*Table structure for table `cargo` */

DROP TABLE IF EXISTS `cargo`;

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cargo` */

insert  into `cargo`(`id_cargo`,`descripcion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Administrador','1','2021-04-05 08:00:00','2021-04-05 08:00:00',1,1),
(2,'Contador','1','2021-04-05 08:01:00','2021-04-05 08:01:00',1,1),
(3,'Vendedor','1','2021-04-05 08:02:00','2021-04-05 08:02:00',1,1),
(4,'Operario','0','2021-04-05 08:03:00','2021-04-05 08:03:00',1,1),
(5,'Bodeguero','0','2021-04-05 08:04:00','2021-04-05 08:04:00',1,1);

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cliente` */

/*Table structure for table `compra_venta` */

DROP TABLE IF EXISTS `compra_venta`;

CREATE TABLE `compra_venta` (
  `id_compra_venta` int(11) NOT NULL AUTO_INCREMENT,
  `control` enum('Compra','Venta','Cotizacion') NOT NULL,
  `fecha` datetime NOT NULL,
  `descuento` double DEFAULT NULL,
  `valor` double NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_compra_venta`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `compra_venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `compra_venta_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `compra_venta` */

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) NOT NULL,
  `correo_institucional` varchar(50) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `arl` varchar(20) NOT NULL,
  `salud` varchar(20) NOT NULL,
  `pension` varchar(20) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `sueldo_basico` double DEFAULT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `id_persona` (`id_persona`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `empleado` */

insert  into `empleado`(`id_empleado`,`id_cargo`,`correo_institucional`,`fecha_ingreso`,`arl`,`salud`,`pension`,`id_persona`,`sueldo_basico`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,1,'Correo','2021-05-19','Equidad Seguros','Comfamiliar','Porvenir',3,500000,'0','2021-05-06 00:00:00','2021-05-06 00:00:00',1,1),
(2,1,'Gmail','2021-05-09','Equidad Seguros','Comfamiliar','Porvenir',3,700000,'1','2021-05-06 00:00:00','2021-05-06 00:00:00',1,1),
(4,1,'Outlook','2021-07-09','Equidad Seguros','Sanitas','Proteccion',3,900000,'0','2021-05-06 00:00:00','2021-05-06 00:00:00',1,1);

/*Table structure for table `formulario` */

DROP TABLE IF EXISTS `formulario`;

CREATE TABLE `formulario` (
  `id_formulario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `etiqueta` varchar(30) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_formulario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `formulario` */

/*Table structure for table `formulario_rol` */

DROP TABLE IF EXISTS `formulario_rol`;

CREATE TABLE `formulario_rol` (
  `id_formulario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_formulario_rol`),
  KEY `id_rol` (`id_rol`),
  KEY `id_formulario` (`id_formulario`),
  CONSTRAINT `formulario_rol_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  CONSTRAINT `formulario_rol_ibfk_2` FOREIGN KEY (`id_formulario`) REFERENCES `formulario` (`id_formulario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `formulario_rol` */

/*Table structure for table `generar_pago` */

DROP TABLE IF EXISTS `generar_pago`;

CREATE TABLE `generar_pago` (
  `id_generar_pago` int(11) NOT NULL AUTO_INCREMENT,
  `valor_pago` double NOT NULL,
  `deduccion` double NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_generar_pago`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `generar_pago_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `generar_pago` */

/*Table structure for table `orden` */

DROP TABLE IF EXISTS `orden`;

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_persona` (`id_persona`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `orden` */

/*Table structure for table `pago_dia` */

DROP TABLE IF EXISTS `pago_dia`;

CREATE TABLE `pago_dia` (
  `id_pago_dia` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `pago_dia` double NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_pago_dia`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `pago_dia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pago_dia` */

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `persona` */

insert  into `persona`(`id_persona`,`nombre`,`apellido`,`edad`,`genero`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(2,'Yesica','Gonzalez',26,'F','0','2021-04-22 00:00:00','2021-04-22 00:00:00',0,0),
(3,'Jesus','Gonzalez',29,'','0','2021-04-22 00:00:00','2021-04-22 00:00:00',0,0),
(4,'Jesus','Gonzalez',29,'','0','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1),
(5,'Jesus','Gonzalez',29,'','0','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1),
(6,'Jesus','Gonzalez',29,'M','0','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1);

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `proveedor` */

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `rol` */

/*Table structure for table `tarea` */

DROP TABLE IF EXISTS `tarea`;

CREATE TABLE `tarea` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `valor_unitario` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_pago` enum('por pagar','pagado') NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_tarea`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tarea` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `fecha_activacion` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario` */

/*Table structure for table `usuario_rol` */

DROP TABLE IF EXISTS `usuario_rol`;

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_rol`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario_rol` */

/* Procedure structure for procedure `Agregar_cargo` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_cargo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_cargo`(IN descripcion VARCHAR(50)
																	,IN estado ENUM('0','1')
																	,IN idUsuarioCreacion INT(11)
																	,IN idUsuarioModificacion INT(11))
BEGIN
	INSERT INTO cargo(descripcion
					,estado
                    ,fecha_creacion
                    ,fecha_modificacion
                    ,id_usuario_creacion
                    ,id_usuario_modificacion) 
				VALUES (descripcion
                        ,estado
                        ,CURDATE()
                        ,CURDATE()
                        ,idUsuarioCreacion
                        ,idUsuarioModificacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_empleado`(
						IN idCargo INT(11)
						,IN correoInstitucional VARCHAR(50)
						,IN fechaIngreso DATE
						,IN arl VARCHAR(20)
						,IN salud VARCHAR(20)
						,IN pension VARCHAR(20)
						,IN idPersona INT(11)
            ,IN sueldoBasico double
						,iN estado enum('0','1')
						,IN idUsuarioCreacion INT(11)
					)
BEGIN
	INSERT INTO empleado(
		id_cargo
		,correo_institucional
		,fecha_ingreso
		,arl
		,salud
		,pension
		,id_persona
    ,sueldo_basico
		,estado
		,fecha_creacion
		,fecha_modificacion
		,id_usuario_creacion
		,id_usuario_modificacion
	)
VALUES(
		idCargo
		,correoInstitucional
		,fechaIngreso
		,arl
		,salud
		,pension
		,idPersona
    ,sueldoBasico
		,estado
		,CURDATE()
		,CURDATE()
		,idUsuarioCreacion
		,idUsuarioCreacion
	);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_formulario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_formulario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_formulario`(IN descripcion VARCHAR(50),
					IN etiqueta VARCHAR(30),
                    IN ubicacion VARCHAR(100),
                    IN estado enum('0','1'),
                    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO formulario(
					descripcion,
                    etiqueta,
                    ubicacion,
                    estado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				descripcion,
				etiqueta,
				ubicacion,
				estado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_formulario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_formulario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_formulario_rol`(IN idRol INT(11),
				          	IN idFormulario INT(11),
                    IN estado enum('0','1'),
                    IN idUsuarioCreacion INT(11),
                    IN idUsuarioModificacion INT(11))
BEGIN
	INSERT INTO formulario_rol(
				          	id_rol,
                    id_formulario,
                    estado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				idRol,
				idFormulario,
				estado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioModificacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_generar_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_generar_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_generar_pago`(IN valorPago DOUBLE, 
	IN deduccion DOUBLE, 
    IN fechaInicio DATETIME, 
    IN fechaFin DATETIME, 
    IN idEmpleado INT(11),
    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO generar_pago(
					valor_pago,
                    deduccion,
                    fecha_inicio,
                    fecha_fin,
                    id_empleado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				valorPago,
                deduccion,
                fechaInicio,
				fechaFin,
                idEmpleado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_pago_dia` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_pago_dia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_pago_dia`(IN idEmpleado INT(11), 
	IN pagoDia DOUBLE,
    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO pago_dia(
					id_empleado,
                    pago_dia,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				idEmpleado,
                pagoDia,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_persona`(
	IN nombre VARCHAR(100)
	,IN apellido VARCHAR(100)
	,IN edad INT(11)
	,IN genero ENUM('M','F')	
	,IN estado ENUM('0','1')
	-- ,in fecha_creacion DATETIME
	-- ,IN fecha_modificacion DATETIME
	,IN idUsuarioCreacion INT(11)
	,IN idUsuarioModificacion INT(11)
	)
BEGIN
	INSERT INTO persona(
		nombre
		,apellido
		,edad
		,genero
		,estado
		,fecha_creacion
		,fecha_modificacion
		,id_usuario_creacion
		,id_usuario_modificacion) 
	VALUES (
		nombre
		,apellido
		,edad
		,genero
		,estado
		,CURDATE()
		,CURDATE()
		,idUsuarioCreacion
		,idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_producto`(IN descripcion VARCHAR(50)
																	,IN estado ENUM('0','1')
																	,IN idUsuarioCreacion INT(11)
																	,IN idUsuarioModificacion INT(11))
BEGIN
	INSERT INTO producto(descripcion
			,talla
			,estado
			,id_categoria
			,fecha_creacion
			,fecha_modificacion
			,id_usuario_creacion
			,id_usuario_modificacion) 
		VALUES (descripcion
			,talla
                        ,estado
                        ,id_categoria
                        ,CURDATE()
                        ,CURDATE()
                        ,idUsuarioCreacion
                        ,idUsuarioModificacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_rol`(IN descripcion VARCHAR(50),
					IN estado enum('0','1'),
                    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO rol(
					descripcion,
                    estado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				descripcion,
				estado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_usuario`(IN usuario VARCHAR(50),
					IN contrasenia VARCHAR(50),
                    IN fechaActivacion DATETIME,
                    IN fechaExpiracion DATETIME,
                    IN idPersona INT(11),
					IN estado enum('0','1'),
                    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO usuario(
					usuario,
                    contrasenia,
                    fecha_activacion,
                    fecha_expiracion,
                    id_persona,
                    estado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				usuario,
                contrasenia,
                fechaActivacion,
                fechaExpiracion,
                idPersona,
				estado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_usuario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_usuario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_usuario_rol`(IN idUsuario INT(11),
					IN idRol INT(11),
					IN estado enum('0','1'),
                    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO usuario_rol(
					id_usuario,
                    id_rol,
                    estado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				idUsuario,
                idRol,
				estado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_cargo` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_cargo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_cargo`(IN descripcion VARCHAR(50)
																		,IN estado ENUM('0','1')
                                                                        ,IN idUsuarioModificacion INT(11)
                                                                        ,IN idCargo INT(11))
BEGIN
	UPDATE cargo 
    SET descripcion = descripcion
        ,estado = estado
        ,fecha_modificacion = NOW()
        ,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_cargo = idCargo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_empleado`(
		IN idCargo INT(11)
		,IN correoInstitucional VARCHAR(50)
		,IN fechaIngreso DATETIME
		,IN arl VARCHAR (20)
		,IN salud VARCHAR (20)
		,IN pension VARCHAR (20)
		,IN idPersona INT(11)
    ,IN sueldoBasico double
		,IN estado enum('0','1')
		,IN idUsuarioModificacion INT(11)
		,IN idEmpleado INT(11)
		)
BEGIN
	UPDATE empleado 
    SET id_cargo = idCargo,
		correo_institucional = correoInstitucional,
		fecha_ingreso = fechaIngreso,
		arl = arl,
    salud = salud,	
    pension = pension,
		id_persona = idPersona,
    sueldo_basico = sueldoBasico,
    estado = estado,
    fecha_modificacion = CURDATE(),
    id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_empleado = idEmpleado;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_formulario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_formulario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_formulario`(IN descripcion VARCHAR(50),
					IN etiqueta VARCHAR(30),
                    IN ubicacion VARCHAR(100),
                    IN estado enum('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idFormulario INT(11))
BEGIN
	UPDATE formulario 
    SET descripcion = descripcion,
		etiqueta = etiqueta,
		ubicacion = ubicacion,
		estado = estado,
		fecha_modificacion = NOW(),
		id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_formulario = idFormulario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_formulario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_formulario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_formulario_rol`(IN idRol INT(11),
					IN idFormulario INT(11),
                    IN estado enum('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idFormularioRol INT(11))
BEGIN
	UPDATE formulario_rol 
    SET id_rol = idRol,
		id_formulario = idFormulario,
		estado = estado,
		fecha_modificacion = NOW(),
		id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_formulario_rol = idFormularioRol;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_generar_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_generar_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_generar_pago`(IN valorPago DOUBLE,
					IN deduccion DOUBLE,
                    IN fechaInicio DATETIME,
                    IN fechaFin DATETIME,
                    IN idEmpleado INT(11),
                    IN idUsuarioModificacion INT(11),
                    IN idGenerarPago INT(11))
BEGIN
	UPDATE generar_pago 
    SET valor_pago = valorPago,
		deduccion = deduccion,
		fechaInicio = fechaInicio,
		fechaFin = fechaFin,
        idEmpleado = idEmpleado,
        id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_generar_pago = idGenerarPago;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_pago_dia` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_pago_dia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_pago_dia`(IN idEmpleado INT(11),
					IN pagoDia DOUBLE,
                    IN idUsuarioModificacion INT(11),
                    IN idPagoDia INT(11))
BEGIN
	UPDATE pago_dia 
    SET id_empleado = idEmpleado,
		pago_dia = pagoDia,
        id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_pago_dia = idPagoDia;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_persona`(IN nombre VARCHAR(100),
                    IN apellido VARCHAR(100),
                    IN edad INT(11),
                    IN genero ENUM('Masculino','Femenino','Otro'),
                    IN estado enum('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idPersona INT(11))
BEGIN
	UPDATE persona 
    SET nombre = nombre,
		apellido = apellido,
        edad = edad,
        genero = genero,
		estado = estado,
		fecha_modificacion = NOW(),
		id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_persona = idPersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_producto`(IN descripcion VARCHAR(50),
                    IN talla VARCHAR(50),
                    IN estado ENUM('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idPersona INT(11))
BEGIN
	UPDATE producto 
    SET descripcion = descripcion,
	talla = talla,
        estado = estado,
        genero = genero,
	fecha_modificacion = NOW(),
	id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_producto = idProducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_rol`(IN descripcion VARCHAR(50),
					IN estado enum('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idRol INT(11))
BEGIN
	UPDATE rol 
    SET descripcion = descripcion,
		estado = estado,
		fecha_modificacion = NOW(),
		id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_rol = idRol;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_usuario`(IN usuario VARCHAR(50),
					IN contrasenia VARCHAR(50),
                    IN fechaActivacion DATETIME,
                    IN fechaExpiracion DATETIME,
                    IN idPersona INT(11),
					IN estado enum('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idUsuario INT(11))
BEGIN
	UPDATE usuario 
    SET usuario = usuario,
		contrasenia = contrasenia,
        fecha_activacion = fechaActivacion,
        fecha_expiracion = fechaExpiracion,
        id_persona = idPersona,
		estado = estado,
		fecha_modificacion = NOW(),
		id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_usuario = idUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_usuario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_usuario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_usuario_rol`(IN idUsuario INT(11),
					IN idRol INT(11),
					IN estado enum('0','1'),
                    IN idUsuarioModificacion INT(11),
                    IN idUsuarioRol INT(11))
BEGIN
	UPDATE usuario_rol 
    SET id_usuario = idUsuario,
		id_rol = idRol,
		estado = estado,
		fecha_modificacion = NOW(),
		id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_usuario_rol = idUsuarioRol;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
