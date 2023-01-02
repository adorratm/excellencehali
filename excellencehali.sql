-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 03:46 PM
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
-- Database: `excellencehali`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(1) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `seo_url` longtext DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `img_url`, `content`, `category_id`, `lang`, `rank`, `isActive`, `seo_url`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(1, 'Yazı Deneme', 'e571cbcb16fd81e37c2d968735f509a0.webp', 'test', 1, 'tr', 1, 1, 'yazi-deneme', '2022-11-21 12:42:55', '2022-11-21 12:42:55', '2022-11-21 12:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `seo_url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `title`, `seo_url`, `img_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`) VALUES
(1, 'Blog Yazıları', 'blog-yazilari', NULL, 'tr', 1, 1, '2022-11-21 12:42:35', '2022-11-21 12:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` smallint(6) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(4) DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `host`, `port`, `email`, `password`, `token`, `lang`, `isActive`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, '78.142.211.12', 90, 'ylcnirmak@ytd.com.tr', '1453', '92b735a9-482a-4242-bfb2-4fdddf04b87b', 'tr', 1, 1, '2022-12-19 11:00:49', '2022-12-28 10:30:54'),
(2, '185.210.92.173', 90, 'mutfak@mutfak.com', '14531453', '52ad3bde-6c4a-414b-93de-52c29261a054', 'tr', 1, 2, '2022-12-19 11:05:11', '2022-12-28 10:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `dial_code` int(11) DEFAULT NULL,
  `currency_name` varchar(20) DEFAULT NULL,
  `currency_symbol` varchar(20) DEFAULT NULL,
  `currency_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `code`, `name`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`) VALUES
(1, 'AF', 'Afghanistan', 93, 'Afghan afghani', 'Ø‹', 'AFN'),
(2, 'AL', 'Albania', 355, 'Albanian lek', 'L', 'ALL'),
(3, 'DZ', 'Algeria', 213, 'Algerian dinar', 'Ø¯.Ø¬', 'DZD'),
(4, 'AS', 'American Samoa', 1684, '', '', ''),
(5, 'AD', 'Andorra', 376, 'Euro', 'â‚¬', 'EUR'),
(6, 'AO', 'Angola', 244, 'Angolan kwanza', 'Kz', 'AOA'),
(7, 'AI', 'Anguilla', 1264, 'East Caribbean dolla', '$', 'XCD'),
(8, 'AQ', 'Antarctica', 0, '', '', ''),
(9, 'AG', 'Antigua And Barbuda', 1268, 'East Caribbean dolla', '$', 'XCD'),
(10, 'AR', 'Argentina', 54, 'Argentine peso', '$', 'ARS'),
(11, 'AM', 'Armenia', 374, 'Armenian dram', '', 'AMD'),
(12, 'AW', 'Aruba', 297, 'Aruban florin', 'Æ’', 'AWG'),
(13, 'AU', 'Australia', 61, 'Australian dollar', '$', 'AUD'),
(14, 'AT', 'Austria', 43, 'Euro', 'â‚¬', 'EUR'),
(15, 'AZ', 'Azerbaijan', 994, 'Azerbaijani manat', '', 'AZN'),
(16, 'BS', 'Bahamas The', 1242, '', '', ''),
(17, 'BH', 'Bahrain', 973, 'Bahraini dinar', '.Ø¯.Ø¨', 'BHD'),
(18, 'BD', 'Bangladesh', 880, 'Bangladeshi taka', 'à§³', 'BDT'),
(19, 'BB', 'Barbados', 1246, 'Barbadian dollar', '$', 'BBD'),
(20, 'BY', 'Belarus', 375, 'Belarusian ruble', 'Br', 'BYR'),
(21, 'BE', 'Belgium', 32, 'Euro', 'â‚¬', 'EUR'),
(22, 'BZ', 'Belize', 501, 'Belize dollar', '$', 'BZD'),
(23, 'BJ', 'Benin', 229, 'West African CFA fra', 'Fr', 'XOF'),
(24, 'BM', 'Bermuda', 1441, 'Bermudian dollar', '$', 'BMD'),
(25, 'BT', 'Bhutan', 975, 'Bhutanese ngultrum', 'Nu.', 'BTN'),
(26, 'BO', 'Bolivia', 591, 'Bolivian boliviano', 'Bs.', 'BOB'),
(27, 'BA', 'Bosnia and Herzegovina', 387, 'Bosnia and Herzegovi', 'KM or ÐšÐœ', 'BAM'),
(28, 'BW', 'Botswana', 267, 'Botswana pula', 'P', 'BWP'),
(29, 'BV', 'Bouvet Island', 0, '', '', ''),
(30, 'BR', 'Brazil', 55, 'Brazilian real', 'R$', 'BRL'),
(31, 'IO', 'British Indian Ocean Territory', 246, 'United States dollar', '$', 'USD'),
(32, 'BN', 'Brunei', 673, 'Brunei dollar', '$', 'BND'),
(33, 'BG', 'Bulgaria', 359, 'Bulgarian lev', 'Ð»Ð²', 'BGN'),
(34, 'BF', 'Burkina Faso', 226, 'West African CFA fra', 'Fr', 'XOF'),
(35, 'BI', 'Burundi', 257, 'Burundian franc', 'Fr', 'BIF'),
(36, 'KH', 'Cambodia', 855, 'Cambodian riel', 'áŸ›', 'KHR'),
(37, 'CM', 'Cameroon', 237, 'Central African CFA ', 'Fr', 'XAF'),
(38, 'CA', 'Canada', 1, 'Canadian dollar', '$', 'CAD'),
(39, 'CV', 'Cape Verde', 238, 'Cape Verdean escudo', 'Esc or $', 'CVE'),
(40, 'KY', 'Cayman Islands', 1345, 'Cayman Islands dolla', '$', 'KYD'),
(41, 'CF', 'Central African Republic', 236, 'Central African CFA ', 'Fr', 'XAF'),
(42, 'TD', 'Chad', 235, 'Central African CFA ', 'Fr', 'XAF'),
(43, 'CL', 'Chile', 56, 'Chilean peso', '$', 'CLP'),
(44, 'CN', 'China', 86, 'Chinese yuan', 'Â¥ or å…ƒ', 'CNY'),
(45, 'CX', 'Christmas Island', 61, '', '', ''),
(46, 'CC', 'Cocos (Keeling) Islands', 672, 'Australian dollar', '$', 'AUD'),
(47, 'CO', 'Colombia', 57, 'Colombian peso', '$', 'COP'),
(48, 'KM', 'Comoros', 269, 'Comorian franc', 'Fr', 'KMF'),
(49, 'CG', 'Congo', 242, '', '', ''),
(50, 'CD', 'Congo The Democratic Republic Of The', 242, '', '', ''),
(51, 'CK', 'Cook Islands', 682, 'New Zealand dollar', '$', 'NZD'),
(52, 'CR', 'Costa Rica', 506, 'Costa Rican colÃ³n', 'â‚¡', 'CRC'),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225, '', '', ''),
(54, 'HR', 'Croatia (Hrvatska)', 385, '', '', ''),
(55, 'CU', 'Cuba', 53, 'Cuban convertible pe', '$', 'CUC'),
(56, 'CY', 'Cyprus', 357, 'Euro', 'â‚¬', 'EUR'),
(57, 'CZ', 'Czech Republic', 420, 'Czech koruna', 'KÄ', 'CZK'),
(58, 'DK', 'Denmark', 45, 'Danish krone', 'kr', 'DKK'),
(59, 'DJ', 'Djibouti', 253, 'Djiboutian franc', 'Fr', 'DJF'),
(60, 'DM', 'Dominica', 1767, 'East Caribbean dolla', '$', 'XCD'),
(61, 'DO', 'Dominican Republic', 1809, 'Dominican peso', '$', 'DOP'),
(62, 'TP', 'East Timor', 670, 'United States dollar', '$', 'USD'),
(63, 'EC', 'Ecuador', 593, 'United States dollar', '$', 'USD'),
(64, 'EG', 'Egypt', 20, 'Egyptian pound', 'Â£ or Ø¬.Ù…', 'EGP'),
(65, 'SV', 'El Salvador', 503, 'United States dollar', '$', 'USD'),
(66, 'GQ', 'Equatorial Guinea', 240, 'Central African CFA ', 'Fr', 'XAF'),
(67, 'ER', 'Eritrea', 291, 'Eritrean nakfa', 'Nfk', 'ERN'),
(68, 'EE', 'Estonia', 372, 'Euro', 'â‚¬', 'EUR'),
(69, 'ET', 'Ethiopia', 251, 'Ethiopian birr', 'Br', 'ETB'),
(70, 'XA', 'External Territories of Australia', 61, '', '', ''),
(71, 'FK', 'Falkland Islands', 500, 'Falkland Islands pou', 'Â£', 'FKP'),
(72, 'FO', 'Faroe Islands', 298, 'Danish krone', 'kr', 'DKK'),
(73, 'FJ', 'Fiji Islands', 679, '', '', ''),
(74, 'FI', 'Finland', 358, 'Euro', 'â‚¬', 'EUR'),
(75, 'FR', 'France', 33, 'Euro', 'â‚¬', 'EUR'),
(76, 'GF', 'French Guiana', 594, '', '', ''),
(77, 'PF', 'French Polynesia', 689, 'CFP franc', 'Fr', 'XPF'),
(78, 'TF', 'French Southern Territories', 0, '', '', ''),
(79, 'GA', 'Gabon', 241, 'Central African CFA ', 'Fr', 'XAF'),
(80, 'GM', 'Gambia The', 220, '', '', ''),
(81, 'GE', 'Georgia', 995, 'Georgian lari', 'áƒš', 'GEL'),
(82, 'DE', 'Germany', 49, 'Euro', 'â‚¬', 'EUR'),
(83, 'GH', 'Ghana', 233, 'Ghana cedi', 'â‚µ', 'GHS'),
(84, 'GI', 'Gibraltar', 350, 'Gibraltar pound', 'Â£', 'GIP'),
(85, 'GR', 'Greece', 30, 'Euro', 'â‚¬', 'EUR'),
(86, 'GL', 'Greenland', 299, '', '', ''),
(87, 'GD', 'Grenada', 1473, 'East Caribbean dolla', '$', 'XCD'),
(88, 'GP', 'Guadeloupe', 590, '', '', ''),
(89, 'GU', 'Guam', 1671, '', '', ''),
(90, 'GT', 'Guatemala', 502, 'Guatemalan quetzal', 'Q', 'GTQ'),
(91, 'XU', 'Guernsey and Alderney', 44, '', '', ''),
(92, 'GN', 'Guinea', 224, 'Guinean franc', 'Fr', 'GNF'),
(93, 'GW', 'Guinea-Bissau', 245, 'West African CFA fra', 'Fr', 'XOF'),
(94, 'GY', 'Guyana', 592, 'Guyanese dollar', '$', 'GYD'),
(95, 'HT', 'Haiti', 509, 'Haitian gourde', 'G', 'HTG'),
(96, 'HM', 'Heard and McDonald Islands', 0, '', '', ''),
(97, 'HN', 'Honduras', 504, 'Honduran lempira', 'L', 'HNL'),
(98, 'HK', 'Hong Kong S.A.R.', 852, '', '', ''),
(99, 'HU', 'Hungary', 36, 'Hungarian forint', 'Ft', 'HUF'),
(100, 'IS', 'Iceland', 354, 'Icelandic krÃ³na', 'kr', 'ISK'),
(101, 'IN', 'India', 91, 'Indian rupee', 'â‚¹', 'INR'),
(102, 'ID', 'Indonesia', 62, 'Indonesian rupiah', 'Rp', 'IDR'),
(103, 'IR', 'Iran', 98, 'Iranian rial', 'ï·¼', 'IRR'),
(104, 'IQ', 'Iraq', 964, 'Iraqi dinar', 'Ø¹.Ø¯', 'IQD'),
(105, 'IE', 'Ireland', 353, 'Euro', 'â‚¬', 'EUR'),
(106, 'IL', 'Israel', 972, 'Israeli new shekel', 'â‚ª', 'ILS'),
(107, 'IT', 'Italy', 39, 'Euro', 'â‚¬', 'EUR'),
(108, 'JM', 'Jamaica', 1876, 'Jamaican dollar', '$', 'JMD'),
(109, 'JP', 'Japan', 81, 'Japanese yen', 'Â¥', 'JPY'),
(110, 'XJ', 'Jersey', 44, 'British pound', 'Â£', 'GBP'),
(111, 'JO', 'Jordan', 962, 'Jordanian dinar', 'Ø¯.Ø§', 'JOD'),
(112, 'KZ', 'Kazakhstan', 7, 'Kazakhstani tenge', '', 'KZT'),
(113, 'KE', 'Kenya', 254, 'Kenyan shilling', 'Sh', 'KES'),
(114, 'KI', 'Kiribati', 686, 'Australian dollar', '$', 'AUD'),
(115, 'KP', 'Korea North', 850, '', '', ''),
(116, 'KR', 'Korea South', 82, '', '', ''),
(117, 'KW', 'Kuwait', 965, 'Kuwaiti dinar', 'Ø¯.Ùƒ', 'KWD'),
(118, 'KG', 'Kyrgyzstan', 996, 'Kyrgyzstani som', 'Ð»Ð²', 'KGS'),
(119, 'LA', 'Laos', 856, 'Lao kip', 'â‚­', 'LAK'),
(120, 'LV', 'Latvia', 371, 'Euro', 'â‚¬', 'EUR'),
(121, 'LB', 'Lebanon', 961, 'Lebanese pound', 'Ù„.Ù„', 'LBP'),
(122, 'LS', 'Lesotho', 266, 'Lesotho loti', 'L', 'LSL'),
(123, 'LR', 'Liberia', 231, 'Liberian dollar', '$', 'LRD'),
(124, 'LY', 'Libya', 218, 'Libyan dinar', 'Ù„.Ø¯', 'LYD'),
(125, 'LI', 'Liechtenstein', 423, 'Swiss franc', 'Fr', 'CHF'),
(126, 'LT', 'Lithuania', 370, 'Euro', 'â‚¬', 'EUR'),
(127, 'LU', 'Luxembourg', 352, 'Euro', 'â‚¬', 'EUR'),
(128, 'MO', 'Macau S.A.R.', 853, '', '', ''),
(129, 'MK', 'Macedonia', 389, '', '', ''),
(130, 'MG', 'Madagascar', 261, 'Malagasy ariary', 'Ar', 'MGA'),
(131, 'MW', 'Malawi', 265, 'Malawian kwacha', 'MK', 'MWK'),
(132, 'MY', 'Malaysia', 60, 'Malaysian ringgit', 'RM', 'MYR'),
(133, 'MV', 'Maldives', 960, 'Maldivian rufiyaa', '.Þƒ', 'MVR'),
(134, 'ML', 'Mali', 223, 'West African CFA fra', 'Fr', 'XOF'),
(135, 'MT', 'Malta', 356, 'Euro', 'â‚¬', 'EUR'),
(136, 'XM', 'Man (Isle of)', 44, '', '', ''),
(137, 'MH', 'Marshall Islands', 692, 'United States dollar', '$', 'USD'),
(138, 'MQ', 'Martinique', 596, '', '', ''),
(139, 'MR', 'Mauritania', 222, 'Mauritanian ouguiya', 'UM', 'MRO'),
(140, 'MU', 'Mauritius', 230, 'Mauritian rupee', 'â‚¨', 'MUR'),
(141, 'YT', 'Mayotte', 269, '', '', ''),
(142, 'MX', 'Mexico', 52, 'Mexican peso', '$', 'MXN'),
(143, 'FM', 'Micronesia', 691, 'Micronesian dollar', '$', ''),
(144, 'MD', 'Moldova', 373, 'Moldovan leu', 'L', 'MDL'),
(145, 'MC', 'Monaco', 377, 'Euro', 'â‚¬', 'EUR'),
(146, 'MN', 'Mongolia', 976, 'Mongolian tÃ¶grÃ¶g', 'â‚®', 'MNT'),
(147, 'MS', 'Montserrat', 1664, 'East Caribbean dolla', '$', 'XCD'),
(148, 'MA', 'Morocco', 212, 'Moroccan dirham', 'Ø¯.Ù….', 'MAD'),
(149, 'MZ', 'Mozambique', 258, 'Mozambican metical', 'MT', 'MZN'),
(150, 'MM', 'Myanmar', 95, 'Burmese kyat', 'Ks', 'MMK'),
(151, 'NA', 'Namibia', 264, 'Namibian dollar', '$', 'NAD'),
(152, 'NR', 'Nauru', 674, 'Australian dollar', '$', 'AUD'),
(153, 'NP', 'Nepal', 977, 'Nepalese rupee', 'â‚¨', 'NPR'),
(154, 'AN', 'Netherlands Antilles', 599, '', '', ''),
(155, 'NL', 'Netherlands The', 31, '', '', ''),
(156, 'NC', 'New Caledonia', 687, 'CFP franc', 'Fr', 'XPF'),
(157, 'NZ', 'New Zealand', 64, 'New Zealand dollar', '$', 'NZD'),
(158, 'NI', 'Nicaragua', 505, 'Nicaraguan cÃ³rdoba', 'C$', 'NIO'),
(159, 'NE', 'Niger', 227, 'West African CFA fra', 'Fr', 'XOF'),
(160, 'NG', 'Nigeria', 234, 'Nigerian naira', 'â‚¦', 'NGN'),
(161, 'NU', 'Niue', 683, 'New Zealand dollar', '$', 'NZD'),
(162, 'NF', 'Norfolk Island', 672, '', '', ''),
(163, 'MP', 'Northern Mariana Islands', 1670, '', '', ''),
(164, 'NO', 'Norway', 47, 'Norwegian krone', 'kr', 'NOK'),
(165, 'OM', 'Oman', 968, 'Omani rial', 'Ø±.Ø¹.', 'OMR'),
(166, 'PK', 'Pakistan', 92, 'Pakistani rupee', 'â‚¨', 'PKR'),
(167, 'PW', 'Palau', 680, 'Palauan dollar', '$', ''),
(168, 'PS', 'Palestinian Territory Occupied', 970, '', '', ''),
(169, 'PA', 'Panama', 507, 'Panamanian balboa', 'B/.', 'PAB'),
(170, 'PG', 'Papua new Guinea', 675, 'Papua New Guinean ki', 'K', 'PGK'),
(171, 'PY', 'Paraguay', 595, 'Paraguayan guaranÃ­', 'â‚²', 'PYG'),
(172, 'PE', 'Peru', 51, 'Peruvian nuevo sol', 'S/.', 'PEN'),
(173, 'PH', 'Philippines', 63, 'Philippine peso', 'â‚±', 'PHP'),
(174, 'PN', 'Pitcairn Island', 0, '', '', ''),
(175, 'PL', 'Poland', 48, 'Polish zÅ‚oty', 'zÅ‚', 'PLN'),
(176, 'PT', 'Portugal', 351, 'Euro', 'â‚¬', 'EUR'),
(177, 'PR', 'Puerto Rico', 1787, '', '', ''),
(178, 'QA', 'Qatar', 974, 'Qatari riyal', 'Ø±.Ù‚', 'QAR'),
(179, 'RE', 'Reunion', 262, '', '', ''),
(180, 'RO', 'Romania', 40, 'Romanian leu', 'lei', 'RON'),
(181, 'RU', 'Russia', 70, 'Russian ruble', '', 'RUB'),
(182, 'RW', 'Rwanda', 250, 'Rwandan franc', 'Fr', 'RWF'),
(183, 'SH', 'Saint Helena', 290, 'Saint Helena pound', 'Â£', 'SHP'),
(184, 'KN', 'Saint Kitts And Nevis', 1869, 'East Caribbean dolla', '$', 'XCD'),
(185, 'LC', 'Saint Lucia', 1758, 'East Caribbean dolla', '$', 'XCD'),
(186, 'PM', 'Saint Pierre and Miquelon', 508, '', '', ''),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, 'East Caribbean dolla', '$', 'XCD'),
(188, 'WS', 'Samoa', 684, 'Samoan tÄlÄ', 'T', 'WST'),
(189, 'SM', 'San Marino', 378, 'Euro', 'â‚¬', 'EUR'),
(190, 'ST', 'Sao Tome and Principe', 239, 'SÃ£o TomÃ© and PrÃ­n', 'Db', 'STD'),
(191, 'SA', 'Saudi Arabia', 966, 'Saudi riyal', 'Ø±.Ø³', 'SAR'),
(192, 'SN', 'Senegal', 221, 'West African CFA fra', 'Fr', 'XOF'),
(193, 'RS', 'Serbia', 381, 'Serbian dinar', 'Ð´Ð¸Ð½. or din.', 'RSD'),
(194, 'SC', 'Seychelles', 248, 'Seychellois rupee', 'â‚¨', 'SCR'),
(195, 'SL', 'Sierra Leone', 232, 'Sierra Leonean leone', 'Le', 'SLL'),
(196, 'SG', 'Singapore', 65, 'Brunei dollar', '$', 'BND'),
(197, 'SK', 'Slovakia', 421, 'Euro', 'â‚¬', 'EUR'),
(198, 'SI', 'Slovenia', 386, 'Euro', 'â‚¬', 'EUR'),
(199, 'XG', 'Smaller Territories of the UK', 44, '', '', ''),
(200, 'SB', 'Solomon Islands', 677, 'Solomon Islands doll', '$', 'SBD'),
(201, 'SO', 'Somalia', 252, 'Somali shilling', 'Sh', 'SOS'),
(202, 'ZA', 'South Africa', 27, 'South African rand', 'R', 'ZAR'),
(203, 'GS', 'South Georgia', 0, '', '', ''),
(204, 'SS', 'South Sudan', 211, 'South Sudanese pound', 'Â£', 'SSP'),
(205, 'ES', 'Spain', 34, 'Euro', 'â‚¬', 'EUR'),
(206, 'LK', 'Sri Lanka', 94, 'Sri Lankan rupee', 'Rs or à¶»à·”', 'LKR'),
(207, 'SD', 'Sudan', 249, 'Sudanese pound', 'Ø¬.Ø³.', 'SDG'),
(208, 'SR', 'Suriname', 597, 'Surinamese dollar', '$', 'SRD'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, '', '', ''),
(210, 'SZ', 'Swaziland', 268, 'Swazi lilangeni', 'L', 'SZL'),
(211, 'SE', 'Sweden', 46, 'Swedish krona', 'kr', 'SEK'),
(212, 'CH', 'Switzerland', 41, 'Swiss franc', 'Fr', 'CHF'),
(213, 'SY', 'Syria', 963, 'Syrian pound', 'Â£ or Ù„.Ø³', 'SYP'),
(214, 'TW', 'Taiwan', 886, 'New Taiwan dollar', '$', 'TWD'),
(215, 'TJ', 'Tajikistan', 992, 'Tajikistani somoni', 'Ð…Ðœ', 'TJS'),
(216, 'TZ', 'Tanzania', 255, 'Tanzanian shilling', 'Sh', 'TZS'),
(217, 'TH', 'Thailand', 66, 'Thai baht', 'à¸¿', 'THB'),
(218, 'TG', 'Togo', 228, 'West African CFA fra', 'Fr', 'XOF'),
(219, 'TK', 'Tokelau', 690, '', '', ''),
(220, 'TO', 'Tonga', 676, 'Tongan paÊ»anga', 'T$', 'TOP'),
(221, 'TT', 'Trinidad And Tobago', 1868, 'Trinidad and Tobago ', '$', 'TTD'),
(222, 'TN', 'Tunisia', 216, 'Tunisian dinar', 'Ø¯.Øª', 'TND'),
(223, 'TR', 'Turkey', 90, 'Turkish lira', '', 'TRY'),
(224, 'TM', 'Turkmenistan', 7370, 'Turkmenistan manat', 'm', 'TMT'),
(225, 'TC', 'Turks And Caicos Islands', 1649, 'United States dollar', '$', 'USD'),
(226, 'TV', 'Tuvalu', 688, 'Australian dollar', '$', 'AUD'),
(227, 'UG', 'Uganda', 256, 'Ugandan shilling', 'Sh', 'UGX'),
(228, 'UA', 'Ukraine', 380, 'Ukrainian hryvnia', 'â‚´', 'UAH'),
(229, 'AE', 'United Arab Emirates', 971, 'United Arab Emirates', 'Ø¯.Ø¥', 'AED'),
(230, 'GB', 'United Kingdom', 44, 'British pound', 'Â£', 'GBP'),
(231, 'US', 'United States', 1, 'United States dollar', '$', 'USD'),
(232, 'UM', 'United States Minor Outlying Islands', 1, '', '', ''),
(233, 'UY', 'Uruguay', 598, 'Uruguayan peso', '$', 'UYU'),
(234, 'UZ', 'Uzbekistan', 998, 'Uzbekistani som', '', 'UZS'),
(235, 'VU', 'Vanuatu', 678, 'Vanuatu vatu', 'Vt', 'VUV'),
(236, 'VA', 'Vatican City State (Holy See)', 39, '', '', ''),
(237, 'VE', 'Venezuela', 58, 'Venezuelan bolÃ­var', 'Bs F', 'VEF'),
(238, 'VN', 'Vietnam', 84, 'Vietnamese Ä‘á»“ng', 'â‚«', 'VND'),
(239, 'VG', 'Virgin Islands (British)', 1284, '', '', ''),
(240, 'VI', 'Virgin Islands (US)', 1340, '', '', ''),
(241, 'WF', 'Wallis And Futuna Islands', 681, '', '', ''),
(242, 'EH', 'Western Sahara', 212, '', '', ''),
(243, 'YE', 'Yemen', 967, 'Yemeni rial', 'ï·¼', 'YER'),
(244, 'YU', 'Yugoslavia', 38, '', '', ''),
(245, 'ZM', 'Zambia', 260, 'Zambian kwacha', 'ZK', 'ZMW'),
(246, 'ZW', 'Zimbabwe', 263, 'Botswana pula', 'P', 'BWP');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(1) DEFAULT 1,
  `rank` bigint(20) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `protocol`, `host`, `port`, `user`, `password`, `from`, `to`, `user_name`, `lang`, `isActive`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, 'ssl', 'smtp.yandex.com.tr', 465, 'emrekilic@mutfakyapim.com', 'mutfak35?', 'emrekilic@mutfakyapim.com', 'emrekilic@mutfakyapim.com', 'Site İletişim Formu Mesajı | Excellence Halı', 'tr', 1, 1, '2021-01-08 00:08:59', '2023-01-02 07:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `gallery_type` varchar(50) DEFAULT NULL,
  `folder_name` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(1) DEFAULT 1,
  `isCover` tinyint(1) DEFAULT 0,
  `rank` bigint(20) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `url`, `img_url`, `title`, `gallery_type`, `folder_name`, `content`, `lang`, `isActive`, `isCover`, `rank`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(2, 'resim-galerisi', 'cdd45a785d878036949732976f533763.webp', 'Resim Galerisi', 'images', 'resim-galerisi', NULL, 'tr', 1, 0, 2, '2022-11-23 08:57:12', '2022-11-23 08:57:12', '2022-11-23 08:57:01'),
