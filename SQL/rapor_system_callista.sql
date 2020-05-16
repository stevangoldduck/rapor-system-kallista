-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 06:13 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rapor_system_callista`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_permission`
--

CREATE TABLE `access_permission` (
  `ap_id` int(11) NOT NULL,
  `ap_name` varchar(255) NOT NULL,
  `ap_permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_permission`
--

INSERT INTO `access_permission` (`ap_id`, `ap_name`, `ap_permission`) VALUES
(1, 'View All Grade Submission', 'view_all_grade_submission'),
(2, 'View Own Grade Submission', 'view_own_grade_submission');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_grade` int(11) NOT NULL,
  `class_department_id` int(11) NOT NULL,
  `class_start_ay` year(4) NOT NULL,
  `class_end_ay` year(4) NOT NULL,
  `class_homeroom_id` int(11) DEFAULT NULL COMMENT 'teacher that has User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_code`, `class_name`, `class_grade`, `class_department_id`, `class_start_ay`, `class_end_ay`, `class_homeroom_id`) VALUES
(1, '1EM0001-20', 'Elementary 1A', 1, 1, 2020, 2021, 1),
(2, '1EM0001-20', 'Elementary 1B', 1, 1, 2020, 2021, 1),
(3, '1EM0001-20', 'Elementary 2B', 1, 1, 2020, 2021, 1),
(4, '12R000001-20', 'RPL 12 B', 12, 3, 2020, 2021, 2);

-- --------------------------------------------------------

--
-- Table structure for table `class_sequence`
--

