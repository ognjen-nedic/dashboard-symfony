-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2022 at 01:34 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universal_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `roles`, `password`) VALUES
(1, 'ognjen.nedic@universal.com', '[\"ROLE_ADMIN\"]', '$2y$13$IHujHplqt2CbpQ6CyJzOD.01LhmEnjP929P9z/0H/74Klxt/5jjp6');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_data` longtext COLLATE utf8mb4_unicode_ci,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_name`, `email`, `billing`, `payment_method`, `invoice_data`, `avatar_path`, `avatar_alt`) VALUES
(1, 'Jefferson Airplane', 'jefferson.airplane@universal.com', '4th Boulevard 666', 'Card', 'Payment by cash', 'clients/jefferson_airplane_1', NULL),
(2, 'Big Brother', 'big.brother@gmail.com', 'Address 345', 'Direct deposit', NULL, 'clients/big_brother_2', NULL),
(3, 'Roadhouse', 'roadhouse@gmail.com', 'End of Road 666', 'Cash', NULL, 'clients/roadhouse_3', NULL),
(4, 'Infostud', 'infostud@gmail.com', 'Galerija 3', 'Cash', NULL, 'clients/infostud_4', NULL),
(5, 'Alstek', 'info@alstek.com', 'Moše Tomića 6', 'Cash', NULL, 'clients/alstek_5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

DROP TABLE IF EXISTS `developer`;
CREATE TABLE IF NOT EXISTS `developer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptt` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `first_name`, `last_name`, `email`, `phone`, `street`, `city`, `ptt`, `country`, `password`, `bank_account`, `avatar_path`, `avatar_alt`, `roles`) VALUES
(1, 'Jim', 'Morrison', 'lizard.king@universal.com', '+381631596874', 'Love Street 8', 'Melbourne', 32901, 'Florida', '$2y$13$rg.pamW9ACBfaNI9jH0.suRq5mWMueXghQpqQA39awT7ylWQFrK1a', '170-30024659000-11', 'developers/jim_morrison_1', NULL, '[]'),
(2, 'Grace', 'Slick', 'white.alice@universal.com', '+381621588547', 'Tobacco Road 26', 'Highland Park', 60035, 'Illinois', '$2y$13$r/gIKd9unsR/fN5Lg/03neL2DvWJ6DiEK1pDwmMLCGTQWIURSoGk6', '265-25635779000-170', 'developers/grace_slick_2', NULL, '[]'),
(3, 'Roger', 'Waters', 'roger.waters@universal.com', '+381635987412', 'Pompeii Street 1', 'Great Bookham', 11375, 'United Kingdom', '$2y$13$W8pjzkcS65ThHyeVv3jHxO5R9sjgXNvL/g/UtxtaOVma9toM8uuE2', '321-984563710000-695', 'developers/roger_waters_3', NULL, '[]'),
(4, 'Mariska', 'Veres', 'shocking.you@universal.com', '+381635961203', 'Tobacco Road 56', 'Hague', 101500, 'Netherlands', '$2y$13$bV8s0Uy.K7wqDOPoBpRz4OAxZnmN47xOPKapu6kBAdl1ajppR8v2S', '321-25963014000-256', 'developers/mariska_veres_4', NULL, '[]'),
(5, 'George', 'Orwell', 'animal.farmer@universal.com', '+381631984000', 'Animal Farm 1984', 'London', 27917, 'United Kingdom', '$2y$13$ITJwgeSioqNJB8ZaE4dhXOBx9CXPLjLqXBlkFQJIz1DqRVSsBiOkK', '265-36981523000-999', 'developers/george_orwell_5', NULL, '[]'),
(6, 'Nick', 'Mason', 'nick.mason@universal.com', '+38163588547', 'Love Street 69', 'London', 101500, 'United Kingdom', '$2y$13$qiF6fUMi7jHgR7Iml4YBKuGcBFEDShF9I/vPrJnrujsObVEKibvw6', '321-96587423000-158', 'developers/nick_mason_6', NULL, '[]');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220509062932', '2022-05-09 06:29:48', 668),
('DoctrineMigrations\\Version20220509085215', '2022-05-09 08:53:08', 481);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `developer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `task_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_527EDB2519EB6921` (`client_id`),
  KEY `IDX_527EDB2564DD9267` (`developer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `client_id`, `developer_id`, `date`, `time`, `task_description`) VALUES
(1, 1, 2, '2022-05-10', '00:10:00', 'Update the address on the website.'),
(2, 2, 5, '2022-05-08', '00:20:00', 'Update routing system.'),
(3, 3, 1, '2022-05-11', '00:20:00', 'Clean the code.'),
(4, 1, 3, '2022-05-10', '00:10:00', 'Change hosting provider.'),
(5, 1, 2, '2022-05-10', '00:10:00', 'Repair engine'),
(6, 4, 2, '2022-05-13', '00:16:00', 'Change icons'),
(7, 3, 6, '2022-06-16', '00:10:00', 'Drop table'),
(8, 3, 1, '2022-04-15', '00:47:00', 'Let it roll, baby, roll'),
(9, 2, 1, '2022-05-11', '00:06:00', 'Light my fire'),
(10, 1, 1, '2022-05-14', '00:15:00', 'This is different');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB2519EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_527EDB2564DD9267` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
