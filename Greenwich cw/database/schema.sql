-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: greenwich_qa
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Current Database: `greenwich_qa`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `greenwich_qa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `greenwich_qa`;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(160) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'Web Programming','2026-07-25 04:37:08'),(2,'Business Management','2026-07-25 04:37:08'),(3,'Information Analysis and Visualisation','2026-07-25 04:37:08'),(5,'Graphic Design','2026-07-25 04:37:08'),(6,'Food','2026-07-25 04:37:08'),(7,'Travels','2026-07-25 04:37:08'),(8,'Family','2026-07-25 04:37:08'),(9,'Study tips','2026-07-25 04:37:08'),(10,'London campus','2026-07-25 04:37:08');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(220) NOT NULL,
  `body` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_posts_user` (`user_id`),
  KEY `fk_posts_module` (`module_id`),
  CONSTRAINT `fk_posts_module` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_posts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,9,'Best Study Tips','Study Smarter, Not Harder\r\nBlurting Method - Write down everything you remember from a topic then check what you missed.\r\nActive Recall > Rereading - Don’t just read notes test yourself by recalling information.\r\nTeach It to a 5 Year Old - If you can’t explain it simply you don’t fully understand it.\r\nThe Feynman Technique - Break complex topics into simple explanations to deepen understanding.\r\n\r\nFocus & Productivity\r\nNo Multitasking - Focus on one task at a time for better retention.\r\nUse the 2-Minute Rule - If a small task takes less than 2 minutes do it immediately (helps avoid procrastination).\r\nPomodoro Technique - Study for 25-50 min, take a 5-10 min break, repeat.\r\n\r\nMindset & Motivation\r\nDone is Better Than Perfect - Progress > Perfection. Don’t get stuck trying to make perfect notes.\r\nStart With the Hardest Task First - Your willpower is strongest at the start of a study session.\r\nSet Micro Goals - Instead of “Study for 3 hours,” break it into “Finish 2 chapters” or “Solve 10 problems.”\r\nReward Yourself - Small rewards keep you motivated.',NULL,'2026-02-12 02:30:00','2026-07-26 10:26:05'),(2,3,2,'Motivational Theories to solve Collaboration Problem','Hi everyone, I will now have a project about Business. I am in the process of choosing a business to implement the project (business case). I have a business that is having problems related to collaboration. I wonder if motivational theories can handle the collaboration problem? Thanks in advance.',NULL,'2026-02-15 07:10:00','2026-07-26 10:26:17'),(3,4,2,'Please help me, I don\'t know what happened. I just started coding','Just got my laptop 4 days ago and have no idea about coding or anything need help. I was following the video online.','assets/images/code-problem.jpeg','2026-02-20 03:15:00','2026-07-26 10:27:16'),(4,6,3,'Feeling stuck in Data Cleaning & Visualization despite knowing ML theory — any advice?','I’ve been learning Machine Learning for the past few months and I’m comfortable with the theory side of things now. I understand statistics, calculus, and the workings of most ML algorithms.\r\n\r\nI’ve also learned libraries like Pandas, NumPy, Matplotlib, and Seaborn, but the problem is that I still can’t confidently use them on real-world datasets. Either I get confused about what to do next, or I feel like my knowledge is insufficient for practical projects.\r\n\r\nEven small suggestions or personal experiences would really help.','assets/images/matplotlib stack.png','2026-03-01 06:00:00','2026-07-26 10:27:31'),(5,8,6,'Best cheap food near Greenwich campus?','Been living on the same two places near campus and want to branch out. What is actually good and still affordable?','assets/images/greenwich street.png','2026-03-09 09:45:00','2026-07-26 10:26:41'),(6,7,3,'Anyone have a good free/ cheap software or website for dithering?','Im just looking for an ideally free, or at least cheap good quality method for dithering images. I have found websites in the past, the quality of which is questionable. The reason why I\'m not just googling this is because searching for this stuff online is super unreliable with different sponsored links, scams, pay walls, and low quality garbage thats pushed to you immediately.','assets/images/Best-Graphic-Design.jpg','2026-03-12 04:20:00','2026-07-26 10:26:49'),(7,3,NULL,'We need to add topics like club activities and other activities?','Let\'s add a topic where students could post about school activities, clubs, and events.',NULL,'2026-03-15 05:30:00','2026-07-26 10:27:05'),(8,2,7,'Greenwich Malaysia tour!!','Malaysia tour is so much fun. This is a good time for learning new stuff while relieving the stress!','assets/images/Malaysia tour.png','2026-03-18 11:05:00','2026-07-26 10:25:32'),(9,2,6,'Hello','Welcome guys, to our episode',NULL,'2026-08-09 13:25:23','2026-08-09 13:25:23');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Oliver Smith','Oliver@greenwich.ac.uk','$argon2id$v=19$m=65536,t=4,p=2$LnU4emw1cTliajkzdlYxbg$+R/LubfVs1oNuF3+s6ORYbAybIpklv/ngLjXLYUCnxs',1,'2026-07-25 04:37:08'),(2,'Amelia Johnson','Amelia@greenwich.ac.uk','$argon2id$v=19$m=65536,t=4,p=2$LnU4emw1cTliajkzdlYxbg$+R/LubfVs1oNuF3+s6ORYbAybIpklv/ngLjXLYUCnxs',0,'2026-07-25 04:37:08'),(3,'Ethan Williams','Ethan@greenwich.ac.uk','$argon2id$v=19$m=65536,t=4,p=2$LnU4emw1cTliajkzdlYxbg$+R/LubfVs1oNuF3+s6ORYbAybIpklv/ngLjXLYUCnxs',0,'2026-07-25 04:37:08'),(4,'Chloe Wang','Chloe@greenwich.ac.uk','$2a$12$4/5gveWaRLvIND2gWjjHdOsosN5YfW51tB4/qONlKkNyNgLPGpebq',0,'2026-07-25 04:37:08'),(5,'Daniel Chen','Daniel@greenwich.ac.uk','$2a$12$4/5gveWaRLvIND2gWjjHdOsosN5YfW51tB4/qONlKkNyNgLPGpebq',0,'2026-07-25 04:37:08'),(6,'Mia Takahashi','Mia@greenwich.ac.uk','$2a$12$4/5gveWaRLvIND2gWjjHdOsosN5YfW51tB4/qONlKkNyNgLPGpebq',0,'2026-07-25 04:37:08'),(7,'Liam Tran','Liam@greenwich.ac.uk','$2a$12$4/5gveWaRLvIND2gWjjHdOsosN5YfW51tB4/qONlKkNyNgLPGpebq',0,'2026-07-25 04:37:08'),(8,'Alex Pham','Alex@greenwich.ac.uk','$2a$12$4/5gveWaRLvIND2gWjjHdOsosN5YfW51tB4/qONlKkNyNgLPGpebq',0,'2026-07-25 04:37:08'),(9,'Francine Martinez','Francine@greenwich.ac.uk','$2a$12$4/5gveWaRLvIND2gWjjHdOsosN5YfW51tB4/qONlKkNyNgLPGpebq',0,'2026-07-25 04:37:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-09 20:29:39
