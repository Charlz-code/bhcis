-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2026 at 10:49 PM
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
-- Database: `bhcis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `child_information`
--

CREATE TABLE `child_information` (
  `information_id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `sex` enum('M','F') DEFAULT NULL,
  `birth_length` decimal(5,2) DEFAULT NULL,
  `birth_weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_lookup`
--

CREATE TABLE `complaint_lookup` (
  `chief_complaint_id` int(11) NOT NULL,
  `complaint` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultation_record`
--

CREATE TABLE `consultation_record` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `visit_type_id` int(11) DEFAULT NULL,
  `transaction_type_id` int(11) DEFAULT NULL,
  `date_of_consultation` date DEFAULT NULL,
  `consultation_time` time DEFAULT NULL,
  `name_of_attending_provider` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation_record`
--

INSERT INTO `consultation_record` (`record_id`, `patient_id`, `worker_id`, `visit_type_id`, `transaction_type_id`, `date_of_consultation`, `consultation_time`, `name_of_attending_provider`) VALUES
(1, 1, 2, 2, 1, '2026-01-30', NULL, 'Marlyn Achas');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_lookup`
--

CREATE TABLE `diagnosis_lookup` (
  `icd_code` varchar(10) DEFAULT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis_name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnosis_lookup`
--

INSERT INTO `diagnosis_lookup` (`icd_code`, `diagnosis_id`, `diagnosis_name`, `category`) VALUES
('I10', 1, 'Essential (primary) hypertension', 'Cardiovascular'),
('I21.9', 2, 'Acute myocardial infarction, unspecified', 'Cardiovascular'),
('I63.9', 3, 'Cerebral infarction (Stroke)', 'Cardiovascular'),
('I50.0', 4, 'Congestive heart failure', 'Cardiovascular'),
('I48.91', 5, 'Atrial fibrillation', 'Cardiovascular'),
('I09.9', 6, 'Rheumatic heart disease', 'Cardiovascular'),
('A97.0', 7, 'Dengue fever without warning signs', 'Infectious'),
('A97.1', 8, 'Dengue fever with warning signs', 'Infectious'),
('A97.2', 9, 'Severe dengue', 'Infectious'),
('A15.0', 10, 'Tuberculosis of lung, confirmed', 'Infectious'),
('A27.9', 11, 'Leptospirosis, unspecified', 'Infectious'),
('A01.0', 12, 'Typhoid fever', 'Infectious'),
('A06.0', 13, 'Acute amebic dysentery', 'Infectious'),
('A09.9', 14, 'Gastroenteritis (Infectious diarrhea)', 'Infectious'),
('B20', 15, 'HIV disease', 'Infectious'),
('B18.1', 16, 'Chronic viral hepatitis B', 'Infectious'),
('A82.9', 17, 'Rabies, unspecified', 'Infectious'),
('B05.9', 18, 'Measles', 'Infectious'),
('B08.4', 19, 'Hand, foot and mouth disease (HFMD)', 'Infectious'),
('J18.9', 20, 'Pneumonia, unspecified organism', 'Respiratory'),
('J45.901', 21, 'Asthma with acute exacerbation', 'Respiratory'),
('J44.9', 22, 'Chronic obstructive pulmonary disease (COPD)', 'Respiratory'),
('J20.9', 23, 'Acute bronchitis', 'Respiratory'),
('J00', 24, 'Acute nasopharyngitis (Common cold)', 'Respiratory'),
('E11.9', 25, 'Type 2 diabetes mellitus without complications', 'Endocrine'),
('E11.22', 26, 'Type 2 diabetes with nephropathy', 'Endocrine'),
('E05.90', 27, 'Thyrotoxicosis (Hyperthyroidism)', 'Endocrine'),
('E03.9', 28, 'Hypothyroidism, unspecified', 'Endocrine'),
('D50.9', 29, 'Iron deficiency anemia', 'Hematology'),
('E78.5', 30, 'Hyperlipidemia (High cholesterol)', 'Metabolic'),
('E79.0', 31, 'Hyperuricemia (High uric acid)', 'Metabolic'),
('K21.9', 32, 'Gastro-esophageal reflux disease (GERD)', 'Gastrointestinal'),
('K35.80', 33, 'Acute appendicitis', 'Gastrointestinal'),
('K80.20', 34, 'Gallstones (Cholehithiasis)', 'Gastrointestinal'),
('K74.60', 35, 'Cirrhosis of liver', 'Gastrointestinal'),
('K76.0', 36, 'Fatty liver (NAFLD)', 'Gastrointestinal'),
('K40.90', 37, 'Inguinal hernia', 'Gastrointestinal'),
('N18.5', 38, 'Chronic kidney disease, stage 5', 'Renal'),
('N18.6', 39, 'End stage renal disease', 'Renal'),
('N20.0', 40, 'Kidney stones (Nephrolithiasis)', 'Renal'),
('N39.0', 41, 'Urinary tract infection (UTI)', 'Renal'),
('C50.91', 42, 'Malignant neoplasm of breast', 'Oncology'),
('C34.90', 43, 'Malignant neoplasm of lung', 'Oncology'),
('C18.9', 44, 'Malignant neoplasm of colon', 'Oncology'),
('C22.0', 45, 'Liver cell carcinoma', 'Oncology'),
('C53.9', 46, 'Malignant neoplasm of cervix', 'Oncology'),
('G40.909', 47, 'Epilepsy, unspecified', 'Neurological'),
('G43.909', 48, 'Migraine, unspecified', 'Neurological'),
('F32.9', 49, 'Major depressive disorder', 'Psychiatric'),
('F41.1', 50, 'Generalized anxiety disorder', 'Psychiatric'),
('L20.9', 51, 'Atopic dermatitis (Eczema)', 'Dermatology'),
('L40.9', 52, 'Psoriasis, unspecified', 'Dermatology'),
('M17.9', 53, 'Osteoarthritis of knee', 'Musculoskeletal'),
('M10.9', 54, 'Gout, unspecified', 'Musculoskeletal'),
('O14.90', 55, 'Pre-eclampsia', 'Obstetrics'),
('O24.419', 56, 'Gestational diabetes', 'Obstetrics'),
('T63.0', 57, 'Snake bite venom', 'Emergency'),
('A41.9', 58, 'Sepsis, unspecified', 'Emergency');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_record`
--

CREATE TABLE `diagnosis_record` (
  `diagnosis_record_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `diagnosis_id` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `date_diagnosed` date DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnosis_record`
--

INSERT INTO `diagnosis_record` (`diagnosis_record_id`, `patient_id`, `worker_id`, `diagnosis_id`, `record_id`, `date_diagnosed`, `remarks`) VALUES
(1, 1, 2, 12, 1, '2026-01-30', 'Please work');

-- --------------------------------------------------------

--
-- Table structure for table `gravidity_lookup`
--

CREATE TABLE `gravidity_lookup` (
  `gravidity_id` int(11) NOT NULL,
  `gravidity_label` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_worker`
--

CREATE TABLE `health_worker` (
  `worker_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_worker`
--

INSERT INTO `health_worker` (`worker_id`, `user_id`, `first_name`, `last_name`, `position`, `contact_number`) VALUES
(2, 2, 'Marlyn', 'Achas', 'Barangay Health Worker', '09764532364');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `household_id` int(11) NOT NULL,
  `family_id` varchar(50) DEFAULT NULL,
  `household_contact` varchar(50) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`household_id`, `family_id`, `household_contact`, `zone_id`) VALUES
(1, '1', '09924767396', 1);

-- --------------------------------------------------------

--
-- Table structure for table `immunization`
--

CREATE TABLE `immunization` (
  `immunization_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `vaccine_id` int(11) DEFAULT NULL,
  `dose_number` int(11) DEFAULT NULL,
  `date_administered` date DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_findings`
--

CREATE TABLE `laboratory_findings` (
  `finding_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `test_item` varchar(100) DEFAULT NULL,
  `result` varchar(100) DEFAULT NULL,
  `normal_value` varchar(50) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medication_treatment`
--

CREATE TABLE `medication_treatment` (
  `treatment_id` int(11) NOT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `frequency` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `provider_name` varchar(100) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medication_treatment`
--

INSERT INTO `medication_treatment` (`treatment_id`, `medicine_id`, `dosage`, `frequency`, `duration`, `additional_notes`, `provider_name`, `record_id`) VALUES
(1, 1, '500 mg', 'Every 6 hours', '5 days', 'After meals', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `medicine_name`, `description`, `expiration_date`) VALUES
(1, 'Paracetamol', 'Pain and fever reducer', '2027-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_transaction`
--

CREATE TABLE `mode_of_transaction` (
  `transaction_type_id` int(11) NOT NULL,
  `transaction_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mode_of_transaction`
--

INSERT INTO `mode_of_transaction` (`transaction_type_id`, `transaction_type`) VALUES
(1, 'Walk-in'),
(2, 'Visited'),
(3, 'Referral');

-- --------------------------------------------------------

--
-- Table structure for table `nature_of_visit`
--

CREATE TABLE `nature_of_visit` (
  `visit_type_id` int(11) NOT NULL,
  `visit_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nature_of_visit`
--

INSERT INTO `nature_of_visit` (`visit_type_id`, `visit_type`) VALUES
(1, 'New Consultation/Case'),
(2, 'New Admission'),
(3, 'Follow-up Visit');

-- --------------------------------------------------------

--
-- Table structure for table `parity_lookup`
--

CREATE TABLE `parity_lookup` (
  `parity_id` int(11) NOT NULL,
  `parity_label` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `residential_address` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `household_id` int(11) DEFAULT NULL,
  `patient_enrollment_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `first_name`, `last_name`, `middle_name`, `suffix`, `residential_address`, `date_of_birth`, `household_id`, `patient_enrollment_id`) VALUES
(1, 'Charles', 'Chavaria', 'Sabalbaro', NULL, 'Zone 1, Sta. Ana', '2004-11-13', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `penicillin_lookup`
--

CREATE TABLE `penicillin_lookup` (
  `penicillin_id` int(11) NOT NULL,
  `penicillin_given` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postpartum`
--

CREATE TABLE `postpartum` (
  `postpartum_id` int(11) NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `prenatal_record_id` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `date_postpartum_24hrs` date DEFAULT NULL,
  `date_postpartum_1week` date DEFAULT NULL,
  `danger_signs_mother` text DEFAULT NULL,
  `danger_signs_baby` text DEFAULT NULL,
  `date_vitamin_a_given` date DEFAULT NULL,
  `date_iron_given` date DEFAULT NULL,
  `number_of_iron_given` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prenatal_record`
--

CREATE TABLE `prenatal_record` (
  `prenatal_record_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `lmp` date DEFAULT NULL,
  `edc` date DEFAULT NULL,
  `aog` int(11) DEFAULT NULL,
  `gravidity_id` int(11) DEFAULT NULL,
  `parity_id` int(11) DEFAULT NULL,
  `syphilis_id` int(11) DEFAULT NULL,
  `penicillin_id` int(11) DEFAULT NULL,
  `fetal_heart_tone` varchar(50) DEFAULT NULL,
  `fundic_height` decimal(5,2) DEFAULT NULL,
  `schedule_of_next_visit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `syphilis_lookup`
--

CREATE TABLE `syphilis_lookup` (
  `syphilis_id` int(11) NOT NULL,
  `syphilis_result` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_admin`
--

CREATE TABLE `system_admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role_id`) VALUES
(1, 'admin', '$2a$12$doCL2pWn8XnMXD5rGz2lru5JWKfkuR79fZe4ReVFNF7YVGMZtYm3S', 'admin@bhcis.local', 1),
(2, 'achas', '$2a$12$7qdTc5V/zQBViHqwqqbKTe1Wr2/aEaxYapuhHHteCrAArqeyjJ4je', 'healthworker@bhcis.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(3, 'Auditor'),
(2, 'BHW');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_lookup`
--

CREATE TABLE `vaccine_lookup` (
  `vaccine_id` int(11) NOT NULL,
  `vaccine_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `vital_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `bp` varchar(20) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `temperature` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`vital_id`, `record_id`, `bp`, `weight`, `height`, `temperature`) VALUES
(2, 1, '120/80', 60.50, 165.00, 36.80);

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `zone_id` int(11) NOT NULL,
  `zone_number` varchar(20) DEFAULT NULL,
  `assigned_worker_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zone_id`, `zone_number`, `assigned_worker_id`) VALUES
(1, '1', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child_information`
--
ALTER TABLE `child_information`
  ADD PRIMARY KEY (`information_id`),
  ADD KEY `postpartum_id` (`postpartum_id`);

--
-- Indexes for table `complaint_lookup`
--
ALTER TABLE `complaint_lookup`
  ADD PRIMARY KEY (`chief_complaint_id`);

--
-- Indexes for table `consultation_record`
--
ALTER TABLE `consultation_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `visit_type_id` (`visit_type_id`),
  ADD KEY `transaction_type_id` (`transaction_type_id`),
  ADD KEY `idx_consult_patient` (`patient_id`),
  ADD KEY `idx_consult_date` (`date_of_consultation`),
  ADD KEY `idx_consult_worker` (`worker_id`),
  ADD KEY `idx_consult_patient_date` (`patient_id`,`date_of_consultation`);

--
-- Indexes for table `diagnosis_lookup`
--
ALTER TABLE `diagnosis_lookup`
  ADD PRIMARY KEY (`diagnosis_id`);

--
-- Indexes for table `diagnosis_record`
--
ALTER TABLE `diagnosis_record`
  ADD PRIMARY KEY (`diagnosis_record_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `diagnosis_id` (`diagnosis_id`),
  ADD KEY `record_id` (`record_id`),
  ADD KEY `idx_diagnosis_patient` (`patient_id`),
  ADD KEY `idx_diagnosis_date` (`date_diagnosed`),
  ADD KEY `idx_diagnosis_type` (`diagnosis_id`),
  ADD KEY `idx_diagnosis_date_type` (`date_diagnosed`,`diagnosis_id`);

--
-- Indexes for table `gravidity_lookup`
--
ALTER TABLE `gravidity_lookup`
  ADD PRIMARY KEY (`gravidity_id`);

--
-- Indexes for table `health_worker`
--
ALTER TABLE `health_worker`
  ADD PRIMARY KEY (`worker_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`household_id`),
  ADD KEY `zone_id` (`zone_id`),
  ADD KEY `idx_household_zone` (`zone_id`);

--
-- Indexes for table `immunization`
--
ALTER TABLE `immunization`
  ADD PRIMARY KEY (`immunization_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `record_id` (`record_id`),
  ADD KEY `vaccine_id` (`vaccine_id`),
  ADD KEY `idx_immun_patient` (`patient_id`),
  ADD KEY `idx_immun_vaccine` (`vaccine_id`),
  ADD KEY `idx_immun_date` (`date_administered`),
  ADD KEY `idx_immun_followup` (`follow_up_date`),
  ADD KEY `idx_immun_patient_vaccine` (`patient_id`,`vaccine_id`);

--
-- Indexes for table `laboratory_findings`
--
ALTER TABLE `laboratory_findings`
  ADD PRIMARY KEY (`finding_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `medication_treatment`
--
ALTER TABLE `medication_treatment`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `fk_med_treatment_record` (`record_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `mode_of_transaction`
--
ALTER TABLE `mode_of_transaction`
  ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `nature_of_visit`
--
ALTER TABLE `nature_of_visit`
  ADD PRIMARY KEY (`visit_type_id`);

--
-- Indexes for table `parity_lookup`
--
ALTER TABLE `parity_lookup`
  ADD PRIMARY KEY (`parity_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `household_id` (`household_id`),
  ADD KEY `idx_patient_lastname` (`last_name`),
  ADD KEY `idx_patient_enrollment` (`patient_enrollment_id`),
  ADD KEY `idx_patient_household` (`household_id`),
  ADD KEY `idx_patient_dob` (`date_of_birth`);

--
-- Indexes for table `penicillin_lookup`
--
ALTER TABLE `penicillin_lookup`
  ADD PRIMARY KEY (`penicillin_id`);

--
-- Indexes for table `postpartum`
--
ALTER TABLE `postpartum`
  ADD PRIMARY KEY (`postpartum_id`),
  ADD KEY `record_id` (`record_id`),
  ADD KEY `prenatal_record_id` (`prenatal_record_id`),
  ADD KEY `idx_postpartum_delivery` (`delivery_date`);

--
-- Indexes for table `prenatal_record`
--
ALTER TABLE `prenatal_record`
  ADD PRIMARY KEY (`prenatal_record_id`),
  ADD KEY `record_id` (`record_id`),
  ADD KEY `gravidity_id` (`gravidity_id`),
  ADD KEY `parity_id` (`parity_id`),
  ADD KEY `syphilis_id` (`syphilis_id`),
  ADD KEY `penicillin_id` (`penicillin_id`),
  ADD KEY `idx_prenatal_lmp` (`lmp`),
  ADD KEY `idx_prenatal_edc` (`edc`);

--
-- Indexes for table `syphilis_lookup`
--
ALTER TABLE `syphilis_lookup`
  ADD PRIMARY KEY (`syphilis_id`);

--
-- Indexes for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `idx_users_username` (`username`),
  ADD KEY `idx_users_role` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `vaccine_lookup`
--
ALTER TABLE `vaccine_lookup`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`vital_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`),
  ADD KEY `assigned_worker_id` (`assigned_worker_id`),
  ADD KEY `idx_zone_worker` (`assigned_worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child_information`
--
ALTER TABLE `child_information`
  MODIFY `information_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_lookup`
--
ALTER TABLE `complaint_lookup`
  MODIFY `chief_complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultation_record`
--
ALTER TABLE `consultation_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `diagnosis_lookup`
--
ALTER TABLE `diagnosis_lookup`
  MODIFY `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `diagnosis_record`
--
ALTER TABLE `diagnosis_record`
  MODIFY `diagnosis_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gravidity_lookup`
--
ALTER TABLE `gravidity_lookup`
  MODIFY `gravidity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_worker`
--
ALTER TABLE `health_worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization`
--
ALTER TABLE `immunization`
  MODIFY `immunization_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratory_findings`
--
ALTER TABLE `laboratory_findings`
  MODIFY `finding_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medication_treatment`
--
ALTER TABLE `medication_treatment`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mode_of_transaction`
--
ALTER TABLE `mode_of_transaction`
  MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nature_of_visit`
--
ALTER TABLE `nature_of_visit`
  MODIFY `visit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parity_lookup`
--
ALTER TABLE `parity_lookup`
  MODIFY `parity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penicillin_lookup`
--
ALTER TABLE `penicillin_lookup`
  MODIFY `penicillin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postpartum`
--
ALTER TABLE `postpartum`
  MODIFY `postpartum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prenatal_record`
--
ALTER TABLE `prenatal_record`
  MODIFY `prenatal_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `syphilis_lookup`
--
ALTER TABLE `syphilis_lookup`
  MODIFY `syphilis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_admin`
--
ALTER TABLE `system_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vaccine_lookup`
--
ALTER TABLE `vaccine_lookup`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `vital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `child_information`
--
ALTER TABLE `child_information`
  ADD CONSTRAINT `child_information_ibfk_1` FOREIGN KEY (`postpartum_id`) REFERENCES `postpartum` (`postpartum_id`);

--
-- Constraints for table `consultation_record`
--
ALTER TABLE `consultation_record`
  ADD CONSTRAINT `consultation_record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `consultation_record_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `health_worker` (`worker_id`),
  ADD CONSTRAINT `consultation_record_ibfk_4` FOREIGN KEY (`transaction_type_id`) REFERENCES `mode_of_transaction` (`transaction_type_id`),
  ADD CONSTRAINT `fk_consultation_nature` FOREIGN KEY (`visit_type_id`) REFERENCES `nature_of_visit` (`visit_type_id`);

--
-- Constraints for table `diagnosis_record`
--
ALTER TABLE `diagnosis_record`
  ADD CONSTRAINT `diagnosis_record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `diagnosis_record_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `health_worker` (`worker_id`),
  ADD CONSTRAINT `diagnosis_record_ibfk_3` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnosis_lookup` (`diagnosis_id`),
  ADD CONSTRAINT `diagnosis_record_ibfk_4` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`);

--
-- Constraints for table `health_worker`
--
ALTER TABLE `health_worker`
  ADD CONSTRAINT `health_worker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `household`
--
ALTER TABLE `household`
  ADD CONSTRAINT `household_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`zone_id`);

--
-- Constraints for table `immunization`
--
ALTER TABLE `immunization`
  ADD CONSTRAINT `immunization_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `immunization_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`),
  ADD CONSTRAINT `immunization_ibfk_3` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccine_lookup` (`vaccine_id`);

--
-- Constraints for table `laboratory_findings`
--
ALTER TABLE `laboratory_findings`
  ADD CONSTRAINT `laboratory_findings_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`);

--
-- Constraints for table `medication_treatment`
--
ALTER TABLE `medication_treatment`
  ADD CONSTRAINT `fk_med_treatment_record` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`),
  ADD CONSTRAINT `medication_treatment_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`household_id`) REFERENCES `household` (`household_id`);

--
-- Constraints for table `postpartum`
--
ALTER TABLE `postpartum`
  ADD CONSTRAINT `postpartum_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`),
  ADD CONSTRAINT `postpartum_ibfk_2` FOREIGN KEY (`prenatal_record_id`) REFERENCES `prenatal_record` (`prenatal_record_id`);

--
-- Constraints for table `prenatal_record`
--
ALTER TABLE `prenatal_record`
  ADD CONSTRAINT `prenatal_record_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`),
  ADD CONSTRAINT `prenatal_record_ibfk_2` FOREIGN KEY (`gravidity_id`) REFERENCES `gravidity_lookup` (`gravidity_id`),
  ADD CONSTRAINT `prenatal_record_ibfk_3` FOREIGN KEY (`parity_id`) REFERENCES `parity_lookup` (`parity_id`),
  ADD CONSTRAINT `prenatal_record_ibfk_4` FOREIGN KEY (`syphilis_id`) REFERENCES `syphilis_lookup` (`syphilis_id`),
  ADD CONSTRAINT `prenatal_record_ibfk_5` FOREIGN KEY (`penicillin_id`) REFERENCES `penicillin_lookup` (`penicillin_id`);

--
-- Constraints for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD CONSTRAINT `system_admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`);

--
-- Constraints for table `vitals`
--
ALTER TABLE `vitals`
  ADD CONSTRAINT `vitals_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `consultation_record` (`record_id`);

--
-- Constraints for table `zone`
--
ALTER TABLE `zone`
  ADD CONSTRAINT `zone_ibfk_1` FOREIGN KEY (`assigned_worker_id`) REFERENCES `health_worker` (`worker_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
