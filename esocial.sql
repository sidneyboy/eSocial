/*
SQLyog Community v12.09 (64 bit)
MySQL - 10.4.22-MariaDB : Database - esocial
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`esocial` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `esocial`;

/*Table structure for table `assignment_details` */

DROP TABLE IF EXISTS `assignment_details`;

CREATE TABLE `assignment_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_question_id` bigint(20) DEFAULT NULL,
  `choice_a` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_b` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_c` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_d` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `assignment_details` */

insert  into `assignment_details`(`id`,`assignment_question_id`,`choice_a`,`choice_b`,`choice_c`,`choice_d`,`created_at`,`updated_at`) values (8,25,'A','B','C','D','2022-09-24 01:15:56','2022-09-24 01:15:56');

/*Table structure for table `assignment_matchings` */

DROP TABLE IF EXISTS `assignment_matchings`;

CREATE TABLE `assignment_matchings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_question_id` bigint(20) NOT NULL,
  `choices` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `assignment_matchings` */

insert  into `assignment_matchings`(`id`,`assignment_question_id`,`choices`,`created_at`,`updated_at`) values (17,27,'Carmen','2022-09-24 01:17:00','2022-09-24 01:17:00'),(18,27,'Cagayan de Oro City','2022-09-24 01:17:00','2022-09-24 01:17:00'),(19,27,'Bulue','2022-09-24 01:17:00','2022-09-24 01:17:00'),(20,27,'CDO','2022-09-24 01:17:00','2022-09-24 01:17:00'),(21,27,'Pasil','2022-09-24 01:17:00','2022-09-24 01:17:00');

/*Table structure for table `assignment_questions` */

DROP TABLE IF EXISTS `assignment_questions`;

CREATE TABLE `assignment_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `course_assignment_id` bigint(20) NOT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `assignment_questions` */

insert  into `assignment_questions`(`id`,`course_id`,`course_assignment_id`,`course_chapter_id`,`question`,`answer`,`question_type`,`score`,`created_at`,`updated_at`) values (24,8,15,4,'Question Enumeration','enumerate1|enumerate2','Enumeration','30','2022-09-24 01:15:31','2022-09-24 01:15:31'),(25,8,15,4,'Multiple Choice','choice_b','Multitple Choice','10','2022-09-24 01:15:56','2022-09-24 01:15:56'),(26,8,15,4,'Identifacation Question','identify','Identification','20','2022-09-24 01:16:10','2022-09-24 01:16:10'),(27,8,15,4,'Bulua|Gumamela Ext.','cagayan de oro city|carmen','Matching Type','30','2022-09-24 01:16:59','2022-09-24 01:16:59'),(28,8,15,4,'Enumerate 2','enumarete2','Enumeration','20','2022-09-24 01:17:14','2022-09-24 01:17:14');

/*Table structure for table `assignment_taken_details` */

DROP TABLE IF EXISTS `assignment_taken_details`;

CREATE TABLE `assignment_taken_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_taken_id` bigint(20) NOT NULL,
  `assignment_question_id` bigint(20) NOT NULL,
  `student_answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `assignment_taken_details` */

/*Table structure for table `assignment_takens` */

DROP TABLE IF EXISTS `assignment_takens`;

CREATE TABLE `assignment_takens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `assignment_takens` */

insert  into `assignment_takens`(`id`,`assignment_id`,`instructor_id`,`student_id`,`course_chapter_id`,`course_id`,`score`,`total_points`,`remarks`,`created_at`,`updated_at`) values (1,15,13,12,4,8,NULL,NULL,NULL,'2022-09-24 14:24:33','2022-09-24 14:24:33');

/*Table structure for table `assignments` */

DROP TABLE IF EXISTS `assignments`;

CREATE TABLE `assignments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `number_of_questions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deadline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `assignments` */

insert  into `assignments`(`id`,`course_id`,`number_of_questions`,`course_chapter_id`,`title`,`status`,`created_at`,`updated_at`,`deadline`) values (15,8,'5',4,'Assignment 1','enabled','2022-09-24 09:14:48','2022-09-26 03:06:19','2022-09-26');

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `course_id` bigint(20) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `comments` */

