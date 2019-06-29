/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.3.13-MariaDB-2 : Database - baul
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`baul` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci */;

USE `baul`;

/*Table structure for table `pedidos` */

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `codigo_referencia` mediumtext NOT NULL,
  `codigo_autorizacion` mediumtext NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pedidos` */

/*Table structure for table `pedidos_error` */

DROP TABLE IF EXISTS `pedidos_error`;

CREATE TABLE `pedidos_error` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `codigo_error` varchar(50) DEFAULT NULL,
  `merchant_message` mediumtext DEFAULT NULL,
  `user_message` mediumtext DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pedidos_error` */

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `idReview` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `puntuacion` decimal(10,2) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `profileid` varchar(20) DEFAULT NULL,
  `fecha_real` datetime NOT NULL,
  PRIMARY KEY (`idReview`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `reviews` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `status` smallint(1) NOT NULL,
  `codeUser` varchar(7) COLLATE latin1_spanish_ci NOT NULL,
  `dateCreation` datetime NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
