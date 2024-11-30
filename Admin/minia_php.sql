-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2024 at 01:11 PM
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
  `comments` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bon`
--

INSERT INTO `bon` (`id`, `autono`, `reference`, `sequence_reference`, `user_id`, `username`, `company_id`, `company_name`, `site_id`, `date_of_bon`, `total_one`, `total_two`, `currency_one`, `currency_two`, `amount_in_lettres`, `beneficier_name`, `motif`, `account_number`, `is_voided`, `comments`) VALUES
('', 1063, 'ref', '435', '3245', 'qwer', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '3bd48476-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-01', 34.0000, 2345.0000, 'EUR', 'CF', 'trente-quatre USD\n### ### ###\ndeux mille, trois cent quarante-cinq CF', '2345', '2345', '2345', 0, 'this is a test for the edit page.'),
('04745180-ad94-11ef-9eb4-0efd67b0fe78', 1030, 'asdf', '234', '1234', 'asdf', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'USD', '', '123', '1234', '1234', 0, '1234'),
('069ce9d6-ae52-11ef-9eb4-0efd67b0fe78', 1052, '234', '23', '23', '23', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-15', 432.0000, 23.0000, 'USD', 'CF', 'quatre cent trente-deux USD<br>### ### ###<br>vingt-trois CF', '23', '23', '23', 0, '32'),
('085de4b4-ad94-11ef-9eb4-0efd67b0fe78', 1031, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0300, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('087d47e4-ae59-11ef-9eb4-0efd67b0fe78', 1066, '243', '3425', '235', '2345', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('0ce261ec-ae50-11ef-9eb4-0efd67b0fe78', 1045, '2342', '1234', '234', '2134', '', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '', '2024-12-04', 12.0000, 43.0000, 'USD', 'EUR', 'douze USD<br>### ### ###<br>quarante-trois EUR', 'awer', 'adsf', 'r42', 0, 'this is a random comment'),
('1d612d10-ae59-11ef-9eb4-0efd67b0fe78', 1067, '243', '3425', '235', '2345', '', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('2218266c-ad94-11ef-9eb4-0efd67b0fe78', 1032, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0300, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('28c7179d-6d9d-4d9b-b053-e31c85e1e9a4', 1010, 'REF12354', 'SEQ12354', 'd7c5d5a2-4f7b-4e61-a8c9-9824fae9f5b4', 'tom_smith', '8c1d5626-d9e3-4969-b29b-2290c986f455', 'NextGen Tech', '1a9fd3fd-8a7e-4d4b-b35e-d1a15e43831f', '2024-11-20', 3000.0000, 500.0000, 'USD', 'ZAR', 'three thousand South African Rand', 'John Kriel', 'Payment for software installation', 'ACC006543210', 0, 'Payment successful'),
('28f91e2c-ae58-11ef-9eb4-0efd67b0fe78', 1061, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('2b6b0f84-8f53-4b5b-9079-711cb9a9b2ac', 1004, 'REF12348', 'SEQ12348', 'f77391b9-3e6b-4208-b0a7-4b70e0be9f7a', 'alice_green', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'Tech Innovations', 'a3bc2b98-8b64-4a3e-a68b-1c2f0e29d388', '2024-11-26', 2450.0000, 150.0000, 'USD', 'USD', 'two thousand four hundred and fifty Canadian Dollars', 'Michael Johnson', 'Consulting and technical support', 'ACC004567891', 0, 'Payment completed'),
('2c0d125c-ad91-11ef-9eb4-0efd67b0fe78', 1017, '234', '1234', '1324', '1234', '1234', '1234', '1234', '2024-11-08', 1234.0000, 1234.0000, 'USD', 'USD', '', '1234', '1234', '1234', 0, '1234'),
('2ea9e932-ad90-11ef-9eb4-0efd67b0fe78', 1015, '354', '345', '3245', '2345', '2345', '2345', '2345', '2024-11-19', 345.0000, 345.0000, '2345', '2345', '345', '2345', '2345', '2345', 2345, '345'),
('32423445', 1014, '3245', '52345', '2345', '2345', '2345', '2345', '234', '2024-11-07', 2345.0000, 345.0000, 'EUR', 'EGP', '', '2345', '2345', '345', 0, '2345'),
('33066986-ae5a-11ef-9eb4-0efd67b0fe78', 1070, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('383c9450-ad94-11ef-9eb4-0efd67b0fe78', 1033, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 1007657547.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('3c9845aa-ae50-11ef-9eb4-0efd67b0fe78', 1046, '2342', '1234', '234', '2134', '', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '', '2024-12-05', 12.0000, 43.0000, 'USD', 'EUR', 'douze USD<br>### ### ###<br>quarante-trois EUR', 'awer', 'adsf', 'r42', 0, 'this is a random comment'),
('3e7532c2-ae58-11ef-9eb4-0efd67b0fe78', 1062, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('41c714f6-ad93-11ef-9eb4-0efd67b0fe78', 1023, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 100.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('428ad5be-ae4f-11ef-9eb4-0efd67b0fe78', 1043, '2342', '1234', '234', '2134', '', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '', '2024-12-04', 12.0000, 43.0000, 'USD', 'EUR', 'douze USD<br>### ### ###<br>quarante-trois EUR', 'company test, site osseili. check the ids', 'adsf', 'r42', 0, 'awer'),
('4787d000-ae52-11ef-9eb4-0efd67b0fe78', 1053, '324', '52345', '234', '5234', '', '6105aaf4-acbb-11ef-9eb4-0efd67b0fe78', '', '2024-12-16', 34.0000, 2345.0000, 'USD', 'CF', 'trente-quatre USD\n### ### ###\ndeux mille, trois cent quarante-cinq CF', '2345', '2345', '2345', 0, '2354'),
('4b7a467b-e8b5-4df9-bd4f-c1b0fa3cc0e2', 1003, 'REF12347', 'SEQ12347', 'c99f8ac8-b345-4a67-a4d9-2d1f3e347c74', 'bob_white', '4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', 'Gamma Solutions', 'bd6f9be3-4070-4313-bb71-69d0d39ca34d', '2024-11-25', 100.0000, 500.0000, 'EUR', 'USD', 'ten thousand and five hundred British Pounds', 'Sarah Miller', 'Consulting fees for project', 'ACC007890345', 0, 'All payments processed successfully'),
('4e6b8c47-c12a-4a9a-b839-2c1d416c2b7f', 1012, 'REF12356', 'SEQ12356', '6d5b4399-7f38-44f3-b801-cd82cbfba6b1', 'david_rose', 'f13cde1e-c25d-4a3b-8121-5420d3cd2e0b', 'Momentum Innovations', '2ad5b8e8-33e1-4417-8a3c-ec84a8481cb2', '2024-11-18', 1800.5000, 200.0000, 'USD', 'SEK', 'one thousand eight hundred Swedish Krona', 'Erik Svensson', 'Software solution payment', 'ACC004321098', 0, 'Processed successfully'),
('4f8d0816-ad93-11ef-9eb4-0efd67b0fe78', 1024, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('50b2b8ca-ae4d-11ef-9eb4-0efd67b0fe78', 1039, '234213', '234', '234', 'Osseili', '234', '2345', '', '2024-12-01', 2134.0000, 23423.0000, 'USD', 'EGP', '', '234', '1234', '1234', 0, '234'),
('5c6de87a-ae56-11ef-9eb4-0efd67b0fe78', 1059, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('62b721c6-ae54-11ef-9eb4-0efd67b0fe78', 1054, '2345', '2345', '23', '2345', '', 'a30b974a-abfa-11ef-9eb4-0efd67b0fe78', '', '2024-12-18', 2345.0000, 2345.0000, 'CF', 'EUR', 'deux mille, trois cent quarante-cinq CF\n### ### ###\ndeux mille, trois cent quarante-cinq EUR', '2345', '2345', '2345', 0, '2345234'),
('654489e6-ad92-11ef-9eb4-0efd67b0fe78', 1020, '1234', '1234', '1234', '1234', '1234', '1234', '1234', '2024-11-30', 1234.0000, 1234.0000, 'USD', 'USD', '', '1234', '1234', '1234', 0, '1234'),
('679085ec-ad97-11ef-9eb4-0efd67b0fe78', 1035, '124', '1234', '1234', '1234', '1234', '1234', '1234', '2024-11-29', 234.0000, 578.0000, 'USD', 'USD', '', '1234', '1234', '1234', 0, '1234'),
('6794ca7e-ae4d-11ef-9eb4-0efd67b0fe78', 1040, '234213', '234', '234', 'Osseili', '234', '2345', '', '2024-12-01', 2134.0000, 23423.0000, 'USD', 'EGP', '', '234', '1234', '1234', 0, '234'),
('6807d1b0-ae55-11ef-9eb4-0efd67b0fe78', 1055, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('6b30749a-ad93-11ef-9eb4-0efd67b0fe78', 1025, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('6ecd0fde-ad91-11ef-9eb4-0efd67b0fe78', 1018, '2345', '2345', '2345', '2345', '2345', '2345', '2345', '2024-11-08', 2345.0000, 2345.0000, 'USD', 'EUR', '', '2345', '2345', '2345', 0, '2354'),
('706043a6-ad97-11ef-9eb4-0efd67b0fe78', 1036, '124', '1234', '1234', '1234', '1234', '1234', '1234', '2024-11-29', 234.3000, 578.0000, 'USD', 'USD', '', '1234', '1234', '1234', 0, '1234'),
('785a142e-af13-11ef-9eb4-0efd67b0fe78', 1074, 'ad', 'adsf', 'asdf', 'asdf', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', 'fgsdffds', '3af50892-acc4-11ef-9eb4-0efd67b0fe78', '2024-11-09', 234.0000, 1234.0000, 'USD', 'USD', 'deux cent trente-quatre USD\n### ### ###\nun mille, deux cent trente-quatre USD', 'asdf', 'asdf', 'asdf', 1, 'asdf'),
('7ce33d9e-ad93-11ef-9eb4-0efd67b0fe78', 1026, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('7cf7a910-ae55-11ef-9eb4-0efd67b0fe78', 1056, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('7db98f99-fd6c-4422-82a3-c95304bc9f57', 1009, 'REF12353', 'SEQ12353', '3d7f8d6a-f7b1-429a-bbdb-d6e8244c8493', 'lisa_pink', 'c61e951f-e9fa-4baf-a5be-d07563b9b6ed', 'Eco Systems', 'fd18fe0e-0a52-4b57-9e94-fb50a078c3c8', '2024-11-21', 2100.7500, 150.0000, 'USD', 'BRL', 'two thousand one hundred and fifty Brazilian Reals', 'Roberta Lima', 'Payment for environmental research', 'ACC008987654', 0, 'Payment successfully processed'),
('838723dc-ae55-11ef-9eb4-0efd67b0fe78', 1057, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('8dc7f75c-ae4d-11ef-9eb4-0efd67b0fe78', 1041, '234213', '234', '234', 'Osseili', '234', '2345', '', '2024-12-01', 2134.0000, 23423.0000, 'USD', 'EGP', 'deux mille, cent trente-quatre USD<br>### ### ###<br>vingt-trois mille, quatre cent vingt-trois EGP', '234', '1234', '1234', 0, '234'),
('8e55c54c-ad93-11ef-9eb4-0efd67b0fe78', 1027, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('961f4244-ae51-11ef-9eb4-0efd67b0fe78', 1049, '1234', '1234', '2134', '1234', '', '6105aaf4-acbb-11ef-9eb4-0efd67b0fe78', '', '2024-12-12', 1234.0000, 1234.0000, 'EUR', 'CF', 'zéro <br>### ### ###<br> ', '234', '1234', '2134', 0, '1234'),
('97376b58-ad97-11ef-9eb4-0efd67b0fe78', 1037, '124', '1234', '1234', '1234', '1234', '1234', '1234', '2024-11-29', 234.3000, 578.0000, 'USD', 'USD', '', '1234', '1234', '1234', 0, '1234'),
('9c3a012a-ad91-11ef-9eb4-0efd67b0fe78', 1019, '2345', '2345', '2345', '2345', '2345', '2345', '2345', '2024-11-08', 2345.0000, 2345.0000, 'USD', 'EUR', '', '2345', '2345', '2345', 0, '2354'),
('ae2c5e00-ad8c-11ef-9eb4-0efd67b0fe78', 1013, '2345', '2345', '2345', '2345', '2345', '3425', '2345', '2024-11-12', 3245.0000, 2345.0000, '2345', '2345', 'hwety', '2345', '34w', NULL, 1, '345'),
('b10b8c86-ae59-11ef-9eb4-0efd67b0fe78', 1068, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('b90508b4-ad90-11ef-9eb4-0efd67b0fe78', 1016, '3245', '52345', '2345', '2345', '2345', '2345', '234', '2024-11-07', 2345.0000, 345.0000, 'EUR', 'EGP', '', '2345', '2345', '345', 0, '2345'),
('ba9f00b0-ae55-11ef-9eb4-0efd67b0fe78', 1058, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('bb0e27ab-6e8a-4a3a-80db-bc4368a7f76f', 1008, 'REF12352', 'SEQ12352', '65b98f72-01b2-4375-94d2-6fba10b7f0a4', 'george_black', '765a86e7-18e9-4d8e-b75e-94c65b4c925a', 'Advanced Solutions', 'b78825ca-9c78-4c4f-9b06-7a8a55a17a7f', '2024-11-22', 1500.5000, 100.0000, 'USD', 'MXN', 'one thousand five hundred Mexican Pesos', 'Carlos Ruiz', 'Consulting payment', 'ACC009234567', 0, 'Payment completed'),
('be1e6e34-b477-4e41-9b7a-bb8fe0342469', 1011, 'REF12355', 'SEQ12355', 'f4e909c5-5996-4dbd-9f33-51f5ff30b5be', 'nina_yellow', 'f0c8b7e0-7317-48ba-b745-b924557b3f61', 'Elite Tech', '5a3186b5-9067-49b7-b579-6fbc39a87d29', '2024-11-19', 4000.5000, 300.0000, 'USD', 'EGP', 'four thousand Egyptian Pounds', 'Ahmed Maher', 'Payment for cloud hosting service', 'ACC003567890', 0, 'Payment has been processed'),
('c1d4e58b-d432-44e1-94a0-5c423ccd4b44', 1002, 'REF12346', 'SEQ12346', '89f9ae13-56b2-4f53-bc39-c875a7b3df2d', 'emily_blue', 'a4dbe207-627b-4958-bfbb-2bffb5d0e3d0', 'Future Enterprises', 'c7386799-d3cf-45c5-9f8b-d18ac4fa1298', '2024-11-24', 3500.0000, 200.0000, 'USD', 'JPY', 'three thousand five hundred Japanese Yen', 'David Wilson', 'Product purchase payment', 'ACC009876543', 0, 'Processing successful'),
('c750bd72-ae59-11ef-9eb4-0efd67b0fe78', 1069, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('c9c8159a-ae5a-11ef-9eb4-0efd67b0fe78', 1071, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('cd32a7fe-ad92-11ef-9eb4-0efd67b0fe78', 1021, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 1234.0000, 1234.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('cd452b22-ae5a-11ef-9eb4-0efd67b0fe78', 1072, '243', '3425', '235', '2345', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 1, '2'),
('d3cf69b6-ad93-11ef-9eb4-0efd67b0fe78', 1028, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('d77ae9ae-ae4d-11ef-9eb4-0efd67b0fe78', 1042, '2345', '3245', '345', '2345', '2345', '2345', '', '2024-12-02', 345.0000, 2345.0000, 'EGP', 'EUR', 'trois cent quarante-cinq EGP<br>### ### ###<br>deux mille, trois cent quarante-cinq EUR', '3245', '2345', '2345', 0, '2345'),
('da90d186-ae51-11ef-9eb4-0efd67b0fe78', 1050, '234', '23', '23', '23', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-15', 432.0000, 23.0000, 'USD', 'CF', 'zéro <br>### ### ###<br> ', '23', '23', '23', 0, '32'),
('dab1107c-aeec-11ef-9eb4-0efd67b0fe78', 1073, '43', '34', '43', '43', '4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', 'asdfghstheshr', '273c514c-aeff-11ef-9eb4-0efd67b0fe78', '2025-01-02', 43.0000, 43.0000, 'USD', 'USD', 'quarante-trois USD\n### ### ###\nquarante-trois USD', '43', '43', '34', 1, '43'),
('db5f8104-6bbd-4316-b02a-589cc3434231', 1007, 'REF12351', 'SEQ12351', '57d3cc3b-f2a2-4cfd-b61b-b45c898d7a9f', 'claire_brown', 'be5d62b2-f9fe-423b-a7ca-e66d9fe0b818', 'Visionary Tech', 'ac6c8eb6-e658-4d25-bd80-16c9cf4c6595', '2024-11-29', 8000.0000, 250.0000, 'USD', 'CNY', 'eight thousand Chinese Yuan', 'Li Wei', 'Payment for mobile app development', 'ACC008976543', 0, 'Payment completed successfully'),
('dc1e922a-ae58-11ef-9eb4-0efd67b0fe78', 1064, 'qwer', '435', '3245', 'qwer', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', '2024-12-23', 34.0000, 2345.0000, 'USD', 'CF', 'trente-quatre USD\n### ### ###\ndeux mille, trois cent quarante-cinq CF', '2345', '2345', '2345', 0, '2345234'),
('e2d514aa-ae57-11ef-9eb4-0efd67b0fe78', 1060, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('e74ca590-ad92-11ef-9eb4-0efd67b0fe78', 1022, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 100.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('ed7fe654-ae58-11ef-9eb4-0efd67b0fe78', 1065, '243', '3425', '235', '2345', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '9364298c-acc3-11ef-9eb4-0efd67b0fe78', '2024-12-20', 2345.0000, 2345.0000, 'USD', 'USD', 'deux mille, trois cent quarante-cinq USD\n### ### ###\ndeux mille, trois cent quarante-cinq USD', '2345', '2345', '2345', 0, '2'),
('f54b91d8-ae50-11ef-9eb4-0efd67b0fe78', 1047, '313', '313', '150', 'aliosseili', '', '2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', '', '2024-12-06', 23.0000, 50.0000, 'USD', 'CF', 'zéro <br>### ### ###<br> ', 'osseili', 'testing', '33', 0, 'site osseili company test'),
('f64b924e-ad93-11ef-9eb4-0efd67b0fe78', 1029, 'asdf', '234', '1234', 'asdf', '1234', '1234', '2134', '2024-11-07', 100.0000, 10054.0000, 'USD', 'EGP', '', '123', '1234', '1234', 0, '1234'),
('f8a7d8c5-3a4d-4338-86c8-e72261f6f2c1', 1001, 'REF12345', 'SEQ12345', 'a22b34cd-5e67-4a1b-9a56-312f93d5bbd7', 'john_doe', 'd02d76c5-8830-4c96-9db2-8e1f3b9530f2', 'Acme Corp.', 'e6f8c1d1-cd80-4b5f-90b7-e52410fb4014', '2024-11-27', 1500.7500, 200.0000, 'USD', 'EUR', 'one thousand five hundred and seventy-five Euros', 'Jane Smith', 'Payment for services', 'ACC001234567', 0, 'No issues'),
('fb4859e4-ae4c-11ef-9eb4-0efd67b0fe78', 1038, '234213', '234', '234', 'Osseili', '234', '2345', '', '2024-12-01', 2134.0000, 23423.0000, 'USD', 'EGP', '', '234', '1234', '1234', 0, '234'),
('fbb63176-ae51-11ef-9eb4-0efd67b0fe78', 1051, '234', '23', '23', '23', '', '6da21fa8-acad-11ef-9eb4-0efd67b0fe78', '', '2024-12-15', 432.0000, 23.0000, 'USD', 'CF', 'quatre cent trente-deux USD<br>### ### ###<br>vingt-trois CF', '23', '23', '23', 0, '32'),
('ff358588-ad96-11ef-9eb4-0efd67b0fe78', 1034, '124', '1234', '1234', '1234', '1234', '1234', '1234', '2024-11-29', 234.0000, 578.0000, 'USD', 'USD', '', '1234', '1234', '1234', 0, '1234');

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
  `company_name` varchar(255) NOT NULL,
  `autonumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `autonumber`) VALUES