/*Table structure for table `course_chapters` */

DROP TABLE IF EXISTS `course_chapters`;

CREATE TABLE `course_chapters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `course_chapters` */

insert  into `course_chapters`(`id`,`course_id`,`title`,`created_at`,`updated_at`,`content`,`chapter_number`,`thumbnail`) values (4,8,'Title','2022-09-21 12:28:27','2022-09-22 10:49:00','What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum','1','received_790004915490478.jpeg'),(5,8,'ASDASD','2022-09-21 13:31:21','2022-09-21 13:31:21','QWEQWE','ASDAS','307075117_5768675756490072_2746946818833767974_n.png'),(6,8,'asdasd','2022-09-23 08:27:48','2022-09-23 08:27:48','qweqwe','3','barangay_logo.jpeg');

/*Table structure for table `course_details` */

DROP TABLE IF EXISTS `course_details`;

CREATE TABLE `course_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `course_details` */

insert  into `course_details`(`id`,`course_id`,`file`,`created_at`,`updated_at`,`file_type`,`course_chapter_id`,`status`) values (8,8,'file-1663813933.mp4','2022-09-22 02:32:13','2022-09-26 07:49:05','video',4,'enabled'),(9,8,'file-1663813994.png','2022-09-22 02:33:14','2022-09-22 03:16:17','image',4,'enabled'),(10,8,'file-1663814020.docx','2022-09-22 02:33:40','2022-09-26 07:49:00','application',4,'enabled'),(11,8,'file-1663814129.jpeg','2022-09-22 10:35:29','2022-09-22 03:18:31','image',4,'enabled'),(12,8,'file-1663814337.png','2022-09-22 10:38:57','2022-09-22 03:18:47','image',4,'enabled'),(13,8,'file-1663814337.png','2022-09-22 10:38:57','2022-09-26 07:49:03','image',4,'enabled');

/*Table structure for table `course_quizzes` */

DROP TABLE IF EXISTS `course_quizzes`;

CREATE TABLE `course_quizzes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quiz_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_questions` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `course_quizzes` */

insert  into `course_quizzes`(`id`,`course_id`,`course_chapter_id`,`created_at`,`updated_at`,`quiz_title`,`number_of_questions`,`status`) values (18,8,4,'2022-09-26 10:55:46','2022-09-26 02:57:18','Quiz 1',4,'enabled');

/*Table structure for table `course_types` */

DROP TABLE IF EXISTS `course_types`;

