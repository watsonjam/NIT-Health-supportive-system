-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 11:12 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nit_health_supportive`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `nationality` varchar(200) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `systemEmail` varchar(200) NOT NULL,
  `emailPassword` varchar(200) NOT NULL,
  `token` varchar(50) NOT NULL,
  `details` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fname`, `lname`, `gender`, `nationality`, `date_of_birth`, `picture`, `email`, `phone_no`, `password`, `systemEmail`, `emailPassword`, `token`, `details`, `status`) VALUES
(1, 'Admin', '', '', '', '', '', '', 'godifreyhugho65.gh@gmail.com', '', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'nithealths8@gmail.com', 'nit@2020', 'a4df35b179d367290f121237acc30ad5', 'not added', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(10) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `doctorName` varchar(200) NOT NULL,
  `doctorId` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `feedback` mediumtext NOT NULL,
  `token_no` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `about_appo` varchar(10) NOT NULL,
  `time` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `userId`, `name`, `user_email`, `doctorName`, `doctorId`, `description`, `feedback`, `token_no`, `status`, `about_appo`, `time`, `date`) VALUES
(31, 'user6', 'Lameck Samo Augustino', 'augustinolameck69@gmail.com', 'Olivery Tino Matata', 'doctor3', 'Naumwa sana', '', '21456', 'confirmed', '', '22:44', '2020/09/20');

-- --------------------------------------------------------

--
-- Table structure for table `approved_appointment`
--

