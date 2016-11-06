CREATE DATABASE  IF NOT EXISTS `bd_auxilio` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bd_auxilio`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_auxilio
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas`
--

DROP TABLE IF EXISTS `entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradas` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `numero_nf` varchar(45) NOT NULL,
  `data_entrada` date NOT NULL,
  `qtd_entrada` int(11) NOT NULL,
  `validade_lote` date NOT NULL,
  `medicamento_cod` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_entradas_medicamento1_idx` (`medicamento_cod`),
  CONSTRAINT `fk_entradas_medicamento1` FOREIGN KEY (`medicamento_cod`) REFERENCES `medicamento` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulario`
--

DROP TABLE IF EXISTS `formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulario` (
  `qtd_pedir` int(11) NOT NULL,
  `medicamento_cod` int(11) NOT NULL,
  KEY `fk_formulario_medicamento1_idx` (`medicamento_cod`),
  CONSTRAINT `fk_formulario_medicamento1` FOREIGN KEY (`medicamento_cod`) REFERENCES `medicamento` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulario`
--

LOCK TABLES `formulario` WRITE;
/*!40000 ALTER TABLE `formulario` DISABLE KEYS */;
/*!40000 ALTER TABLE `formulario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_retirada`
--

DROP TABLE IF EXISTS `itens_retirada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_retirada` (
  `qtd_retirada` int(11) NOT NULL,
  `retiradas_cod` int(11) NOT NULL,
  `medicamento_cod` int(11) NOT NULL,
  KEY `fk_itens_retirada_retiradas1_idx` (`retiradas_cod`),
  KEY `fk_itens_retirada_medicamento1_idx` (`medicamento_cod`),
  CONSTRAINT `fk_itens_retirada_retiradas1` FOREIGN KEY (`retiradas_cod`) REFERENCES `retiradas` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_retirada_medicamento1` FOREIGN KEY (`medicamento_cod`) REFERENCES `medicamento` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_retirada`
--

LOCK TABLES `itens_retirada` WRITE;
/*!40000 ALTER TABLE `itens_retirada` DISABLE KEYS */;
/*!40000 ALTER TABLE `itens_retirada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamento` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `apresentacao` varchar(20) NOT NULL,
  `qtd` int(11) NOT NULL,
  `principio_ativo_cod` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_medicamento_principio_ativo_idx` (`principio_ativo_cod`),
  CONSTRAINT `fk_medicamento_principio_ativo` FOREIGN KEY (`principio_ativo_cod`) REFERENCES `principio_ativo` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamento`
--

LOCK TABLES `medicamento` WRITE;
/*!40000 ALTER TABLE `medicamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operador`
--

DROP TABLE IF EXISTS `operador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operador` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operador`
--

LOCK TABLES `operador` WRITE;
/*!40000 ALTER TABLE `operador` DISABLE KEYS */;
/*!40000 ALTER TABLE `operador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_nasc` date NOT NULL,
  `data_cad` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `principio_ativo`
--

DROP TABLE IF EXISTS `principio_ativo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `principio_ativo` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `principio_ativo_nome` varchar(25) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `principio_ativo`
--

LOCK TABLES `principio_ativo` WRITE;
/*!40000 ALTER TABLE `principio_ativo` DISABLE KEYS */;
/*!40000 ALTER TABLE `principio_ativo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retiradas`
--

DROP TABLE IF EXISTS `retiradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retiradas` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `operador_cod` int(11) NOT NULL,
  `paciente_cod` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `fk_retiradas_operador1_idx` (`operador_cod`),
  KEY `fk_retiradas_paciente1_idx` (`paciente_cod`),
  CONSTRAINT `fk_retiradas_operador1` FOREIGN KEY (`operador_cod`) REFERENCES `operador` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retiradas_paciente1` FOREIGN KEY (`paciente_cod`) REFERENCES `paciente` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retiradas`
--

LOCK TABLES `retiradas` WRITE;
/*!40000 ALTER TABLE `retiradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `retiradas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-06 14:01:12
