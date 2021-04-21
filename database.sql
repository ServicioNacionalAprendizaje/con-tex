/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.18-MariaDB : Database - contex
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
  `codigo_cargo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` bit(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cargo` */

LOCK TABLES `cargo` WRITE;

UNLOCK TABLES;

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cliente` */

LOCK TABLES `cliente` WRITE;

UNLOCK TABLES;

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
  PRIMARY KEY (`id_compra_venta`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `compra_venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `compra_venta_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `compra_venta` */

LOCK TABLES `compra_venta` WRITE;

UNLOCK TABLES;

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) NOT NULL,
  `correo_institucional` varchar(50) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `arl` enum('ARL1','ARL2','ARL3') NOT NULL,
  `salud` enum('salud1','salud2','salud3') NOT NULL,
  `pension` enum('pension1','pension2','pension3') NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `id_persona` (`id_persona`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `empleado` */

LOCK TABLES `empleado` WRITE;

UNLOCK TABLES;

/*Table structure for table `formulario` */

DROP TABLE IF EXISTS `formulario`;

CREATE TABLE `formulario` (
  `id_formulario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `etiqueta` varchar(30) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_formulario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `formulario` */

LOCK TABLES `formulario` WRITE;

UNLOCK TABLES;

/*Table structure for table `formulario_rol` */

DROP TABLE IF EXISTS `formulario_rol`;

CREATE TABLE `formulario_rol` (
  `id_formulario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `estado` bit(1) NOT NULL,
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

LOCK TABLES `formulario_rol` WRITE;

UNLOCK TABLES;

/*Table structure for table `generar_pago` */

DROP TABLE IF EXISTS `generar_pago`;

CREATE TABLE `generar_pago` (
  `id_generar_pago` int(11) NOT NULL AUTO_INCREMENT,
  `valor_pago` double NOT NULL,
  `deduccion` double NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_generar_pago`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `generar_pago_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `generar_pago` */

LOCK TABLES `generar_pago` WRITE;

UNLOCK TABLES;

/*Table structure for table `orden` */

DROP TABLE IF EXISTS `orden`;

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_persona` (`id_persona`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `orden` */

LOCK TABLES `orden` WRITE;

UNLOCK TABLES;

/*Table structure for table `pago_dia` */

DROP TABLE IF EXISTS `pago_dia`;

CREATE TABLE `pago_dia` (
  `id_pago_dia` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `pago_dia` double NOT NULL,
  PRIMARY KEY (`id_pago_dia`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `pago_dia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pago_dia` */

LOCK TABLES `pago_dia` WRITE;

UNLOCK TABLES;

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `estado` bit(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `persona` */

LOCK TABLES `persona` WRITE;

-- insert  into `persona`(`id_persona`,`nombre`,`apellido`,`edad`,`genero`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values (1,'Jesus','ArieÃ±',29,'','','2021-04-20 00:00:00','2021-04-20 00:00:00',0,0);

UNLOCK TABLES;

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `proveedor` */

LOCK TABLES `proveedor` WRITE;

UNLOCK TABLES;

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `estado` bit(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `rol` */

LOCK TABLES `rol` WRITE;

UNLOCK TABLES;

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
  PRIMARY KEY (`id_tarea`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tarea` */

LOCK TABLES `tarea` WRITE;

UNLOCK TABLES;

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `fecha_activacion` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` bit(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario` */

LOCK TABLES `usuario` WRITE;

UNLOCK TABLES;

/*Table structure for table `usuario_rol` */

DROP TABLE IF EXISTS `usuario_rol`;

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` bit(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fehca_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_rol`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario_rol` */

LOCK TABLES `usuario_rol` WRITE;

UNLOCK TABLES;

/* Procedure structure for procedure `Agregar_formulario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_formulario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_formulario`(IN descripcion VARCHAR(50),
					IN etiqueta VARCHAR(30),
                    IN ubicacion VARCHAR(100),
                    IN estado BIT(1),
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
                    IN estado BIT(1),
                    IN idUsuarioCreacion INT(11))
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
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_persona`(IN nombre VARCHAR(100),
					IN apellido VARCHAR(100),
                    IN edad INT(11),
                    IN genero ENUM('Masculino','Femenino','Otro'),
                    IN estado BIT(1),
                    IN idUsuarioCreacion INT(11))
BEGIN
	INSERT INTO persona(
					nombre,
                    apellido,
                    edad,
                    genero,
                    estado,
                    fecha_creacion,
                    fecha_modificacion,
                    id_usuario_creacion,
                    id_usuario_modificacion) 
			VALUES (
				nombre,
				apellido,
                edad,
                genero,
				estado,
				CURDATE(),
				CURDATE(),
				idUsuarioCreacion,
				idUsuarioCreacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_rol`(IN descripcion VARCHAR(50),
					IN estado BIT(1),
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
					IN estado BIT(1),
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
					IN estado BIT(1),
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

/* Procedure structure for procedure `Agregar_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_empleado`(IN idCargo INT(11),
					IN correoInstitucional VARCHAR(50),
                    IN fechaIngreso DATETIME,
                    IN arl ENUM('ARL1','ARL2','ARL3'),
                    IN salud ENUM('salud1','salud2','salud3'),
                    IN pension ENUM('pension1','pension2','pension3'),
					IN idPersona INT(11),
                    IN estado BIT(1))
BEGIN
	INSERT INTO empleado(
					id_cargo,
                    correo_institucional,
                    fecha_ingreso,
                    arl,
                    salud,
                    pension,
                    id_persona,
                    estado) 
			VALUES (
				idCargo,
                correoInstitucional,
				fechaIngreso,
				arl,
                salud,
                pension,
				idPersona,
				estado);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_empleado`(IN idCargo INT(11),
					IN correoInstitucional VARCHAR(50),
                    IN fechaIngreso DATETIME,
                    IN arl ENUM('ARL1','ARL2','ARL3'),
                    IN salud ENUM('salud1','salud2','salud3'),
                    IN pension ENUM('pension1','pension2','pension3'),
					IN idPersona INT(11),
                    IN estado BIT(1))
BEGIN
	UPDATE empleado 
    SET id_cargo = idCargo,
		correo_institucional = correoInstitucional,
		fecha_ingreso = fechaIngreso,
		arl = arl,
        salud = salud,
        pension = pension,
		id_persona = idPersona,
        estado = estado 
	WHERE id_empleado = idEmpleado;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_formulario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_formulario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_formulario`(IN descripcion VARCHAR(50),
					IN etiqueta VARCHAR(30),
                    IN ubicacion VARCHAR(100),
                    IN estado BIT(1),
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
                    IN estado BIT(1),
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

/* Procedure structure for procedure `Modificar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_persona`(IN nombre VARCHAR(100),
                    IN apellido VARCHAR(100),
                    IN edad INT(11),
                    IN genero ENUM('Masculino','Femenino','Otro'),
                    IN estado BIT(1),
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

/* Procedure structure for procedure `Modificar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_rol`(IN descripcion VARCHAR(50),
					IN estado BIT(1),
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
					IN estado BIT(1),
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
					IN estado BIT(1),
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
