/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - contex
*********************************************************************
*/

DROP DATABASE IF EXISTS contex;

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

CREATE TABLE `cargo` (`id_cargo` INT(11) NOT NULL AUTO_INCREMENT
					 ,`descripcion` VARCHAR(50) DEFAULT NULL
					 ,`estado` ENUM('0','1') NOT NULL
					 ,`fecha_creacion` DATETIME NOT NULL
					 ,`fecha_modificacion` DATETIME NOT NULL
					 ,`id_usuario_creacion` INT(11) NOT NULL
					 ,`id_usuario_modificacion` INT(11) NOT NULL
					 ,PRIMARY KEY (`id_cargo`)
					 ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `cargo` WRITE;

	INSERT INTO `cargo` (`id_cargo`,`descripcion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,'Administrador','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1)
	,(2,'Contador','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1)
	,(3,'Vendedor','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1)
	,(4,'Empleado','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1);

UNLOCK TABLES;

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (`id_categoria` INT(11) NOT NULL AUTO_INCREMENT
						 ,`descripcion` VARCHAR(50) NOT NULL
						 ,`estado` ENUM('0','1') NOT NULL
						 ,`fecha_creacion` DATETIME NOT NULL
						 ,`fecha_modificacion` DATETIME NOT NULL
						 ,`id_usuario_creacion` INT(11) NOT NULL
						 ,`id_usuario_modificacion` INT(11) NOT NULL
						 ,PRIMARY KEY (`id_categoria`)
						 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (`id_cliente` INT(11) NOT NULL AUTO_INCREMENT
						,`id_persona` INT(11) NOT NULL
						,`estado` ENUM('0','1') NOT NULL
						,`fecha_creacion` DATETIME NOT NULL
						,`fecha_modificacion` DATETIME NOT NULL
						,`id_usuario_creacion` INT(11) NOT NULL
						,`id_usuario_modificacion` INT(11) NOT NULL
						,PRIMARY KEY (`id_cliente`)
						,KEY `id_persona` (`id_persona`)
						,CONSTRAINT `fk_cliente_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `cliente` WRITE;

	INSERT INTO `cliente` (`id_cliente`,`id_persona`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,5,1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(2,6,1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(3,7,1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(4,8,1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(5,9,1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1);

UNLOCK TABLES;

/*Table structure for table `compra_venta` */

DROP TABLE IF EXISTS `compra_venta`;

CREATE TABLE `compra_venta` (`id_compra_venta` INT(11) NOT NULL AUTO_INCREMENT
							,`control` ENUM('Compra','Venta','Cotizacion') NOT NULL
							,`fecha` DATETIME NOT NULL
							,`descuento` DOUBLE DEFAULT NULL
							,`valor` DOUBLE NOT NULL
							,`id_cliente` INT(11) NOT NULL
							,`id_proveedor` INT(11) NOT NULL
							,`estado` ENUM('0','1') NOT NULL
							,`fecha_creacion` DATETIME NOT NULL
							,`fecha_modificacion` DATETIME NOT NULL
							,`id_usuario_creacion` INT(11) NOT NULL
							,`id_usuario_modificacion` INT(11) NOT NULL
							,PRIMARY KEY (`id_compra_venta`)
							,KEY `id_cliente` (`id_cliente`)
							,KEY `id_proveedor` (`id_proveedor`)
							,CONSTRAINT `compra_venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`)
							,CONSTRAINT `compra_venta_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `detalle_orden` */

DROP TABLE IF EXISTS `detalle_orden`;

CREATE TABLE `detalle_orden` (`id_detalle_orden` INT(11) NOT NULL AUTO_INCREMENT
							 ,`valor_inventario` DOUBLE NOT NULL
							 ,`valor_venta` DOUBLE NOT NULL
							 ,`cantidad` INT(11) NOT NULL
							 ,`id_orden` INT(11) NOT NULL
							 ,`id_producto` INT(11) NOT NULL
							 ,`fecha_creacion` DATETIME NOT NULL
							 ,`fecha_modificacion` DATETIME NOT NULL
							 ,`id_usuario_creacion` INT(11) NOT NULL
							 ,`id_usuario_modificacion` INT(11) NOT NULL
							 ,PRIMARY KEY (`id_detalle_orden`)
							 ,KEY `fk_detalle_orden_producto` (`id_producto`)
							 ,KEY `fk_detalle_orden_orden` (`id_orden`)
							 ,CONSTRAINT `fk_detalle_orden_orden` FOREIGN KEY (`id_orden`) REFERENCES `orden` (`id_orden`)
							 ,CONSTRAINT `fk_detalle_orden_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
							 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (`id_empleado` INT(11) NOT NULL AUTO_INCREMENT
						,`id_cargo` INT(11) NOT NULL
						,`correo_institucional` VARCHAR(50) NOT NULL
						,`fecha_ingreso` date NOT NULL
						,`arl` VARCHAR(20) NOT NULL
						,`salud` VARCHAR(20) NOT NULL
						,`pension` VARCHAR(20) NOT NULL
						,`id_persona` INT(11) NOT NULL
						,`sueldo_basico` DOUBLE DEFAULT NULL
						,`estado` ENUM('0','1') NOT NULL
						,`fecha_creacion` DATETIME NOT NULL
						,`fecha_modificacion` DATETIME NOT NULL
						,`id_usuario_creacion` INT(11) NOT NULL
						,`id_usuario_modificacion` INT(11) NOT NULL
						,PRIMARY KEY (`id_empleado`)
						,KEY `id_persona` (`id_persona`)
						,KEY `id_cargo` (`id_cargo`)
						,CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
						,CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`)
						) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `empleado` WRITE;
	
	INSERT INTO `empleado` (`id_empleado`,`id_cargo`,`correo_institucional`,`fecha_ingreso`,`arl`,`salud`,`pension`,`id_persona`,`sueldo_basico`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,1,'cargon@contex.com','2021-05-08','Equidad Seguros','Comfamiliar','Colpesiones',2,1200000,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1)
	,(2,2,'yestov@contex.com','2021-05-08','Equidad Seguros','Comfamiliar','Colpesiones',1,1200000,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1)
	,(3,3,'yestov@contex.com','2021-05-08','Equidad Seguros','Comfamiliar','Colpesiones',1,1200000,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1)
	,(4,4,'aletov@context.com','2021-05-08','Equidad Seguros','Comfamiliar','Colpesiones',3,1200000,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1);

UNLOCK TABLES;

/*Table structure for table `formulario` */

DROP TABLE IF EXISTS `formulario`;

CREATE TABLE `formulario` (`id_formulario` INT(11) NOT NULL AUTO_INCREMENT
							,`descripcion` VARCHAR(50) NOT NULL
							,`etiqueta` VARCHAR(30) NOT NULL
							,`ubicacion` VARCHAR(100) NOT NULL
							,`estado` ENUM('0','1') NOT NULL
							,`fecha_creacion` DATETIME NOT NULL
							,`fecha_modificacion` DATETIME NOT NULL
							,`id_usuario_creacion` INT(11) NOT NULL
							,`id_usuario_modificacion` INT(11) NOT NULL
							,PRIMARY KEY (`id_formulario`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `formulario` WRITE;

	INSERT INTO `formulario` (`id_formulario`,`descripcion`,`etiqueta`,`ubicacion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,'formulario','Seguridad','./vista/Seguridad/formulario.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(2,'formulario rol','Seguridad','./vista/Seguridad/formularioRol.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(3,'persona','Seguridad','./vista/Seguridad/persona.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(4,'rol','Seguridad','./vista/Seguridad/rol.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(5,'usuario','Seguridad','./vista/Seguridad/usuario.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(6,'cargo','Nomina','./vista/Nomina/cargo.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(7,'empleado','Nomina','./vista/Nomina/empleado.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(8,'generar pago','Nomina','./vista/Nomina/generarPago.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(9,'pago dia','Nomina','./vista/Nomina/pagoDia.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(10,'categoria','Producción','./vista/Producción/categoria.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(11,'detalle orden','Producción','./vista/Producción/detalleOrden.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(12,'insumo','Producción','./vista/Producción/insumo.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(13,'orden','Producción','./vista/Producción/orden.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(14,'producto','Producción','./vista/Producción/producto.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(15,'tarea','Producción','./vista/Producción/tarea.V.html',1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1);

UNLOCK TABLES;

/*Table structure for table `formulario_rol` */

DROP TABLE IF EXISTS `formulario_rol`;

CREATE TABLE `formulario_rol` (`id_formulario_rol` INT(11) NOT NULL AUTO_INCREMENT
								,`id_rol` INT(11) NOT NULL
								,`id_formulario` INT(11) NOT NULL
								,`estado` ENUM('0','1') NOT NULL
								,`fecha_creacion` DATETIME NOT NULL
								,`fecha_modificacion` DATETIME NOT NULL
								,`id_usuario_creacion` INT(11) NOT NULL
								,`id_usuario_modificacion` INT(11) NOT NULL
								,PRIMARY KEY (`id_formulario_rol`)
								,KEY `id_rol` (`id_rol`)
								,KEY `id_formulario` (`id_formulario`)
								,CONSTRAINT `formulario_rol_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
								,CONSTRAINT `formulario_rol_ibfk_2` FOREIGN KEY (`id_formulario`) REFERENCES `formulario` (`id_formulario`)
								) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `formulario_rol` WRITE;

	INSERT INTO `formulario_rol` (`id_formulario_rol`,`id_rol`,`id_formulario`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,1,1,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(2,1,2,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(3,1,3,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(4,1,4,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(5,1,5,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(6,1,6,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(7,1,7,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(8,1,8,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(9,1,9,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(10,1,10,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(11,1,11,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(12,1,12,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(13,1,13,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(14,1,14,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
	(15,1,15,1,'2021-05-10 22:22:00','2021-05-10 22:22:00',1,1);

UNLOCK TABLES;

/*Table structure for table `generar_pago` */

DROP TABLE IF EXISTS `generar_pago`;

CREATE TABLE `generar_pago` (`id_generar_pago` INT(11) NOT NULL AUTO_INCREMENT
							,`valor_pago` DOUBLE NOT NULL
							,`deduccion` DOUBLE NOT NULL
							,`fecha_inicio` DATETIME NOT NULL
							,`fecha_fin` DATETIME NOT NULL
							,`id_empleado` INT(11) NOT NULL
							,`estado` ENUM('0','1') NOT NULL
							,`fecha_creacion` DATETIME NOT NULL
							,`fecha_modificacion` DATETIME NOT NULL
							,`id_usuario_creacion` INT(11) NOT NULL
							,`id_usuario_modificacion` INT(11) NOT NULL
							,PRIMARY KEY (`id_generar_pago`)
							,KEY `id_empleado` (`id_empleado`)
							,CONSTRAINT `generar_pago_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `orden` */

DROP TABLE IF EXISTS `orden`;

CREATE TABLE `orden` (`id_orden` INT(11) NOT NULL AUTO_INCREMENT
					 ,`fecha_orden` DATETIME NOT NULL
					 ,`fecha_entrega` DATETIME NOT NULL
					 ,`descripcion` VARCHAR(100) NOT NULL
					 ,`id_cliente` INT(11) NOT NULL
					 ,`id_empleado` INT(11) NOT NULL
					 ,`estado` ENUM('0','1') NOT NULL
					 ,`fecha_creacion` DATETIME NOT NULL
					 ,`fecha_modificacion` DATETIME NOT NULL
					 ,`id_usuario_creacion` INT(11) NOT NULL
					 ,`id_usuario_modificacion` INT(11) NOT NULL
					 ,PRIMARY KEY (`id_orden`)
					 ,KEY `id_cliente` (`id_cliente`)
					 ,KEY `id_empleado` (`id_empleado`)
					 ,CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`)
					 ,CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
					 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `pago_dia` */

DROP TABLE IF EXISTS `pago_dia`;

CREATE TABLE `pago_dia` (`id_pago_dia` INT(11) NOT NULL AUTO_INCREMENT
						,`id_empleado` INT(11) NOT NULL
						,`pago_dia` DOUBLE NOT NULL
						,`estado` ENUM('0','1') NOT NULL
						,`fecha_creacion` DATETIME NOT NULL
						,`fecha_modificacion` DATETIME NOT NULL
						,`id_usuario_creacion` INT(11) NOT NULL
						,`id_usuario_modificacion` INT(11) NOT NULL
						,PRIMARY KEY (`id_pago_dia`)
						,KEY `id_empleado` (`id_empleado`)
						,CONSTRAINT `pago_dia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (`id_persona` INT(11) NOT NULL AUTO_INCREMENT
						,`nombre` VARCHAR(100) NOT NULL
						,`apellido` VARCHAR(100) NOT NULL
						,`edad` INT(11) NOT NULL
						,`genero` ENUM('M','F') NOT NULL
						,`estado` ENUM('0','1') NOT NULL
						,`fecha_creacion` DATETIME NOT NULL
						,`fecha_modificacion` DATETIME NOT NULL
						,`id_usuario_creacion` INT(11) NOT NULL
						,`id_usuario_modificacion` INT(11) NOT NULL
						,PRIMARY KEY (`id_persona`)
						) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `persona` WRITE;

	/*Data for the table `persona` */

	INSERT INTO `persona`(`id_persona`,`nombre`,`apellido`,`edad`,`genero`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES 
	(1,'Yesica','Tovar',26,'F','1','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1)
	,(3,'Alejandra','Tovar',22,'F','1','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1)
	,(2,'Carmenza','Gonzalez',42,'F','1','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1)
	,(4,'Costurera','SiDatos',11,'F','0','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1)
	,(5,'Cliente#1','ACliente#1',101,'M','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(6,'Cliente#2','ACliente#2',102,'F','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(7,'Cliente#3','ACliente#3',103,'M','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(8,'Cliente#4','ACliente#4',104,'F','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1)
	,(9,'Cliente#5','ACliente#5',105,'M','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1);

UNLOCK TABLES;

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (`id_producto` INT(11) NOT NULL AUTO_INCREMENT
						,`descripcion` VARCHAR(100) NOT NULL
						,`talla` VARCHAR(50) NOT NULL
						,`estado` ENUM('0','1') NOT NULL
						,`id_categoria` INT(11) NOT NULL
						,`fecha_creacion` DATETIME NOT NULL
						,`fecha_modificacion` DATETIME NOT NULL
						,`id_usuario_creacion` INT(11) NOT NULL
						,`id_usuario_modificacion` INT(11) NOT NULL
						,PRIMARY KEY (`id_producto`)
						,KEY `fk_producto_categoria` (`id_categoria`)
						,CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (`id_proveedor` INT(11) NOT NULL AUTO_INCREMENT
						 ,`id_persona` INT(11) NOT NULL
						 ,`estado` ENUM('0','1') NOT NULL
						 ,`fecha_creacion` DATETIME NOT NULL
						 ,`fecha_modificacion` DATETIME NOT NULL
						 ,`id_usuario_creacion` INT(11) NOT NULL
						 ,`id_usuario_modificacion` INT(11) NOT NULL
						 ,PRIMARY KEY (`id_proveedor`)
						 ,KEY `id_persona` (`id_persona`)
						 ,CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
						 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (`id_rol` INT(11) NOT NULL AUTO_INCREMENT
					,`descripcion` VARCHAR(50) NOT NULL
					,`estado` ENUM('0','1') NOT NULL
					,`fecha_creacion` DATETIME NOT NULL
					,`fecha_modificacion` DATETIME NOT NULL
					,`id_usuario_creacion` INT(11) NOT NULL
					,`id_usuario_modificacion` INT(11) NOT NULL
					,PRIMARY KEY (`id_rol`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `rol` WRITE;

	INSERT INTO `rol` (`id_rol`,`descripcion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,'admin',1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
	(2,'contador',1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
	(3,'vendedor',1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
	(4,'empleado',1,'2021-05-10 20:00:00','2021-05-10 20:00:00',1,1);

UNLOCK TABLES;

/*Table structure for table `tarea` */

DROP TABLE IF EXISTS `tarea`;

CREATE TABLE `tarea` (`id_tarea` INT(11) NOT NULL AUTO_INCREMENT
					 ,`descripcion` VARCHAR(100) NOT NULL
					 ,`valor_unitario` DOUBLE NOT NULL
					 ,`cantidad` INT(11) NOT NULL
					 ,`fecha` DATETIME NOT NULL
					 ,`estado_pago` ENUM('por pagar','pagado') NOT NULL
					 ,`id_empleado` INT(11) NOT NULL
					 ,`estado` ENUM('0','1') NOT NULL
					 ,`fecha_creacion` DATETIME NOT NULL
					 ,`fecha_modificacion` DATETIME NOT NULL
					 ,`id_usuario_creacion` INT(11) NOT NULL
					 ,`id_usuario_modificacion` INT(11) NOT NULL
					 ,PRIMARY KEY (`id_tarea`)
					 ,KEY `id_empleado` (`id_empleado`)
					 ,CONSTRAINT `fk_tarea_id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
					 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tipo_pago` */

DROP TABLE IF EXISTS `tipo_pago`;

CREATE TABLE `tipo_pago` (`id_tipo_pago` INT(11) NOT NULL AUTO_INCREMENT
						 ,`descripcion` VARCHAR(100) NOT NULL
						 ,`estado` ENUM('0','1') NOT NULL
						 ,`fecha_creacion` DATETIME NOT NULL
						 ,`fecha_modificacion` DATETIME NOT NULL
						 ,`id_usuario_creacion` INT(11) NOT NULL
						 ,`id_usuario_modificacion` INT(11) NOT NULL
						 ,PRIMARY KEY (`id_tipo_pago`)
						 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (`id_usuario` INT(11) NOT NULL AUTO_INCREMENT
						,`usuario` VARCHAR(50) NOT NULL
						,`contrasenia` VARCHAR(50) NOT NULL
						,`fecha_activacion` DATETIME NOT NULL
						,`fecha_expiracion` DATETIME NOT NULL
						,`id_persona` INT(11) NOT NULL
						,`estado` ENUM('0','1') NOT NULL
						,`fecha_creacion` DATETIME NOT NULL
						,`fecha_modificacion` DATETIME NOT NULL
						,`id_usuario_creacion` INT(11) NOT NULL
						,`id_usuario_modificacion` INT(11) NOT NULL
						,PRIMARY KEY (`id_usuario`)
						,KEY `id_persona` (`id_persona`)
						,CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `usuario` WRITE;
	
	INSERT INTO `usuario` (`id_usuario`,`usuario`,`contrasenia`,`fecha_activacion`,`fecha_expiracion`,`id_persona`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) VALUES
	(1,'admin','admin','2021-05-08 01:35:00','2022-05-08 01:35:00',1,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1);

UNLOCK TABLES;

/*Table structure for table `usuario_rol` */

DROP TABLE IF EXISTS `usuario_rol`;

CREATE TABLE `usuario_rol` (`id_usuario_rol` INT(11) NOT NULL AUTO_INCREMENT
							,`id_usuario` INT(11) NOT NULL
							,`id_rol` INT(11) NOT NULL
							,`estado` ENUM('0','1') NOT NULL
							,`fecha_creacion` DATETIME NOT NULL
							,`fecha_modificacion` DATETIME NOT NULL
							,`id_usuario_creacion` INT(11) NOT NULL
							,`id_usuario_modificacion` INT(11) NOT NULL
							,PRIMARY KEY (`id_usuario_rol`)
							,KEY `id_usuario` (`id_usuario`)
							,KEY `id_rol` (`id_rol`)
							,CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
							,CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Procedure structure for procedure `Agregar_cargo` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_cargo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_cargo`(IN descripcion VARCHAR(50)
																	,IN estado ENUM('0','1')
																	,IN idUsuarioCreacion INT(11)
																	,IN idUsuarioModificacion INT(11)
																	)
BEGIN
	INSERT INTO cargo(descripcion
					 ,estado
					 ,fecha_creacion
					 ,fecha_modificacion
					 ,id_usuario_creacion
					 ,id_usuario_modificacion
					 )
	VALUES (descripcion
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_categoria` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_categoria` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_categoria`(IN descripcion VARCHAR(50)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
	INSERT INTO categoria(descripcion
						 ,estado
						 ,fecha_creacion
						 ,fecha_modificacion
						 ,id_usuario_creacion
						 ,id_usuario_modificacion
						 )
   VALUES (descripcion
   			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_cliente`(IN idPersona INT(11)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
	INSERT INTO persona(id_persona
						,estado
						,fecha_creacion
						,fecha_modificacion
						,id_usuario_creacion
						,id_usuario_modificacion
						) 
	VALUES (idPersona
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_detalle_orden` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_detalle_orden` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_detalle_orden`(IN valorInventario DOUBLE
																			,IN valorVenta DOUBLE
																			,IN cantidad INT(11)
																			,IN idOrden INT(11)
																			,IN idProducto INT(11)
																			,IN idUsuarioCreacion INT(11)
																			,IN idUsuarioModificacion INT(11)
																			)
BEGIN
	INSERT INTO detalle_orden(valor_inventario
							 ,valor_venta
							 ,cantidad
							 ,id_orden
							 ,id_producto
							 ,fecha_creacion
							 ,fecha_modificacion
							 ,id_usuario_creacion
							 ,id_usuario_modificacion
							 ) 
	VALUES (valorInventario
			,valorVenta
			,cantidad
			,idOrden
			,idProducto
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_empleado`(IN idCargo INT(11)
																		,IN correoInstitucional VARCHAR(50)
																		,IN fechaIngreso DATE
																		,IN arl VARCHAR(20)
																		,IN salud VARCHAR(20)
																		,IN pension VARCHAR(20)
																		,IN idPersona INT(11)
																		,IN sueldoBasico DOUBLE
																		,iN estado ENUM('0','1')
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
	INSERT INTO empleado(id_cargo
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
	VALUES(idCargo
			,correoInstitucional
			,fechaIngreso
			,arl
			,salud
			,pension
			,idPersona
			,sueldoBasico
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_formulario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_formulario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_formulario`(IN descripcion VARCHAR(50)
																		 ,IN etiqueta VARCHAR(30)
																		 ,IN ubicacion VARCHAR(100)
																		 ,IN estado ENUM('0','1')
																		 ,IN idUsuarioCreacion INT(11)
																		 ,IN idUsuarioModificacion INT(11)
																		 )
BEGIN
	INSERT INTO formulario(descripcion
							,etiqueta
							,ubicacion
							,estado
							,fecha_creacion
							,fecha_modificacion
							,id_usuario_creacion
							,id_usuario_modificacion
							) 
	VALUES (descripcion
			,etiqueta
			,ubicacion
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_formulario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_formulario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_formulario_rol`(IN idRol INT(11)
																				,IN idFormulario INT(11)
																				,IN estado ENUM('0','1')
																				,IN idUsuarioCreacion INT(11)
																				,IN idUsuarioModificacion INT(11)
																				)
BEGIN
	INSERT INTO formulario_rol(id_rol
								,id_formulario
								,estado
								,fecha_creacion
								,fecha_modificacion
								,id_usuario_creacion
								,id_usuario_modificacion
								) 
	VALUES (idRol
			,idFormulario
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_generar_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_generar_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_generar_pago`(IN valorPago DOUBLE
																			,IN deduccion DOUBLE
																			,IN fechaInicio DATETIME
																			,IN fechaFin DATETIME
																			,IN idEmpleado INT(11)
																			,IN idUsuarioCreacion INT(11)
																			,IN idUsuarioModificacion INT(11)
																			)
BEGIN
	INSERT INTO generar_pago(valor_pago
							,deduccion
							,fecha_inicio
							,fecha_fin
							,id_empleado
							,fecha_creacion
							,fecha_modificacion
							,id_usuario_creacion
							,id_usuario_modificacion
							) 
	VALUES (valorPago
			,deduccion
			,fechaInicio
			,fechaFin
			,idEmpleado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_orden` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_orden` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_orden`(IN fechaOrden DATETIME
																	,IN fechaEntrega DATETIME
																	,IN descripcion VARCHAR(50)
																	,IN idCliente INT(11)
																	,IN idEmpleado INT(11)
																	,IN estado ENUM('0','1')
																	,IN idUsuarioCreacion INT(11)
																	,IN idUsuarioModificacion INT(11)
																	)
BEGIN
	INSERT INTO orden(fecha_orden
					 ,fecha_entrega
					 ,descripcion
					 ,id_cliente
					 ,id_empleado
					 ,estado
					 ,fecha_creacion
					 ,fecha_modificacion
					 ,id_usuario_creacion
					 ,id_usuario_modificacion
					 ) 
	VALUES (fechaOrden
		   ,fechaEntrega
		   ,descripcion
		   ,idCliente
		   ,idEmpleado
		   ,estado
		   ,NOW()
		   ,NOW()
		   ,idUsuarioCreacion
		   ,idUsuarioModificacion
           );
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_pago_dia` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_pago_dia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_pago_dia`(IN idEmpleado INT(11)
																		,IN pagoDia DOUBLE
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
	INSERT INTO pago_dia(id_empleado
						,pago_dia
						,fecha_creacion
						,fecha_modificacion
						,id_usuario_creacion
						,id_usuario_modificacion
						) 
	VALUES (idEmpleado
			,pagoDia
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_persona`(IN nombre VARCHAR(100)
																		,IN apellido VARCHAR(100)
																		,IN edad INT(11)
																		,IN genero ENUM('M','F')
																		,IN estado ENUM('0','1')
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
INSERT INTO persona(nombre
					,apellido
					,edad
					,genero
					,estado
					,fecha_creacion
					,fecha_modificacion
					,id_usuario_creacion
					,id_usuario_modificacion
					) 
VALUES (nombre
		,apellido
		,edad
		,genero
		,estado
		,NOW()
		,NOW()
		,idUsuarioCreacion
		,idUsuarioModificacion
		);	
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_producto`(IN `descripcion` VARCHAR(50)
																		,IN `talla` INT(11)
																		,IN `estado` ENUM('0','1')
																		,IN `idCategoria` INT(11)
																		,IN `idUsuarioCreacion` INT(11)
																		,IN `idUsuarioModificacion` INT(11)
																		)
BEGIN
	INSERT INTO producto(descripcion
						,talla
						,estado
						,id_categoria
						,fecha_creacion
						,fecha_modificacion
						,id_usuario_creacion
						,id_usuario_modificacion
						) 
	VALUES (descripcion
			,talla
			,estado
			,idCategoria
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_rol`(IN descripcion VARCHAR(50)
																	,IN estado ENUM('0','1')
																	,IN idUsuarioCreacion INT(11)
																	,IN idUsuarioModificacion INT(11)
																	)
BEGIN
	INSERT INTO rol(descripcion
					,estado
					,fecha_creacion
					,fecha_modificacion
					,id_usuario_creacion
					,id_usuario_modificacion
					) 
	VALUES (descripcion
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_tarea` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_tarea` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_tarea`(IN descripcion VARCHAR(100)
																	,IN valorUnitario DOUBLE
																	,IN cantidad INT(11)
																	,in fecha DATETIME
																	,IN estadoPago ENUM('0','1')
																	,in idEmpleado INT(11)
																	,in estado ENUM('0','1')
																	,IN idUsuarioCreacion INT(11)
																	,IN idUsuarioModificacion INT(11)
																	)
BEGIN
	INSERT INTO rol(descripcion
					,valor_unitario
					,cantidad
					,fecha
					,estado_pago
					,id_empleado
					,estado
					,fecha_creacion
					,fecha_modificacion
					,id_usuario_creacion
					,id_usuario_modificacion
					) 
	VALUES(descripcion
			,valorUnitario
			,cantidad
			,fecha
			,estadoPago
			,idEmpleado
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_tipo_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_tipo_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_tipo_pago`(IN descripcion VARCHAR(100)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
	INSERT INTO tipo_pago(descripcion
						 ,estado
						 ,fecha_creacion
						 ,fecha_modificacion
						 ,id_usuario_creacion
						 ,id_usuario_modificacion
						 ) 
	VALUES (descripcion
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_usuario`(IN usuario VARCHAR(50)
																		,IN contrasenia VARCHAR(50)
																		,IN fechaActivacion DATETIME
																		,IN fechaExpiracion DATETIME
																		,IN idPersona INT(11)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioCreacion INT(11)
																		,IN idUsuarioModificacion INT(11)
																		)
BEGIN
	INSERT INTO usuario(usuario
						,contrasenia
						,fecha_activacion
						,fecha_expiracion
						,id_persona
						,estado
						,fecha_creacion
						,fecha_modificacion
						,id_usuario_creacion
						,id_usuario_modificacion
						) 
	VALUES (usuario
			,contrasenia
			,fechaActivacion
			,fechaExpiracion
			,idPersona
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_usuario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_usuario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_usuario_rol`(IN idUsuario INT(11)
																			,IN idRol INT(11)
																			,IN estado ENUM('0','1')
																			,IN idUsuarioCreacion INT(11)
																			,IN idUsuarioModificacion INT(11)
																			)
BEGIN
	INSERT INTO usuario_rol(id_usuario
							,id_rol
							,estado
							,fecha_creacion
							,fecha_modificacion
							,id_usuario_creacion
							,id_usuario_modificacion
							) 
	VALUES (idUsuario
			,idRol
			,estado
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_cargo` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_cargo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_cargo`(IN descripcion VARCHAR(50)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioModificacion INT(11)
																		,IN idCargo INT(11)
																		)
BEGIN
	UPDATE cargo 
	SET descripcion = descripcion
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_cargo = idCargo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_categoria` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_categoria` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_categoria`(IN descripcion VARCHAR(50)
																			,IN estado ENUM('0','1')
																			,IN idUsuarioModificacion INT(11)
																			,IN idCategoria INT(11)
																			)
BEGIN
	UPDATE categoria 
	SET descripcion = descripcion
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion
	WHERE id_categoria = idCategoria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_cliente`(IN idPersona INT(11)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioModificacion INT(11)
																		,IN idCliente INT(11)
																		)
BEGIN
	UPDATE cliente 
	SET id_persona = idPersona
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_cliente = idCliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_empleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_empleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_empleado`(IN idCargo INT(11)
																			,IN correoInstitucional VARCHAR(50)
																			,IN fechaIngreso DATETIME
																			,IN arl VARCHAR (20)
																			,IN salud VARCHAR (20)
																			,IN pension VARCHAR (20)
																			,IN idPersona INT(11)
																			,IN sueldoBasico DOUBLE
																			,IN estado ENUM('0','1')
																			,IN idUsuarioModificacion INT(11)
																			,IN idEmpleado INT(11)
																			)
BEGIN
	UPDATE empleado 
	SET id_cargo = idCargo
		,correo_institucional = correoInstitucional
		,fecha_ingreso = fechaIngreso
		,arl = arl
		,salud = salud
		,pension = pension
		,id_persona = idPersona
		,sueldo_basico = sueldoBasico
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_empleado = idEmpleado;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_formulario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_formulario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_formulario`(IN descripcion VARCHAR(50)
																			,IN etiqueta VARCHAR(30)
																			,IN ubicacion VARCHAR(100)
																			,IN estado ENUM('0','1')
																			,IN idUsuarioModificacion INT(11)
																			,IN idFormulario INT(11)
																			)
BEGIN
	UPDATE formulario 
    SET descripcion = descripcion
		,etiqueta = etiqueta
		,ubicacion = ubicacion
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_formulario = idFormulario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_formulario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_formulario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_formulario_rol`(IN idRol INT(11)
																				,IN idFormulario INT(11)
																				,IN estado ENUM('0','1')
																				,IN idUsuarioModificacion INT(11)
																				,IN idFormularioRol INT(11)
																				)
BEGIN
	UPDATE formulario_rol 
    SET id_rol = idRol
		,id_formulario = idFormulario
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_formulario_rol = idFormularioRol;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_generar_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_generar_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_generar_pago`(IN valorPago DOUBLE
																				,IN deduccion DOUBLE
																				,IN fechaInicio DATETIME
																				,IN fechaFin DATETIME
																				,IN idEmpleado INT(11)
																				,IN idUsuarioModificacion INT(11)
																				,IN idGenerarPago INT(11)
																				)
BEGIN
	UPDATE generar_pago 
	SET valor_pago = valorPago
		,deduccion = deduccion
		,fecha_inicio = fechaInicio
		,fecha_fin = fechaFin
		,id_empleado = idEmpleado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_generar_pago = idGenerarPago;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_orden` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_orden` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_orden`(IN fechaOrden DATETIME
                                                                      ,IN fechaEntrega DATETIME
                                                                      ,IN descripcion VARCHAR(50)
                                                                      ,IN idCliente INT(11)
                                                                      ,IN idEmpleado INT(11)
                                                                      ,IN estado ENUM('0','1')
                                                                      ,IN idUsuarioModificacion INT(11)
																	  ,IN idOrden INT(11)
                                                                      )
BEGIN
	UPDATE orden 
	SET fecha_orden = fechaOrden
       ,fecha_entrega = fechaEntrega 
       ,descripcion = descripcion
       ,id_cliente = idCliente
       ,id_empleado = idEmpleado
       ,estado = estado
	   ,fecha_modificacion = NOW()
       ,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_orden = idOrden;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_pago_dia` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_pago_dia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_pago_dia`(IN idEmpleado INT(11)
																			,IN pagoDia DOUBLE
																			,IN estado ENUM('0','1')
																			,IN idUsuarioModificacion INT(11)
																			,IN idPagoDia INT(11)
																			)
BEGIN
	UPDATE pago_dia 
	SET id_empleado = idEmpleado
		,pago_dia = pagoDia
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE 
		id_pago_dia = idPagoDia;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_persona`(IN nombre VARCHAR(100)
																		,IN apellido VARCHAR(100)
																		,IN edad INT(11)
																		,IN genero ENUM('M','F')
																		,IN estado ENUM('0','1')
																		,IN idUsuarioModificacion INT(11)
																		,IN idPersona INT(11)
																		)
BEGIN
	UPDATE persona 
	SET nombre = nombre
		,apellido = apellido
		,edad = edad
		,genero = genero
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE
		id_persona = idPersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_producto`(IN `descripcion` VARCHAR(50)
																		 ,IN `talla` VARCHAR(50)
																		 ,IN `estado` ENUM('0','1')
																		 ,IN `idCategoria` INT
																		 ,IN `idUsuarioModificacion` INT(11)
																		 ,IN `idProducto` INT(11)
																		 )
BEGIN
	UPDATE producto 
    SET descripcion = descripcion
		,talla = talla
		,estado = estado
		,id_categoria = idCategoria
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_producto = idProducto;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_rol`(IN descripcion VARCHAR(50)
																	,in estado ENUM('0','1')
																	,IN idUsuarioModificacion INT(11)
																	,IN idRol INT(11)
																	)
BEGIN
	UPDATE rol 
	SET	descripcion = descripcion
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_rol = idRol;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_tarea` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_tarea` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_tarea`(IN descripcion VARCHAR(100)
																		,IN valorUnitario DOUBLE
																		,IN cantidad INT(11)
																		,IN fecha DATETIME
																		,IN estadoPago ENUM('0','1')
																		,IN idEmpleado INT(11)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioModificacion INT(11)
																		,IN idTarea INT(11)
																		)
BEGIN
	UPDATE rol
	set descripcion = descripcion
		,valor_unitario = valorUnitario
		,cantidad = cantidad
		,fecha = fecha
		,estado_pago = estadoPago
		,id_empleado = idEmpleado
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_Modificacion = idUsuarioModificacion
	WHERE
		id_tarea = idTarea;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_tipo_pago` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_tipo_pago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_tipo_pago`(IN descripcion VARCHAR(100)
																			,IN estado ENUM('0','1')
																			,IN idUsuarioModificacion INT(11)
																			,IN idTipoPago INT(11)
																			)
BEGIN
	UPDATE persona 
	SET descripcion = descripcion
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_tipo_pago = idTipoPago;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_usuario`(IN usuario VARCHAR(50)
																		,IN contrasenia VARCHAR(50)
																		,IN fechaActivacion DATETIME
																		,IN fechaExpiracion DATETIME
																		,IN idPersona INT(11)
																		,IN estado ENUM('0','1')
																		,IN idUsuarioModificacion INT(11)
																		,IN idUsuario INT(11)
																		)
BEGIN
	UPDATE usuario 
	SET usuario = usuario
		,contrasenia = contrasenia
		,fecha_activacion = fechaActivacion
		,fecha_expiracion = fechaExpiracion
		,id_persona = idPersona
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_usuario = idUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_usuario_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_usuario_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_usuario_rol`(IN idUsuario INT(11)
																			,IN idRol INT(11)
																			,IN estado ENUM('0','1')
																			,IN idUsuarioModificacion INT(11)
																			,IN idUsuarioRol INT(11)
																			)
BEGIN
	UPDATE usuario_rol 
	SET id_usuario = idUsuario
		,id_rol = idRol
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_usuario_rol = idUsuarioRol;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