CREATE TABLE `course_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `course_types` */

insert  into `course_types`(`id`,`course_type`,`created_at`,`updated_at`) values (1,'Information Technology','2022-09-05 09:56:25','2022-09-18 12:31:43'),(2,'Algebra','2022-09-05 09:56:42','2022-09-05 09:56:42'),(3,'History','2022-09-05 09:56:49','2022-09-05 09:56:49'),(4,'Trigonometry','2022-09-05 09:56:56','2022-09-05 09:56:56');

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_type_id` bigint(20) NOT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_monitization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_amount` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `courses` */

insert  into `courses`(`id`,`course_type_id`,`course_title`,`course_description`,`course_monitization`,`course_amount`,`created_at`,`updated_at`,`user_id`,`status`,`image_template`) values (1,2,'asd','asd','Free',NULL,'2022-09-15 14:51:28','2022-09-23 08:06:32',15,'Pending Approval','course_image_template-1663253488.jpg'),(2,1,'Marian','asdasd','Free',NULL,'2022-09-18 12:40:06','2022-09-18 12:40:06',13,'Pending Approval','course_image_template-1663504806.png'),(3,1,'asdasd','asdasd','Monitize',1000.00,'2022-09-20 10:59:16','2022-09-20 10:59:16',13,'Pending Approval','course_image_template-1663671556.jpeg'),(4,1,'sample','sample','Free',NULL,'2022-09-21 10:03:38','2022-09-21 10:03:38',13,'Pending Approval','course_image_template-1663754618.jpeg'),(5,1,'sample','sample','Free',NULL,'2022-09-21 10:55:49','2022-09-21 10:55:49',13,'Pending Approval','course_image_template-1663757749.png'),(6,1,'asdasd','asdasd','Free',NULL,'2022-09-21 11:40:40','2022-09-23 09:59:30',13,'Approved','course_image_template-1663760440.png'),(7,1,'Information Technology','Long Text','Free',NULL,'2022-09-21 11:49:30','2022-09-23 08:09:29',13,'Approved','course_image_template-1663760970.jpeg'),(8,1,'Sample Title','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Free',NULL,'2022-09-21 12:27:58','2022-09-23 08:09:25',13,'Approved','course_image_template-1663763278.jpeg');

/*Table structure for table `direct_messages` */

DROP TABLE IF EXISTS `direct_messages`;

CREATE TABLE `direct_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_id` bigint(20) DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_typer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `direct_messages` */

insert  into `direct_messages`(`id`,`user_id`,`comment`,`status`,`created_at`,`updated_at`,`file`,`instructor_id`,`file_type`,`user_typer`) values (1,14,'asdasdasd','replied','2022-09-15 14:42:43','2022-09-15 14:52:31',NULL,15,NULL,'Student'),(2,14,'yese yes yes','replied','2022-09-15 14:52:32','2022-09-15 14:52:32','download.jpg',15,'image/jpeg','Instructor'),(3,12,'asdasdasd','replied','2022-09-18 12:40:56','2022-09-18 12:41:25',NULL,13,NULL,'Student'),(4,12,'Sample',NULL,'2022-09-18 12:41:25','2022-09-18 12:41:25',NULL,13,NULL,'Instructor'),(5,14,'asdasdasd','replied','2022-09-18 12:42:56','2022-09-18 12:51:37',NULL,13,NULL,'Student'),(6,14,'asdasdasd',NULL,'2022-09-18 12:43:09','2022-09-18 12:43:09',NULL,15,NULL,'Student'),(7,14,'sampleeeee',NULL,'2022-09-18 12:51:37','2022-09-18 12:51:37',NULL,13,NULL,'Instructor');

/*Table structure for table `enrolled_courses` */

DROP TABLE IF EXISTS `enrolled_courses`;

CREATE TABLE `enrolled_courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `enrolled_courses` */

insert  into `enrolled_courses`(`id`,`student_id`,`instructor_id`,`course_id`,`course_type`,`amount`,`created_at`,`updated_at`) values (1,14,15,1,'Free',0.00,'2022-09-15 14:51:50','2022-09-15 14:51:50'),(2,12,13,2,'Free',0.00,'2022-09-18 12:40:34','2022-09-18 12:40:34'),(3,14,13,2,'Free',0.00,'2022-09-18 12:41:53','2022-09-18 12:41:53'),(4,12,13,3,'Free',0.00,'2022-09-20 11:04:38','2022-09-20 11:04:38'),(5,12,13,3,'Subscribed',1000.00,'2022-09-20 11:04:38','2022-09-20 11:04:38'),(6,12,13,3,'Free',0.00,'2022-09-20 11:05:06','2022-09-20 11:05:06'),(7,12,13,3,'Subscribed',1000.00,'2022-09-20 11:05:06','2022-09-20 11:05:06'),(8,12,13,8,'Free',0.00,'2022-09-23 08:10:16','2022-09-23 08:10:16');

/*Table structure for table `exam_details` */

DROP TABLE IF EXISTS `exam_details`;

CREATE TABLE `exam_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `exam_question_id` bigint(20) NOT NULL,
  `choice_a` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_b` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_c` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_d` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exam_details` */

insert  into `exam_details`(`id`,`exam_question_id`,`choice_a`,`choice_b`,`choice_c`,`choice_d`,`created_at`,`updated_at`,`question`,`answer`,`file`,`file_type`) values (6,41,'A','B','C','D','2022-09-26 05:50:32','2022-09-26 05:50:32','','',NULL,NULL);

/*Table structure for table `exam_matchings` */

DROP TABLE IF EXISTS `exam_matchings`;

CREATE TABLE `exam_matchings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `exam_question_id` bigint(20) DEFAULT NULL,
  `choices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exam_matchings` */

