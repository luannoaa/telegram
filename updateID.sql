CREATE TABLE `tbbotresposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `nm_comando` varchar(255) DEFAULT NULL,
  `resposta` varchar(255) DEFAULT NULL,
  `update_id` varchar(255) NOT NULL,
  PRIMARY KEY (`update_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
