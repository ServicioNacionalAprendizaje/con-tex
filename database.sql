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
(1,'Administrador','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(2,'Contador','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(3,'Costurer@','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(4,'Vendedor','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1);

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categoria` */

insert  into `categoria`(`id_categoria`,`descripcion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Camisas','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(2,'Pantalones','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(3,'Vestidos','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(4,'Sueteres','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(5,'Interiores','1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(8,'Resortes','1','2021-06-18 13:01:40','2021-06-18 13:01:40',1,1),
(9,'Botones','1','2021-06-18 13:02:06','2021-06-18 13:02:06',1,1);

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
  CONSTRAINT `fk_cliente_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cliente` */

insert  into `cliente`(`id_cliente`,`id_persona`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,5,'1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(2,6,'1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(3,7,'1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(4,8,'1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(5,9,'1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1);

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

/*Table structure for table `detalle_orden` */

DROP TABLE IF EXISTS `detalle_orden`;

CREATE TABLE `detalle_orden` (
  `id_detalle_orden` int(11) NOT NULL AUTO_INCREMENT,
  `valor_inventario` double NOT NULL,
  `valor_venta` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_orden`),
  KEY `fk_detalle_orden_producto` (`id_producto`),
  KEY `fk_detalle_orden_orden` (`id_orden`),
  CONSTRAINT `fk_detalle_orden_orden` FOREIGN KEY (`id_orden`) REFERENCES `orden` (`id_orden`),
  CONSTRAINT `fk_detalle_orden_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `detalle_orden` */

insert  into `detalle_orden`(`id_detalle_orden`,`valor_inventario`,`valor_venta`,`cantidad`,`id_orden`,`id_producto`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,1100,2100,10,1,1,'1','2021-05-26 19:07:00','2021-05-26 19:07:00',1,1),
(2,1200,2200,2,2,1,'1','2021-05-26 19:07:00','2021-05-26 19:07:00',1,1),
(3,1100,2300,20,1,2,'1','2021-05-27 19:07:00','2021-05-27 19:07:00',1,1),
(4,1300,2400,3,2,3,'1','2021-05-28 19:07:00','2021-05-28 19:07:00',1,1),
(5,1400,2500,3,3,4,'1','2021-05-29 19:07:00','2021-05-29 19:07:00',1,1),
(6,1500,2200,30,5,6,'0','2021-05-30 19:07:00','2021-05-30 19:07:00',1,1),
(7,1600,2700,40,3,3,'0','2021-05-31 19:07:00','2021-05-31 19:07:00',1,1);

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
  UNIQUE KEY `id_persona` (`id_persona`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `empleado` */

insert  into `empleado`(`id_empleado`,`id_cargo`,`correo_institucional`,`fecha_ingreso`,`arl`,`salud`,`pension`,`id_persona`,`sueldo_basico`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,1,'cargon@contex.coma','2021-06-01','Equidad Seguros','Comfamiliar','Colpesiones',1,22,'1','2021-05-08 01:35:00','2021-06-01 21:39:51',1,1),
(2,2,'yestov@contex.com','2021-05-08','Equidad Seguros','Comfamiliar','Colpesiones',2,1200000,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(4,4,'aletov@context.com','2021-05-08','Equidad Seguros','Comfamiliar','Colpesiones',4,1200000,'1','2021-05-08 01:35:00','2021-05-08 01:35:00',1,1),
(7,1,'hola@mundo.co','2021-06-01','Seguros Bolivar','Sanitas','Proteccion',5,1789,'1','2021-05-27 13:58:47','2021-06-01 21:40:36',1,1),
(8,3,'aletov@contex.com','2021-06-01','Equidad Seguros','Comfamiliar','Colpesiones',3,1200000,'1','2021-06-01 23:29:33','2021-06-01 23:29:33',1,1),
(9,1,'edurado.andres@gmail.com','2021-06-01','Sura','Nueva Eps','Colpesiones',11,3000000,'1','2021-06-01 23:33:55','2021-06-01 23:33:55',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `formulario` */

insert  into `formulario`(`id_formulario`,`descripcion`,`etiqueta`,`ubicacion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Formulario','Seguridad','./vista/seguridad/formulario.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(2,'Formularios de rol','Seguridad','./vista/seguridad/formularioRol.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(3,'Persona','Seguridad','./vista/seguridad/persona.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(4,'Rol','Seguridad','./vista/seguridad/rol.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(5,'Usuario','Seguridad','./vista/seguridad/usuario.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(6,'Cargo','Nomina','./vista/nomina/cargo.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(7,'Empleado','Nomina','./vista/nomina/empleado.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(8,'Generar pago','Nomina','./vista/nomina/generarPago.V.php','1','2021-05-10 22:22:00','2021-06-12 20:48:28',1,1),
(9,'Pago del dia','Nomina','./vista/nomina/pagoDia.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(10,'Categoria','Produccion','./vista/produccion/categoria.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(11,'Detalles de orden','Produccion','./vista/produccion/detalleOrden.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(12,'Orden de produccion','Produccion','./vista/produccion/orden.V.php','1','2021-05-10 22:22:00','2021-06-18 13:04:47',1,1),
(13,'Producto','Produccion','./vista/produccion/producto.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(14,'Tarea','Produccion','./vista/produccion/tarea.V.php','1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(15,'Rol de usuario','Seguridad','./vista/seguridad/usuarioRol.V.php','1','2021-05-10 22:22:00','2021-06-01 23:31:39',1,1),
(17,'Insumo','Produccion','./vista/produccion/insumo.V.php','1','2021-06-11 00:24:18','2021-06-11 00:24:18',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `formulario_rol` */

insert  into `formulario_rol`(`id_formulario_rol`,`id_rol`,`id_formulario`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,1,1,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(2,1,2,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(3,1,3,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(4,1,4,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(5,1,5,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(6,1,6,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(7,1,7,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(8,1,8,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(9,1,9,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(10,1,10,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(11,1,11,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(12,1,12,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(13,1,13,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(14,1,14,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(15,1,15,'1','2021-05-10 22:22:00','2021-05-10 22:22:00',1,1),
(20,1,16,'1','2021-06-01 23:32:08','2021-06-01 23:32:08',1,1),
(21,1,17,'1','2021-06-11 00:25:07','2021-06-11 00:25:07',1,1);

/*Table structure for table `generar_pago` */

DROP TABLE IF EXISTS `generar_pago`;

CREATE TABLE `generar_pago` (
  `id_generar_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_pago` date NOT NULL,
  `valor_pago` double NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_generar_pago`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `generar_pago_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `generar_pago` */

insert  into `generar_pago`(`id_generar_pago`,`id_empleado`,`fecha_inicio`,`fecha_fin`,`fecha_pago`,`valor_pago`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(19,1,'2021-05-01','2021-05-22','2021-06-19',126000,'2021-06-19 17:48:36','2021-06-19 17:48:36',1,1),
(20,1,'2021-05-01','2021-05-31','2021-06-19',171000,'2021-06-19 17:53:45','2021-06-19 17:53:45',1,1),
(21,1,'2021-05-01','2021-05-31','2021-06-18',171000,'2021-06-19 17:55:00','2021-06-19 17:55:00',1,1),
(22,1,'2021-05-01','2021-05-31','2021-06-19',171000,'2021-06-19 18:03:27','2021-06-19 18:03:27',1,1);

/*Table structure for table `insumo` */

DROP TABLE IF EXISTS `insumo`;

CREATE TABLE `insumo` (
  `id_insumo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` enum('0','1') CHARACTER SET utf8mb4 NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_insumo`),
  KEY `fk_insumo_categoria` (`id_categoria`),
  CONSTRAINT `fk_insumo_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `insumo` */

insert  into `insumo`(`id_insumo`,`descripcion`,`id_categoria`,`cantidad`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Boton azul',9,14,'1','2021-06-10 21:27:19','2021-06-18 13:02:41',1,1),
(2,'Agujas 2',2,15,'0','2021-06-10 23:19:40','2021-06-18 13:00:16',1,1);

/*Table structure for table `orden` */

DROP TABLE IF EXISTS `orden`;

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `orden` */

insert  into `orden`(`id_orden`,`fecha_orden`,`fecha_entrega`,`descripcion`,`id_cliente`,`id_empleado`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'2021-05-21 07:00:00','2021-06-21 07:00:00','Camisas x 10',5,1,'1','2021-05-21 07:00:00','2021-05-21 07:00:00',1,1),
(2,'2021-05-22 08:00:00','2021-05-27 08:00:00','Pantalones x 2',4,2,'1','2021-05-22 08:00:00','2021-05-22 08:00:00',1,1),
(3,'2021-05-22 09:00:00','2021-06-22 09:00:00','Medias x 20',3,9,'1','2021-05-22 09:00:00','2021-05-22 09:00:00',1,1),
(4,'2021-05-23 10:00:00','2021-06-13 10:00:00','Vestidos x 3',2,4,'0','2021-05-23 10:00:00','2021-05-23 10:00:00',1,1),
(5,'2021-05-23 11:00:00','2021-06-16 11:00:00','Sacos x 3',1,1,'1','2021-05-23 11:00:00','2021-05-23 11:00:00',1,1);

/*Table structure for table `pago_dia` */

DROP TABLE IF EXISTS `pago_dia`;

CREATE TABLE `pago_dia` (
  `id_pago_dia` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `pago_dia` double NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_pago_dia` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_pago_dia`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `pago_dia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pago_dia` */

insert  into `pago_dia`(`id_pago_dia`,`id_empleado`,`pago_dia`,`estado`,`fecha_pago_dia`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,1,45000,'1','2021-05-31','2021-06-01 23:24:33','2021-06-01 23:24:33',1,1),
(2,2,35000,'0','2021-06-01','2021-06-01 23:25:04','2021-06-01 23:25:04',1,1),
(3,1,42000,'1','2021-05-12','2021-06-01 23:26:09','2021-06-01 23:26:09',1,1),
(4,1,42000,'1','2021-05-13','2021-06-01 23:26:32','2021-06-01 23:26:32',1,1),
(5,1,42000,'1','2021-05-22','2021-06-01 23:26:55','2021-06-01 23:26:55',1,1),
(6,8,50000,'0','2021-04-06','2021-06-01 23:30:00','2021-06-01 23:30:00',1,1),
(7,2,36000,'1','2021-06-12','2021-06-12 18:32:53','2021-06-12 18:32:53',1,1);

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `tipo_documento` set('CC','TI','CE','PEP') NOT NULL DEFAULT '',
  `documento` int(11) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` enum('M','F','O') NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `documento` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `persona` */

insert  into `persona`(`id_persona`,`nombre`,`apellido`,`tipo_documento`,`documento`,`edad`,`genero`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Yesica','Tovar','CC',10101010,26,'F','1','2021-04-22 00:00:00','2021-06-07 15:35:35',1,1),
(2,'Carmenza','Gonzalez','CC',1075264422,42,'F','1','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1),
(3,'Alejandra','Tovar','CC',1075264423,22,'F','1','2021-04-22 00:00:00','2021-04-22 00:00:00',1,1),
(4,'Costurera','Sin Datos','CC',1075264424,11,'M','0','2021-04-22 00:00:00','2021-06-07 16:16:42',1,1),
(5,'Cliente#1','ACliente#1','TI',1075264425,17,'O','0','2021-05-10 20:00:00','2021-06-07 15:51:07',1,1),
(6,'Cliente#2','ACliente#2','CC',1075264426,102,'F','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(7,'Cliente#3','ACliente#3','TI',1075264427,18,'O','1','2021-05-10 20:00:00','2021-06-07 15:55:47',1,1),
(8,'Cliente#4','ACliente#4','CC',1075264428,104,'F','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(9,'Cliente#5','ACliente#5','CC',1075264429,105,'M','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(10,'Wilmer','Vargas Bautista','CC',1075250180,30,'M','1','2021-06-01 23:30:41','2021-06-01 23:30:41',1,1),
(11,'Oscar Leonardo','Perdomo','CC',1081158586,26,'M','1','2021-06-01 23:14:56','2021-06-01 23:14:56',1,1),
(12,'Eduardo Andres','Peña Rojas','CC',1075264436,28,'M','1','2021-06-07 16:35:22','2021-06-07 16:35:22',1,1);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `talla` varchar(50) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_producto_categoria` (`id_categoria`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `producto` */

insert  into `producto`(`id_producto`,`descripcion`,`talla`,`estado`,`id_categoria`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Camisa cuadros','L','1',1,'2021-05-26 19:07:00','2021-06-07 13:37:16',1,1),
(2,'pantalon','32','0',2,'2021-05-26 19:07:00','2021-06-07 13:51:47',1,1),
(3,'medias','43','1',3,'2021-05-26 19:07:00','2021-05-26 19:07:00',1,1),
(4,'vestido','S','1',4,'2021-05-26 19:07:00','2021-05-26 19:07:00',1,1),
(5,'saco','L','0',5,'2021-05-26 19:07:00','2021-06-07 13:52:00',1,1),
(6,'Camisa rayas','0','1',1,'2021-06-07 12:57:45','2021-06-07 12:57:45',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rol` */

insert  into `rol`(`id_rol`,`descripcion`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Administrador','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(2,'Contador','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1),
(3,'Vendedor','1','2021-05-10 20:00:00','2021-05-10 20:00:00',1,1);

/*Table structure for table `tarea` */

DROP TABLE IF EXISTS `tarea`;

CREATE TABLE `tarea` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `valor_unitario` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_pago` enum('Pagado','Por pagar') NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_tarea`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `fk_tarea_id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tarea` */

insert  into `tarea`(`id_tarea`,`descripcion`,`valor_unitario`,`cantidad`,`fecha`,`estado_pago`,`id_empleado`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'Hola',10000,10,'2021-05-17 00:00:00','Por pagar',2,'1','2021-05-12 22:36:37','2021-05-12 22:36:37',1,1),
(14,'Hola',10000,10,'0000-00-00 00:00:00','Por pagar',1,'1','2021-05-29 21:59:45','2021-05-29 21:59:45',1,1),
(15,'Chao',2334234,3242342,'2021-05-29 00:00:00','Pagado',3,'0','2021-05-29 22:04:04','2021-05-29 22:04:04',1,1),
(16,'dsfsdgds',3454235,45453245,'2021-05-30 00:00:00','Por pagar',1,'1','2021-05-29 22:18:35','2021-05-29 22:18:35',1,1);

/*Table structure for table `tipo_pago` */

DROP TABLE IF EXISTS `tipo_pago`;

CREATE TABLE `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipo_pago` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `fecha_activacion` date NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `id_usuario_modificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_persona_UNIQUE` (`id_persona`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`usuario`,`contrasenia`,`fecha_activacion`,`fecha_expiracion`,`id_persona`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,'u20152142462@usco.edu.co','0a5c79b1eaf15445da252ada718857e9','2021-05-16','2021-06-02',1,'1','2021-05-08 01:35:00','2021-06-01 21:01:53',1,1),
(2,'carmen@.com','9f564fef13bb8a7f9faa5f9071e4e045','2021-05-02','2021-05-07',2,'1','2021-05-11 22:06:54','2021-06-01 20:21:55',1,2),
(3,'ariel5253@misena.edu.com','31784d9fc1fa0d25d04eae50ac9bf787','2021-05-16','2021-06-02',5,'1','2021-05-11 22:11:21','2021-06-01 20:45:25',1,3),
(4,'olperdomo6@misena.edu.co','149815eb972b3c370dee3b89d645ae14','2021-06-01','2022-01-01',11,'1','2021-06-01 23:16:47','2021-06-01 23:16:47',1,1),
(5,'edurado.andres@gmail.com','e44985980c9d3c5d70b6a548b14d773a','2021-06-01','2022-06-01',12,'1','2021-06-01 23:32:32','2021-06-01 23:42:46',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario_rol` */

insert  into `usuario_rol`(`id_usuario_rol`,`id_usuario`,`id_rol`,`estado`,`fecha_creacion`,`fecha_modificacion`,`id_usuario_creacion`,`id_usuario_modificacion`) values 
(1,1,1,'1','2021-05-10 05:00:22','2021-05-12 05:00:24',1,1),
(3,4,1,'1','2021-06-01 23:18:20','2021-06-01 23:18:20',1,1),
(4,5,1,'1','2021-06-01 23:00:00','2022-06-01 23:00:00',1,1);

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
																			,IN estado ENUM('0','1')
																			,IN idUsuarioCreacion INT(11)
																			,IN idUsuarioModificacion INT(11)
																			)
BEGIN
	INSERT INTO detalle_orden(valor_inventario
							 ,valor_venta
							 ,cantidad
							 ,id_orden
							 ,id_producto
							 ,estado
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
			,estado
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_generar_pago`(
	IN `idEmpleado` INT(11),
	IN `fechaInicio` DATE,
	IN `fechaFin` DATE,
	IN `fechaPago` DATE,
	IN `valorPago` DOUBLE,
	IN `idUsuarioCreacion` INT(11),
	IN `idUsuarioModificacion` INT(11)
)
BEGIN
	INSERT INTO generar_pago(
							id_empleado
							,fecha_inicio
							,fecha_fin
							,fecha_pago
							,valor_pago
							,fecha_creacion
							,fecha_modificacion
							,id_usuario_creacion
							,id_usuario_modificacion
							) 
	VALUES (
			idEmpleado
			,fechaInicio
			,fechaFin
			,fechaPago
			,valorPago
			,NOW()
			,NOW()
			,idUsuarioCreacion
			,idUsuarioModificacion
			);
END */$$
DELIMITER ;

/* Procedure structure for procedure `Agregar_insumo` */

/*!50003 DROP PROCEDURE IF EXISTS  `Agregar_insumo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_insumo`(
	IN `descripcion` VARCHAR(50),
	IN `cantidad` INT(11),
	IN `idCategoria` INT(11),
	IN `estado` ENUM('1','0'),
	IN `idUsuarioCreacion` INT(11),
	IN `idUsuarioModificacion` INT(11)
)
BEGIN
	INSERT INTO insumo(descripcion
						,cantidad
						,id_categoria
						,estado
						,fecha_creacion
						,fecha_modificacion
						,id_usuario_creacion
						,id_usuario_modificacion
						) 
	VALUES (descripcion
			,cantidad
			,idCategoria
			,estado
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_pago_dia`(
	IN `idEmpleado` INT(11),
	IN `pagoDia` DOUBLE,
	IN `fechaPago` DATE,
	IN `estado` ENUM('0','1'),
	IN `idUsuarioCreacion` INT(11),
	IN `idUsuarioModificacion` INT(11)
)
BEGIN
	INSERT INTO pago_dia(
						id_empleado
						,pago_dia
						,fecha_pago_dia
						,estado
						,fecha_creacion
						,fecha_modificacion
						,id_usuario_creacion
						,id_usuario_modificacion
						) 
	VALUES (idEmpleado
			,pagoDia
			,fechaPago
			,estado
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_persona`(
	IN `nombre` VARCHAR(100),
	IN `apellido` VARCHAR(100),
	IN `tipoDocumento` SET('CC','TI','CE','PEP'),
	IN `documento` INT(11),
	IN `edad` INT(11),
	IN `genero` ENUM('M','F','O'),
	IN `estado` ENUM('0','1'),
	IN `idUsuarioCreacion` INT(11),
	IN `idUsuarioModificacion` INT(11)
)
BEGIN
INSERT INTO persona(nombre
					,apellido
					,tipo_documento
					,documento
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
		,tipoDocumento
		,documento
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Agregar_tarea`(IN `descripcion` VARCHAR(100), IN `valorUnitario` DOUBLE, IN `cantidad` INT(11), IN `fecha` DATETIME, IN `estadoPago` ENUM('Pagado','Por pagar'), IN `idEmpleado` INT(11), IN `estado` ENUM('0','1'), IN `idUsuarioCreacion` INT(11), IN `idUsuarioModificacion` INT(11))
BEGIN
	INSERT INTO tarea (descripcion
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
																		,IN fechaActivacion DATE
																		,IN fechaExpiracion DATE
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

/* Procedure structure for procedure `Modificar_detalle_orden` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_detalle_orden` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_detalle_orden`(
		IN valorInventario DOUBLE,
		IN valorVenta DOUBLE,
		IN cantidad INT(11),
		IN idOrden INT(11),
		IN idProducto INT(11),
		IN estado ENUM('0','1'),
		IN idUsuarioModificacion INT(11),
		IN idDetalleOrden INT(11)
	)
BEGIN
	UPDATE detalle_orden 
	    SET 
		 	valor_inventario = valorInventario
			,valor_venta = valorVenta
			,cantidad = cantidad
			,id_orden = idOrden
			,id_producto = idProducto
			,estado = estado
			,fecha_modificacion = NOW()
			,id_usuario_modificacion = idUsuarioModificacion 
		WHERE id_detalle_orden = idDetalleOrden;
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_generar_pago`(
	IN `idEmpleado` INT(11),
	IN `fechaInicio` DATE,
	IN `fechaFin` DATE,
	IN `fechaPago` DATE,
	IN `valorPago` DOUBLE,
	IN `idUsuarioModificacion` INT(11),
	IN `idGenerarPago` INT(11)
)
BEGIN
	UPDATE generar_pago 
	SET 
		id_empleado = idEmpleado
		,fecha_inicio = fechaInicio
		,fecha_fin = fechaFin
		,fecha_pago = fechaPago
		,valor_pago = valorPago
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_generar_pago = idGenerarPago;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Modificar_insumo` */

/*!50003 DROP PROCEDURE IF EXISTS  `Modificar_insumo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_insumo`(
	IN `descripcion` VARCHAR(50),
	IN `cantidadO` INT(11),
	IN `idCategoria` INT(11),
	IN `estado` ENUM('1','0'),
	IN `idUsuarioModificacion` INT(11),
	IN `idInsumo` CHAR(1)
)
BEGIN
	UPDATE insumo 
    SET descripcion = descripcion
		,cantidad = cantidad + cantidadO
		,id_categoria = idCategoria
		,estado = estado
		,fecha_modificacion = NOW()
		,id_usuario_modificacion = idUsuarioModificacion 
	WHERE id_insumo = idInsumo;
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_pago_dia`(
	IN `idEmpleado` INT(11),
	IN `pagoDia` DOUBLE,
	IN `fechaPago` DATE,
	IN `estado` ENUM('0','1'),
	IN `idUsuarioModificacion` INT(11),
	IN `idPagoDia` INT(11)
)
BEGIN
	UPDATE pago_dia 
	SET id_empleado = idEmpleado
		,pago_dia = pagoDia
		,fecha_pago_dia = fechaPago
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_persona`(
	IN `nombre` VARCHAR(100),
	IN `apellido` VARCHAR(100),
	IN `tipoDocumento` SET('CC','TI','CE','PEP'),
	IN `documento` INT(11),
	IN `edad` INT(11),
	IN `genero` ENUM('M','F','O'),
	IN `estado` ENUM('0','1'),
	IN `idUsuarioModificacion` INT(11),
	IN `idPersona` INT(11)
)
BEGIN
	UPDATE persona 
	SET nombre = nombre
		,apellido = apellido
		,tipo_documento = tipoDocumento
		,documento = documento
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Modificar_tarea`(IN `descripcion` VARCHAR(100), IN `valorUnitario` DOUBLE, IN `cantidad` INT(11), IN `fecha` DATETIME, IN `estadoPago` ENUM('Pagado','Por pagar'), IN `idEmpleado` INT(11), IN `estado` ENUM('0','1'), IN `idUsuarioModificacion` INT(11), IN `idTarea` INT(11))
BEGIN
	UPDATE tarea
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
																		,IN fechaActivacion DATE
																		,IN fechaExpiracion DATE
																		,IN idPersona INT(11)
																		,IN estado ENUM('0','1')
																		,IN idUsuario INT(11)
																		,IN idUsuarioModificacion INT(11)
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

/* Procedure structure for procedure `Obtener_carpeta` */

/*!50003 DROP PROCEDURE IF EXISTS  `Obtener_carpeta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_carpeta`(IN id INT)
BEGIN
	SELECT 
		f.etiqueta AS modulo
		,COUNT(f.etiqueta) AS cantidad_formulario
	FROM 
		formulario AS f
		INNER JOIN formulario_rol AS  fr ON f.id_formulario = fr.id_formulario
		INNER JOIN rol AS r ON fr.id_rol = r.id_rol
		INNER JOIN usuario_rol AS ur ON r.id_rol = ur.id_rol
		INNER JOIN usuario AS u ON ur.id_usuario = u.id_usuario
	WHERE u.id_usuario = id
	GROUP BY etiqueta
	ORDER BY f.descripcion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Obtener_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `Obtener_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_login`(IN u_user VARCHAR(50), u_password VARCHAR(100))
BEGIN
	SELECT 
		COUNT(u.usuario) AS autenticado
		,u.id_usuario
		,u.usuario
		,CONCAT(p.nombre,' ',p.apellido) AS nombre
	FROM
		usuario AS u
		INNER JOIN persona AS p ON u.id_persona = p.id_persona
	WHERE u.usuario = u_user AND u.contrasenia = u_password;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Obtener_menu` */

/*!50003 DROP PROCEDURE IF EXISTS  `Obtener_menu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_menu`(IN modulo VARCHAR(50),id INT)
BEGIN
	SELECT 
		f.id_formulario
		,f.descripcion
		,CONVERT(CAST(CONVERT(f.ubicacion USING latin1) AS BINARY) USING utf8) AS ubicacion
		,f.etiqueta
	FROM 
		usuario AS u
		INNER JOIN usuario_rol AS ur ON u.id_usuario = ur.id_usuario
		INNER JOIN rol AS r ON ur.id_rol = r.id_rol
		INNER JOIN formulario_rol AS fr ON r.id_rol = fr.id_rol
		INNER JOIN formulario AS f ON fr.id_formulario = f.id_formulario
	WHERE f.etiqueta LIKE modulo AND u.id_usuario = id
	ORDER BY f.descripcion;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