insert  into `exam_matchings`(`id`,`exam_question_id`,`choices`,`created_at`,`updated_at`) values (16,43,'asda','2022-09-26 05:51:18','2022-09-26 05:51:18'),(17,43,'sdasd','2022-09-26 05:51:18','2022-09-26 05:51:18'),(18,43,'asdasd','2022-09-26 05:51:18','2022-09-26 05:51:18'),(19,43,'qweqwe','2022-09-26 05:51:18','2022-09-26 05:51:18'),(20,43,'asdasd','2022-09-26 05:51:18','2022-09-26 05:51:18');

/*Table structure for table `exam_questions` */

DROP TABLE IF EXISTS `exam_questions`;

CREATE TABLE `exam_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `course_exam_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `exam_question_id` bigint(20) DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exam_questions` */

insert  into `exam_questions`(`id`,`course_id`,`course_exam_id`,`question`,`answer`,`created_at`,`updated_at`,`exam_question_id`,`course_chapter_id`,`question_type`,`score`) values (40,8,12,'Question Exam Enumeration','one|two','2022-09-26 05:50:09','2022-09-26 05:50:09',NULL,4,'Enumeration','30'),(41,8,12,'Question Multiple Choice','choice_a','2022-09-26 05:50:32','2022-09-26 05:50:32',NULL,4,'Multitple Choice','50'),(42,8,12,'Question Identification','identify','2022-09-26 05:50:59','2022-09-26 05:50:59',NULL,4,'Identification','30'),(43,8,12,'Patag|Patag','apoval|apovel','2022-09-26 05:51:18','2022-09-26 05:51:18',NULL,4,'Matching Type','30');

/*Table structure for table `exams` */

DROP TABLE IF EXISTS `exams`;

CREATE TABLE `exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `number_of_exams` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exams` */

insert  into `exams`(`id`,`course_id`,`created_at`,`updated_at`,`number_of_exams`,`title`,`certificate`,`course_chapter_id`,`status`) values (12,8,'2022-09-26 13:49:53','2022-09-26 05:51:37',NULL,'Exam 1',NULL,4,'enabled');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `instructor_planners` */

DROP TABLE IF EXISTS `instructor_planners`;

CREATE TABLE `instructor_planners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `todo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `instructor_planners` */

insert  into `instructor_planners`(`id`,`date`,`time`,`instructor_id`,`todo`,`created_at`,`updated_at`,`status`) values (1,'2022-09-18','20:37',13,'asdasdasd','2022-09-18 12:37:55','2022-09-18 12:38:09','approved'),(2,'2022-09-20','09:11',12,'asdasd','2022-09-20 01:11:14','2022-09-20 01:11:23','approved'),(3,'2022-09-20','18:01',13,'asdasdasd','2022-09-20 11:00:03','2022-09-20 11:00:11','approved'),(4,'2022-09-28','19:03',12,'asdasdasd','2022-09-20 11:01:37','2022-09-20 11:01:37',NULL);

/*Table structure for table `invite_students` */

DROP TABLE IF EXISTS `invite_students`;

CREATE TABLE `invite_students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `invite_students` */

