CREATE DATABASE `contex`;

USE `contex`;

CREATE TABLE `persona`(
    `id_persona` INT NOT NULL ,
    `nombre_completo` VARCHAR(100) NOT NULL,
    `edad` INT NOT NULL,
    `genero` ENUM('Masculino','Femenino','Otro') NOT NULL,
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT NOT NULL,
    PRIMARY KEY (`id_persona`)
);

CREATE TABLE `cliente`(
    `id_cliente` INT NOT NULL,
    `id_persona` INT,
    PRIMARY KEY(`id_cliente`),
    FOREIGN KEY(`id_persona`) REFERENCES `persona`(`id_persona`)
);

CREATE TABLE `proveedor`(
    `id_proveedor` INT NOT NULL,
    `id_persona` INT,
    PRIMARY KEY(`id_proveedor`),
    FOREIGN KEY(`id_persona`) REFERENCES `persona`(`id_persona`)
);

CREATE TABLE `compra_venta`(
    `id_compra_venta` INT NOT NULL,
    `control` ENUM('Compra','Venta','Cotizacion') NOT NULL,
    `fecha` DATETIME NOT NULL,
    `descuento` DOUBLE,
    `valor` DOUBLE NOT NULL,
    `id_cliente` INT,
    `id_proveedor` INT,
    PRIMARY KEY(`id_compra_venta`),
    FOREIGN KEY(`id_cliente`) REFERENCES `cliente`(`id_cliente`),
    FOREIGN KEY(`id_proveedor`) REFERENCES `proveedor`(`id_proveedor`)
);

CREATE TABLE `usuario`(
    `id_usuario` INT NOT NULL,
    `usuario` VARCHAR(50) NOT NULL,
    `contrasenia` VARCHAR(50) NOT NULL,
    `fecha_activacion` DATETIME NOT NULL,
    `fecha_expiracion` DATETIME NOT NULL,
    `id_persona` INT,
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `fecha_modificacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT NOT NULL,
    PRIMARY KEY(`id_usuario`),
    FOREIGN KEY(`id_persona`) REFERENCES `persona`(`id_persona`)
);

CREATE TABLE `usuario_rol`(
    `id_usuario_rol` INT NOT NULL,
    `id_usuario` INT,
    `id_rol` INT NOT NULL,
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `fehca_modificacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT NOT NULL,
    PRIMARY KEY (`id_usuario_rol`),
    FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id_usuario`),
    FOREIGN KEY (`id_rol`) REFERENCES `rol`(`id_rol`)
);

CREATE TABLE `rol`(
    `id_rol` INT NOT NULL,
    `descripcion` VARCHAR(50) NOT NULL,
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `fecha_modificacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT NOT NULL,
    PRIMARY KEY (`id_rol`)
);

CREATE TABLE `formulario_rol`(
    `id_formulario_rol` INT NOT NULL,
    `id_rol` INT,
    `id_formulario` INT NOT NULL,
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `fecha_modificacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT NOT NULL,
    PRIMARY KEY (`id_formulario_rol`),
    FOREIGN KEY (`id_rol`) REFERENCES `rol`(`id_rol`),
    FOREIGN KEY (`id_formulario`) REFERENCES `formulario`(`id_formulario`)
);

CREATE TABLE `formulario`(
    `id_formulario` INT NOT NULL,
    `descripcion` VARCHAR(50) NOT NULL,
    `etiqueta` VARCHAR(30) NOT NULL,
    `ubicacion` VARCHAR(100) NOT NULL,
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `fecha_modificacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT NOT NULL,
    PRIMARY KEY (`id_formulario`)
);

CREATE TABLE `cargo`(
    `id_cargo` INT NOT NULL,
    `codigo_cargo` INT NOT NULL,
    `descripcion` VARCHAR(50),
    `estado` BIT NOT NULL,
    `fecha_creacion` DATETIME NOT NULL,
    `fecha_modificacion` DATETIME NOT NULL,
    `id_usuario_creacion` INT NOT NULL,
    `id_usuario_modificacion` INT  NOT NULL,
    PRIMARY KEY (`id_cargo`) 
);

CREATE TABLE `empleado`(
    `id_empleado` INT NOT NULL,
    `id_cargo` INT NOT NULL,
    `correo_institucional` VARCHAR(50) NOT NULL,
    `fecha_ingreso` VARCHAR(50) NOT NULL,
    `arl` ENUM('ARL1','ARL2','ARL3'),
    `salud` ENUM('salud1','salud2','salud3'),
    `pension` ENUM('pension1','pension2','pension3'),
    `id_persona` INT,
    `estado` BIT NOT NULL,
    PRIMARY KEY (`id_empleado`),
    FOREIGN KEY (`id_persona`) REFERENCES `persona`(`id_persona`),
    FOREIGN KEY (`id_cargo`) REFERENCES `cargo`(`id_cargo`)
);

CREATE TABLE `tarea`(
    `id_tarea` INT NOT NULL,
    `descripcion` VARCHAR(100) NOT NULL,
    `valor_unitario` DOUBLE NOT NULL,
    `cantidad` INT NOT NULL,
    `fecha` DATETIME NOT NULL,
    `estado_pago` ENUM('por pagar','pagado'),
    `id_empleado` INT,
    PRIMARY KEY (`id_tarea`),
    FOREIGN KEY (`id_empleado`) REFERENCES `empleado`(`id_empleado`)
);

CREATE TABLE `generar_pago`(
    `id_generar_pago` INT NOT NULL,
    `valor_pago` DOUBLE NOT NULL,
    `deduccion` DOUBLE NOT NULL,
    `fecha_inicio` DATETIME NOT NULL,
    `fecha_fin` DATETIME NOT NULL,
    `id_empleado` INT,
    PRIMARY KEY (`id_generar_pago`),
    FOREIGN KEY (`id_empleado`) REFERENCES `empleado`(`id_empleado`)
);

CREATE TABLE `pago_dia`(
    `id_pago_dia` INT NOT NULL,
    `id_empleado` INT,
    `pago_dia` DOUBLE NOT NULL,
    PRIMARY KEY (`id_pago_dia`),
    FOREIGN KEY (`id_empleado`) REFERENCES `empleado`(`id_empleado`)
);

CREATE TABLE `orden`(
    `id_orden` INT NOT NULL,
    `fecha_orden` DATETIME NOT NULL,
    `fecha_entrega` DATETIME NOT NULL,
    `descripcion` VARCHAR(100) NOT NULL,
    `id_persona` INT,
    `id_empleado` INT,
    `estado` BIT NOT NULL,
    PRIMARY KEY (`id_orden`),
    FOREIGN KEY (`id_persona`) REFERENCES `persona`(`id_persona`),
    FOREIGN KEY (`id_empleado`) REFERENCES `empleado`(`id_empleado`)
);