('2b63e8ee-acba-11ef-9eb4-0efd67b0fe78', 'test', 5),
('4bc2bed4-acbb-11ef-9eb4-0efd67b0fe78', 'asdfghstheshr', 8),
('6105aaf4-acbb-11ef-9eb4-0efd67b0fe78', 'asfhrtrt', 9),
('6da21fa8-acad-11ef-9eb4-0efd67b0fe78', 'fgsdffds', 4),
('a30b974a-abfa-11ef-9eb4-0efd67b0fe78', 'asdfasdfsadf', 2),
('bda1a89a-acba-11ef-9eb4-0efd67b0fe78', 'asdfasf', 6),
('be073b10-acba-11ef-9eb4-0efd67b0fe78', 'asdfasf', 7);

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
  `site_name` varchar(255) NOT NULL,
  `autonumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `site_name`, `autonumber`) VALUES
('273c514c-aeff-11ef-9eb4-0efd67b0fe78', 'Test Inc', 8),
('2afe2710-aeff-11ef-9eb4-0efd67b0fe78', 'name test', 9),
('2ffd4386-aeff-11ef-9eb4-0efd67b0fe78', 'site kinshasa', 10),
('3bd48476-aeff-11ef-9eb4-0efd67b0fe78', 'site congo', 11),
('9364298c-acc3-11ef-9eb4-0efd67b0fe78', 'aSDAsdasd', 5),
('936d8e9e-af13-11ef-9eb4-0efd67b0fe78', 'asdf', 12);

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
  `candelete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `useremail`, `username`, `password`, `token`, `created_at`, `isadmin`, `canadd`, `canedit`, `candelete`) VALUES
(7, 'henry@gmail.com', 'Henry', '$2y$10$vC41AOMLc.nfBlZFOwukkuN/44tpQIlIjnGdRMMOVdlzOTf5fT5zq', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', '2020-09-24 17:53:37', 1, 0, 0, 0),
(11, 'ali@gmail.com', 'alioss', '$2y$10$aIgMmwf3aF39Vo19LR1qB.LXMxPLTDz1rVPd.R8xXqSl1SCwJ.dUi', 'e3f8fe5f5d6236dce4dbce6aed0586d37b803d33da855047a06154a82f27bcdf98137d74a414adf3aa660fa6c33f010be0fa', '2024-11-25 10:39:58', 0, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon`
--
ALTER TABLE `bon`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
