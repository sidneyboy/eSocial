-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2022 at 05:54 PM
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
-- Database: `esocial`
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

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `course_id`, `number_of_questions`, `course_chapter_id`, `title`, `status`, `created_at`, `updated_at`, `deadline`) VALUES
(21, 12, '2', 11, 'course 1 chapter 1 assignment 1', 'enabled', '2022-09-29 14:24:31', '2022-09-29 06:35:14', '2022-09-30');

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

--
-- Dumping data for table `assignment_questions`
--

INSERT INTO `assignment_questions` (`id`, `course_id`, `course_assignment_id`, `course_chapter_id`, `question`, `answer`, `question_type`, `score`, `created_at`, `updated_at`) VALUES
(40, 12, 21, 11, 'qweqwe', 'qweqwe', 'Enumeration', '10', '2022-09-29 06:24:53', '2022-09-29 06:24:53'),
(41, 12, 21, 11, 'qweqwe', 'qweqwe|on|o|p|k|p|pp|pp|pp|pp|pp|pp|pp|pp|pp|pp|pp|p|pp|pp', 'Enumeration', '10', '2022-09-29 06:25:21', '2022-09-29 06:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_takens`
--

CREATE TABLE `assignment_takens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_id` bigint(20) NOT NULL,
  `instructor_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_chapter_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_taken_details`
--

CREATE TABLE `assignment_taken_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_taken_id` bigint(20) NOT NULL,
  `assignment_question_id` bigint(20) NOT NULL,
  `student_answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(11, 6, 'Course 1', 'Course 1', 'Monitize', 1500.00, '2022-09-29 06:00:23', '2022-09-29 06:34:00', 21, 'Approved', 'course_image_template-1664460023.png'),
(12, 6, 'Course 2', 'course 2', 'Monitize', 2500.00, '2022-09-29 06:01:37', '2022-09-29 06:33:57', 21, 'Approved', 'course_image_template-1664460097.png');

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
(10, 11, 'course 1 title 1', '2022-09-29 06:03:04', '2022-09-29 06:03:04', 'topic 1', 'course 1 chapter 1', 'Minimal (1).png'),
(11, 11, 'course 1 title 2', '2022-09-29 06:03:23', '2022-09-29 06:03:23', 'topic 2', 'course 1 chapter 2', 'Minimal (7).jpg'),
(12, 12, 'course 2 title 1', '2022-09-29 06:03:48', '2022-09-29 06:03:48', 'topic 1', 'course 2 chapter 1', 'Minimal (3).jpg'),
(13, 12, 'course 2 title 2', '2022-09-29 06:04:06', '2022-09-29 06:04:06', 'topic 2', 'course 2 chapter 2', 'Minimal (7).png');

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
(14, 12, 'file-1664460599.png', '2022-09-29 14:09:59', '2022-09-29 06:34:44', 'image', 10, 'enabled'),
(15, 12, 'file-1664460618.docx', '2022-09-29 14:10:18', '2022-09-29 06:34:40', 'application', 10, 'enabled'),
(16, 12, 'file-1664460628.mp4', '2022-09-29 14:10:28', '2022-09-29 06:34:48', 'video', 10, 'enabled');

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

--
-- Dumping data for table `course_quizzes`
--

INSERT INTO `course_quizzes` (`id`, `course_id`, `course_chapter_id`, `created_at`, `updated_at`, `quiz_title`, `number_of_questions`, `status`) VALUES
(25, 12, 10, '2022-09-29 14:20:17', '2022-09-29 06:34:54', 'Course 1 chapter 1 question 1', 2, 'enabled'),
(26, 12, 10, '2022-09-29 14:21:12', '2022-09-29 06:34:59', 'course 1 chapter 1 quiz 2', 2, 'enabled'),
(27, 12, 10, '2022-09-29 14:23:36', '2022-09-29 06:35:03', 'course 1 chapter 1 quiz 2', 2, 'enabled'),
(28, 12, 12, '2022-09-29 14:30:31', '2022-09-29 06:35:22', 'course 2 quiz 1', 2, 'enabled');

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
(6, 'Information Technology', '2022-09-29 05:59:32', '2022-09-29 05:59:32'),
(7, 'Liceo', '2022-09-29 05:59:40', '2022-09-29 05:59:40');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolled_courses`
--

INSERT INTO `enrolled_courses` (`id`, `student_id`, `instructor_id`, `course_id`, `course_type`, `amount`, `created_at`, `updated_at`, `status`) VALUES
(15, 22, 21, 11, 'Subscribed', 1500.00, '2022-09-29 07:05:32', '2022-09-29 07:05:32', 'unpaid'),
(16, 22, 21, 11, 'Subscribed', 1500.00, '2022-09-29 07:05:58', '2022-09-29 07:06:26', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_type` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `exams` (`id`, `question_type`, `course_id`, `created_at`, `updated_at`, `number_of_exams`, `title`, `certificate`, `course_chapter_id`, `status`) VALUES
(28, NULL, 12, '2022-09-29 14:22:09', '2022-09-29 06:35:06', NULL, 'course 1 chapter 1 exam 1', NULL, 10, 'enabled');

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
(82, 12, 28, 'www', 'ee', '2022-09-29 06:22:16', '2022-09-29 06:22:16', NULL, 10, 'Enumeration', '10'),
(83, 12, 28, 'www', 'eee', '2022-09-29 06:22:22', '2022-09-29 06:22:22', NULL, 10, 'Enumeration', '20');

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
(68, '2022_09_22_121045_create_assignment_matchings_table', 45),
(69, '2022_09_23_100221_add_course_chapter_id', 46),
(70, '2022_09_23_122258_create_student_logs_table', 47),
(71, '2022_09_23_130520_add_course_details_id', 48),
(72, '2022_09_23_134636_add_student_id_to_student_logs', 49),
(73, '2022_09_24_002028_add_column_date_to_student_logs', 50),
(74, '2022_09_24_134419_create_assignment_takens_table', 51),
(75, '2022_09_24_134851_create_assignment_taken_details_table', 52),
(76, '2022_09_25_063038_create_takens_table', 53),
(77, '2022_09_25_063229_create_taken_details_table', 54),
(78, '2022_09_25_081255_add_date_to_taken', 55),
(79, '2022_09_25_083534_add_score_to_taken_details', 56),
(80, '2022_09_25_084117_add_status_to_taken_details', 57),
(81, '2022_09_25_084856_add_type_to_taken_details', 58),
(82, '2022_09_26_011106_add_student_id', 59),
(83, '2022_09_26_012205_add_question_type', 60),
(84, '2022_09_26_074111_add_content_to_student_logs', 61),
(85, '2022_09_29_145433_add_status_to_payment', 62),
(86, '2022_09_29_145514_add_status_to_enrolled', 62);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `course_id`, `student_id`, `instructor_id`, `amount`, `created_at`, `updated_at`, `status`) VALUES
(8, 11, 22, 21, 1500.00, '2022-09-29 07:05:32', '2022-09-29 07:05:32', 'unpaid'),
(9, 11, 22, 21, 1500.00, '2022-09-29 07:05:58', '2022-09-29 07:06:26', 'paid');

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

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `course_id`, `course_quiz_id`, `question`, `answer`, `created_at`, `updated_at`, `question_type`, `course_chapter_id`, `score`) VALUES
(43, 12, 25, 'weqweasda', 'qweqwe', '2022-09-29 06:20:32', '2022-09-29 06:20:32', 'Enumeration', 10, '10'),
(44, 12, 25, 'www', 'rr|tt', '2022-09-29 06:20:39', '2022-09-29 06:20:39', 'Enumeration', 10, '20'),
(45, 12, 26, 'question 1', 'qweqwe', '2022-09-29 06:21:17', '2022-09-29 06:21:17', 'Identification', 10, '10'),
(46, 12, 26, 'question 2', 'qweqwe', '2022-09-29 06:21:23', '2022-09-29 06:21:23', 'Identification', 10, '20'),
(47, 12, 27, 'ggg', 'g', '2022-09-29 06:23:42', '2022-09-29 06:23:42', 'Enumeration', 10, '10'),
(48, 12, 27, 'ooo', 'ppp', '2022-09-29 06:23:50', '2022-09-29 06:23:50', 'Enumeration', 10, '2'),
(49, 12, 28, 'qweqwe', 'qweqwe', '2022-09-29 06:30:36', '2022-09-29 06:30:36', 'Enumeration', 12, '10'),
(50, 12, 28, 'qweqwe', 'qweqwe', '2022-09-29 06:30:45', '2022-09-29 06:30:45', 'Enumeration', 12, '20');

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
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_chapter_id` bigint(20) DEFAULT NULL
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
-- Table structure for table `student_logs`
--

CREATE TABLE `student_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_logs`
--

INSERT INTO `student_logs` (`id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `course_id`, `course_chapter_id`, `assignment_id`, `quiz_id`, `exam_id`, `created_at`, `updated_at`, `course_details_id`, `student_id`, `date`, `content`) VALUES
(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 10, NULL, NULL, NULL, '2022-09-29 15:08:15', '2022-09-29 15:08:15', NULL, 22, '2022-09-29', 'Quiz score 0/30'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 10, NULL, NULL, NULL, '2022-09-29 15:41:45', '2022-09-29 15:41:45', NULL, 22, '2022-09-29', 'Quiz score 10/30'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 10, NULL, NULL, NULL, '2022-09-29 15:42:25', '2022-09-29 15:42:25', NULL, 22, '2022-09-29', 'Quiz score 0/30');

-- --------------------------------------------------------

--
-- Table structure for table `takens`
--

CREATE TABLE `takens` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `takens`
--

INSERT INTO `takens` (`id`, `exam_id`, `quiz_id`, `assignment_id`, `instructor_id`, `student_id`, `course_chapter_id`, `course_id`, `score`, `total_points`, `type`, `remarks`, `created_at`, `updated_at`, `date`) VALUES
(54, NULL, 25, NULL, 21, 22, 10, 12, 10, 30, 'quiz', 'failed', '2022-09-29 15:39:31', '2022-09-29 15:41:45', '2022-09-29'),
(55, NULL, 26, NULL, 21, 22, 10, 12, 0, 30, 'quiz', 'failed', '2022-09-29 15:42:02', '2022-09-29 15:42:25', '2022-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `taken_details`
--

CREATE TABLE `taken_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taken_details`
--

INSERT INTO `taken_details` (`id`, `taken_id`, `question_id`, `question_answer`, `student_answer`, `remarks`, `created_at`, `updated_at`, `score`, `status`, `type`, `student_id`, `question_type`) VALUES
(71, 54, 43, 'qweqwe', 'qweqwe', 'checked', '2022-09-29 15:40:14', '2022-09-29 15:40:14', '10', 'answered', 'quiz', 22, 'Enumeration'),
(72, 54, 44, 'rr|tt', 'rretert,werwer', 'wrong', '2022-09-29 15:41:38', '2022-09-29 15:41:38', '20', 'answered', 'quiz', 22, 'Enumeration'),
(73, 55, 45, 'qweqwe', 'retert', 'wrong', '2022-09-29 15:42:08', '2022-09-29 15:42:08', '10', 'answered', 'quiz', 22, 'Identification'),
(74, 55, 46, 'qweqwe', 'nunn', 'wrong', '2022-09-29 15:42:18', '2022-09-29 15:42:18', '20', 'answered', 'quiz', 22, 'Identification');

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
(5, '    ', 'Admin', 'admin@gmail.com', 'Admin', NULL, '$2y$10$ajscrOU/3aY3Z8QYfoB/xe5mpV.YL3wVcGyT/1w9Pe7yA48hwmjq2', NULL, '2022-09-05 01:53:40', '2022-09-19 17:17:08', 'Approved', 'user_image-1663636628.jpeg'),
(21, 'sidney', 'salazar', 'salazarjohnsidney@gmail.com', 'Instructor', NULL, '$2y$10$NguSW/Vi01BVIXEqZ6KWLerEwTcv0IEXghf77s9bEmVvVxNewvURm', NULL, '2022-09-26 05:19:32', '2022-09-26 05:27:16', 'Approved', NULL),
(22, 'sidney', 'salazar', 'sidney@gmail.com', 'Student', NULL, '$2y$10$RglgiuiWLmi0b5lb1Xh3W.QC283ET93hC9jBj3S9Br58u3CJFKBAS', NULL, '2022-09-26 05:59:06', '2022-09-26 05:59:06', NULL, NULL);

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
-- Indexes for table `assignment_takens`
--
ALTER TABLE `assignment_takens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_taken_details`
--
ALTER TABLE `assignment_taken_details`
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
-- Indexes for table `student_logs`
--
ALTER TABLE `student_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `takens`
--
ALTER TABLE `takens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taken_details`
--
ALTER TABLE `taken_details`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `assignment_details`
--
ALTER TABLE `assignment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assignment_matchings`
--
ALTER TABLE `assignment_matchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `assignment_questions`
--
ALTER TABLE `assignment_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `assignment_takens`
--
ALTER TABLE `assignment_takens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_taken_details`
--
ALTER TABLE `assignment_taken_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `course_chapters`
--
ALTER TABLE `course_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_types`
--
ALTER TABLE `course_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `direct_messages`
--
ALTER TABLE `direct_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrolled_courses`
--
ALTER TABLE `enrolled_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `exam_details`
--
ALTER TABLE `exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam_matchings`
--
ALTER TABLE `exam_matchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz_details`
--
ALTER TABLE `quiz_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_matchings`
--
ALTER TABLE `quiz_matchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `student_exams`
--
ALTER TABLE `student_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_exam_details`
--
ALTER TABLE `student_exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_logs`
--
ALTER TABLE `student_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `takens`
--
ALTER TABLE `takens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `taken_details`
--
ALTER TABLE `taken_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