insert  into `invite_students`(`id`,`course_id`,`student_id`,`instructor_id`,`status`,`created_at`,`updated_at`) values (1,2,20,13,'Pending Approval','2022-09-20 10:58:05','2022-09-20 10:58:05'),(2,3,20,13,'Pending Approval','2022-09-20 10:59:43','2022-09-20 10:59:43'),(3,3,14,13,'Pending Approval','2022-09-20 10:59:46','2022-09-20 10:59:46'),(4,3,12,13,'Accepted','2022-09-20 10:59:49','2022-09-20 11:05:06');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2022_09_02_091007_create_tutorials_table',2),(5,'2022_09_05_011018_create_course_types_table',2),(6,'2022_09_05_012345_add_column_to_users',2),(7,'2022_09_05_050326_add_user_image',2),(8,'2022_09_05_061453_create_courses_table',2),(9,'2022_09_05_064420_create_course_details_table',2),(10,'2022_09_05_064645_add_column_to_course_details',2),(11,'2022_09_05_065455_add_user_id_to_courses',2),(12,'2022_09_05_234608_add_course_image_template',3),(13,'2022_09_09_120217_create_comments_table',4),(14,'2022_09_10_011151_add_status_to_comments',5),(15,'2022_09_10_113433_create_direct_messages_table',6),(16,'2022_09_10_114031_add_file_to_direct_message',7),(17,'2022_09_10_115044_add_instructor_id',8),(18,'2022_09_10_121714_add_file_type_to_message',9),(19,'2022_09_10_143141_add_user_type_to_message',10),(20,'2022_09_10_223935_create_exams_table',11),(21,'2022_09_10_224040_create_exam_details_table',12),(22,'2022_09_10_232322_add_number_of_items',13),(23,'2022_09_10_234547_add_files_to_exam',14),(24,'2022_09_10_235635_add_many_to_exam_details',15),(25,'2022_09_11_005834_add_exam_title',16),(26,'2022_09_12_093934_create_payments_table',17),(27,'2022_09_12_111135_create_enrolled_courses_table',18),(28,'2022_09_13_000008_create_student_exams_table',19),(29,'2022_09_13_001142_create_student_exam_details_table',19),(30,'2022_09_13_001805_add_status_to_student_exam_details',19),(31,'2022_09_13_002536_add_columns_to_student_exam_details',19),(32,'2022_09_13_005106_add_remarks',19),(33,'2022_09_13_011749_add_student_percentage',19),(34,'2022_09_13_011935_add_status',19),(35,'2022_09_13_013210_add_exam_certificate',19),(36,'2022_09_14_001942_create_invite_students_table',19),(37,'2022_09_14_133536_add_column_title',20),(38,'2022_09_15_003128_create_instructor_planners_table',21),(39,'2022_09_15_005651_add_status_to_todo',21),(40,'2022_09_21_001358_create_course_chapters_table',22),(41,'2022_09_21_001750_add_content_to_course_chapter',22),(42,'2022_09_21_002736_add_chapter_id_to_course_details',22),(43,'2022_09_21_014042_add_chapter_number_to_course_chapter',22),(44,'2022_09_21_014746_create_course_quizzes_table',22),(45,'2022_09_21_022011_add_columns',22),(46,'2022_09_21_100733_create_quiz_questions_table',23),(47,'2022_09_21_101413_add_type_to_quiz',24),(48,'2022_09_21_102503_add_course_chapter_id',25),(49,'2022_09_21_104423_create_quiz_details_table',26),(50,'2022_09_21_113023_create_quiz_matchings_table',27),(51,'2022_09_21_121639_add_thumbnail',28),(52,'2022_09_22_023632_add_status_to_course_details',29),(53,'2022_09_22_033610_add_status_to_quiz',30),(54,'2022_09_22_062619_add_course_chapter_id',31),(55,'2022_09_22_063010_create_exam_questions_table',32),(56,'2022_09_22_063140_add_exam_question_id',33),(57,'2022_09_22_063240_create_exam_matchings_table',34),(58,'2022_09_22_065739_add_course_chapter_id',35),(59,'2022_09_22_073734_exam_status',36),(60,'2022_09_22_102503_add_score_to_quiz_questions',37),(61,'2022_09_22_112803_add_score_to_exam',38),(62,'2022_09_22_112902_add_score_to_exam',39),(63,'2022_09_22_113944_create_assignments_table',40),(64,'2022_09_22_115349_create_assignment_questions_table',41),(65,'2022_09_22_120037_add_deadline_to_assignment',42),(66,'2022_09_22_120453_create_assignment_details_table',43),(67,'2022_09_22_120859_create_assignment_details_table',44),(68,'2022_09_22_121045_create_assignment_matchings_table',45),(69,'2022_09_23_100221_add_course_chapter_id',46),(70,'2022_09_23_122258_create_student_logs_table',47),(71,'2022_09_23_130520_add_course_details_id',48),(72,'2022_09_23_134636_add_student_id_to_student_logs',49),(73,'2022_09_24_002028_add_column_date_to_student_logs',50),(74,'2022_09_24_134419_create_assignment_takens_table',51),(75,'2022_09_24_134851_create_assignment_taken_details_table',52),(76,'2022_09_25_063038_create_takens_table',53),(77,'2022_09_25_063229_create_taken_details_table',54),(78,'2022_09_25_081255_add_date_to_taken',55),(79,'2022_09_25_083534_add_score_to_taken_details',56),(80,'2022_09_25_084117_add_status_to_taken_details',57),(81,'2022_09_25_084856_add_type_to_taken_details',58),(82,'2022_09_26_011106_add_student_id',59),(83,'2022_09_26_012205_add_question_type',60),(84,'2022_09_26_074111_add_content_to_student_logs',61);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payments` */

