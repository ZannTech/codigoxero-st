-- MySQL dump 10.19  Distrib 10.3.37-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: comeswzs_codigoxero
-- ------------------------------------------------------
-- Server version	10.3.37-MariaDB-log-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `T_ASSIGN`
--

DROP TABLE IF EXISTS `T_ASSIGN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_ASSIGN` (
  `id_asignacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_usuario` varchar(23) NOT NULL,
  `id_meta` int(11) DEFAULT NULL,
  `id_asignado` int(11) NOT NULL,
  `type` enum('DISTRITO','ZONA') NOT NULL,
  `fecha_asignado` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`id_asignacion`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_ASSIGN`
--

LOCK TABLES `T_ASSIGN` WRITE;
/*!40000 ALTER TABLE `T_ASSIGN` DISABLE KEYS */;
INSERT INTO `T_ASSIGN` VALUES (13,1,'00000001',14,2,'DISTRITO','2022-11-10 15:01:56','2022-11-23 14:10:11','01'),(14,1,'08870705',15,1,'DISTRITO','2022-11-10 20:50:50','2022-11-23 14:55:05','01'),(17,1,'08870705',16,4,'ZONA','2023-01-04 22:01:12',NULL,'01'),(18,1,'08870706',17,1,'DISTRITO','2023-01-04 22:12:17',NULL,'01'),(19,1,'08870706',18,1,'DISTRITO','2023-01-04 22:12:28',NULL,'01'),(20,1,'08870706',19,1,'DISTRITO','2023-01-04 22:12:47',NULL,'01'),(21,1,'08870706',20,1,'DISTRITO','2023-01-04 22:12:48',NULL,'01'),(22,1,'08870706',21,1,'DISTRITO','2023-01-04 22:13:00',NULL,'01');
/*!40000 ALTER TABLE `T_ASSIGN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_COUNTRY`
--

DROP TABLE IF EXISTS `T_COUNTRY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_COUNTRY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_COUNTRY`
--

LOCK TABLES `T_COUNTRY` WRITE;
/*!40000 ALTER TABLE `T_COUNTRY` DISABLE KEYS */;
INSERT INTO `T_COUNTRY` VALUES (1,'AF','AFGHANISTAN','Afghanistan','AFG',4,93),(2,'AL','ALBANIA','Albania','ALB',8,355),(3,'DZ','ALGERIA','Algeria','DZA',12,213),(4,'AS','AMERICAN SAMOA','American Samoa','ASM',16,1684),(5,'AD','ANDORRA','Andorra','AND',20,376),(6,'AO','ANGOLA','Angola','AGO',24,244),(7,'AI','ANGUILLA','Anguilla','AIA',660,1264),(8,'AQ','ANTARCTICA','Antarctica',NULL,NULL,0),(9,'AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28,1268),(10,'AR','ARGENTINA','Argentina','ARG',32,54),(11,'AM','ARMENIA','Armenia','ARM',51,374),(12,'AW','ARUBA','Aruba','ABW',533,297),(13,'AU','AUSTRALIA','Australia','AUS',36,61),(14,'AT','AUSTRIA','Austria','AUT',40,43),(15,'AZ','AZERBAIJAN','Azerbaijan','AZE',31,994),(16,'BS','BAHAMAS','Bahamas','BHS',44,1242),(17,'BH','BAHRAIN','Bahrain','BHR',48,973),(18,'BD','BANGLADESH','Bangladesh','BGD',50,880),(19,'BB','BARBADOS','Barbados','BRB',52,1246),(20,'BY','BELARUS','Belarus','BLR',112,375),(21,'BE','BELGIUM','Belgium','BEL',56,32),(22,'BZ','BELIZE','Belize','BLZ',84,501),(23,'BJ','BENIN','Benin','BEN',204,229),(24,'BM','BERMUDA','Bermuda','BMU',60,1441),(25,'BT','BHUTAN','Bhutan','BTN',64,975),(26,'BO','BOLIVIA','Bolivia','BOL',68,591),(27,'BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70,387),(28,'BW','BOTSWANA','Botswana','BWA',72,267),(29,'BV','BOUVET ISLAND','Bouvet Island',NULL,NULL,0),(30,'BR','BRAZIL','Brazil','BRA',76,55),(31,'IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL,246),(32,'BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96,673),(33,'BG','BULGARIA','Bulgaria','BGR',100,359),(34,'BF','BURKINA FASO','Burkina Faso','BFA',854,226),(35,'BI','BURUNDI','Burundi','BDI',108,257),(36,'KH','CAMBODIA','Cambodia','KHM',116,855),(37,'CM','CAMEROON','Cameroon','CMR',120,237),(38,'CA','CANADA','Canada','CAN',124,1),(39,'CV','CAPE VERDE','Cape Verde','CPV',132,238),(40,'KY','CAYMAN ISLANDS','Cayman Islands','CYM',136,1345),(41,'CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140,236),(42,'TD','CHAD','Chad','TCD',148,235),(43,'CL','CHILE','Chile','CHL',152,56),(44,'CN','CHINA','China','CHN',156,86),(45,'CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL,61),(46,'CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL,672),(47,'CO','COLOMBIA','Colombia','COL',170,57),(48,'KM','COMOROS','Comoros','COM',174,269),(49,'CG','CONGO','Congo','COG',178,242),(50,'CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180,242),(51,'CK','COOK ISLANDS','Cook Islands','COK',184,682),(52,'CR','COSTA RICA','Costa Rica','CRI',188,506),(53,'CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384,225),(54,'HR','CROATIA','Croatia','HRV',191,385),(55,'CU','CUBA','Cuba','CUB',192,53),(56,'CY','CYPRUS','Cyprus','CYP',196,357),(57,'CZ','CZECH REPUBLIC','Czech Republic','CZE',203,420),(58,'DK','DENMARK','Denmark','DNK',208,45),(59,'DJ','DJIBOUTI','Djibouti','DJI',262,253),(60,'DM','DOMINICA','Dominica','DMA',212,1767),(61,'DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214,1809),(62,'EC','ECUADOR','Ecuador','ECU',218,593),(63,'EG','EGYPT','Egypt','EGY',818,20),(64,'SV','EL SALVADOR','El Salvador','SLV',222,503),(65,'GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226,240),(66,'ER','ERITREA','Eritrea','ERI',232,291),(67,'EE','ESTONIA','Estonia','EST',233,372),(68,'ET','ETHIOPIA','Ethiopia','ETH',231,251),(69,'FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238,500),(70,'FO','FAROE ISLANDS','Faroe Islands','FRO',234,298),(71,'FJ','FIJI','Fiji','FJI',242,679),(72,'FI','FINLAND','Finland','FIN',246,358),(73,'FR','FRANCE','France','FRA',250,33),(74,'GF','FRENCH GUIANA','French Guiana','GUF',254,594),(75,'PF','FRENCH POLYNESIA','French Polynesia','PYF',258,689),(76,'TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL,0),(77,'GA','GABON','Gabon','GAB',266,241),(78,'GM','GAMBIA','Gambia','GMB',270,220),(79,'GE','GEORGIA','Georgia','GEO',268,995),(80,'DE','GERMANY','Germany','DEU',276,49),(81,'GH','GHANA','Ghana','GHA',288,233),(82,'GI','GIBRALTAR','Gibraltar','GIB',292,350),(83,'GR','GREECE','Greece','GRC',300,30),(84,'GL','GREENLAND','Greenland','GRL',304,299),(85,'GD','GRENADA','Grenada','GRD',308,1473),(86,'GP','GUADELOUPE','Guadeloupe','GLP',312,590),(87,'GU','GUAM','Guam','GUM',316,1671),(88,'GT','GUATEMALA','Guatemala','GTM',320,502),(89,'GN','GUINEA','Guinea','GIN',324,224),(90,'GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624,245),(91,'GY','GUYANA','Guyana','GUY',328,592),(92,'HT','HAITI','Haiti','HTI',332,509),(93,'HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL,0),(94,'VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336,39),(95,'HN','HONDURAS','Honduras','HND',340,504),(96,'HK','HONG KONG','Hong Kong','HKG',344,852),(97,'HU','HUNGARY','Hungary','HUN',348,36),(98,'IS','ICELAND','Iceland','ISL',352,354),(99,'IN','INDIA','India','IND',356,91),(100,'ID','INDONESIA','Indonesia','IDN',360,62),(101,'IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364,98),(102,'IQ','IRAQ','Iraq','IRQ',368,964),(103,'IE','IRELAND','Ireland','IRL',372,353),(104,'IL','ISRAEL','Israel','ISR',376,972),(105,'IT','ITALY','Italy','ITA',380,39),(106,'JM','JAMAICA','Jamaica','JAM',388,1876),(107,'JP','JAPAN','Japan','JPN',392,81),(108,'JO','JORDAN','Jordan','JOR',400,962),(109,'KZ','KAZAKHSTAN','Kazakhstan','KAZ',398,7),(110,'KE','KENYA','Kenya','KEN',404,254),(111,'KI','KIRIBATI','Kiribati','KIR',296,686),(112,'KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408,850),(113,'KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410,82),(114,'KW','KUWAIT','Kuwait','KWT',414,965),(115,'KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417,996),(116,'LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418,856),(117,'LV','LATVIA','Latvia','LVA',428,371),(118,'LB','LEBANON','Lebanon','LBN',422,961),(119,'LS','LESOTHO','Lesotho','LSO',426,266),(120,'LR','LIBERIA','Liberia','LBR',430,231),(121,'LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434,218),(122,'LI','LIECHTENSTEIN','Liechtenstein','LIE',438,423),(123,'LT','LITHUANIA','Lithuania','LTU',440,370),(124,'LU','LUXEMBOURG','Luxembourg','LUX',442,352),(125,'MO','MACAO','Macao','MAC',446,853),(126,'MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807,389),(127,'MG','MADAGASCAR','Madagascar','MDG',450,261),(128,'MW','MALAWI','Malawi','MWI',454,265),(129,'MY','MALAYSIA','Malaysia','MYS',458,60),(130,'MV','MALDIVES','Maldives','MDV',462,960),(131,'ML','MALI','Mali','MLI',466,223),(132,'MT','MALTA','Malta','MLT',470,356),(133,'MH','MARSHALL ISLANDS','Marshall Islands','MHL',584,692),(134,'MQ','MARTINIQUE','Martinique','MTQ',474,596),(135,'MR','MAURITANIA','Mauritania','MRT',478,222),(136,'MU','MAURITIUS','Mauritius','MUS',480,230),(137,'YT','MAYOTTE','Mayotte',NULL,NULL,269),(138,'MX','MEXICO','Mexico','MEX',484,52),(139,'FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583,691),(140,'MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498,373),(141,'MC','MONACO','Monaco','MCO',492,377),(142,'MN','MONGOLIA','Mongolia','MNG',496,976),(143,'MS','MONTSERRAT','Montserrat','MSR',500,1664),(144,'MA','MOROCCO','Morocco','MAR',504,212),(145,'MZ','MOZAMBIQUE','Mozambique','MOZ',508,258),(146,'MM','MYANMAR','Myanmar','MMR',104,95),(147,'NA','NAMIBIA','Namibia','NAM',516,264),(148,'NR','NAURU','Nauru','NRU',520,674),(149,'NP','NEPAL','Nepal','NPL',524,977),(150,'NL','NETHERLANDS','Netherlands','NLD',528,31),(151,'AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530,599),(152,'NC','NEW CALEDONIA','New Caledonia','NCL',540,687),(153,'NZ','NEW ZEALAND','New Zealand','NZL',554,64),(154,'NI','NICARAGUA','Nicaragua','NIC',558,505),(155,'NE','NIGER','Niger','NER',562,227),(156,'NG','NIGERIA','Nigeria','NGA',566,234),(157,'NU','NIUE','Niue','NIU',570,683),(158,'NF','NORFOLK ISLAND','Norfolk Island','NFK',574,672),(159,'MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580,1670),(160,'NO','NORWAY','Norway','NOR',578,47),(161,'OM','OMAN','Oman','OMN',512,968),(162,'PK','PAKISTAN','Pakistan','PAK',586,92),(163,'PW','PALAU','Palau','PLW',585,680),(164,'PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL,970),(165,'PA','PANAMA','Panama','PAN',591,507),(166,'PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598,675),(167,'PY','PARAGUAY','Paraguay','PRY',600,595),(168,'PE','PERU','Peru','PER',604,51),(169,'PH','PHILIPPINES','Philippines','PHL',608,63),(170,'PN','PITCAIRN','Pitcairn','PCN',612,0),(171,'PL','POLAND','Poland','POL',616,48),(172,'PT','PORTUGAL','Portugal','PRT',620,351),(173,'PR','PUERTO RICO','Puerto Rico','PRI',630,1787),(174,'QA','QATAR','Qatar','QAT',634,974),(175,'RE','REUNION','Reunion','REU',638,262),(176,'RO','ROMANIA','Romania','ROM',642,40),(177,'RU','RUSSIAN FEDERATION','Russian Federation','RUS',643,70),(178,'RW','RWANDA','Rwanda','RWA',646,250),(179,'SH','SAINT HELENA','Saint Helena','SHN',654,290),(180,'KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659,1869),(181,'LC','SAINT LUCIA','Saint Lucia','LCA',662,1758),(182,'PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666,508),(183,'VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670,1784),(184,'WS','SAMOA','Samoa','WSM',882,684),(185,'SM','SAN MARINO','San Marino','SMR',674,378),(186,'ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678,239),(187,'SA','SAUDI ARABIA','Saudi Arabia','SAU',682,966),(188,'SN','SENEGAL','Senegal','SEN',686,221),(189,'CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL,381),(190,'SC','SEYCHELLES','Seychelles','SYC',690,248),(191,'SL','SIERRA LEONE','Sierra Leone','SLE',694,232),(192,'SG','SINGAPORE','Singapore','SGP',702,65),(193,'SK','SLOVAKIA','Slovakia','SVK',703,421),(194,'SI','SLOVENIA','Slovenia','SVN',705,386),(195,'SB','SOLOMON ISLANDS','Solomon Islands','SLB',90,677),(196,'SO','SOMALIA','Somalia','SOM',706,252),(197,'ZA','SOUTH AFRICA','South Africa','ZAF',710,27),(198,'GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL,0),(199,'ES','SPAIN','Spain','ESP',724,34),(200,'LK','SRI LANKA','Sri Lanka','LKA',144,94),(201,'SD','SUDAN','Sudan','SDN',736,249),(202,'SR','SURINAME','Suriname','SUR',740,597),(203,'SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744,47),(204,'SZ','SWAZILAND','Swaziland','SWZ',748,268),(205,'SE','SWEDEN','Sweden','SWE',752,46),(206,'CH','SWITZERLAND','Switzerland','CHE',756,41),(207,'SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760,963),(208,'TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158,886),(209,'TJ','TAJIKISTAN','Tajikistan','TJK',762,992),(210,'TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834,255),(211,'TH','THAILAND','Thailand','THA',764,66),(212,'TL','TIMOR-LESTE','Timor-Leste',NULL,NULL,670),(213,'TG','TOGO','Togo','TGO',768,228),(214,'TK','TOKELAU','Tokelau','TKL',772,690),(215,'TO','TONGA','Tonga','TON',776,676),(216,'TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780,1868),(217,'TN','TUNISIA','Tunisia','TUN',788,216),(218,'TR','TURKEY','Turkey','TUR',792,90),(219,'TM','TURKMENISTAN','Turkmenistan','TKM',795,7370),(220,'TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796,1649),(221,'TV','TUVALU','Tuvalu','TUV',798,688),(222,'UG','UGANDA','Uganda','UGA',800,256),(223,'UA','UKRAINE','Ukraine','UKR',804,380),(224,'AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784,971),(225,'GB','UNITED KINGDOM','United Kingdom','GBR',826,44),(226,'US','UNITED STATES','United States','USA',840,1),(227,'UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL,1),(228,'UY','URUGUAY','Uruguay','URY',858,598),(229,'UZ','UZBEKISTAN','Uzbekistan','UZB',860,998),(230,'VU','VANUATU','Vanuatu','VUT',548,678),(231,'VE','VENEZUELA','Venezuela','VEN',862,58),(232,'VN','VIET NAM','Viet Nam','VNM',704,84),(233,'VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92,1284),(234,'VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850,1340),(235,'WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876,681),(236,'EH','WESTERN SAHARA','Western Sahara','ESH',732,212),(237,'YE','YEMEN','Yemen','YEM',887,967),(238,'ZM','ZAMBIA','Zambia','ZMB',894,260),(239,'ZW','ZIMBABWE','Zimbabwe','ZWE',716,263);
/*!40000 ALTER TABLE `T_COUNTRY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_CUSTOMERS`
--

DROP TABLE IF EXISTS `T_CUSTOMERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_CUSTOMERS` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) NOT NULL,
  `description` varchar(150) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `id_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `flag_state` varchar(2) NOT NULL,
  PRIMARY KEY (`id_customer`),
  KEY `dni` (`dni`),
  CONSTRAINT `T_CUSTOMERS_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `T_SUPER_ADMIN` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_CUSTOMERS`
--

LOCK TABLES `T_CUSTOMERS` WRITE;
/*!40000 ALTER TABLE `T_CUSTOMERS` DISABLE KEYS */;
INSERT INTO `T_CUSTOMERS` VALUES (1,'12345678','DAVID ASENCIO FIESTAS','dasencio','$2y$10$4WwSWOvnH7tu/cmWv1ebJeWiNpEVTfbVEjvCLF/8Z28ThOIwMBoeO','12345678','2022-06-23 08:00:00',NULL,NULL,'01');
/*!40000 ALTER TABLE `T_CUSTOMERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_DISTRICTS`
--

DROP TABLE IF EXISTS `T_DISTRICTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_DISTRICTS` (
  `id_district` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `description` varchar(150) NOT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_district`),
  KEY `id_customer` (`id_customer`),
  KEY `id_person` (`dni`),
  CONSTRAINT `T_DISTRICTS_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `T_CUSTOMERS` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_DISTRICTS`
--

LOCK TABLES `T_DISTRICTS` WRITE;
/*!40000 ALTER TABLE `T_DISTRICTS` DISABLE KEYS */;
INSERT INTO `T_DISTRICTS` VALUES (1,1,NULL,'SANTIAGO DE SURCO\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(2,1,NULL,'ATE\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(3,1,NULL,'LIMA\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(4,1,NULL,'LOS OLIVOS\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(5,1,NULL,'PUENTE PIEDRA\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(6,1,NULL,'CHACLACAYO\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(7,1,NULL,'CHOSICA\r\n','12345678','2022-09-02 19:50:51',NULL,NULL,'01'),(10,1,NULL,'DA','12345678','2022-12-06 16:38:21',NULL,NULL,'01');
/*!40000 ALTER TABLE `T_DISTRICTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_FILES`
--

DROP TABLE IF EXISTS `T_FILES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_FILES` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `local_route` varchar(255) NOT NULL,
  `server_route` varchar(255) NOT NULL,
  `file_size` decimal(11,2) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_FILES`
--

LOCK TABLES `T_FILES` WRITE;
/*!40000 ALTER TABLE `T_FILES` DISABLE KEYS */;
INSERT INTO `T_FILES` VALUES (22,1,'public/files/uploads/OLAVERDE_1665699568.jpg','https://st.codigoxero.com/public/files/uploads/OLAVERDE_1665699568.jpg',401720.00,'jpg','2022-10-13 18:19:28'),(23,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668047990.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668047990.png',141790.00,'png','2022-11-09 21:39:50'),(24,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668048824.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668048824.png',141790.00,'png','2022-11-09 21:53:44'),(25,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668048958.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668048958.png',141790.00,'png','2022-11-09 21:55:58'),(26,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049037.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049037.png',141790.00,'png','2022-11-09 21:57:17'),(27,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049078.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049078.png',141790.00,'png','2022-11-09 21:57:58'),(28,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049107.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049107.png',141790.00,'png','2022-11-09 21:58:27'),(29,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049165.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049165.png',141790.00,'png','2022-11-09 21:59:25'),(30,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049220.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049220.png',141790.00,'png','2022-11-09 22:00:20'),(31,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049359.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049359.png',141790.00,'png','2022-11-09 22:02:39'),(32,1,'public/files/uploads/192.168.100.20_19500_ (1)_1668049452.png','https://st.codigoxero.com/public/files/uploads/192.168.100.20_19500_ (1)_1668049452.png',141790.00,'png','2022-11-09 22:04:12'),(33,1,'public/files/uploads/file_1668049482.png','https://st.codigoxero.com/public/files/uploads/file_1668049482.png',141790.00,'png','2022-11-09 22:04:42'),(34,1,'public/files/uploads/file_1668107582.png','https://st.codigoxero.com/public/files/uploads/file_1668107582.png',24228.00,'png','2022-11-10 14:13:02'),(35,1,'public/files/uploads/file_1668108240.jpg','https://st.codigoxero.com/public/files/uploads/file_1668108240.jpg',48256.00,'jpg','2022-11-10 14:24:00'),(36,1,'public/files/uploads/file_1668108354.jpg','https://st.codigoxero.com/public/files/uploads/file_1668108354.jpg',48256.00,'jpg','2022-11-10 14:25:54'),(37,1,'public/files/uploads/file_1668108382.jpg','https://st.codigoxero.com/public/files/uploads/file_1668108382.jpg',48256.00,'jpg','2022-11-10 14:26:22'),(38,1,'public/files/uploads/file_1668108482.jpg','https://st.codigoxero.com/public/files/uploads/file_1668108482.jpg',48256.00,'jpg','2022-11-10 14:28:02'),(39,1,'public/files/uploads/file_1668108648.jpg','https://st.codigoxero.com/public/files/uploads/file_1668108648.jpg',48256.00,'jpg','2022-11-10 14:30:48'),(40,1,'public/files/uploads/file_1668108719.jpg','https://st.codigoxero.com/public/files/uploads/file_1668108719.jpg',48256.00,'jpg','2022-11-10 14:31:59');
/*!40000 ALTER TABLE `T_FILES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_METAS`
--

DROP TABLE IF EXISTS `T_METAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_METAS` (
  `id_meta` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `cant_proposal` int(8) DEFAULT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_meta`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_METAS`
--

LOCK TABLES `T_METAS` WRITE;
/*!40000 ALTER TABLE `T_METAS` DISABLE KEYS */;
INSERT INTO `T_METAS` VALUES (10,1,'2022-10-18','2022-10-18',2,'02','1','2022-10-19 00:00:50',NULL,NULL),(11,1,'2022-10-18',NULL,2000,'01','12345678','2022-10-19 01:09:30',NULL,NULL),(12,1,'2022-10-26',NULL,2000,'01','1','2022-10-27 03:41:49',NULL,NULL),(13,1,'2022-11-10',NULL,2000,'01','1','2022-11-10 19:34:20',NULL,NULL),(14,1,'2022-11-10',NULL,200000,'01','1','2022-11-10 20:01:56',NULL,NULL),(15,1,'2022-11-10',NULL,4,'01','1','2022-11-11 01:50:50',NULL,NULL),(16,1,'2023-01-04',NULL,1000,'01','1','2023-01-05 03:01:12',NULL,NULL),(17,1,'2023-01-04',NULL,1000,'01','1','2023-01-05 03:12:17',NULL,NULL),(18,1,'2023-01-04',NULL,999,'01','1','2023-01-05 03:12:28',NULL,NULL),(19,1,'2023-01-04',NULL,999,'01','1','2023-01-05 03:12:47',NULL,NULL),(20,1,'2023-01-04',NULL,999,'01','1','2023-01-05 03:12:48',NULL,NULL),(21,1,'2023-01-04',NULL,999,'01','1','2023-01-05 03:13:00',NULL,NULL);
/*!40000 ALTER TABLE `T_METAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_NUM_ERROR`
--

DROP TABLE IF EXISTS `T_NUM_ERROR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_NUM_ERROR` (
  `id_customer` int(11) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_NUM_ERROR`
--

LOCK TABLES `T_NUM_ERROR` WRITE;
/*!40000 ALTER TABLE `T_NUM_ERROR` DISABLE KEYS */;
/*!40000 ALTER TABLE `T_NUM_ERROR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_PERSONS`
--

DROP TABLE IF EXISTS `T_PERSONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_PERSONS` (
  `dni` varchar(8) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_district` int(11) NOT NULL,
  `id_zone` int(11) NOT NULL,
  `id_street` int(11) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `id_meta` int(11) DEFAULT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `date_birth` date DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `direction` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `whatsApp` varchar(15) DEFAULT NULL,
  `link_facebook` varchar(150) DEFAULT NULL,
  `link_twitter` varchar(150) DEFAULT NULL,
  `link_instagram` varchar(150) DEFAULT NULL,
  `link_tiktok` varchar(150) DEFAULT NULL,
  `link_twitch` varchar(150) DEFAULT NULL,
  `flag_state` varchar(2) NOT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `id_asignacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`dni`),
  UNIQUE KEY `phone` (`phone`),
  KEY `id_sexo` (`id_sexo`),
  KEY `id_meta` (`id_meta`),
  KEY `id_customers` (`id_customer`),
  KEY `id_customer` (`id_customer`),
  KEY `id_district` (`id_district`),
  KEY `id_zone` (`id_zone`),
  KEY `id_street` (`id_street`),
  CONSTRAINT `T_PERSONS_ibfk_1` FOREIGN KEY (`id_sexo`) REFERENCES `T_SEXS` (`id_sex`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_PERSONS_ibfk_2` FOREIGN KEY (`id_meta`) REFERENCES `T_METAS` (`id_meta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_PERSONS_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `T_CUSTOMERS` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_PERSONS_ibfk_4` FOREIGN KEY (`id_district`) REFERENCES `T_DISTRICTS` (`id_district`),
  CONSTRAINT `T_PERSONS_ibfk_5` FOREIGN KEY (`id_zone`) REFERENCES `T_ZONES` (`id_zone`),
  CONSTRAINT `T_PERSONS_ibfk_6` FOREIGN KEY (`id_street`) REFERENCES `T_STREETS` (`id_street`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_PERSONS`
--

LOCK TABLES `T_PERSONS` WRITE;
/*!40000 ALTER TABLE `T_PERSONS` DISABLE KEYS */;
INSERT INTO `T_PERSONS` VALUES ('08870705',1,1,4,3,1,NULL,'David Ronald','asencio','1967-03-21','+51 51987562150',NULL,'Calle lino mendoza, mzv1 lote9 Santiago de surco','dasencio21@gmail.com','-76.9976951','-12.1648294','+51 51987562150','','','','','','01','12345678','2023-01-05 03:01:12',NULL,NULL,NULL),('08870706',1,1,4,3,1,NULL,'David Ronald','asencio','1967-03-21','+51 51987562151',NULL,'Calle lino mendoza, mzv1 lote9 Santiago de surco','dasencio21@msn.com','-76.9982464','-12.1503744','+51 51987562151','','','','','','01','12345678','2023-01-05 03:13:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `T_PERSONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_REPORTS_WSP`
--

DROP TABLE IF EXISTS `T_REPORTS_WSP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_REPORTS_WSP` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  `type` varchar(5) NOT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dni` (`dni`),
  CONSTRAINT `T_REPORTS_WSP_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `T_USERS` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_REPORTS_WSP`
--

LOCK TABLES `T_REPORTS_WSP` WRITE;
/*!40000 ALTER TABLE `T_REPORTS_WSP` DISABLE KEYS */;
/*!40000 ALTER TABLE `T_REPORTS_WSP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_REPORT_METAS`
--

DROP TABLE IF EXISTS `T_REPORT_METAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_REPORT_METAS` (
  `id_reporte` int(11) NOT NULL,
  `id_meta` int(11) NOT NULL,
  `dni_person` varchar(8) NOT NULL,
  `date_create` datetime NOT NULL,
  KEY `id_meta` (`id_meta`),
  KEY `id_reporte` (`id_reporte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_REPORT_METAS`
--

LOCK TABLES `T_REPORT_METAS` WRITE;
/*!40000 ALTER TABLE `T_REPORT_METAS` DISABLE KEYS */;
INSERT INTO `T_REPORT_METAS` VALUES (9,10,'32121332','2022-10-18 20:02:23'),(9,10,'98765432','2022-10-18 20:55:50'),(10,11,'123456','2022-10-18 22:28:44'),(11,12,'10490324','2022-10-26 23:56:53'),(11,12,'43734','2022-10-26 23:59:35'),(11,12,'4212','2022-10-27 00:00:06'),(11,12,'08870704','2022-10-27 00:02:51'),(11,12,'933256','2022-10-29 00:03:08'),(11,12,'31642487','2022-10-30 13:59:08'),(10,11,'87878789','2022-10-31 20:18:23'),(8,8,'125478','2022-11-04 10:24:38'),(11,12,'6546456','2022-11-04 14:11:51'),(10,11,'43853435','2022-11-05 13:53:44'),(10,11,'08870705','2022-11-08 12:46:52'),(14,15,'75618258','2022-11-11 08:48:00');
/*!40000 ALTER TABLE `T_REPORT_METAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_SETTING`
--

DROP TABLE IF EXISTS `T_SETTING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_SETTING` (
  `id_customer` int(11) DEFAULT NULL,
  `url_logo` varchar(255) DEFAULT NULL,
  `app_name` varchar(255) DEFAULT NULL,
  `token_twilio` varchar(255) DEFAULT NULL,
  `ssid_twilio` varchar(255) DEFAULT NULL,
  `mensaje_bienvenida` varchar(500) DEFAULT NULL,
  `wheather_key` varchar(255) DEFAULT NULL,
  `number_wsp` varchar(255) DEFAULT NULL,
  `number_sms` varchar(255) NOT NULL,
  `messaging_service` varchar(255) DEFAULT NULL,
  `instance_id` varchar(255) DEFAULT NULL,
  `token_instance` varchar(255) DEFAULT NULL,
  `default_message` text NOT NULL,
  `codigo_pais` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_SETTING`
--

LOCK TABLES `T_SETTING` WRITE;
/*!40000 ALTER TABLE `T_SETTING` DISABLE KEYS */;
INSERT INTO `T_SETTING` VALUES (1,'public/assets/images/logos/911af7aa209e00b49f3d6fd2afa92564.png','SISTEMA TIERRA','9334d1472306ff09fbd996de41d2a91c','ACe3f3ecbca478f482c800170258d380b2','Bienvenido {{1}} al sistema tierra, se ha usado este número, para registrar un usuario tipo {{2}}. Por seguridad necesitamos que confirmes este mensaje dando click en el botón de --aceptar--. Para empezar a recibir notificaciones y mensajes personalizados de nuestra campaña.','5f7177bc606b4e3b90a11540222307','+51949082760','+12058838596','MGda1123b6ab7c5261f89d9de5d1c4462b','instance16630','974vtlak4ibhcyrv','¡Se ha registrado correctamente al sistema territorial! Que bueno que ahora formas parte de nosotros!','');
/*!40000 ALTER TABLE `T_SETTING` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_SEXS`
--

DROP TABLE IF EXISTS `T_SEXS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_SEXS` (
  `id_sex` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `flag_state` varchar(2) NOT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_sex`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_SEXS`
--

LOCK TABLES `T_SEXS` WRITE;
/*!40000 ALTER TABLE `T_SEXS` DISABLE KEYS */;
INSERT INTO `T_SEXS` VALUES (1,'MASCULINO','01','12345678','2022-06-23 08:00:00',NULL,NULL),(2,'FEMENINO','01','12345678','2022-06-23 08:00:00',NULL,NULL),(3,'NO ESPECIFICADO','01',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `T_SEXS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_STREETS`
--

DROP TABLE IF EXISTS `T_STREETS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_STREETS` (
  `id_street` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_zone` int(11) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_street`),
  KEY `id_zone` (`id_zone`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `T_STREETS_ibfk_1` FOREIGN KEY (`id_zone`) REFERENCES `T_ZONES` (`id_zone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_STREETS_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `T_CUSTOMERS` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_STREETS`
--

LOCK TABLES `T_STREETS` WRITE;
/*!40000 ALTER TABLE `T_STREETS` DISABLE KEYS */;
INSERT INTO `T_STREETS` VALUES (1,1,2,NULL,'DENSA','12345678','2022-09-02 19:54:37',NULL,NULL,'01'),(2,1,5,NULL,'LOS UMBRALES','12345678','2022-09-02 19:55:20',NULL,NULL,'01'),(3,1,4,NULL,'ARCOIRIS','12345678','2022-09-05 18:46:21',NULL,NULL,'01'),(4,1,6,NULL,'REYES','12345678','2022-09-06 01:34:56',NULL,NULL,'01');
/*!40000 ALTER TABLE `T_STREETS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_SUPER_ADMIN`
--

DROP TABLE IF EXISTS `T_SUPER_ADMIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_SUPER_ADMIN` (
  `dni` varchar(8) NOT NULL,
  `description` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `flg_state` varchar(2) DEFAULT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_SUPER_ADMIN`
--

LOCK TABLES `T_SUPER_ADMIN` WRITE;
/*!40000 ALTER TABLE `T_SUPER_ADMIN` DISABLE KEYS */;
INSERT INTO `T_SUPER_ADMIN` VALUES ('12345678','ADMINISTRADOR','qwerty%','01',NULL,NULL);
/*!40000 ALTER TABLE `T_SUPER_ADMIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_TEMPLATE_MSJ`
--

DROP TABLE IF EXISTS `T_TEMPLATE_MSJ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_TEMPLATE_MSJ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `body` blob NOT NULL,
  `status` varchar(2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_customer` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_TEMPLATE_MSJ`
--

LOCK TABLES `T_TEMPLATE_MSJ` WRITE;
/*!40000 ALTER TABLE `T_TEMPLATE_MSJ` DISABLE KEYS */;
/*!40000 ALTER TABLE `T_TEMPLATE_MSJ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_TYPEUSERS`
--

DROP TABLE IF EXISTS `T_TYPEUSERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_TYPEUSERS` (
  `id_typeuser` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_typeuser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_TYPEUSERS`
--

LOCK TABLES `T_TYPEUSERS` WRITE;
/*!40000 ALTER TABLE `T_TYPEUSERS` DISABLE KEYS */;
INSERT INTO `T_TYPEUSERS` VALUES (1,1,'SIMPATIZANTE','01','12345678','2022-06-23 08:00:00',NULL,NULL),(2,1,'VOLUNTARIO FISICO','01','12345678','2022-06-23 08:00:00',NULL,NULL),(3,1,'VOLUNTARIO VIRTUAL','01','12345678','2022-06-23 08:00:00',NULL,NULL),(4,1,'COORDINADOR','01','12345678','2022-06-23 08:00:00',NULL,NULL);
/*!40000 ALTER TABLE `T_TYPEUSERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_USERS`
--

DROP TABLE IF EXISTS `T_USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_USERS` (
  `dni` varchar(8) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_typeuser` int(11) NOT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`dni`),
  KEY `id_customer` (`id_customer`),
  KEY `type_user` (`id_typeuser`),
  CONSTRAINT `T_USERS_ibfk_1` FOREIGN KEY (`id_typeuser`) REFERENCES `T_TYPEUSERS` (`id_typeuser`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_USERS_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `T_CUSTOMERS` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_USERS`
--

LOCK TABLES `T_USERS` WRITE;
/*!40000 ALTER TABLE `T_USERS` DISABLE KEYS */;
INSERT INTO `T_USERS` VALUES ('00000000',1,'1234',4,'01','12345678','2022-11-10 19:34:20',NULL,NULL),('00000001',1,'1234',4,'01','12345678','2022-11-10 20:01:56',NULL,NULL),('08870705',1,'987562150',4,'01','12345678','2022-11-11 01:50:50',NULL,NULL),('08870706',1,'210367',4,'01','12345678','2023-01-05 03:13:00',NULL,NULL),('75618258',1,'001',1,'01','08870705','2022-11-11 13:48:00',NULL,NULL),('8787',1,'98',1,'01','12345678','2022-11-23 19:23:08',NULL,NULL);
/*!40000 ALTER TABLE `T_USERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_USERS_PERSONS`
--

DROP TABLE IF EXISTS `T_USERS_PERSONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_USERS_PERSONS` (
  `id_customer` int(11) NOT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `dni_coordinador` varchar(8) DEFAULT NULL,
  `dni_simpatizantes` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_USERS_PERSONS`
--

LOCK TABLES `T_USERS_PERSONS` WRITE;
/*!40000 ALTER TABLE `T_USERS_PERSONS` DISABLE KEYS */;
INSERT INTO `T_USERS_PERSONS` VALUES (1,'3131','14232342',NULL),(1,'124578','14232342','3131'),(1,'14725836','14232342',NULL),(1,'14725836','14232342',NULL),(1,'14725836','14232342',NULL),(1,'14725836','14232342',NULL),(1,'14725836','14232342',NULL),(1,'14725836','14232342',NULL),(1,'14725836','14232342',NULL),(1,'88527272','222','null'),(1,'36963','12','null'),(1,'1555','12',NULL),(1,'7855','12',NULL),(1,'12311114','12','null'),(1,'555','12','null'),(1,'555','12','null'),(1,'555','12','null'),(1,'555','12',NULL),(1,'87658674','12',NULL),(1,'555','12','null'),(1,'87658674','12',NULL),(1,'87658674','12','null'),(1,'1254152','12',NULL),(1,'12541525','12',NULL),(1,'14','12',NULL),(1,'98764512','12','null'),(1,'98764519','12','null'),(1,'456987','12','null'),(1,'sdffdsfd','12','null'),(1,'44233422','12','null'),(1,'32121332','12345678',NULL),(1,'98765432','12345678',NULL),(1,'123456','12345678','98765432'),(1,'10490324','08870705',NULL),(1,'43734','08870705',NULL),(1,'4212','08870705',NULL),(1,'08870704','08870705','null'),(1,'933256','08870705','null'),(1,'31642487','08870705',NULL),(1,'87878789','12345678',NULL),(1,'125478','12',NULL),(1,'6546456','08870705',NULL),(1,'43853435','12345678','null'),(1,'08870705','12345678','null'),(1,'75618258','08870705',NULL);
/*!40000 ALTER TABLE `T_USERS_PERSONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `T_ZONES`
--

DROP TABLE IF EXISTS `T_ZONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `T_ZONES` (
  `id_zone` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_district` int(11) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `description` varchar(150) NOT NULL,
  `user_create` varchar(8) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(8) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `flag_state` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_zone`),
  KEY `id_district` (`id_district`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `T_ZONES_ibfk_2` FOREIGN KEY (`id_district`) REFERENCES `T_DISTRICTS` (`id_district`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `T_ZONES_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `T_CUSTOMERS` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `T_ZONES`
--

LOCK TABLES `T_ZONES` WRITE;
/*!40000 ALTER TABLE `T_ZONES` DISABLE KEYS */;
INSERT INTO `T_ZONES` VALUES (2,1,2,NULL,'SANTA CLARA','12345678','2022-09-02 19:52:11',NULL,NULL,'01'),(3,1,2,222,'HUAYCAN','12345678','2022-09-02 19:52:29',NULL,NULL,'01'),(4,1,1,NULL,'Sagitario','12345678','2022-09-02 19:52:42','12345678','2023-01-05 03:04:57','01'),(5,1,7,NULL,'RICARDO PALMA','12345678','2022-09-02 19:52:56',NULL,NULL,'01'),(6,1,2,NULL,'EYZAGUIRRE','12345678','2022-09-02 19:53:59','12345678','2022-11-28 18:33:03','01'),(7,1,5,NULL,'HUAMANTANGA','12345678','2022-09-02 19:54:12',NULL,NULL,'01');
/*!40000 ALTER TABLE `T_ZONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_doc`
--

DROP TABLE IF EXISTS `temp_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(255) DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_doc`
--

LOCK TABLES `temp_doc` WRITE;
/*!40000 ALTER TABLE `temp_doc` DISABLE KEYS */;
INSERT INTO `temp_doc` VALUES (2,'public/assets/images/logos/f9edda05c1a98d53f302da3c0b5393b3.png','png'),(3,'public/docs/imp_tmp_1664651916.xlsx','xlsx'),(4,'public/docs/imp_tmp_1664652064.xlsx','xlsx'),(5,'public/docs/imp_tmp_1664671544.png','png'),(6,'public/docs/imp_tmp_1664673796.png','png'),(7,'public/docs/imp_tmp_1664673918.csv','csv'),(8,'public/docs/imp_tmp_1664673961.csv','csv'),(9,'public/docs/imp_tmp_1664674024.csv','csv'),(10,'public/docs/imp_tmp_1664674118.csv','csv'),(11,'public/docs/imp_tmp_1664674165.csv','csv'),(12,'public/docs/imp_tmp_1664674220.csv','csv'),(13,'public/docs/imp_tmp_1664674322.csv','csv'),(14,'public/docs/imp_tmp_1664674357.csv','csv'),(15,'public/docs/imp_tmp_1664674402.csv','csv'),(16,'public/docs/imp_tmp_1664674511.csv','csv'),(17,'public/docs/imp_tmp_1664674971.csv','csv'),(18,'public/docs/imp_tmp_1664675113.csv','csv'),(19,'public/docs/imp_tmp_1664675125.csv','csv'),(20,'public/docs/imp_tmp_1664675161.csv','csv'),(21,'public/docs/imp_tmp_1664675192.csv','csv'),(22,'public/docs/imp_tmp_1664675232.csv','csv'),(23,'public/docs/imp_tmp_1664675369.csv','csv'),(24,'public/assets/images/logos/0e90a50dc860578545314b938a29a346.jpeg','jpeg'),(25,'public/assets/images/logos/26f9af5aa77ebc549f20acaa4de11ae6.jpeg','jpeg'),(26,'public/assets/images/logos/a0c4c6f280eb93d3100dac30403057f4.png','png'),(27,'public/assets/images/logos/911af7aa209e00b49f3d6fd2afa92564.png','png'),(28,'public/docs/imp_tmp_1665550148.csv','csv'),(29,'public/docs/imp_tmp_1665550234.csv','csv'),(30,'public/docs/imp_tmp_1665550270.csv','csv'),(31,'public/docs/imp_tmp_1665550336.csv','csv'),(32,'public/docs/imp_tmp_1665550365.csv','csv'),(33,'public/docs/imp_tmp_1665550406.csv','csv'),(34,'public/docs/imp_tmp_1665550436.csv','csv'),(35,'public/docs/imp_tmp_1665550486.csv','csv'),(36,'public/docs/imp_tmp_1665621330.csv','csv'),(37,'public/docs/imp_tmp_1665621342.csv','csv'),(38,'public/docs/imp_tmp_1665621422.csv','csv'),(39,'public/docs/imp_tmp_1665621437.csv','csv'),(40,'public/docs/imp_tmp_1665621597.csv','csv'),(41,'public/docs/imp_tmp_1665621679.csv','csv'),(42,'public/docs/imp_tmp_1665621723.csv','csv'),(43,'public/docs/imp_tmp_1665621804.csv','csv'),(44,'public/docs/imp_tmp_1665621918.csv','csv'),(45,'public/docs/imp_tmp_1665622012.csv','csv'),(46,'public/docs/imp_tmp_1665622144.csv','csv'),(47,'public/docs/imp_tmp_1665622266.csv','csv'),(48,'public/docs/imp_tmp_1665686479.csv','csv'),(49,'public/docs/imp_tmp_1665686525.csv','csv'),(50,'public/docs/imp_tmp_1665686561.csv','csv'),(51,'public/docs/imp_tmp_1665687594.csv','csv'),(52,'public/docs/imp_tmp_1665687636.csv','csv'),(53,'public/docs/imp_tmp_1665691823.csv','csv'),(54,'public/docs/imp_tmp_1665691992.csv','csv'),(55,'public/docs/imp_tmp_1665692576.csv','csv'),(56,'public/docs/imp_tmp_1665692591.csv','csv'),(57,'public/docs/imp_tmp_1665699514.csv','csv'),(58,'public/docs/imp_tmp_1665701019.csv','csv'),(59,'public/docs/imp_tmp_1665701047.csv','csv'),(60,'public/docs/imp_tmp_1665701171.csv','csv'),(61,'public/docs/imp_tmp_1665701348.csv','csv'),(62,'public/docs/imp_tmp_1665701742.csv','csv'),(63,'public/docs/imp_tmp_1665701838.csv','csv'),(64,'public/docs/imp_tmp_1665701922.csv','csv'),(65,'public/docs/imp_tmp_1665781100.csv','csv'),(66,'public/docs/imp_tmp_1665781224.csv','csv'),(67,'public/docs/imp_tmp_1665781264.csv','csv'),(68,'public/docs/imp_tmp_1665781311.csv','csv'),(69,'public/docs/imp_tmp_1665781366.csv','csv'),(70,'public/docs/imp_tmp_1665781428.csv','csv'),(71,'public/docs/imp_tmp_1665781529.csv','csv'),(72,'public/docs/imp_tmp_1665781694.csv','csv'),(73,'public/docs/imp_tmp_1665797162.csv','csv'),(74,'public/docs/imp_tmp_1665797340.csv','csv'),(75,'public/docs/imp_tmp_1665797435.csv','csv'),(76,'public/docs/imp_tmp_1665797593.csv','csv'),(77,'public/docs/imp_tmp_1665797784.csv','csv'),(78,'public/docs/imp_tmp_1665797994.csv','csv'),(79,'public/docs/imp_tmp_1665798031.csv','csv'),(80,'public/docs/imp_tmp_1665798076.csv','csv'),(81,'public/docs/imp_tmp_1665798110.csv','csv'),(82,'public/docs/imp_tmp_1665798479.csv','csv'),(83,'public/docs/imp_tmp_1665798573.csv','csv'),(84,'public/docs/imp_tmp_1665798679.csv','csv'),(85,'public/docs/imp_tmp_1665894113.xlsx','xlsx'),(86,'public/docs/imp_tmp_1665894248.xlsx','xlsx'),(87,'public/docs/imp_tmp_1665894347.xlsx','xlsx'),(88,'public/docs/imp_tmp_1665894380.xlsx','xlsx'),(89,'public/docs/imp_tmp_1665894389.xlsx','xlsx'),(90,'public/docs/imp_tmp_1667930607.xlsx','xlsx'),(91,'public/docs/imp_tmp_1667930739.xlsx','xlsx'),(92,'public/docs/imp_tmp_1668046471.xlsx','xlsx'),(93,'public/docs/imp_tmp_1668046551.xlsx','xlsx'),(94,'public/docs/imp_tmp_1668048838.xlsx','xlsx'),(95,'public/docs/imp_tmp_1668048966.xlsx','xlsx'),(96,'public/docs/imp_tmp_1668049028.xlsx','xlsx'),(97,'public/docs/imp_tmp_1668049075.xlsx','xlsx'),(98,'public/docs/imp_tmp_1668049113.xlsx','xlsx'),(99,'public/docs/imp_tmp_1668049143.xlsx','xlsx'),(100,'public/docs/imp_tmp_1668049162.xlsx','xlsx'),(101,'public/docs/imp_tmp_1668049368.xlsx','xlsx'),(102,'public/docs/imp_tmp_1668049447.xlsx','xlsx'),(103,'public/docs/imp_tmp_1668049492.xlsx','xlsx'),(104,'public/docs/imp_tmp_1668107598.xlsx','xlsx'),(105,'public/docs/imp_tmp_1668107641.xlsx','xlsx'),(106,'public/docs/imp_tmp_1668107752.xlsx','xlsx'),(107,'public/docs/imp_tmp_1668108186.xlsx','xlsx'),(108,'public/docs/imp_tmp_1668108251.xlsx','xlsx'),(109,'public/docs/imp_tmp_1668108351.xlsx','xlsx'),(110,'public/docs/imp_tmp_1668108376.xlsx','xlsx'),(111,'public/docs/imp_tmp_1668108490.xlsx','xlsx'),(112,'public/docs/imp_tmp_1668108562.xlsx','xlsx'),(113,'public/docs/imp_tmp_1668108654.xlsx','xlsx'),(114,'public/docs/imp_tmp_1668108725.xlsx','xlsx'),(115,'public/docs/imp_tmp_1668110880.xlsx','xlsx');
/*!40000 ALTER TABLE `temp_doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_dist_coord`
--

DROP TABLE IF EXISTS `v_dist_coord`;
/*!50001 DROP VIEW IF EXISTS `v_dist_coord`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_dist_coord` AS SELECT
 1 AS `description`,
  1 AS `id_customer`,
  1 AS `nombre`,
  1 AS `meta`,
  1 AS `id_meta`,
  1 AS `dni_coord` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_dist_coord`
--

/*!50001 DROP VIEW IF EXISTS `v_dist_coord`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`comeswzs`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_dist_coord` AS select `d`.`description` AS `description`,`d`.`id_customer` AS `id_customer`,ucase(concat(`p`.`first_name`,' ',`p`.`last_name`)) AS `nombre`,`m`.`cant_proposal` AS `meta`,`m`.`id_meta` AS `id_meta`,`p`.`dni` AS `dni_coord` from (((`T_DISTRICTS` `d` join `T_PERSONS` `p` on(`d`.`dni` = `p`.`dni`)) join `T_METAS` `m` on(`p`.`id_meta` = `m`.`id_meta`)) join `T_USERS` `tu` on(`p`.`dni` = `tu`.`dni`)) where `tu`.`id_typeuser` = 4 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-07 18:26:46
