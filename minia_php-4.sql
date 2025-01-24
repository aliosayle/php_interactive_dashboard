-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2025 at 11:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minia_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `bon`
--

CREATE TABLE `bon` (
  `id` char(36) NOT NULL,
  `autono` int(11) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `sequence_reference` varchar(100) DEFAULT NULL,
  `user_id` char(36) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `company_id` char(36) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `site_id` char(36) DEFAULT NULL,
  `date_of_bon` date NOT NULL,
  `total_one` decimal(18,4) NOT NULL,
  `total_two` decimal(18,4) DEFAULT NULL,
  `currency_one` varchar(10) NOT NULL,
  `currency_two` varchar(10) DEFAULT NULL,
  `amount_in_lettres` text NOT NULL,
  `beneficier_name` varchar(250) NOT NULL,
  `motif` varchar(100) NOT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `is_voided` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `autonumber` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bon`
--

INSERT INTO `bon` (`id`, `autono`, `reference`, `sequence_reference`, `user_id`, `username`, `company_id`, `company_name`, `site_id`, `date_of_bon`, `total_one`, `total_two`, `currency_one`, `currency_two`, `amount_in_lettres`, `beneficier_name`, `motif`, `account_number`, `is_voided`, `comments`, `autonumber`, `created_at`) VALUES
('13a05a98-d709-11ef-bead-0efd67b0fe78', 1081, '0000', '000', '000', '0000', 'be073b10-acba-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-20', 11.0000, 11.0000, 'USD', 'CF', 'onze USD\n### ### ###\nonze CF', 'Ali Osseili', '000', '000', 1, '000', 1, '2025-01-23 08:34:41'),
('15a3c4ca-d95b-11ef-bead-0efd67b0fe78', 1091, 'ACCH-3', '', '7', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '936d8e9e-af13-11ef-9eb4-0efd67b0fe78', '2025-01-23', 32452.0000, 0.0000, 'USD', 'CF', 'trente-deux mille, quatre cent cinquante-deux USD\n### ### ###\nzéro CF', 'adfgaf', 'aeth', 'afsh', 0, 'ahgdas', 29, '2025-01-23 08:34:41'),
('21f6585c-bc53-11ef-aadb-0efd67b0fe77', 1069, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2', 2, '2025-01-23 08:34:41'),
('21f6588e-bc53-11ef-aadb-0efd67b0fe77', 1071, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2', 3, '2025-01-23 08:34:41'),
('21f658f2-bc53-11ef-aadb-0efd67b0fe77', 1072, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 1, '2', 4, '2025-01-23 08:34:41'),
('21f659f6-bc53-11ef-aadb-0efd67b0fe77', 1073, '43', '34', '43', '43', '4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', 'asdfghstheshr', '9cefcce4-af17-11ef-9eb4-0efd67b0fe78', '2025-01-02', 43.0000, 43.0000, 'USD', 'USD', 'quarante-trois USD\n### ### ###\nquarante-trois USD', '43', '43', '34', 1, '43', 5, '2025-01-23 08:34:41'),
('21f65a3c-bc53-11ef-aadb-0efd67b0fe77', 1064, 'qwer', '435', '3245', 'qwer', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2024-12-23', 34.0000, 2345.0000, 'USD', 'CF', 'trente-quatre USD\n### ### ###\ndeux mille, trois cent quarante-cinq CF', '2345', '2345', '2345', 0, '2345234', 6, '2025-01-23 08:34:41'),
('274c412e-d8bc-11ef-bead-0efd67b0fe78', 1086, 'ttttttttt', 'ttttt', 'ttttt', 'ttttttt', 'be073b10-acba-11ef-9eb4-0efd67b0fe78', NULL, '273c514c-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 1342.0000, 0.0000, 'USD', 'CF', 'un mille, trois cent quarante-deux USD\n### ### ###\nzéro CF', 'tttt', 'tttt', 'ttttt', 1, 'ttttt', 7, '2025-01-23 08:34:41'),
('28c7179d-6d9d-4d9b-b053-e31c85e1e9a4', 1010, 'REF12354', 'SEQ12354', 'd7c5d5a2-4f7b-4e61-a8c9-9824fae9f5b4', 'tom_smith', '8c1d5626-d9e3-4969-b29b-2290c986f455', 'NextGen Tech', '1a9fd3fd-8a7e-4d4b-b35e-d1a15e43831f', '2024-11-20', 3000.0000, 500.0000, 'USD', 'ZAR', 'three thousand South African Rand', 'John Kriel', 'Payment for software installation', 'ACC006543210', 0, 'Payment successful', 8, '2025-01-23 08:34:41'),
('32b0a564-d8c1-11ef-bead-0efd67b0fe78', 1089, 'ACCH-1', 'sfdgsdf', 'asfgas', 'gserh', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '3bd48476-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-28', 356.0000, 5.0000, 'USD', 'CF', 'trois cent cinquante-six USD\n### ### ###\ncinq CF', 'asdf', 'asdf', 'asdfasfd', 1, 'asdfa', 27, '2025-01-23 08:34:41'),
('33066986-ae5a-11ef-9eb4-0efd67b0fe78', 1070, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2', 9, '2025-01-23 08:34:41'),
('33a28c96-d964-11ef-bead-0efd67b0fe78', 1101, 'ACCH-13', 'a', '7', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '936d8e9e-af13-11ef-9eb4-0efd67b0fe78', '2025-01-23', 64234.0000, 0.0000, 'USD', 'CF', 'soixante-quatre mille, deux cent trente-quatre USD\n### ### ###\nzéro CF', 'afdga', 'adhfda', 'arhaetr', 0, 'asfga', 40, '2025-01-23 08:34:41'),
('3db496c2-d962-11ef-bead-0efd67b0fe78', 1096, 'ACCH-8', 'asrha', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 4252.0000, 0.0000, 'USD', 'CF', 'quatre mille, deux cent cinquante-deux USD\n### ### ###\nzéro CF', 'arfhetj', 'asfha', 'asfha', 0, 'asfhaf', 35, '2025-01-23 08:34:41'),
('3eb38250-d966-11ef-bead-0efd67b0fe78', 1106, 'ACCH-18', 'qwer', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 34534.0000, 0.0000, 'USD', 'CF', 'trente-quatre mille, cinq cent trente-quatre USD\n### ### ###\nzéro CF', 'qewr', 'qwer', 'qwer', 0, 'qwerq', 45, '2025-01-23 08:44:23'),
('3f3dd160-d963-11ef-bead-0efd67b0fe78', 1100, 'ACCH-12', 'asdgas', '7', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 3452134.0000, 0.0000, 'USD', 'CF', 'trois million, quatre cent cinquante-deux mille, cent trente-quatre USD\n### ### ###\nzéro CF', 'asdf', 'asdg', 'asfgda', 0, 'ashdgasd', 39, '2025-01-23 08:34:41'),
('4b7a467b-e8b5-4df9-bd4f-c1b0fa3cc0e2', 1003, 'REF12347', 'SEQ12347', 'c99f8ac8-b345-4a67-a4d9-2d1f3e347c74', 'bob_white', '4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', 'Gamma Solutions', 'bd6f9be3-4070-4313-bb71-69d0d39ca34d', '2024-11-25', 100.0000, 500.0000, 'EUR', 'USD', 'ten thousand and five hundred British Pounds', 'Sarah Miller', 'Consulting fees for project', 'ACC007890345', 0, 'All payments processed successfully', 10, '2025-01-23 08:34:41'),
('4e6b8c47-c12a-4a9a-b839-2c1d416c2b7f', 1012, 'REF12356', 'SEQ12356', '6d5b4399-7f38-44f3-b801-cd82cbfba6b1', 'david_rose', 'f13cde1e-c25d-4a3b-8121-5420d3cd2e0b', 'Momentum Innovations', '2ad5b8e8-33e1-4417-8a3c-ec84a8481cb2', '2024-11-18', 1800.5000, 200.0000, 'USD', 'SEK', 'one thousand eight hundred Swedish Krona', 'Erik Svensson', 'Software solution payment', 'ACC004321098', 0, 'Processed successfully', 11, '2025-01-23 08:34:41'),
('63814062-d962-11ef-bead-0efd67b0fe78', 1097, 'ACCH-9', 'asdga', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 342.0000, 0.0000, 'USD', 'CF', 'trois cent quarante-deux USD\n### ### ###\nzéro CF', 'asfhsaf', 'asfha', 'wargw', 0, 'asg', 36, '2025-01-23 08:34:41'),
('71654618-d95f-11ef-bead-0efd67b0fe78', 1092, 'ACCH-4', '', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 4261.0000, 0.0000, 'USD', 'CF', 'quatre mille, deux cent soixante-un USD\n### ### ###\nzéro CF', 'SFGAS', 'ASDFGA', 'asdgsad', 0, 'GASDG', 30, '2025-01-23 08:34:41'),
('785a142e-af13-11ef-9eb4-0efd67b0fe78', 1074, 'ad', 'adsf', 'asdf', 'asdf', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', 'fgsdffds', '3af50892-acc4-11ef-9eb4-0efd67b0fe78', '2024-11-09', 234.0000, 1234.0000, 'USD', 'USD', 'deux cent trente-quatre USD\n### ### ###\nun mille, deux cent trente-quatre USD', 'asdf', 'asdf', 'asdf', 1, 'asdf', 12, '2025-01-23 08:34:41'),
('856660d6-d962-11ef-bead-0efd67b0fe78', 1098, 'ACCH-10', 'asfdgas', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '3bd48476-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 2425.0000, 0.0000, 'USD', 'CF', 'deux mille, quatre cent vingt-cinq USD\n### ### ###\nzéro CF', 'asfgas', 'asfg', 'fga', 0, 'asfhg', 37, '2025-01-23 08:34:41'),
('87928592-d8d6-11ef-bead-0efd67b0fe78', 1090, 'ACCH-2', 'asgdasdf', '7', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-22', 134.0000, 245.0000, 'USD', 'CF', 'cent trente-quatre USD\n### ### ###\ndeux cent quarante-cinq CF', 'asfgdasdf', 'asfhgasf', 'asfhgasfg', 0, 'asgasdgf', 28, '2025-01-23 08:34:41'),
('89190672-d965-11ef-bead-0efd67b0fe78', 1103, 'ACCH-15', 'asdf', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 3256.0000, 0.0000, 'USD', 'CF', 'trois mille, deux cent cinquante-six USD\n### ### ###\nzéro CF', 'asdf', 'asdf', 'asdfasd', 0, 'asdf', 42, '2025-01-23 08:39:18'),
('8c0a9c0e-d962-11ef-bead-0efd67b0fe78', 1099, 'ACCH-11', 'asfdgas', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '3bd48476-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 2425.0000, 0.0000, 'USD', 'CF', 'deux mille, quatre cent vingt-cinq USD\n### ### ###\nzéro CF', 'asfgas', 'asfg', 'fga', 0, 'asfhg', 38, '2025-01-23 08:34:41'),
('93e2705c-d965-11ef-bead-0efd67b0fe78', 1104, 'ACCH-16', 'asdf', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 3256.0000, 0.0000, 'USD', 'CF', 'trois mille, deux cent cinquante-six USD\n### ### ###\nzéro CF', 'asdf', 'asdf', 'asdfasd', 0, 'aaaaa', 43, '2025-01-23 08:39:36'),
('996cee22-d8bf-11ef-bead-0efd67b0fe78', 1087, '-1', 'asdfasd', 'asdfas', 'sdafasd', '4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-25', 45235632.0000, 0.0000, 'USD', 'CF', 'quarante-cinq million, deux cent trente-cinq mille, six cent trente-deux USD\n### ### ###\nzéro CF', 'sadfsa', 'asdf', 'dgasdg', 0, 'fasdfasdf', 25, '2025-01-23 08:34:41'),
('b10b8c86-ae59-11ef-9eb4-0efd67b0fe78', 1068, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2', 13, '2025-01-23 08:34:41'),
('bb0e27ab-6e8a-4a3a-80db-bc4368a7f76f', 1008, 'REF12352', 'SEQ12352', '65b98f72-01b2-4375-94d2-6fba10b7f0a4', 'george_black', '765a86e7-18e9-4d8e-b75e-94c65b4c925a', 'Advanced Solutions', 'b78825ca-9c78-4c4f-9b06-7a8a55a17a7f', '2024-11-22', 1500.5000, 100.0000, 'USD', 'MXN', 'one thousand five hundred Mexican Pesos', 'Carlos Ruiz', 'Consulting payment', 'ACC009234567', 0, 'Payment completed', 14, '2025-01-23 08:34:41'),
('be1e6e34-b477-4e41-9b7a-bb8fe0342469', 1011, 'REF12355', 'SEQ12355', 'f4e909c5-5996-4dbd-9f33-51f5ff30b5be', 'nina_yellow', 'f0c8b7e0-7317-48ba-b745-b924557b3f61', 'Elite Tech', '5a3186b5-9067-49b7-b579-6fbc39a87d29', '2024-11-19', 4000.5000, 300.0000, 'USD', 'EGP', 'four thousand Egyptian Pounds', 'Ahmed Maher', 'Payment for cloud hosting service', 'ACC003567890', 0, 'Payment has been processed', 15, '2025-01-23 08:34:41'),
('c138c5fa-d961-11ef-bead-0efd67b0fe78', 1093, 'ACCH-5', 'gasdgfa', '7', '', 'be073b10-acba-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 235623.0000, 0.0000, 'USD', 'CF', 'deux cent trente-cinq mille, six cent vingt-trois USD\n### ### ###\nzéro CF', 'dsgjhadg', 'afshad', 'asfg', 0, 'asfg', 32, '2025-01-23 08:34:41'),
('c1d4e58b-d432-44e1-94a0-5c423ccd4b44', 1002, 'REF12346', 'SEQ12346', '89f9ae13-56b2-4f53-bc39-c875a7b3df2d', 'emily_blue', 'a4dbe207-627b-4958-bfbb-2bffb5d0e3d0', 'Future Enterprises', 'c7386799-d3cf-45c5-9f8b-d18ac4fa1298', '2024-11-24', 3500.0000, 200.0000, 'USD', 'JPY', 'three thousand five hundred Japanese Yen', 'David Wilson', 'Product purchase payment', 'ACC009876543', 0, 'Processing successful', 16, '2025-01-23 08:34:41'),
('c2412d62-d8bb-11ef-bead-0efd67b0fe78', 1085, '11111', 'asgasdg', 'asgasd', 'asg', 'be073b10-acba-11ef-9eb4-0efd67b0fe78', NULL, '273c514c-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-22', 45233.0000, 0.0000, 'USD', 'CF', 'quarante-cinq mille, deux cent trente-trois USD\n### ### ###\nzéro CF', 'asdgashgwqrg', 'asdgfasdasdfasgasgasfgasdfasdfasfasdfsafasgasgasga', 'aasgasd', 0, 'test amount two', 17, '2025-01-23 08:34:41'),
('c750bd72-ae59-11ef-9eb4-0efd67b0fe78', 1069, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2', 18, '2025-01-23 08:34:41'),
('c9c8159a-ae5a-11ef-9eb4-0efd67b0fe78', 1071, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2', 19, '2025-01-23 08:34:41'),
('cd452b22-ae5a-11ef-9eb4-0efd67b0fe78', 1072, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 1, '2', 20, '2025-01-23 08:34:41'),
('ef9e3346-d58b-11ef-bead-0efd67b0fe78', 1075, 'AAAA!', '1111A', '1111', 'aliosayle', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', 'Afrifood', '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-18', 100.0000, 50000.0000, 'USD', 'CF', 'cent USD\n### ### ###\ncinquante mille CF', 'Ali Osseili', 'To test the print bon page', '1111', 1, 'This is a test for the print bon', 21, '2025-01-23 08:34:41'),
('f61873f2-d965-11ef-bead-0efd67b0fe78', 1105, 'ACCH-17', 'qwer', '7', '', 'bda1a89a-acba-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 34534.0000, 0.0000, 'USD', 'CF', 'trente-quatre mille, cinq cent trente-quatre USD\n### ### ###\nzéro CF', 'qewr', 'qwer', 'qwer', 0, 'qwerq', 44, '2025-01-23 08:42:21'),
('f8a7d8c5-3a4d-4338-86c8-e72261f6f2c1', 1001, 'REF12345', 'SEQ12345', 'a22b34cd-5e67-4a1b-9a56-312f93d5bbd7', 'john_doe', 'd02d76c5-8830-4c96-9db2-8e1f3b9530f2', 'Acme Corp.', 'e6f8c1d1-cd80-4b5f-90b7-e52410fb4014', '2024-11-27', 1500.7500, 200.0000, 'USD', 'EUR', 'one thousand five hundred and seventy-five Euros', 'Jane Smith', 'Payment for services', 'ACC001234567', 0, 'No issues', 22, '2025-01-23 08:34:41'),
('fb5887da-d8c0-11ef-bead-0efd67b0fe78', 1088, '-2', 'sdfgsdfg', 'sfdg', 'sdfgsdfg', '4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-27', 3626.0000, 345.0000, 'USD', 'CF', 'trois mille, six cent vingt-six USD\n### ### ###\ntrois cent quarante-cinq CF', 'sdfgsd', 'sfdgsdf', 'sdfgsdfg', 1, 'fdgsdf', 26, '2025-01-23 08:34:41'),
('fc54306e-d7f6-11ef-bead-0efd67b0fe78', 1084, 'lllllllllll', 'llll', 'lll', 'llll', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-24', 0.0000, 794586.0000, 'USD', 'CF', 'zéro USD\n### ### ###\nsept cent quatre-vingt-quatorze mille, cinq cent quatre-vingt-six CF', 'llll', 'lll', 'lll', 1, 'lll', 23, '2025-01-23 08:34:41'),
('fcbfebc2-d708-11ef-bead-0efd67b0fe78', 1080, 'asdf', 'asdfdasd', 'zcvd', 'asg', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '3bd48476-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-20', 324.0000, 235.0000, 'USD', 'CF', 'trois cent vingt-quatre USD\n### ### ###\ndeux cent trente-cinq CF', 'asdf', 'asdg', 'asg', 1, 'asg', 24, '2025-01-23 08:34:41'),
('fd063b28-d964-11ef-bead-0efd67b0fe78', 1102, 'ACCH-14', 'asdgas', '7', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', NULL, '2afe2710-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 3562.0000, 0.0000, 'USD', 'CF', 'trois mille, cinq cent soixante-deux USD\n### ### ###\nzéro CF', 'fasdf', 'asdg', 'asdg', 0, 'asgdf', 41, '2025-01-23 08:35:23'),
('fdadc544-d961-11ef-bead-0efd67b0fe78', 1094, 'ACCH-6', 'gasdgfa', '7', '', 'be073b10-acba-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 235623.0000, 0.0000, 'USD', 'CF', 'deux cent trente-cinq mille, six cent vingt-trois USD\n### ### ###\nzéro CF', 'dsgjhadg', 'afshad', 'asfg', 0, 'asfg', 33, '2025-01-23 08:34:41'),
('ffe7f7d0-d961-11ef-bead-0efd67b0fe78', 1095, 'ACCH-7', 'gasdgfa', '7', '', 'be073b10-acba-11ef-9eb4-0efd67b0fe78', NULL, '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-23', 235623.0000, 0.0000, 'USD', 'CF', 'deux cent trente-cinq mille, six cent vingt-trois USD\n### ### ###\nzéro CF', 'dsgjhadg', 'afshad', 'asfg', 0, 'asfg', 34, '2025-01-23 08:34:41');

--
-- Triggers `bon`
--
DELIMITER $$
CREATE TRIGGER `before_insert_autono` BEFORE INSERT ON `bon` FOR EACH ROW BEGIN
    -- Increment 'autono' field automatically


        SET NEW.id = UUID();



    IF NEW.autono IS NULL THEN
        SET NEW.autono = (SELECT IFNULL(MAX(autono), 0) + 1 FROM bon);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `autonumber` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `autonumber`, `created_at`) VALUES
('4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', 'Example ', 8, '2025-01-20 07:18:21'),
('6105aaf4-acbb-11ef-9eb4-0efd67b0fe78', 'asfhrtrt', 9, '2025-01-20 07:18:21'),
('6da21fa8-acad-11ef-9eb4-0efd67b0fe78', 'Afrifood', 4, '2025-01-20 07:18:21'),
('bda1a89a-acba-11ef-9eb4-0efd67b0fe78', 'Apple Inc.', 6, '2025-01-20 07:18:21'),
('be073b10-acba-11ef-9eb4-0efd67b0fe78', 'Test Company', 7, '2025-01-20 07:18:21');

--
-- Triggers `companies`
--
DELIMITER $$
CREATE TRIGGER `before_insert_companies` BEFORE INSERT ON `companies` FOR EACH ROW BEGIN
    DECLARE mynext INT;

    -- Calculate the next autonumber atomically
    SELECT COALESCE(MAX(autonumber), 0) + 1 INTO mynext FROM companies;

    -- Set the autonumber for the new row
    SET NEW.autonumber = mynext;

    -- Generate a UUID for the id column
    SET NEW.id = UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lookup_references`
--

CREATE TABLE `lookup_references` (
  `id` char(36) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `type` enum('table','field') NOT NULL,
  `description_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lookup_references`
--

INSERT INTO `lookup_references` (`id`, `descr`, `type`, `description_2`) VALUES
('0548dae0-aef2-11ef-9eb4-0efd67b0fe78', 'id', 'field', 'companies'),
('1089d49a-aef2-11ef-9eb4-0efd67b0fe78', 'company_name', 'field', 'companies'),
('1bbd62aa-aef2-11ef-9eb4-0efd67b0fe78', 'id', 'field', 'site_name'),
('1dfa97f8-aef3-11ef-9eb4-0efd67b0fe78', 'true', 'field', 'true'),
('23f78090-aef2-11ef-9eb4-0efd67b0fe78', 'site_name', 'field', 'sites'),
('26a583d6-aef3-11ef-9eb4-0efd67b0fe78', 'false', 'field', 'false'),
('b7c2da00-aef1-11ef-9eb4-0efd67b0fe78', 'companies', 'table', ''),
('bc5046b6-aef1-11ef-9eb4-0efd67b0fe78', 'sites', 'table', '');

--
-- Triggers `lookup_references`
--
DELIMITER $$
CREATE TRIGGER `before_insert_lookup_references` BEFORE INSERT ON `lookup_references` FOR EACH ROW BEGIN
    -- Generate a new GUID (UUID) before the insert
    SET NEW.id = UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `autonumber` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `autonumber`, `created_at`) VALUES
('273c514c-aeff-11ef-9eb4-0efd67b0fe78', 'Test Inc', 8, '2025-01-20 07:18:49'),
('2afe2710-aeff-11ef-9eb4-0efd67b0fe78', 'name test', 9, '2025-01-20 07:18:49'),
('2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', 'site kinshasa', 10, '2025-01-20 07:18:49'),
('3bd48476-aeff-11ef-9eb4-0efd67b0fe78', 'site congo', 11, '2025-01-20 07:18:49'),
('936d8e9e-af13-11ef-9eb4-0efd67b0fe78', 'TESTEDIT', 12, '2025-01-20 07:18:49'),
('9cefcce4-af17-11ef-9eb4-0efd67b0fe78', 'osseili\r\n', 13, '2025-01-20 07:18:49');

--
-- Triggers `sites`
--
DELIMITER $$
CREATE TRIGGER `before_insert_sites` BEFORE INSERT ON `sites` FOR EACH ROW BEGIN
    DECLARE mynext INT;

    -- Calculate the next autonumber atomically
    SELECT COALESCE(MAX(autonumber), 0) + 1 INTO mynext FROM sites;

    -- Set the autonumber for the new row
    SET NEW.autonumber = mynext;

    -- Generate a UUID for the id column
    SET NEW.id = UUID();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `isadmin` tinyint(1) DEFAULT 0,
  `canadd` tinyint(1) NOT NULL DEFAULT 0,
  `canedit` tinyint(1) NOT NULL DEFAULT 0,
  `candelete` tinyint(1) NOT NULL DEFAULT 0,
  `prefix` varchar(12) NOT NULL DEFAULT 'ACC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `useremail`, `username`, `password`, `token`, `created_at`, `isadmin`, `canadd`, `canedit`, `candelete`, `prefix`) VALUES
(7, 'henry@gmail.com', 'Henry', '$2y$10$vC41AOMLc.nfBlZFOwukkuN/44tpQIlIjnGdRMMOVdlzOTf5fT5zq', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', '2020-09-24 17:53:37', 1, 1, 1, 1, 'ACCH'),
(11, 'ali@gmail.com', 'alioss', '$2y$10$aIgMmwf3aF39Vo19LR1qB.LXMxPLTDz1rVPd.R8xXqSl1SCwJ.dUi', 'e3f8fe5f5d6236dce4dbce6aed0586d37b803d33da855047a06154a82f27bcdf98137d74a414adf3aa660fa6c33f010be0fa', '2024-11-25 10:39:58', 0, 1, 1, 1, 'ACCALI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon`
--
ALTER TABLE `bon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `autonumber` (`autonumber`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_references`
--
ALTER TABLE `lookup_references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `useremail` (`useremail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bon`
--
ALTER TABLE `bon`
  MODIFY `autonumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