insert  into `payments`(`id`,`course_id`,`student_id`,`instructor_id`,`amount`,`created_at`,`updated_at`) values (1,3,12,13,1000.00,'2022-09-20 11:04:38','2022-09-20 11:04:38'),(2,3,12,13,1000.00,'2022-09-20 11:05:06','2022-09-20 11:05:06');

/*Table structure for table `quiz_details` */

DROP TABLE IF EXISTS `quiz_details`;

CREATE TABLE `quiz_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_question_id` bigint(20) NOT NULL,
  `choice_a` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_b` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_c` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_d` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quiz_details` */

insert  into `quiz_details`(`id`,`quiz_question_id`,`choice_a`,`choice_b`,`choice_c`,`choice_d`,`created_at`,`updated_at`) values (5,30,'A','B','C','D','2022-09-26 02:56:37','2022-09-26 02:56:37');

/*Table structure for table `quiz_matchings` */

DROP TABLE IF EXISTS `quiz_matchings`;

CREATE TABLE `quiz_matchings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_question_id` bigint(20) DEFAULT NULL,
  `choices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quiz_matchings` */

insert  into `quiz_matchings`(`id`,`quiz_question_id`,`choices`,`created_at`,`updated_at`) values (17,32,'qweqw','2022-09-26 02:57:05','2022-09-26 02:57:05'),(18,32,'eqwe','2022-09-26 02:57:05','2022-09-26 02:57:05'),(19,32,'qweqwe','2022-09-26 02:57:05','2022-09-26 02:57:05'),(20,32,'qweqwe','2022-09-26 02:57:05','2022-09-26 02:57:05'),(21,32,'qweqwe','2022-09-26 02:57:05','2022-09-26 02:57:05');

/*Table structure for table `quiz_questions` */

DROP TABLE IF EXISTS `quiz_questions`;

CREATE TABLE `quiz_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `course_quiz_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quiz_questions` */

insert  into `quiz_questions`(`id`,`course_id`,`course_quiz_id`,`question`,`answer`,`created_at`,`updated_at`,`question_type`,`course_chapter_id`,`score`) values (29,8,18,'Question Enumeration','enumerate1|enumerate2','2022-09-26 02:56:22','2022-09-26 02:56:22','Enumeration',4,'20'),(30,8,18,'Question multiple choice','choice_c','2022-09-26 02:56:37','2022-09-26 02:56:37','Multitple Choice',4,'20'),(31,8,18,'identify','identify','2022-09-26 02:56:45','2022-09-26 02:56:45','Identification',4,'50'),(32,8,18,'Carmen|Patag','zone1|zone 9','2022-09-26 02:57:05','2022-09-26 02:57:05','Matching Type',4,'50');

/*Table structure for table `student_exam_details` */

DROP TABLE IF EXISTS `student_exam_details`;

CREATE TABLE `student_exam_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_exam_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_answer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_a` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_b` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_c` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_d` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `student_exam_details` */

/*Table structure for table `student_exams` */

DROP TABLE IF EXISTS `student_exams`;

CREATE TABLE `student_exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_exam_percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `student_exams` */

/*Table structure for table `student_logs` */

DROP TABLE IF EXISTS `student_logs`;

CREATE TABLE `student_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `monday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `assignment_id` bigint(20) DEFAULT NULL,
  `quiz_id` bigint(20) DEFAULT NULL,
  `exam_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `course_details_id` bigint(20) DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `student_logs` */

