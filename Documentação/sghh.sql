/*
Navicat MySQL Data Transfer

Source Server         : localhost_root
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : sghh

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2013-04-26 17:44:27
*/

SET FOREIGN_KEY_CHECKS=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of funcionario
-- ----------------------------
INSERT INTO `funcionario` VALUES ('1', 'Sérgio Macedo', '01234567890', '123456');
INSERT INTO `funcionario` VALUES ('2', 'Lucas Sobrinho', '12345678901', '123456');
INSERT INTO `funcionario` VALUES ('3', 'Enrique Bonifácio', '23456789012', '123456');
INSERT INTO `funcionario` VALUES ('4', 'Jorge Pimenta', '34567890123', '123456');
INSERT INTO `funcionario` VALUES ('5', 'Wesley Nunes', '45678901234', '123456');
INSERT INTO `funcionario` VALUES ('6', 'Igor Espirito Santo', '56789012345', '123456');
INSERT INTO `funcionario` VALUES ('7', 'Fábio César', '67890123456', '123456');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leito
-- ----------------------------
INSERT INTO `leito` VALUES ('1', '1', 'Leito1', '1');
INSERT INTO `leito` VALUES ('2', '1', 'Leito2', '2');
INSERT INTO `leito` VALUES ('3', '2', 'Leito1', '1');
INSERT INTO `leito` VALUES ('4', '2', 'Leito2', '1');
INSERT INTO `leito` VALUES ('5', '1', 'Leito3', '0');
INSERT INTO `leito` VALUES ('6', '1', 'Leito4', '1');

-- ----------------------------
-- Table structure for `ocupacao`
-- ----------------------------
DROP TABLE IF EXISTS `ocupacao`;
CREATE TABLE `ocupacao` (
  `OcupacaoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PacienteId` int(10) unsigned NOT NULL,
  `LeitoId` int(10) unsigned NOT NULL,
  `Laudo` text,
  `FuncCadastro` int(10) unsigned NOT NULL,
  `DataCad` date NOT NULL,
  `HoraCad` time NOT NULL,
  `FuncBaixa` int(10) unsigned DEFAULT NULL,
  `DataBaixa` date DEFAULT NULL,
  `HoraBaixa` time DEFAULT NULL,
  PRIMARY KEY (`OcupacaoId`),
  KEY `PacienteId` (`PacienteId`),
  KEY `LeitoId` (`LeitoId`),
  KEY `FuncCadastro` (`FuncCadastro`),
  KEY `FuncBaixa` (`FuncBaixa`),
  CONSTRAINT `ocupacao_ibfk_1` FOREIGN KEY (`PacienteId`) REFERENCES `paciente` (`PacienteId`),
  CONSTRAINT `ocupacao_ibfk_2` FOREIGN KEY (`LeitoId`) REFERENCES `leito` (`LeitoId`),
  CONSTRAINT `ocupacao_ibfk_3` FOREIGN KEY (`FuncCadastro`) REFERENCES `funcionario` (`FuncionarioId`),
  CONSTRAINT `ocupacao_ibfk_4` FOREIGN KEY (`FuncBaixa`) REFERENCES `funcionario` (`FuncionarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ocupacao
-- ----------------------------
INSERT INTO `ocupacao` VALUES ('2', '1', '6', 'É importante questionar o quanto a competitividade nas transações comerciais representa uma abertura para a melhoria das posturas dos órgãos dirigentes com relação às suas atribuições.', '3', '2013-04-23', '11:20:35', null, null, null);
INSERT INTO `ocupacao` VALUES ('3', '2', '1', 'Ainda assim, existem dúvidas a respeito de como o aumento do diálogo entre os diferentes setores produtivos promove a alavancagem dos relacionamentos verticais entre as hierarquias.', '2', '2013-04-24', '15:31:43', null, null, null);

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
INSERT INTO `paciente` VALUES ('1', 'Sérgio Macedo da Silva Santos', '01234567890', 'Rua A', '12', 'Frente', 'Eldorado', 'Contagem', 'MG', '1', '0', '2013-03-26 11:06:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quarto
-- ----------------------------
INSERT INTO `quarto` VALUES ('1', '1', 'M01', '1');
INSERT INTO `quarto` VALUES ('2', '1', 'M02', '1');
INSERT INTO `quarto` VALUES ('3', '1', 'F01', '1');
INSERT INTO `quarto` VALUES ('4', '1', 'I01', '0');

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