CREATE TABLE `class_sequence` (
  `cseq_id` int(11) NOT NULL,
  `cseq_sequence_num` int(6) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_sequence`
--

INSERT INTO `class_sequence` (`cseq_id`, `cseq_sequence_num`) VALUES
(1, 000001);

-- --------------------------------------------------------

--
-- Table structure for table `class_subject`
--

CREATE TABLE `class_subject` (
  `cs_class_id` int(11) NOT NULL,
  `cs_subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_subject`
--

INSERT INTO `class_subject` (`cs_class_id`, `cs_subject_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Elementary School'),
(2, 'Junior Highschool'),
(3, 'Highschool/Vacational Highschool');

-- --------------------------------------------------------

--
-- Table structure for table `grade_submissions`
--

CREATE TABLE `grade_submissions` (
  `gs_id` int(11) NOT NULL,
  `gs_submitted_by` int(11) NOT NULL COMMENT 'teacher_id (user_id)',
  `gs_approval_one_by` int(11) DEFAULT NULL,
  `gs_approval_two_by` int(11) DEFAULT NULL,
  `gs_approval_three_by` int(11) DEFAULT NULL,
  `gs_approval_one` int(11) NOT NULL DEFAULT 0 COMMENT 'lvl_1 (highest); 0 : false',
  `gs_approval_two` int(11) NOT NULL DEFAULT 0 COMMENT 'lvl_2; 0 : false',
  `gs_approval_three` int(11) NOT NULL DEFAULT 0 COMMENT 'lvl_3; 0 : false',
  `gs_submitted_date` date NOT NULL,
  `gs_subject_id` int(11) NOT NULL,
  `gs_sy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade_submissions`
--

INSERT INTO `grade_submissions` (`gs_id`, `gs_submitted_by`, `gs_approval_one_by`, `gs_approval_two_by`, `gs_approval_three_by`, `gs_approval_one`, `gs_approval_two`, `gs_approval_three`, `gs_submitted_date`, `gs_subject_id`, `gs_sy`) VALUES
(1, 1, NULL, NULL, NULL, 0, 0, 0, '2020-05-15', 1, '2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-04-12-051602', 'App\\Database\\Migrations\\Users', 'default', 'App', 1586668944, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_pob` varchar(255) DEFAULT NULL,
  `student_dob` datetime NOT NULL,
  `student_phone` varchar(255) DEFAULT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `student_address` text NOT NULL,
  `student_nis` varchar(255) NOT NULL,
  `student_nisn` varchar(255) NOT NULL,
  `student_department_id` int(11) NOT NULL,
  `student_specialization_id` int(11) DEFAULT NULL COMMENT 'only if HS/VHS',
  `student_father_name` varchar(255) DEFAULT NULL,
  `student_father_phone` varchar(255) DEFAULT NULL,
  `student_father_address` text DEFAULT NULL,
  `student_mother_name` varchar(255) DEFAULT NULL,
  `student_mother_phone` varchar(255) DEFAULT NULL,
  `student_mother_address` text DEFAULT NULL,
  `student_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_created_by` int(11) DEFAULT NULL,
  `student_modified_at` timestamp NULL DEFAULT NULL,
  `student_modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_pob`, `student_dob`, `student_phone`, `student_email`, `student_address`, `student_nis`, `student_nisn`, `student_department_id`, `student_specialization_id`, `student_father_name`, `student_father_phone`, `student_father_address`, `student_mother_name`, `student_mother_phone`, `student_mother_address`, `student_created_at`, `student_created_by`, `student_modified_at`, `student_modified_by`) VALUES
(1, 'Gading Marten II', 'Jakarta', '0000-00-00 00:00:00', '08956442414', 'gadiing@mail.com', 'Perumahan Citra Mas 2 Blok A 3', '19445701', '5499875542', 1, 1, 'Roy Marten', '', '', 'Meriam Belina', '', 'Suparman', '2020-04-20 14:35:17', NULL, '0000-00-00 00:00:00', 1),
(2, 'Gisella Anastasia', 'Surabaya', '0000-00-00 00:00:00', '', '', '', '1744854', '9978845456', 1, NULL, '', '', '', '', '', '', '2020-04-20 14:37:32', NULL, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `sclass_student_id` int(11) NOT NULL,
  `sclass_class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`sclass_student_id`, `sclass_class_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_club_grade`
--

CREATE TABLE `student_club_grade` (
  `scg_id` int(11) NOT NULL,
  `scg_student_id` int(11) NOT NULL,
  `scg_subject_id` int(11) NOT NULL,
  `scg_gs_id` int(11) NOT NULL,
  `scg_class_id` int(11) DEFAULT NULL,
  `scg_club_grade` varchar(255) NOT NULL,
  `scg_pmr_grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_sknowledge_grade`
--

CREATE TABLE `student_sknowledge_grade` (
  `skg_id` int(11) NOT NULL,
  `skg_student_id` int(11) NOT NULL,
  `skg_subject_id` int(11) NOT NULL,
  `skg_class_id` int(11) NOT NULL,
  `skg_gs_id` int(11) NOT NULL,
  `skg_u_a` double DEFAULT NULL COMMENT 'u = ulangan',
  `skg_u_rema` double DEFAULT NULL,
  `skg_u_b` double DEFAULT NULL,
  `skg_u_remb` double DEFAULT NULL,
  `skg_u_c` double DEFAULT NULL,
  `skg_u_remc` double DEFAULT NULL,
  `skg_u_d` double DEFAULT NULL,
  `skg_u_remd` double DEFAULT NULL,
  `skg_u_e` double DEFAULT NULL,
  `skg_u_reme` double DEFAULT NULL,
  `skg_aw_u` double DEFAULT NULL,
  `skg_avg_u` double DEFAULT NULL,
  `skg_t_a` double DEFAULT NULL COMMENT 't = tugas/latihan',
  `skg_t_rema` double DEFAULT NULL,
  `skg_t_b` double DEFAULT NULL,
  `skg_t_remb` double DEFAULT NULL,
  `skg_t_c` double DEFAULT NULL,
  `skg_t_remc` double DEFAULT NULL,
  `skg_t_d` double DEFAULT NULL,
  `skg_t_remd` double DEFAULT NULL,
  `skg_t_e` double DEFAULT NULL,
  `skg_t_reme` double DEFAULT NULL,
  `skg_aw_t` double DEFAULT NULL,
  `skg_avg_t` double DEFAULT NULL,
  `skg_md_score` double DEFAULT NULL,
  `skg_aw_md` double DEFAULT NULL,
  `skg_avg_md` double DEFAULT NULL,
  `skg_st_score` double DEFAULT NULL,
  `skg_aw_st` double DEFAULT NULL,
  `skg_avg_st` double DEFAULT NULL,
  `skg_final_score` double DEFAULT NULL,
  `skg_conversion` double DEFAULT NULL,
  `skg_predikat` varchar(255) DEFAULT NULL,
  `skg_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_sknowledge_grade`
--

INSERT INTO `student_sknowledge_grade` (`skg_id`, `skg_student_id`, `skg_subject_id`, `skg_class_id`, `skg_gs_id`, `skg_u_a`, `skg_u_rema`, `skg_u_b`, `skg_u_remb`, `skg_u_c`, `skg_u_remc`, `skg_u_d`, `skg_u_remd`, `skg_u_e`, `skg_u_reme`, `skg_aw_u`, `skg_avg_u`, `skg_t_a`, `skg_t_rema`, `skg_t_b`, `skg_t_remb`, `skg_t_c`, `skg_t_remc`, `skg_t_d`, `skg_t_remd`, `skg_t_e`, `skg_t_reme`, `skg_aw_t`, `skg_avg_t`, `skg_md_score`, `skg_aw_md`, `skg_avg_md`, `skg_st_score`, `skg_aw_st`, `skg_avg_st`, `skg_final_score`, `skg_conversion`, `skg_predikat`, `skg_remark`) VALUES
(1, 1, 1, 0, 1, 80, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 80, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, 80, NULL, 8, 80, NULL, 8, 80, NULL, 'B+', ''),
(2, 2, 1, 0, 1, 85, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.5, 80, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, 80, NULL, 8, 80, NULL, 8, 81.5, NULL, 'A', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_social_grade`
--

CREATE TABLE `student_social_grade` (
  `ssbg_id` int(11) NOT NULL,
  `ssbg_subject_id` int(11) NOT NULL,
  `ssbg_student_id` int(11) NOT NULL,
  `ssbg_class_id` int(11) NOT NULL,
  `ssbg_gs_id` int(11) NOT NULL,
  `ssbg_grade` varchar(255) NOT NULL,
  `ssbg_remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_spritual_grade`
--

CREATE TABLE `student_spritual_grade` (
  `sspg_id` int(11) NOT NULL,
  `sspg_subject_id` int(11) NOT NULL,
  `sspg_student_id` int(11) NOT NULL,
  `sspg_class_id` int(11) NOT NULL,
  `sspg_gs_id` int(11) NOT NULL,
  `sspg_grade` varchar(255) NOT NULL,
  `sspg_remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `ss_student_id` int(11) NOT NULL,
  `ss_subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`ss_student_id`, `ss_subject_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `student_subjectskill_grade`
--

CREATE TABLE `student_subjectskill_grade` (
  `ssg_id` int(11) NOT NULL,
  `ssg_student_id` int(11) NOT NULL,
  `ssg_subject_id` int(11) NOT NULL,
  `ssg_class_id` int(11) NOT NULL,
  `ssg_gs_id` int(11) NOT NULL,
  `ssg_ppk_a` double DEFAULT NULL COMMENT 'ppk = praktik',
  `ssg_ppk_rema` float DEFAULT NULL,
  `ssg_ppk_b` double DEFAULT NULL,
  `ssg_ppk_remb` double DEFAULT NULL,
  `ssg_ppk_c` double DEFAULT NULL,
  `ssg_ppk_remc` double DEFAULT NULL,
  `ssg_aw_ppk` double DEFAULT NULL,
  `ssg_avg_ppk` double DEFAULT NULL,
  `ssg_ppr_a` double DEFAULT NULL,
  `ssg_ppr_rema` double DEFAULT NULL COMMENT 'ppr = produk',
  `ssg_ppr_b` double DEFAULT NULL,
  `ssg_ppr_remb` double DEFAULT NULL,
  `ssg_ppr_c` double DEFAULT NULL,
  `ssg_ppr_remc` double DEFAULT NULL,
  `ssg_aw_ppr` double DEFAULT NULL,
  `ssg_avg_ppr` double DEFAULT NULL,
  `ssg_ppj_a` double DEFAULT NULL COMMENT 'ppj = project',
  `ssg_ppj_rema` double DEFAULT NULL,
  `ssg_ppj_b` double DEFAULT NULL,
  `ssg_ppj_remb` double DEFAULT NULL,
  `ssg_ppj_c` double DEFAULT NULL,
  `ssg_ppj_remc` double DEFAULT NULL,
  `ssg_aw_ppj` double DEFAULT NULL,
  `ssg_avg_ppj` double DEFAULT NULL,
  `ssg_md_score` double DEFAULT NULL COMMENT 'md = midtest',
  `ssg_aw_md` double DEFAULT NULL,
  `ssg_avg_md` double DEFAULT NULL,
  `ssg_st_score` double DEFAULT NULL COMMENT 'st = smstertest',
  `ssg_aw_st` double DEFAULT NULL,
  `ssg_avg_st` double DEFAULT NULL,
  `ssg_final_score` double DEFAULT NULL,
  `ssg_conversion` double DEFAULT NULL,
  `ssg_predikat` varchar(255) DEFAULT NULL,
  `ssg_remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subjectskill_grade`
--

INSERT INTO `student_subjectskill_grade` (`ssg_id`, `ssg_student_id`, `ssg_subject_id`, `ssg_class_id`, `ssg_gs_id`, `ssg_ppk_a`, `ssg_ppk_rema`, `ssg_ppk_b`, `ssg_ppk_remb`, `ssg_ppk_c`, `ssg_ppk_remc`, `ssg_aw_ppk`, `ssg_avg_ppk`, `ssg_ppr_a`, `ssg_ppr_rema`, `ssg_ppr_b`, `ssg_ppr_remb`, `ssg_ppr_c`, `ssg_ppr_remc`, `ssg_aw_ppr`, `ssg_avg_ppr`, `ssg_ppj_a`, `ssg_ppj_rema`, `ssg_ppj_b`, `ssg_ppj_remb`, `ssg_ppj_c`, `ssg_ppj_remc`, `ssg_aw_ppj`, `ssg_avg_ppj`, `ssg_md_score`, `ssg_aw_md`, `ssg_avg_md`, `ssg_st_score`, `ssg_aw_st`, `ssg_avg_st`, `ssg_final_score`, `ssg_conversion`, `ssg_predikat`, `ssg_remark`) VALUES
(1, 1, 1, 0, 1, 80, 80, NULL, NULL, NULL, NULL, NULL, 16, 80, 80, NULL, NULL, NULL, NULL, NULL, 8, 80, 80, NULL, NULL, NULL, NULL, NULL, 16, 80, NULL, 16, 80, NULL, 24, 64, NULL, 'B', ''),
(2, 2, 1, 0, 1, 80, 80, NULL, NULL, NULL, NULL, NULL, 16, 80, 80, NULL, NULL, NULL, NULL, NULL, 8, 80, 80, NULL, NULL, NULL, NULL, NULL, 16, 80, NULL, 16, 80, NULL, 24, 64, NULL, 'B', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_scc` int(11) NOT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `subject_grade` int(11) NOT NULL,
  `subject_teacher_id` int(11) NOT NULL,
  `subject_category` varchar(255) NOT NULL COMMENT 'moral, subject, social, curricular',
  `subject_aw_knowledge_id` int(11) DEFAULT NULL COMMENT 'only for subject',
  `subject_aw_skill_id` int(11) DEFAULT NULL COMMENT 'only for subject',
  `subject_predicate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `subject_scc`, `subject_group_id`, `subject_grade`, `subject_teacher_id`, `subject_category`, `subject_aw_knowledge_id`, `subject_aw_skill_id`, `subject_predicate_id`) VALUES
(1, 'ENG1', 'Bahasa Inggris 1', 73, 1, 1, 1, 'subject', 3, 3, 1),
(2, 'IND1', 'Bahasa Indonesia 1', 70, 1, 1, 1, 'subject', NULL, NULL, NULL),
(3, 'SPRTBHV1', 'Spiritual Behavior', 70, 1, 1, 1, 'moral', NULL, NULL, NULL),
(4, 'SCBHV1', 'Social Behavior', 75, 1, 1, 1, 'social', NULL, NULL, NULL),
(5, 'COCURRI1', 'Soccer', 70, 1, 1, 1, 'curricular', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_aw_knowledge`
--

CREATE TABLE `subject_aw_knowledge` (
  `sak_id` int(11) NOT NULL,
  `sak_u_aw` double DEFAULT NULL,
  `sak_t_aw` double DEFAULT NULL,
  `sak_md_aw` double DEFAULT NULL,
  `sak_st_aw` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_aw_knowledge`
--

INSERT INTO `subject_aw_knowledge` (`sak_id`, `sak_u_aw`, `sak_t_aw`, `sak_md_aw`, `sak_st_aw`) VALUES
(3, 30, 50, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `subject_aw_skill`
--

CREATE TABLE `subject_aw_skill` (
  `sas_id` int(11) NOT NULL,
  `sas_aw_ppk` double DEFAULT NULL,
  `sas_aw_ppr` double DEFAULT NULL,
  `sas_aw_ppj` double DEFAULT NULL,
  `sas_aw_md` double DEFAULT NULL,
  `sas_aw_st` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_aw_skill`
--

INSERT INTO `subject_aw_skill` (`sas_id`, `sas_aw_ppk`, `sas_aw_ppr`, `sas_aw_ppj`, `sas_aw_md`, `sas_aw_st`) VALUES
(3, 20, 10, 20, 20, 30);

-- --------------------------------------------------------

--
-- Table structure for table `subject_group`
--

CREATE TABLE `subject_group` (
  `sg_id` int(11) NOT NULL,
  `sg_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_group`
--

INSERT INTO `subject_group` (`sg_id`, `sg_name`) VALUES
(1, 'Grade 1 Group'),
(2, 'Grade 2 Group'),
(3, 'Group Grade 1');

-- --------------------------------------------------------

--
-- Table structure for table `subject_predicate`
--

CREATE TABLE `subject_predicate` (
  `sp_id` int(11) NOT NULL,
  `sp_min_a` double NOT NULL,
  `sp_max_a` double NOT NULL,
  `sp_p_a` varchar(5) NOT NULL,
  `sp_min_b` double NOT NULL,
  `sp_max_b` double NOT NULL,
  `sp_p_b` varchar(5) NOT NULL,
  `sp_min_c` double NOT NULL,
  `sp_max_c` double NOT NULL,
  `sp_p_c` varchar(5) NOT NULL,
  `sp_min_d` double NOT NULL,
  `sp_max_d` double NOT NULL,
  `sp_p_d` varchar(5) NOT NULL,
  `sp_min_e` double NOT NULL,
  `sp_max_e` double NOT NULL,
  `sp_p_e` varchar(5) NOT NULL,
  `sp_min_f` double NOT NULL,
  `sp_max_f` double NOT NULL,
  `sp_p_f` varchar(5) NOT NULL,
  `sp_min_g` double NOT NULL,
  `sp_max_g` double NOT NULL,
  `sp_p_g` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_predicate`
--

INSERT INTO `subject_predicate` (`sp_id`, `sp_min_a`, `sp_max_a`, `sp_p_a`, `sp_min_b`, `sp_max_b`, `sp_p_b`, `sp_min_c`, `sp_max_c`, `sp_p_c`, `sp_min_d`, `sp_max_d`, `sp_p_d`, `sp_min_e`, `sp_max_e`, `sp_p_e`, `sp_min_f`, `sp_max_f`, `sp_p_f`, `sp_min_g`, `sp_max_g`, `sp_p_g`) VALUES
(1, 30, 40, 'D', 40, 50, 'C+', 50, 60, 'C', 60, 70, 'B', 70, 80, 'B+', 80, 90, 'A', 90, 100, 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `teacher_nip` varchar(25) NOT NULL,
  `teacher_user_id` int(11) DEFAULT NULL,
  `teacher_phone` varchar(25) DEFAULT NULL,
  `teacher_address` varchar(255) DEFAULT NULL,
  `teacher_email` varchar(255) DEFAULT NULL,
  `teacher_department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `teacher_nip`, `teacher_user_id`, `teacher_phone`, `teacher_address`, `teacher_email`, `teacher_department_id`) VALUES
(1, 'Pak Guru Narno', '1787546425', 2, '784654515', 'Suparman', 'saasdj@mail.com', 1),
(2, 'Suwarno', '23423412', 3, '487546548', 'Suparman', 'suwarn@mail.com', 1),
(3, 'Yunpeng', '78945642', 4, '136875', 'KO BCI Industrial Park c/02-c/06', 'kurtjuriant99@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `ts_teacher_id` int(11) NOT NULL,
  `ts_subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_access` text DEFAULT '"[]"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `phone`, `address`, `email`, `user_access`) VALUES
(1, 'admin', '$2y$10$gAiLzXYoQ6J5AjPmzK5ouOviCjbREj4lyhKLTYYSjvQjcyY3YvWli', 0, 'Administrator 2', '08445157565', 'Sekolah Callista 2', 'admin@mail.com', '{\"view_all_grade_submission\":true,\"view_own_grade_submission\":true}'),
(2, 'narnobatman', '$2y$10$3vOawbdNOItkXa/IYQw3MuxI0HZtbHIcwNf1PN6YcqXgYlk5n8RQK', 1, 'Pak Guru Narno', '784654515', 'Suparman', 'saasdj@mail.com', '\"[]\"'),
(3, 'stevangd', '$2y$10$MmHTH68j1uhC49D/FjOS1eh.y0ZZdSNAOg49w4Mi48OGbWOpy769a', 1, 'Suwarno', '487546548', 'Suparman', 'suwarn@mail.com', '\"[]\"'),
(4, 'doctor', '$2y$10$5G1WIFsP1lr70n50R9KPvucsRQsqZ.vKKhIC7gfpNVSd2rrMeISla', 1, 'Yunpeng', '136875', 'KO BCI Industrial Park c/02-c/06', 'kurtjuriant99@gmail.com', '\"[]\"');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_permission`
--
ALTER TABLE `access_permission`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_sequence`
--
ALTER TABLE `class_sequence`
  ADD PRIMARY KEY (`cseq_id`);

--
-- Indexes for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`cs_class_id`,`cs_subject_id`),
  ADD KEY `sb_id` (`cs_subject_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `grade_submissions`
--
ALTER TABLE `grade_submissions`
  ADD PRIMARY KEY (`gs_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`sclass_student_id`,`sclass_class_id`);

--
-- Indexes for table `student_club_grade`
--
ALTER TABLE `student_club_grade`
  ADD PRIMARY KEY (`scg_id`);

--
-- Indexes for table `student_sknowledge_grade`
--
ALTER TABLE `student_sknowledge_grade`
  ADD PRIMARY KEY (`skg_id`);

--
-- Indexes for table `student_social_grade`
--
ALTER TABLE `student_social_grade`
  ADD PRIMARY KEY (`ssbg_id`);

--
-- Indexes for table `student_spritual_grade`
--
ALTER TABLE `student_spritual_grade`
  ADD PRIMARY KEY (`sspg_id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`ss_student_id`,`ss_subject_id`);

--
-- Indexes for table `student_subjectskill_grade`
--
ALTER TABLE `student_subjectskill_grade`
  ADD PRIMARY KEY (`ssg_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_aw_knowledge`
--
ALTER TABLE `subject_aw_knowledge`
  ADD PRIMARY KEY (`sak_id`);

--
-- Indexes for table `subject_aw_skill`
--
ALTER TABLE `subject_aw_skill`
  ADD PRIMARY KEY (`sas_id`);

--
-- Indexes for table `subject_group`
--
ALTER TABLE `subject_group`
  ADD PRIMARY KEY (`sg_id`);

--
-- Indexes for table `subject_predicate`
--
ALTER TABLE `subject_predicate`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`ts_teacher_id`,`ts_subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_permission`
--
ALTER TABLE `access_permission`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_sequence`
--
ALTER TABLE `class_sequence`
  MODIFY `cseq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade_submissions`
--
ALTER TABLE `grade_submissions`
  MODIFY `gs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_club_grade`
--
ALTER TABLE `student_club_grade`
  MODIFY `scg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_sknowledge_grade`
--
ALTER TABLE `student_sknowledge_grade`
  MODIFY `skg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_social_grade`
--
ALTER TABLE `student_social_grade`
  MODIFY `ssbg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_spritual_grade`
--
ALTER TABLE `student_spritual_grade`
  MODIFY `sspg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_subjectskill_grade`
--
ALTER TABLE `student_subjectskill_grade`
  MODIFY `ssg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject_aw_knowledge`
--
ALTER TABLE `subject_aw_knowledge`
  MODIFY `sak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_aw_skill`
--
ALTER TABLE `subject_aw_skill`
  MODIFY `sas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_group`
--
ALTER TABLE `subject_group`
  MODIFY `sg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_predicate`
--
ALTER TABLE `subject_predicate`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD CONSTRAINT `cl_id` FOREIGN KEY (`cs_class_id`) REFERENCES `classes` (`class_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sb_id` FOREIGN KEY (`cs_subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
