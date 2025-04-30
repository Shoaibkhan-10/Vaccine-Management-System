-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 02:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccine_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `user_id`, `child_id`, `hospital_id`, `vaccine_id`, `date`, `time`, `status`) VALUES
(74, 28, 39, 4, 12, '2025-02-17', '10:00:00', 'Pending'),
(75, 28, 40, 4, 12, '2025-02-18', '08:00:00', 'Pending'),
(76, 18, 41, 7, 17, '2025-02-18', '10:00:00', 'Pending'),
(77, 29, 42, 11, 15, '2025-02-21', '08:21:00', 'Pending'),
(78, 32, 43, 9, 20, '2025-02-20', '21:30:00', 'Pending'),
(79, 32, 44, 8, 18, '2025-02-28', '21:31:00', 'Pending'),
(80, 30, 45, 6, 14, '2025-03-10', '06:00:00', 'Pending'),
(81, 30, 46, 5, 13, '2025-03-15', '22:30:00', 'Pending'),
(82, 34, 47, 10, 19, '2025-03-03', '21:35:00', 'Pending'),
(83, 34, 48, 7, 12, '2025-02-25', '15:00:00', 'Pending'),
(84, 29, 49, 6, 15, '2025-02-17', '07:05:00', 'Rejected'),
(85, 29, 49, 6, 15, '2025-02-17', '07:05:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(4, 'Chickenpox	', 'Chickenpox, also known as varicella, is a highly contagious disease caused by varicella zoster virus, a member of the herpesvirus family. The disease results in a characteristic skin rash that forms small, itchy blisters, which eventually scab over. It us'),
(5, 'Dengue', 'Dengue (break-bone fever) is a viral infection that spreads from mosquitoes to people. It is more common in tropical and subtropical climates. Most people who get dengue won’t have symptoms. But for those that do, the most common symptoms are high fever, '),
(6, 'Flu', 'The flu virus, also known as influenza, is a contagious virus that infects the respiratory system. It can cause a range of symptoms, from mild to severe.  The flu is spread through droplets from coughs and sneezes.  The virus can live on hands and surface'),
(7, 'Hepatitis A	', 'Hepatitis A is an infectious disease of the liver caused by Hepatovirus A; it is a type of viral hepatitis. Many cases have few or no symptoms, especially in the young. The time between infection and symptoms, in those who develop them, is two–six weeks.'),
(8, 'Hepatitis B	', 'Hepatitis B virus (HBV) is a virus that infects the liver and can cause acute or chronic disease. It is a vaccine-preventable disease.  HBV is transmitted through contact with infected blood, semen, or other bodily fluids  It can be passed from mother to '),
(9, 'Polio', 'Poliovirus, the causative agent of polio, is a serotype of the species Enterovirus C, in the family of Picornaviridae. There are three poliovirus serotypes, numbered 1, 2, and 3. Poliovirus is composed of an RNA genome and a protein capsid.');

-- --------------------------------------------------------

--
-- Table structure for table `child_details`
--

CREATE TABLE `child_details` (
  `child_id` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `Birth_Form` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `child_image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_details`
--

INSERT INTO `child_details` (`child_id`, `DOB`, `child_name`, `blood_group`, `gender`, `Birth_Form`, `birth_certificate`, `child_image`, `user_id`) VALUES
(39, '2025-02-17', 'Asad', 'A+', 'Male', '184257', '20253847', '../admin/uploads-images/1739616862_child (10).jpg', 28),
(40, '2025-02-18', 'Aayat', 'B+', 'Female', '938472', '20255869', '../admin/uploads-images/1739617004_child (9).jpg', 28),
(41, '2025-02-18', 'Aayat', 'B+', 'Female', '938472', '20255869', '../admin/uploads-images/1739618294_child (9).jpg', 18),
(42, '2025-02-20', 'Meer Balaj', 'O-', 'Male', '501928', '20257381', '../admin/uploads-images/1739618406_child (15).jpg', 29),
(43, '2025-02-20', 'Bashir', 'AB+', 'Male', '673849', '20259902', '../admin/uploads-images/1739618524_child (8).jpg', 32),
(44, '2025-02-28', 'Dua', 'AB-', 'Female', '174357', '29253877', '../admin/uploads-images/1739618620_child (18).jpg', 32),
(45, '2025-03-10', 'Eman', 'O+', 'Female', '924772', '20906731', '../admin/uploads-images/1739618722_child (6).jpg', 30),
(46, '2025-03-15', 'Menahil', 'AB-', 'Female', '673889', '34656543', '../admin/uploads-images/1739618823_child (2).jpg', 30),
(47, '2025-03-03', 'Danish', 'B-', 'Male', '235975', '12769843', '../admin/uploads-images/1739618946_child (1).jpg', 34),
(48, '2025-02-25', 'Zainab', 'A+', 'Female', '946246', '90703416', '../admin/uploads-images/1739619017_child (11).jpg', 34),
(49, '2025-02-17', 'ali', 'A+', 'Male', '234532', '89075645', '../admin/uploads-images/1739626565_child (17).jpg', 29);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `hospital_name`, `location`, `contact`, `details`, `image`) VALUES
(4, 'Agha Khan University Hospital', 'Stadium Road,Karachi', '+92 21 3493 0051', 'The Aga Khan University Hospital in Karachi, established in 1985. Their vision is to provide premier, tertiary, referral health care facilities to the people of Pakistan.AKU\'s objective is to promote human welfare by disseminating knowledge and providing instruction, training, research and services in health sciences, education and other disciplines. AKU is a non-denominational institution open to all on merit, and admissions to its academic programmes are needs-blind. The University places special emphasis on the development of women. Through its high academic standards, programmes relevant to the needs of developing societies, its work as a dialogue partner with government on issues of health and education policy, and its delivery of critical social services, AKU has had a national impact in Pakistan. With the launch of academic programmes in East Africa, the United Kingdom, Syria and Afghanistan, AKU has now established itself as an international institution at ten sites in seven countries. AKU\'s Faculty of Health Sciences, comprising a Medical College and a School of Nursing, is located on the same campus in Karachi as Aga Khan University Hospital (AKUH). The Institute for Educational Development (AKUIED) is situated at another campus in Karachi, while the Institute for the Study of Muslim Civilisations (AKU-ISMC) is based in London. With the development of AKU-IED and AKU-ISMC, along with the planning of a Faculty of Arts and Sciences, AKU has moved towards becoming a comprehensive university.', 'agha_khan.jpg'),
(5, 'Liaquat National Hospital', 'National Stadium Road,Karachi', '+92-21 34413010', 'Welcome to Liaquat National Hospital! Every day thousands of people enter the gates of Liaquat National Hospital (LNH) seeking medical attention for themselves or their loved ones. With an undying commitment to excellence that meets international standards, regulations and quality systems, we make sure that the patient’s needs are met satisfactorily under a single roof. Liaquat National Hospital is located in the center of the bustling city of Karachi near the National Cricket Stadium. Owing to this unique location LNH has easy access from all quadrants of the city. LNH was conceived 60 years ago as a not-for-profit organization with a vision to provide quality healthcare at an affordable cost to all socioeconomic classes. Over the years, the hospital has evolved to become the largest tertiary care hospital in the country with more than 700 beds. We also have the largest number of ICU beds and ventilators in the city. The hospital excels in all facets of medicine, surgery, diagnostics and medical support services. LNH houses more than 35 specialties. Considering patient’s care as priority, we provide 24 hour emergency services, acute care, inpatient, outpatient and day care facilities not only to the city but also to patients from the far reaching corners of Sindh, Balochistan, Khyber Pakhtunkhwa and Punjab.', 'liaquat_national.png'),
(6, 'Dr. Ruth K . M. Pfau Civil Hospital', 'Opp: Allawala Market, M.A.Jinnah Road,Karach', '02199215740', 'The Civil Hospital Karachi Initially established in 1898 with 250 beds to provide basic health facilities, the hospital has expanded considerably and has been totally transformed over the years. Its 1900 beds are located in 34 departments, with over a dozen major operation theaters and a huge out patient’s attendance. Greater stress is being laid on public-private partnerships and preventive work notably in the Paediatrics department to avert unnecessary infant and child deaths due to pneumonia, malnutrition, diarrhea or vaccine-preventable illnesses. Measures are also in place to prevent and control major communicable diseases such as Tuberculosis, Malaria, viral Hepatitis B & C and HIV/AIDS, in addition to non-communicable diseases such as cardiovascular diseases, diabetes and cancers having a huge burden in Pakistan. Today as Karachi is a sprawling mega-city with a population estimated at 18 million divided into 18 major towns, the Civil Hospital Karachi lives on to tell two tales in the same city. The services of this tertiary care institution have kept in line with the latest technological advances as far as that is compatible with the situation in a low-income developing country. Sophisticated laboratory and radiographical procedures, investigations and examinations are performed totally free to benefit the poor patients attending the hospital. An average of two million out-patients report to the Hospital annually; 95% of which are non-affording patients entailing a huge cost on medicines, laboratory facilities and other logistics.', 'civil_hosp.jpg'),
(7, 'Dow University Hospital', 'Saddar,Karachi', '+ 922199232660', 'Dow University Hospital was established in the year 2009. It serves as a tertiary care University Hospital attached to Dow International Medical College for teaching and training of MBBS & Post-graduate students. The Dow hospital is a 5 story building, with large capacity of 1000 beds, fully equipped emergency room, spacious general wards, semi-private rooms, private rooms, an operation theater complex and labor rooms. It is also equipped with most modern facilities and units for treatment of surgical and medical problems, like the 12 bedded ICU and HDU, Nursery, Special Care Unit, Endoscopy Units, and the Liver Transplant Center. The hospital consists of Ultrasound, Echocardiography and pharmacy besides Seminar Rooms, a cafeteria, and the administrative departments. All types of routine and specialized surgeries are carried out by qualified and experienced surgeons of every specialty, including neurosurgery, cardiac surgery and even plastic surgery. The Intensive Care Unit (ICU) is also fully equipped with ventilators and other required equipment and monitors. High Dependency Unit (HDU) is meant for serious patients, not requiring ventilators. 10 dialysis machines are providing services till late night daily, separate machines are designated for Hepatitis B and C patients. A new dialysis lab has also been created to meet with demand for dialysis around the clock. A lab collection point is placed within the Dow Hospital to facilitate indoor and emergency patients, besides specialized collection centers all over the city, and interior of Sindh.	', 'dow_medical.jpg'),
(8, 'Patel Hospital', 'ST-18, Block 4, Gulshan-e-Iqbal,Karach', '0300568417', 'Patel Hospital is one of the prominent not-for-profit tertiary healthcare hospitals Comprising of more than 250 beds established to provide quality healthcare amenities to all at an affordable cost and Welfare Support to the under- privileged. The hospital is located in densely populated area of Karachi which provides services to millions of patients arriving from not only in Karachi but also from Interior Sindh, Baluchistan and KPK. Patel Hospital has been certified by the College of Physicians and Surgeons for post-graduate training and Pakistan Medical & Dental Council. In addition to that, the hospital is certified with ISO 9001-2015, RIQAS, CAP and PCP and has effectively accomplished the status of a tertiary healthcare & teaching hospital. At Patel Hospital we offer complete In-Patient and Out-Patient care through automated and advanced equipment, techniques, and a team of highly –skilled, qualified, and dedicated people who share its mission and values.	', 'patel_hosp.jpg'),
(9, 'Saifee Hospital', 'ST-1, Block-F, North Nazimabad, Near Chase Up Store, Karachi', '(021) 36789400', 'At Saifee Hospital, located in North Nazimabad, we are dedicated to your well-being. With a team of skilled professionals and advanced facilities, we provide compassionate, comprehensive care to support you on your health journey. Your wellness is our commitment, and we’re here to ensure you receive the quality healthcare you deserve.', 'saifee_hos.jpeg'),
(10, 'Ziauddin Hospital', '4/B Shahrah-e-Ghalib Rd, Block 6 Clifton, Karachi, Karachi City, Sindh', '(021) 111 942 942', 'Dr. Ziauddin Hospital Clifton is a purpose built hospital founded in 1999 as a state of the art facility providing exceptional patient care – a tradition which continues to this day. The hospital is known for its quality of treatment, expertise of doctors and technologically advanced services in health care.\r\n\r\nToday the Dr. Ziauddin Hospital Clifton Campus is equipped with 180 beds and treats around 700 admitted patients every month. Consultants at the Outpatient Clinics provide diagnostic and treatment services to about 200 patients every day.\r\n\r\nDr. Ziauddin Hospital Clifton campus is a comprehensive tertiary care facility. We understand how a comfortable environment can help in a patient’s recovery and therefore make the commitment of providing the highest quality of patient care everyday through expert doctors, dedicated nurses, and other patient care services.', 'ziauddinn.png'),
(11, 'Indus Hospital & Health', 'Plot C-76, Sector 31/5, Opposite، Crossing, Darussalam Society Sector 39 Korangi, Karachi, Karachi City, Sindh', '(021) 111 111 880', 'Indus Hospital & Health Network stands as a beacon of hope and healing in Pakistan, providing accessible, high-quality healthcare to all, regardless of their ability to pay. Through innovative approaches and community engagement, IHHN strives to uphold its vision of a healthier, more equitable society for all.', 'indus.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'hospital'),
(3, 'parent');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `profile_picture`, `role_id`) VALUES
(13, 'Admin', 'admin@admin.com', '$2y$10$Xy.9YX63kSz2qmrb3YuRse9IlEZDUdt2dYG8mlbylShHdDNx748Ia', '1738317192_doctors-1.jpg', 1),
(18, 'Rimsha Khan', 'rimsha@rimsha.com', '$2y$10$VrBRsMYmx9/fMq5y7yvw3eTSJW51OeMTk8TV9SYNU5CtkhsPyayju', 'testimonial-1.jpg', 3),
(28, 'Shoaib khan', 'shoaib@shoaib.com', '$2y$10$idFiYPH9BXNDa0nwqI2lo.utINjzIHZPY.LLl88AewqXORKCicAdu', 'testimonials-4.jpg', 3),
(29, 'Abdul Quddos', 'quddos@quddos.com', '$2y$10$EKrQSmfPevciqLB99.p0k.2/.GtFEiPzOHdb7gRj9.EUQ8y11PP4u', 'parent (15).jpg', 3),
(30, 'Munazza ', 'munazza@munazza.com', '$2y$10$VFjoEufsLQmS/Wxgdp4QNu4JFYxF477MsJ00UFDEhxuLCQAvVeDHW', 'parent (10).jpg', 3),
(32, 'Daniyal Inam', 'dani@dani.com', '$2y$10$gEAJXn14ONaLg8EimqUqCuCFqtFW8AEmnM3Ulunuol5hZiItR/N1O', 'parent (6).jpg', 3),
(33, 'Zeba Khan', 'zebi@gmail.com', '$2y$10$vmCk2bFLbqExLGQmQP95WOalaPx9DgmtmYX8kEZSu94B6BRcvhMMm', 'parent (5).jpg', 3),
(34, 'Bilal', 'bilal@bilal.com', '$2y$10$875tks7NGYRNHO0DVpEkH.L9QqMqdzjR9rtsfhsWnW4jwPwohK1si', 'parent (17).jpg', 3),
(35, 'hospital', 'hospital@hospital.com', '$2y$10$Gwc1p1kYvHaacEitdQn9k./gC10Nu7uoE4Gi5xWEtjX3N.xKXBXQK', 'Vaccine management2.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_records`
--

CREATE TABLE `vaccination_records` (
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `vaccine_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `vaccine_id` int(11) NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `vaccine_type` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `number_of_doses` int(11) NOT NULL,
  `availability` enum('Available','Unavailable') NOT NULL,
  `hospital_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`vaccine_id`, `vaccine_name`, `vaccine_type`, `category_id`, `number_of_doses`, `availability`, `hospital_id`) VALUES
(12, 'Novavax', '', 5, 7, 'Available', 4),
(13, 'CoronaVac', '', 4, 9, 'Available', 6),
(14, 'Pfizer', '', 9, 12, 'Available', 8),
(15, 'Varivax', '', 4, 5, 'Available', 8),
(16, 'Dengvaxia', '', 5, 4, 'Available', 9),
(17, 'Fluzone', '', 6, 3, 'Available', 6),
(18, 'Havrix', '', 7, 2, 'Available', 5),
(19, 'Engerix-B', '', 8, 2, 'Unavailable', 11),
(20, 'IPOL', '', 9, 6, 'Available', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id_fk` (`user_id`),
  ADD KEY `child_id_fk` (`child_id`),
  ADD KEY `hospital_id_fk` (`hospital_id`),
  ADD KEY `vaccine_id_fk` (`vaccine_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `child_details`
--
ALTER TABLE `child_details`
  ADD PRIMARY KEY (`child_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vaccination_records`
--
ALTER TABLE `vaccination_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`vaccine_id`),
  ADD KEY `category_id_fk` (`category_id`),
  ADD KEY `hospital_id_fk` (`hospital_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `child_details`
--
ALTER TABLE `child_details`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `vaccination_records`
--
ALTER TABLE `vaccination_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `child_details`
--
ALTER TABLE `child_details`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `vaccination_records`
--
ALTER TABLE `vaccination_records`
  ADD CONSTRAINT `vaccination_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `vaccination_records_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`);

--
-- Constraints for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD CONSTRAINT `category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `hospital_id_fk` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