insert  into `student_logs`(`id`,`monday`,`tuesday`,`wednesday`,`thursday`,`friday`,`saturday`,`sunday`,`course_id`,`course_chapter_id`,`assignment_id`,`quiz_id`,`exam_id`,`created_at`,`updated_at`,`course_details_id`,`student_id`,`date`,`content`) values (14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,4,NULL,NULL,NULL,'2022-09-26 15:47:51','2022-09-26 15:52:38',9,12,'2022-09-26','<br />Turned in quiz with a score of 140 over 140 and a percentage of 100. remarks pass'),(15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,4,NULL,NULL,NULL,'2022-09-26 15:47:57','2022-09-26 15:47:57',11,12,'2022-09-26','view image file file-1663814129.jpeg'),(16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,4,NULL,NULL,NULL,'2022-09-26 15:50:31','2022-09-26 15:50:31',8,12,'2022-09-26','view video file file-1663813933.mp4'),(17,'view document file file-1663814020.docx',NULL,NULL,NULL,NULL,NULL,NULL,8,4,NULL,NULL,NULL,'2022-09-26 15:50:38','2022-09-26 15:50:38',10,12,'2022-09-26','sdasdview video file file-1663813933.mp4'),(18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,4,15,NULL,NULL,'2022-09-26 15:51:17','2022-09-26 15:51:17',NULL,12,'2022-09-26','Turned in assignment with a score of 90 over 110 and a percentage of 81.82. remarks pass');

/*Table structure for table `taken_details` */

DROP TABLE IF EXISTS `taken_details`;

CREATE TABLE `taken_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `taken_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `question_answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_answer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `taken_details` */

insert  into `taken_details`(`id`,`taken_id`,`question_id`,`question_answer`,`student_answer`,`remarks`,`created_at`,`updated_at`,`score`,`status`,`type`,`student_id`,`question_type`) values (44,44,24,'enumerate1|enumerate2','enumerate1,enumerate2','checked','2022-09-26 15:50:52','2022-09-26 15:50:52','30','answered','assignment',12,'Enumeration'),(45,44,25,'choice_b','choice_b','checked','2022-09-26 15:50:57','2022-09-26 15:50:57','10','answered','assignment',12,'Multitple Choice'),(46,44,26,'identify','identify','checked','2022-09-26 15:51:01','2022-09-26 15:51:01','20','answered','assignment',12,'Identification'),(47,44,27,'cagayan de oro city|carmen',NULL,'checked','2022-09-26 15:51:10','2022-09-26 15:51:10','30','answered','assignment',12,'Matching Type'),(48,44,28,'enumarete2','enumerate2','wrong','2022-09-26 15:51:15','2022-09-26 15:51:15','20','answered','assignment',12,'Enumeration'),(49,45,29,'enumerate1|enumerate2','enumerate1,enumerate2','checked','2022-09-26 15:52:19','2022-09-26 15:52:19','20','answered','quiz',12,'Enumeration'),(50,45,30,'choice_c','choice_c','checked','2022-09-26 15:52:23','2022-09-26 15:52:23','20','answered','quiz',12,'Multitple Choice'),(51,45,31,'identify','identify','checked','2022-09-26 15:52:28','2022-09-26 15:52:28','50','answered','quiz',12,'Identification'),(52,45,32,'zone1|zone 9','zone1,zone 9','checked','2022-09-26 15:52:36','2022-09-26 15:52:36','50','answered','quiz',12,'Matching Type');

/*Table structure for table `takens` */

DROP TABLE IF EXISTS `takens`;

CREATE TABLE `takens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) DEFAULT NULL,
  `quiz_id` bigint(20) DEFAULT NULL,
  `assignment_id` bigint(20) DEFAULT NULL,
  `instructor_id` bigint(20) DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `takens` */

insert  into `takens`(`id`,`exam_id`,`quiz_id`,`assignment_id`,`instructor_id`,`student_id`,`course_chapter_id`,`course_id`,`score`,`total_points`,`type`,`remarks`,`created_at`,`updated_at`,`date`) values (44,NULL,NULL,15,13,12,4,8,90,110,'assignment','pass','2022-09-26 15:50:46','2022-09-26 15:51:17','2022-09-26'),(45,NULL,18,NULL,13,12,4,8,140,140,'quiz','pass','2022-09-26 15:52:15','2022-09-26 15:52:38','2022-09-26');