(3, 'video-galerisi', '60cb46ba27341bf2ed98fddeb35d3e2d.webp', 'Video Galerisi', 'video_urls', 'video-galerisi', NULL, 'tr', 1, 0, 3, '2022-11-23 09:14:36', '2022-11-23 09:14:36', '2022-11-23 09:14:23'),
(4, 'sertifikalarimiz', NULL, 'Sertifikalarimiz', 'images', 'sertifikalarimiz', NULL, 'tr', 1, 0, 3, '2022-12-16 13:12:46', '2022-12-16 13:14:51', '2022-12-16 13:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `home_items`
--

CREATE TABLE `home_items` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(1) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_items`
--

INSERT INTO `home_items` (`id`, `title`, `content`, `img_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(1, 'Kariyer', 'Kariyer seçimi tüm yaşamımızı etkilerken, size yol göstermekten mutluluk duyuyoruz.', '32a58b5d9befa56be822870047275ad6.webp', 'tr', 1, 1, '2022-03-05 21:32:07', '2022-03-05 21:32:07', '2022-03-05 21:31:19'),
(2, 'Yaşam', 'Eğitim, hobiler ve sosyal hayatımız. Hepsi değerli, hepsi için birlikte yürüyoruz.', '2f4bf615f00d671632219a8b32f8632a.webp', 'tr', 2, 1, '2022-03-05 21:34:05', '2022-03-05 21:34:05', '2022-03-05 21:33:42'),
(3, 'Gelişim', 'Kişisel ve sosyal gelişim için gerekli olan her tesisi öğrencilerimize sunuyoruz.', 'caeda11611c6667b118045829d3f4200.webp', 'tr', 3, 1, '2022-03-05 21:34:21', '2022-03-05 21:34:21', '2022-03-05 21:34:07'),
(4, 'Bilim &amp; Teknoloji', 'Geleceği, bugünü yakalayarak değiştirebiliriz. Bilim ve teknolojiyi takip etmek görevimiz.', 'b5b6ce6aebdf4bc219e238a6ce804985.webp', 'tr', 4, 1, '2022-03-05 21:34:38', '2022-03-05 21:34:38', '2022-03-05 21:34:23'),
(5, 'Kayıt &amp; Kabul', 'Ön kayıt ile başlayan kayıt süreciyle birlikte geleceğine yön verecek ilk adımı atabilirsin.', '345a2385e85426eff2c0c8cf74e9650f.webp', 'tr', 5, 1, '2022-03-05 21:44:01', '2022-03-05 21:44:01', '2022-03-05 21:43:25'),
(6, 'Okulda Yaşam', 'Sosyal ve sportif aktiviteler ile eğitimin sadece dersliklerde olmayacağını keşfedebilirsin.', '2e925ad429e90632d976ed6c13283cce.webp', 'tr', 6, 1, '2022-03-05 21:44:16', '2022-03-05 21:44:16', '2022-03-05 21:44:02'),
(7, 'Bölümler', 'Teknolojiye yön veren bölümler arasında sana en uygun olanı seçip, kariyerini planlayabilirsin.', '5b21232e34ddf1d052eb2350dbd1a7f6.webp', 'tr', 7, 1, '2022-03-05 21:44:31', '2022-03-05 21:44:31', '2022-03-05 21:44:19'),
(8, 'Akademik Birimler', 'Ortak, alan ve bölüm derslerini de alarak hem mesleki gelişimini tamamlayabilir hem de üniversite sınavlarına hazırlanabilirsin.', '15034e2b616db388ea01f9126a7505f7.webp', 'tr', 8, 1, '2022-03-05 21:44:49', '2022-03-05 21:44:49', '2022-03-05 21:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `gallery_id`, `url`, `img_url`, `title`, `description`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(13, 2, '01337291ceb4e97d2302879096d9dd58.webp', NULL, NULL, NULL, 'tr', 1, 1, '2022-11-23 08:57:22', '2022-11-23 08:57:22', NULL),
(14, 4, '5a3a76780a3014de534a520be3d99e0e.webp', NULL, NULL, NULL, 'tr', 2, 1, '2022-12-16 13:36:54', '2022-12-16 13:36:54', NULL),
(15, 4, 'd5f34ac01440645268f5f8d20c5196c5.webp', NULL, NULL, NULL, 'tr', 3, 1, '2022-12-16 13:36:56', '2022-12-16 13:36:56', NULL),
(16, 4, '3f6f187c72d7d24a7e085ebe2537ddff.webp', NULL, NULL, NULL, 'tr', 11, 1, '2022-12-16 13:36:56', '2022-12-16 13:37:38', NULL),
(17, 4, '1b45f86f5e57febf483c61514ca45dd5.webp', NULL, NULL, NULL, 'tr', 4, 1, '2022-12-16 13:36:58', '2022-12-16 13:37:38', NULL),
(18, 4, '8faba6eebb182e5ed376f7b1ec92a3f9.webp', NULL, NULL, NULL, 'tr', 5, 1, '2022-12-16 13:37:02', '2022-12-16 13:37:38', NULL),
(19, 4, '1ad7ea07fcf393010b815fbf9fd621d2.webp', NULL, NULL, NULL, 'tr', 6, 1, '2022-12-16 13:37:05', '2022-12-16 13:37:38', NULL),
(20, 4, '7a308f97a5b9e60b789363fe019a12f6.webp', NULL, NULL, NULL, 'tr', 7, 1, '2022-12-16 13:37:07', '2022-12-16 13:37:38', NULL),
(21, 4, '0503292ad4f476a879a9b5aed94503fb.webp', NULL, NULL, NULL, 'tr', 8, 1, '2022-12-16 13:37:09', '2022-12-16 13:37:38', NULL),
(22, 4, '2ebf426c097731185c45d475e615cf42.webp', NULL, NULL, NULL, 'tr', 9, 1, '2022-12-16 13:37:12', '2022-12-16 13:37:38', NULL),
(23, 4, '6a26a7ec38d3f6158902cbd9854b1a50.webp', NULL, NULL, NULL, 'tr', 10, 1, '2022-12-16 13:37:14', '2022-12-16 13:37:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) NOT NULL,
  `name` char(49) DEFAULT NULL,
  `code` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`) VALUES
(1, 'English', 'en'),
(2, 'Afar', 'aa'),
(3, 'Abkhazian', 'ab'),
(4, 'Afrikaans', 'af'),
(5, 'Amharic', 'am'),
(6, 'Arabic', 'ar'),
(7, 'Assamese', 'as'),
(8, 'Aymara', 'ay'),
(9, 'Azerbaijani', 'az'),
(10, 'Bashkir', 'ba'),
(11, 'Belarusian', 'be'),
(12, 'Bulgarian', 'bg'),
(13, 'Bihari', 'bh'),
(14, 'Bislama', 'bi'),
(15, 'Bengali/Bangla', 'bn'),
(16, 'Tibetan', 'bo'),
(17, 'Breton', 'br'),
(18, 'Catalan', 'ca'),
(19, 'Corsican', 'co'),
(20, 'Czech', 'cs'),
(21, 'Welsh', 'cy'),
(22, 'Danish', 'da'),
(23, 'German', 'de'),
(24, 'Bhutani', 'dz'),
(25, 'Greek', 'el'),
(26, 'Esperanto', 'eo'),
(27, 'Spanish', 'es'),
(28, 'Estonian', 'et'),
(29, 'Basque', 'eu'),
(30, 'Persian', 'fa'),
(31, 'Finnish', 'fi'),
(32, 'Fiji', 'fj'),
(33, 'Faeroese', 'fo'),
(34, 'French', 'fr'),
(35, 'Frisian', 'fy'),
(36, 'Irish', 'ga'),
(37, 'Scots/Gaelic', 'gd'),
(38, 'Galician', 'gl'),
(39, 'Guarani', 'gn'),
(40, 'Gujarati', 'gu'),
(41, 'Hausa', 'ha'),
(42, 'Hindi', 'hi'),
(43, 'Croatian', 'hr'),
(44, 'Hungarian', 'hu'),
(45, 'Armenian', 'hy'),
(46, 'Interlingua', 'ia'),
(47, 'Interlingue', 'ie'),
(48, 'Inupiak', 'ik'),
(49, 'Indonesian', 'in'),
(50, 'Icelandic', 'is'),
(51, 'Italian', 'it'),
(52, 'Hebrew', 'iw'),
(53, 'Japanese', 'ja'),
(54, 'Yiddish', 'ji'),
(55, 'Javanese', 'jw'),
(56, 'Georgian', 'ka'),
(57, 'Kazakh', 'kk'),
(58, 'Greenlandic', 'kl'),
(59, 'Cambodian', 'km'),
(60, 'Kannada', 'kn'),
(61, 'Korean', 'ko'),
(62, 'Kashmiri', 'ks'),
(63, 'Kurdish', 'ku'),
(64, 'Kirghiz', 'ky'),
(65, 'Latin', 'la'),
(66, 'Lingala', 'ln'),
(67, 'Laothian', 'lo'),
(68, 'Lithuanian', 'lt'),
(69, 'Latvian/Lettish', 'lv'),
(70, 'Malagasy', 'mg'),
(71, 'Maori', 'mi'),
(72, 'Macedonian', 'mk'),
(73, 'Malayalam', 'ml'),
(74, 'Mongolian', 'mn'),
(75, 'Moldavian', 'mo'),
(76, 'Marathi', 'mr'),
(77, 'Malay', 'ms'),
(78, 'Maltese', 'mt'),
(79, 'Burmese', 'my'),
(80, 'Nauru', 'na'),
(81, 'Nepali', 'ne'),
(82, 'Dutch', 'nl'),
(83, 'Norwegian', 'no'),
(84, 'Occitan', 'oc'),
(85, '(Afan)/Oromoor/Oriya', 'om'),
(86, 'Punjabi', 'pa'),
(87, 'Polish', 'pl'),
(88, 'Pashto/Pushto', 'ps'),
(89, 'Portuguese', 'pt'),
(90, 'Quechua', 'qu'),
(91, 'Rhaeto-Romance', 'rm'),
(92, 'Kirundi', 'rn'),
(93, 'Romanian', 'ro'),
(94, 'Russian', 'ru'),
(95, 'Kinyarwanda', 'rw'),
(96, 'Sanskrit', 'sa'),
(97, 'Sindhi', 'sd'),
(98, 'Sangro', 'sg'),
(99, 'Serbo-Croatian', 'sh'),
(100, 'Singhalese', 'si'),
(101, 'Slovak', 'sk'),
(102, 'Slovenian', 'sl'),
(103, 'Samoan', 'sm'),
(104, 'Shona', 'sn'),
(105, 'Somali', 'so'),
(106, 'Albanian', 'sq'),
(107, 'Serbian', 'sr'),
(108, 'Siswati', 'ss'),
(109, 'Sesotho', 'st'),
(110, 'Sundanese', 'su'),
(111, 'Swedish', 'sv'),
(112, 'Swahili', 'sw'),
(113, 'Tamil', 'ta'),
(114, 'Telugu', 'te'),
(115, 'Tajik', 'tg'),
(116, 'Thai', 'th'),
(117, 'Tigrinya', 'ti'),
(118, 'Turkmen', 'tk'),
(119, 'Tagalog', 'tl'),
(120, 'Setswana', 'tn'),
(121, 'Tonga', 'to'),
(122, 'Turkish', 'tr'),
(123, 'Tsonga', 'ts'),
(124, 'Tatar', 'tt'),
(125, 'Twi', 'tw'),
(126, 'Ukrainian', 'uk'),
(127, 'Urdu', 'ur'),
(128, 'Uzbek', 'uz'),
(129, 'Vietnamese', 'vi'),
(130, 'Volapuk', 'vo'),
(131, 'Wolof', 'wo'),
(132, 'Xhosa', 'xh'),
(133, 'Yoruba', 'yo'),
(134, 'Chinese', 'zh'),
(135, 'Zulu', 'zu');

-- --------------------------------------------------------

--
-- Table structure for table `linguo_languages`
--

CREATE TABLE `linguo_languages` (
  `language_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `is_master` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linguo_language_files`
--

CREATE TABLE `linguo_language_files` (
  `file_id` int(11) UNSIGNED NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linguo_language_strings`
--

CREATE TABLE `linguo_language_strings` (
  `string_id` int(11) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL DEFAULT 0,
  `top_id` int(11) NOT NULL DEFAULT 0,
  `position` enum('HEADER','HEADER_RIGHT','MOBILE','FOOTER','FOOTER2','FOOTER3') DEFAULT 'HEADER',
  `target` enum('_blank','_self','_parent','_top') DEFAULT '_self',
  `title` longtext DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `showServices` tinyint(4) DEFAULT 0,
  `showSectors` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `page_id`, `top_id`, `position`, `target`, `title`, `url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `showServices`, `showSectors`) VALUES
(1, 0, 0, 'HEADER', '_self', 'Anasayfa', '/', 'tr', 1, 1, '2021-12-28 14:17:07', '2021-12-28 14:51:47', 0, 0),
(2, 0, 0, 'HEADER', '_self', 'Koleksiyonlar', '/koleksiyonlar', 'tr', 2, 1, '2022-11-14 14:15:06', '2023-01-02 12:35:34', 0, 0),
(3, 1, 0, 'HEADER', '_self', 'Hakkımızda', NULL, 'tr', 3, 1, '2022-01-14 12:40:58', '2023-01-02 12:53:49', 0, 0),
(4, 1, 3, 'HEADER', '_self', 'Biz Kimiz?', NULL, 'tr', 4, 1, '2022-01-03 07:44:44', '2023-01-02 12:38:54', 0, 0),
(5, 0, 0, 'HEADER', '_self', 'Galeri', '/galeriler/galeri/resim-galerisi', 'tr', 8, 1, '2022-12-13 11:25:46', '2023-01-02 12:54:26', 0, 0),
(6, 0, 0, 'HEADER', '_self', 'Blog', '/blog', 'tr', 9, 1, '2022-11-21 12:37:52', '2023-01-02 12:54:26', 0, 0),
(7, 0, 0, 'HEADER', '_self', 'İletişim', '/iletisim', 'tr', 10, 1, '2022-01-03 07:52:56', '2023-01-02 12:54:26', 0, 0),
(8, 1, 0, 'FOOTER', '_self', 'Hakkımızda', NULL, 'tr', 11, 1, '2022-03-05 11:46:13', '2023-01-02 12:54:26', 0, 0),
(9, 0, 0, 'FOOTER3', '_self', 'İletişim', '/iletisim', 'tr', 12, 1, '2022-03-05 14:31:32', '2023-01-02 12:54:26', 0, 0),
(10, 0, 0, 'FOOTER3', '_self', 'Galeri', '/galeriler/galeri/resim-galerisi', 'tr', 13, 1, '2022-12-13 11:25:46', '2023-01-02 12:54:26', 0, 0),
(11, 0, 0, 'FOOTER3', '_self', 'Blog', '/blog', 'tr', 14, 1, '2022-11-21 12:37:52', '2023-01-02 12:54:26', 0, 0),
(12, 9, 0, 'FOOTER3', '_self', 'KVKK', NULL, 'tr', 15, 1, '2022-03-05 22:02:08', '2023-01-02 12:54:26', 0, 0),
(13, 2, 3, 'HEADER', '_self', 'Misyonumuz', NULL, 'tr', 5, 1, '2023-01-02 12:39:17', '2023-01-02 12:39:27', 0, 0),
(14, 3, 3, 'HEADER', '_self', 'Vizyonumuz', NULL, 'tr', 6, 1, '2023-01-02 12:54:05', '2023-01-02 12:54:22', 0, 0),
(15, 4, 3, 'HEADER', '_self', 'Değerlerimiz', NULL, 'tr', 7, 1, '2023-01-02 12:54:16', '2023-01-02 12:54:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `banner_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL,
  `type` enum('SIMPLE','ABOUT','KVKK','CONTENT') DEFAULT 'SIMPLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `url`, `title`, `content`, `img_url`, `banner_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`, `type`) VALUES
(1, 'biz-kimiz', 'Biz Kimiz?', '<p>1988 yılında İzmir Alsancak semtinde faaliyete geçen firmamız 1996 yılında piyasadaki gelişmeler ve büyümesi neticesinde YALÇINKAYA HALICILIK MOBİLYA TİC. VE SAN. LTD. ŞTİ. Ünvanını almıştır. 2013 yılında İzmir Menderes’te 4000 m2 kullanım alanlı yeni modern depolarımızda uzman kadrosuyla yıllara dayanan tecrübesi ile faaliyet göstermektedir.</p>\r\n<p>Yeni işyerimizde zemin sektörüne giriş yapan firmamız bu süreçte laminat parke, duvardan duvara halı, pvc yer döşemeleri ürün grubuna katılmıştır.<br />Firmamız kendi markamız olan Excellence halı yurtiçi ve yurtdışı bayilik dağıtımı, Dinarsu halı, Efsane halı, Gümüşsuyu Halı, Linea halı, Sarar Altınsar Halı ve Battaniye Ege Bölge Bayiliği, Arçelik bayii, Lamiset ve AGT Parke İzmir Bölge Bayisidir.</p>\r\n<p>Düzenli ve sürekli olarak kendi araç filosuyla dağıtım hizmeti veren firmamız geçmişten gelen tecrübesiyle, geniş ürün yelpazesiyle, yüksek stok miktarıyla, sektörümüze ilkeli, doğru ve dürüst hizmet anlayışıyla uygun fiyatlı ürünler sunmayı prensip edinmiştir.</p>', '34e11894856d01347bcd31a8b85de014.webp', '6f39d61bc46022e50057e8def3595652.webp', 'tr', 1, 1, '2022-02-23 06:24:54', '2023-01-02 12:37:41', '2022-02-23 06:24:26', 'ABOUT'),
(2, 'misyonumuz', 'Misyonumuz', '<p>Kalite odaklı, sürekli yenilik ve farklılık yaratarak müşteri memnuniyetine duyarlı teknolojik gelişmelere açık her zaman ve en güzel ürünü en hesaplı fiyatla ulaştırmayı kendimize bir görev olarak görüyoruz. Sosyal sorumluluk sahibi olarak çevremize faydalı ürünler ve hizmetler vermeyi ilke ediniyoruz.</p>', NULL, '79f32b95fde202ab853ebcd3af637eaf.webp', 'tr', 2, 1, '2022-02-28 12:08:02', '2023-01-02 12:40:45', '2022-02-28 12:07:27', 'ABOUT'),
(3, 'vizyonumuz', 'Vizyonumuz', '<p>Sektörde yenilikleri ve trendleri güncel olarak takip eden ve sektörün önde gelen markalarını en iyi ve kusursuz hizmet anlayışıyla iş ortaklarımıza temin ve tedarik etmektir.</p>', '204b864028a5377a591f4e8661bc68da.webp', '4fe27a8599e9da522406003474aec303.webp', 'tr', 3, 1, '2022-02-28 13:36:35', '2023-01-02 12:41:52', '2022-02-28 13:35:49', 'ABOUT'),
(4, 'degerlerimiz', 'Değerlerimiz', '<ul>\r\n<li>Her zaman açık ve dürüst olmak.</li>\r\n<li>Müşteri odaklı düşünmek ve davranmak.</li>\r\n<li>Bilgi, teknolojik ve yenilik yanlısı olmak</li>\r\n<li>Girişken olmak ve özverili olmak.</li>\r\n<li>Kaynakları etkin kullanmak.</li>\r\n<li>İnsana değer vermek.</li>\r\n<li>Çevreye ve topluma karşı sorumlulukları bilmek.</li>\r\n<li>Yenilikçi olmak</li>\r\n</ul>', 'a536ed01632706e6d3736c7c469f8977.webp', NULL, 'tr', 4, 1, '2022-12-12 13:41:02', '2023-01-02 12:51:49', '2022-12-12 13:40:37', 'ABOUT'),
(5, 'ilkeler-ve-hedefler', 'İlkeler ve Hedefler', '<p>Ülke geneline yayılmış tüm müşterilerimize sunmuş olduğumuz, kaliteli ürün çeşitliliğini genişletmek, üretim kapasitesini ve niteliğini her geçen yıl dünya standartları paralelinde arttırmak siz değerli müşterilerimize verilmiş sözümüzdür.<br />Birlikte bu günlerimize geldiğimiz sizlerin, her sene bir önceki yıla göre çok daha karlı ve değerli olabilmesi, bizlerin <strong>KALİTE-DÜRÜSTLÜK-YENİLİKÇİLİK</strong> kanunlarının tamamlayıcısı olan <strong>MÜŞTERİ ve TOPLUM MEMNUNİYETİ</strong> ilkesini oluşturmaktadır. Ticari Profil üretimindeki kalitesi ve geniş ürün çeşidi ile AKIN HADDE, sektöründeki seçkin firmalar arasındaki konumunu her geçen gün daha da güçlendirmektedir.</p>', 'a4986ebf18218310f486f140849fdc08.webp', NULL, 'tr', 5, 1, '2022-12-12 13:41:40', '2022-12-15 10:46:01', '2022-12-12 13:41:15', 'ABOUT'),
(6, 'cevre-politikasi', 'Çevre Politikası', '<p>Çelik sektörünün önde gelen şirketlerinden biri olan Akın Haddecilik A.Ş.;</p>\r\n<p>Yönetim ekibi, çalışanları ve çözüm ortakları ile, sürdürülebilir ve çevreye duyarlı bir şirket olarak son derece hassas ve önemli adımlar atmaktadır. Çünkü Akın Ailesi, bugünün doğal kaynaklarının geçmiş nesillerden miras, gelecek nesillerden ise emanet alındığının bilincindedir. Bu görüş Akın Ailesine doğayı koruma ve kaynaklarını verimli kullanması için büyük bir sorumluluk yükler. Bu nedenle şirketimiz hammadde alım aşamasından son ürün haline getirilmesi aşamasına kadar geçen süreçte, üretimimizin ve hizmetlerimizin boyutlarını dikkate alarak çevresel etkilerini belirler ve yönetim kadrosu ile bu etkileri kontrol altına alacak programlar hazırlayarak çevreye zarar vermemeyi ve sadece günümüzde değil gelecekte de adından gururla bahsedilen hem ülkemiz hem de dünya için güvenilir ve sürdürülebilir bir şirket olmayı hedefler.</p>', '7b87b886408fa964d94f0c00e09002e3.webp', '4af2350c08fcbd1d44bba7c48d0e66ab.webp', 'tr', 6, 1, '2022-03-01 08:33:59', '2022-12-16 13:12:20', '2022-03-01 08:32:51', 'CONTENT'),
(7, 'enerji-politikasi', 'Enerji Politikası', '<p>Çelik sektörünün önde gelen şirketlerinden biri olan Akın Haddecilik A.Ş.;</p>\r\n<p>Enerji ve doğal kaynaklarımızı, yaşama saygı duyarak verimli kullanmayı, Enerji performansını arttırmak için hazırlamış olduğu enerji yönetim sistemi ile ilgili yapmış olduğumuz çalışmaları sürekli iyileştirmeyi ve sürdürülebilir kılmayı hedefler.</p>\r\n<p>Sektördeki yenilikleri ve gelişmeleri takip ederek, hazırlamış olduğumuz enerji yönetim sistemini, üretimimizin her aşamasına entegre ederek, hedeflemiş olduğumuz verimli tüketim noktasına ulaşmayı ve sürdürülebilirlik adına büyük bir adım atmayı hedefliyoruz.</p>\r\n<p><strong>Akın Hadde</strong></p>\r\n<p>Yapmış olduğu GES (Güneş enerjisi santralleri) yatırımları sayesinde <strong>5milyon kWh/yıl </strong>(1500 hanenin yaklaşık 1 yıllık tüketimine eşdeğer)<strong> </strong>yenilenebilir enerji üretimi yapmakta ve çeliğini kendi enerjisini kullanarak üretmektedir.</p>\r\n<p>İlk kurulduğu yıllarda yapmış olduğu yağmur suyu toplama sistemini günümüzde geliştirerek ve büyüterek tesisin farklı bölgelerinde bulunan havuzlarda depolayarak, üretiminin farklı aşamalarında kullanan Akın Hadde bu sistem ile yıllık yaklaşık 6000 ton (300 hanenin yaklaşık 1 yıllık tüketimine eşdeğer) su tasarrufu sağlamaktadır.</p>', 'b651039e6fc97576f3839e2e470786e1.webp', 'd57f187b5a7d462917847a7cda84783d.webp', 'tr', 7, 1, '2022-12-13 11:05:43', '2022-12-16 13:12:26', '2022-12-13 11:05:22', 'CONTENT'),
(8, 'is-sagligi-ve-is-guvenligi-politikasi', 'İş Sağlığı ve İş Güvenliği Politikası', '<p>Akın Haddecilik A.Ş olarak, iş sağlığı ve güvenliği konusunda yasal şart ve sorumluluklarımızı eksiksiz bir şekilde yerine getirmekte olup, eğitimler ve özel programlar aracılığıyla çalışanlarımızın iş sağlığı ve iş güvenliği bilincini en üst seviyelere çıkarmayı, iş kazalarına ve mesleki hastalıklara sebebiyet verebilecek olan riskleri önceden tespit ederek, yaşanabilecek tehlikeleri azaltmayı ve ortadan kaldırmayı hedeflemekteyiz.</p>', 'f31057d249041662786cf81fa8701c5b.webp', '21ce41e07b6a3e0076aa323c4d8e0ca3.webp', 'tr', 8, 1, '2022-03-04 10:51:18', '2022-12-16 13:12:32', '2022-03-04 10:50:29', 'CONTENT'),
(9, 'sirket-gizlilik-politikasi', 'Şirket Gizlilik Politikası', '<p>AKIN HADDECİLİK LTD.ŞTİ., paydaşlarından <strong>Kişisel Verilerle İlgili Genel Aydınlatma Metni</strong>’nde ve <strong>Personel İçin Aydınlatma Metni</strong>’nde açıklanan yollarla toplanan kişisel verilerin, gizliliğinin korunması için azami özen ilkesi çerçevesinde, gereken tüm idari ve teknik önlemleri almakta ve bu verileri, önlemlere uygun şekilde fiziksel ve/veya elektronik ortamda saklamaktadır.</p>\r\n<p>AKIN HADDECİLİK LTD.ŞTİ., topladığı tüm kişisel verileri, ilgili mevzuata ve şirket politikalarına uygun olarak ve yukarıda adı geçen aydınlatma metinlerinde belirtilen şartlarda işler, saklar veya paylaşır. AKIN HADDECİLİK LTD.ŞTİ., iş birliği içinde olduğu kurum veya kuruluşlarla bilgi paylaşması halinde, bu şirketlerin AKIN HADDECİLİK LTD.ŞTİ.’nın gizlilik standartlarına ve şartlarına uymalarını sağlamak için gerekli önlemleri alır.</p>\r\n<p>AKIN HADDECİLİK LTD.ŞTİ., tüm çalışanlarının da gizlilik politikasına uygun davranmaları ve bu konuda gereken hassasiyeti göstermesini sağlamak için gerekli önlemleri almaktadır. Çalışanlarımız eğitimler yoluyla hem kendi kişisel verileri hem de paydaşlara ait kişisel verilerin korunması hakkında bilgilendirilmektedir.</p>\r\n<p>Bu politikada yer verilen taahhütler AKIN HADDECİLİK LTD.ŞTİ.’nin web sitesi ve diğer kanalları aracılığıyla paylaşılan bilgiler için geçerlidir. Bu sitede veya diğer kanallarda, başka web sitelerine link verilmesi halinde, link verilen web sitelerinin gizlilik ilkeleri ve kullanım şartları geçerli olup ilgili web sitelerinin ziyaret edilmesi nedeniyle uğranabilecek zarardan AKIN HADDECİLİK LTD.ŞTİ. sorumlu değildir.</p>\r\n<p>AKIN HADDECİLİK LTD.ŞTİ., gizlilik politikasına yönelik prensiplerin, güncel tutulması ve başta ilgili mevzuata ve şirket politikalarına uygun hale getirilmesi için bu politikada düzenlenen hususları önceden haber vermeksizin değiştirme hakkını saklı tutar.<br /><br /></p>\r\n<ol>\r\n<li><strong> </strong><strong>Çerez Nedir:</strong> Çerez veya bilinen ismiyle “cookie”, mobil ve masaüstü cihazlar kullanarak sitelerimizi (<a href=\"http://www.akinhadde.com.tr\">akinhadde.com.tr</a> ) ziyaret ettiğinizde bilgisayarınız veya mobil cihazınıza (akıllı telefon, tablet gibi) kaydedilen küçük metin dosyası veya bilgilerdir. Çerezler genellikle geldikleri internet site isimlerini, kullanım ömürlerini (cihazınızda ne kadar süre ile kalacağını) ve rastgele verilen sayılardan oluşan değerler içerir.</li>\r\n<li><strong> </strong><strong>Ne için Kullanıyoruz</strong>: Çerezleri, sitelerimizin daha kolay kullanılması, sizin ilgi ve ihtiyaçlarınıza göre ayarlanması ve kullanıcılarımıza akıllı reklam gösterimi için kişiselleştirme amacıyla kullanıyoruz. İnternet siteleri bu çerez dosyaları okuyup yazabiliyorlar ve bu sayede tanınmanız ve size daha uygun bir internet sitesi sunulması amacıyla sizinle ilgili önemli bilgilerin hatırlanması sağlanıyor (tercih ayarlarınızın hatırlanması gibi). Çerezler ayrıca, sitelerimiz üzerinde gelecekteki hareketlerinizin hızlanmasına da yardımcı olur. Bunlara ek olarak, ziyaretçilerin sitelerimizi nasıl kullandığını anlamak ve sitelerimizin tasarımı ile kullanışlılığını geliştirmek amacıyla çerezleri sitelerimizin kullanımı hakkında istatistiksel bilgiler toplamak için de kullanabiliriz.</li>\r\n<li><strong> </strong><strong>Hangi Türlerini Kullanıyoruz</strong>: Oturum çerezleri (session cookies) ve kalıcı çerezler (persistent cookies) olmak üzere sitelerimiz genelinde iki tür çerez kullanmaktayız. Oturum çerezleri geçici çerezler olup sadece tarayıcınızı kapatıncaya kadar geçerlidirler. Kalıcı çerezler siz silinceye veya süreleri doluncaya (bu şekilde çerezlerin cihazında ne kadar kalacağı, çerezlerin “kullanım ömürlerine” bağlı olacaktır) kadar sabit diskinizde kalırlar.</li>\r\n</ol>\r\n<p><strong><u>Üçüncü Parti Çerezleri (3th Party Cookies)</u></strong></p>\r\n<p>İş ortaklarımız, reklam platformları, sosyal medya platformları ile analitik bilgileri toplama hizmeti veren, sitemiz genelinde kullanılan bu servis sağlayıcılar hizmetlerini sunabilmeleri için sitelerimizi ziyaret ettiğinizde, bizim yerimize cihazlarınıza çerez kaydetmelerine izin verebiliriz. Bu çerezler hakkında daha fazla bilgi edinmek ve bu çerezlerin nasıl kontrol edileceğine ilişkin ayrıntılı bilgi için, lütfen bu üçüncü parti kurum ve kuruluşların gizlilik politikalarını veya çerez politikalarını inceleyiniz.<br /><br /></p>\r\n<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"121\">\r\n<p><strong>Kullanılan Çerez</strong></p>\r\n</td>\r\n<td width=\"246\">\r\n<p><strong>Ne İşe Yarar</strong></p>\r\n</td>\r\n<td width=\"170\">\r\n<p><strong>Kullanım Ömrü</strong></p>\r\n</td>\r\n<td width=\"132\">\r\n<p><strong>Ayrıntılar</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p>İzleme/Analiz</p>\r\n</td>\r\n<td width=\"246\">\r\n<p><a href=\"http://www.elteksmak.com.tr\">www.akinhadde.com.tr</a>   sitesi içerisinde nerelerde gezindiğiniz ve neler yaptığınız hakkında isimsiz (anonim) toplu veriler sağlar</p>\r\n</td>\r\n<td width=\"170\">\r\n<p>Kalıcı, oturum ve 3. parti</p>\r\n</td>\r\n<td width=\"132\">\r\n<p>Google Analytics<br />YouTube İzlenmesi<br />Gemius<br />Comscore</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p>Sosyal Medya / Paylaşım</p>\r\n</td>\r\n<td width=\"246\">\r\n<p>Yorumları, sayfaları, yer imlerini paylaşmanızı sağlar ve sosyal ağlar ile sosyal araçlara daha kolay erişim sunmaya yardımcı olur.</p>\r\n</td>\r\n<td width=\"170\">\r\n<p>3. parti</p>\r\n</td>\r\n<td width=\"132\">\r\n<p>Facebook<br />Twitter<br />YouTube</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p>Siteler arası izleme</p>\r\n</td>\r\n<td width=\"246\">\r\n<p>Kullanıcının IP adresi sayesinde yaklaşık adresinin (şehir, ilçe, posta kodu) belirlenmesini ve kullanıcının içerik ve reklam tercihlerine göre en uygun olanlarını kullanıcıya sunulmasını sağlar.</p>\r\n</td>\r\n<td width=\"170\">\r\n<p>Oturum, 3.parti</p>\r\n</td>\r\n<td width=\"132\">\r\n<p>Mobil Reklam platformları</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p>Google Analitikleri</p>\r\n</td>\r\n<td width=\"246\">\r\n<p>Bu tür çerezler tüm istatistiksel verilerin toplanmasını bu şekilde Sitenin sunumunun ve kullanımının geliştirilmesini sağlar. Google, bu istatistiklere toplumsal istatistikler ve ilgilere ilişkin veriler eklemek suretiyle, kullanıcıları daha iyi anlamamızı sağlar.</p>\r\n</td>\r\n<td width=\"170\">\r\n<p>Kalıcı, oturum ve 3.part</p>\r\n</td>\r\n<td width=\"132\">\r\n<p>Google Analytics</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p> </p>\r\n<ol>\r\n<li><strong> </strong><strong>Çerezleri nasıl kontrol edebilir veya silebilirsiniz: </strong>Birçok internet tarayıcısı, varsayılan olarak çerezleri otomatik olarak kabul etmeye ayarlıdır. Bu ayarları, çerezleri engelleyecek veya cihazınıza çerez gönderildiğinde uyarı verecek şekilde değiştirebilirsiniz. Çerezleri yönetmenin birkaç yolu bulunmaktadır. Tarayıcı ayarlarınızı nasıl düzenleyeceğiniz hakkında ayrıntılı bilgi almak için lütfen tarayıcınızın talimat veya yardım ekranına başvurun. Eğer kullandığımız çerezleri devre dışı bırakırsanız, bu eylem şirketimizin web sitesindeki kullanıcı deneyiminizi etkileyebilir; örneğin sitenin belirli bölümlerini görüntüleyemeyebilir veya tekrar ziyaret ettiğinizde sizin için özelleştirilmiş olan bilgilere ulaşamayabilirsiniz. Siteyi görüntülemek için farklı cihazlar kullanıyorsanız (ör. bilgisayar, akıllı telefon, tablet vb.), bu cihazların her birindeki her tarayıcının çerez tercihlerinize uygun şekilde ayarlanmış olduğundan emin olmanız gerekir.</li>\r\n</ol>', NULL, '1bf7af771f49dfa5b0ec95e56ca9c6e3.webp', 'tr', 9, 1, '2022-03-05 22:01:49', '2022-12-29 19:11:46', '2022-03-05 21:58:23', 'KVKK'),
(10, 'sosyal-medya-kullanimi-politikasi', 'Sosyal Medya Kullanımı Politikası', '<p>AKIN HADDECİLİK LTD.ŞTİ., politikanın yayınlandığı tarihte kullanmakta olduğu bir sosyal medya platformu bulunmamaktadır. Olması halinde, ilgili sosyal medya platformunun adı (Facebook, Instagram vb), politikaya eklenecek ve ilan edilecektir.  </p>\r\n<p>Sayfaların açılması ve yönetim yetkisi, Genel Müdür’ün sorumluluğundadır. Bunun dışında açılan hesaplar ve sayfalar şirketimizle ilgili değildir. Tespiti halinde, AKIN HADDECİLİK LTD.ŞTİ. yasal yollara başvurabilir. Sayfalarda, şirket faaliyetleri (Fabrika geneli, üretim faaliyeti, fuar vb etkinlikler, sosyal faaliyetler vb) sırasında çekilen fotoğraf ve videolar paylaşılmaktadır. Bunun dışında milli ve dini bayramlara ait kutlama / anma mesajları yayınlanabilmektedir.</p>\r\n<p>Sosyal medya sayfalarında, gerekli parametre ve gizlilik ayarları Genel Müdür tarafından yapılır.</p>\r\n<p>Fotoğraf ve videolarda yer alan çalışanlarımızın görüntüleri ancak açık rızaları alınmışsa yayınlanabilir, bunun dışında müşterilerimizin, tedarikçilerimizin, ziyaretçilerimizin görüntülerine, izinleri alınmadığı takdirde yer verilmez. Paylaşımlarda, çalışanlarımızın adları etiketlenmez, hiçbir kişisel verisi izni olmaksızın paylaşılmaz.</p>\r\n<p>Bunun dışında, çalışanlarımızın, sosyal medya kullanımında dikkat etmesi kurallar aşağıda açıklanmıştır:</p>\r\n<ol>\r\n<li>Sosyal ağlarda, AKIN HADDECİLİK LTD.ŞTİ. veya sektörle ilgili bir konuda fikir beyan ediliyorsa, kişisel düşünceniz olduğu belirtmek zorundadır.</li>\r\n<li>Şirket, çalışma arkadaşları ve kendi itibarını korumak zorundadır. İtibar zedeleyici herhangi bir yorum yapılmaktan kaçınılacaktır.</li>\r\n<li>Müşteriler, rakipler, tedarikçiler, kamu veya özel kurum ve kuruluşlar hakkında itibar zedeleyici herhangi bir yorum yapılmayacaktır.</li>\r\n<li>AKIN HADDECİLİK LTD.ŞTİ. çalışanlarına, müşterilerine, tedarikçilerine ve diğer paydaşlara ait hiçbir bilgi paylaşılmayacaktır.</li>\r\n<li>Sosyal ağlarda, onay alınmadıkça diğer kişilerin fotoğraflarını paylaşmamalı ve adlarını etiketlememelidir.</li>\r\n<li>Ayrımcı, tacizci, ırkçı, dini veya cinsel içerikli, saldırgan ve rahatsız edici tarzda yorumlar yazılmayacaktır.</li>\r\n<li>Şirketin sosyal medya sayfalarında, hiçbir ticari ürünün reklamı, hiçbir siyasi partinin propagandası yapılmayacaktır.</li>\r\n<li>Şirket bünyesindeki kişi, ofis, toplantı, çalışma içeriğine ait detaylar, mekanlar vb sosyal medyada etiketlenmeyecektir. Şirket içerisinde çekilen fotoğraflar, şirket adı etiketlenerek paylaşılmayacaktır.</li>\r\n<li>Paylaşılması düşünülen bir içerik hakkında şüpheye düşülmüşse, İnsan Kaynakları Sorumlusu’na danışılacaktır.</li>\r\n<li>Sosyal medya platformlarına herhangi bir içerik (metin, resim, video vb.) yüklemesi yaparken dikkatli olmak gerekir. Farkında olmadan marka ya da telif hakları ihlal edilebilir.</li>\r\n<li>Çalışanlar sosyal medyada paylaştıkları ve yayınladıkları içeriklerden kişisel olarak sorumludur.</li>\r\n<li>Sosyal medyada yazılı mesajların yanlış anlaşılma ihtimaline karşı, yazım kurallarına uygun davranılacaktır.</li>\r\n<li>Yetki verilmemiş kişiler asla kendini firmanın resmi sözcüsü olarak tanıtmamalıdır.</li>\r\n<li>Şirketle ilgili başkaları tarafından yazılmış olumsuz mesajlara karşı olumsuz mesaj yazılmayacak, sağduyulu ve nazik yaklaşılacaktır.</li>\r\n<li>İnternette paylaşılanların, kaldırılsa veya silinse bile tamamen kaldırılamayacağının farkında olunacak.</li>\r\n</ol>\r\n<p>Çalışanlarımız, kişisel sosyal medya sayfalarındaki parametre ve gizlilik ayarları konusunda, İnsan Kaynakları Sorumlusu’na danışabilirler.</p>', NULL, '76bd5d10a82e5517795fe63a88a2c40f.webp', 'tr', 10, 1, '2022-12-26 08:36:58', '2022-12-29 19:12:07', '2022-12-26 08:34:59', 'KVKK'),
(11, 'kisisel-veri-saklama-ve-imha-politikasi', 'Kişisel Veri Saklama ve İmha Politikası', '<p><strong>POLİTİKA AMACI:</strong></p>\r\n<p>Bu politika, şirketimizin aldığı ve işlediği kişisel verilerin saklanması ve imha işlemlerinin yönetilmesine dair yaklaşımını tanımlamak amacıyla, Kişisel Verilerin Silinmesi, Yok Edilmesi Veya Anonim Hale Getirilmesi Hakkında Yönetmelik baz alınarak hazırlanmıştır.</p>\r\n<p><strong>TANIMLAR:</strong></p>\r\n<p><strong>İmha</strong>: Kişisel verilerin silinmesi, yok edilmesi veya anonim hale getirilmesini</p>\r\n<p><strong>Kayıt ortamı</strong>: Tamamen veya kısmen otomatik olan ya da herhangi bir veri kayıt sisteminin parçası olmak kaydıyla otomatik olmayan yollarla işlenen kişisel verilerin bulunduğu her türlü ortamı</p>\r\n<p><strong>Periyodik imha:</strong> Kanunda yer alan kişisel verilerin işlenme şartlarının tamamının ortadan kalkması durumunda kişisel verileri saklama ve imha politikasında belirtilen ve tekrar eden aralıklarla resen gerçekleştirilecek silme, yok etme veya anonim hale getirme işlemini</p>\r\n<p><strong>Veri kayıt sistemi</strong>: Kişisel verilerin belirli kriterlere göre yapılandırılarak işlendiği kayıt sistemini ifade eder.</p>\r\n<p><strong>SAKLAMA ve İMHA GEREKÇELERİ, SAKLAMA ve İMHA SÜRELERİ:</strong></p>\r\n<p>Şirketimiz, işlediği kişisel verileri, yasal zorunlu faaliyetlerini ve ticari faaliyetlerini yerine getirebilmek amacıyla, <strong>Kişisel Veri Envanteri</strong> ile belirlenen ve VERBİS (Veri Sorumluları Sicili)’de kamuya açık şekilde ilan edilen saklama süreleri zarfında, fiziksel ve/veya elektronik ortamlarda güvenli bir şekilde saklamaktadır. Kişisel Veri Envanteri’nde, her bir kişisel verinin, hangi ortamlarda işlendiği, saklandığı ve hangi yöntemlerle imha edildiği tanımlanmıştır. Kişisel veriler, başta 6698 Sayılı Kişisel Verileri Koruma Kanunu, 4857 Sayılı İş Kanunu, 6331 Sayılı İş Sağlığı ve Güvenliği Kanunu ve şirket faaliyetlerimizi ilgilendiren tüm mevzuat şartlarına uygun şekilde muhafaza edilmektedir.</p>\r\n<p>Kişisel veri saklama sürelerinin belirlenmesinde, kişisel verinin işlenmesindeki hukuki gerekçe veya işleme amacı dikkate alınır. Kişisel veri, yasal şartlar gereği olarak  toplanan ve işlenen bir veri ise, saklama süresi, ilgili mevzuatta yer alan süre olarak <strong>Kişisel Veri Envanteri</strong>’nde tanımlanır. Diğer veriler için ise, işleme amacına uygun şekilde, ilgili faaliyetlerin yerine getirebilmesini sağlayacak süreler belirlenir ve <strong>Kişisel Veri Envanteri</strong>’nde tanımlanır. Saklama süreleri bazen “ay”, “yıl” gibi tanımlanırken, bazı kişisel veriler için “…. Bitiminde”, “…………yapılana kadar” şeklinde tanımlanabilmektedir. Bu sebeple her bir kişisel veri için, ilgili mevzuatta öngörülen veya işlendikleri amaç için gerekli olan süreye ilişkin farklı bir muhafaza süresi geçerli olabilmektedir.</p>\r\n<p>Kişisel veriler, VERBİS’de kamuya açık şekilde ilan edilen “Veri Güvenliği Tedbirleri” alınarak saklanmaktadır. Çalışanlar için yetki matrisi hazırlanması, eğitimler yapılması, çalışanlarla ve veri işleyenlerle gizlilik sözleşmeleri yapılması gibi idari tedbirlerin yanı sıra, güncel antivirüs sistemleri kullanımı, güvenlik duvarı kullanımı, yedekleme, şifreleme vb teknik veri güvenliği tedbirleri alınmaktadır.</p>\r\n<p>Kişisel verilerin imhasında, seçilen yönteme göre, silme, yok etme, anonim hale getirme işlemi, kişisel verinin tekrar erişilmesi, geri getirilmesi, kullanılması veya veri sahibi ile ilişkilendirilmesini mümkün kılmayacak şekilde hareket edilir.</p>\r\n<p>Saklama süresi dolan kişisel veriler, belirlenmiş olan imha yöntemlerine göre imha edilir ve Veri İmha Tutanağı kullanılarak işlem kayıt altına alınır. Bu kayıtlar en az 3 yıl saklanır.</p>\r\n<p>Kişisel verilerin saklama ve imhasında, “Kişisel Veri Envanteri” ve “Kişisel Veriler İçin Yetki Matrisi ve Yetkilerin Yönetimi Tablosu”yla belirlenen sorumlular görev alır. İmha işlemlerinde görev alanlar, Veri İmha Tutanağı’nda kayıt altına alınır.</p>\r\n<p>Şirketimiz, her 3 ayda bir (Mart, Haziran, Eylül ve Aralık ayları) kişisel verileri gözden geçirerek, saklama süresi dolan verileri tespit eder ve kişisel verileri silme, yok etme veya anonim hale getirme yükümlülüğünün ortaya çıktığı tarihi takip eden ilk periyodik imha işleminde, kişisel verileri siler, yok eder veya anonim hale getirir. Bu süre, altı ayı geçmez.</p>\r\n<p><strong>İLGİLİ KİŞİNİN (VERİ SAHİBİNİN) TALEBİ HALİNDE KİŞİSEL VERİLERİN İMHASI</strong></p>\r\n<p>Kişisel veri sahipleri, Kişisel Verilerle İlgili Genel Aydınlatma Metni’mizde yer alan iletişim yöntemlerini kullanarak verileri hakkında bilgi talep edebilir. Bu talebin, kişisel verisinin silinmesi olması halinde:</p>\r\n<ol>\r\n<li>Kişisel veri işleme şartlarının tamamı ortadan kalkmışsa, talebe konu olan kişisel veriler imha edilir. İlgili kişinin talebi en geç 30 gün içinde sonuçlandırılır ve yazılı olarak / elektronik ortamda bilgilendirilir.</li>\r\n<li>Kişisel veri işleme şartlarının tamamı ortadan kalkmışsa ve talebe konu veriler, veri işleyen taraflara aktarılmışsa, şirketimiz durumu Veri İşleyen’e bildirir ve imha işlemlerinin yapılmasını sağlar.</li>\r\n<li>Kişisel veri işleme şartlarının tamamı ortadan kalkmamışsa, şirketimiz tarafından gerekçesi açıklanarak reddedilir ve en geç 30 gün içinde ret cevabı yazılı olarak / elektronik ortamda bildirilir.</li>\r\n</ol>\r\n<p> </p>\r\n<p> </p>\r\n<p>YÜRÜRLÜK TARİHİ: 11.02/2020 tarihinde yürürlüğe girmiştir. Revizyon no:00</p>\r\n<p>DEĞİŞİKLİKLER:</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width=\"121\">\r\n<p>Değişiklik No</p>\r\n</td>\r\n<td width=\"142\">\r\n<p>Değişiklik Tarihi</p>\r\n</td>\r\n<td width=\"390\">\r\n<p>Değişikliğe Dair Açıklama</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p> </p>\r\n</td>\r\n<td width=\"142\">\r\n<p> </p>\r\n</td>\r\n<td width=\"390\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p> </p>\r\n</td>\r\n<td width=\"142\">\r\n<p> </p>\r\n</td>\r\n<td width=\"390\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"121\">\r\n<p> </p>\r\n</td>\r\n<td width=\"142\">\r\n<p> </p>\r\n</td>\r\n<td width=\"390\">\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, '92ead8694214ce2b5a0032e6d686ba99.webp', 'tr', 11, 1, '2022-12-26 08:46:27', '2022-12-29 19:12:16', '2022-12-26 08:45:02', 'KVKK'),
(12, 'kisisel-verilerle-ilgili-genel-aydinlatma-metni', 'Kişisel Verilerle İlgili Genel Aydınlatma Metni', '<ol>\r\n<li><strong> </strong><strong>Kişisel Verilerin Korunması Kanunu Hakkında:</strong></li>\r\n</ol>\r\n<p>İşbu “Genel Aydınlatma Metni”, AKIN HADDECİLİK Ltd.Şti. (“AKIN HADDECİLİK”) olarak, 6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) uyarınca, Veri Sorumlusu sıfatıyla, KVKK’da yer alan “Veri Sorumlusunun Aydınlatma Yükümlülüğü” başlıklı 10. ve “İlgili Kişinin Hakları” başlıklı 11. maddesi çerçevesinde; hangi amaçla kişisel verilerinizin işleneceği, işlenen kişisel verilerinizin kimlere ve hangi amaçla aktarılabileceği, kişisel verilerinizin toplanmasının yöntemi ve hukuki sebebi ve KVKK’nın 11. maddesinde sayılan diğer haklarınızla ilgili olarak size bilgi vermek ve aşağıdaki hususlarda onayınızı almak amacıyla sunulmaktadır.</p>\r\n<p>Bize sağladığınız kişisel verilerin gizliliğini ve güvenliğini korumaya önem veriyoruz. Bu doğrultuda, kişisel verilerinizi yetkisiz erişim, zarar, kayıp veya ifşaya karşı korumak için gerekli teknik ve idari güvenlik önlemlerini almaktayız.</p>\r\n<p>Çalışanlarımızın kişisel verileriyle ilgili bilgilendirme <strong>Personel İçin Aydınlatma Metni</strong> ile sağlanmaktadır.</p>\r\n<ol start=\"2\">\r\n<li><strong> </strong><strong>Aldığımız Kişisel Verileriniz ve İşleme Amaçlarımız:</strong></li>\r\n</ol>\r\n<p>AKIN HADDECİLİK, web sitesi (<a href=\"http://www.akinhadde.com.tr\">www.akinhadde.com.tr</a>  )ve bu aydınlatma metninde yer verilen diğer kanallar vasıtasıyla paylaşmış olduğunuz kişisel verilerinizi, yine bu aydınlatma metninde belirtilen amaçlar ile sınırlı olarak işlemektedir. AKIN HADDECİLİK,  açık adresi Akçeşme Mah.2600 Sokak No:5. Merkezefendi / DENİZLİ/ TÜRKİYE ve vergi numarası Gökpınar  Vergi Dairesi - Vergi No: 027 001 0302’dir. KVKK açısından Şirketimiz “Veri Sorumlusu” sıfatıyla faaliyet göstermektedir.</p>\r\n<p>AKIN HADDECİLİK’e ait web sitesini ziyaret ettiğinizde ve/veya AKIN HADDECİLİK ile kişisel verilerinizi bu aydınlatma metninde belirtilen işleme amaçları kapsamında kullanılmak üzere paylaştığınızda, bu aydınlatma metninde ve web sitemizde yer alan gizlilik politikasında yer alan hükümler konusunda bilgilendirilmiş kabul edilirsiniz.</p>\r\n<p>AKIN HADDECİLİK olarak, Veri Sorumlusu sıfatıyla, 6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”), 5237 sayılı Türk Ceza Kanunu, 5651 sayılı İnternet Ortamında Yapılan Yayınların Düzenlenmesi ve Bu Yayınlar Yoluyla İşlenen Suçlarla Mücadele Edilmesi Hakkında Kanun ve ilgili ikincil mevzuat ve bunlarla sınırlı olmaksızın ilgili tüm mevzuattan kaynaklanan yasal yükümlülüklerimiz çerçevesinde ve şirket faaliyetlerimizi sürdürebilmek adına yaptığımız işlemlerde kişisel verileri topluyoruz.</p>\r\n<ol>\r\n<li><strong> </strong><strong>Müşterilerimizden Toplanan Kişisel Veriler</strong>: Adı-soyadı, e-posta adresi, adresi, telefon no, şirketimizi ziyareti halinde güvenlik kamerası görüntüleri, çekilmesi halinde fotoğraf vb veriler.</li>\r\n<li><strong> </strong><strong>Tedarikçilerimizden Topladığımız Kişisel Veriler</strong>: Ürün veya hizmet satın alma sürecinde, tedarikçi yetkilisi ve çalışanlarının adı-soyadı, iletişim bilgileri (Telefon, e-posta), hizmetin niteliğine göre hizmeti sunan tedarikçi personelinin diğer kişisel verileri, şirketimizi ziyareti halinde güvenlik kamerası görüntüleri vb</li>\r\n<li><strong> </strong><strong>İş Başvurusu Yapan Çalışan Adaylarından Topladığımız Kişisel Veriler</strong>: Kimlik, iletişim, mesleki deneyim (Öğrenim, eğitim ve çalışma geçmişi), adli sicil kaydı, referansların kimlik ve iletişim verileri, uyruk, doğum yeri ve tarihi, cinsiyet, medeni durum, askerlik durumu, sağlık / engellilik durumu vb. Aday, kendi ilettiği özgeçmişinde, AKIN HADDECİLİK tarafından talep edilmemiş başka kişisel verilerini de iletmiş olabilir. Bu veriler, AKIN HADDECİLİK tarafından dikkate alınmaz, işlenmez, bir başka kişi, kurum ya da kuruluşa iletilmez.</li>\r\n<li><strong> </strong><strong>Diğer</strong>: İş faaliyetlerinin yürütümü sırasında temas edilen diğer taraflardan alınan adı-soyadı, iletişim bilgileri vb.</li>\r\n</ol>\r\n<p><strong>İşleme Amaçlarımız</strong>: (VERBİS kaydımızda kategorik bazda tümü mevcuttur)</p>\r\n<p>      Aşağıdakilerle sınırlı olmamak kaydıyla, işleme amaçlarımız</p>\r\n<ol>\r\n<li>Mevzuatta düzenlenen hukuki yükümlülüklerimizi yerine getirmek</li>\r\n<li>Müşterilerimizin ihtiyaçlarını anlamak ve doğru teklifi sunabilmek</li>\r\n<li>Müşterilerle iletişimi geliştirmek ve daha etkin ve kaliteli hizmet sunabilmek</li>\r\n<li>Pazarlama ve satış süreçlerini yürütülebilmek</li>\r\n<li>Yetkili kişi, kurum ve kuruluşlara bilgi vermek</li>\r\n<li>Faturalandırma ve tahsilatı yapmak</li>\r\n<li>İşe başvuru süreçlerini yönetmek ve adayı değerlendirmek (İş başvurusu yapan adaylar için)</li>\r\n<li>Satın alma süreçlerini yürütmek (Tedarikçiler için)</li>\r\n<li>İş süreçlerimizi yürütebilmek (Diğer taraflar)</li>\r\n</ol>\r\n<p>Bu kişisel veriler; AKIN HADDECİLİK olarak sunduğumuz hizmetlerden yararlanabilmeniz adına, açık rızanıza istinaden veya tabi olduğumuz yasal mevzuat başta olmak üzere KVKK 5. maddesinin 2. fıkrasında öngörülen diğer hallerde, işbu Kişisel Verilerin Korunması Hakkında Bilgilendirme ile belirlenen amaçlar ve kapsam dışında kullanılmamak kaydı ile gerekli tüm bilgi güvenliği tedbirleri de alınarak işlenecek ve yasal saklama süresince veya işleme amacının gerekli kıldığı süre boyunca saklanacak ve işleme amacının gerekli kıldığı sürenin sonunda imha edilecek veya anonimleştirilerek kullanılacaktır.</p>\r\n<ol start=\"3\">\r\n<li><strong> </strong><strong>Kişisel Verilerinizi Hangi Yollarla Topluyoruz: </strong></li>\r\n</ol>\r\n<p>Kişisel verileriniz, sözlü, yazılı ya da elektronik ortamda, yukarıda yer verilen amaçlar kapsamında ve kanuni yükümlülüklerin ve hizmet şartlarının yerine getirebilmesi amacıyla toplanır.</p>\r\n<p><u>AKIN HADDECİLİK’e doğrudan sizin tarafınızdan sağlanan kişisel veriler</u>: İletmiş olduğunuz tüm bilgi ve belgeler, teklif talepleri, sözleşmeler, siparişler, iş başvuru formu veya özgeçmişler vb.</p>\r\n<p><u>İş süreçlerinin yürütümü sırasında toplanan kişisel veriler</u>:  Yazışmalar, e-posta yazışmaları, telefonla veya yüz yüze görüşmeler vb</p>\r\n<p><u>Fuarlarda toplanan kişisel veriler</u>: Sektörel fuar organizasyonlarındaki görüşmelerde toplanan bilgi ve belgeler</p>\r\n<p><u>(Kullanılması halinde )Çerezler ve benzeri teknolojiler vasıtasıyla topladığımız kişisel veriler</u>: Kişisel verileriniz, Kanun’a uygun olmak kaydıyla <a href=\"http://www.akinhadde.com.tr\">www.akinhadde.com.tr</a>    aracılığı ile otomatik yollarla elektronik ortamda toplanabilmektedir.</p>\r\n<p><u>AKIN HADDECİLİK’e yaptığınız ziyaretlerde toplanan kişisel veriler</u>: Güvenlik girişinden itibaren, güvenlik kamerası işareti bulunan alanlarda, güvenlik kamerası ile çekilen görüntüler kaydedilmektedir.</p>\r\n<ol start=\"4\">\r\n<li><strong> </strong><strong>Kişisel Verilerinizi Kimlerle Paylaşıyoruz:</strong></li>\r\n</ol>\r\n<p>AKIN HADDECİLİK, söz konusu kişisel verilerinizi, açık rızanıza istinaden veya tabi olduğumuz mevzuat başta olmak üzere KVKK md. 5/f.2’de öngörülen diğer hallerde KVKK’da belirtilen güvenlik ve gizlilik esasları çerçevesinde yeterli önlemler alınmak kaydıyla ilgili taraflarla paylaşabilir ve aktarabilir. Bizimle paylaşmış olduğunuz kişisel verileriniz, KVKK’da öngörülen işlenme ve paylaşım amaçları haricinde veya açık rızanız olmadan üçüncü kişilerle paylaşılmaz.</p>\r\n<p>Elektronik ortamda tutulan kişisel verileriniz, şirketimizin sunucu ve veri depolama ünitelerine (yurtiçi) aktarılır.</p>\r\n<p>Çalışan adaylarının iş başvuru formları, web sitemiz aracılığı ile ilettikleri bilgileri veya elden / e-posta ile gönderdikleri özgeçmişleri, açık rızası olmaksızın başka kişi ve kuruluşlara aktarılmaz..</p>\r\n<p>Diğer taraflardan toplanan kişisel veriler, işleme amacı doğrultusunda aktarımı gerekiyorsa, açık rızayı gerektiren hallerde veri sahibinin açık rızasını alarak veya kanuni gereklilik ya da açık rıza dışı işleme şartı gereği olarak yetkili kişi, kurum veya kuruluşlara aktarılabilir.</p>\r\n<ol start=\"5\">\r\n<li><strong> </strong><strong>Veri Sahibinin (İlgili Kişinin) Hakları</strong></li>\r\n</ol>\r\n<p>KVKK gereğince, veri sahibi olarak, kişisel verilerinizin:</p>\r\n<ul>\r\n<li>İşlenip işlenmediğini öğrenme</li>\r\n<li>İşlendiyse bilgi talep etme</li>\r\n<li>İşlenme amacını ve amaca uygun kullanılıp kullanılmadığını öğrenme</li>\r\n<li>Yurtiçi veya dışında aktarıldığı üçüncü tarafları bilme</li>\r\n<li>Eksik ya da yanlış işlenmişse veya değişmişse, düzeltilmesini talep etme</li>\r\n<li>KVKK Madde 7 çerçevesinde, silinmesini veya yok edilmesini isteme</li>\r\n<li>Aktarıldığı üçüncü kişilerden de yapılan işlemlerin bildirilmesini isteme</li>\r\n<li>Münhasıran otomatik sistemlerle analiz edilmesi nedeniyle aleyhte bir sonucun ortaya çıkmasına itiraz etme ve</li>\r\n<li>KVKK’ya aykırı işlenmesi sebebiyle zarara uğraması halinde zararın giderilmesini isteme hakkına sahipsiniz.</li>\r\n</ul>\r\n<p>Bu kapsamda yapacağınız talepler 6698 Kişisel Verileri Koruma Kanunu kapsamında yazılı olmalıdır. Bunun için, kimliğinizi tespit edici belgeler ile birlikte, kullanmak istediğiniz hakkınıza yönelik açıklamalarınızı yazılı olarak, şirketimizin <a href=\"mailto:info@akinhadde.com.tr\">info@akinhadde.com.tr</a> adresine gönderebilir veya başvurunuzu noter kanalıyla göndererek yapabilirsiniz.</p>\r\n<p>Bu amaçlarla yaptığınız başvurunun ek bir maliyet gerektirmesi durumunda, Kişisel Verileri Koruma Kurulu tarafından belirlenecek tarifedeki ücret tutarını ödemeniz gerekebilir. Başvurunuzda yer alan talepleriniz, talebin niteliğine göre en kısa sürede ve en geç 30 (otuz) gün içinde sonuçlandırılacaktır.</p>\r\n<p>Kullanıcı / Kullanıcılar, Şirketimiz web sitesinde işlem yapmadan önce sitede yer alan Şirket Gizlilik Politikası, Kişisel Veri Saklama ve  İmha Politikası ve yukarıda belirtilen Kişisel Verilerle İlgili Genel Aydınlatma Metni’ni okuduklarını, bu metinlerde belirtilen tüm hususlara uyacaklarını, web sitesinde yer alan içeriklerin ve AKIN HADDECİLİK’ye ait tüm elektronik ortam ve bilgisayar kayıtlarının Hukuk Muhakemeleri Kanunu madde 193 uyarınca kesin delil sayılacağını gayrıkabili rücu olarak kabul, beyan ve taahhüt etmişlerdir.</p>\r\n<p><u>Bizimle İletişime Geçin</u>: Genel Aydınlatma Metni veya diğer veri koruma uygulamalarımıza ilişkin herhangi bir soru veya endişenizin bulunması halinde veya bir erişim talebinizin bulunması halinde, bize Akçeşme  Mahallesi 2600 Sokak No:5 Merkezefendi / DENİZLİ adresinden veya 0258 371 31 85 nolu telefondan ulaşabilirsiniz.</p>\r\n<ol start=\"6\">\r\n<li><strong> </strong><strong>Yürürlük ve Değişiklikler</strong></li>\r\n</ol>\r\n<p>Bu aydınlatma metni, 11/02/2020 tarihinden itibaren yürürlüğe girmiştir.</p>\r\n<p>Kanunda veya Kişisel Veri Envanteri’nde değişiklikler olması halinde, revizyon numarası ve tarihi değiştirilerek, paydaşlara yeniden bilgilendirme yapılacaktır.</p>', NULL, 'e911a77b11879293e34362d508e36835.webp', 'tr', 12, 1, '2022-12-26 08:51:41', '2022-12-29 19:12:21', '2022-12-26 08:51:14', 'KVKK');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `top_id` int(11) NOT NULL DEFAULT 0,
  `url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `features` longtext DEFAULT NULL,
  `lang` char(2) NOT NULL DEFAULT 'tr',
  `rank` bigint(20) NOT NULL DEFAULT 1,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `technical_information_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `top_id`, `url`, `title`, `content`, `description`, `features`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`, `img_url`, `technical_information_id`) VALUES
(1, 0, 'kare', 'Kare', '<p>Akın Haddecilik A.Ş. geniş bir kullanım yelpazesine sahip olan Kare profilin üretimini birçok farklı ölçüde, kalitede ve toleranslarda yapmaktadır.</p>', '<h2 class=\"text-danger\"><strong>KARE PROFİL BAŞLICA KULLANIM ALANLARI</strong></h2>\r\n<ul style=\"list-style: circle!important;\">\r\n<li>Ferforje demir üretimi</li>\r\n<li>Yapı ve konstrüksiyon</li>\r\n<li>Otomotiv sanayi</li>\r\n<li>Makine imalatı</li>\r\n<li>Vinç sanayi</li>\r\n<li>Tarım aletleri üretimi</li>\r\n<li>Mobilya imalatı</li>\r\n<li>Elektrik panosu imalatları </li>\r\n<li>Ve gündelik kullanılan tüm demir işlerinde</li>\r\n</ul>', '<p>‘Çeliğimizle Dünyayı Güzelleştiriyoruz’</p>', 'tr', 1, 1, '2022-11-14 14:47:48', '2022-12-22 06:57:50', '2022-11-14 14:47:18', 'fe12d8feed93514b64586791e151c878.webp', 11),
(3, 0, 't-demiri', 'T Demiri', '<p>Akın Haddecilik, İzmir ve Denizli tesislerinde üretimi yapılan, demir çelik sektöründe ve başka sektörlerde çeşitli kullanım alanları bulunan <strong>T profili</strong> birçok farklı ölçüde, kalitede ve 3mt – 12mt boyları arasında üretebilme kapasitesine sahiptir. Üretilen bu <strong>T demiri</strong> beyaz eşya sanayi ve otomotiv sektörü gibi pek çok farklı sektörlerde kullanılır.</p>', '<h2 class=\"text-danger\"><strong>T DEMİRİ BAŞLICA KULLANIM ALANLARI</strong></h2>\r\n<ul>\r\n<li>Otomotiv sanayi</li>\r\n<li>Beyaz eşya sanayi</li>\r\n<li>Sera ve benzeri örtü alanları</li>\r\n<li>Çit yapımı</li>\r\n<li>Gündelik <span style=\"font-size: 12pt;\">kullanılan</span> tüm çelik işleri</li>\r\n</ul>', '<p><strong>‘Sağlıklı ve Bol çeşitli bir zincirin yapısal halkasıyız’</strong></p>', 'tr', 3, 1, '2022-12-16 11:43:50', '2022-12-23 11:37:37', '2022-12-16 11:43:42', '0c823f97309aec23c32ff47cd1dea135.webp', 14),
(4, 0, 'esitkenar-kosebent', 'Eşitkenar Köşebent', '<p>Akın Haddecilik demir çelik sektöründe ve başka sektörlerde çeşitli kullanım alanları bulunan Eşitkenar Köşebent demirini birçok farklı ölçüde, kalitede ve 3mt – 12mt boyları arasında üretebilme kapasitesine sahiptir. Üretilen bu eşitkenar köşebent çelik konstrüksiyonlarda, enerji nakil hatlarında ve tarım makineleri imalatı olmak üzere pek çok sayamadığımız farklı sektörlerde kullanılır.</p>', '<h2 class=\"text-danger\"><strong>EŞİTKENAR KÖŞEBENT BAŞLICA KULLANIM ALANLARI<br /></strong></h2>\r\n<ul>\r\n<li>Enerji nakil hatları</li>\r\n<li>Köprü, baraj ve yol inşaatları</li>\r\n<li>Yapısal çelik sektörü</li>\r\n<li>Makina imalatı</li>\r\n<li>Tarım makineleri imalatı</li>\r\n<li>Sera ve benzeri örtü alanları</li>\r\n<li>Çit yapımı</li>\r\n<li>Gündelik kullanılan tüm demir işlerinde</li>\r\n</ul>\r\n<h2 class=\"text-danger\"><strong> </strong></h2>\r\n<h2 class=\"text-danger\"> </h2>\r\n<h2 class=\"text-danger\"><strong> </strong></h2>', '<p>‘ENERJİNİN SINIR TANIMAYAN YOLCULUĞUNA, ÇELİĞİMİZLE EŞLİK EDİYORUZ’</p>', 'tr', 4, 1, '2022-12-16 12:10:46', '2022-12-23 11:39:13', '2022-12-16 12:08:04', 'f8e27fc6aba402717ddb8f66d2a59e59.webp', 13),
(5, 0, 'npu-profil', 'NPU Profil', '<p>Akın Haddecilik, İzmir ve Denizli tesislerinde üretimi yapılan, demir çelik sektöründe ve başka sektörlerde çeşitli kullanım alanları bulunan <strong>NPU profili</strong> birçok farklı ölçüde, kalitede ve 3mt – 12mt boyları arasında üretebilme kapasitesine sahiptir. Üretilen bu <strong>NPU profili</strong> enerji nakil hatları ve makine imalatı gibi pek çok farklı sektörlerde kullanılır.</p>', '<h2 class=\"text-danger\"><strong>NPU PROFİL BAŞLICA KULLANIM ALANLARI<br /></strong></h2>\r\n<ul>\r\n<li>Enerji nakil hatları</li>\r\n<li>Köprü, baraj ve yol inşaatları</li>\r\n<li>Yapısal çelik sektörü</li>\r\n<li>Makina ve zirai alet imalatı</li>\r\n<li>Vinç Sanayi</li>\r\n<li>Ve gündelik kullanılan tüm demir işlerinde</li>\r\n</ul>\r\n<h2 class=\"text-danger\"><strong> </strong></h2>', '<p>‘Kıtaları birleştiren, uygarlıklara şekil veren bir sektörün temsilcisiyiz’</p>', 'tr', 5, 1, '2022-12-16 12:36:48', '2022-12-22 06:45:05', '2022-12-16 12:34:01', 'bb4c3797e499f8fbaa9c48fc306532fc.webp', 15),
(6, 0, 'npi-ipe-profilleri', 'NPI – IPE Profilleri', '<p>Akın Haddecilik, İzmir ve Denizli tesislerinde üretimi yapılan, demir çelik sektöründe ve başka sektörlerde çeşitli kullanım alanları bulunan <strong>NPI – IPE Profillerini</strong> birçok farklı ölçüde, kalitede ve 3mt – 12mt boyları arasında üretebilme kapasitesine sahiptir. Üretilen bu <strong>NPI – IPE Profiller</strong> yapısal çelik ve vinç sanayi gibi pek çok farklı sektörlerde kullanılır.</p>', '<h2 class=\"text-danger\"><strong>NPI - IPE PROFİLLERİ BAŞLICA KULLANIM ALANLARI<br /></strong></h2>\r\n<ul>\r\n<li>Enerji nakil hatları</li>\r\n<li>Köprü, baraj ve yol inşaatları</li>\r\n<li>Yapısal çelik sektörü</li>\r\n<li>Makine imalatı</li>\r\n<li>Tarım aletleri üretimi</li>\r\n<li>Vinç sanayi </li>\r\n</ul>\r\n<h2 class=\"text-danger\"><strong> </strong></h2>', '<p>‘GELECEK NESİLLERİN GÜVENLE YAŞAYACAKLARI YAPILARA GÜÇ KATIYORUZ’</p>', 'tr', 6, 1, '2022-12-16 13:27:35', '2022-12-23 11:35:38', '2022-12-16 13:24:02', '6bd05379de755c0a5695ef1ef608d867.webp', 10),
(7, 0, 'lama-demirleri', 'Lama Demirleri', '<p>Akın Haddecilik, İzmir ve Denizli tesislerinde üretimi yapılan, demir çelik sektöründe ve başka sektörlerde çeşitli kullanım alanları bulunan <strong>lama profilin</strong> birçok farklı ölçüde, kalitede ve 3mt – 12mt boyları arasında üretebilme kapasitesine sahiptir. Üretilen bu <strong>lama demiri</strong> çelik konstrüksiyonlar, makine sanayi ve otomotiv sektörü gibi pek çok sayamadığımız farklı sektörlerde kullanılır.</p>', '<h2 class=\"text-danger\"><strong>LAMA DEMİRLERİ BAŞLICA KULLANIM ALANLARI<br /></strong></h2>\r\n<ul>\r\n<li>Yapı ve konstrüksiyon</li>\r\n<li>Makine sanayi</li>\r\n<li>Tarım makineleri imalatı</li>\r\n<li>Gemi İnşa Sektörü</li>\r\n<li>Otomotiv sektörü</li>\r\n<li>Kamyon römorkları ve damper imalatı</li>\r\n<li>Dekoratif uygulamalar</li>\r\n<li>Demiryolları yapımı</li>\r\n</ul>\r\n<h2 class=\"text-danger\"><strong> </strong></h2>', '<p>   Gücümüze güç katan Türk makinelerinin gövdelerinde yer almaktan gurur duyuyoruz.</p>', 'tr', 7, 1, '2022-12-16 13:47:11', '2022-12-23 11:34:10', '2022-12-16 13:43:41', '833af71a1c7fcc4203d5b05545ca1ee8.webp', 12),
(8, 0, 'yuvarlak', 'Yuvarlak', '<p>Akın Haddecilik, İzmir ve Denizli tesislerinde üretimi yapılan, demir çelik sektöründe ve başka sektörlerde çeşitli kullanım alanları bulunan <strong>Yuvarlak Profili </strong>birçok farklı ölçüde, kalitede ve 3mt – 12mt boyları arasında üretebilme kapasitesine sahiptir. Üretilen bu <strong>Yuvarlak Profil</strong> inşaat sektörü ve otomotiv sanayi gibi pek çok farklı sektörlerde kullanılır.</p>', '<h2 class=\"text-danger\"><strong>T DEMİRİ BAŞLICA KULLANIM ALANLARI<br /></strong></h2>\r\n<ul>\r\n<li>Savunma sanayi</li>\r\n<li>Otomotiv sanayi</li>\r\n<li>Makine sanayi</li>\r\n<li>İnşaat sektörü</li>\r\n<li>Yedek parça üretimi</li>\r\n<li>Ve gündelik kullanılan tüm demir işleri</li>\r\n</ul>\r\n<h2 class=\"text-danger\"><strong> </strong></h2>', '.', 'tr', 2, 1, '2022-12-16 14:13:32', '2022-12-21 07:54:27', '2022-12-15 14:06:10', '5a5b02c05fb2507f738644011318bcbe.webp', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_w_categories`
--

CREATE TABLE `products_w_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_w_categories`
--

INSERT INTO `products_w_categories` (`id`, `product_id`, `category_id`) VALUES
(22, 8, 1),
(23, 5, 2),
(24, 1, 1),
(25, 7, 1),
(26, 6, 2),
(27, 3, 1),
(28, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `codes_id` int(11) DEFAULT NULL,
  `top_id` int(11) NOT NULL DEFAULT 0,
  `title` longtext DEFAULT NULL,
  `seo_url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `home_url` longtext DEFAULT NULL,
  `banner_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `codes_id`, `top_id`, `title`, `seo_url`, `img_url`, `home_url`, `banner_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `codes`) VALUES
(1, 1, 0, 'ÇİCEKYOLU YOLLUK', 'cicekyolu-yolluk', NULL, NULL, NULL, 'tr', 1, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(2, 8, 0, 'TUNA YOLLUK', 'tuna-yolluk', NULL, NULL, NULL, 'tr', 2, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(3, 12, 0, 'AREL YOLLUK', 'arel-yolluk', NULL, NULL, NULL, 'tr', 3, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(4, 31, 0, 'BAS. YOLLUK', 'bas-yolluk', NULL, NULL, NULL, 'tr', 4, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(5, 34, 0, 'BASKILI YOLLUK', 'baskili-yolluk', NULL, NULL, NULL, 'tr', 5, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(6, 46, 0, 'BAS.YOLLUK', 'bas-yolluk', NULL, NULL, NULL, 'tr', 6, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(7, 63, 0, 'KLASIK', 'klasik', NULL, NULL, NULL, 'tr', 7, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(8, 70, 0, 'TAC', 'tac', NULL, NULL, NULL, 'tr', 8, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(9, 82, 0, 'HAYAL', 'hayal', NULL, NULL, NULL, 'tr', 9, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(10, 84, 0, 'KUMSAL 2', 'kumsal-2', NULL, NULL, NULL, 'tr', 10, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(11, 89, 0, 'SUMER', 'sumer', NULL, NULL, NULL, 'tr', 11, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(12, 92, 0, 'VEZIR', 'vezir', NULL, NULL, NULL, 'tr', 12, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(13, 94, 0, 'NOSTALJI', 'nostalji', NULL, NULL, NULL, 'tr', 13, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(14, 97, 0, 'SHAGGY-25', 'shaggy-25', NULL, NULL, NULL, 'tr', 14, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(15, 109, 0, 'L. SIMAL', 'l-simal', NULL, NULL, NULL, 'tr', 15, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(16, 112, 0, 'L. FANTAZI', 'l-fantazi', NULL, NULL, NULL, 'tr', 16, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(17, 127, 0, 'SANEM', 'sanem', NULL, NULL, NULL, 'tr', 17, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(18, 161, 0, 'CISEM', 'cisem', NULL, NULL, NULL, 'tr', 18, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(19, 174, 0, 'NEPAL', 'nepal', NULL, NULL, NULL, 'tr', 19, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(20, 205, 0, 'IZEL', 'izel', NULL, NULL, NULL, 'tr', 20, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(21, 212, 0, 'LADIK', 'ladik', NULL, NULL, NULL, 'tr', 21, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(22, 214, 0, 'DINARSU NEPAL', 'dinarsu-nepal', NULL, NULL, NULL, 'tr', 22, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(23, 228, 0, 'STYLE SHAGGY', 'style-shaggy', NULL, NULL, NULL, 'tr', 23, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(24, 239, 0, 'ALESTA SHAGGY', 'alesta-shaggy', NULL, NULL, NULL, 'tr', 24, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(25, 248, 0, 'KLASIK NEPAL', 'klasik-nepal', NULL, NULL, NULL, 'tr', 25, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(26, 253, 0, 'BERKE', 'berke', NULL, NULL, NULL, 'tr', 26, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(27, 264, 0, 'SHAGGY DELUXE', 'shaggy-deluxe', NULL, NULL, NULL, 'tr', 27, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(28, 271, 0, 'ISILAY', 'isilay', NULL, NULL, NULL, 'tr', 28, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(29, 273, 0, 'EDA', 'eda', NULL, NULL, NULL, 'tr', 29, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(30, 303, 0, 'SHAGGY LUX', 'shaggy-lux', NULL, NULL, NULL, 'tr', 30, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(31, 315, 0, 'CAKIL', 'cakil', NULL, NULL, NULL, 'tr', 31, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(32, 318, 0, 'KANYON', 'kanyon', NULL, NULL, NULL, 'tr', 32, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(33, 340, 0, 'ANADOLU', 'anadolu', NULL, NULL, NULL, 'tr', 33, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(34, 398, 0, 'SIRAZ', 'siraz', NULL, NULL, NULL, 'tr', 34, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(35, 404, 0, 'EFES', 'efes', NULL, NULL, NULL, 'tr', 35, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(36, 414, 0, 'SUMELA', 'sumela', NULL, NULL, NULL, 'tr', 36, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(37, 419, 0, 'KIRMAN', 'kirman', NULL, NULL, NULL, 'tr', 37, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(38, 427, 0, 'HEREKE', 'hereke', NULL, NULL, NULL, 'tr', 38, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(39, 429, 0, 'AYASOFYA', 'ayasofya', NULL, NULL, NULL, 'tr', 39, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(40, 431, 0, 'MIDYAT', 'midyat', NULL, NULL, NULL, 'tr', 40, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(41, 461, 0, 'MILANO', 'milano', NULL, NULL, NULL, 'tr', 41, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(42, 476, 0, 'SELANIK', 'selanik', NULL, NULL, NULL, 'tr', 42, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(43, 483, 0, 'PARS', 'pars', NULL, NULL, NULL, 'tr', 43, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(44, 488, 0, 'URANUS', 'uranus', NULL, NULL, NULL, 'tr', 44, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(45, 522, 0, 'EFSANE KLASİK', 'efsane-klasik', NULL, NULL, NULL, 'tr', 45, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(46, 530, 0, 'COSMIC SHAGGY', 'cosmic-shaggy', NULL, NULL, NULL, 'tr', 46, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(47, 555, 0, 'EFSANE SHAGGY', 'efsane-shaggy', NULL, NULL, NULL, 'tr', 47, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(48, 567, 0, 'CIZGI SHAGGY', 'cizgi-shaggy', NULL, NULL, NULL, 'tr', 48, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(49, 577, 0, 'ESINTI SHAGGY', 'esinti-shaggy', NULL, NULL, NULL, 'tr', 49, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(50, 586, 0, 'JOY', 'joy', NULL, NULL, NULL, 'tr', 50, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(51, 594, 0, 'SMART', 'smart', NULL, NULL, NULL, 'tr', 51, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(52, 603, 0, 'HARMONY SHAGGY', 'harmony-shaggy', NULL, NULL, NULL, 'tr', 52, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(53, 607, 0, 'BEST', 'best', NULL, NULL, NULL, 'tr', 53, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(54, 614, 0, 'SHAGGY MIXX', 'shaggy-mixx', NULL, NULL, NULL, 'tr', 54, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(55, 616, 0, 'EDA SIMLI', 'eda-simli', NULL, NULL, NULL, 'tr', 55, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(56, 621, 0, 'ISILAY SIMLI', 'isilay-simli', NULL, NULL, NULL, 'tr', 56, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(57, 626, 0, 'SHAGGY LEATHER', 'shaggy-leather', NULL, NULL, NULL, 'tr', 57, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(58, 631, 0, 'ALMERA', 'almera', NULL, NULL, NULL, 'tr', 58, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(59, 633, 0, 'SETENAY', 'setenay', NULL, NULL, NULL, 'tr', 59, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(60, 658, 0, 'POPULER SHAGGY', 'populer-shaggy', NULL, NULL, NULL, 'tr', 60, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(61, 668, 0, 'HOBBY SHAGGY', 'hobby-shaggy', NULL, NULL, NULL, 'tr', 61, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(62, 696, 0, 'RUYA OYMALI', 'ruya-oymali', NULL, NULL, NULL, 'tr', 62, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(63, 701, 0, 'SENA OYMALI', 'sena-oymali', NULL, NULL, NULL, 'tr', 63, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(64, 706, 0, 'ELEGANCE', 'elegance', NULL, NULL, NULL, 'tr', 64, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(65, 715, 0, 'EFSANE RESITAL', 'efsane-resital', NULL, NULL, NULL, 'tr', 65, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(66, 719, 0, 'MEGA COCUK HALISI', 'mega-cocuk-halisi', NULL, NULL, NULL, 'tr', 66, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(67, 736, 0, 'HOLLYWOOD SHAGGY', 'hollywood-shaggy', NULL, NULL, NULL, 'tr', 67, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(68, 750, 0, 'RUYA', 'ruya', NULL, NULL, NULL, 'tr', 68, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(69, 780, 0, 'POLLiNi SiMENA', 'pollini-simena', NULL, NULL, NULL, 'tr', 69, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(70, 784, 0, 'POLLİNİ POLİP', 'pollini-polip', NULL, NULL, NULL, 'tr', 70, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(71, 798, 0, 'SEMENTA KLASiK', 'sementa-klasik', NULL, NULL, NULL, 'tr', 71, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(72, 803, 0, 'ILGIN NEPAL', 'ilgin-nepal', NULL, NULL, NULL, 'tr', 72, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(73, 806, 0, 'ViTAL SiMLi', 'vital-simli', NULL, NULL, NULL, 'tr', 73, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(74, 833, 0, 'POLLiNi KLASiK', 'pollini-klasik', NULL, NULL, NULL, 'tr', 74, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(75, 888, 0, 'DELUXE', 'deluxe', NULL, NULL, NULL, 'tr', 75, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(76, 903, 0, 'REGAL', 'regal', NULL, NULL, NULL, 'tr', 76, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(77, 918, 0, 'LATİNA', 'latina', NULL, NULL, NULL, 'tr', 77, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(78, 931, 0, 'GULHANE', 'gulhane', NULL, NULL, NULL, 'tr', 78, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(79, 944, 0, 'KAPADOKYA', 'kapadokya', NULL, NULL, NULL, 'tr', 79, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(80, 958, 0, 'GALEXY', 'galexy', NULL, NULL, NULL, 'tr', 80, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(81, 968, 0, 'TIBET', 'tibet', NULL, NULL, NULL, 'tr', 81, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(82, 997, 0, 'SIMOLA', 'simola', NULL, NULL, NULL, 'tr', 82, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(83, 1042, 0, 'SIMENTA', 'simenta', NULL, NULL, NULL, 'tr', 83, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(84, 1070, 0, 'ANKARA', 'ankara', NULL, NULL, NULL, 'tr', 84, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(85, 1075, 0, 'KLAS IPEK', 'klas-ipek', NULL, NULL, NULL, 'tr', 85, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(86, 1085, 0, 'AKRILUX', 'akrilux', NULL, NULL, NULL, 'tr', 86, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(87, 1113, 0, 'SULTANAS', 'sultanas', NULL, NULL, NULL, 'tr', 87, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(88, 1132, 0, 'SIMLI AKRILUX', 'simli-akrilux', NULL, NULL, NULL, 'tr', 88, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(89, 1152, 0, 'TUFTY LINE', 'tufty-line', NULL, NULL, NULL, 'tr', 89, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(90, 1178, 0, 'SIMLI KLAS IPEK', 'simli-klas-ipek', NULL, NULL, NULL, 'tr', 90, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(91, 1184, 0, 'MODENA', 'modena', NULL, NULL, NULL, 'tr', 91, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(92, 1215, 0, 'GUMUS', 'gumus', NULL, NULL, NULL, 'tr', 92, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(93, 1217, 0, 'SIENA', 'siena', NULL, NULL, NULL, 'tr', 93, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(94, 1240, 0, 'TRENDY', 'trendy', NULL, NULL, NULL, 'tr', 94, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(95, 1252, 0, 'ANKARA PLUS', 'ankara-plus', NULL, NULL, NULL, 'tr', 95, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(96, 1302, 0, '4 MEVSİM GENÇ', '4-mevsim-genc', NULL, NULL, NULL, 'tr', 96, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(97, 1320, 0, '4 MEVSİM ÇİFT KİŞİLİK', '4-mevsim-cift-kisilik', NULL, NULL, NULL, 'tr', 97, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(98, 1355, 0, 'BEBE UYKU SETİ', 'bebe-uyku-seti', NULL, NULL, NULL, 'tr', 98, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(99, 1360, 0, 'BEBE NEVRESİM TAKIMI', 'bebe-nevresim-takimi', NULL, NULL, NULL, 'tr', 99, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(100, 1361, 0, 'ÇİFT KİŞİLİK NEVRESİM TAKIMI', 'cift-kisilik-nevresim-takimi', NULL, NULL, NULL, 'tr', 100, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(101, 1371, 0, 'ÇİFT KİŞİLİK UYKU SETİ', 'cift-kisilik-uyku-seti', NULL, NULL, NULL, 'tr', 101, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(102, 1380, 0, 'GENÇ NEVRESİM TAKIMI', 'genc-nevresim-takimi', NULL, NULL, NULL, 'tr', 102, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(103, 1383, 0, 'ÖRGÜ BATTANİYE', 'orgu-battaniye', NULL, NULL, NULL, 'tr', 103, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(104, 1391, 0, 'NATURE DUVET SET', 'nature-duvet-set', NULL, NULL, NULL, 'tr', 104, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(105, 1392, 0, 'BODY SET', 'body-set', NULL, NULL, NULL, 'tr', 105, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(106, 1399, 0, 'TEK 4 MEVSİM', 'tek-4-mevsim', NULL, NULL, NULL, 'tr', 106, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(107, 1402, 0, 'TEK NEVRESİM TAKIMI', 'tek-nevresim-takimi', NULL, NULL, NULL, 'tr', 107, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(108, 1405, 0, 'TEK UYKU SETİ', 'tek-uyku-seti', NULL, NULL, NULL, 'tr', 108, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(109, 1409, 0, 'FITTED ÇARŞAF', 'fitted-carsaf', NULL, NULL, NULL, 'tr', 109, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(110, 1412, 0, 'ALEZ', 'alez', NULL, NULL, NULL, 'tr', 110, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(111, 1413, 0, 'MASA ÖRTÜSÜ KARE', 'masa-ortusu-kare', NULL, NULL, NULL, 'tr', 111, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(112, 1420, 0, 'MASA ÖRTÜSÜ DİKDÖRTGEN', 'masa-ortusu-dikdortgen', NULL, NULL, NULL, 'tr', 112, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(113, 1437, 0, 'KLASİK NEPAL', 'klasik-nepal', NULL, NULL, NULL, 'tr', 113, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(114, 1441, 0, 'MAREO', 'mareo', NULL, NULL, NULL, 'tr', 114, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(115, 1442, 0, 'SAHİL', 'sahil', NULL, NULL, NULL, 'tr', 115, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(116, 1443, 0, 'ORİON', 'orion', NULL, NULL, NULL, 'tr', 116, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(117, 1444, 0, 'OKYANUS', 'okyanus', NULL, NULL, NULL, 'tr', 117, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(118, 1445, 0, 'MİSKET', 'misket', NULL, NULL, NULL, 'tr', 118, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(119, 1447, 0, 'FIORE', 'fiore', NULL, NULL, NULL, 'tr', 119, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(120, 1448, 0, 'PANEL', 'panel', NULL, NULL, NULL, 'tr', 120, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(121, 1449, 0, 'FLAVIA', 'flavia', NULL, NULL, NULL, 'tr', 121, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(122, 1450, 0, 'RESİTAL', 'resital', NULL, NULL, NULL, 'tr', 122, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(123, 1451, 0, 'MELODİ', 'melodi', NULL, NULL, NULL, 'tr', 123, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(124, 1452, 0, 'LİNDA', 'linda', NULL, NULL, NULL, 'tr', 124, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(125, 1459, 0, 'GÖKYILDIZ', 'gokyildiz', NULL, NULL, NULL, 'tr', 125, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(126, 1501, 0, 'SONIL', 'sonil', NULL, NULL, NULL, 'tr', 126, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(127, 1509, 0, 'PANDORA', 'pandora', NULL, NULL, NULL, 'tr', 127, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(128, 1512, 0, 'DORMİNA', 'dormina', NULL, NULL, NULL, 'tr', 128, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(129, 1515, 0, 'DİOLEN', 'diolen', NULL, NULL, NULL, 'tr', 129, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(130, 1516, 0, 'DİOLEN SİMLİ', 'diolen-simli', NULL, NULL, NULL, 'tr', 130, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(131, 1523, 0, 'SİESTE', 'sieste', NULL, NULL, NULL, 'tr', 131, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(132, 1528, 0, 'VALERON', 'valeron', NULL, NULL, NULL, 'tr', 132, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(133, 1529, 0, 'OTTOMAN', 'ottoman', NULL, NULL, NULL, 'tr', 133, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(134, 1531, 0, 'KOZA İPEKLİ NEPAL', 'koza-ipekli-nepal', NULL, NULL, NULL, 'tr', 134, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(135, 1534, 0, 'MONALISA', 'monalisa', NULL, NULL, NULL, 'tr', 135, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(136, 1572, 0, 'TOLEDO', 'toledo', NULL, NULL, NULL, 'tr', 136, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(137, 1605, 0, '100', '100', NULL, NULL, NULL, 'tr', 137, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(138, 1607, 0, '160', '160', NULL, NULL, NULL, 'tr', 138, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(139, 1609, 0, '170', '170', NULL, NULL, NULL, 'tr', 139, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(140, 1636, 0, 'POLLINI LUREX', 'pollini-lurex', NULL, NULL, NULL, 'tr', 140, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(141, 1646, 0, 'SUPRIZ', 'supriz', NULL, NULL, NULL, 'tr', 141, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(142, 1658, 0, 'SURPRIZ', 'surpriz', NULL, NULL, NULL, 'tr', 142, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(143, 1712, 0, 'IPEKSI', 'ipeksi', NULL, NULL, NULL, 'tr', 143, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(144, 1716, 0, 'IPEKSI YK', 'ipeksi-yk', NULL, NULL, NULL, 'tr', 144, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(145, 1734, 0, 'AERO CHENNILE', 'aero-chennile', NULL, NULL, NULL, 'tr', 145, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(146, 1737, 0, 'POLLINI CHENILLE', 'pollini-chenille', NULL, NULL, NULL, 'tr', 146, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(147, 1746, 0, 'NEW CHENILLE', 'new-chenille', NULL, NULL, NULL, 'tr', 147, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(148, 1775, 0, 'RİXOS', 'rixos', NULL, NULL, NULL, 'tr', 148, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(149, 1785, 0, 'POLLINI FLOWERS', 'pollini-flowers', NULL, NULL, NULL, 'tr', 149, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(150, 1801, 0, 'POLLINI SHAGGY', 'pollini-shaggy', NULL, NULL, NULL, 'tr', 150, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(151, 1819, 0, 'GOLDEN', 'golden', NULL, NULL, NULL, 'tr', 151, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(152, 1868, 0, 'SELiN', 'selin', NULL, NULL, NULL, 'tr', 152, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(153, 1898, 0, 'POLLiNi', 'pollini', NULL, NULL, NULL, 'tr', 153, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(154, 1980, 0, 'KITTY DE', 'kitty-de', NULL, NULL, NULL, 'tr', 154, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(155, 1984, 0, 'GAME HOUSE DE', 'game-house-de', NULL, NULL, NULL, 'tr', 155, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(156, 1987, 0, 'PALANDÖKEN TIP S. DE', 'palandoken-tip-s-de', NULL, NULL, NULL, 'tr', 156, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(157, 1994, 0, 'TOROS TIP S. DE', 'toros-tip-s-de', NULL, NULL, NULL, 'tr', 157, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(158, 1999, 0, 'KARACADAĞ TIP S. DE', 'karacadag-tip-s-de', NULL, NULL, NULL, 'tr', 158, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(159, 2002, 0, 'ULUDAĞ TIP S. DE', 'uludag-tip-s-de', NULL, NULL, NULL, 'tr', 159, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(160, 2004, 0, 'AKÇAY BUKLE TY', 'akcay-bukle-ty', NULL, NULL, NULL, 'tr', 160, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(161, 2010, 0, 'AKSU BUKLE TY', 'aksu-bukle-ty', NULL, NULL, NULL, 'tr', 161, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(162, 2045, 0, 'ARAS BUKLE TY', 'aras-bukle-ty', NULL, NULL, NULL, 'tr', 162, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(163, 2093, 0, 'BİRGOS BUKLE TY', 'birgos-bukle-ty', NULL, NULL, NULL, 'tr', 163, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(164, 2101, 0, 'CEYHAN BUKLE TY', 'ceyhan-bukle-ty', NULL, NULL, NULL, 'tr', 164, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(165, 2113, 0, 'ÇİNE BUKLE TY', 'cine-bukle-ty', NULL, NULL, NULL, 'tr', 165, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(166, 2114, 0, 'ÇORUH BUKLE TY', 'coruh-bukle-ty', NULL, NULL, NULL, 'tr', 166, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(167, 2122, 0, 'EMET BUKLE TY', 'emet-bukle-ty', NULL, NULL, NULL, 'tr', 167, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(168, 2155, 0, 'FIRAT BUKLE TY', 'firat-bukle-ty', NULL, NULL, NULL, 'tr', 168, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(169, 2156, 0, 'SAKARYA BUKLE TY', 'sakarya-bukle-ty', NULL, NULL, NULL, 'tr', 169, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(170, 2159, 0, 'SİMAV BUKLE TY', 'simav-bukle-ty', NULL, NULL, NULL, 'tr', 170, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(171, 2170, 0, 'TİBER BUKLE TY', 'tiber-bukle-ty', NULL, NULL, NULL, 'tr', 171, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(172, 2192, 0, 'SiMAY SiMLi', 'simay-simli', NULL, NULL, NULL, 'tr', 172, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(173, 2208, 0, 'UNDERWATER BUKLE DE', 'underwater-bukle-de', NULL, NULL, NULL, 'tr', 173, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(174, 2211, 0, 'TRAFFIC BUKLE DE', 'traffic-bukle-de', NULL, NULL, NULL, 'tr', 174, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(175, 2213, 0, 'SEKSEK BUKLE DE', 'seksek-bukle-de', NULL, NULL, NULL, 'tr', 175, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(176, 2220, 0, 'ROMANTIC DE', 'romantic-de', NULL, NULL, NULL, 'tr', 176, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(177, 2222, 0, 'ANIMAL DE', 'animal-de', NULL, NULL, NULL, 'tr', 177, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(178, 2224, 0, 'HAPPY BUNNY DE', 'happy-bunny-de', NULL, NULL, NULL, 'tr', 178, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(179, 2227, 0, 'MOON DE', 'moon-de', NULL, NULL, NULL, 'tr', 179, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(180, 2228, 0, 'BEAR DE', 'bear-de', NULL, NULL, NULL, 'tr', 180, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(181, 2232, 0, 'GIRAFFE DE', 'giraffe-de', NULL, NULL, NULL, 'tr', 181, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(182, 2233, 0, 'TEDDY BEAR DE', 'teddy-bear-de', NULL, NULL, NULL, 'tr', 182, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(183, 2236, 0, 'WORLD BUKLE DE', 'world-bukle-de', NULL, NULL, NULL, 'tr', 183, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(184, 2348, 0, 'MANAVGAT BUKLE TY', 'manavgat-bukle-ty', NULL, NULL, NULL, 'tr', 184, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(185, 2407, 0, 'SAHIKA', 'sahika', NULL, NULL, NULL, 'tr', 185, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(186, 2409, 0, 'SAMPLE AKRILIK', 'sample-akrilik', NULL, NULL, NULL, 'tr', 186, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(187, 2413, 0, 'FIRUZE SIMLI', 'firuze-simli', NULL, NULL, NULL, 'tr', 187, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(188, 2415, 0, 'GULENDAM', 'gulendam', NULL, NULL, NULL, 'tr', 188, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(189, 2430, 0, 'LEONA', 'leona', NULL, NULL, NULL, 'tr', 189, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(190, 2457, 0, 'SPRING BUKLE DE', 'spring-bukle-de', NULL, NULL, NULL, 'tr', 190, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(191, 2458, 0, 'RACE BUKLE DE', 'race-bukle-de', NULL, NULL, NULL, 'tr', 191, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(192, 2460, 0, 'VIOLET BUKLE DE', 'violet-bukle-de', NULL, NULL, NULL, 'tr', 192, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(193, 2477, 0, 'BERLİN DE', 'berlin-de', NULL, NULL, NULL, 'tr', 193, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(194, 2479, 0, 'ELEPHANT DE', 'elephant-de', NULL, NULL, NULL, 'tr', 194, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(195, 2481, 0, 'SEVILLE DE', 'seville-de', NULL, NULL, NULL, 'tr', 195, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(196, 2493, 0, 'LIMA DE', 'lima-de', NULL, NULL, NULL, 'tr', 196, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(197, 2495, 0, 'DION', 'dion', NULL, NULL, NULL, 'tr', 197, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(198, 2497, 0, 'GULENDAM YK', 'gulendam-yk', NULL, NULL, NULL, 'tr', 198, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(199, 2499, 0, 'FULLTIME TZC', 'fulltime-tzc', NULL, NULL, NULL, 'tr', 199, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(200, 2536, 0, 'ARDA BUKLE TY', 'arda-bukle-ty', NULL, NULL, NULL, 'tr', 200, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(201, 2545, 0, 'PROTOKOL BUKLE TY', 'protokol-bukle-ty', NULL, NULL, NULL, 'tr', 201, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(202, 2555, 0, 'ZÜMRÜT', 'zumrut', NULL, NULL, NULL, 'tr', 202, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(203, 2557, 0, 'FİRUZE 800 TY', 'firuze-800-ty', NULL, NULL, NULL, 'tr', 203, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(204, 2560, 0, 'HAVANA DE', 'havana-de', NULL, NULL, NULL, 'tr', 204, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(205, 2566, 0, 'DEVREZ BUKLE TY', 'devrez-bukle-ty', NULL, NULL, NULL, 'tr', 205, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(206, 2584, 0, 'MİNE SHAGGY', 'mine-shaggy', NULL, NULL, NULL, 'tr', 206, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(207, 2612, 0, 'DİANA', 'diana', NULL, NULL, NULL, 'tr', 207, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(208, 2620, 0, 'PALMIYE', 'palmiye', NULL, NULL, NULL, 'tr', 208, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(209, 2621, 0, 'FIRUZE SIMLI BH', 'firuze-simli-bh', NULL, NULL, NULL, 'tr', 209, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(210, 2647, 0, 'ALMEDA', 'almeda', NULL, NULL, NULL, 'tr', 210, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(211, 2650, 0, 'NARiN NEPAL', 'narin-nepal', NULL, NULL, NULL, 'tr', 211, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(212, 2669, 0, 'ELMAS', 'elmas', NULL, NULL, NULL, 'tr', 212, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(213, 2674, 0, 'ASİ BUKLE TY', 'asi-bukle-ty', NULL, NULL, NULL, 'tr', 213, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(214, 2703, 0, 'TUNA BUKLE TY', 'tuna-bukle-ty', NULL, NULL, NULL, 'tr', 214, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(215, 2718, 0, 'MOZAİK', 'mozaik', NULL, NULL, NULL, 'tr', 215, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(216, 2750, 0, 'MOZAIK', 'mozaik', NULL, NULL, NULL, 'tr', 216, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(217, 2773, 0, 'KOZA NEPAL', 'koza-nepal', NULL, NULL, NULL, 'tr', 217, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(218, 2804, 0, 'IPEKSI BABY YK', 'ipeksi-baby-yk', NULL, NULL, NULL, 'tr', 218, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(219, 2805, 0, 'IPEKSI BABY', 'ipeksi-baby', NULL, NULL, NULL, 'tr', 219, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(220, 2806, 0, 'ZUMRUT', 'zumrut', NULL, NULL, NULL, 'tr', 220, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(221, 2809, 0, 'RIXOS', 'rixos', NULL, NULL, NULL, 'tr', 221, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(222, 2815, 0, 'SEDEF', 'sedef', NULL, NULL, NULL, 'tr', 222, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(223, 2825, 0, 'SOLARIS', 'solaris', NULL, NULL, NULL, 'tr', 223, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(224, 2852, 0, 'GOLD-SİMLİ', 'gold-simli', NULL, NULL, NULL, 'tr', 224, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(225, 2861, 0, 'GULENDAM BH', 'gulendam-bh', NULL, NULL, NULL, 'tr', 225, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(226, 2863, 0, 'TERME BUKLE TY', 'terme-bukle-ty', NULL, NULL, NULL, 'tr', 226, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(227, 2864, 0, 'ISTRANCA BUKLE TY', 'istranca-bukle-ty', NULL, NULL, NULL, 'tr', 227, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(228, 2866, 0, 'NİLÜFER BUKLE TY', 'nilufer-bukle-ty', NULL, NULL, NULL, 'tr', 228, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(229, 2867, 0, 'SADABAT BUKLE TY', 'sadabat-bukle-ty', NULL, NULL, NULL, 'tr', 229, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(230, 2868, 0, 'LAKA BUKLE TY', 'laka-bukle-ty', NULL, NULL, NULL, 'tr', 230, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(231, 2870, 0, 'KURA BUKLE TY', 'kura-bukle-ty', NULL, NULL, NULL, 'tr', 231, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(232, 2872, 0, 'GÖKIRMAK BUKLE TY', 'gokirmak-bukle-ty', NULL, NULL, NULL, 'tr', 232, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(233, 2874, 0, 'HAVRAN BUKLE TY', 'havran-bukle-ty', NULL, NULL, NULL, 'tr', 233, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(234, 2875, 0, 'AKAR BUKLE TY', 'akar-bukle-ty', NULL, NULL, NULL, 'tr', 234, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(235, 2882, 0, 'FİLYOS BUKLE TY', 'filyos-bukle-ty', NULL, NULL, NULL, 'tr', 235, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(236, 3102, 0, 'SUDE', 'sude', NULL, NULL, NULL, 'tr', 236, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(237, 3139, 0, 'SÜRPRİZ', 'surpriz', NULL, NULL, NULL, 'tr', 237, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(238, 3147, 0, 'GULENDAM HT', 'gulendam-ht', NULL, NULL, NULL, 'tr', 238, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(239, 3150, 0, 'GULENDAM AR', 'gulendam-ar', NULL, NULL, NULL, 'tr', 239, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(240, 3165, 0, 'ASIYAN', 'asiyan', NULL, NULL, NULL, 'tr', 240, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(241, 3181, 0, 'LOVE  BEYAZ OYMALI', 'love-beyaz-oymali', NULL, NULL, NULL, 'tr', 241, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(242, 3183, 0, 'VEZÜV', 'vezuv', NULL, NULL, NULL, 'tr', 242, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(243, 3228, 0, 'TOWN 133x190 YEŞİL BUKLE', 'town-133x190-yesil-bukle', NULL, NULL, NULL, 'tr', 243, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(244, 3230, 0, 'AQUA PARK 100x160 MAVİ OYMALI', 'aqua-park-100x160-mavi-oymali', NULL, NULL, NULL, 'tr', 244, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(245, 3232, 0, 'FIELD 100x160 K.PEMBE OYMALI', 'field-100x160-k-pembe-oymali', NULL, NULL, NULL, 'tr', 245, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(246, 3233, 0, 'PIRATE 100x160 MAVİ OYMALI', 'pirate-100x160-mavi-oymali', NULL, NULL, NULL, 'tr', 246, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(247, 3234, 0, 'PIRATE SHIP 100x160 MAVİ OYMALI', 'pirate-ship-100x160-mavi-oymali', NULL, NULL, NULL, 'tr', 247, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(248, 3235, 0, 'PRINCESS 100x160 PEMBE OYMALI', 'princess-100x160-pembe-oymali', NULL, NULL, NULL, 'tr', 248, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(249, 3258, 0, 'STUDY TIME 133x190 MAVİ BUKLE', 'study-time-133x190-mavi-bukle', NULL, NULL, NULL, 'tr', 249, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(250, 3280, 0, 'CİTY PARKE', 'city-parke', NULL, NULL, NULL, 'tr', 250, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(251, 3307, 0, 'SYMPATHY', 'sympathy', NULL, NULL, NULL, 'tr', 251, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(252, 3342, 0, 'VEZUV', 'vezuv', NULL, NULL, NULL, 'tr', 252, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(253, 3351, 0, 'BADE', 'bade', NULL, NULL, NULL, 'tr', 253, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(254, 3374, 0, 'WOOD', 'wood', NULL, NULL, NULL, 'tr', 254, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(255, 3382, 0, 'SP118 DİŞ BUDAK', 'sp118-dis-budak', NULL, NULL, NULL, 'tr', 255, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(256, 3403, 0, 'SÜPÜRGELİK', 'supurgelik', NULL, NULL, NULL, 'tr', 256, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(257, 3677, 0, 'HANEDAN', 'hanedan', NULL, NULL, NULL, 'tr', 257, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(258, 3720, 0, 'SAMPLE', 'sample', NULL, NULL, NULL, 'tr', 258, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(259, 3768, 0, 'SHOW OYMA', 'show-oyma', NULL, NULL, NULL, 'tr', 259, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(260, 3829, 0, 'ZİNET', 'zinet', NULL, NULL, NULL, 'tr', 260, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(261, 3842, 0, 'BİLKENT NEPAL', 'bilkent-nepal', NULL, NULL, NULL, 'tr', 261, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(262, 3849, 0, 'JEL', 'jel', NULL, NULL, NULL, 'tr', 262, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(263, 3868, 0, 'VEZUV_simli', 'vezuv-simli', NULL, NULL, NULL, 'tr', 263, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(264, 3881, 0, 'INCI', 'inci', NULL, NULL, NULL, 'tr', 264, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(265, 3921, 0, 'VIRA', 'vira', NULL, NULL, NULL, 'tr', 265, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(266, 3929, 0, 'VIRA SİMLİ', 'vira-simli', NULL, NULL, NULL, 'tr', 266, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(267, 3934, 0, 'ŞİİR', 'siir', NULL, NULL, NULL, 'tr', 267, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(268, 4064, 0, 'LİNEA CAMİLİK', 'linea-camilik', NULL, NULL, NULL, 'tr', 268, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(269, 4109, 0, 'TM LAMİNE', 'tm-lamine', NULL, NULL, NULL, 'tr', 269, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(270, 4113, 0, 'SIIR LUREX', 'siir-lurex', NULL, NULL, NULL, 'tr', 270, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(271, 4118, 0, 'SİMENTA', 'simenta', NULL, NULL, NULL, 'tr', 271, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(272, 4147, 0, '1', '1', NULL, NULL, NULL, 'tr', 272, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(273, 4164, 0, 'GULENDAM SOFT', 'gulendam-soft', NULL, NULL, NULL, 'tr', 273, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(274, 4178, 0, 'SAHIKA SOFT', 'sahika-soft', NULL, NULL, NULL, 'tr', 274, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(275, 4182, 0, 'ALAMODE', 'alamode', NULL, NULL, NULL, 'tr', 275, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(276, 4200, 0, 'VIRA LUREX', 'vira-lurex', NULL, NULL, NULL, 'tr', 276, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(277, 4206, 0, 'PALMIYE SIMLI', 'palmiye-simli', NULL, NULL, NULL, 'tr', 277, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(278, 4223, 0, 'GELİNCİK', 'gelincik', NULL, NULL, NULL, 'tr', 278, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(279, 4235, 0, 'NEVADA', 'nevada', NULL, NULL, NULL, 'tr', 279, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(280, 4275, 0, 'BAHAR', 'bahar', NULL, NULL, NULL, 'tr', 280, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(281, 4310, 0, 'ZINET', 'zinet', NULL, NULL, NULL, 'tr', 281, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(282, 4319, 0, 'SARAYHAN', 'sarayhan', NULL, NULL, NULL, 'tr', 282, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(283, 4357, 0, '420X662', '420x662', NULL, NULL, NULL, 'tr', 283, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(284, 4394, 0, 'MIHRIBAN', 'mihriban', NULL, NULL, NULL, 'tr', 284, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(285, 4468, 0, 'TEBRIZ', 'tebriz', NULL, NULL, NULL, 'tr', 285, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(286, 4498, 0, 'SERENAT', 'serenat', NULL, NULL, NULL, 'tr', 286, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(287, 4507, 0, 'TREND', 'trend', NULL, NULL, NULL, 'tr', 287, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(288, 4509, 0, 'ELDORA', 'eldora', NULL, NULL, NULL, 'tr', 288, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(289, 4609, 0, 'OPTIMUS', 'optimus', NULL, NULL, NULL, 'tr', 289, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(290, 4643, 0, '1104A', '1104a', NULL, NULL, NULL, 'tr', 290, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(291, 4646, 0, '1115A', '1115a', NULL, NULL, NULL, 'tr', 291, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(292, 4648, 0, '1266C', '1266c', NULL, NULL, NULL, 'tr', 292, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(293, 4651, 0, 'YATAK', 'yatak', NULL, NULL, NULL, 'tr', 293, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(294, 4652, 0, 'BATTANİYE', 'battaniye', NULL, NULL, NULL, 'tr', 294, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(295, 4653, 0, 'SAVAN', 'savan', NULL, NULL, NULL, 'tr', 295, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(296, 4654, 0, 'KOLTUK ÖRTÜSÜ', 'koltuk-ortusu', NULL, NULL, NULL, 'tr', 296, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(297, 4655, 0, 'SERİ SONU', 'seri-sonu', NULL, NULL, NULL, 'tr', 297, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(298, 4656, 0, 'SACAKLI KOLEKSIYON', 'sacakli-koleksiyon', NULL, NULL, NULL, 'tr', 298, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(299, 4665, 0, 'VIYANA', 'viyana', NULL, NULL, NULL, 'tr', 299, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(300, 4681, 0, 'AVANGART', 'avangart', NULL, NULL, NULL, 'tr', 300, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(301, 4682, 0, 'RİP RULO', 'rip-rulo', NULL, NULL, NULL, 'tr', 301, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(302, 4726, 0, 'LIPARIS LUREX', 'liparis-lurex', NULL, NULL, NULL, 'tr', 302, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(303, 4738, 0, 'LIPARIS SACAKLI', 'liparis-sacakli', NULL, NULL, NULL, 'tr', 303, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(304, 4748, 0, 'Days In Colors Turuncu', 'days-in-colors-turuncu', NULL, NULL, NULL, 'tr', 304, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(305, 4834, 0, 'Days In Colours Yazlik', 'days-in-colours-yazlik', NULL, NULL, NULL, 'tr', 305, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(306, 4974, 0, 'Days In Colours Vezuv', 'days-in-colours-vezuv', NULL, NULL, NULL, 'tr', 306, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(307, 5021, 0, 'SEDIR', 'sedir', NULL, NULL, NULL, 'tr', 307, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(308, 5044, 0, 'ALATURKA', 'alaturka', NULL, NULL, NULL, 'tr', 308, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(309, 5094, 0, 'LARENDE', 'larende', NULL, NULL, NULL, 'tr', 309, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(310, 5140, 0, 'SAÇAKLI', 'sacakli', NULL, NULL, NULL, 'tr', 310, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(311, 5149, 0, 'NEW YORK', 'new-york', NULL, NULL, NULL, 'tr', 311, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(312, 5155, 0, 'FIRST CLASS', 'first-class', NULL, NULL, NULL, 'tr', 312, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(313, 5156, 0, 'GIZEM SACAKLI', 'gizem-sacakli', NULL, NULL, NULL, 'tr', 313, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(314, 5169, 0, 'SACAKLI', 'sacakli', NULL, NULL, NULL, 'tr', 314, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(315, 5172, 0, 'AMESİS', 'amesis', NULL, NULL, NULL, 'tr', 315, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(316, 5182, 0, 'VIRA SACAKLI', 'vira-sacakli', NULL, NULL, NULL, 'tr', 316, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(317, 5192, 0, '1374', '1374', NULL, NULL, NULL, 'tr', 317, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(318, 5216, 0, 'BUNYAN PALMIYE', 'bunyan-palmiye', NULL, NULL, NULL, 'tr', 318, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(319, 5242, 0, 'RİVA İSTANBUL', 'riva-istanbul', NULL, NULL, NULL, 'tr', 319, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(320, 5255, 0, 'SERONİ', 'seroni', NULL, NULL, NULL, 'tr', 320, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(321, 5308, 0, 'CIRAGAN', 'ciragan', NULL, NULL, NULL, 'tr', 321, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(322, 5320, 0, 'ESTİVA', 'estiva', NULL, NULL, NULL, 'tr', 322, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(323, 5330, 0, 'SÜMBÜL', 'sumbul', NULL, NULL, NULL, 'tr', 323, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(324, 5380, 0, 'Days In Colours Larende', 'days-in-colours-larende', NULL, NULL, NULL, 'tr', 324, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(325, 5383, 0, 'HEREKE KLASİK', 'hereke-klasik', NULL, NULL, NULL, 'tr', 325, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(326, 5446, 0, 'HEREKE TEBRİZ', 'hereke-tebriz', NULL, NULL, NULL, 'tr', 326, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(327, 5457, 0, 'PANDA JEL', 'panda-jel', NULL, NULL, NULL, 'tr', 327, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(328, 5505, 0, 'NARİN', 'narin', NULL, NULL, NULL, 'tr', 328, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(329, 5557, 0, 'HALIC', 'halic', NULL, NULL, NULL, 'tr', 329, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(330, 5565, 0, 'POPULER', 'populer', NULL, NULL, NULL, 'tr', 330, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(331, 5602, 0, '1232C', '1232c', NULL, NULL, NULL, 'tr', 331, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(332, 5605, 0, '1534C', '1534c', NULL, NULL, NULL, 'tr', 332, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(333, 5607, 0, '1551C', '1551c', NULL, NULL, NULL, 'tr', 333, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(334, 5608, 0, '1289C', '1289c', NULL, NULL, NULL, 'tr', 334, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(335, 5610, 0, '1503A', '1503a', NULL, NULL, NULL, 'tr', 335, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(336, 5659, 0, 'HALIC ISILTI', 'halic-isilti', NULL, NULL, NULL, 'tr', 336, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(337, 5673, 0, 'PALMIYE SACAKLI', 'palmiye-sacakli', NULL, NULL, NULL, 'tr', 337, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(338, 5721, 0, 'ISFAHAN', 'isfahan', NULL, NULL, NULL, 'tr', 338, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(339, 5734, 0, 'VİPOL CAMİLİK', 'vipol-camilik', NULL, NULL, NULL, 'tr', 339, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(340, 5736, 0, 'LIPARIS SACAKLI(OVAL)', 'liparis-sacakli-oval', NULL, NULL, NULL, 'tr', 340, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(341, 5741, 0, 'AMASRA', 'amasra', NULL, NULL, NULL, 'tr', 341, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(342, 5747, 0, 'TURKFLEX', 'turkflex', NULL, NULL, NULL, 'tr', 342, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(343, 5777, 0, 'BEVERLY', 'beverly', NULL, NULL, NULL, 'tr', 343, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(344, 5779, 0, 'NARIN', 'narin', NULL, NULL, NULL, 'tr', 344, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(345, 5784, 0, 'YAGMUR', 'yagmur', NULL, NULL, NULL, 'tr', 345, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(346, 5792, 0, 'PALMIYE YAZLIK', 'palmiye-yazlik', NULL, NULL, NULL, 'tr', 346, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(347, 5808, 0, 'SURPRIZ YAZLIK', 'surpriz-yazlik', NULL, NULL, NULL, 'tr', 347, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(348, 5884, 0, 'SEVEN', 'seven', NULL, NULL, NULL, 'tr', 348, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(349, 5929, 0, 'SEDEF SAÇAKLI', 'sedef-sacakli', NULL, NULL, NULL, 'tr', 349, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(350, 5951, 0, 'SEDEF LUX SACAKLI', 'sedef-lux-sacakli', NULL, NULL, NULL, 'tr', 350, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(351, 5959, 0, 'SHOW YAZLIK', 'show-yazlik', NULL, NULL, NULL, 'tr', 351, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(352, 5966, 0, 'SHOW', 'show', NULL, NULL, NULL, 'tr', 352, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(353, 5983, 0, 'LIPARIS LUX', 'liparis-lux', NULL, NULL, NULL, 'tr', 353, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(354, 6031, 0, 'MERLOT', 'merlot', NULL, NULL, NULL, 'tr', 354, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(355, 6061, 0, 'ROSE GARDEN', 'rose-garden', NULL, NULL, NULL, 'tr', 355, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(356, 6125, 0, 'MİNK JEL', 'mink-jel', NULL, NULL, NULL, 'tr', 356, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(357, 6148, 0, 'PREMİUM JEL', 'premium-jel', NULL, NULL, NULL, 'tr', 357, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(358, 6198, 0, 'DORA KİLİM', 'dora-kilim', NULL, NULL, NULL, 'tr', 358, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(359, 6215, 0, 'MİNK DEKORATİF HALI', 'mink-dekoratif-hali', NULL, NULL, NULL, 'tr', 359, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(360, 6271, 0, 'FIRUZE', 'firuze', NULL, NULL, NULL, 'tr', 360, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(361, 6284, 0, 'ALDORA', 'aldora', NULL, NULL, NULL, 'tr', 361, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(362, 6302, 0, 'EXCELLENCE  KİLİM', 'excellence-kilim', NULL, NULL, NULL, 'tr', 362, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(363, 6343, 0, 'EXCELLENCE ANATOLIA NANO KİLİM', 'excellence-anatolia-nano-kilim', NULL, NULL, NULL, 'tr', 363, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(364, 6344, 0, 'PRADA JEL', 'prada-jel', NULL, NULL, NULL, 'tr', 364, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(365, 6350, 0, 'PRADA POST JEL', 'prada-post-jel', NULL, NULL, NULL, 'tr', 365, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(366, 6352, 0, 'EXCELLENCE KİLİM', 'excellence-kilim', NULL, NULL, NULL, 'tr', 366, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(367, 6353, 0, 'ETNA KİLİM', 'etna-kilim', NULL, NULL, NULL, 'tr', 367, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(368, 6354, 0, 'VIOLA KİLİM', 'viola-kilim', NULL, NULL, NULL, 'tr', 368, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(369, 6355, 0, 'GOLD KİLİM', 'gold-kilim', NULL, NULL, NULL, 'tr', 369, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(370, 6356, 0, 'VENÜS KİLİM', 'venus-kilim', NULL, NULL, NULL, 'tr', 370, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(371, 6357, 0, 'MELİS KİLİM', 'melis-kilim', NULL, NULL, NULL, 'tr', 371, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(372, 6358, 0, 'İPEK KİLİM', 'ipek-kilim', NULL, NULL, NULL, 'tr', 372, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(373, 6391, 0, 'EXCELLENCE-ERCIYES', 'excellence-erciyes', NULL, NULL, NULL, 'tr', 373, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(374, 6394, 0, 'EXCELLENCE-GALA', 'excellence-gala', NULL, NULL, NULL, 'tr', 374, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(375, 6411, 0, 'PVC PASPAS', 'pvc-paspas', NULL, NULL, NULL, 'tr', 375, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(376, 6422, 0, 'ADEN', 'aden', NULL, NULL, NULL, 'tr', 376, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(377, 6436, 0, 'EXCELENCE ERCIYES', 'excelence-erciyes', NULL, NULL, NULL, 'tr', 377, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(378, 6443, 0, 'EXCELENCE-GALA', 'excelence-gala', NULL, NULL, NULL, 'tr', 378, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(379, 6448, 0, 'NATURA', 'natura', NULL, NULL, NULL, 'tr', 379, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(380, 6483, 0, 'EXCELLENCE JEL', 'excellence-jel', NULL, NULL, NULL, 'tr', 380, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(381, 6499, 0, 'WEB POST', 'web-post', NULL, NULL, NULL, 'tr', 381, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(382, 6504, 0, 'BELLA KİLİM', 'bella-kilim', NULL, NULL, NULL, 'tr', 382, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(383, 6533, 0, 'EMBOSS JEL', 'emboss-jel', NULL, NULL, NULL, 'tr', 383, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(384, 6535, 0, 'REGNUM POST JEL', 'regnum-post-jel', NULL, NULL, NULL, 'tr', 384, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(385, 6542, 0, 'EXC.SÜPER SOFT P.P.', 'exc-super-soft-p-p', NULL, NULL, NULL, 'tr', 385, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(386, 6551, 0, 'EXCELLENCE CONCEPT', 'excellence-concept', NULL, NULL, NULL, 'tr', 386, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(387, 6626, 0, 'DİAMOND', 'diamond', NULL, NULL, NULL, 'tr', 387, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(388, 6634, 0, 'SOFT SHAGGY', 'soft-shaggy', NULL, NULL, NULL, 'tr', 388, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(389, 6638, 0, 'SEMPATİ KİLİM', 'sempati-kilim', NULL, NULL, NULL, 'tr', 389, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(390, 6647, 0, 'SEMPATİ YOLLUK', 'sempati-yolluk', NULL, NULL, NULL, 'tr', 390, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(391, 6648, 0, 'ÇİM HALI', 'cim-hali', NULL, NULL, NULL, 'tr', 391, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(392, 6656, 0, 'SARDUNYA PASPAS', 'sardunya-paspas', NULL, NULL, NULL, 'tr', 392, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(393, 6670, 0, 'EXCELLENCE CLASSİC', 'excellence-classic', NULL, NULL, NULL, 'tr', 393, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(394, 6685, 0, 'SARAR JEL', 'sarar-jel', NULL, NULL, NULL, 'tr', 394, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(395, 7333, 0, 'ARMONİA', 'armonia', NULL, NULL, NULL, 'tr', 395, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(396, 8180, 0, 'SEDİR', 'sedir', NULL, NULL, NULL, 'tr', 396, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(397, 8747, 0, 'EXCELLENCE SERRA', 'excellence-serra', NULL, NULL, NULL, 'tr', 397, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(398, 9265, 0, 'PERA', 'pera', NULL, NULL, NULL, 'tr', 398, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(399, 9587, 0, 'EXCELLENCE PORTO', 'excellence-porto', NULL, NULL, NULL, 'tr', 399, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(400, 9591, 0, 'EXCELLENCE TREND', 'excellence-trend', NULL, NULL, NULL, 'tr', 400, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(401, 9764, 0, 'EXCELLENCE SARAYHAN', 'excellence-sarayhan', NULL, NULL, NULL, 'tr', 401, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(402, 9847, 0, 'EXCELLENCE CASELLA', 'excellence-casella', NULL, NULL, NULL, 'tr', 402, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(403, 9849, 0, 'EXCELLENCA CASELLA', 'excellenca-casella', NULL, NULL, NULL, 'tr', 403, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(404, 10025, 0, 'NOVA JEL', 'nova-jel', NULL, NULL, NULL, 'tr', 404, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 1),
(405, 1, 0, 'SULTANA', 'sultana', NULL, NULL, NULL, 'tr', 405, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2);
INSERT INTO `product_categories` (`id`, `codes_id`, `top_id`, `title`, `seo_url`, `img_url`, `home_url`, `banner_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `codes`) VALUES
(406, 6, 0, 'CLASSIC NEPAL', 'classic-nepal', NULL, NULL, NULL, 'tr', 406, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(407, 28, 0, 'Camilik', 'camilik', NULL, NULL, NULL, 'tr', 407, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(408, 36, 0, 'IPEK NEPAL', 'ipek-nepal', NULL, NULL, NULL, 'tr', 408, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(409, 98, 0, 'GOLD NEPAL', 'gold-nepal', NULL, NULL, NULL, 'tr', 409, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(410, 163, 0, 'Hisar', 'hisar', NULL, NULL, NULL, 'tr', 410, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(411, 176, 0, 'TRENDY', 'trendy', NULL, NULL, NULL, 'tr', 411, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(412, 190, 0, 'BAHAR', 'bahar', NULL, NULL, NULL, 'tr', 412, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(413, 200, 0, 'DEKOR', 'dekor', NULL, NULL, NULL, 'tr', 413, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(414, 272, 0, 'Locca', 'locca', NULL, NULL, NULL, 'tr', 414, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(415, 278, 0, 'Tuft', 'tuft', NULL, NULL, NULL, 'tr', 415, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(416, 280, 0, 'Sultan Faris', 'sultan-faris', NULL, NULL, NULL, 'tr', 416, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(417, 290, 0, 'TIFTIK', 'tiftik', NULL, NULL, NULL, 'tr', 417, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(418, 297, 0, 'IPEKOZEL', 'ipekozel', NULL, NULL, NULL, 'tr', 418, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(419, 301, 0, 'ŞEHRAZAT', 'sehrazat', NULL, NULL, NULL, 'tr', 419, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(420, 376, 0, 'MILLENNIUM', 'millennium', NULL, NULL, NULL, 'tr', 420, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(421, 387, 0, 'KAFTAN', 'kaftan', NULL, NULL, NULL, 'tr', 421, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(422, 392, 0, 'ORHUN', 'orhun', NULL, NULL, NULL, 'tr', 422, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(423, 395, 0, 'OLİMPOS', 'olimpos', NULL, NULL, NULL, 'tr', 423, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(424, 420, 0, 'ORİENTAL', 'oriental', NULL, NULL, NULL, 'tr', 424, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(425, 436, 0, 'PRESTİJ', 'prestij', NULL, NULL, NULL, 'tr', 425, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(426, 445, 0, 'SHAGGY ŞARK', 'shaggy-sark', NULL, NULL, NULL, 'tr', 426, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(427, 448, 0, 'SHAGGY FIRAT', 'shaggy-firat', NULL, NULL, NULL, 'tr', 427, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(428, 452, 0, 'SHAGGY PETEK', 'shaggy-petek', NULL, NULL, NULL, 'tr', 428, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(429, 458, 0, 'IŞIL', 'isil', NULL, NULL, NULL, 'tr', 429, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(430, 464, 0, 'GÜMÜŞ YOLLUK', 'gumus-yolluk', NULL, NULL, NULL, 'tr', 430, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(431, 494, 0, 'mohair', 'mohair', NULL, NULL, NULL, 'tr', 431, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(432, 506, 0, 'FAVORİ', 'favori', NULL, NULL, NULL, 'tr', 432, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(433, 511, 0, 'SELİN', 'selin', NULL, NULL, NULL, 'tr', 433, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(434, 517, 0, 'ŞENGEZER', 'sengezer', NULL, NULL, NULL, 'tr', 434, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(435, 519, 0, 'NAMAZLIK', 'namazlik', NULL, NULL, NULL, 'tr', 435, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(436, 521, 0, 'SERİSONU', 'serisonu', NULL, NULL, NULL, 'tr', 436, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(437, 528, 0, 'KİLİM', 'kilim', NULL, NULL, NULL, 'tr', 437, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(438, 531, 0, 'UFUK', 'ufuk', NULL, NULL, NULL, 'tr', 438, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(439, 533, 0, 'SAVAN', 'savan', NULL, NULL, NULL, 'tr', 439, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(440, 534, 0, 'KALE KİLİM', 'kale-kilim', NULL, NULL, NULL, 'tr', 440, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(441, 535, 0, 'SAÇIL', 'sacil', NULL, NULL, NULL, 'tr', 441, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(442, 536, 0, 'ATLAS', 'atlas', NULL, NULL, NULL, 'tr', 442, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(443, 538, 0, 'AKSU', 'aksu', NULL, NULL, NULL, 'tr', 443, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(444, 539, 0, 'OĞUL', 'ogul', NULL, NULL, NULL, 'tr', 444, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(445, 540, 0, 'SESLİ', 'sesli', NULL, NULL, NULL, 'tr', 445, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(446, 541, 0, 'NİSAN', 'nisan', NULL, NULL, NULL, 'tr', 446, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(447, 542, 0, 'TERMOLEX', 'termolex', NULL, NULL, NULL, 'tr', 447, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(448, 544, 0, 'LUX SAVAN', 'lux-savan', NULL, NULL, NULL, 'tr', 448, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(449, 546, 0, 'PIRILTI', 'pirilti', NULL, NULL, NULL, 'tr', 449, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(450, 565, 0, 'ZÜMRÜT', 'zumrut', NULL, NULL, NULL, 'tr', 450, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(451, 569, 0, 'ANAOLIA', 'anaolia', NULL, NULL, NULL, 'tr', 451, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(452, 585, 0, 'SHAGGY SOFT', 'shaggy-soft', NULL, NULL, NULL, 'tr', 452, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(453, 598, 0, 'MELSAN', 'melsan', NULL, NULL, NULL, 'tr', 453, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(454, 619, 0, 'İpek', 'ipek', NULL, NULL, NULL, 'tr', 454, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(455, 700, 0, 'AMBIANCE', 'ambiance', NULL, NULL, NULL, 'tr', 455, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(456, 709, 0, 'LİRİK', 'lirik', NULL, NULL, NULL, 'tr', 456, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(457, 748, 0, 'ANATOLIA', 'anatolia', NULL, NULL, NULL, 'tr', 457, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(458, 753, 0, 'YILDIZ', 'yildiz', NULL, NULL, NULL, 'tr', 458, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(459, 783, 0, 'AZRA', 'azra', NULL, NULL, NULL, 'tr', 459, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(460, 795, 0, 'TUANA', 'tuana', NULL, NULL, NULL, 'tr', 460, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(461, 826, 0, 'AVANGARD-NİŞAN', 'avangard-nisan', NULL, NULL, NULL, 'tr', 461, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(462, 873, 0, 'AVANGARD', 'avangard', NULL, NULL, NULL, 'tr', 462, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(463, 893, 0, 'JEL', 'jel', NULL, NULL, NULL, 'tr', 463, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(464, 894, 0, 'KUPON', 'kupon', NULL, NULL, NULL, 'tr', 464, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(465, 905, 0, 'ADEN', 'aden', NULL, NULL, NULL, 'tr', 465, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(466, 926, 0, 'LAPIS', 'lapis', NULL, NULL, NULL, 'tr', 466, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(467, 946, 0, 'İSFAHAN', 'isfahan', NULL, NULL, NULL, 'tr', 467, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(468, 952, 0, 'SİMLİ  NUMUNE', 'simli-numune', NULL, NULL, NULL, 'tr', 468, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(469, 954, 0, 'SİMLİ NUMUNE', 'simli-numune', NULL, NULL, NULL, 'tr', 469, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(470, 967, 0, 'GELİNCİK', 'gelincik', NULL, NULL, NULL, 'tr', 470, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(471, 968, 0, 'SİMLİ GELİNCİK', 'simli-gelincik', NULL, NULL, NULL, 'tr', 471, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(472, 978, 0, 'PERA', 'pera', NULL, NULL, NULL, 'tr', 472, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(473, 987, 0, 'AÇELYA', 'acelya', NULL, NULL, NULL, 'tr', 473, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(474, 1000, 0, 'FESHANE', 'feshane', NULL, NULL, NULL, 'tr', 474, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(475, 1037, 0, 'İPEK MİLAS', 'ipek-milas', NULL, NULL, NULL, 'tr', 475, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(476, 1135, 0, 'GALA', 'gala', NULL, NULL, NULL, 'tr', 476, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(477, 1312, 0, 'CRAFT', 'craft', NULL, NULL, NULL, 'tr', 477, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(478, 1334, 0, 'BOYUT', 'boyut', NULL, NULL, NULL, 'tr', 478, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(479, 1344, 0, 'S300D', 's300d', NULL, NULL, NULL, 'tr', 479, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(480, 1347, 0, 'VD. Adenya', 'vd-adenya', NULL, NULL, NULL, 'tr', 480, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(481, 1367, 0, 'SEÇİL', 'secil', NULL, NULL, NULL, 'tr', 481, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(482, 1379, 0, 'SEVEN', 'seven', NULL, NULL, NULL, 'tr', 482, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(483, 1408, 0, 'FAVORI', 'favori', NULL, NULL, NULL, 'tr', 483, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(484, 1440, 0, 'MODEL', 'model', NULL, NULL, NULL, 'tr', 484, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(485, 1444, 0, 'İPEK FAVORİ', 'ipek-favori', NULL, NULL, NULL, 'tr', 485, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(486, 1452, 0, 'OTTOMAN', 'ottoman', NULL, NULL, NULL, 'tr', 486, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(487, 1459, 0, 'OLİVYA', 'olivya', NULL, NULL, NULL, 'tr', 487, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(488, 1464, 0, 'KRİSTAL', 'kristal', NULL, NULL, NULL, 'tr', 488, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(489, 1493, 0, 'ÖZEL', 'ozel', NULL, NULL, NULL, 'tr', 489, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(490, 1504, 0, 'SEMENTA KLASiK', 'sementa-klasik', NULL, NULL, NULL, 'tr', 490, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(491, 1527, 0, 'İPEK SEDEF', 'ipek-sedef', NULL, NULL, NULL, 'tr', 491, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(492, 1546, 0, 'EBRULİ', 'ebruli', NULL, NULL, NULL, 'tr', 492, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(493, 1553, 0, 'OTTOMAN SACAKLI', 'ottoman-sacakli', NULL, NULL, NULL, 'tr', 493, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(494, 1614, 0, 'İPEK ELMAS', 'ipek-elmas', NULL, NULL, NULL, 'tr', 494, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(495, 1640, 0, 'VALDES', 'valdes', NULL, NULL, NULL, 'tr', 495, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(496, 1649, 0, 'KOTON', 'koton', NULL, NULL, NULL, 'tr', 496, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(497, 1694, 0, 'İPEKSİ', 'ipeksi', NULL, NULL, NULL, 'tr', 497, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(498, 1705, 0, 'GELINCIK', 'gelincik', NULL, NULL, NULL, 'tr', 498, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(499, 1756, 0, 'DORA KİLİM', 'dora-kilim', NULL, NULL, NULL, 'tr', 499, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(500, 1759, 0, 'ŞÖNİL KİLİM', 'sonil-kilim', NULL, NULL, NULL, 'tr', 500, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(501, 1778, 0, 'NUBUK', 'nubuk', NULL, NULL, NULL, 'tr', 501, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(502, 1793, 0, 'ASPENDOS', 'aspendos', NULL, NULL, NULL, 'tr', 502, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(503, 1804, 0, 'EMBOS', 'embos', NULL, NULL, NULL, 'tr', 503, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(504, 1864, 0, 'SAMPLE', 'sample', NULL, NULL, NULL, 'tr', 504, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(505, 1872, 0, 'EVVA', 'evva', NULL, NULL, NULL, 'tr', 505, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(506, 1884, 0, 'BAMBU', 'bambu', NULL, NULL, NULL, 'tr', 506, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(507, 1893, 0, 'EXCLUSİVE', 'exclusive', NULL, NULL, NULL, 'tr', 507, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(508, 1896, 0, 'ASPERA', 'aspera', NULL, NULL, NULL, 'tr', 508, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(509, 1901, 0, 'ERCIYES', 'erciyes', NULL, NULL, NULL, 'tr', 509, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(510, 1938, 0, 'ERCIYES SACAKLI', 'erciyes-sacakli', NULL, NULL, NULL, 'tr', 510, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(511, 1989, 0, 'AVALON', 'avalon', NULL, NULL, NULL, 'tr', 511, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(512, 1991, 0, 'BROOKLYN', 'brooklyn', NULL, NULL, NULL, 'tr', 512, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(513, 1995, 0, 'ATY-BAMBU', 'aty-bambu', NULL, NULL, NULL, 'tr', 513, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(514, 1997, 0, 'VELVET', 'velvet', NULL, NULL, NULL, 'tr', 514, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(515, 1999, 0, '24JUTZERO', '24jutzero', NULL, NULL, NULL, 'tr', 515, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(516, 2001, 0, 'MİLANO', 'milano', NULL, NULL, NULL, 'tr', 516, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(517, 2004, 0, 'DROPLU', 'droplu', NULL, NULL, NULL, 'tr', 517, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(518, 2006, 0, 'CURLY', 'curly', NULL, NULL, NULL, 'tr', 518, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(519, 2008, 0, 'MİLANO2', 'milano2', NULL, NULL, NULL, 'tr', 519, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(520, 2010, 0, 'LYNESSE', 'lynesse', NULL, NULL, NULL, 'tr', 520, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(521, 2016, 0, 'BURN COTON', 'burn-coton', NULL, NULL, NULL, 'tr', 521, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(522, 2022, 0, 'QUEEN', 'queen', NULL, NULL, NULL, 'tr', 522, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(523, 2028, 0, 'TOUCH COTON', 'touch-coton', NULL, NULL, NULL, 'tr', 523, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(524, 5049, 0, 'BANCO', 'banco', NULL, NULL, NULL, 'tr', 524, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(525, 5073, 0, 'KAYMAZ TABAN', 'kaymaz-taban', NULL, NULL, NULL, 'tr', 525, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(526, 5076, 0, '20005A', '20005a', NULL, NULL, NULL, 'tr', 526, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(527, 5081, 0, '20016A', '20016a', NULL, NULL, NULL, 'tr', 527, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(528, 5084, 0, '20026A', '20026a', NULL, NULL, NULL, 'tr', 528, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(529, 5087, 0, '20032A', '20032a', NULL, NULL, NULL, 'tr', 529, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(530, 5097, 0, 'EXCELLENCE CONCEPT', 'excellence-concept', NULL, NULL, NULL, 'tr', 530, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(531, 5132, 0, 'CIZGI', 'cizgi', NULL, NULL, NULL, 'tr', 531, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(532, 5138, 0, 'LYONESSE', 'lyonesse', NULL, NULL, NULL, 'tr', 532, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(533, 5140, 0, 'OLIVYA', 'olivya', NULL, NULL, NULL, 'tr', 533, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(534, 5148, 0, 'IPEK', 'ipek', NULL, NULL, NULL, 'tr', 534, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(535, 7204, 0, 'POST', 'post', NULL, NULL, NULL, 'tr', 535, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(536, 7208, 0, 'EXCELLENCE IMOLA', 'excellence-imola', NULL, NULL, NULL, 'tr', 536, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(537, 7244, 0, 'FAVORI SİLVER', 'favori-silver', NULL, NULL, NULL, 'tr', 537, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(538, 7378, 0, 'SİLVER', 'silver', NULL, NULL, NULL, 'tr', 538, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(539, 7616, 0, 'JELUX', 'jelux', NULL, NULL, NULL, 'tr', 539, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(540, 7716, 0, 'BENTLEY', 'bentley', NULL, NULL, NULL, 'tr', 540, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(541, 7795, 0, 'MONACO', 'monaco', NULL, NULL, NULL, 'tr', 541, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(542, 7805, 0, 'HARMNY', 'harmny', NULL, NULL, NULL, 'tr', 542, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(543, 7970, 0, 'EXCELLENCE PRUVA', 'excellence-pruva', NULL, NULL, NULL, 'tr', 543, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(544, 7971, 0, 'EXCELLENCE HARMONY', 'excellence-harmony', NULL, NULL, NULL, 'tr', 544, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(545, 7972, 0, 'EXCELLENCE BENTLEY', 'excellence-bentley', NULL, NULL, NULL, 'tr', 545, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(546, 8035, 0, 'HARMONY', 'harmony', NULL, NULL, NULL, 'tr', 546, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(547, 8036, 0, 'PRUVA', 'pruva', NULL, NULL, NULL, 'tr', 547, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(548, 8039, 0, 'EXCELLENCE HARMOY', 'excellence-harmoy', NULL, NULL, NULL, 'tr', 548, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(549, 8040, 0, 'EXCELLENCE CARINO', 'excellence-carino', NULL, NULL, NULL, 'tr', 549, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2),
(550, 8092, 0, 'HAMRY', 'hamry', NULL, NULL, NULL, 'tr', 550, 1, '2023-01-02 12:29:35', '2023-01-02 12:29:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_dimensions`
--

CREATE TABLE `product_dimensions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `lang` char(2) NOT NULL DEFAULT 'tr',
  `img_url` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_dimensions`
--

INSERT INTO `product_dimensions` (`id`, `product_id`, `title`, `lang`, `img_url`, `isActive`, `rank`, `createdAt`, `updatedAt`) VALUES
(4, 4, 'EŞİTKENAR KÖŞEBENT BİRİM AĞIRLIK TABLOSU', 'tr', '14bfcb97763e45bb62373f6bf4984301.webp', 1, 2, '2022-12-16 12:11:29', '2022-12-16 12:21:53'),
(13, 7, 'LAMA DEMİRLERİ PROFİL BİRİM AĞIRLIK TABLOSU', 'tr', '6052b161576a833f2d7dcc1ca024d50d.webp', 1, 8, '2022-12-16 13:49:31', '2022-12-16 13:49:31'),
(15, 8, 'YUVARLAK PROFİL BİRİM AĞIRLIK TABLOSU', 'tr', '37107f28d2d713c43b5d66c77af21867.webp', 1, 10, '2022-12-16 14:15:54', '2022-12-16 14:15:54'),
(23, 7, 'LAMA DEMİRLERİ PROFİL BİRİM AĞIRLIK TABLOSU', 'tr', '2a48d230a26ef18b6c7abec5bf8ac30b.webp', 1, 10, '2022-12-22 12:52:30', '2022-12-22 12:52:30'),
(24, 1, 'KARE PROFİL BİRİM AĞIRLIK TABLOSU', 'tr', '28bf61bd3ce6b0579c264dc88f7480dd.webp', 1, 10, '2022-12-22 12:55:37', '2022-12-22 12:55:37'),
(25, 5, 'NPU PROFİL BİRİM AĞIRLIK TABLOSU', 'tr', '892e37f22762b89c991f99375500e5e5.webp', 1, 9, '2022-12-22 13:05:07', '2022-12-22 13:05:07'),
(26, 5, 'NPU PROFİL BİRİM AĞIRLIK TABLOSU', 'tr', '23fca74b008a45681807b847009c0d4d.webp', 1, 10, '2022-12-22 13:05:21', '2022-12-22 13:05:21'),
(27, 3, 'T DEMİRİ BİRİM AĞIRLIK TABLOSU', 'tr', 'dea554b2d94519e086a751b45da8967c.webp', 1, 10, '2022-12-22 13:09:39', '2022-12-22 13:09:39'),
(29, 4, 'EŞİTKENAR KÖŞEBENT BİRİM AĞIRLIK TABLOSU', 'tr', '033bcb1f586a90042947a1d251d10aa7.webp', 1, 10, '2022-12-23 10:39:50', '2022-12-23 10:39:50'),
(30, 6, 'NPI – IPE Profilleri', 'tr', '91cf00103aa110c0d4855606d3090d04.webp', 1, 10, '2022-12-23 10:49:55', '2022-12-23 10:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `isCover` tinyint(4) DEFAULT 0,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `url`, `img_url`, `title`, `description`, `lang`, `rank`, `isActive`, `isCover`, `createdAt`, `updatedAt`) VALUES
(8, 1, 'c743e8bf2c1450031df17dd591a15052.webp', NULL, NULL, NULL, 'tr', 2, 1, 0, '2022-12-15 13:31:51', '2022-12-15 13:31:51'),
(9, 1, '51da70e554a9e99fb5c2bd0c0ebbec47.webp', NULL, NULL, NULL, 'tr', 3, 1, 1, '2022-12-15 13:31:51', '2022-12-15 13:31:58'),
(10, 1, '53b467d31358dec5ebe01e5fc8c544f0.webp', NULL, NULL, NULL, 'tr', 4, 1, 0, '2022-12-15 13:31:52', '2022-12-15 13:31:52'),
(11, 1, '51d4e0f0363f94d3097b96d915d547cc.webp', NULL, NULL, NULL, 'tr', 5, 1, 0, '2022-12-15 13:31:53', '2022-12-15 13:31:53'),
(12, 1, '0726264a916ef1fae33da64638ee09f8.webp', NULL, NULL, NULL, 'tr', 6, 1, 0, '2022-12-15 13:31:54', '2022-12-15 13:31:54'),
(13, 1, 'dfc2533e4e6820ff77a1b2c20d7b2671.webp', NULL, NULL, NULL, 'tr', 7, 1, 0, '2022-12-15 13:31:55', '2022-12-15 13:31:55'),
(14, 3, 'b8239e4f801448415f0161a418b041b8.webp', NULL, NULL, NULL, 'tr', 7, 1, 1, '2022-12-16 11:58:26', '2022-12-16 11:59:21'),
(15, 3, 'e9ea4142ee5897d121383ed156084943.webp', NULL, NULL, NULL, 'tr', 8, 1, 0, '2022-12-16 11:58:27', '2022-12-16 11:58:27'),
(16, 3, '0000ecabf7a9948acb7285a4a618f165.webp', NULL, NULL, NULL, 'tr', 9, 1, 0, '2022-12-16 11:58:29', '2022-12-16 11:58:29'),
(17, 3, 'c6aaf3e3bf7fa6632b0c068d8b30cb06.webp', NULL, NULL, NULL, 'tr', 10, 1, 0, '2022-12-16 11:58:30', '2022-12-16 11:58:30'),
(18, 3, 'f2dfa42783b67f2359188b41e30a2cc8.webp', NULL, NULL, NULL, 'tr', 11, 1, 0, '2022-12-16 11:58:31', '2022-12-16 11:58:31'),
(19, 3, '99839f6da7aae1a5da12a770425c6075.webp', NULL, NULL, NULL, 'tr', 12, 1, 0, '2022-12-16 11:58:32', '2022-12-16 11:58:32'),
(20, 3, '1b47c8791f28f6c5de157864ba619e49.webp', NULL, NULL, NULL, 'tr', 13, 1, 0, '2022-12-16 11:58:34', '2022-12-16 11:58:34'),
(21, 3, '4e1fc403f20aadbc291d57f3c4c5211c.webp', NULL, NULL, NULL, 'tr', 14, 1, 0, '2022-12-16 11:58:35', '2022-12-16 11:58:35'),
(22, 3, '07a12dad8eb6b6bfcfb95d99579658cf.webp', NULL, NULL, NULL, 'tr', 15, 1, 0, '2022-12-16 11:58:36', '2022-12-16 11:58:36'),
(23, 3, '94c8304056c0cbdf8715aa2f8a824421.webp', NULL, NULL, NULL, 'tr', 16, 1, 0, '2022-12-16 11:58:38', '2022-12-16 11:58:38'),
(24, 3, '57cba3a20c270e0548377c4824d0fdcc.webp', NULL, NULL, NULL, 'tr', 17, 1, 0, '2022-12-16 11:58:39', '2022-12-16 11:58:39'),
(25, 3, '506cbe84fec93df323d0b875b4c6129c.webp', NULL, NULL, NULL, 'tr', 18, 1, 0, '2022-12-16 11:58:40', '2022-12-16 11:58:40'),
(26, 3, 'dd7efe04f031ca5c844c84d5030f6319.webp', NULL, NULL, NULL, 'tr', 19, 1, 0, '2022-12-16 11:58:41', '2022-12-16 11:58:41'),
(27, 3, 'f0a27f9e1a91050871cf194087575dab.webp', NULL, NULL, NULL, 'tr', 20, 1, 0, '2022-12-16 11:58:42', '2022-12-16 11:58:42'),
(28, 3, 'eb881543f1bc1b59b2f3831be42d43b3.webp', NULL, NULL, NULL, 'tr', 21, 1, 0, '2022-12-16 11:58:44', '2022-12-16 11:58:44'),
(29, 3, '50b9e688d155a3980b5d04e3393e0cac.webp', NULL, NULL, NULL, 'tr', 22, 1, 0, '2022-12-16 11:58:45', '2022-12-16 11:58:45'),
(30, 3, 'b762dde11f754b3542077e7a8f54e4e3.webp', NULL, NULL, NULL, 'tr', 23, 1, 0, '2022-12-16 11:58:46', '2022-12-16 11:58:46'),
(31, 4, 'fba8bc86cd263efa89de9ee4e81ac8ec.webp', NULL, NULL, NULL, 'tr', 24, 1, 0, '2022-12-16 12:12:13', '2022-12-16 12:12:13'),
(32, 4, 'c649ab3f2e682ef87ae9f499ffb51f3f.webp', NULL, NULL, NULL, 'tr', 25, 1, 0, '2022-12-16 12:12:13', '2022-12-16 12:12:13'),
(33, 4, 'cd7700066a6d77bdd71e6d6f9e56fccf.webp', NULL, NULL, NULL, 'tr', 26, 1, 0, '2022-12-16 12:12:14', '2022-12-16 12:12:14'),
(34, 4, '74d407fea0494cbf38a263e3dc7a7d5a.webp', NULL, NULL, NULL, 'tr', 27, 1, 0, '2022-12-16 12:12:15', '2022-12-16 12:12:15'),
(35, 4, '0233e565f7c43a0d8722edf9087238d0.webp', NULL, NULL, NULL, 'tr', 28, 1, 0, '2022-12-16 12:12:16', '2022-12-16 12:12:16'),
(36, 4, 'fdfb153f3a317da189d3bbe14cc32afb.webp', NULL, NULL, NULL, 'tr', 29, 1, 0, '2022-12-16 12:12:16', '2022-12-16 12:12:16'),
(37, 4, 'a739050466bfaf3495bdfd358233883f.webp', NULL, NULL, NULL, 'tr', 30, 1, 1, '2022-12-16 12:12:17', '2022-12-16 12:12:30'),
(38, 4, '636fdf82d9bda5f08f8a696ec814eeb9.webp', NULL, NULL, NULL, 'tr', 31, 1, 0, '2022-12-16 12:12:18', '2022-12-16 12:12:18'),
(39, 4, 'cc6c8ccc9494f5e9ada3caf82919fa84.webp', NULL, NULL, NULL, 'tr', 32, 1, 0, '2022-12-16 12:12:19', '2022-12-16 12:12:19'),
(40, 4, '23147e406e87391010dd01f71478f2a3.webp', NULL, NULL, NULL, 'tr', 33, 1, 0, '2022-12-16 12:12:20', '2022-12-16 12:12:20'),
(41, 5, '0f1af9038382b04d978488bda2c7ba83.webp', NULL, NULL, NULL, 'tr', 34, 1, 0, '2022-12-16 12:37:08', '2022-12-16 12:37:08'),
(42, 5, '441ef36f4c9da7715c90d24af9fcf689.webp', NULL, NULL, NULL, 'tr', 35, 1, 0, '2022-12-16 12:37:09', '2022-12-16 12:37:09'),
(43, 5, '840900aa84a008b0ca2ebcac7ac824ef.webp', NULL, NULL, NULL, 'tr', 36, 1, 0, '2022-12-16 12:37:10', '2022-12-16 12:37:10'),
(44, 5, 'ef0b18460b12ff2ec9bbc6b4fa2da96a.webp', NULL, NULL, NULL, 'tr', 37, 1, 0, '2022-12-16 12:37:11', '2022-12-16 12:37:11'),
(45, 5, '85ad059ab17c03c1ebb0ecab7fa8e1c7.webp', NULL, NULL, NULL, 'tr', 38, 1, 0, '2022-12-16 12:37:12', '2022-12-16 12:37:12'),
(46, 5, 'b55dc3cbdacc3b6db4c62bae6ed77307.webp', NULL, NULL, NULL, 'tr', 39, 1, 0, '2022-12-16 12:37:12', '2022-12-16 12:37:12'),
(47, 5, '862d3f39f038972773aad5b4e0c6f079.webp', NULL, NULL, NULL, 'tr', 40, 1, 0, '2022-12-16 12:37:13', '2022-12-16 12:37:13'),
(48, 5, '3ed38680554484ebc76a325767b2cc5c.webp', NULL, NULL, NULL, 'tr', 41, 1, 0, '2022-12-16 12:37:14', '2022-12-16 12:37:14'),
(49, 5, '0843eded26fab8453524121bb7c1c192.webp', NULL, NULL, NULL, 'tr', 42, 1, 1, '2022-12-16 12:37:15', '2022-12-16 14:37:11'),
(50, 5, '2e774e3b1c5bc0717fd924deae3a072f.webp', NULL, NULL, NULL, 'tr', 43, 1, 0, '2022-12-16 12:37:16', '2022-12-16 12:37:16'),
(51, 6, '6fab7b4beb96d0a6f3ea49d829aca7be.webp', NULL, NULL, NULL, 'tr', 44, 1, 0, '2022-12-16 13:28:07', '2022-12-16 13:28:07'),
(52, 6, 'a142d1572a4379cf4175606e33553231.webp', NULL, NULL, NULL, 'tr', 45, 1, 0, '2022-12-16 13:28:08', '2022-12-16 13:28:08'),
(53, 6, 'e11b4fe51f3bf2b1619ad53d69d21d14.webp', NULL, NULL, NULL, 'tr', 46, 1, 0, '2022-12-16 13:28:09', '2022-12-16 13:28:09'),
(54, 6, 'ddc4ca277b2d4515d9e05224249f4d27.webp', NULL, NULL, NULL, 'tr', 47, 1, 0, '2022-12-16 13:28:10', '2022-12-16 13:28:10'),
(55, 6, 'c9afa30458e30b06fa2323d3c3aa6382.webp', NULL, NULL, NULL, 'tr', 48, 1, 0, '2022-12-16 13:28:11', '2022-12-16 13:28:11'),
(56, 6, 'd4b26777e7681dc0504c833460613aa5.webp', NULL, NULL, NULL, 'tr', 49, 1, 0, '2022-12-16 13:28:13', '2022-12-16 13:28:13'),
(57, 6, 'fce217f61ac0d33a7a0eb077d027e0b9.webp', NULL, NULL, NULL, 'tr', 50, 1, 1, '2022-12-16 13:28:14', '2022-12-16 13:28:27'),
(58, 6, 'edd3d8b2905dfa56247bbc7af38f4a76.webp', NULL, NULL, NULL, 'tr', 51, 1, 0, '2022-12-16 13:28:14', '2022-12-16 13:28:14'),
(59, 6, 'd8847db09665a385d61c600561d2db15.webp', NULL, NULL, NULL, 'tr', 52, 1, 0, '2022-12-16 13:28:15', '2022-12-16 13:28:15'),
(60, 6, '471b41444e90aa7abb623260b7d4c93f.webp', NULL, NULL, NULL, 'tr', 53, 1, 0, '2022-12-16 13:28:16', '2022-12-16 13:28:16'),
(61, 6, 'c8ee5f52e127777ea2f16f940014ea4a.webp', NULL, NULL, NULL, 'tr', 54, 1, 0, '2022-12-16 13:28:17', '2022-12-16 13:28:17'),
(62, 6, '6c1f0025d3aa3a38e61e7d6bd5069701.webp', NULL, NULL, NULL, 'tr', 55, 1, 0, '2022-12-16 13:28:18', '2022-12-16 13:28:18'),
(63, 6, '52af70fae1d3233249f83c280d135fe7.webp', NULL, NULL, NULL, 'tr', 56, 1, 0, '2022-12-16 13:28:19', '2022-12-16 13:28:19'),
(64, 6, '66fb67d3e963db0b2af30fd08f5e6f76.webp', NULL, NULL, NULL, 'tr', 57, 1, 0, '2022-12-16 13:28:20', '2022-12-16 13:28:20'),
(65, 7, '3c627d82ab376f65069a9b09d38b0213.webp', NULL, NULL, NULL, 'tr', 58, 1, 0, '2022-12-16 13:47:25', '2022-12-16 13:47:25'),
(66, 7, '41d5907186296138774bfff1c8ca0688.webp', NULL, NULL, NULL, 'tr', 59, 1, 0, '2022-12-16 13:47:26', '2022-12-16 13:47:26'),
(67, 7, 'e684a92f32afce7807fdfc129b16c4fc.webp', NULL, NULL, NULL, 'tr', 60, 1, 0, '2022-12-16 13:47:27', '2022-12-16 13:47:27'),
(68, 7, '557d06641771b1af5994bdbacaa8de1d.webp', NULL, NULL, NULL, 'tr', 61, 1, 0, '2022-12-16 13:47:28', '2022-12-16 13:47:28'),
(69, 7, '374289d12547ece4639c6e0b415d6663.webp', NULL, NULL, NULL, 'tr', 62, 1, 0, '2022-12-16 13:47:29', '2022-12-16 13:47:29'),
(70, 7, 'b499ecdf470334c80528bc1827144562.webp', NULL, NULL, NULL, 'tr', 63, 1, 0, '2022-12-16 13:47:30', '2022-12-16 13:47:30'),
(71, 7, 'b23f5810dc2135f6f002d162ce299e17.webp', NULL, NULL, NULL, 'tr', 64, 1, 0, '2022-12-16 13:47:31', '2022-12-16 13:47:31'),
(72, 7, '359545112760e36d83dc1068d637c334.webp', NULL, NULL, NULL, 'tr', 65, 1, 0, '2022-12-16 13:47:32', '2022-12-16 13:47:32'),
(73, 7, 'b3fb22bbf96e9ba11e3916ec28e45d4a.webp', NULL, NULL, NULL, 'tr', 66, 1, 0, '2022-12-16 13:47:33', '2022-12-16 13:47:33'),
(74, 7, '4f8cf283495172ce9a80c6ce62264259.webp', NULL, NULL, NULL, 'tr', 67, 1, 0, '2022-12-16 13:47:34', '2022-12-16 13:47:34'),
(75, 7, '22e6a2cd41ecdda811d5895724b5cdf6.webp', NULL, NULL, NULL, 'tr', 68, 1, 0, '2022-12-16 13:47:35', '2022-12-16 13:47:35'),
(76, 7, '610e8970271979596422429c5aa64bcc.webp', NULL, NULL, NULL, 'tr', 69, 1, 1, '2022-12-16 13:47:36', '2022-12-16 13:47:46'),
(77, 8, 'a8668e843ccaaac0ff6dd640b0a1bdfa.webp', NULL, NULL, NULL, 'tr', 70, 1, 0, '2022-12-16 14:13:44', '2022-12-16 14:13:44'),
(78, 8, '174c5fd4da3ac88a5a384e9f352920ff.webp', NULL, NULL, NULL, 'tr', 71, 1, 0, '2022-12-16 14:13:45', '2022-12-16 14:13:45'),
(79, 8, '823bf310ad7c79037993254c6dffdfcb.webp', NULL, NULL, NULL, 'tr', 72, 1, 0, '2022-12-16 14:13:45', '2022-12-16 14:13:45'),
(80, 8, 'd69f9bd9d1f64fd48ee70a8208c367d4.webp', NULL, NULL, NULL, 'tr', 73, 1, 1, '2022-12-16 14:13:46', '2022-12-16 14:13:58'),
(81, 8, 'f2886190fc0bb58ba40a1c69303073f7.webp', NULL, NULL, NULL, 'tr', 74, 1, 0, '2022-12-16 14:13:47', '2022-12-16 14:13:47'),
(82, 8, '3d7c3c092b4555040f5103933aa7af32.webp', NULL, NULL, NULL, 'tr', 75, 1, 0, '2022-12-16 14:13:48', '2022-12-16 14:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `banner_url` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `seo_url` longtext DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `title`, `img_url`, `banner_url`, `content`, `category_id`, `lang`, `rank`, `isActive`, `seo_url`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(1, 'Enerji', '59baf22e430db19892932e1382953fcc.webp', '03e743a5b64113aaf234dd9c1b90e8a4.webp', '', 1, 'tr', 1, 1, 'enerji', '2022-03-01 14:12:33', '2022-12-14 13:20:25', '2022-03-01 14:10:47'),
(2, 'Güneş Enerjisi', 'f6a0b01b3416c0eb8130ce0a5195f582.webp', 'e7d55da9910010c75044174349356552.webp', '', 1, 'tr', 2, 1, 'gunes-enerjisi', '2022-03-01 14:12:33', '2022-12-14 13:11:52', '2022-03-01 14:10:47'),
(3, 'Yapısal Çelik', '8a43f8e3b28cebb8ccb3ccd3ca65a05c.webp', '640eaacb262905059b28f7522be6cf55.webp', '', 1, 'tr', 3, 1, 'yapisal-celik', '2022-03-01 14:12:33', '2022-12-14 13:14:11', '2022-03-01 14:10:47'),
(4, 'Yapı ve Konstrüksiyon', '802b0a7aef45c2b4be3e2b056a4edf46.webp', '9c8877d4f518780ef04d17d98147eacc.webp', '', 1, 'tr', 4, 1, 'yapi-ve-konstruksiyon', '2022-03-04 08:41:03', '2022-12-14 13:16:38', '2022-03-04 08:38:47'),
(5, 'Maden ve Tünel', '76384018066692e7b627a0c720c22d06.webp', 'cbda240db1d50bdcfa863770b8e07b91.webp', '', 1, 'tr', 5, 1, 'maden-ve-tunel', '2022-03-04 08:44:36', '2022-12-14 13:18:44', '2022-03-04 08:42:57'),
(6, 'Gemi İnşa', 'd7a5dad974454b9769502bf40078525d.webp', '1cd8feda1cf5354b1cfdc906da5c55be.webp', '', 1, 'tr', 6, 1, 'gemi-insa', '2022-03-04 09:28:17', '2022-12-14 13:27:11', '2022-03-04 09:23:38'),
(7, 'Makine İmalat', '5832c1aca4f7d2a6559b6b5da9bf3487.webp', 'e1b065d4515b89ff93f572d8a0815e57.webp', '', 1, 'tr', 7, 1, 'makine-imalat', '2022-11-18 12:59:24', '2022-12-14 13:31:52', '2022-11-18 12:59:13'),
(8, 'Tarım', 'f4b6281cc6a86ed860a7c4bf09a39547.webp', 'b1435eb87ef8b3825169bff1a5020722.webp', '', 1, 'tr', 8, 1, 'tarim', '2022-11-18 12:59:38', '2022-12-14 13:32:00', '2022-11-18 12:59:26'),
(9, 'Ulaşım', '6c98d156191cb5b07e5352eadbcbca94.webp', '6d6ac46f575c825745d6c37e88ddc8c0.webp', '', 1, 'tr', 9, 1, 'ulasim', '2022-11-18 12:59:49', '2022-12-14 13:35:34', '2022-11-18 12:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `sector_categories`
--

CREATE TABLE `sector_categories` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `seo_url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sector_categories`
--

INSERT INTO `sector_categories` (`id`, `title`, `seo_url`, `img_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`) VALUES
(1, 'Değer ve Fark Yarattığımız Sektörler', 'deger-ve-fark-yarattigimiz-sektorler', NULL, 'tr', 1, 1, '2022-03-01 14:10:43', '2022-11-18 12:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `banner_url` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `seo_url` longtext DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `img_url`, `banner_url`, `content`, `category_id`, `lang`, `rank`, `isActive`, `seo_url`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(1, 'Uçak Bakımı', '890b4aae8e23ccdc1af149167e199be4.webp', '09f1ea08631926a3266bd8dd21ea9c07.webp', '<p>Havacılık, günümüzde sivil taşımacılık, lojistik ve askeri alanlarda oldukça önemli bir sektör olmakla birlikte sürekli gelişim göstermektedir. Sektörde yaşanan bu gelişim sayesinde havacılık alanında çalışan kişilere duyulan ihtiyaç artmaktadır.</p>\r\n<p>Özel İzmir Pancar OSB Mesleki ve Teknik Anadolu Lisesi Uçak Bakım alanında eğitim alan öğrencilerimiz Uçak Elektroniği Ve Uçak Gövde Motor dallarında, uçak teknisyenliği, uçuş emniyeti ve sivil havacılık kanunları konularına eğitim almaktadırlar.</p>\r\n<hr class=\"my-5\" />\r\n<h3>Uçak Bakımı Bölümünden Mezun Olanlar</h3>\r\n<p>Bu alandan mezun olanlar uçak gövde-motor teknisyeni veya uçak elektroniği alanlarında kariyer yapma şansı elde ederler. Sivil havacılık yönetmeliklerine uygun bir şekilde uçakların mekanik ve elektronik kontrollerinin yapılmasını kapsayan bu meslekler, günümüzün popüler meslekleri arasında yer almaktadır.</p>\r\n<p>Alan mezunu öğrencilerimiz dilerlerse Milli Savunma Üniversitesinin sınavlarına girerek askeri havacılık alanında ilerleyip astsubaylık veya subaylık eğitimleri alabilir, dilerlerse de sadece üniversite sınavlarına girerek bölümlerine uygun Meslek Yüksek Okulları için (iki yıllık) ek puan avantajından ya da Fakülteler için(dört yıllık) M.T.O.K (mesleki ve teknik ortaöğretim kurumları kontenjanı)kontenjanından yararlanarak üniversite eğitimlerine devam edebilirler.</p>', 1, 'tr', 1, 1, 'ucak-bakimi', '2022-03-01 14:12:33', '2022-03-04 13:59:39', '2022-03-01 14:10:47'),
(2, 'Biyomedikal Cihaz Teknolojileri', '8d0174a86ca81bab5b28a0044b213a19.webp', '2568f748cf53ff89049cdd95dabcccbc.webp', '<p>Teknoloji ile birlikte en hızlı gelişen alanlardan birisi de tıp ve tüm dünyanın bu alanda elde edilecek gelişmelere gerçekten ihtiyacı var. Tıbbi teknolojilerin gelişmesi insanların ortalama yaşam ömrünü uzatmanın yanı sıra yaşam kalitesini de olumlu bir şekilde etkiliyor. İnsan yaşamının değerinin her zaman farkında olduğumuz gerçeğini unutmasak bile gelişen teknolojiler sayesinde değeri sorgulanamayan hayatları kurtarmak ve rahatlatmak mümkün oluyor.</p>\r\n<p>Özel İzmir Pancar OSB Mesleki ve Teknik Anadolu Lisesi Biyomedikal Cihaz Teknolojileri alanında eğitim alan öğrenciler tıbbi görüntüleme ve medikal cihazlarının montaj, kurulum, bakım, onarım ve kalibrasyon gereksinimlerini karşılayabilecek nitelikte eğitim almaktadırlar.</p>\r\n<h3>Biyomedikal Cihaz Teknolojileri Bölümünden Mezun Olanlar</h3>\r\n<p>Alan mezunu olan öğrencilerimiz dilerlerse eğitimlerini tamamladıktan sonra “İş Yeri Açma Belgeleri” ile meslek hayatlarına başlayabilir, dilerlerse de üniversite sınavlarına girerek bölümlerine uygun Meslek Yüksek Okulları için (iki yıllık) ek puan avantajından ya da Fakülteler için(dört yıllık) M.T.O.K (mesleki ve teknik ortaöğretim kurumları kontenjanı)kontenjanından yararlanarak üniversite eğitimlerine devam edebilirler.</p>', 1, 'tr', 2, 1, 'biyomedikal-cihaz-teknolojileri', '2022-03-01 14:12:33', '2022-03-04 13:57:13', '2022-03-01 14:10:47'),
(3, 'Endüstriyel Otomasyon Teknolojileri', '060e86b19aa4dbe063c0bc24fad730ad.webp', '995c00498743225fae451c804f8578ef.webp', '<p>Endüstriyel Otomasyon; endüstride otomatik üretim yapan makinelerin bakımı - onarımı, programlanması ve temel olarak imalatı, otomasyon sistemlerinin ağ yapılarını kullanarak üretimin ölçüp izlenerek denetlenmesi için donanım ve yazılım işlemleri ile ilgili yeterlikleri kazandırmaya yönelik eğitim ve öğretim verilen alandır.</p>\r\n<p>Günümüzde endüstriyel üretimin daha hızlı ve kaliteli yapabilmesi için insan gücünün yerini robotik sistemler almıştır. Endüstriyel otomasyon alanında ise, robot teknolojisi yaygın şekilde kullanılmaktadır. Günümüzde teknolojinin bir zorunluluğu olmuştur.</p>\r\n<p>Ürün tasarımı, sistem dinamiği ve akıllı kontrol, üretim süreçlerinin gözlenmesi, modellenmesi ve kontrolü, kuvvet elektroniği, mikrosistem tasarımı ve uygulamaları, endüstriyel kontrol tasarımı, algılayıcılar ve robot sistemleri, görüntü işleme, sistemler arası iletişim ağları, yapay zekâ ve sanal gerçeklik gibi konuları içermesi nedeni ile savunma sanayii, otomotiv ve tekstil sektörleri için önemli meslek dallarının başında gelir.</p>\r\n<p>Özel İzmir Pancar OSB Mesleki ve Teknik Anadolu Lisesi Endüstriyel Otomasyon Teknolojileri Alanında eğitim alan öğrencilerimiz elektronik devreler ve robotik sistemler tasarlamak, endüstriyel tasarımlar yapmak, programlanabilir kontrol sistemleri kurmak, otomasyon sistemlerine bakım yapmak ya da bu sistemlerini arızalarını gidermek gibi pek çok sayıda farklı alanda eğitim görmektedirler.</p>\r\n<h3>Endüstriyel Otomasyon Teknolojileri Bölümünden Mezun Olanlar</h3>\r\n<p>Alan mezunu olan öğrenciler mezuniyetleri ile birlikte “İş Yeri Açma Belgeleri” ile meslek hayatlarına başlayabilir, dilerlerse de üniversite sınavlarına girerek bölümlerine uygun Meslek Yüksek Okulları için (iki yıllık) ek puan avantajından ya da Fakülteler için(dört yıllık) M.T.O.K (mesleki ve teknik ortaöğretim kurumları kontenjanı)kontenjanından yararlanarak üniversite eğitimlerine devam edebilirler.</p>', 1, 'tr', 3, 1, 'endustriyel-otomasyon-teknolojileri', '2022-03-01 14:12:33', '2022-03-04 13:58:09', '2022-03-01 14:10:47'),
(4, 'Makine Teknolojisi', '0437b5e85d38cd4c2ae89b859fdafe6d.webp', '2bcb57e9ade2414d45df6b54f0cd130b.webp', '<h3>Makine Teknolojisi Bölümü</h3>\r\n<h4>Bilgisayar Destekli Makine Ressamlığı Dalı</h4>\r\n<p>Makine ve Tasarım Teknolojisi alanı ekonomik kalkınmanın temelini oluşturur. Tasarım ve üretim yapan her sektöre hitap eder. Gelişen teknoloji ve üretim teknikleri tasarım ve üretimde makinenin önemini artırmıştır. Getirisi ve katma değeri ile insanların hayatını kolaylaştıran, yaşam kalitesini yükselten en önemli unsurlardan biridir.</p>\r\n<p>Makine ve Tasarım Teknolojisi alanı ekonomik kalkınmanın temelidir. Alan, ülkemizde ve dünyada hızla ilerlemektedir, getirisi ve katma değeri de ekonominin lokomotifi durumundadır. Alanda istihdam imkânları oldukça çeşitlidir.</p>\r\n<p>Özel İzmir Pancar OSB Mesleki ve Teknik Anadolu Lisesi Makine ve Tasarım Teknolojileri Alanında eğitim alan öğrencilerimiz; gelecekte yeni makine tasarımları yapma, mevcut bir tasarımı analiz edebilme ve yapılan tasarımı üretime geçirebilme niteliklerine uygun eğitim görmektedirler.</p>\r\n<h3>Bilgisayar Destekli Makine Ressamlığı Dalından Mezun Olanlar</h3>\r\n<p>Makine ve Tasarım Teknolojisi alanı Bilgisayar Destekli Makine Ressamlığı dalından mezun olan öğrenciler makine üretimi yapan fabrikalarda, atölyelerde, AR-GE tesislerinde ve modelleme şirketlerinde iş bulabiliyorlar. Ortaöğretimi tamamlayan öğrenciler dilerlerse “İş Yeri Açma Belgeleri” ile meslek hayatlarına başlayabilir, dilerlerse de üniversite sınavlarına girerek bölümlerine uygun Meslek Yüksek Okulları için (iki yıllık) ek puan avantajından ya da Fakülteler için(dört yıllık) M.T.O.K (mesleki ve teknik ortaöğretim kurumları kontenjanı)kontenjanından yararlanarak üniversite eğitimlerine devam edebilirler.</p>', 1, 'tr', 4, 1, 'makine-teknolojisi', '2022-03-04 08:41:03', '2022-03-04 13:58:27', '2022-03-04 08:38:47'),
(5, 'Yenilenebilir Enerji Teknolojileri', '20b62b25ec9e049ebe685898cfbe9409.webp', 'c81d89e1ab2a4455fa8ddf13988454ab.webp', '<p>Yenilenebilir enerji teknolojileri; rüzgâr ve güneş enerjisinden elektrik üreten küçük ve büyük çaplı santrallerin kurulumu, işletilmesi, bakımı, onarımı ve arızalarının giderilmesi ile ilgili yeterlikleri kazandırmaya yönelik eğitim ve öğretim verilen alandır.</p>\r\n<p>Gücünü güneşten alan, hiç tükenmeyeceği düşünülen ve çevreye zarar vermeyen enerji kaynakları yenilenebilir enerji kaynaklarıdır. Bu kaynaklar güneş ışığı, rüzgâr, akan su (hidrogüç), biyolojik süreçler ve jeotermal olarak sıralanabilir. Yenilenebilir enerji, yeşil enerjidir. Güneş ve rüzgâr yenilenebilir enerji kaynağıdır. Bu teknolojiler ile günümüzde en çok ihtiyaç duyulan elektrik enerjisi üretilmektedir.</p>\r\n<p>Türkiye\'de bu sektör hızla gelişmekte ve bu alanda ciddi miktarda kaliteli elemana ihtiyaç duyulmaktadır.</p>\r\n<p>Özel İzmir Pancar OSB Mesleki ve Teknik Anadolu Lisesi Yenilenebilir Enerji Teknolojileri alanından mezun olan öğrenciler dilerlerse aldıkları diploma ve “İş Yeri Açma Belgesi” ile iş hayatına başlayabiliyor ya da kariyerlerini farklı alanlarda ilerletmek için eğitimlerine devam edebiliyorlar.</p>\r\n<h3>Yenilenebilir Enerji Teknolojileri<br />Bölümünden Mezun Olanlar</h3>\r\n<p>Yenilenebilir Enerji Teknolojileri alanından mezun olan öğrencilerimiz dilerlerse güneş veya rüzgar enerjisi sistemlerine odaklanan firmalarda, yenilenebilir enerji ile elektrik üreten santrallerde ve bu alanda yapılan AR-GE çalışmaları kapsamında iş bulabiliyorken dilerlerse de üniversite sınavlarına girerek bölümlerine uygun Meslek Yüksek Okulları için (iki yıllık) ek puan avantajından ya da Fakülteler için(dört yıllık) M.T.O.K (mesleki ve teknik ortaöğretim kurumları kontenjanı)kontenjanından yararlanarak üniversite eğitimlerine devam edebilirler.</p>', 1, 'tr', 5, 1, 'yenilenebilir-enerji-teknolojileri', '2022-03-04 08:44:36', '2022-04-04 08:48:37', '2022-03-04 08:42:57'),
(6, 'Akademik Birimler', '7aa0e7c7df534cd463c4982eafdd1659.webp', '86946678aa5bfa50e0afe80bcefc4db6.webp', '<h3>İngilizce</h3>\r\n<p>İzmir Pancar O.S.B. Mesleki ve Teknik Anadolu Lisesi’nde İngilizce artık yabancı dil olmaktan çıkıyor, ikinci ana dil oluyor. Özenle tasarlanmış dersliklerde yabancı öğretmenler (native speaker) ile uygulamalı işlenen derslerde öğrencilerimiz kendilerini yurt dışında gibi hissetmeleri sağlanır. Üst düzey kaliteye sahip dersliklerimizde öğrencilerimizin, yabancı dili anadili gibi konuşması sağlanır. İPOSB MTAL öğrencilerin FastForWord ve Reading Assisant programları ile anadil öğrenir gibi sesleri duyarak, Z Kuşağının vazgeçilmezi teknoloji ve eğlenceyi dersler içerisinde kullanarak yabancı dil öğrenmeleri sağlanmaktadır.</p>\r\n<hr />\r\n<h3>Almanca</h3>\r\n<p>İzmir Pancar O.S.B. Mesleki ve Teknik Anadolu Lisesi eğitim programında teknoloji, sanayi ve makine alanlarında oldukça önemli bir dil olan Almanca bulunuyor. Teknoloji ve sanayi alanında önemli bir yere sahip olan Almanya’nın makine, yenilenebilir enerji, endüstriyel otomasyon, havacılık ve biyomedikal cihaz teknolojileri alanında yaptığı atılımlar bu alanlarda kariyer yapmak isteyenler için hem yol gösterici hem de ilham verici olma özelliği taşıyor. Alanlarda bu kadar önemli bir etkisi olan ülkenin ana dili de söz konusu alanlarda kariyer yapmak ve kendini geliştirmek isteyen öğrenciler için vazgeçilmez oluyor. Biz de Özel Pancar O.S.B. Mesleki ve Teknik Anadolu Lisesi olarak öğrencilerimizin dünyanın ortak dili İngilizceyi öğrenmelerinin yanı sıra alanlarında oldukça büyük öneme sahip olan Almancayı da öğrenmeleri için eğitim programımızda bu dile de yer veriyoruz.</p>\r\n<hr />\r\n<h3>Matematik</h3>\r\n<p>İPOSB MTAL\'de uygulanan matematik yöntemi; oluşturacağımız sınıf ve materyallerle öğrencilerin problem çözmelerini ve temel matematik kavramlarını öğrenmelerine önem veren, matematiksel düşünmeyi merkeze alan bir sistemdir. Matematik korkusunu ortadan kaldırır.</p>\r\n<hr />\r\n<h3>Fen Bilimleri</h3>\r\n<p>Bilimsel yöntem ve deneysel öğretim üzerinde durulur, bilgi yoluyla eleştirel ve sistemli düşünce becerileri geliştirilir, öğrencilerin çok geniş bir yelpazedeki kavramları açıklamaları ve uygulamaları sağlanır.</p>\r\n<hr />\r\n<h3>Türk Dili ve Edebiyatı</h3>\r\n<p>Öğrencilerimizin ana dillerinde en yetkin düzeye ulaşmalarını amaçlamaktadır. Bölüm olarak öğrencilerimizin hem Türk edebiyatını hem de dünya edebiyatını en üst düzeyde tanımalarını ve her iki düzlemde üretilmiş eserlerin en seçkinlerini seviyelerine göre okuyup içselleştirmelerini beklemekteyiz. Bu bağlamda hazırlık sınıfından başlayarak 12. Sınıf sonuna değin her öğrencimiz her dönemde Türk ve dünya edebiyatından en az dört eseri okumakta ve bu eserleri ayrıntılı bir biçimde inceleme fırsatı bulabilmektedir.</p>\r\n<p>Alanında uzman eğitimcilerimiz ile öğrencilerimizin, Türk edebiyatını incelemeleri ve sevmelerini sağlayacak imkan ve programlama yapılmaktadır.</p>\r\n<hr />\r\n<h3>Sosyal Bilimler</h3>\r\n<p>Alanlarında uzman eğitimcilerimiz sosyal bilimler alanındaki dersleri öğrencilerimize uygulanan yöntem ve testlerle ilgi ve isteklerine göre planlanarak uygulaması sağlanır.</p>\r\n<hr />\r\n<h3>Bilgisayar Bilimleri</h3>\r\n<p>Bilişim Teknolojileri günümüzde Z Kuşağı dediğimiz sürekli bilgisayar ile içe içe olan çocuklarımızın derslerini sıkıcılıktan uzak bir araç olarak, müfredat programlarını, bilgisayar desteği ile zevkli ve kolay öğrenmeleri sağlanmaktadır.</p>\r\n<hr />\r\n<h3>Beden Eğitimi</h3>\r\n<p>Öğrencilerimizin kabiliyetleri doğrultusunda yapabilecekleri sportif faaliyetler belirlenerek okul kampüsümüzde var olan futbol ve basketbol sahalarından v.b yararlanmaları sağlanmaktadır.</p>\r\n<hr />\r\n<h3>Sanat ve Müzik</h3>\r\n<p>Öğretmenlerimiz, öğrencilerle yakından ilgilenerek, çalışmalarında öğrencilerin estetik, zihinsel ve teknik becerilerini geliştirmeleri sağlanır. Sanat programı çerçevesinde müzik, görsel sanatlar, iletişim ve atölye çalışmaları dengeli bir dağılımla, içerik ve mekân açısından çeşitlilik gösteren şekilde sunulur.</p>\r\n<hr />\r\n<h3>Rehberlik</h3>\r\n<p>Rehberlik bölümü bir koordinatör, psikologlar ve rehber öğretmenlerden oluşur.</p>', 1, 'tr', 6, 1, 'akademik-birimler', '2022-03-04 09:28:17', '2022-04-22 11:12:35', '2022-03-04 09:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `seo_url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `title`, `seo_url`, `img_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`) VALUES
(1, 'Akademik', 'akademik', NULL, 'tr', 1, 1, '2022-03-01 14:10:43', '2022-03-01 14:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `mission` longtext DEFAULT NULL,
  `vision` longtext DEFAULT NULL,
  `motto` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `address_title` longtext DEFAULT NULL,
  `map` longtext DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `mobile_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `mobile_logo_2` varchar(255) DEFAULT NULL,
  `blog_logo` varchar(255) DEFAULT NULL,
  `about_logo` varchar(255) DEFAULT NULL,
  `gallery_logo` varchar(255) DEFAULT NULL,
  `contact_logo` varchar(255) DEFAULT NULL,
  `product_logo` varchar(255) DEFAULT NULL,
  `product_detail_logo` varchar(255) DEFAULT NULL,
  `technical_information_logo` varchar(255) DEFAULT NULL,
  `technical_information_detail_logo` varchar(255) DEFAULT NULL,
  `service_logo` longtext DEFAULT NULL,
  `sector_logo` varchar(255) DEFAULT NULL,
  `phone` longtext DEFAULT NULL,
  `fax` longtext DEFAULT NULL,
  `whatsapp` longtext DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `medium` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `analytics` longtext DEFAULT NULL,
  `metrica` longtext DEFAULT NULL,
  `live_support` longtext DEFAULT NULL,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isActive` tinyint(1) DEFAULT 1,
  `lang` char(2) DEFAULT 'tr',
  `shippingMinPrice` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `slogan`, `mission`, `vision`, `motto`, `address`, `address_title`, `map`, `logo`, `mobile_logo`, `favicon`, `mobile_logo_2`, `blog_logo`, `about_logo`, `gallery_logo`, `contact_logo`, `product_logo`, `product_detail_logo`, `technical_information_logo`, `technical_information_detail_logo`, `service_logo`, `sector_logo`, `phone`, `fax`, `whatsapp`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `medium`, `pinterest`, `meta_keywords`, `meta_description`, `analytics`, `metrica`, `live_support`, `rank`, `createdAt`, `updatedAt`, `isActive`, `lang`, `shippingMinPrice`) VALUES
(1, 'Excellence Halı', 'YALÇINKAYA HALICILIK MOBİLYA TİC. VE SAN. LTD. ŞTİ.', '																				Kalite odaklı, sürekli yenilik ve farklılık yaratarak müşteri memnuniyetine duyarlı teknolojik gelişmelere açık her zaman ve en güzel ürünü en hesaplı fiyatla ulaştırmayı kendimize bir görev olarak görüyoruz. Sosyal sorumluluk sahibi olarak çevremize faydalı ürünler ve hizmetler vermeyi ilke ediniyoruz.															', '																				Sektörde yenilikleri ve trendleri güncel olarak takip eden ve sektörün önde gelen markalarını en iyi ve kusursuz hizmet anlayışıyla iş ortaklarımıza temin ve tedarik etmektir.															', '												<ul>\r\n<li>Her zaman açık ve dürüst olmak.</li>\r\n<li>Müşteri odaklı düşünmek ve davranmak.</li>\r\n<li>Bilgi, teknolojik ve yenilik yanlısı olmak</li>\r\n<li>Girişken olmak ve özverili olmak.</li>\r\n<li>Kaynakları etkin kullanmak.</li>\r\n<li>İnsana değer vermek.</li>\r\n<li>Çevreye ve topluma karşı sorumlulukları bilmek.</li>\r\n<li>Yenilikçi olmak</li>\r\n</ul>									', '[\"Osmangazi, Yavuz Cd. No:252, 35535 Bayrakl\\u0131\\/\\u0130zmir\"]', '[\"\\u0130zmir Ofis\"]', '[\"&lt;iframe src=&quot;https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3123.5501584688477!2d27.18405071559186!3d38.47494537933882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b97d42d90d5cb5%3A0x9d89bc5f3a54f920!2sOsmangazi%2C%20Yavuz%20Cd.%20No%3A252%2C%2035535%20Bayrakl%C4%B1%2F%C4%B0zmir!5e0!3m2!1sen!2str!4v1672644754902!5m2!1sen!2str&quot; width=&quot;600&quot; height=&quot;450&quot; style=&quot;border:0;&quot; allowfullscreen=&quot;&quot; loading=&quot;lazy&quot; referrerpolicy=&quot;no-referrer-when-downgrade&quot;&gt;&lt;\\/iframe&gt;\"]', 'e9f5e859e128736933cbbeadedcbbf47.webp', 'e1e4e83409f19cb02f1fb0cd20ef058a.webp', '91ed6fc25cb38c2de63a0ddaf8dcc72e.webp', 'baa5718ba664c6e84eca7af753904742.webp', '405089704aa9cd40ffc8b11b38a02958.webp', '8292b596145cf734cbe7ea80c1c7b5d4.webp', '3ec2fbc7151fbc19a1ee18ca7df94a43.webp', 'cbd5c3850ed221363e6a0991552ce477.webp', '472cc1c9079604e452fb5c2dae3853dc.webp', '52be06b3ad761b6508254b53aa89535a.webp', 'b0b03755b700ed32b8d8e1fa1cef8484.webp', 'c22e50caac3c393baeaf5b7287c7a77e.webp', '763d588ba49ea081c6873f6007262977.webp', '9ad37733dd839901223ffbf58a7c012b.webp', '[\"+90 555 804 2525\"]', '[\"\"]', '[\"+90 507 992 72 07\"]', 'info@excellencehali.com', 'https://www.facebook.com/excellencecarpet', NULL, 'https://www.instagram.com/excellencecarpet/', 'https://www.linkedin.com/company/yalcinkaya-halicilik/', NULL, NULL, NULL, NULL, 'Excellence Halı markasının online alışveriş sitesi olan excellencehalishop.com\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&#039;dan tüm halı ihtiyaçlarınızı eksiksiz bir şekilde karşılayabilirsiniz. Hemen Excellence Koleksiyonlarını keşfedin. Kalite, şıklık ve modernl', '', '', '', 1, '2020-07-22 20:57:22', '2023-01-02 13:11:39', 1, 'tr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `allowButton` tinyint(4) DEFAULT 0,
  `button_url` longtext DEFAULT NULL,
  `target` enum('_self','_blank','_top','_parent') DEFAULT '_self',
  `button_caption` longtext DEFAULT NULL,
  `video_url` longtext DEFAULT NULL,
  `video_caption` longtext DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `description`, `img_url`, `allowButton`, `button_url`, `target`, `button_caption`, `video_url`, `video_caption`, `page_id`, `category_id`, `product_id`, `service_id`, `sector_id`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(1, 'Kariyer Planı', 'Teknik ile Bilimin Buluştuğu Yerde,<br />Geleceği Parlak Nesiller Yetiştiriyoruz.', 'bde9cb013bc09ab033783bd37b4c609c.webp', 0, NULL, '_self', 'Kariyerini planlamak için tıkla', 'https://www.youtube.com/watch?v=6WZoYIYCNQQ', 'Tanıtımı İzle', NULL, NULL, NULL, NULL, NULL, 'tr', 1, 1, '2022-01-03 11:00:17', '2022-12-15 11:05:00', '2022-01-03 10:59:49'),
(2, 'Ön Kayıt', 'Eğitimde Fırsat Eşitliğine İnanıyor,<br />Tüm Öğrencilerimiz İçin Yüksek Standartlar Oluşturuyoruz.', '443b252150084f75ea7373c894c6fc16.webp', 0, NULL, '_self', 'Ön Kayıt İçin Tıkla', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tr', 2, 1, '2022-01-14 11:27:30', '2022-12-15 11:03:22', '2022-01-14 11:26:43'),
(3, 'Okul Tanıtımı', '12 Haziran 2021 tarihinden itibaren her cumartesi 11:00 ve 13:00 saatlerinde bölüm öğretmenlerimizin bilgilendirmeleri öğrencilerimizin atölye sunumlarıyla sizlere okulumuzu en iyi şekilde tanıtmak için bekliyor olacağız.', '3fea5c418f5fc4043e98d7927db79ca6.webp', 0, NULL, '_self', 'Yemek Odalarını İncele', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tr', 3, 1, '2022-01-14 11:31:34', '2022-12-15 10:56:50', '2022-01-14 11:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `technical_informations`
--

CREATE TABLE `technical_informations` (
  `id` int(11) NOT NULL,
  `top_id` int(11) NOT NULL DEFAULT 0,
  `url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `features` longtext DEFAULT NULL,
  `lang` char(2) NOT NULL DEFAULT 'tr',
  `rank` bigint(20) NOT NULL DEFAULT 1,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technical_informations`
--

INSERT INTO `technical_informations` (`id`, `top_id`, `url`, `title`, `content`, `description`, `features`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(1, 0, 'alasim-elementlerinin-celiklerin-ozelliklerine-etkileri', 'ALAŞIM ELEMENTLERİNİN ÇELİKLERİN ÖZELLİKLERİNE ETKİLERİ', '', '', '', 'tr', 1, 1, '2022-11-14 14:47:48', '2022-11-22 05:57:28', '2022-11-14 14:47:18'),
(2, 0, 'standart-karsilastirma-tablosu', 'STANDART KARŞILAŞTIRMA TABLOSU', '', '', '', 'tr', 1, 1, '2022-11-14 14:47:48', '2022-11-22 05:57:38', '2022-11-14 14:47:18'),
(3, 0, 'genel-yapi-celikleri-mekanik-ozellikleri', 'GENEL YAPI ÇELİKLERİ MEKANİK ÖZELLİKLERİ', '', '', '', 'tr', 3, 1, '2022-11-22 05:57:53', '2022-11-22 05:57:53', '2022-11-22 05:57:40'),
(4, 0, 'cekme-dayanimina-gore-ifade-edilen-genel-yapi-celikleri', 'ÇEKME DAYANIMINA GÖRE İFADE EDİLEN GENEL YAPI ÇELİKLERİ', '', '', '', 'tr', 4, 1, '2022-11-22 05:58:13', '2022-11-22 05:58:13', '2022-11-22 05:57:56'),
(5, 0, 'genel-yapi-celikleri-ve-bilesimleri', 'GENEL YAPI ÇELİKLERİ VE BİLEŞİMLERİ', '', '', '', 'tr', 5, 1, '2022-11-22 05:58:39', '2022-11-22 05:58:39', '2022-11-22 05:58:26'),
(6, 0, 'non-alloy-chemical-composition', 'NON-ALLOY CHEMICAL COMPOSITION', '', '', '', 'tr', 6, 1, '2022-11-22 05:58:52', '2022-11-22 05:58:52', '2022-11-22 05:58:41'),
(7, 0, 'non-alloy-mechanical-properties', 'NON-ALLOY MECHANICAL PROPERTIES', '', '', '', 'tr', 7, 1, '2022-11-22 05:59:06', '2022-11-22 05:59:06', '2022-11-22 05:58:54'),
(8, 0, 'gost-steel-norms', 'GOST STEEL NORMS', '', '', '', 'tr', 8, 1, '2022-11-22 05:59:14', '2022-11-22 05:59:14', '2022-11-22 05:59:08'),
(9, 0, 'inch-donusum-tablosu', 'INCH DÖNÜŞÜM TABLOSU', '', '', '', 'tr', 9, 1, '2022-11-22 05:59:29', '2022-11-22 05:59:29', '2022-11-22 05:59:17'),
(10, 0, 'npi-ipe-tolerans-tablosu', 'NPI - IPE TOLERANS TABLOSU', '', '', '', 'tr', 10, 1, '2022-12-15 14:44:53', '2022-12-15 14:44:53', '2022-12-15 14:44:21'),
(11, 0, 'kare-profil-tolerans-tablosu', 'KARE PROFİL TOLERANS TABLOSU', '', '', '', 'tr', 11, 1, '2022-12-15 14:48:02', '2022-12-15 14:48:02', '2022-12-15 14:47:46'),
(12, 0, 'lama-tolerans-tablosu', 'LAMA TOLERANS TABLOSU', '', '', '', 'tr', 12, 1, '2022-12-15 14:49:16', '2022-12-15 14:49:16', '2022-12-15 14:48:32'),
(13, 0, 'kosebent-tolerans', 'KÖŞEBENT TOLERANS', '', '', '', 'tr', 13, 1, '2022-12-15 14:49:53', '2022-12-15 14:49:53', '2022-12-15 14:49:42'),
(14, 0, 't-profil-tolerans-tablosu', 'T PROFİL TOLERANS TABLOSU', '', '', '', 'tr', 14, 1, '2022-12-15 14:50:49', '2022-12-15 14:50:49', '2022-12-15 14:50:39'),
(15, 0, 'npu-profil-tolerans-tablosu', 'NPU PROFİL TOLERANS TABLOSU', '', '', '', 'tr', 15, 1, '2022-12-15 14:51:50', '2022-12-15 14:51:50', '2022-12-15 14:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `technical_informations_w_categories`
--

CREATE TABLE `technical_informations_w_categories` (
  `id` int(11) NOT NULL,
  `technical_information_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technical_informations_w_categories`
--

INSERT INTO `technical_informations_w_categories` (`id`, `technical_information_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(8, 9, 1),
(9, 8, 1),
(10, 7, 1),
(11, 10, 2),
(12, 11, 2),
(13, 12, 2),
(14, 13, 2),
(15, 14, 2),
(16, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `technical_information_categories`
--

CREATE TABLE `technical_information_categories` (
  `id` int(11) NOT NULL,
  `top_id` int(11) NOT NULL DEFAULT 0,
  `title` longtext DEFAULT NULL,
  `seo_url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `home_url` longtext DEFAULT NULL,
  `banner_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technical_information_categories`
--

INSERT INTO `technical_information_categories` (`id`, `top_id`, `title`, `seo_url`, `img_url`, `home_url`, `banner_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`) VALUES
(1, 0, 'Teknik Bilgiler', 'teknik-bilgiler', '36d71127403dfe97b8332e1009ebb618.webp', '28611029a7a23218057806cb7a3c7025.webp', 'ad8ce330578876b4db428be7870b74a1.webp', 'tr', 1, 1, '2022-11-23 00:27:35', '2022-12-22 13:25:02'),
(2, 0, 'Ölçü Tolerans Tabloları', 'olcu-tolerans-tablolari', NULL, NULL, NULL, 'tr', 2, 1, '2022-12-15 12:06:56', '2022-12-15 12:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `technical_information_dimensions`
--

CREATE TABLE `technical_information_dimensions` (
  `id` int(11) NOT NULL,
  `technical_information_id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `lang` char(2) NOT NULL DEFAULT 'tr',
  `img_url` varchar(255) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technical_information_dimensions`
--

INSERT INTO `technical_information_dimensions` (`id`, `technical_information_id`, `title`, `lang`, `img_url`, `isActive`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, 1, '', 'tr', '6cb45af169bf6b448f90bd5ac558d43a.webp', 1, 1, '2022-12-13 13:05:29', '2022-12-13 13:09:02'),
(2, 1, '', 'tr', 'ddbb97f980b24f627791a21ec0f9c387.webp', 1, 2, '2022-12-13 13:09:48', '2022-12-13 13:09:48'),
(3, 1, '', 'tr', 'd3fb82da1333956b96e1695b347a21ab.webp', 1, 3, '2022-12-13 13:09:53', '2022-12-13 13:09:53'),
(4, 1, '', 'tr', '1a5aff22222daa6faca32e45dccfd1a7.webp', 1, 4, '2022-12-13 13:09:59', '2022-12-13 13:09:59'),
(5, 1, '', 'tr', '231aeb5d2b68f281764ae1cad18f1afd.webp', 1, 5, '2022-12-13 13:10:06', '2022-12-13 13:10:06'),
(6, 1, '', 'tr', '80652acf814c1cd8d62d927a81d6f6c8.webp', 1, 6, '2022-12-13 13:10:11', '2022-12-13 13:10:11'),
(7, 2, '', 'tr', 'da21f0ec42a805430cfd58527b5d3f2f.webp', 1, 7, '2022-12-15 14:17:12', '2022-12-15 14:17:12'),
(8, 3, '', 'tr', '3b310ef80898d6badb5002494364632f.webp', 1, 8, '2022-12-15 14:20:35', '2022-12-15 14:20:35'),
(9, 4, '', 'tr', '2a789dd91fcff3f95b3596b46d011f8d.webp', 1, 9, '2022-12-15 14:20:55', '2022-12-15 14:20:55'),
(10, 5, '', 'tr', 'f040710ad77d3bbe7958ab823ddb8a9b.webp', 1, 10, '2022-12-15 14:21:25', '2022-12-15 14:21:25'),
(11, 6, '', 'tr', 'ae8ac6ecf2277101e788b0213df43d52.webp', 1, 11, '2022-12-15 14:21:41', '2022-12-15 14:21:41'),
(12, 7, '', 'tr', 'be3ef25b9a0f5e4558c38e8c5e7a2a68.webp', 1, 12, '2022-12-15 14:22:01', '2022-12-15 14:22:01'),
(13, 8, '', 'tr', '6d6953b118bfb21a7207d96bee0802cf.webp', 1, 13, '2022-12-15 14:22:26', '2022-12-15 14:22:26'),
(14, 8, '', 'tr', '3f1225069784395f6f0b467277857a6f.webp', 1, 14, '2022-12-15 14:22:31', '2022-12-15 14:22:31'),
(15, 8, '', 'tr', '8b82a164bc40d99bff132b4711121b10.webp', 1, 15, '2022-12-15 14:22:37', '2022-12-15 14:22:37'),
(16, 9, '', 'tr', '0da406386d613d637ed076ac0635c6fc.webp', 1, 16, '2022-12-15 14:22:57', '2022-12-15 14:22:57'),
(17, 10, '', 'tr', '6aeb1d9bb3512849e3ec5f6fffd608c9.webp', 1, 17, '2022-12-15 14:45:23', '2022-12-15 14:47:22'),
(18, 10, '', 'tr', NULL, 0, 18, '2022-12-15 14:46:04', '2022-12-15 14:47:22'),
(19, 10, '', 'tr', '56cfabd5c7fda534a6b14d995459ee4d.webp', 1, 19, '2022-12-15 14:46:23', '2022-12-15 14:46:23'),
(20, 10, '', 'tr', '18b2c525ea2decdc3eaec9e2dda9328c.webp', 1, 20, '2022-12-15 14:46:29', '2022-12-15 14:46:29'),
(21, 11, '', 'tr', '3447fe1d5f0ae9e9a081760246c28e73.webp', 1, 21, '2022-12-15 14:48:13', '2022-12-15 14:48:13'),
(22, 12, '', 'tr', 'f86e98f93c6dce40e6ea88301a5bbb0d.webp', 1, 22, '2022-12-15 14:49:26', '2022-12-15 14:49:26'),
(23, 13, '', 'tr', 'f51aae76a43576864f87ad7dfe12d298.webp', 1, 23, '2022-12-15 14:50:14', '2022-12-15 14:50:14'),
(24, 14, '', 'tr', '5b00be06cb3a21168df7866a980ebaf6.webp', 1, 24, '2022-12-15 14:51:00', '2022-12-15 14:51:00'),
(25, 15, '', 'tr', 'c088824f980ac9283ca8b78414090c08.webp', 1, 25, '2022-12-15 14:52:07', '2022-12-15 14:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `technical_information_images`
--

CREATE TABLE `technical_information_images` (
  `id` int(11) NOT NULL,
  `technical_information_id` int(11) DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `isCover` tinyint(4) DEFAULT 0,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technical_information_images`
--

INSERT INTO `technical_information_images` (`id`, `technical_information_id`, `url`, `img_url`, `title`, `description`, `lang`, `rank`, `isActive`, `isCover`, `createdAt`, `updatedAt`) VALUES
(13, 9, '61f7e96d7ce4857610bce3d5ed46f8f1.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:33:19', '2022-12-15 14:33:20'),
(14, 1, 'e53a41bc9cee0e6805c3c148701066fb.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:33:45', '2022-12-15 14:33:50'),
(15, 2, '20e4ddb9cb69a72584646ed90bb7cf06.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:34:03', '2022-12-15 14:34:05'),
(16, 3, '8fe6fa57c8f298c18490f869544c8c21.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:34:22', '2022-12-15 14:34:23'),
(17, 4, '4a7ebd955cab7f4ef5ebf5dde6ef8ee3.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:34:37', '2022-12-15 14:34:39'),
(18, 5, 'e0fd6bd32ddb44e84dd6cfbb0354beb2.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:34:57', '2022-12-15 14:34:58'),
(19, 6, '20d26c18a850630d91bca6237d45e631.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:35:12', '2022-12-15 14:35:13'),
(20, 7, '2a5f31072f1b188bd1dd3edc0c44917d.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:35:30', '2022-12-15 14:35:31'),
(21, 8, '2efbb6e15394997e6d8b6944c0c70e19.webp', NULL, NULL, NULL, 'tr', 9, 1, 1, '2022-12-15 14:35:50', '2022-12-15 14:35:52'),
(22, 10, '2d9f23db924788604297f0f6cb03886c.webp', NULL, NULL, NULL, 'tr', 10, 1, 1, '2022-12-15 14:46:41', '2022-12-15 14:46:42'),
(23, 11, '6f4278264d4798284c57bd0a72e3c77f.webp', NULL, NULL, NULL, 'tr', 11, 1, 1, '2022-12-15 14:48:22', '2022-12-15 14:48:25'),
(24, 12, 'bd2e434eebafdd6974e9e24e98c5a568.webp', NULL, NULL, NULL, 'tr', 12, 1, 1, '2022-12-15 14:49:34', '2022-12-15 14:49:36'),
(25, 13, 'fce9f0de331511ee7cb4c6037a19bca6.webp', NULL, NULL, NULL, 'tr', 13, 1, 1, '2022-12-15 14:49:59', '2022-12-15 14:50:00'),
(26, 14, '1cd033233f77d85a98d0f4341652737d.webp', NULL, NULL, NULL, 'tr', 14, 1, 1, '2022-12-15 14:51:08', '2022-12-15 14:51:09'),
(27, 15, '7412ea54179e88fe86e6387dae05c13f.webp', NULL, NULL, NULL, 'tr', 15, 1, 1, '2022-12-15 14:52:14', '2022-12-15 14:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `full_name` varchar(70) DEFAULT NULL,
  `company` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(1) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(19) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `isActive` tinyint(4) DEFAULT 0,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `role_id`, `isActive`, `rank`, `createdAt`, `updatedAt`, `token`, `lang`) VALUES
(1, 'Mutfak Yapım', 'info@mutfakyapim.com', '05494410121', '0a7483867a2442352e2b86d4b4910826', 1, 1, 1, '2021-01-13 05:30:08', '2022-01-16 09:59:05', 'jxFRs9CRUfkyFgqZcegvAH1iyNOEBEU2BqFVJCvQmK04EuPmocO8wo3xFtvs67kZlP8A7RbUYlZqY2GS4jPLbppdH8zloYlmCEuDf5N234KacVkMtJq8PThypV5O6m2Ht0kXJGTsS578WwCDc1zApKbaQxI4Cpu9wyOlN0tV53SzdBGw5qWMGU1GxLW7VTn1eLdaEXXMwHofDesIW6fLainDjRiQIvLKhBYoex79eiIjgQdg1ghtN3IAnzYDrz9', 'tr'),
(2, 'Emre KILIÇ', 'emrekilic@mutfakyapim.com', '05494410120', '0a7483867a2442352e2b86d4b4910826', 1, 1, 2, '2021-01-13 05:30:08', '2022-02-16 11:43:50', '3914SmBBFEUto1qeEtR501FCu1ATi4Go78I9M3nHRIjbEgrvjYnsMJMzJur6h8UqYDMvQsc9fg7ETh0Tr5oSY6zpvHcalbqShaXv8zrVslAkWVIc7mfLCZGDWspF7eBEtbDVDJG0VNFd2Bc8ZMX5zCSGdpJnuO3bCGqPDkiQxLxlmXZwic445IuYxqKfNwIfjUUjeVhQwFgJdtiu4R2jZlzQAHOtxKydxHkoy6XwW1SygdTy30akPLfhv6aw9yN', 'tr');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `permissions` mediumtext DEFAULT NULL,
  `isActive` int(11) DEFAULT 0,
  `isCover` tinyint(4) DEFAULT 0,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `title`, `permissions`, `isActive`, `isCover`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, 'Admin', '{\"blogs\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"blog_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"dashboard\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"emailsettings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"galleries\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"homeitems\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"menus\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"pages\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"products\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"product_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"sectors\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"sector_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"services\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"service_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"settings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"slides\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"technical_informations\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"technical_information_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"userop\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"users\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"user_role\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"}}', 1, 1, 1, '2020-07-22 20:58:34', '2022-11-16 13:56:26'),
(2, 'Kullanıcı', NULL, 1, 0, 2, '2021-04-27 15:36:34', '2021-04-27 15:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_urls`
--

CREATE TABLE `video_urls` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `img_url` longtext DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` bigint(20) DEFAULT 1,
  `isActive` tinyint(1) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sharedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `video_urls`
--

INSERT INTO `video_urls` (`id`, `gallery_id`, `title`, `description`, `url`, `img_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `sharedAt`) VALUES
(4, 3, NULL, NULL, '&lt;iframe class=&quot;lazyload&quot; loading=&quot;lazy&quot; width=&quot;100%&quot; height=&quot;450&quot; data-src=&quot;https://www.youtube.com/embed/nMokHYNLKus&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', NULL, 'tr', 1, 1, '2022-11-23 09:15:52', '2022-11-23 09:15:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_FILEGALLERY` (`gallery_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_items`
--
ALTER TABLE `home_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_IMAGEGALLERY` (`gallery_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linguo_languages`
--
ALTER TABLE `linguo_languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `linguo_language_files`
--
ALTER TABLE `linguo_language_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `linguo_language_strings`
--
ALTER TABLE `linguo_language_strings`
  ADD PRIMARY KEY (`string_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_w_categories`
--
ALTER TABLE `products_w_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PRODUCTWID` (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_dimensions`
--
ALTER TABLE `product_dimensions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_DIMENSIONPRODUCT` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PRODUCTID` (`product_id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sector_categories`
--
ALTER TABLE `sector_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical_informations`
--
ALTER TABLE `technical_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical_informations_w_categories`
--
ALTER TABLE `technical_informations_w_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PRODUCTWID` (`technical_information_id`);

--
-- Indexes for table `technical_information_categories`
--
ALTER TABLE `technical_information_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical_information_dimensions`
--
ALTER TABLE `technical_information_dimensions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_DIMENSIONTECHNICALINFORMATION` (`technical_information_id`) USING BTREE;

--
-- Indexes for table `technical_information_images`
--
ALTER TABLE `technical_information_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TECHNICALINFORMATIONID` (`technical_information_id`) USING BTREE;

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `FK_ROLEID` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_VIDEOGALLERY` (`gallery_id`);

--
-- Indexes for table `video_urls`
--
ALTER TABLE `video_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_VIDEOURLGALLERY` (`gallery_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_items`
--
ALTER TABLE `home_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `linguo_languages`
--
ALTER TABLE `linguo_languages`
  MODIFY `language_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `linguo_language_files`
--
ALTER TABLE `linguo_language_files`
  MODIFY `file_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `linguo_language_strings`
--
ALTER TABLE `linguo_language_strings`
  MODIFY `string_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_w_categories`
--
ALTER TABLE `products_w_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT for table `product_dimensions`
--
ALTER TABLE `product_dimensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sector_categories`
--
ALTER TABLE `sector_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `technical_informations`
--
ALTER TABLE `technical_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `technical_informations_w_categories`
--
ALTER TABLE `technical_informations_w_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `technical_information_categories`
--
ALTER TABLE `technical_information_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `technical_information_dimensions`
--
ALTER TABLE `technical_information_dimensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `technical_information_images`
--
ALTER TABLE `technical_information_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_urls`
--
ALTER TABLE `video_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `FK_FILEGALLERY` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_IMAGEGALLERY` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_w_categories`
--
ALTER TABLE `products_w_categories`
  ADD CONSTRAINT `FK_PRODUCTWID` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_dimensions`
--
ALTER TABLE `product_dimensions`
  ADD CONSTRAINT `FK_DIMENSIONPRODUCT` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_PRODUCTID` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_ROLEID` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `FK_VIDEOGALLERY` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video_urls`
--
ALTER TABLE `video_urls`
  ADD CONSTRAINT `FK_VIDEOURLGALLERY` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
