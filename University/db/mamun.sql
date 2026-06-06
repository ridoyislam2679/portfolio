-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 07:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mamun`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic`
--

CREATE TABLE `academic` (
  `academic_id` int(3) NOT NULL,
  `academic_name` varchar(100) NOT NULL,
  `academic_image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic`
--

INSERT INTO `academic` (`academic_id`, `academic_name`, `academic_image`) VALUES
(1, 'Bachelor of Science in Computer Science', 'bsc-cs.jpg'),
(2, 'Bachelor of Arts in English', 'ba-english.jpg'),
(3, 'Bachelor of Business Administration', 'bba.jpg'),
(4, 'Bachelor of Science in Physics', 'bsc-physics.jpg'),
(5, 'Bachelor of Science in Mathematics', 'bsc-math.jpg'),
(6, 'Bachelor of Social Science', 'bss.jpg'),
(7, 'Bachelor of Fine Arts', 'bfa.jpg'),
(8, 'Bachelor of Laws', 'llb.jpg'),
(9, 'Bachelor of Medicine', 'mbbs.jpg'),
(10, 'Bachelor of Pharmacy', 'bpharm.jpg'),
(11, 'Master of Science in Computer Science', 'msc-cs.jpg'),
(12, 'Master of Business Administration', 'mba.jpg'),
(13, 'Master of Arts in English', 'ma-english.jpg'),
(14, 'Master of Science in Physics', 'msc-physics.jpg'),
(15, 'Master of Science in Mathematics', 'msc-math.jpg'),
(16, 'Master of Social Science', 'mss.jpg'),
(17, 'Master of Fine Arts', 'mfa.jpg'),
(18, 'Master of Laws', 'llm.jpg'),
(19, 'Doctor of Philosophy in Computer Science', 'phd-cs.jpg'),
(20, 'Doctor of Philosophy in Physics', 'phd-physics.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `administrator_id` int(3) NOT NULL,
  `administrator_name` varchar(100) NOT NULL,
  `administrator_email` varchar(100) NOT NULL,
  `administrator_phone` int(11) NOT NULL,
  `administrator_gender` varchar(50) NOT NULL,
  `administrator_image` varchar(150) NOT NULL,
  `administrator_type` varchar(100) NOT NULL,
  `welcome_msg` varchar(1000) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date DEFAULT NULL,
  `status` enum('running','retired','regained','') NOT NULL DEFAULT 'running'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administrator_id`, `administrator_name`, `administrator_email`, `administrator_phone`, `administrator_gender`, `administrator_image`, `administrator_type`, `welcome_msg`, `start_date`, `end_date`, `status`) VALUES
(1, 'Prof. Dr. Mohammad Ali', 'vc@university.edu', 1712345678, 'Male', 'administration.jpg', 'Vice Chancellor', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(2, 'Prof. Dr. Fatima Begum', 'provc@university.edu', 1712345679, 'Female', 'administration.jpg', 'Pro Vice Chancellor', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(3, 'Dr. Abdullah Khan', 'treasurer@university.edu', 1712345680, 'Male', 'administration.jpg', 'Treasurer', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running'),
(4, 'Mr. Hasan Mahmud', 'registrar@university.edu', 1712345681, 'Male', 'administration.jpg', 'Registrar', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2019-01-01', '2024-12-31', 'running'),
(5, 'Mrs. Nusrat Jahan', 'deputy-registrar@university.edu', 1712345682, 'Female', 'administration.jpg', 'Deputy Registrar', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running'),
(6, 'Mr. Kamal Hossain', 'controller@university.edu', 1712345683, 'Male', 'administration.jpg', 'Controller of Examinations', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(7, 'Mrs. Ayesha Siddika', 'library@university.edu', 1712345684, 'Female', 'administration.jpg', 'Librarian', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2018-01-01', '2023-12-31', 'running'),
(8, 'Dr. Farhan Ahmed', 'finance@university.edu', 1712345685, 'Male', 'administration.jpg', 'Finance Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running'),
(9, 'Mrs. Sabrina Islam', 'hr@university.edu', 1712345686, 'Female', 'administration.jpg', 'HR Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2019-01-01', '2024-12-31', 'running'),
(10, 'Mr. Rahim Khan', 'estate@university.edu', 1712345687, 'Male', 'administration.jpg', 'Estate Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(11, 'Dr. Nasrin Akter', 'student-affairs@university.edu', 1712345688, 'Female', 'administration.jpg', 'Student Affairs Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running'),
(12, 'Mr. Jamal Uddin', 'ict@university.edu', 1712345689, 'Male', 'administration.jpg', 'ICT Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(13, 'Mrs. Tahmina Akter', 'research@university.edu', 1712345690, 'Female', 'administration.jpg', 'Research Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2019-01-01', '2024-12-31', 'running'),
(14, 'Dr. Arif Hossain', 'planning@university.edu', 1712345691, 'Male', 'administration.jpg', 'Planning Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running'),
(15, 'Mrs. Sharmin Akter', 'admission@university.edu', 1712345692, 'Female', 'administration.jpg', 'Admission Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(16, 'Mr. Sajjad Hossain', 'publications@university.edu', 1712345693, 'Male', 'administration.jpg', 'Publications Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2019-01-01', '2024-12-31', 'running'),
(17, 'Dr. Nabila Rahman', 'international@university.edu', 1712345694, 'Female', 'administration.jpg', 'International Affairs Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running'),
(18, 'Mr. Faisal Mahmud', 'security@university.edu', 1712345695, 'Male', 'administration.jpg', 'Security Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2020-01-01', '2025-12-31', 'running'),
(19, 'Mrs. Jannatul Ferdous', 'medical@university.edu', 1712345696, 'Female', 'administration.jpg', 'Medical Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2019-01-01', '2024-12-31', 'running'),
(20, 'Dr. Tariqul Islam', 'sports@university.edu', 1712345697, 'Male', 'administration.jpg', 'Sports Director', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.', '2021-01-01', '2026-12-31', 'running');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_education`
--

CREATE TABLE `administrator_education` (
  `id` int(11) NOT NULL,
  `administrator_id` int(3) NOT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `year_of_passing` year(4) DEFAULT NULL,
  `end_year` year(4) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator_education`
--

INSERT INTO `administrator_education` (`id`, `administrator_id`, `degree`, `subject`, `institution`, `year_of_passing`, `end_year`, `result`, `remarks`) VALUES
(1, 1, 'PhD', 'Computer Science', 'University of Dhaka', '2005', NULL, '3.8/4.0', 'Currently supervising PhD students'),
(2, 1, 'MSc', 'Computer Science', 'Bangladesh University of Engineering and Technology', '2000', '2002', 'First Class', 'Completed in 2 years'),
(3, 1, 'BSc', 'Computer Science', 'University of Chittagong', '1998', '2000', '3.7/4.0', 'Graduated with Honors'),
(4, 2, 'PhD', 'Mathematics', 'University of Cambridge', '2008', '2012', 'Pass with Distinction', 'Fulbright Scholar'),
(5, 2, 'MPhil', 'Applied Mathematics', 'University of Oxford', '2004', '2006', 'Merit', 'Research in Numerical Analysis'),
(6, 3, 'MBA', 'Educational Leadership', 'Harvard University', '2012', '2014', '3.9/4.0', 'Executive Education Program'),
(7, 3, 'MA', 'Education', 'Columbia University', '2007', NULL, 'A+', 'Currently teaching part-time'),
(8, 4, 'PhD', 'Physics', 'Massachusetts Institute of Technology', '2010', '2015', '4.0/4.0', 'Nobel Laureate Advisor'),
(9, 4, 'MSc', 'Theoretical Physics', 'California Institute of Technology', '2006', NULL, 'First Class', 'Visiting researcher'),
(10, 5, 'LLB', 'Law', 'University of London', '2009', '2012', 'Second Class Upper', 'International Law Focus'),
(11, 5, 'BA', 'Political Science', 'University of Dhaka', '2005', '2009', '3.5/4.0', 'Student Government President'),
(12, 6, 'MD', 'Medicine', 'Dhaka Medical College', '1995', '2000', 'First Class', 'Gold Medalist'),
(13, 6, 'MBBS', 'Medicine', 'Sir Salimullah Medical College', '1992', NULL, 'Distinction', 'Still affiliated as visiting faculty'),
(14, 7, 'PhD', 'Economics', 'University of Chicago', '2015', '2019', '4.0/4.0', 'Nobel Prize Winning Advisor'),
(15, 7, 'MA', 'Econometrics', 'London School of Economics', '2010', NULL, 'Distinction', 'Adjunct professor'),
(16, 8, 'BSc', 'Electrical Engineering', 'BUET', '2003', '2007', '3.9/4.0', 'Summa Cum Laude'),
(17, 9, 'MFA', 'Fine Arts', 'Rhode Island School of Design', '2011', '2013', 'Pass with Honors', 'International Exhibition'),
(18, 10, 'PhD', 'Chemistry', 'Stanford University', '2009', NULL, '3.95/4.0', 'Ongoing research collaboration'),
(19, 11, 'MSc', 'Environmental Science', 'Yale University', '2014', '2016', '3.8/4.0', 'Field Research in Sundarbans'),
(20, 12, 'BBA', 'Business Administration', 'North South University', '2007', NULL, '3.6/4.0', 'Currently on advisory board');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_login`
--

CREATE TABLE `administrator_login` (
  `administrator_id` int(10) NOT NULL,
  `administrator_name` varchar(100) NOT NULL,
  `administrator_email` varchar(50) NOT NULL,
  `administrator_pass` varchar(255) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator_login`
--

INSERT INTO `administrator_login` (`administrator_id`, `administrator_name`, `administrator_email`, `administrator_pass`, `last_update`) VALUES
(1, 'mamun', 'mamun@gmail.com', '1230', '2025-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `administrator_work`
--

CREATE TABLE `administrator_work` (
  `id` int(11) NOT NULL,
  `administrator_id` int(3) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `start_work` year(4) DEFAULT NULL,
  `end_work` year(4) DEFAULT NULL,
  `currently_working` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator_work`
--

INSERT INTO `administrator_work` (`id`, `administrator_id`, `subject`, `institution`, `start_work`, `end_work`, `currently_working`) VALUES
(0, 1, 'University Administration', 'University of Dhaka', '2020', NULL, '1'),
(0, 1, 'Academic Affairs', 'Harvard University', '2015', '2020', '0'),
(0, 2, 'Student Services', 'University of Oxford', '2019', NULL, '1'),
(0, 2, 'Admissions', 'Stanford University', '2014', '2019', '0'),
(0, 3, 'Research Administration', 'MIT', '2018', NULL, '1'),
(0, 3, 'Grants Management', 'University of Cambridge', '2013', '2018', '0'),
(0, 4, 'Financial Administration', 'University of Pennsylvania', '2017', '2022', '0'),
(0, 4, 'Budget Planning', 'Columbia University', '2012', '2017', '0'),
(0, 5, 'Human Resources', 'University of California', '2021', NULL, '1'),
(0, 5, 'Faculty Recruitment', 'University of Chicago', '2016', '2021', '0'),
(0, 6, 'International Programs', 'Yale University', '2016', '2021', '0'),
(0, 6, 'Study Abroad', 'Princeton University', '2010', '2016', '0'),
(0, 7, 'IT Services', 'California Institute of Technology', '2018', NULL, '1'),
(0, 7, 'Digital Learning', 'ETH Zurich', '2014', '2018', '0'),
(0, 8, 'Facilities Management', 'University of Michigan', '2015', '2020', '0'),
(0, 8, 'Campus Development', 'University of Tokyo', '2010', '2015', '0'),
(0, 9, 'Alumni Relations', 'University of Delhi', '2020', NULL, '1'),
(0, 9, 'Fundraising', 'London School of Economics', '2015', '2020', '0'),
(0, 10, 'Quality Assurance', 'University of Sydney', '2018', '2023', '0'),
(0, 10, 'Accreditation', 'National University of Singapore', '2013', '2018', '0');

-- --------------------------------------------------------

--
-- Table structure for table `admission_news`
--

CREATE TABLE `admission_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('Undergraduate','Postgraduate') NOT NULL,
  `publish_date` date DEFAULT NULL,
  `pdf_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_news`
--

INSERT INTO `admission_news` (`id`, `title`, `type`, `publish_date`, `pdf_url`) VALUES
(1, '২০২৫ সালের অনলাইন আবেদন শুরু', 'Undergraduate', '2025-04-27', 'notice.pdf'),
(2, 'ভর্তি পরীক্ষার তারিখ ঘোষণা', 'Postgraduate', '2025-04-25', 'notice.pdf'),
(3, 'নতুন বিভাগ চালু', 'Undergraduate', '2025-04-22', 'notice.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `campus_media`
--

CREATE TABLE `campus_media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('image','video') DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus_media`
--

INSERT INTO `campus_media` (`id`, `title`, `description`, `type`, `file_url`) VALUES
(1, 'Main Building', 'This is the central building.', 'image', 'vc.jpg'),
(2, 'Campus Tour', 'Take a virtual tour.', 'video', 'video.mp4'),
(3, 'Library', 'Our quiet study area.', 'image', 'vc.jpg'),
(5, 'Campus Tour', 'Take a virtual tour.', 'video', 'video.mp4'),
(6, 'Library', 'Our quiet study area.', 'image', 'vc.jpg'),
(7, 'Main Building', 'This is the central building.', 'image', 'vc.jpg'),
(9, 'Library', 'Our quiet study area.', 'image', 'vc.jpg'),
(10, 'Main Building', 'This is the central building.', 'image', 'vc.jpg'),
(11, 'Campus Tour', 'Take a virtual tour.', 'video', 'video.mp4'),
(12, 'Library', 'Our quiet study area.', 'image', 'vc.jpg'),
(13, 'Campus Tour', 'Take a virtual tour.', 'video', 'video.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `dean`
--

CREATE TABLE `dean` (
  `dean_id` int(3) NOT NULL,
  `faculty_id` int(3) NOT NULL,
  `dean_name` varchar(100) NOT NULL,
  `dean_email` varchar(150) NOT NULL,
  `dean_phone` int(11) NOT NULL,
  `dean_image` varchar(100) NOT NULL,
  `dean_gender` varchar(100) NOT NULL,
  `welcome_msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean`
--

INSERT INTO `dean` (`dean_id`, `faculty_id`, `dean_name`, `dean_email`, `dean_phone`, `dean_image`, `dean_gender`, `welcome_msg`) VALUES
(1, 1, 'Prof. Dr. Ahmed Khan', 'science@university.edu', 1712345700, 'science-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(2, 2, 'Prof. Dr. Nusrat Jahan', 'arts@university.edu', 1712345701, 'arts-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(3, 3, 'Prof. Dr. Mahmudul Hasan', 'business@university.edu', 1712345702, 'business-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(4, 4, 'Prof. Dr. Abdul Karim', 'engineering@university.edu', 1712345703, 'engineering-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(5, 5, 'Prof. Dr. Farhana Islam', 'law@university.edu', 1712345704, 'law-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(6, 6, 'Prof. Dr. Rahim Uddin', 'medicine@university.edu', 1712345705, 'medicine-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(7, 7, 'Prof. Dr. Sabrina Ahmed', 'pharmacy@university.edu', 1712345706, 'pharmacy-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(8, 8, 'Prof. Dr. Jamal Uddin', 'social-science@university.edu', 1712345707, 'social-science-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(9, 9, 'Prof. Dr. Tahmina Akter', 'biological-science@university.edu', 1712345708, 'biological-science-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(10, 10, 'Prof. Dr. Arif Hossain', 'fine-arts@university.edu', 1712345709, 'fine-arts-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(11, 11, 'Prof. Dr. Sharmin Akter', 'education@university.edu', 1712345710, 'education-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(12, 12, 'Prof. Dr. Sajjad Hossain', 'architecture@university.edu', 1712345711, 'architecture-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(13, 0, 'Prof. Dr. Nabila Rahman', 'agriculture@university.edu', 1712345712, 'agriculture-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(14, 0, 'Prof. Dr. Faisal Mahmud', 'environment@university.edu', 1712345713, 'environment-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(15, 0, 'Prof. Dr. Jannatul Ferdous', 'marine-science@university.edu', 1712345714, 'marine-science-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(16, 0, 'Prof. Dr. Tariqul Islam', 'ict@university.edu', 1712345715, 'ict-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(17, 0, 'Prof. Dr. Nasrin Akter', 'economics@university.edu', 1712345716, 'economics-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(18, 0, 'Prof. Dr. Kamal Hossain', 'public-health@university.edu', 1712345717, 'public-health-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(19, 0, 'Prof. Dr. Ayesha Siddika', 'development-studies@university.edu', 1712345718, 'development-studies-dean.jpg', 'Female', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(20, 0, 'Prof. Dr. Hasan Mahmud', 'international-relations@university.edu', 1712345719, 'international-relations-dean.jpg', 'Male', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.'),
(21, 0, '', '', 0, '', '', 'We at Rajshahi University are committed to providing you with excellent education, practical training and facilities in the careers you have deliberately chosen to pursue. To achieve this, we continuously update our courses and syllabi, keeping in view the changing needs of different professions, industries and ever-changing social milieu as such. We emphasize on imparting excellent education into our students in an encouraging environment; we pay equal attention to their all-round development as well.  We provide them with ample opportunities for giving expression to their inner faculty and critical voices, creative and artistic talents as well as sportsmanship. We want out students to be well-educated and well-trained and become responsible citizens. You will be happy to know that the track record of the achievements of our alumni is commendable. Hundreds of our past students have proved their worth, professionalism and excellence at home and abroad in different walks of life.');

-- --------------------------------------------------------

--
-- Table structure for table `dean_education`
--

CREATE TABLE `dean_education` (
  `id` int(11) NOT NULL,
  `dean_id` int(3) NOT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `year_of_passing` year(4) DEFAULT NULL,
  `end_year` year(4) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean_education`
--

INSERT INTO `dean_education` (`id`, `dean_id`, `degree`, `subject`, `institution`, `year_of_passing`, `end_year`, `result`, `remarks`) VALUES
(1, 1, 'PhD', 'Economics', 'University of Dhaka', '2005', NULL, '3.8/4.0', 'Current position as Dean'),
(2, 1, 'MSc', 'Applied Economics', 'London School of Economics', '2000', '2002', 'Distinction', 'Completed degree'),
(3, 2, 'PhD', 'Business Administration', 'Harvard University', '2010', '2014', '4.0/4.0', 'Former position'),
(4, 2, 'MBA', 'Finance', 'University of Pennsylvania', '2005', '2007', '3.9/4.0', 'Wharton School'),
(5, 3, 'PhD', 'Computer Science', 'MIT', '2012', NULL, '3.95/4.0', 'Current research'),
(6, 3, 'BSc', 'Computer Engineering', 'BUET', '2005', '2009', '3.7/4.0', 'Gold Medalist'),
(7, 4, 'PhD', 'Public Health', 'Johns Hopkins', '2015', '2019', '4.0/4.0', 'Global Health'),
(8, 4, 'MPH', 'Epidemiology', 'UNC', '2010', '2012', '3.8/4.0', 'CDC Fellowship'),
(9, 5, 'PhD', 'Education', 'Stanford', '2008', NULL, '3.9/4.0', 'Current Dean'),
(10, 5, 'MA', 'Educational Leadership', 'Columbia', '2003', '2005', '3.6/4.0', 'Dean\'s List'),
(11, 6, 'PhD', 'Physics', 'Cambridge', '2007', '2011', 'First Class', 'Nobel advisor'),
(12, 6, 'MPhil', 'Theoretical Physics', 'Oxford', '2004', '2006', 'Distinction', 'Quantum research'),
(13, 7, 'PhD', 'Chemistry', 'Caltech', '2013', NULL, '3.9/4.0', 'Active professor'),
(14, 7, 'BSc', 'Chemistry', 'University of Dhaka', '2005', '2009', '3.8/4.0', 'Summa Cum Laude'),
(15, 8, 'PhD', 'Mathematics', 'Princeton', '2009', '2013', '4.0/4.0', 'Fields Medal nominee'),
(16, 8, 'MS', 'Applied Mathematics', 'ETH Zurich', '2006', '2008', '5.5/6.0', 'Swiss scholarship'),
(17, 9, 'PhD', 'Political Science', 'Yale', '2011', NULL, '3.7/4.0', 'Current position'),
(18, 9, 'BA', 'International Relations', 'University of Delhi', '2004', '2007', 'First Division', 'Topper'),
(19, 10, 'PhD', 'Environmental Science', 'Stanford', '2014', '2018', '3.9/4.0', 'Climate research'),
(20, 10, 'MSc', 'Environmental Eng', 'UC Berkeley', '2010', '2012', '3.8/4.0', 'NSF Fellowship');

-- --------------------------------------------------------

--
-- Table structure for table `dean_login`
--

CREATE TABLE `dean_login` (
  `dean_id` int(10) NOT NULL,
  `dean_name` varchar(100) NOT NULL,
  `dean_email` varchar(50) NOT NULL,
  `dean_pass` varchar(255) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean_login`
--

INSERT INTO `dean_login` (`dean_id`, `dean_name`, `dean_email`, `dean_pass`, `last_update`) VALUES
(1, 'mamun', 'mamun@gmail.com', '1230', '2025-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `dean_work`
--

CREATE TABLE `dean_work` (
  `id` int(11) NOT NULL,
  `dean_id` int(3) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `start_work` year(4) DEFAULT NULL,
  `end_work` year(4) DEFAULT NULL,
  `currently_working` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean_work`
--

INSERT INTO `dean_work` (`id`, `dean_id`, `subject`, `institution`, `start_work`, `end_work`, `currently_working`) VALUES
(1, 1, 'Faculty of Science', 'University of Dhaka', '2020', NULL, '1'),
(2, 1, 'Department of Physics', 'MIT', '2015', '2020', '0'),
(3, 2, 'Business School', 'Harvard University', '2018', NULL, '1'),
(4, 2, 'Finance Department', 'University of Pennsylvania', '2012', '2018', '0'),
(5, 3, 'School of Engineering', 'Stanford University', '2019', NULL, '1'),
(6, 3, 'Computer Science Dept', 'UC Berkeley', '2014', '2019', '0'),
(7, 4, 'Medical Faculty', 'Johns Hopkins University', '2017', '2022', '0'),
(8, 4, 'Public Health Dept', 'University of North Carolina', '2012', '2017', '0'),
(9, 5, 'Education Faculty', 'Columbia University', '2021', NULL, '1'),
(10, 5, 'Curriculum Development', 'University of Chicago', '2016', '2021', '0'),
(11, 6, 'Science Faculty', 'University of Cambridge', '2016', '2021', '0'),
(12, 6, 'Physics Department', 'Imperial College London', '2010', '2016', '0'),
(13, 7, 'Chemistry Faculty', 'California Institute of Technology', '2018', NULL, '1'),
(14, 7, 'Materials Science Dept', 'ETH Zurich', '2014', '2018', '0'),
(15, 8, 'Mathematics Faculty', 'Princeton University', '2015', '2020', '0'),
(16, 8, 'Applied Math Dept', 'University of Waterloo', '2010', '2015', '0'),
(17, 9, 'Social Sciences', 'Yale University', '2020', NULL, '1'),
(18, 9, 'Political Science Dept', 'London School of Economics', '2015', '2020', '0'),
(19, 10, 'Environmental Studies', 'Stanford University', '2018', '2023', '0'),
(20, 10, 'Sustainability Dept', 'University of British Columbia', '2013', '2018', '0');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(3) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_image` varchar(150) NOT NULL,
  `faculty_id` int(3) NOT NULL,
  `department_start_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_image`, `faculty_id`, `department_start_date`) VALUES
(1, 'Computer Science and Engineering', 'departemnt.jpg', 1, '2000-01-01'),
(2, 'Electrical and Electronic Engineering', 'departemnt.jpg', 1, '2000-01-01'),
(3, 'Physics', 'departemnt.jpg', 1, '2000-01-01'),
(4, 'Mathematics', 'departemnt.jpg', 1, '2000-01-01'),
(5, 'Chemistry', 'departemnt.jpg', 1, '2000-01-01'),
(6, 'English', 'departemnt.jpg', 2, '2000-01-01'),
(7, 'Bangla', 'departemnt.jpg', 2, '2000-01-01'),
(8, 'History', 'departemnt.jpg', 2, '2000-01-01'),
(9, 'Economics', 'departemnt.jpg', 3, '2000-01-01'),
(10, 'Business Administration', 'departemnt.jpg', 3, '2000-01-01'),
(11, 'Accounting', 'departemnt.jpg', 3, '2000-01-01'),
(12, 'Marketing', 'departemnt.jpg', 3, '2000-01-01'),
(13, 'Civil Engineering', 'departemnt.jpg', 4, '2000-01-01'),
(14, 'Mechanical Engineering', 'departemnt.jpg', 4, '2000-01-01'),
(15, 'Architecture', 'departemnt.jpg', 4, '2000-01-01'),
(16, 'Law', 'departemnt.jpg', 5, '2000-01-01'),
(17, 'Medicine', 'departemnt.jpg', 6, '2000-01-01'),
(18, 'Pharmacy', 'departemnt.jpg', 7, '2000-01-01'),
(19, 'Sociology', 'departemnt.jpg', 8, '2000-01-01'),
(20, 'Political Science', 'departemnt.jpg', 8, '2000-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `events_id` int(3) NOT NULL,
  `events_type` varchar(100) NOT NULL,
  `events_hedline` varchar(150) NOT NULL,
  `events_dsc` text NOT NULL,
  `events_image` varchar(150) NOT NULL,
  `events_date` date NOT NULL,
  `events_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`events_id`, `events_type`, `events_hedline`, `events_dsc`, `events_image`, `events_date`, `events_time`, `end_time`, `location`) VALUES
(1, 'ict', 'Annual Convocation 2023', 'The university will hold its annual convocation ceremony', 'news1.jpg', '2023-12-15', '10:00:00', '10:50:00', 'Dhaka university'),
(2, 'happy holi', 'Science Fair 2023', 'Annual science fair showcasing student projects', 'news2.jpg', '2023-11-20', '09:00:00', '00:00:00', 'Rajshahi Collage'),
(3, 'eid ul fitar', 'Cultural Festival', 'Three-day cultural festival celebrating diversity', 'news3.jpg', '2023-10-25', '11:00:00', '11:20:00', 'Khulna University'),
(4, 'uid ul adza', 'Career Fair', 'Opportunity to meet potential employers', 'career-fair.jpg', '2023-11-10', '10:00:00', '00:00:00', 'ramazzan'),
(5, 'ict', 'Research Symposium', 'Presentation of faculty and student research', 'research-symposium.jpg', '2023-09-15', '09:30:00', '00:00:00', 'nobin '),
(6, 'seminar', 'Sports Week', 'Annual inter-department sports competition', 'sports-week.jpg', '2023-08-20', '08:00:00', '00:00:00', 'ict'),
(7, 'ict', 'Alumni Reunion', 'Gathering of university alumni', 'alumni-reunion.jpg', '2023-12-05', '18:00:00', '00:00:00', 'admission'),
(8, 'book fair', 'Book Fair', 'Annual book fair with publishers and authors', 'book-fair.jpg', '2023-07-25', '10:00:00', '00:00:00', ''),
(9, '', 'Startup Competition', 'Student startup pitch competition', 'startup-competition.jpg', '2023-10-15', '13:00:00', '00:00:00', ''),
(10, '', 'Debate Championship', 'Inter-university debate competition', 'debate-championship.jpg', '2023-09-05', '14:00:00', '00:00:00', ''),
(11, '', 'Art Exhibition', 'Exhibition of student artwork', 'art-exhibition.jpg', '2023-08-10', '11:00:00', '00:00:00', ''),
(12, '', 'Music Concert', 'Performance by university music club', 'music-concert.jpg', '2023-07-15', '18:00:00', '00:00:00', ''),
(13, '', 'International Conference on AI', 'Experts discuss latest in artificial intelligence', 'ai-conference.jpg', '2023-11-25', '09:00:00', '00:00:00', ''),
(14, '', 'Blood Donation Camp', 'University organizes blood donation drive', 'blood-donation.jpg', '2023-08-05', '10:00:00', '00:00:00', ''),
(15, '', 'Teacher\'s Day Celebration', 'Honoring faculty members', 'teachers-day.jpg', '2023-10-05', '15:00:00', '00:00:00', ''),
(16, '', 'Freshers\' Reception', 'Welcoming new students to campus', 'freshers-reception.jpg', '2023-09-01', '16:00:00', '00:00:00', ''),
(17, '', 'Independence Day Celebration', 'Celebrating national independence', 'independence-day.jpg', '2023-03-26', '08:00:00', '00:00:00', ''),
(18, '', 'Language Movement Day', 'Commemorating the language movement', 'language-movement.jpg', '2023-02-21', '08:00:00', '00:00:00', ''),
(19, '', 'Winter Carnival', 'Annual winter festival with food and games', 'winter-carnival.jpg', '2023-12-20', '11:00:00', '00:00:00', 'ru campus'),
(20, '', 'Graduation Ceremony', 'Celebrating graduating students', 'vc.jpg', '2023-12-10', '10:00:00', '00:00:00', 'Rajshahi collage'),
(22, 'ict', 'upcoming events cheack headline ', 'upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming', 'vc.jpg', '2026-04-01', '11:00:00', '20:06:41', 'Dhaka '),
(23, 'ict', 'upcoming events cheack headline ', 'upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline ', 'vc.jpg', '2026-04-01', '11:00:00', '20:06:41', 'Dhaka '),
(24, 'admission', 'upcoming Admission events cheack headline ', 'upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline upcoming events cheack headline ', 'vc.jpg', '2026-04-01', '11:00:00', '20:06:41', 'Dhaka ');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `facilities_id` int(3) NOT NULL,
  `facilities_name` varchar(150) NOT NULL,
  `facilities_image` varchar(150) NOT NULL,
  `facilities_details` text NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`facilities_id`, `facilities_name`, `facilities_image`, `facilities_details`, `start_date`) VALUES
(1, 'Central Library', 'library.jpg', 'Four-story library with 500,000+ books, digital resources, and 24/7 study areas', '2015-06-15'),
(2, 'Computer Science Lab', 'cs_lab.jpg', 'State-of-the-art computing lab with 100 workstations and high-performance servers', '2018-03-01'),
(3, 'Sports Complex', 'sports_complex.jpg', 'Olympic-sized swimming pool, indoor basketball courts, and fitness center', '2016-11-20'),
(4, 'Medical Center', 'medical_center.jpg', '24-hour campus health facility with doctors and emergency services', '2014-01-10'),
(5, 'Auditorium', 'auditorium.jpg', '1000-seat auditorium with advanced audio-visual equipment', '2017-09-05'),
(6, 'Research Center', 'research_center.jpg', 'Interdisciplinary research facility with specialized laboratories', '2019-05-12'),
(7, 'Student Cafeteria', 'cafeteria.jpg', 'Modern dining facility serving 3000+ meals daily', '2015-08-25'),
(8, 'Engineering Workshop', 'engineering_workshop.jpg', 'Fully equipped workshop for mechanical and electrical engineering students', '2016-02-18'),
(9, 'Art Gallery', 'art_gallery.jpg', 'Exhibition space for student and faculty artwork', '2018-07-30'),
(10, 'Dormitory A', 'dormitory_a.jpg', 'Residence hall with 500 single rooms and common facilities', '2014-10-15'),
(11, 'Biotechnology Lab', 'biotech_lab.jpg', 'BSL-2 certified laboratory for advanced biological research', '2020-01-22'),
(12, 'Language Center', 'language_center.jpg', 'Digital language labs and cultural exchange programs', '2017-04-10'),
(13, 'Career Services', 'career_services.jpg', 'Career counseling and job placement assistance center', '2015-03-05'),
(14, 'Greenhouse', 'greenhouse.jpg', 'Botanical research facility with rare plant species', '2019-08-14'),
(15, 'Robotics Lab', 'robotics_lab.jpg', 'Advanced robotics and AI research facility', '2021-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(3) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `faculty_image` varchar(150) NOT NULL,
  `faculty_start_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `faculty_image`, `faculty_start_date`) VALUES
(1, 'Faculty of Science', 'library.jpg', '2000-01-01'),
(2, 'Faculty of Arts', 'library.jpg', '2000-01-01'),
(3, 'Faculty of Business Studies', 'library.jpg', '2000-01-01'),
(4, 'Faculty of Engineering', 'library.jpg', '2000-01-01'),
(5, 'Faculty of Law', 'library.jpg', '2000-01-01'),
(6, 'Faculty of Medicine', 'library.jpg', '2000-01-01'),
(7, 'Faculty of Pharmacy', 'library.jpg', '2000-01-01'),
(8, 'Faculty of Social Science', 'library.jpg', '2000-01-01'),
(9, 'Faculty of Biological Science', 'library.jpg', '2000-01-01'),
(10, 'Faculty of Fine Arts', 'library.jpg', '2000-01-01'),
(11, 'Faculty of Education', 'library.jpg', '2000-01-01'),
(12, 'Faculty of Architecture', 'library.jpg', '2000-01-01'),
(13, 'Faculty of Agriculture', 'library.jpg', '2000-01-01'),
(14, 'Faculty of Environmental Science', 'library.jpg', '2000-01-01'),
(15, 'Faculty of Marine Science', 'library.jpg', '2000-01-01'),
(16, 'Faculty of Information Technology', 'library.jpg', '2000-01-01'),
(17, 'Faculty of Economics', 'library.jpg', '2000-01-01'),
(18, 'Faculty of Public Health', 'library.jpg', '2000-01-01'),
(19, 'Faculty of Development Studies', 'library.jpg', '2000-01-01'),
(20, 'Faculty of International Relations', 'library.jpg', '2000-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(11) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `institute_image` varchar(150) DEFAULT NULL,
  `institute_url` varchar(150) DEFAULT NULL,
  `institute_type` enum('affiliated collage','international affairs') DEFAULT NULL,
  `start_date` year(4) DEFAULT NULL,
  `end_date` year(4) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `institute_name`, `institute_image`, `institute_url`, `institute_type`, `start_date`, `end_date`, `status`) VALUES
(1, 'Dhaka College Affiliated Campus', 'dhaka_college.jpg', 'https://www.dhakacollege.edu.bd', 'affiliated collage', '0000', NULL, '1'),
(2, 'Notre Dame College Extension', 'notre_dame.jpg', 'https://www.ndc.edu.bd', 'affiliated collage', '1950', NULL, '1'),
(3, 'University of Dhaka International Program', 'du_international.jpg', 'https://www.du.ac.bd/international', 'international affairs', '2005', NULL, '1'),
(4, 'BUET Global Partnerships', 'buet_global.jpg', 'https://www.buet.ac.bd/global', 'international affairs', '2010', NULL, '1'),
(5, 'North South University Affiliated College', 'nsu_college.jpg', 'https://college.northsouth.edu', 'affiliated collage', '2000', NULL, '1'),
(6, 'BRAC University International Office', 'brac_international.jpg', 'https://www.bracu.ac.bd/international', 'international affairs', '2008', NULL, '1'),
(7, 'Chittagong College Affiliated Center', 'chittagong_college.jpg', 'https://www.cc.edu.bd', 'affiliated collage', '1960', NULL, '1'),
(8, 'Rajshahi University Global Affairs', 'ru_international.jpg', 'https://www.ru.ac.bd/international', 'international affairs', '2012', NULL, '1'),
(9, 'Jahangirnagar University Extension Campus', 'ju_extension.jpg', 'https://www.juniv.edu/extension', 'affiliated collage', '1995', NULL, '1'),
(10, 'Khulna University International Programs', 'ku_global.jpg', 'https://www.ku.ac.bd/international', 'international affairs', '2015', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(3) NOT NULL,
  `news_type` varchar(100) NOT NULL,
  `news_hedline` varchar(150) NOT NULL,
  `news_dsc` text NOT NULL,
  `news_image` varchar(150) NOT NULL,
  `news_date` date NOT NULL,
  `news_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_type`, `news_hedline`, `news_dsc`, `news_image`, `news_date`, `news_time`) VALUES
(1, 'admission', 'University ranks top in national ranking', 'The university has been ranked first in the latest national university rankings.The university has been ranked first in the latest national university rankings.The university has been ranked first in  the latest national university rankings. The university has been ranked first in the latest national university rankings.The university has been ranked first in the latest national university rankings.The university has been ranked first in  the latest national university rankings.', 'news3.jpg', '2023-06-15', '10:00:00'),
(2, 'ict', 'New research grant awarded', 'University receives $2M grant for climate change research. University receives $2M grant for climate change research.University receives $2M grant for climate change research.University receives $2M grant for climate change research.University receives $2M grant for climate change research.', 'news3.jpg', '2023-06-10', '09:00:00'),
(3, 'scholarship', 'New academic programs launched', 'Three new undergraduate programs introduced.Three new undergraduate programs introduced.Three new undergraduate programs introduced.Three new undergraduate programs introduced.Three new undergraduate programs introduced.Three new undergraduate programs introduced.Three new undergraduate programs introduced.', 'news3.jpg', '2023-05-25', '11:00:00'),
(4, 'ict', 'International collaboration signed', 'Agreement with foreign university for student exchange', 'news3.jpg', '2023-05-20', '10:00:00'),
(5, 'exam', 'Campus expansion announced', 'New academic buildings to be constructed', 'news3.jpg', '2023-05-15', '09:30:00'),
(6, 'admission', 'Student wins international competition', 'Computer science student wins hackathon', 'news3.jpg', '2023-05-10', '08:00:00'),
(7, 'ict', 'Faculty member receives prestigious award', 'Professor recognized for outstanding research', 'news3.jpg', '2023-05-05', '18:00:00'),
(8, 'admission', 'University library digitizes rare collection', 'Historical documents now available online', 'news3.jpg', '2023-04-25', '10:00:00'),
(9, 'scholarship', 'New sports complex inaugurated', 'State-of-the-art facility opened for students', 'news3.jpg', '2023-04-15', '13:00:00'),
(10, 'admission', 'Alumni donate for scholarship fund', 'Generous donation to support needy students', 'news3.jpg', '2023-04-05', '14:00:00'),
(11, 'carcular', 'University launches online courses', 'New platform for distance learning', 'news3.jpg', '2023-03-25', '11:00:00'),
(12, 'admission', 'Annual research conference held', 'Faculty and students present research findings', 'news3.jpg', '2023-03-15', '18:00:00'),
(13, '', 'New student dormitories opened', 'Additional housing for increasing student population', 'news3.jpg', '2023-03-05', '09:00:00'),
(14, '', 'University signs industry partnership', 'Collaboration with leading tech company', 'news3.jpg', '2023-02-25', '10:00:00'),
(15, '', 'Campus sustainability initiative', 'University commits to carbon neutrality by 2030', 'news3.jpg', '2023-02-15', '15:00:00'),
(16, '', 'New health center opens', 'Expanded medical facilities for students', 'news3.jpg', '2023-02-05', '16:00:00'),
(17, '', 'Student entrepreneurship program', 'New incubator for student startups', 'news3.jpg', '2023-01-25', '08:00:00'),
(18, '', 'University celebrates golden jubilee', '50 years of academic excellence', 'news3.jpg', '2023-01-15', '08:00:00'),
(19, '', 'New cafeteria with diverse menu', 'Expanded dining options for students', 'cafeteria.jpg', '2023-01-05', '11:00:00'),
(20, '', 'Winter admission notice published', 'Application process for spring semester begins', 'admission-notice.jpg', '2022-12-20', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `professor_id` int(5) NOT NULL,
  `professor_name` varchar(100) NOT NULL,
  `professor_email` varchar(50) NOT NULL,
  `professor_number` int(11) NOT NULL,
  `professor_gender` varchar(50) NOT NULL,
  `professor_image` varchar(150) NOT NULL,
  `department_id` int(5) NOT NULL,
  `professor_type` enum('department head','professor','assistant professor','') NOT NULL DEFAULT 'professor',
  `welcome_msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor_id`, `professor_name`, `professor_email`, `professor_number`, `professor_gender`, `professor_image`, `department_id`, `professor_type`, `welcome_msg`) VALUES
(1, 'Prof. Dr. Mahmudul Hasan', 'mhasan@university.edu', 1712345800, 'Male', 'news2.jpg', 1, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(2, 'Prof. Dr. Abdul Karim', 'akarim@university.edu', 1712345801, 'Male', 'news2.jpg', 2, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(3, 'Prof. Dr. Farhana Islam', 'fislam@university.edu', 1712345802, 'Female', 'news2.jpg', 3, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(4, 'Prof. Dr. Rahim Uddin', 'ruddin@university.edu', 1712345803, 'Male', 'news2.jpg', 4, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(5, 'Prof. Dr. Sabrina Ahmed', 'sahmed@university.edu', 1712345804, 'Female', 'news2.jpg', 5, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(6, 'Prof. Dr. Jamal Uddin', 'juddin@university.edu', 1712345805, 'Male', 'news2.jpg', 6, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(7, 'Prof. Dr. Tahmina Akter', 'takter@university.edu', 1712345806, 'Female', 'news2.jpg', 7, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(8, 'Prof. Dr. Arif Hossain', 'ahossain@university.edu', 1712345807, 'Male', 'news2.jpg', 8, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(9, 'Prof. Dr. Sharmin Akter', 'sakter@university.edu', 1712345808, 'Female', 'news2.jpg', 9, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(10, 'Prof. Dr. Sajjad Hossain', 'shossain@university.edu', 1712345809, 'Male', 'news2.jpg', 10, 'department head', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(11, 'Prof. Dr. Nabila Rahman', 'nrahman@university.edu', 1712345810, 'Female', 'news2.jpg', 11, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(12, 'Prof. Dr. Faisal Mahmud', 'fmahmud@university.edu', 1712345811, 'Male', 'news2.jpg', 12, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(13, 'Prof. Dr. Jannatul Ferdous', 'jferdous@university.edu', 1712345812, 'Female', 'news2.jpg', 13, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(14, 'Prof. Dr. Tariqul Islam', 'tislam@university.edu', 1712345813, 'Male', 'news2.jpg', 14, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(15, 'Prof. Dr. Nasrin Akter', 'nakter@university.edu', 1712345814, 'Female', 'news2.jpg', 15, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(16, 'Prof. Dr. Kamal Hossain', 'khossain@university.edu', 1712345815, 'Male', 'news2.jpg', 16, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(17, 'Prof. Dr. Ayesha Siddika', 'asiddika@university.edu', 1712345816, 'Female', 'news2.jpg', 17, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(18, 'Prof. Dr. Hasan Mahmud', 'hmahmud@university.edu', 1712345817, 'Male', 'news2.jpg', 18, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(19, 'Prof. Dr. Nusrat Jahan', 'njahan@university.edu', 1712345818, 'Female', 'news2.jpg', 19, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.'),
(20, 'Prof. Dr. Ahmed Khan', 'akhan@university.edu', 1712345819, 'Male', 'news2.jpg', 20, 'professor', 'The Faculty of Arts of Rajshahi University started its journey along with the establishment of the university itself in 1953. Professor Dr. Muhammad Shahidullah was appointed the first Dean of the faculty in 1955. Initially the faculty comprised seven departments. These departments were Bangla, English, Philosophy, History, Islamic History, Psychology and Commerce. But currently it has emerged as the biggest faculty consisting of as many as twelve departments.');

-- --------------------------------------------------------

--
-- Table structure for table `professor_education`
--

CREATE TABLE `professor_education` (
  `id` int(11) NOT NULL,
  `professor_id` int(3) NOT NULL,
  `degree` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `year_of_passing` year(4) DEFAULT NULL,
  `end_year` year(4) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor_education`
--

INSERT INTO `professor_education` (`id`, `professor_id`, `degree`, `subject`, `institution`, `year_of_passing`, `end_year`, `result`, `remarks`) VALUES
(1, 1, 'PhD', 'Computer Science', 'Massachusetts Institute of Technology', '2015', NULL, '4.0/4.0', 'Dissertation on Machine Learning Algorithms'),
(2, 1, 'MSc', 'Computer Engineering', 'Stanford University', '2010', '2012', '3.9/4.0', 'Specialization in AI'),
(3, 2, 'PhD', 'Physics', 'University of Cambridge', '2008', '2012', 'First Class', 'Quantum Mechanics Research'),
(4, 2, 'BSc', 'Physics', 'University of Dhaka', '2002', '2006', '3.8/4.0', 'Gold Medalist'),
(5, 3, 'PhD', 'Economics', 'Harvard University', '2013', NULL, '3.95/4.0', 'Current Professor'),
(6, 3, 'MA', 'Econometrics', 'London School of Economics', '2008', '2010', 'Distinction', 'Thesis Award'),
(7, 4, 'PhD', 'Mathematics', 'Princeton University', '2010', '2014', '4.0/4.0', 'Number Theory'),
(8, 4, 'MS', 'Applied Mathematics', 'ETH Zurich', '2006', '2008', '5.5/6.0', 'Swiss Scholarship'),
(9, 5, 'PhD', 'Chemistry', 'California Institute of Technology', '2012', NULL, '3.9/4.0', 'Nano-technology Research'),
(10, 5, 'BSc', 'Chemistry', 'Bangladesh University of Engineering and Technology', '2004', '2008', '3.7/4.0', 'Summa Cum Laude'),
(11, 6, 'PhD', 'Biochemistry', 'University of Oxford', '2011', '2015', '4.0/4.0', 'Molecular Biology'),
(12, 6, 'MPhil', 'Biotechnology', 'University of Cambridge', '2007', '2009', 'Merit', 'Research Fellowship'),
(13, 7, 'PhD', 'Electrical Engineering', 'Georgia Institute of Technology', '2014', NULL, '3.8/4.0', 'Power Systems'),
(14, 7, 'MEng', 'Electrical Engineering', 'University of Tokyo', '2010', '2012', 'A+', 'Monbukagakusho Scholar'),
(15, 8, 'PhD', 'Mechanical Engineering', 'University of Michigan', '2009', '2013', '4.0/4.0', 'Robotics'),
(16, 8, 'BS', 'Mechanical Engineering', 'Indian Institute of Technology', '2003', '2007', '8.5/10.0', 'Institute Rank 5'),
(17, 9, 'PhD', 'Political Science', 'Yale University', '2012', NULL, '3.7/4.0', 'International Relations'),
(18, 9, 'BA', 'Political Science', 'University of Delhi', '2005', '2009', 'First Division', 'University Topper'),
(19, 10, 'PhD', 'Environmental Science', 'Stanford University', '2013', '2017', '3.9/4.0', 'Climate Change'),
(20, 10, 'MSc', 'Environmental Engineering', 'University of California, Berkeley', '2009', '2011', '3.8/4.0', 'NSF Fellowship');

-- --------------------------------------------------------

--
-- Table structure for table `professor_login`
--

CREATE TABLE `professor_login` (
  `professor_id` int(10) NOT NULL,
  `professor_name` varchar(100) NOT NULL,
  `professor_email` varchar(50) NOT NULL,
  `professor_pass` varchar(255) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor_login`
--

INSERT INTO `professor_login` (`professor_id`, `professor_name`, `professor_email`, `professor_pass`, `last_update`) VALUES
(1, 'mamun', 'mamun@gmail.com', '1230', '2025-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `professor_work`
--

CREATE TABLE `professor_work` (
  `id` int(11) NOT NULL,
  `professor_id` int(3) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `start_work` year(4) DEFAULT NULL,
  `end_work` year(4) DEFAULT NULL,
  `currently_working` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor_work`
--

INSERT INTO `professor_work` (`id`, `professor_id`, `subject`, `institution`, `start_work`, `end_work`, `currently_working`) VALUES
(1, 1, 'Computer Science', 'Massachusetts Institute of Technology', '2015', NULL, '1'),
(2, 1, 'Artificial Intelligence', 'Stanford University', '2012', '2015', '0'),
(3, 2, 'Quantum Physics', 'University of Cambridge', '2012', '2018', '0'),
(4, 2, 'Theoretical Physics', 'University of Dhaka', '2006', '2012', '0'),
(5, 3, 'Econometrics', 'Harvard University', '2013', NULL, '1'),
(6, 3, 'Development Economics', 'World Bank', '2010', '2013', '0'),
(7, 4, 'Number Theory', 'Princeton University', '2014', '2020', '0'),
(8, 4, 'Applied Mathematics', 'ETH Zurich', '2008', '2014', '0'),
(9, 5, 'Nanotechnology', 'California Institute of Technology', '2012', NULL, '1'),
(10, 5, 'Organic Chemistry', 'Bangladesh University of Engineering and Technology', '2008', '2012', '0'),
(11, 6, 'Molecular Biology', 'University of Oxford', '2015', '2021', '0'),
(12, 6, 'Biotechnology', 'University of Cambridge', '2009', '2015', '0'),
(13, 7, 'Power Systems', 'Georgia Institute of Technology', '2014', NULL, '1'),
(14, 7, 'Renewable Energy', 'University of Tokyo', '2012', '2014', '0'),
(15, 8, 'Robotics', 'University of Michigan', '2013', '2019', '0'),
(16, 8, 'Automotive Engineering', 'Indian Institute of Technology', '2007', '2013', '0'),
(17, 9, 'International Relations', 'Yale University', '2012', NULL, '1'),
(18, 9, 'Political Theory', 'University of Delhi', '2009', '2012', '0'),
(19, 10, 'Climate Change', 'Stanford University', '2017', '2022', '0'),
(20, 10, 'Environmental Policy', 'University of California, Berkeley', '2011', '2017', '0');

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE `student_login` (
  `student_id` int(10) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_pass` varchar(255) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_login`
--

INSERT INTO `student_login` (`student_id`, `student_name`, `student_email`, `student_pass`, `last_update`) VALUES
(1, 'mamun', 'mamun@gmail.com', '1230', '2025-05-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic`
--
ALTER TABLE `academic`
  ADD PRIMARY KEY (`academic_id`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`administrator_id`);

--
-- Indexes for table `administrator_education`
--
ALTER TABLE `administrator_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `administrator_id` (`administrator_id`);

--
-- Indexes for table `administrator_login`
--
ALTER TABLE `administrator_login`
  ADD PRIMARY KEY (`administrator_id`);

--
-- Indexes for table `admission_news`
--
ALTER TABLE `admission_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campus_media`
--
ALTER TABLE `campus_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dean`
--
ALTER TABLE `dean`
  ADD PRIMARY KEY (`dean_id`);

--
-- Indexes for table `dean_education`
--
ALTER TABLE `dean_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dean_id` (`dean_id`);

--
-- Indexes for table `dean_login`
--
ALTER TABLE `dean_login`
  ADD PRIMARY KEY (`dean_id`);

--
-- Indexes for table `dean_work`
--
ALTER TABLE `dean_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dean_id` (`dean_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`facilities_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor_id`);

--
-- Indexes for table `professor_education`
--
ALTER TABLE `professor_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `professor_login`
--
ALTER TABLE `professor_login`
  ADD PRIMARY KEY (`professor_id`);

--
-- Indexes for table `professor_work`
--
ALTER TABLE `professor_work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `student_login`
--
ALTER TABLE `student_login`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic`
--
ALTER TABLE `academic`
  MODIFY `academic_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `administrator_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `administrator_education`
--
ALTER TABLE `administrator_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `administrator_login`
--
ALTER TABLE `administrator_login`
  MODIFY `administrator_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_news`
--
ALTER TABLE `admission_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campus_media`
--
ALTER TABLE `campus_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dean`
--
ALTER TABLE `dean`
  MODIFY `dean_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dean_education`
--
ALTER TABLE `dean_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dean_login`
--
ALTER TABLE `dean_login`
  MODIFY `dean_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dean_work`
--
ALTER TABLE `dean_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `events_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `facilities_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `professor_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `professor_education`
--
ALTER TABLE `professor_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `professor_login`
--
ALTER TABLE `professor_login`
  MODIFY `professor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor_work`
--
ALTER TABLE `professor_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_login`
--
ALTER TABLE `student_login`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