/*Table structure for table `tutorials` */

DROP TABLE IF EXISTS `tutorials`;

CREATE TABLE `tutorials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tutorial_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tutorial_note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tutorials` */

insert  into `tutorials`(`id`,`tutorial_image`,`tutorial_note`,`created_at`,`updated_at`,`title`) values (5,'tutorial_image-1663505691.png','Where','2022-09-18 12:54:51','2022-09-18 12:54:51','asdasdW'),(6,'tutorial_image-1663505705.png','Where','2022-09-18 12:55:05','2022-09-18 12:55:05','Where');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`last_name`,`email`,`user_type`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`status`,`user_image`) values (5,'eSocial','Admin','admin@gmail.com','Admin',NULL,'$2y$10$ajscrOU/3aY3Z8QYfoB/xe5mpV.YL3wVcGyT/1w9Pe7yA48hwmjq2',NULL,'2022-09-05 09:53:40','2022-09-20 01:17:08','Approved','user_image-1663636628.jpeg'),(12,'sidney','z','sidney@gmail.com','Student',NULL,'$2y$10$0D2AlN8ja27h3maR8Xr3ku.LyipQ2kBTV/8eU/uSWA1LOUWRl1Pni',NULL,'2022-09-15 13:04:39','2022-09-20 11:04:07',NULL,'user_image-1663671847.jpeg'),(13,'sidney','sidney','salazar@gmail.com','Instructor',NULL,'$2y$10$C9TXWlfRSriAzI11bvJLMO1.WdHd73WaWxfD2xb1lzdT0EqoUK4sa',NULL,'2022-09-15 13:06:16','2022-09-20 01:17:47','Approved','user_image-1663636667.jpeg'),(14,'sasdasd','b','sad@gmail.com','Student',NULL,'$2y$10$oHhPr1gviD.90Nd48cfa2.7p4HCrb3kCbG.7BdtDq6hyU0VGoPJfO',NULL,'2022-09-15 14:18:39','2022-09-15 14:18:39',NULL,NULL),(15,'sada','asd','sad2@gmail.com','Instructor',NULL,'$2y$10$IbaEFH61mPvjI3fY2eg9L.SIP4PgzMlbi1iYSVEwewQbK4h4gL.ee',NULL,'2022-09-15 14:37:30','2022-09-15 14:37:47','Approved',NULL),(16,'sample','sample','sample@gmail.com','Instructor',NULL,'$2y$10$BC6dhbAzZagACmWy5TdfxO.96u82VKnIhUrRv5yIDtX2P3M6ysrNS',NULL,'2022-09-20 10:49:55','2022-09-20 10:49:55',NULL,NULL),(17,'sdasd','sadasd','sadsdasd@gmail.com','Instructor',NULL,'$2y$10$RI68XPQ.4LBEiT.XGFj7uOFQeeCgSJZMoWp789p4BjB99qhoJJYg.',NULL,'2022-09-20 10:52:39','2022-09-20 10:52:39',NULL,NULL),(18,'weqwe','qweqwe','qweqwe@gmail.com','Instructor',NULL,'$2y$10$MM1xNatwAF9mZz2a880biui3KaN5Nx79Wmgnn7wI0JoCOHHHdRM9S',NULL,'2022-09-20 10:53:46','2022-09-20 10:53:46',NULL,NULL),(19,'sdasd','eqweq','qweqwerterte@gmail.com','Instructor',NULL,'$2y$10$LZm6JgJovE6YRwiIM9C1TOVE/Rbm7S5ohCCjNxcYy0R4LsnJZoFcC',NULL,'2022-09-20 10:55:00','2022-09-20 10:55:00',NULL,NULL),(20,'sample','a','sample123@gmail.com','Student',NULL,'$2y$10$3REFu7NsdDOjUj3WRu7FWeDqEgoKpZUlvf9lISt3oG8aFlVcz348W',NULL,'2022-09-20 10:57:11','2022-09-20 10:57:11',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
