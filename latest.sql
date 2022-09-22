-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2022 at 04:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_social_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `number_of_questions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deadline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_details`
--

CREATE TABLE `assignment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_question_id` bigint(20) DEFAULT NULL,
  `choice_a` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_b` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_c` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_d` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_matchings`
--

CREATE TABLE `assignment_matchings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_question_id` bigint(20) NOT NULL,
  `choices` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_questions`
--

CREATE TABLE `assignment_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_assignment_id` bigint(20) NOT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `course_id` bigint(20) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_type_id` bigint(20) NOT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_monitization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_amount` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_type_id`, `course_title`, `course_description`, `course_monitization`, `course_amount`, `created_at`, `updated_at`, `user_id`, `status`, `image_template`) VALUES
(1, 2, 'asd', 'asd', 'Free', NULL, '2022-09-15 06:51:28', '2022-09-15 06:51:28', 15, 'Pending Approval', 'course_image_template-1663253488.jpg'),
(2, 1, 'Marian', 'asdasd', 'Free', NULL, '2022-09-18 04:40:06', '2022-09-18 04:40:06', 13, 'Pending Approval', 'course_image_template-1663504806.png'),
(3, 1, 'asdasd', 'asdasd', 'Monitize', 1000.00, '2022-09-20 02:59:16', '2022-09-20 02:59:16', 13, 'Pending Approval', 'course_image_template-1663671556.jpeg'),
(4, 1, 'sample', 'sample', 'Free', NULL, '2022-09-21 02:03:38', '2022-09-21 02:03:38', 13, 'Pending Approval', 'course_image_template-1663754618.jpeg'),
(5, 1, 'sample', 'sample', 'Free', NULL, '2022-09-21 02:55:49', '2022-09-21 02:55:49', 13, 'Pending Approval', 'course_image_template-1663757749.png'),
(6, 1, 'asdasd', 'asdasd', 'Free', NULL, '2022-09-21 03:40:40', '2022-09-21 03:40:40', 13, 'Pending Approval', 'course_image_template-1663760440.png'),
(7, 1, 'Information Technology', 'Long Text', 'Free', NULL, '2022-09-21 03:49:30', '2022-09-21 03:49:30', 13, 'Pending Approval', 'course_image_template-1663760970.jpeg'),
(8, 1, 'Sample Title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Free', NULL, '2022-09-21 04:27:58', '2022-09-21 04:27:58', 13, 'Pending Approval', 'course_image_template-1663763278.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `course_chapters`
--

CREATE TABLE `course_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_chapters`
--

INSERT INTO `course_chapters` (`id`, `course_id`, `title`, `created_at`, `updated_at`, `content`, `chapter_number`, `thumbnail`) VALUES
(4, 8, 'Title', '2022-09-21 04:28:27', '2022-09-22 02:49:00', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '1', 'received_790004915490478.jpeg'),
(5, 8, 'ASDASD', '2022-09-21 05:31:21', '2022-09-21 05:31:21', 'QWEQWE', 'ASDAS', '307075117_5768675756490072_2746946818833767974_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`id`, `course_id`, `file`, `created_at`, `updated_at`, `file_type`, `course_chapter_id`, `status`) VALUES
(8, 8, 'file-1663813933.mp4', '2022-09-21 18:32:13', '2022-09-21 19:19:24', 'video', 4, 'disabled'),
(9, 8, 'file-1663813994.png', '2022-09-21 18:33:14', '2022-09-21 19:16:17', 'image', 4, 'enabled'),
(10, 8, 'file-1663814020.docx', '2022-09-21 18:33:40', '2022-09-21 18:33:40', 'application', 4, 'disabled'),
(11, 8, 'file-1663814129.jpeg', '2022-09-22 02:35:29', '2022-09-21 19:18:31', 'image', 4, 'enabled'),
(12, 8, 'file-1663814337.png', '2022-09-22 02:38:57', '2022-09-21 19:18:47', 'image', 4, 'enabled'),
(13, 8, 'file-1663814337.png', '2022-09-22 02:38:57', '2022-09-22 02:38:57', 'image', 4, 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `course_quizzes`
--

CREATE TABLE `course_quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quiz_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_questions` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_types`
--

CREATE TABLE `course_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_types`
--

INSERT INTO `course_types` (`id`, `course_type`, `created_at`, `updated_at`) VALUES
(1, 'Information Technology', '2022-09-05 01:56:25', '2022-09-18 04:31:43'),
(2, 'Algebra', '2022-09-05 01:56:42', '2022-09-05 01:56:42'),
(3, 'History', '2022-09-05 01:56:49', '2022-09-05 01:56:49'),
(4, 'Trigonometry', '2022-09-05 01:56:56', '2022-09-05 01:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `direct_messages`
--

CREATE TABLE `direct_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_id` bigint(20) DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_typer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direct_messages`
--

INSERT INTO `direct_messages` (`id`, `user_id`, `comment`, `status`, `created_at`, `updated_at`, `file`, `instructor_id`, `file_type`, `user_typer`) VALUES
(1, 14, 'asdasdasd', 'replied', '2022-09-15 06:42:43', '2022-09-15 06:52:31', NULL, 15, NULL, 'Student'),
(2, 14, 'yese yes yes', 'replied', '2022-09-15 06:52:32', '2022-09-15 06:52:32', 'download.jpg', 15, 'image/jpeg', 'Instructor'),
(3, 12, 'asdasdasd', 'replied', '2022-09-18 04:40:56', '2022-09-18 04:41:25', NULL, 13, NULL, 'Student'),
(4, 12, 'Sample', NULL, '2022-09-18 04:41:25', '2022-09-18 04:41:25', NULL, 13, NULL, 'Instructor'),
(5, 14, 'asdasdasd', 'replied', '2022-09-18 04:42:56', '2022-09-18 04:51:37', NULL, 13, NULL, 'Student'),
(6, 14, 'asdasdasd', NULL, '2022-09-18 04:43:09', '2022-09-18 04:43:09', NULL, 15, NULL, 'Student'),
(7, 14, 'sampleeeee', NULL, '2022-09-18 04:51:37', '2022-09-18 04:51:37', NULL, 13, NULL, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_courses`
--

CREATE TABLE `enrolled_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolled_courses`
--

INSERT INTO `enrolled_courses` (`id`, `student_id`, `instructor_id`, `course_id`, `course_type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 14, 15, 1, 'Free', 0.00, '2022-09-15 06:51:50', '2022-09-15 06:51:50'),
(2, 12, 13, 2, 'Free', 0.00, '2022-09-18 04:40:34', '2022-09-18 04:40:34'),
(3, 14, 13, 2, 'Free', 0.00, '2022-09-18 04:41:53', '2022-09-18 04:41:53'),
(4, 12, 13, 3, 'Free', 0.00, '2022-09-20 03:04:38', '2022-09-20 03:04:38'),
(5, 12, 13, 3, 'Subscribed', 1000.00, '2022-09-20 03:04:38', '2022-09-20 03:04:38'),
(6, 12, 13, 3, 'Free', 0.00, '2022-09-20 03:05:06', '2022-09-20 03:05:06'),
(7, 12, 13, 3, 'Subscribed', 1000.00, '2022-09-20 03:05:06', '2022-09-20 03:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `number_of_exams` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `course_id`, `created_at`, `updated_at`, `number_of_exams`, `title`, `certificate`, `course_chapter_id`, `status`) VALUES
(11, 8, '2022-09-22 14:16:50', '2022-09-22 14:16:50', 0, 'Exam 1', '', 4, 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `exam_details`
--

CREATE TABLE `exam_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_details`
--

INSERT INTO `exam_details` (`id`, `exam_question_id`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `created_at`, `updated_at`, `question`, `answer`, `file`, `file_type`) VALUES
(5, 36, 'A', 'B', 'C', 'D', '2022-09-22 06:18:29', '2022-09-22 06:18:29', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_matchings`
--

CREATE TABLE `exam_matchings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_question_id` bigint(20) DEFAULT NULL,
  `choices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_matchings`
--

INSERT INTO `exam_matchings` (`id`, `exam_question_id`, `choices`, `created_at`, `updated_at`) VALUES
(11, 38, 'SSSSSS', '2022-09-22 06:19:30', '2022-09-22 06:19:30'),
(12, 38, 'SSSSSSWWW', '2022-09-22 06:19:30', '2022-09-22 06:19:30'),
(13, 38, 'WWWWWWW', '2022-09-22 06:19:30', '2022-09-22 06:19:30'),
(14, 38, 'WWWWW', '2022-09-22 06:19:30', '2022-09-22 06:19:30'),
(15, 38, 'EEEEEEEe', '2022-09-22 06:19:30', '2022-09-22 06:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_exam_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `exam_question_id` bigint(20) DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `course_id`, `course_exam_id`, `question`, `answer`, `created_at`, `updated_at`, `exam_question_id`, `course_chapter_id`, `question_type`, `score`) VALUES
(35, 8, 11, 'Enumarate the number from 1 to 3', 'one|two', '2022-09-22 06:18:01', '2022-09-22 06:18:01', NULL, 4, 'Enumeration', '30'),
(36, 8, 11, 'Mutliple Choice', 'choice_a', '2022-09-22 06:18:29', '2022-09-22 06:18:29', NULL, 4, 'Multitple Choice', '30'),
(37, 8, 11, 'IDENTIFY', 'identifiable', '2022-09-22 06:18:53', '2022-09-22 06:18:53', NULL, 4, 'Identification', '30'),
(38, 8, 11, 'PLACE|PLACE', 'patag|bulua', '2022-09-22 06:19:30', '2022-09-22 06:19:30', NULL, 4, 'Matching Type', '20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_planners`
--

CREATE TABLE `instructor_planners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `todo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructor_planners`
--

INSERT INTO `instructor_planners` (`id`, `date`, `time`, `instructor_id`, `todo`, `created_at`, `updated_at`, `status`) VALUES
(1, '2022-09-18', '20:37', 13, 'asdasdasd', '2022-09-18 04:37:55', '2022-09-18 04:38:09', 'approved'),
(2, '2022-09-20', '09:11', 12, 'asdasd', '2022-09-19 17:11:14', '2022-09-19 17:11:23', 'approved'),
(3, '2022-09-20', '18:01', 13, 'asdasdasd', '2022-09-20 03:00:03', '2022-09-20 03:00:11', 'approved'),
(4, '2022-09-28', '19:03', 12, 'asdasdasd', '2022-09-20 03:01:37', '2022-09-20 03:01:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invite_students`
--

CREATE TABLE `invite_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invite_students`
--

INSERT INTO `invite_students` (`id`, `course_id`, `student_id`, `instructor_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 20, 13, 'Pending Approval', '2022-09-20 02:58:05', '2022-09-20 02:58:05'),
(2, 3, 20, 13, 'Pending Approval', '2022-09-20 02:59:43', '2022-09-20 02:59:43'),
(3, 3, 14, 13, 'Pending Approval', '2022-09-20 02:59:46', '2022-09-20 02:59:46'),
(4, 3, 12, 13, 'Accepted', '2022-09-20 02:59:49', '2022-09-20 03:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_09_02_091007_create_tutorials_table', 2),
(5, '2022_09_05_011018_create_course_types_table', 2),
(6, '2022_09_05_012345_add_column_to_users', 2),
(7, '2022_09_05_050326_add_user_image', 2),
(8, '2022_09_05_061453_create_courses_table', 2),
(9, '2022_09_05_064420_create_course_details_table', 2),
(10, '2022_09_05_064645_add_column_to_course_details', 2),
(11, '2022_09_05_065455_add_user_id_to_courses', 2),
(12, '2022_09_05_234608_add_course_image_template', 3),
(13, '2022_09_09_120217_create_comments_table', 4),
(14, '2022_09_10_011151_add_status_to_comments', 5),
(15, '2022_09_10_113433_create_direct_messages_table', 6),
(16, '2022_09_10_114031_add_file_to_direct_message', 7),
(17, '2022_09_10_115044_add_instructor_id', 8),
(18, '2022_09_10_121714_add_file_type_to_message', 9),
(19, '2022_09_10_143141_add_user_type_to_message', 10),
(20, '2022_09_10_223935_create_exams_table', 11),
(21, '2022_09_10_224040_create_exam_details_table', 12),
(22, '2022_09_10_232322_add_number_of_items', 13),
(23, '2022_09_10_234547_add_files_to_exam', 14),
(24, '2022_09_10_235635_add_many_to_exam_details', 15),
(25, '2022_09_11_005834_add_exam_title', 16),
(26, '2022_09_12_093934_create_payments_table', 17),
(27, '2022_09_12_111135_create_enrolled_courses_table', 18),
(28, '2022_09_13_000008_create_student_exams_table', 19),
(29, '2022_09_13_001142_create_student_exam_details_table', 19),
(30, '2022_09_13_001805_add_status_to_student_exam_details', 19),
(31, '2022_09_13_002536_add_columns_to_student_exam_details', 19),
(32, '2022_09_13_005106_add_remarks', 19),
(33, '2022_09_13_011749_add_student_percentage', 19),
(34, '2022_09_13_011935_add_status', 19),
(35, '2022_09_13_013210_add_exam_certificate', 19),
(36, '2022_09_14_001942_create_invite_students_table', 19),
(37, '2022_09_14_133536_add_column_title', 20),
(38, '2022_09_15_003128_create_instructor_planners_table', 21),
(39, '2022_09_15_005651_add_status_to_todo', 21),
(40, '2022_09_21_001358_create_course_chapters_table', 22),
(41, '2022_09_21_001750_add_content_to_course_chapter', 22),
(42, '2022_09_21_002736_add_chapter_id_to_course_details', 22),
(43, '2022_09_21_014042_add_chapter_number_to_course_chapter', 22),
(44, '2022_09_21_014746_create_course_quizzes_table', 22),
(45, '2022_09_21_022011_add_columns', 22),
(46, '2022_09_21_100733_create_quiz_questions_table', 23),
(47, '2022_09_21_101413_add_type_to_quiz', 24),
(48, '2022_09_21_102503_add_course_chapter_id', 25),
(49, '2022_09_21_104423_create_quiz_details_table', 26),
(50, '2022_09_21_113023_create_quiz_matchings_table', 27),
(51, '2022_09_21_121639_add_thumbnail', 28),
(52, '2022_09_22_023632_add_status_to_course_details', 29),
(53, '2022_09_22_033610_add_status_to_quiz', 30),
(54, '2022_09_22_062619_add_course_chapter_id', 31),
(55, '2022_09_22_063010_create_exam_questions_table', 32),
(56, '2022_09_22_063140_add_exam_question_id', 33),
(57, '2022_09_22_063240_create_exam_matchings_table', 34),
(58, '2022_09_22_065739_add_course_chapter_id', 35),
(59, '2022_09_22_073734_exam_status', 36),
(60, '2022_09_22_102503_add_score_to_quiz_questions', 37),
(61, '2022_09_22_112803_add_score_to_exam', 38),
(62, '2022_09_22_112902_add_score_to_exam', 39),
(63, '2022_09_22_113944_create_assignments_table', 40),
(64, '2022_09_22_115349_create_assignment_questions_table', 41),
(65, '2022_09_22_120037_add_deadline_to_assignment', 42),
(66, '2022_09_22_120453_create_assignment_details_table', 43),
(67, '2022_09_22_120859_create_assignment_details_table', 44),
(68, '2022_09_22_121045_create_assignment_matchings_table', 45);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `course_id`, `student_id`, `instructor_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 3, 12, 13, 1000.00, '2022-09-20 03:04:38', '2022-09-20 03:04:38'),
(2, 3, 12, 13, 1000.00, '2022-09-20 03:05:06', '2022-09-20 03:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_details`
--

CREATE TABLE `quiz_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_question_id` bigint(20) NOT NULL,
  `choice_a` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_b` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_c` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choice_d` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_matchings`
--

CREATE TABLE `quiz_matchings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_question_id` bigint(20) DEFAULT NULL,
  `choices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_quiz_id` bigint(20) NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_exams`
--

CREATE TABLE `student_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_exam_percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_details`
--

CREATE TABLE `student_exam_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutorial_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tutorial_note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `tutorial_image`, `tutorial_note`, `created_at`, `updated_at`, `title`) VALUES
(5, 'tutorial_image-1663505691.png', 'Where', '2022-09-18 04:54:51', '2022-09-18 04:54:51', 'asdasdW'),
(6, 'tutorial_image-1663505705.png', 'Where', '2022-09-18 04:55:05', '2022-09-18 04:55:05', 'Where');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `user_type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `user_image`) VALUES
(5, 'eSocial', 'Admin', 'admin@gmail.com', 'Admin', NULL, '$2y$10$ajscrOU/3aY3Z8QYfoB/xe5mpV.YL3wVcGyT/1w9Pe7yA48hwmjq2', NULL, '2022-09-05 01:53:40', '2022-09-19 17:17:08', 'Approved', 'user_image-1663636628.jpeg'),
(12, 'sidney', 'z', 'sidney@gmail.com', 'Student', NULL, '$2y$10$0D2AlN8ja27h3maR8Xr3ku.LyipQ2kBTV/8eU/uSWA1LOUWRl1Pni', NULL, '2022-09-15 05:04:39', '2022-09-20 03:04:07', NULL, 'user_image-1663671847.jpeg'),
(13, 'sidney', 'sidney', 'salazar@gmail.com', 'Instructor', NULL, '$2y$10$C9TXWlfRSriAzI11bvJLMO1.WdHd73WaWxfD2xb1lzdT0EqoUK4sa', NULL, '2022-09-15 05:06:16', '2022-09-19 17:17:47', 'Approved', 'user_image-1663636667.jpeg'),
(14, 'sasdasd', 'b', 'sad@gmail.com', 'Student', NULL, '$2y$10$oHhPr1gviD.90Nd48cfa2.7p4HCrb3kCbG.7BdtDq6hyU0VGoPJfO', NULL, '2022-09-15 06:18:39', '2022-09-15 06:18:39', NULL, NULL),
(15, 'sada', 'asd', 'sad2@gmail.com', 'Instructor', NULL, '$2y$10$IbaEFH61mPvjI3fY2eg9L.SIP4PgzMlbi1iYSVEwewQbK4h4gL.ee', NULL, '2022-09-15 06:37:30', '2022-09-15 06:37:47', 'Approved', NULL),
(16, 'sample', 'sample', 'sample@gmail.com', 'Instructor', NULL, '$2y$10$BC6dhbAzZagACmWy5TdfxO.96u82VKnIhUrRv5yIDtX2P3M6ysrNS', NULL, '2022-09-20 02:49:55', '2022-09-20 02:49:55', NULL, NULL),
(17, 'sdasd', 'sadasd', 'sadsdasd@gmail.com', 'Instructor', NULL, '$2y$10$RI68XPQ.4LBEiT.XGFj7uOFQeeCgSJZMoWp789p4BjB99qhoJJYg.', NULL, '2022-09-20 02:52:39', '2022-09-20 02:52:39', NULL, NULL),
(18, 'weqwe', 'qweqwe', 'qweqwe@gmail.com', 'Instructor', NULL, '$2y$10$MM1xNatwAF9mZz2a880biui3KaN5Nx79Wmgnn7wI0JoCOHHHdRM9S', NULL, '2022-09-20 02:53:46', '2022-09-20 02:53:46', NULL, NULL),
(19, 'sdasd', 'eqweq', 'qweqwerterte@gmail.com', 'Instructor', NULL, '$2y$10$LZm6JgJovE6YRwiIM9C1TOVE/Rbm7S5ohCCjNxcYy0R4LsnJZoFcC', NULL, '2022-09-20 02:55:00', '2022-09-20 02:55:00', NULL, NULL),
(20, 'sample', 'a', 'sample123@gmail.com', 'Student', NULL, '$2y$10$3REFu7NsdDOjUj3WRu7FWeDqEgoKpZUlvf9lISt3oG8aFlVcz348W', NULL, '2022-09-20 02:57:11', '2022-09-20 02:57:11', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_details`
--
ALTER TABLE `assignment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_matchings`
--
ALTER TABLE `assignment_matchings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_questions`
--
ALTER TABLE `assignment_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_types`
--
ALTER TABLE `course_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `direct_messages`
--
ALTER TABLE `direct_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled_courses`
--
ALTER TABLE `enrolled_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_details`
--
ALTER TABLE `exam_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_matchings`
--
ALTER TABLE `exam_matchings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_planners`
--
ALTER TABLE `instructor_planners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite_students`
--
ALTER TABLE `invite_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_details`
--
ALTER TABLE `quiz_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_matchings`
--
ALTER TABLE `quiz_matchings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_exams`
--
ALTER TABLE `student_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_exam_details`
--
ALTER TABLE `student_exam_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assignment_details`
--
ALTER TABLE `assignment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assignment_matchings`
--
ALTER TABLE `assignment_matchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `assignment_questions`
--
ALTER TABLE `assignment_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_chapters`
--
ALTER TABLE `course_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_types`
--
ALTER TABLE `course_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `direct_messages`
--
ALTER TABLE `direct_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrolled_courses`
--
ALTER TABLE `enrolled_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam_details`
--
ALTER TABLE `exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_matchings`
--
ALTER TABLE `exam_matchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_planners`
--
ALTER TABLE `instructor_planners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invite_students`
--
ALTER TABLE `invite_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_details`
--
ALTER TABLE `quiz_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_matchings`
--
ALTER TABLE `quiz_matchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_exams`
--
ALTER TABLE `student_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_exam_details`
--
ALTER TABLE `student_exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
