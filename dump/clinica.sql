-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: clinica
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `user_iduser` int(11) NOT NULL,
  PRIMARY KEY (`idadmin`,`user_iduser`),
  KEY `fk_admin_user1_idx` (`user_iduser`),
  CONSTRAINT `fk_admin_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,10);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `idendereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(200) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `cep` varchar(15) NOT NULL,
  PRIMARY KEY (`idendereco`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (33,'Rua João da Silva','121','Centro','São João da Ponte','39430000'),(34,'Rua João da Silva','36','baxinha','São João da Ponte','39430000'),(35,'R A','165','Centro','São João da Ponte','39452000'),(37,'Avenida ','32','Centro','São João da Ponte','39430000'),(39,'R borges','85','Centro','São João da Ponte','39430000'),(40,'R borges','85','Centro','São João da Ponte','39430000'),(41,'R borges','85','Centro','São João da Ponte','39430000'),(42,'Rua Tito','63','pedras','São João da Ponte','39430000'),(43,'Rua Geovane','222','colina','São João da Ponte','39430000'),(44,'Rua Geovane','156','colina','São João da Ponte','39430000');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medico`
--

DROP TABLE IF EXISTS `medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medico` (
  `idmedico` int(11) NOT NULL AUTO_INCREMENT,
  `crm` varchar(45) NOT NULL,
  `especializacao` varchar(100) NOT NULL,
  `user_iduser` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`user_iduser`),
  KEY `fk_medico_user1_idx` (`user_iduser`) USING BTREE,
  CONSTRAINT `fk_medico_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medico`
--

LOCK TABLES `medico` WRITE;
/*!40000 ALTER TABLE `medico` DISABLE KEYS */;
INSERT INTO `medico` VALUES (5,'102030','Cirurgião',8),(6,'365425','Psicanalista',9);
/*!40000 ALTER TABLE `medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
  `fixa` text,
  `data_entrada` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  PRIMARY KEY (`idpaciente`,`pessoa_idpessoa`),
  KEY `fk_paciente_pessoa_idx` (`pessoa_idpessoa`),
  CONSTRAINT `fk_paciente_pessoa` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (1,'Dor de cabeça','2017-05-02 16:16:56',1,30),(2,'','2017-05-02 16:19:19',1,31),(3,'gestante','2017-05-02 16:28:09',1,32),(4,'dor nos olhos','2017-05-02 17:15:49',1,33),(5,'dfasdf','2017-05-02 18:10:49',1,34);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `idpessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `identidade` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  PRIMARY KEY (`idpessoa`,`endereco_idendereco`),
  KEY `fk_pessoa_endereco1_idx` (`endereco_idendereco`),
  CONSTRAINT `fk_pessoa_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (23,'Thais Silva',25,'Feminino','mg 356245','991919191','thais@sim.com',33),(24,'Hairton Sobral',27,'Masculino','13456','991919191','hairtonsena@yahoo.com.br',34),(25,'Hairton Sobral',25,'Masculino','12365487','991902222','hairtonsena@hotmail.com',35),(27,'Tiago alterar',23,'Masculino','mg 654321','636363639','maes@gmail.com',37),(29,'Filipe',26,'Masculino','mg 852963','656565654','filipe@yes.com.br',39),(30,'Filipe',26,'Masculino','mg 852963','656565654','filipe@yes.com.br',40),(31,'Luma ',20,'Feminino','mg 8765433','997979797','luma@sim.com.br',41),(32,'Simone sobral',28,'Feminino','mg 4444444','4444444444','simone@yes.com.br',42),(33,'Murilo',29,'Masculino','mg 4444444','969696966','murilo@sim.com.br',43),(34,'Maria ',50,'Feminino','mg 1111111','911223321','maria@sim.com',44);
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretario`
--

DROP TABLE IF EXISTS `secretario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretario` (
  `idsecretario` int(11) NOT NULL AUTO_INCREMENT,
  `user_iduser` int(11) NOT NULL,
  PRIMARY KEY (`idsecretario`,`user_iduser`),
  KEY `fk_secretario_user1_idx` (`user_iduser`),
  CONSTRAINT `fk_secretario_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretario`
--

LOCK TABLES `secretario` WRITE;
/*!40000 ALTER TABLE `secretario` DISABLE KEYS */;
INSERT INTO `secretario` VALUES (1,12);
/*!40000 ALTER TABLE `secretario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `status` int(1) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  PRIMARY KEY (`iduser`,`pessoa_idpessoa`),
  KEY `fk_user_pessoa1_idx` (`pessoa_idpessoa`),
  CONSTRAINT `fk_user_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,'123456','e10adc3949ba59abbe56e057f20f883e','MEDICO',1,'2017-04-30 20:29:05',23),(9,'321654','102030','MEDICO',1,'2017-04-30 20:30:05',24),(10,'123456','c33367701511b4f6020ec61ded352059','ADMIN',1,'2017-04-20 00:00:00',25),(12,'9999','fa246d0262c3925617b0c72bb20eeb1d','SECRETARIO',1,'2017-05-01 16:39:24',27);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-03  9:43:55
