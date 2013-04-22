/*
Navicat MySQL Data Transfer

Source Server         : localhost_root
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : sghh

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2013-04-05 16:22:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `acomodacao`
-- ----------------------------
DROP TABLE IF EXISTS `acomodacao`;
CREATE TABLE `acomodacao` (
  `AcomodacaoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PacienteId` int(10) unsigned NOT NULL,
  `LeitoId` int(10) unsigned NOT NULL,
  `FuncCadastro` int(10) unsigned NOT NULL,
  `DataCad` date NOT NULL,
  `HoraCad` time NOT NULL,
  `FuncBaixa` int(10) unsigned DEFAULT NULL,
  `DataBaixa` date DEFAULT NULL,
  `HoraBaixa` time DEFAULT NULL,
  PRIMARY KEY (`AcomodacaoId`),
  KEY `PacienteId` (`PacienteId`),
  KEY `LeitoId` (`LeitoId`),
  KEY `FuncCadastro` (`FuncCadastro`),
  KEY `FuncBaixa` (`FuncBaixa`),
  CONSTRAINT `acomodacao_ibfk_1` FOREIGN KEY (`PacienteId`) REFERENCES `paciente` (`PacienteId`),
  CONSTRAINT `acomodacao_ibfk_2` FOREIGN KEY (`LeitoId`) REFERENCES `leito` (`LeitoId`),
  CONSTRAINT `acomodacao_ibfk_3` FOREIGN KEY (`FuncCadastro`) REFERENCES `funcionario` (`FuncionarioId`),
  CONSTRAINT `acomodacao_ibfk_4` FOREIGN KEY (`FuncBaixa`) REFERENCES `funcionario` (`FuncionarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acomodacao
-- ----------------------------

-- ----------------------------
-- Table structure for `funcionario`
-- ----------------------------
DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE `funcionario` (
  `FuncionarioId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(40) NOT NULL,
  `Cpf` char(11) NOT NULL,
  `Senha` varchar(10) NOT NULL,
  PRIMARY KEY (`FuncionarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of funcionario
-- ----------------------------

-- ----------------------------
-- Table structure for `leito`
-- ----------------------------
DROP TABLE IF EXISTS `leito`;
CREATE TABLE `leito` (
  `LeitoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `QuartoId` int(10) unsigned NOT NULL,
  `Identificacao` varchar(10) NOT NULL,
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`LeitoId`),
  KEY `QuartoId` (`QuartoId`),
  CONSTRAINT `leito_ibfk_1` FOREIGN KEY (`QuartoId`) REFERENCES `quarto` (`QuartoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leito
-- ----------------------------

-- ----------------------------
-- Table structure for `paciente`
-- ----------------------------
DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `PacienteId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Cpf` char(11) NOT NULL,
  `Logradouro` varchar(50) DEFAULT NULL,
  `Numero` varchar(10) DEFAULT NULL,
  `Complemento` varchar(10) DEFAULT NULL,
  `Bairro` varchar(40) DEFAULT NULL,
  `Cidade` varchar(40) DEFAULT NULL,
  `Estado` char(2) DEFAULT NULL,
  `Tipo` tinyint(3) unsigned NOT NULL,
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `DataHora` datetime NOT NULL,
  PRIMARY KEY (`PacienteId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paciente
-- ----------------------------
INSERT INTO `paciente` VALUES ('1', 'Sérgio Macedo da Silva Santos', '01234567890', 'Rua A', '12', 'Frente', 'Eldorado', 'Contagem', 'MG', '1', '1', '2013-03-26 11:06:41');
INSERT INTO `paciente` VALUES ('2', 'Márcio Justino', '9876543210', 'Rua D', '51', null, null, null, null, '1', '1', '2013-03-27 21:41:23');
INSERT INTO `paciente` VALUES ('3', 'Daniela Macedo', '111111111', 'Rua B', '50', null, null, null, null, '1', '1', '2013-03-28 10:57:26');

-- ----------------------------
-- Table structure for `quarto`
-- ----------------------------
DROP TABLE IF EXISTS `quarto`;
CREATE TABLE `quarto` (
  `QuartoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Andar` varchar(10) NOT NULL,
  `Identificacao` varchar(10) NOT NULL,
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`QuartoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quarto
-- ----------------------------

-- ----------------------------
-- Table structure for `telefone`
-- ----------------------------
DROP TABLE IF EXISTS `telefone`;
CREATE TABLE `telefone` (
  `TelefoneId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PacienteId` int(10) unsigned NOT NULL,
  `Telefone` varchar(14) NOT NULL,
  PRIMARY KEY (`TelefoneId`),
  KEY `PacienteId` (`PacienteId`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`PacienteId`) REFERENCES `paciente` (`PacienteId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of telefone
-- ----------------------------
INSERT INTO `telefone` VALUES ('1', '1', '(31) 8811-8927');
