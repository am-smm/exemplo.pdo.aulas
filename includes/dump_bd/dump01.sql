DROP SCHEMA IF EXISTS `smm_pdo`;
CREATE DATABASE `smm_pdo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `smm_pdo`;

DROP TABLE IF EXISTS `utilizador`;

CREATE TABLE `utilizador` (
  `id` mediumint unsigned NOT NULL auto_increment,
  `nome` varchar(255) default NULL,
  `apelido` varchar(255) default NULL,
  `username` varchar(255),
  `email` varchar(255) default NULL,
  `psw` varchar(255),
  `dh_registo` datetime,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `utilizador` (`id`,`nome`,`apelido`,`username`,`email`,`psw`,`dh_registo`)
VALUES
  (1,"Jacqueline","Jackson","UEUZJY","mauris.eu@google.org","TYN64HFE2YM","2023-11-15 20:57:59"),
  (2,"Christian","Douglas","SBAHUM","eros@google.edu","SGR65XIC4DF","2023-02-27 23:55:05"),
  (3,"Melvin","Barnett","SORBKO","ac.facilisis@yahoo.net","QHM04RDF7OZ","2023-01-06 04:12:18"),
  (4,"Colton","Dean","SWVUEJ","nam@outlook.com","NKS46OJT8WM","2023-11-12 06:19:55"),
  (5,"Colby","Jenkins","PWDMTV","donec.non@icloud.org","UGT42TFU3EQ","2022-04-05 06:44:07"),
  (6,"Davis","Mcfarland","XMKNXX","et.netus@outlook.net","TMW76LTR1XC","2022-11-05 01:41:53"),
  (7,"Cassady","Espinoza","DNVZAC","facilisis.lorem@aol.net","XRK15XNZ1VT","2022-06-13 12:58:56"),
  (8,"Vaughan","Foreman","QSWOTC","accumsan@aol.couk","IYO03MND2LD","2022-07-28 12:31:51"),
  (9,"Kylie","Bryan","EGSMYU","ut.tincidunt@protonmail.couk","FYF87WNJ6QE","2022-06-18 11:19:47"),
  (10,"Hillary","Bird","RLUDQL","proin.mi@outlook.com","NHJ90EZJ4SS","2022-01-22 13:37:54"),
  (11,"Destiny","Bradford","TBTYAK","mollis.lectus@google.couk","YYH68INY1FR","2022-12-29 15:48:49"),
  (12,"Ferdinand","Goodman","ENFIJG","orci.in@yahoo.edu","QEB76PLI4LB","2023-05-31 08:39:52"),
  (13,"Marvin","Mueller","UEKBTA","pellentesque.eget@outlook.ca","UVB31BRC3VC","2022-07-22 00:00:28"),
  (14,"Lacy","Gay","YFDPQY","dui.fusce.diam@yahoo.com","SIA71XTV7VN","2023-02-08 03:15:20"),
  (15,"Amela","Donaldson","HNFEMH","quis@icloud.edu","IFW53RWY7WW","2023-08-30 08:25:36"),
  (16,"Fritz","Richard","XLKQMY","per.conubia@google.ca","JMM57PJI1FG","2022-03-04 04:57:13"),
  (17,"Serina","Caldwell","FQKVMF","quisque.ac@outlook.couk","DGU03YND3PF","2023-07-27 08:11:58"),
  (18,"Zenia","Raymond","XJKBHN","sem.mollis@hotmail.couk","QJH22TLI9UI","2023-07-10 05:42:45"),
  (19,"Hashim","Lamb","TNEAEC","auctor.ullamcorper@google.com","NYQ20IOL7MV","2022-11-19 19:45:31"),
  (20,"Hamish","Richard","MWOXBJ","est@yahoo.org","DHH13HBG9DL","2023-06-22 12:21:32");
