-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 03:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mobile`, `email`, `password`, `image`) VALUES
(1, 'admin', '01712345678', 'admin@gmail.com', 'password', 'admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(6) NOT NULL,
  `elecid` int(6) NOT NULL,
  `userid` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `elecid`, `userid`) VALUES
(11, 5, 4),
(16, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `elecid` int(9) NOT NULL,
  `Title` varchar(40) NOT NULL,
  `category` varchar(40) NOT NULL,
  `elec_rating` int(3) NOT NULL,
  `image` varchar(90) NOT NULL,
  `discription` varchar(800) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`elecid`, `Title`, `category`, `elec_rating`, `image`, `discription`, `price`) VALUES
(1, 'Unda #20', 'HOMEOPATHY', 5, 'Capture.JPG', '', '70'),
(2, 'Lymphomyosot Rx Injectables', 'HOMEOPATHY', 3, 'lym.JPG', '', '80'),
(3, 'Serotonin Dopamine Liquescence', 'HOMEOPATHY', 2, 'amine.JPG', '', '320'),
(4, 'T-Relief Pain Gel', 'HOMEOPATHY', 5, 't-relife.JPG', '', '39'),
(5, 'BodyAnew Cleanse Oral Drops', 'HOMEOPATHY', 5, 'bodyanew.JPG', '', '999'),
(6, 'Inlife Multivitamin and Minerals Supplem', 'VITAMINSSUPPLEMENTS', 5, '81fcH-PvlxL._SL1500_.jpg', '', '635'),
(7, 'HealthKart Multivitamin with Ginseng Ext', 'VITAMINSSUPPLEMENTS', 5, '61UaZaYCHfL._SL1100_.jpg', '', '325'),
(8, 'NutrineLife Multivitamin Supplement with', 'VITAMINSSUPPLEMENTS', 5, '61MS9JgMncL._SL1450_.jpg', '', '963'),
(9, 'Sapien Body Total B Vitamin Complex - 60', 'VITAMINSSUPPLEMENTS', 5, '51LuEFQNgxL._SL1050_.jpg', '', '1500'),
(11, 'Himalaya Liv.52 Tablets - 100 Counts', 'AYURVEDA', 5, '61sus85P5BL._SL1000_.jpg', '', '520'),
(12, 'Zandu Kesari Jivan - 900 g', 'AYURVEDA', 5, '81J8thIJSnL._SL1500_.jpg', '', '521'),
(13, 'Dabur Chyawanprash - 1 kg with Free Dabu', 'AYURVEDA', 5, '61EhUbk23wL._SL1200_.jpg', '', '320'),
(14, 'Himalaya Confido Tablets - 60 Counts', 'AYURVEDA', 5, '61Cim3CxGOL._SL1000_.jpg', '', '300'),
(15, 'Himalaya Wellness Pure Herbs Ashvagandha', 'AYURVEDA', 5, '71WufUyijvL._SL1500_.jpg', '', '500'),
(16, 'Merck SevenSeas Original Cod liver Oil C', 'HEALTHFOOdDRINKS', 5, '51hFiMx0lQL.jpg', '', '400'),
(17, 'Herbalife Afresh Energy Drink- Lemon 50 ', 'HEALTHFOOdDRINKS', 5, '51tCiPwbkjL._SL1001_.jpg', '', '50'),
(18, 'Protinex Vanilla Delight - 400 g', 'HEALTHFOOdDRINKS', 5, '81cWOEqymLL._SL1500_.jpg', '', '420'),
(19, 'Neuherbs Organic Green Coffee Beans for ', 'HEALTHFOOdDRINKS', 5, '61D4KsVelyL._SL1500_.jpg', '', '40'),
(20, 'Wow Biotin Maximum Strength Veg Capsule ', 'HEALTHFOOdDRINKS', 5, '719yVsL8HEL._SL1500_.jpg', '', '360'),
(21, 'c-Rest Neck Massager Pillow,Massage Tool', 'HEALTHCAREDEVICES', 5, '612OHFmRX4L._SL1000_.jpg', '', '500'),
(22, 'Dr Physio (USA) Electric Heat Shiatsu Ma', 'HEALTHCAREDEVICES', 5, '81PfC3qz7WL._SL1500_.jpg', '', '1000'),
(23, 'Flamingo HC 1002 Orthopaedic Heating Bel', 'HEALTHCAREDEVICES', 5, '41lN8XJRKDL.jpg', '', '300'),
(26, 'Vaseline Intensive Care Deep Restore Bod', 'SKINCARE', 5, '51R-KubhnlL._SL1000_.jpg', '', '300'),
(27, 'Nivea Nourishing Lotion Body Milk with D', 'SKINCARE', 5, '71h3tcA8VUL._SL1500_.jpg', '', '400'),
(28, 'Parachute Advansed Body Lotion Deep Nour', 'SKINCARE', 5, '61Oc9yvHdPL._SL1500_.jpg', '', '450'),
(29, 'Lakme Absolute Perfect Radiance Skin Lig', 'SKINCARE', 5, '51amgXm0IwL._SL1000_.jpg', '', '260'),
(30, 'Lakme Blush and Glow Strawberry Gel Face', 'SKINCARE', 5, '616pyi18tXL._SL1000_.jpg', '', '420'),
(49, 'Calbo D', 'OTCMEDICINE', 4, 'O1.jpg', 'Tablet\r\nGeneric: Calcium + Vitamin D3\r\nSquare Pharmaceuticals Ltd.', '180'),
(50, 'Seclo 20', 'OTCMEDICINE', 5, 'o2.jpg', 'Capsule | Generic: Omeprazole | Square Pharmaceuticals Ltd.', '6'),
(51, 'Napa', 'OTCMEDICINE', 5, 'o3.jpg', 'Syrup | Generic: Paracetamol | Beximco Pharmaceuticals Ltd.', '18'),
(52, 'Rosen 28 (3mg/0.03mg)', 'OTCMEDICINE', 5, 'o4.jpg', 'Tablet | Generic: Drospirenone + Ethinylestradiol | Incepta Pharmaceuticals Ltd.', '350'),
(53, 'D Rise 40000', 'OTCMEDICINE', 5, 'o5.jpg', 'Capsule | Generic: Cholecalciferol (Vit. D3) | Beximco Pharmaceuticals Ltd.', '30'),
(54, 'Cavic-C PLUS', 'OTCMEDICINE', 5, 'o6.jpg', 'Tablet | Generic: Calcium Carbonate + Calcium Lactate Gluconate + Vitamin-C + Vitamin D3 | Incepta Pharmaceuticals Ltd.', '110'),
(55, 'Maxpro 20', 'PRESMEDICINE', 4, 'p1.jpg', 'Tablet | Generic: Esomeprazole Magnesium Trihydrate | Renata Limited', '7'),
(56, 'Vigorex 100', 'PRESMEDICINE', 5, 'p2.jpg', 'Tablet | Generic: Sildenafil | Square Pharmaceuticals Ltd.', '50'),
(57, 'Alatrol ', 'PRESMEDICINE', 4, 'p3.jpg', 'Tablet | Generic: Cetirizine Dihydrochloride | Square Pharmaceuticals Ltd.', '3'),
(59, 'Comet 500', 'PRESMEDICINE', 5, 'p5.jpg', 'Tablet | Generic: Metformin Hydrochloride | Square Pharmaceuticals Ltd', '4'),
(60, 'Alcet 5mg', 'PRESMEDICINE', 5, 'p6.jpg', 'Tablet | Generic: Levocetirizine Hydrochloride | Healthcare Pharmaceuticals Ltd.', '5');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(3) NOT NULL,
  `cardnumber` int(10) NOT NULL,
  `card_expairy` varchar(60) NOT NULL,
  `cvc_code` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `userid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `cardnumber`, `card_expairy`, `cvc_code`, `amount`, `userid`) VALUES
(5, 1793438473, '04/26', 589, 999, 4),
(6, 837483483, '2/26', 456, 400, 5),
(7, 5466899, '12/24', 456, 521, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `mobile`, `email`, `password`) VALUES
(4, 'mizan101', '01756008955', 'mizan101@gmail.com', '123456'),
(5, 'masud101', '01760534597', 'masud101@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`elecid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `elecid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