CREATE TABLE `approved_appointment` (
  `id` int(10) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `doctorName` varchar(200) NOT NULL,
  `doctorId` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `token_no` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `time` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approved_appointment`
--

INSERT INTO `approved_appointment` (`id`, `userId`, `name`, `user_email`, `doctorName`, `doctorId`, `description`, `token_no`, `status`, `time`, `date`) VALUES
(4, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL</p>', '11607', 'New', '02:08 pm', '16/09/2020'),
(5, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK</p>', '12648', 'New', '04:15 pm', '16/09/2020'),
(6, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>JJJJJJjjjjjjjJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJ</p>', '90720', 'New', '04:25 pm', '16/09/2020'),
(7, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll</p>', '99014', 'New', '04:46 pm', '16/09/2020'),
(8, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>LLLLLLLLLLLLLLLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMMMMMMMMMMMMMMMMMMMMMMMEEEEEEEEEEE</p>', '68066', 'New', '04:59 pm', '16/09/2020'),
(9, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>LLLLLLLLLLLLLLLLLLLLLLLLLAAAAAAAAAAAAAAAAAAAAAAAAAMMMMMMMMMMMMMMMMMMMMEEEEEEEEEEEEEEEEECCCCCCCCCCCCCCCCCCCCKKKKKKKKKKKKKKKKK</p>', '56947', 'New', '05:16 pm', '16/09/2020'),
(10, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>NAUMWA SANA LAKINI SIJUI NI NN&nbsp; TATIZO.....</p>', '64314', 'New', '05:23 pm', '16/09/2020'),
(11, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>lllllllllllllLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL</p>', '99604', 'New', '06:02 pm', '16/09/2020'),
(12, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>fffffffffffffffffffffffffffff</p>', '42724', 'New', '06:50 pm', '16/09/2020'),
(13, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>LLLLLLLLLLLLLLLLLLLAAAAAAAAAAAAAAAAMMMMMMMMMMMMMMMEEEEEEEEEEEEEECCCCCCCCCCCKKKKKKKKKKKKKKKK</p>', '27832', 'New', '07:23 pm', '16/09/2020'),
(14, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL</p>', '60051', 'New', '07:30 pm', '16/09/2020'),
(15, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>lLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL</p>', '88401', 'New', '07:37 pm', '16/09/2020'),
(16, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>JJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJ</p>', '33755', 'New', '07:54 pm', '16/09/2020'),
(17, 'user7', 'James Mlay Watson', 'augustinolameck69@gmail.com', 'Baraka Philimon Onduru', 'doctor4', '<p>LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL</p>', '34512', 'New', '08:34 pm', '16/09/2020');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `drugId` int(10) NOT NULL,
  `pharmacistId` int(10) NOT NULL,
  `drug_name` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `total_profit` varchar(100) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `vat` varchar(500) NOT NULL,
  `exclusive_total` varchar(400) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `date_added_to_cart` varchar(100) NOT NULL,
  `time_added_to_cart` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `company_name` varchar(200) NOT NULL,
  `company_moto` varchar(200) NOT NULL,
  `type_of_local_address` varchar(100) NOT NULL,
  `company_logo` varchar(400) NOT NULL,
  `country` varchar(200) NOT NULL,
  `region` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `ward` varchar(200) NOT NULL,
  `street` varchar(200) NOT NULL,
  `road` varchar(200) NOT NULL,
  `plot_no` varchar(100) NOT NULL,
  `block_no` varchar(100) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `unsurveyd` varchar(200) NOT NULL,
  `phone_no1` varchar(200) NOT NULL,
  `phone_no2` varchar(200) NOT NULL,
  `fax_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `VRN` varchar(200) NOT NULL,
  `TIN` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'SS', 'South Sudan'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SH', 'St. Helena'),
(206, 'PM', 'St. Pierre and Miquelon'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States minor outlying islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (U.S.)'),
(241, 'WF', 'Wallis and Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(255) NOT NULL,
  `disease_name` varchar(255) NOT NULL,
  `quater1` int(255) NOT NULL,
  `quater2` int(255) NOT NULL,
  `quater3` int(255) NOT NULL,
  `quater4` int(255) UNSIGNED NOT NULL,
  `total_cases` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `disease_name`, `quater1`, `quater2`, `quater3`, `quater4`, `total_cases`) VALUES
(1, 'Malaria', 0, 0, 3, 0, 3),
(2, 'Urine Track Infections (UTI)', 0, 0, 4, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `token` varchar(50) NOT NULL,
  `details` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(20) NOT NULL,
  `time_registered` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `fname`, `mName`, `lname`, `fullName`, `gender`, `nationality`, `date_of_birth`, `email`, `phone_no`, `password`, `picture`, `token`, `details`, `role`, `date_registered`, `time_registered`, `status`) VALUES
(3, 'olivery', 'Olivery', 'Tino', 'Matata', 'Olivery Tino Matata', 'Male', 'Tanzania', '1996-05-12', 'augustinolameck69@gmail.com', '+255 713456789', '41a1f6bc53d2c2160b03b3e6b85e70e9', 'images/profilePicture/5f6342fed2b771.31127557.jpg', '0fbfbb9d062d78d69e05c6c29aedf5d2', 'added', 'doctor', 'Aug 2020', '12:43 am', 'Online'),
(4, 'baraka', 'Baraka', 'Philimon', 'Onduru', 'Baraka Philimon Onduru', 'Male', 'Tanzania', '1996-02-12', 'baraka23@gmail.com', '+255 745227799', '5f308af44335e27e7ff35177f345cb3d', '', '0fbfbb9d062d78d69e05c6c29aedf5d2', 'added', 'doctor', 'Aug 2020', '12:49 am', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(10) NOT NULL,
  `drug_name` varchar(200) NOT NULL,
  `manufacture_date` varchar(200) NOT NULL,
  `expire_date` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `updated_quantity` int(10) NOT NULL,
  `quantity_type` varchar(100) NOT NULL,
  `buyingPrice` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `registration_date` varchar(100) NOT NULL,
  `alertAddingDrug` int(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `drug_name`, `manufacture_date`, `expire_date`, `quantity`, `updated_quantity`, `quantity_type`, `buyingPrice`, `price`, `profit`, `registration_date`, `alertAddingDrug`, `status`) VALUES
(1, 'Panadol', '2018-02-20', '2020-09-04', 190, 0, 'Pices', '200', '400', '200', '02-Aug-2020', 50, 'Changes'),
(2, 'Mseto', '2020-02-01', '2020-10-01', 200, 0, 'Pices', '500', '1000', '500', '03-Aug-2020', 40, 'New'),
(3, 'Ampicilin', '2019-01-01', '2021-01-01', 1000, 0, 'Boxes', '500', '600', '100', '10-Sep-2020', 100, 'New'),
(4, 'Paracetamol', '2020-02-12', '2020-09-30', 100, 0, 'Boxes', '100', '200', '100', '10-Sep-2020', 10, 'Changes'),
(5, 'Diclofenac', '2018-04-10', '2021-04-09', 500, 0, 'Pices', '500', '600', '100', '12-Sep-2020', 100, 'New'),
(6, 'Albendazol', '2020-01-02', '2023-01-01', 100, 0, 'Boxes', '1000', '1100', '100', '12-Sep-2020', 50, 'New'),
(7, 'Cloxaxilin', '2020-02-04', '2023-02-03', 1000, 0, 'Boxes', '2000', '2500', '500', '12-Sep-2020', 100, 'New'),
(8, 'Ampiclox', '2017-09-30', '2020-09-29', 200, 0, 'Boxes', '5000', '6000', '1000', '12-Sep-2020', 50, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `expiredcart`
--

CREATE TABLE `expiredcart` (
  `id` int(10) NOT NULL,
  `employeeId` varchar(100) NOT NULL,
  `expiredTime` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipt`
--

CREATE TABLE `payment_receipt` (
  `id` int(10) NOT NULL,
  `pharmacistId` int(10) NOT NULL,
  `clientName` varchar(200) NOT NULL,
  `receipt_no` varchar(200) NOT NULL,
  `reference_no` varchar(200) NOT NULL,
  `payment_for` varchar(200) NOT NULL,
  `in_respect_of` varchar(200) NOT NULL,
  `paymentDate` varchar(100) NOT NULL,
  `date_sale` varchar(50) NOT NULL,
  `time_sale` varchar(50) NOT NULL,
  `timestamp` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_receipt`
--

INSERT INTO `payment_receipt` (`id`, `pharmacistId`, `clientName`, `receipt_no`, `reference_no`, `payment_for`, `in_respect_of`, `paymentDate`, `date_sale`, `time_sale`, `timestamp`) VALUES
(1, 1, 'Joyce Juma', '1729409', '3702879199890950', 'Sales Drugs', 'G190621-3638', '03/Aug/2020', '2020-08-03', '10:42 pm', '03-08-2020 10:42 PM'),
(2, 1, 'Anna Juma', '8673055', '7576619386751707', 'Sales Drugs', 'G190621-3638', '19/Aug/2020', '2020-08-19', '07:35 pm', '19-08-2020 07:35 PM'),
(3, 1, 'Anna Juma', '7007253', '8825557043917972', 'Sales Drugs', 'G190621-3638', '19/Aug/2020', '2020-08-19', '07:35 pm', '19-08-2020 07:35 PM'),
(4, 1, 'James John', '4290526', '2748469692621873', 'Sales Drugs', 'G190621-3638', '19/Aug/2020', '2020-08-19', '07:37 pm', '19-08-2020 07:37 PM'),
(5, 1, 'James John', '5255794', '3209604785283324', 'Sales Drugs', 'G190621-3638', '19/Aug/2020', '2020-08-19', '07:37 pm', '19-08-2020 07:37 PM'),
(6, 1, 'Kavishe', '7526460', '3995341702071666', 'Sales Drugs', 'G190621-3638', '27/Aug/2020', '2020-08-27', '05:43 pm', '27-08-2020 05:43 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `fullName` varchar(400) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `token` varchar(50) NOT NULL,
  `details` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(20) NOT NULL,
  `time_registered` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `username`, `fname`, `mName`, `lname`, `fullName`, `gender`, `nationality`, `date_of_birth`, `email`, `phone_no`, `password`, `picture`, `token`, `details`, `role`, `date_registered`, `time_registered`, `status`) VALUES
(2, 'KEEY515897', '', '', '', '', '', '', '', '', '', 'edec78c4672bb22868f299812290b7e5', '', '75d6b02fbd0f04d59de1228148e10b1f', 'not added', 'pharmacist', '', '', 'Online'),
(3, 'yuli', 'Yulitha', 'Limbu', 'Mayunga', 'Yulitha Limbu Mayunga', 'Female', 'Tanzania', '1996-11-23', 'punguster@gmail.com', '+255 755609080', '7f78006fe7839ef6d9e1e99d68b92206', 'images/profilePicture/5f652687e707e0.26203154.jpg', '75d6b02fbd0f04d59de1228148e10b1f', 'added', 'pharmacist', 'Aug 2020', '12:58 am', 'Online'),
(4, 'FEIX816892', '', '', '', '', '', '', '', '', '', '1160296c598ddf3b6946b7a122770b0b', '', '75d6b02fbd0f04d59de1228148e10b1f', 'not added', 'pharmacist', '', '', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(10) NOT NULL,
  `doctor_name` varchar(200) NOT NULL,
  `doctorId` varchar(255) NOT NULL,
  `report` mediumtext NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `doctor_name`, `doctorId`, `report`, `status`, `date`, `time`) VALUES
(1, 'Joyce Johnson Nduguru', 'doctor3', '<h2 style=\"text-align: center;\"><span style=\"text-decoration: underline;\">REPORT</span></h2>\r\n<p>&ldquo;the Act&rdquo; means the Companies Act Number 12 of 2002; &ldquo;the Article&rdquo; means the Articles of the Company; clear days&rdquo; in relation to the period of a notice means that period excluding the day when the notice is given or on which it is to take effect;</p>\r\n<p>&ldquo;the holder&rdquo; in relation to shares means the member whose name is entered in the register of members as the holder of the shares; the seal&rdquo; means the common seal of the Company;</p>\r\n<p>&ldquo;Secretary&rdquo; means the Secretary of the Company or any person appointed to perform the duties of the Secretary of the Company.</p>\r\n<p>Expressions referred to writing shall, unless the contrary intention appears, be construed as including references to printing, lithograph, photograph, and other modes of representing or reproducing words in a visible form.</p>\r\n<p>Unless the context otherwise required, words or expression contained in these Regulations shall bear the same meaning as in the Act or any statutory modification thereof in force at the date at which these Regulations become binding on the Company.</p>', 'New', '03/09/2020', '03:42 pm');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) NOT NULL,
  `itemId` int(10) NOT NULL,
  `pharmacistId` int(10) NOT NULL,
  `seller_name` varchar(200) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `total_profit` varchar(100) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `date_sale` varchar(20) NOT NULL,
  `date_sale2` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `time_sale` varchar(20) NOT NULL,
  `timestamp` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `itemId`, `pharmacistId`, `seller_name`, `customer_name`, `item_name`, `quantity`, `price`, `profit`, `total_profit`, `total_price`, `date_sale`, `date_sale2`, `month`, `year`, `time_sale`, `timestamp`, `status`) VALUES
(1, 1, 1, 'Anna Emmanuel Michael', 'Joyce Juma', 'Panadol', '1', '400', '200', '200', '400', '2020-08-03', 'Aug-2020', 'August', '2020', '10:42 pm', '03-08-2020 10:42 PM', ''),
(2, 1, 1, 'Anna Emmanuel Michael', 'Anna Juma', 'Panadol', '1', '400', '200', '200', '400', '2020-08-19', 'Aug-2020', 'August', '2020', '07:35 pm', '19-08-2020 07:35 PM', ''),
(3, 2, 1, 'Anna Emmanuel Michael', 'Anna Juma', 'Mseto', '1', '1000', '500', '500', '1000', '2020-08-19', 'Aug-2020', 'August', '2020', '07:35 pm', '19-08-2020 07:35 PM', ''),
(4, 1, 1, 'Anna Emmanuel Michael', 'James John', 'Panadol', '1', '400', '200', '200', '400', '2020-08-19', 'Aug-2020', 'August', '2020', '07:37 pm', '19-08-2020 07:37 PM', ''),
(5, 2, 1, 'Anna Emmanuel Michael', 'James John', 'Mseto', '1', '1000', '500', '500', '1000', '2020-08-19', 'Aug-2020', 'August', '2020', '07:37 pm', '19-08-2020 07:37 PM', ''),
(6, 1, 1, 'Anna Emmanuel Michael', 'Kavishe', 'Panadol', '3', '400', '200', '600', '1200', '2020-08-27', 'Aug-2020', 'August', '2020', '05:43 pm', '27-08-2020 05:43 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) NOT NULL,
  `doctor_id` varchar(10) NOT NULL,
  `doctor_name` varchar(200) NOT NULL,
  `switch_button` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `doctor_id`, `doctor_name`, `switch_button`, `status`) VALUES
(1, '1', 'Joyce Johnson Nduguru', 'checked', 'On'),
(3, '3', 'Olivery Tino Matata', '', 'Off'),
(4, '4', 'Baraka Philimon Onduru', 'checked', 'On');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `fullName` varchar(400) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `token` varchar(50) NOT NULL,
  `email_verification_code` varchar(100) NOT NULL,
  `about_email` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_registered` varchar(20) NOT NULL,
  `time_registered` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `mName`, `lname`, `fullName`, `gender`, `nationality`, `date_of_birth`, `email`, `phone_no`, `password`, `picture`, `token`, `email_verification_code`, `about_email`, `details`, `role`, `date_registered`, `time_registered`, `status`) VALUES
(6, 'lameck', 'Lameck', 'Samo', 'Augustino', 'Lameck Samo Augustino', 'Male', 'Tanzania', '1992-06-29', 'augustinolameck69@gmail.com', '+255 719485679', 'eea05fa755e629d607bd978ef08cb956', '', '8034c828af8dd98a9a00ac0e5b4bd3d4', '2724-5385', 'Verified', 'added', 'user', '25/08/2020', '12:07 am', 'Online'),
(7, 'james', 'James', 'Mlay', 'Watson', 'James Mlay Watson', 'Male', 'Tanzania', '1998-01-10', 'augustinolameck69@gmail.com', '+255 652347890', '5721c634b6c516e6b87417f1ca775be5', '', '8034c828af8dd98a9a00ac0e5b4bd3d4', '4704-1440', 'Verified', 'added', 'user', '25/08/2020', '12:18 am', 'Online'),
(8, 'fanuel', 'Mwango', 'Peter', 'Fanuel', 'Mwango Peter Fanuel', 'Male', 'Tanzania', '1994-06-10', 'augustinolameck69@gmail.com', '+255 754607080', '614c4fc15a2e963602d1e27e27e73e6b', '', '8034c828af8dd98a9a00ac0e5b4bd3d4', '6504-4567', 'Verified', 'added', 'user', 'Sep 2020', '08:21 am', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `users_comment`
--

CREATE TABLE `users_comment` (
  `id` int(10) NOT NULL,
  `doctor_name` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `comment` mediumtext NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_comment`
--

INSERT INTO `users_comment` (`id`, `doctor_name`, `user_name`, `comment`, `status`, `date`, `time`, `timestamp`) VALUES
(1, 'Joyce Johnson Nduguru', 'Annastanzia Joseph Juma', 'commentcommentcommentcommentcommentcommentcommentcomment', 'New', '24/08/2020', '01:27 am', '2020-08-25 14:27:57'),
(2, 'Rehema Michael Prosper', 'Annastanzia Joseph Juma', 'commentcommentcommentcommentcommentcommentcommentcomment', 'New', '24/08/2020', '01:29 am', '2020-08-25 14:27:57'),
(3, 'Rehema Michael Prosper', 'Annastanzia Joseph Juma', 'commentcommentcommentcommentcommentcommentcommentcomment', 'New', '24/08/2020', '01:31 am', '2020-08-25 14:27:57'),
(4, 'Rehema Michael Prosper', 'Annastanzia Joseph Juma', 'row_crow_crow_crow_crow_crow_crow_crow_crow_crow_c', 'New', '24/08/2020', '01:46 am', '2020-08-25 14:27:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_appointment`
--
ALTER TABLE `approved_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expiredcart`
--
ALTER TABLE `expiredcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_comment`
--
ALTER TABLE `users_comment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
