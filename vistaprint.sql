-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2023 at 09:28 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vistaprint`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
CREATE TABLE IF NOT EXISTS `agencies` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(30) NOT NULL,
  `gst` varchar(30) NOT NULL,
  `uid` int NOT NULL,
  `status` int NOT NULL COMMENT '0-notapporved,1-approved',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`aid`, `a_name`, `gst`, `uid`, `status`) VALUES
(1, 'Pacific Printing Company', '23ANDPV1097J1ZO', 4, 1),
(10, 'FreshVille Printing Co.', '3ANDP7J1ZO\r\n48171', 6, 1),
(11, 'PrintCity', '482023ANDPV1097', 7, 1),
(12, 'Wonderprints', '97ANDPV12023048', 9, 0),
(13, 'Prime Printing', '44AYHV1097J1ZO', 12, 0),
(14, 'Prime Printing', 'Gst4367284858', 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cname`) VALUES
(1, 'Visiting Cards'),
(2, 'Invitation'),
(3, 'Gifts'),
(6, 'Stationary'),
(10, 'Clothing-Bags'),
(11, 'Banners-Posters');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
CREATE TABLE IF NOT EXISTS `contactus` (
  `contactus_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`contactus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`contactus_id`, `name`, `email`, `message`) VALUES
(1, 'sakshi', 'sakshiantala553@gmail.com', 'I Want To Join As Agency');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `coupon_id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` int NOT NULL COMMENT '0-flat,1-percentage',
  `s_date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `e_date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_status` int NOT NULL COMMENT '0-deactive,1-active',
  `no_of_uses` int NOT NULL,
  `min_order` int NOT NULL,
  `c_amount` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`coupon_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `code`, `type`, `s_date`, `e_date`, `c_status`, `no_of_uses`, `min_order`, `c_amount`, `uid`) VALUES
(1, 'New20', 0, '2021-05-13', '2021-06-30', 1, 5, 2000, 150, 3),
(2, 'Summer2021', 1, '2021-05-01', '2021-06-30', 1, 2, 1000, 5, 0),
(3, 'Print10', 0, '2021-05-06', '2021-08-27', 1, 2, 2000, 120, 9),
(4, 'New17', 0, '2021-06-04', '2021-06-24', 1, 2, 1000, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
CREATE TABLE IF NOT EXISTS `memberships` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `m_title` varchar(20) NOT NULL,
  `m_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` int NOT NULL,
  `duration` varchar(20) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`mid`, `m_title`, `m_desc`, `price`, `duration`) VALUES
(1, 'Basic', 'Add Limited Product,Less Recommendation,Limited Showcase', 399, '3'),
(2, 'Standard', 'Add Limited Products,Mediator Recommendation,Limited Showcase', 1499, '6'),
(3, 'Premium', 'Add Unlimited Product,First Recommendation,Unlimited Showcase', 2999, '12');

-- --------------------------------------------------------

--
-- Table structure for table `membership_purchase`
--

DROP TABLE IF EXISTS `membership_purchase`;
CREATE TABLE IF NOT EXISTS `membership_purchase` (
  `m_p_id` int NOT NULL AUTO_INCREMENT,
  `mid` int NOT NULL,
  `uid` int NOT NULL,
  `p_date` varchar(30) NOT NULL,
  `e_date` varchar(30) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `p_amount` int NOT NULL,
  `status` int NOT NULL COMMENT '0-active,1-deactive',
  PRIMARY KEY (`m_p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `membership_purchase`
--

INSERT INTO `membership_purchase` (`m_p_id`, `mid`, `uid`, `p_date`, `e_date`, `transaction_id`, `p_amount`, `status`) VALUES
(1, 2, 4, '2021-05-23', '2021-11-23', 'pay_HE9toBjxdVyXfP', 1499, 0),
(2, 3, 6, '2021-05-23', '2022-05-23', 'pay_HEA2aNPVf8WDDf', 2999, 0),
(3, 3, 7, '2021-05-23', '2022-05-23', 'pay_HEAA8Fs7L2lAUS', 2999, 0),
(4, 2, 9, '2021-05-23', '2021-11-23', 'pay_HEAEywAQZtLNFL', 1499, 0),
(5, 1, 12, '2021-05-30', '2021-08-30', 'pay_HGz0JAhU7CnLBq', 399, 0),
(6, 2, 19, '2021-06-04', '2021-12-04', 'pay_HIrb82ePRgAs18', 1499, 0),
(7, 2, 3, '2021-06-11', '2021-12-11', 'pay_HLforwFyQs74tm', 1499, 0),
(8, 3, 3, '2021-06-11', '2022-06-11', 'pay_HLfpvMb2tH4dzu', 2999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `o_id` int NOT NULL AUTO_INCREMENT,
  `o_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pincode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `o_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `amount` int NOT NULL,
  `uid` int NOT NULL,
  `d_b_id` int DEFAULT NULL,
  `status` int NOT NULL COMMENT '0-placed,1-print processing,2-printed,3-delivered',
  `transaction_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `coupon_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `d_amt` int DEFAULT NULL,
  PRIMARY KEY (`o_id`),
  KEY `cid` (`d_b_id`),
  KEY `uid` (`uid`),
  KEY `coupon_id` (`coupon_code`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `o_name`, `address`, `city`, `pincode`, `mobile`, `email`, `o_date`, `amount`, `uid`, `d_b_id`, `status`, `transaction_id`, `coupon_code`, `d_amt`) VALUES
(1, 'Dhruvisha Asodariya', '15,Dharmishta Park Society,Jakatnaka', 'surat', '395013', '8758593238', 'dhruviasodariya@gmail.com', '28-04-2021 05:37:25', 13750, 3, NULL, 0, 'pay_HGIHteXNOOo6uR', 'New20', 150),
(2, 'Dhruvisha Asodariya', '15,Dharmishta Park Society,Jakatnaka', 'surat', '395013', '8758593238', 'dhruviasodariya@gmail.com', '29-05-2021 03:44:34', 500, 3, NULL, 0, 'pay_HGew6MfkOl8jPO', NULL, NULL),
(3, 'Dhruvisha Asodariya', '210,Ravidarshan Society,Nana Varachha', 'Suart', '395006', '8758593238', 'dhruviasodariya@gmail.com', '29-05-2021 03:19:57', 9700, 3, NULL, 0, 'pay_HGfJxots3Q6yFe', NULL, NULL),
(4, 'Bali Patel', '55,Prumkhpark Society', 'Ahemdabad', '395010', '9897986435', 'balipatel123@gmail.com', '29-04-2021 04:27:09', 2233, 2, 13, 2, 'pay_HGfWmtQshtoSvg', 'Summer2021', 118),
(5, 'Bali Patel', '211,Suncity Society', 'surat', '395008', '9897986435', 'balipatel123@gmail.com', '29-05-2021 04:40:17', 2400, 2, NULL, 1, 'pay_HGffR21zwagr57', NULL, NULL),
(6, 'Dhruvisha Asodariya', '15,Dharmishta Park Society,Jakatnaka', 'surat', '395013', '8758593238', 'dhruviasodariya@gmail.com', '29-05-2021 04:34:28', 1000, 3, NULL, 0, 'pay_HGfqyJstzKLpuY', NULL, NULL),
(7, 'Brinda Bhalala', '90,Krishna Complex,Katargam', 'Surat', '395008', '7869509797', 'brindabhalala@gmail.com', '29-05-2021 04:46:42', 4940, 5, NULL, 1, 'pay_HGg5yOS8LElL3V', 'Summer2021', 260),
(8, 'Brinda Bhalala', '90,Krishna Complex,Katargam', 'surat', '395008', '7869509797', 'brindabhalala@gmail.com', '29-05-2021 04:37:49', 1250, 5, NULL, 0, 'pay_HGgDDrzVKR7T3J', NULL, NULL),
(9, 'Kunika Dhaduk', '10-A,Star Residency', 'Baroda', '395010', '9848473848', 'kunikadhaduk@gmail.com', '29-05-2021 05:19:04', 6500, 8, 17, 3, 'pay_HGgSkB0wJE2D15', NULL, NULL),
(10, 'Keyuri Domadiya', '20,Royal Star Residency', 'Surat', '395006', '6729282828', 'keyuridomadiya@gmail.com', '29-04-2021 05:00:13', 8480, 9, NULL, 1, 'pay_HGgbuxh3GdffDt', 'Print10', 120),
(11, 'Bansi Radadiya', '91,Yogidarshan Society', 'Suart', '395010', '8979898989', 'bansiradadiya@gmail.com', '29-05-2021 05:25:31', 3660, 10, NULL, 0, 'pay_HGgvN11DXmLB4I', NULL, NULL),
(12, 'Bansi Radadiya', '91,Yogidarshan Society', 'Suart', '395006', '8979898989', 'bansiradadiya@gmail.com', '29-05-2021 05:26:38', 2250, 10, 13, 2, 'pay_HGh2dmiP7rFVPG', NULL, NULL),
(15, 'sakshi', '15,Dharmishta Park Society,Jakatnaka', 'surat', '395006', '8758593238', 'sakshiantala553@gmail.com', '04-06-2021 05:11:13', 2450, 19, NULL, 0, 'pay_HIrYInvkS4SqrJ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `o_d_id` int NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `pid` int NOT NULL,
  `o_id` int NOT NULL,
  `color` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `size` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `paperstock` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `required_datas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `logo_url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_uploaded_design` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`o_d_id`),
  KEY `pid` (`pid`),
  KEY `o_id` (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`o_d_id`, `qty`, `price`, `pid`, `o_id`, `color`, `size`, `paperstock`, `required_datas`, `logo_url`, `user_uploaded_design`) VALUES
(1, 15, 260, 1, 1, 'White', '89 x 51', 'Standard', 'Mr.K.N Mehta,90,Amazing Star,Surat,9828492939', '1622220738.png', ''),
(2, 10, 700, 7, 1, 'Black', 'XL', '', '', '1622221522.jpg', ''),
(3, 10, 300, 15, 1, '', '229 x 162', 'Matte', ',,,', '', '16222224800.jpg,16222224801.pdf'),
(4, 5, 100, 28, 2, '', '', '', 'Reading Is Dreaming With Open Eyes', '1622302381.jpg', ''),
(5, 11, 700, 7, 3, 'Black', 'M', '', '', '', '16223035830.pdf,16223035831.jpg'),
(6, 10, 200, 8, 3, '', '52 x 91', 'Matte', 'Fresh Food,Food Is Love', '1622303768.png', ''),
(7, 5, 120, 11, 4, 'Black', '', '', '2021', '1622304144.jpg', ''),
(8, 5, 350, 27, 4, 'Blue', '', '', '', '1622304247.jpg', ''),
(9, 5, 480, 4, 5, '', '4” x 4”', '', '', '1622304921.jpg', ''),
(10, 2, 500, 10, 6, '', '190 x 120', 'Velvet', 'Priya,Happy Birthday Dear,May All Your Dreams Comes True,02-06-2021', '', ''),
(11, 5, 50, 2, 7, '', '', '', '', '1622306044.jpg', ''),
(12, 5, 990, 14, 7, '', 'M', '', '', '1622306426.jpg', ''),
(13, 5, 250, 9, 8, 'White', '325 ml', '', '', '1622306817.png', ''),
(14, 5, 250, 9, 9, 'Black', '450 ml', '', '', '1622307338.jpg', ''),
(15, 15, 350, 6, 9, 'Black', '63.5 x 63.5', 'Glossy', ',,', '', '16223075610.jpg,16223075611.pdf'),
(16, 40, 215, 30, 10, '', '', 'Standard', 'Priya,Jay,Maharaja Farm,Surat,10-07-2021', '', ''),
(17, 8, 420, 19, 11, '', '', '', 'Don\'t Steal', '1622309128.png', ''),
(18, 3, 100, 16, 11, '', '', '', 'House Of Beauty,9884839397', '1622309338.jpg', ''),
(19, 5, 450, 25, 12, '', '', '', '', '', '16223098130.jpg,16223098131.pdf'),
(23, 5, 350, 6, 14, 'Black', '64 x 64', 'Glossy', 'Mr.K.N Mehta,90,Amazing Star,Surat,9828492939', '1622737532.png', ''),
(24, 7, 350, 6, 15, 'Black', '64 x 64', 'Standard', 'Mr.K.N Mehta,90,Amazing Star,Surat,9828492939', '1622783487.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `paper_stocks`
--

DROP TABLE IF EXISTS `paper_stocks`;
CREATE TABLE IF NOT EXISTS `paper_stocks` (
  `p_s_id` int NOT NULL AUTO_INCREMENT,
  `m_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`p_s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paper_stocks`
--

INSERT INTO `paper_stocks` (`p_s_id`, `m_type`) VALUES
(1, 'Glossy'),
(3, 'Matte'),
(4, 'Standard'),
(6, 'Velvet'),
(8, 'velvet');

-- --------------------------------------------------------

--
-- Table structure for table `pcolors`
--

DROP TABLE IF EXISTS `pcolors`;
CREATE TABLE IF NOT EXISTS `pcolors` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pcolors`
--

INSERT INTO `pcolors` (`color_id`, `name`) VALUES
(1, 'Black'),
(2, 'Pink'),
(3, 'Yellow'),
(4, 'Brown'),
(5, 'White'),
(6, 'Maroon'),
(7, 'Blue'),
(8, 'Neavyblue'),
(9, 'Orange'),
(10, 'Gray'),
(16, 'black');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pname` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `p_desc` varchar(700) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `required_data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `min_qty` int NOT NULL,
  `price` int NOT NULL,
  `sub_cat_id` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `sub_cat_id` (`sub_cat_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `p_desc`, `required_data`, `min_qty`, `price`, `sub_cat_id`, `uid`) VALUES
(1, 'Standard Visiting Card', 'Personalized cards with a professional look.\r\nDimensions: 89 x 51 mm,\r\nMore design options available,\r\nStandard glossy Velvet or matte paper included.', 'Name,Address,Mobile,Logo:image', 5, 260, 4, 4),
(2, 'Basic Pens', 'Per Unit Price Rs.50 (10 Pens starts @ Rs.500).\r\nPlastic Material with soft grip. Ink colour : Blue.\r\nMATERIAL DETAILS: Plastic\r\n FEATURES: Includes Grip', 'Logo:image', 3, 50, 11, 4),
(3, 'Men\'s Cotton T-Shirts', '100% Cotton, half-sleeve regular fit t-shirts\r\nCustomise with your logo, photo or text\r\nGreat for corporate events, sporting events and giveaways', 'Logo:image,Text', 5, 250, 16, 4),
(4, 'Photo Coasters', 'Show off favorite memories in a practical way.\r\n4” x 4” size with high-gloss finish,\r\n3 mm thick with durable backing,\r\nUpload your favourite photo, message or monogram,\r\nSold in sets of 4.', 'Photo:image', 5, 480, 7, 4),
(5, 'Envelopes', 'Add a professional touch to every communication with matching envelopes.\r\nAcid-free smooth, matte, bright white 90 gsm paper,\r\nStandard sizes from 146 x 110 mm to 229 x 162 mm.', 'Companyname,Address', 8, 120, 13, 4),
(6, 'Square Visiting Cards', 'Make your unique business stand out,\r\nDimensions : 63.5 x 63.5 mm,\r\nA unique look, great for featuring logos or photos.', 'Name,Address,Mobile,Logo:image', 5, 350, 3, 4),
(7, 'Men’s Office Shirts - Half Sleeve', '65% Polyester & 35% Cotton,\r\nShort sleeve & regular fit,\r\nIdeal for employee uniforms.', 'Logo:image', 3, 700, 18, 6),
(8, 'Customised Banners', 'Durable material, Indoor & outdoor options,Sharp, full-colour printing,Hang your banners easily with optional metal eyelets', 'Photo:image,Title Text,Sub Titles', 10, 200, 26, 6),
(9, 'Custom Mugs', 'Printed Mugs that bring smiles every day!\r\nMug size is 325 ml\r\nPersonalise with photos, logo and more\r\nSharp, high-quality photo printing', 'Photo:image', 2, 250, 6, 6),
(10, 'Birthday Greetings', 'Complete the special occasion by wishing Happy Birthday through these special personalized birthday greetings!', 'Name,BirthdayMessage,Date', 2, 500, 25, 4),
(11, 'Magnetic Calendars', 'The spotlight’s on your business 365 days a year.\r\nFull-colour digital printing on magnetic sheet,\r\nOrder quantities from 1,\r\nCustomise the date pad to any year.', 'Photo:image,Year', 5, 120, 9, 4),
(12, 'Delivery and Postage Labels', 'Make posting letters a breeze with time-saving custom labels.\r\n\r\nLabel your mail for instant brand recognition\r\nEasily write addresses on smooth, matte stock\r\nChoose one of our designs or upload your own\r\nAlso known as Mailing Labels', 'Logo:image,Company Name,Address', 10, 100, 20, 4),
(13, 'Custom Letterheads', 'Add a professional touch to every letter, invoice or quote.\r\n\r\nSize: 213 x 300 mm,\r\nFull colour printing,\r\n120 gsm smooth finish matte paper,\r\nAcid-free paper for durability.', 'Companyname,Message,Address,Mobile', 5, 180, 12, 6),
(14, 'Fleece Jackets', '100% polyester soft finish fabric\r\nFully openable front zippers\r\nStretchable string at waist for adjustment\r\nSuitable for men and women', 'Logo:image', 2, 990, 19, 6),
(15, 'Bulk Posters', 'High-quality posters at affordable prices.\r\n2 poster sizes,\r\nPerfect for walls, doors, windows or notice boards.', 'Headline,Companyname,Message,Phone', 5, 300, 27, 6),
(16, 'Custom Bill Books', 'Perfect for invoices or using as receipt books,\r\nCustomise with your logo and address,Can also be used as – Notepads,\r\nWe don’t provide carbon copy OR pink / yellow copies OR serial numbers', 'Companyname,Phone,Logo:image', 2, 100, 14, 6),
(17, 'Rounded Corner Visiting Cards', 'Lose the corners. Get an edge,\r\nDimensions: 89 x 51 mm,\r\n6 mm rounded corners.', 'Name,Address,Mobile,Logo:image', 7, 350, 2, 6),
(18, 'Personalised Sleek Pens', 'Best for engraving of text and simple images (outlines), not for filled and complex images,\r\nBallpoint pen with metal body & blue ink colour,\r\nCustomisation technology: Laser engraving,\r\nEngraved text will be in white.', 'Text', 3, 140, 11, 6),
(19, 'Laptop Sleeves', 'Slim design laptop sleeve makes it easy to carry your laptop safely as standalone case or in a bag. You can personalise it with your name, brand or Message', 'Name,Photo:image', 5, 420, 24, 7),
(20, 'Engraved Name Plates', 'A distinguished addition to your conference rooms and offices.\r\nBrowse a variety of styles to customise,\r\nDisplay your name and title in a professional way', 'Name,Text', 2, 300, 21, 7),
(22, 'Men\'s Office Shirt - Cambridge', 'Men\'s Office Shirt – Cambridge\r\n100% Cotton. Regular Fit\r\nIdeal for formal uniform & office wear', 'Photo:image', 5, 690, 18, 7),
(23, 'Product & Packaging Labels', 'Add professional branding to your merchandise.\r\nUpload a logo, add a product name or list ingredients\r\nSelf-sticking, printed and delivered in sheets.', 'ProductName,Ingredients,Logo:image', 4, 120, 20, 7),
(24, 'New Year Greeting Cards', 'This new year wish family and friends with your own personalized greeting cards.', 'Comapnyname,Message,Logo:image,Additional Text', 5, 150, 25, 7),
(25, 'Colour Changing Magic Mugs', 'Add hot water and see the magic,\r\nBlack exterior when empty and cool,\r\nPhotos appear when hot liquid is added,\r\nReverts to black when empty & at room temperature,\r\nClean with a sponge. Do not scrub over the images.', 'Photo:image', 5, 450, 6, 7),
(26, 'Magnetic Visiting Cards', 'Convenient Visiting Cards that people keep around.\r\nFull-colour digital printing on magnetic sheet\r\nOrder quantities from 5 to 5000', 'Name,Address,Mobile,Logo:image', 5, 300, 1, 7),
(27, 'Cotton Drawstring Backpacks', 'Drawstring rope closure secures contents. \r\nCotton canvas is lightweight.\r\n100% Cotton, Reusable and Biodegradable.', 'Photo:image', 5, 350, 24, 7),
(28, 'Bookmarks', 'Give book lovers a useful takeaway.\r\nFull-color double-sided printing.', 'Message,Photo:image', 5, 100, 29, 7),
(29, 'Desk Calendars 2021', 'Free Professional Design Assistance, Alignments, and Quality Checks at Every Step', 'Photo:image', 5, 180, 9, 4),
(30, 'Wedding Invitation', 'Comes with 90 GSM Plain Envelopes,\r\nAvailable In 4 Paper Stock.', 'Bridename,Groomname,Venue,Date', 5, 215, 5, 4),
(31, 'Standard Posters', 'Best suited for indoor placement\r\nAvailable In Four Diffrent Paperstock', 'Headline,Message', 5, 140, 27, 4),
(32, 'Regular Bookmarks', 'These regular (2x6 in) bookmarks are the most preferred size chosen by readers. Available in 350gsm Coated Card and Synthetic non-tearable paper type. Order from just 10 pcs!', 'Photo:image,Message', 8, 50, 29, 6),
(33, 'Square Coaster', 'Customize these rounded corner square coasters with your designs. Made from high grade MDF material.', 'Message,Photo:image', 3, 380, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product_attrs`
--

DROP TABLE IF EXISTS `product_attrs`;
CREATE TABLE IF NOT EXISTS `product_attrs` (
  `p_a_id` int NOT NULL AUTO_INCREMENT,
  `size_id` int DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pid` int NOT NULL,
  PRIMARY KEY (`p_a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_attrs`
--

INSERT INTO `product_attrs` (`p_a_id`, `size_id`, `color_id`, `url`, `pid`) VALUES
(1, 1, 5, '16217626110.jpg', 1),
(3, 3, 6, '16217655810.jpg', 3),
(4, 5, 1, '16217666961.jpg', 3),
(6, 6, 0, NULL, 3),
(7, 4, 0, NULL, 3),
(8, 7, 0, NULL, 4),
(9, 8, 5, '16217684000.jpg', 5),
(10, 9, 2, '16217684011.jpg', 5),
(11, 10, 0, NULL, 5),
(12, 11, 0, NULL, 5),
(13, 12, 1, '16217688950.jpg', 6),
(14, 13, 5, '16217688951.jpg', 6),
(15, 3, 7, '16217699940.jpg', 7),
(16, 5, 5, '16217699941.jpg', 7),
(17, 4, 1, '16217699942.jpg', 7),
(18, 14, 0, NULL, 8),
(19, 15, 0, NULL, 8),
(20, 16, 1, '16217711350.jpg', 9),
(21, 17, 5, '16217711351.jpg', 9),
(22, 9, 0, NULL, 10),
(23, 0, 1, '16217742400.jpg', 11),
(24, 0, 5, '16217742401.jpg', 11),
(25, 0, 0, NULL, 12),
(26, 18, 0, NULL, 13),
(27, 3, 1, '16218744440.jpg', 14),
(28, 5, NULL, NULL, 14),
(29, 6, NULL, NULL, 14),
(30, 4, NULL, NULL, 14),
(31, 9, NULL, NULL, 15),
(32, 10, NULL, NULL, 15),
(33, 19, NULL, NULL, 15),
(34, 0, NULL, NULL, 16),
(35, 1, 5, '16218756870.jpg', 17),
(36, 0, 1, '16218757771.jpg', 17),
(37, 0, 1, '16218763650.jpg', 18),
(38, 0, NULL, NULL, 19),
(39, 0, NULL, NULL, 20),
(40, 0, NULL, NULL, 21),
(41, 3, 1, '16219611910.jpg', 22),
(42, 5, 5, '16219611911.jpg', 22),
(43, 6, 7, '16219612222.jpg', 22),
(44, 4, NULL, NULL, 22),
(45, 0, NULL, NULL, 23),
(46, 9, NULL, NULL, 24),
(47, 0, NULL, NULL, 25),
(48, 0, NULL, NULL, 26),
(49, 0, 6, '16220458030.jpg', 27),
(50, 0, 7, '16220458031.jpg', 27),
(51, 0, NULL, NULL, 28),
(52, 0, NULL, NULL, 29),
(53, 0, NULL, NULL, 30),
(54, 8, NULL, NULL, 31),
(55, 0, NULL, NULL, 32),
(56, 0, NULL, NULL, 33);

-- --------------------------------------------------------

--
-- Table structure for table `psizes`
--

DROP TABLE IF EXISTS `psizes`;
CREATE TABLE IF NOT EXISTS `psizes` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `psizes`
--

INSERT INTO `psizes` (`size_id`, `size`) VALUES
(1, '89 x 51'),
(2, '296 x 210'),
(3, 'S'),
(4, 'XL'),
(5, 'M'),
(6, 'L'),
(7, '4” x 4”'),
(8, '146 x 110'),
(9, '190 x 120'),
(10, '229 x 162'),
(11, '241 x 105'),
(12, '64 x 64'),
(13, '63.5 x 63.5'),
(14, '76 x 122'),
(15, '52 x 91'),
(16, '325 ml'),
(17, '450 ml'),
(18, '213 x 300'),
(19, '16 x 20'),
(20, '3*2');

-- --------------------------------------------------------

--
-- Table structure for table `p_images`
--

DROP TABLE IF EXISTS `p_images`;
CREATE TABLE IF NOT EXISTS `p_images` (
  `p_i_id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pid` int NOT NULL,
  PRIMARY KEY (`p_i_id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `p_images`
--

INSERT INTO `p_images` (`p_i_id`, `url`, `pid`) VALUES
(1, '16217626110.jpg', 1),
(2, '16217626111.jpg', 1),
(3, '16217626112.png', 1),
(4, '16217626113.png', 1),
(6, '16217630031.jpg', 2),
(22, '16217654620.jpg', 3),
(23, '16217654621.jpg', 3),
(24, '16217654632.jpg', 3),
(25, '16217676200.jpg', 4),
(26, '16217676211.jpg', 4),
(27, '16217676212.jpg', 4),
(28, '16217683990.jpg', 5),
(29, '16217683991.jpg', 5),
(30, '16217684002.jpg', 5),
(31, '16217684003.jpg', 5),
(34, '16217688952.jpg', 6),
(36, '16217689680.png', 6),
(37, '16217690260.jpg', 6),
(39, '16217699931.jpg', 7),
(40, '16217699942.jpg', 7),
(41, '16217700520.jpg', 7),
(42, '16217706850.jpg', 8),
(43, '16217706851.jpg', 8),
(44, '16217706852.jpg', 8),
(45, '16217706853.jpg', 8),
(47, '16217711351.jpg', 9),
(48, '16217711352.jpg', 9),
(49, '16217711353.jpg', 9),
(52, '16217730980.jpg', 10),
(53, '16217742390.jpg', 11),
(54, '16217742401.jpg', 11),
(55, '16217742402.jpg', 11),
(56, '16217749450.jpg', 12),
(57, '16217749451.jpg', 12),
(62, '16218734080.jpg', 13),
(63, '16218734081.jpg', 13),
(64, '16218734092.jpg', 13),
(65, '16218744440.jpg', 14),
(66, '16218744441.jpg', 14),
(67, '16218744442.jpg', 14),
(68, '16218749360.jpg', 15),
(69, '16218749361.jpg', 15),
(70, '16218749362.jpg', 15),
(71, '16218749373.jpg', 15),
(72, '16218754440.jpg', 16),
(73, '16218754441.jpg', 16),
(74, '16218754452.jpg', 16),
(75, '16218754453.jpg', 16),
(76, '16218756860.jpg', 17),
(77, '16218756861.jpg', 17),
(78, '16218756862.jpg', 17),
(79, '16218757770.jpg', 17),
(81, '16218763090.jpg', 18),
(82, '16218763970.jpg', 18),
(85, '16219588820.jpg', 19),
(86, '16219588831.jpg', 19),
(87, '16219588832.jpg', 19),
(88, '16219588833.jpg', 19),
(89, '16219602000.jpg', 20),
(90, '16219602011.jpg', 20),
(91, '16219608720.jpg', 21),
(92, '16219608721.png', 21),
(93, '16219611910.jpg', 22),
(94, '16219612780.jpg', 22),
(95, '16219612781.jpg', 22),
(96, '16219612792.jpg', 22),
(97, '16219620400.jpg', 23),
(98, '16219622620.jpg', 24),
(99, '16220446760.jpg', 25),
(100, '16220446761.jpg', 25),
(103, '16220450612.jpg', 26),
(104, '16220452020.jpg', 26),
(105, '16220452021.png', 26),
(106, '16220458030.jpg', 27),
(107, '16220458460.jpg', 27),
(108, '16220458471.jpg', 27),
(109, '16220468440.jpg', 28),
(110, '16220468441.jpg', 28),
(111, '16220468442.jpg', 28),
(112, '16220473360.jpg', 29),
(113, '16220473361.jpg', 29),
(120, '16220487170.jpg', 30),
(121, '16220487181.png', 30),
(122, '16221322940.png', 31),
(125, '16221343210.jpg', 32),
(126, '16221344320.jpg', 32),
(130, '16221355962.jpg', 33),
(131, '16221356450.jpg', 33),
(132, '16221356461.jpg', 33);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `rating` float NOT NULL,
  `r_desc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `pid` (`pid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`r_id`, `rating`, `r_desc`, `pid`, `uid`) VALUES
(1, 3, 'Nice Design', 1, 3),
(2, 4, 'good product', 1, 3),
(3, 2, 'Good Support', 2, 2),
(4, 4, 'Good Printing Quality', 4, 2),
(5, 3, 'Nice', 6, 8),
(6, 5, 'Best For Office Wear', 7, 3),
(7, 1, 'Nice!!', 15, 3),
(8, 3, 'Excellent Designs', 11, 2),
(9, 4, 'Very Nice', 27, 2),
(10, 3, 'New And Clear Designs......', 16, 10),
(11, 5, 'Best Ever Card For Wedding', 30, 9),
(12, 2, 'Nice', 19, 10),
(13, 3, 'Excellent', 25, 10),
(14, 3, 'Nice', 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `sub_cat_id` int NOT NULL AUTO_INCREMENT,
  `s_c_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cat_id` int NOT NULL,
  PRIMARY KEY (`sub_cat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`sub_cat_id`, `s_c_name`, `cat_id`) VALUES
(1, 'Magnetic Visiting Card', 1),
(2, 'Rounded Corner Visiting Card', 1),
(3, 'Square Visiting Card', 1),
(4, 'Standard Visiting Card', 1),
(5, 'Wedding Invitation', 2),
(6, 'Mugs', 3),
(7, 'Photo Gifts', 3),
(9, 'Calender', 3),
(11, 'Pens', 6),
(12, 'Letterhead', 6),
(13, 'Envelopes', 6),
(14, 'Bill Book', 6),
(16, 'T-shirts', 10),
(18, 'Shirt', 10),
(19, 'Jacket', 10),
(20, 'Labels', 6),
(21, 'Sign', 6),
(24, 'Laptop Sleeves And Bags', 10),
(25, 'Greeting Cards', 2),
(26, 'Banner', 11),
(27, 'Poster', 11),
(28, 'Face Mask', 12),
(29, 'Bookmarks', 6),
(30, 'Square Visiting Card', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobile` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dob` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pincode` int NOT NULL,
  `terms` int NOT NULL,
  `status` int NOT NULL COMMENT '0-admin,1-user,2-agency,3-deliverboy',
  `token` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `u_status` int DEFAULT NULL COMMENT '0-active,1-deactive',
  `url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `mobile`, `email`, `password`, `dob`, `address`, `pincode`, `terms`, `status`, `token`, `u_status`, `url`) VALUES
(1, 'Sakshi', '8969694939', 'admin123@gmail.com', 'admin#123', '12-10-2001', 'Nana Varachha,Surat', 395010, 1, 0, NULL, NULL, '1621753502.jpg'),
(2, 'Bali ', '9897986435', 'balipatel123@gmail.com', 'Bali#123', '10-12-1999', 'Mota Varachha,Surat', 395008, 1, 1, NULL, 0, NULL),
(3, 'Dhruvisha ', '8758593238', 'asodariyadhruvi317@gmail.com', 'Dhruvi@12', '31-07-2000', 'Jakatnaka,Surat', 395013, 1, 1, '263644', 0, NULL),
(4, 'Drashti ', '9099175620', 'drashtialagiya23@gmail.com', 'Drashti#09', '23-06-2001', 'Pedar Road,Mota Varachha,Surat', 394101, 1, 2, NULL, 0, NULL),
(5, 'Brinda ', '7869509797', 'brindabhalala@gmail.com', 'Brinda@90', '01-02-2001', 'Katargam,Surat', 395008, 1, 1, NULL, 0, NULL),
(6, 'Ayushi ', '7898908657', 'ayushiambliya@gmail.com', 'Ayushi@123', '03-01-2001', 'Bombay Market,Surat', 395008, 1, 2, NULL, 0, NULL),
(7, 'Chandani ', '7567095622', 'chandanikhanesha@gmail.com', 'Chandani@123', '09-05-2001', 'Surat,Gujarat', 395006, 1, 2, NULL, 0, NULL),
(8, 'Kunika ', '9848473848', 'kunikadhaduk@gmail.com', 'Kunika#105', '15-05-2001', 'Amroli,surat', 394107, 1, 1, NULL, 0, NULL),
(9, 'Keyuri ', '6729282828', 'keyuridomadiya@gmail.com', 'Keyuri#123', '04-07-2000', 'Surat,Gujarat', 395006, 1, 1, NULL, 0, NULL),
(10, 'Bansi ', '8979898989', 'bansiradadiya@gmail.com', 'Bansi#789', '09-08-2001', 'Yogichowk,Surat', 395010, 1, 1, NULL, 0, NULL),
(11, 'Harshad', '8738383838', 'harshadantala2@gmail.com', 'Harshad@123', '12-02-2000', 'surat', 395010, 0, 1, NULL, 1, NULL),
(12, 'Sharda', '9714498494', 'sharda43@gmail.com', 'Sharda#123', '22-05-1998', 'Surat,Gujarat', 395006, 1, 1, NULL, 0, NULL),
(13, 'Jay Antala', '7359551055', 'jayantala123@gmail.com', 'Jay#123', '06-06-1996', 'Nana Varachha,Surat', 395006, 0, 3, NULL, 0, NULL),
(14, 'Henil Patel', '7046590370', 'henilpatel@gmail.com', 'Henil@90', '03-01-2001', 'Nanpura,Surat', 395001, 0, 3, NULL, 0, NULL),
(15, 'Jemin Alagiya', '6730928383', 'jeminalagiya@gmail.com', 'Jemin@89', '10-01-1997', 'Suncity Society,Pedar Road,Surat', 394101, 0, 3, NULL, 0, NULL),
(16, 'Brijesh Asodariya', '7849393949', 'brijeshasodariya@gmail.com', 'Brijesh#15', '08-06-1995', '21,Sangana Society,Surat', 396001, 0, 3, NULL, 0, NULL),
(17, 'Rahul Raiyani', '8929869012', 'rahulraiyani125@gmail.com', 'Rahul@21', '04-07-1991', 'Kuber Nagar,Surat', 382340, 0, 3, NULL, 0, NULL),
(18, 'Deep Senjaliya', '7805678383', 'deepsenjaliya123@gmail.com', 'Deep#12', '06-06-1995', '20,Vardhman Society,Surat', 395013, 0, 3, NULL, 0, NULL),
(19, 'sakshi', '7779479467', 'sakshiantala553@gmail.com', 'Sakshi@123', '10-12-2001', 'Surat', 395006, 1, 1, NULL, 0, NULL),
(20, 'Jemin Alagiya', '7486746779', 'jeminalagiya1@gmail.com', 'Jemin@1', '10-12-2001', '23,surat', 394101, 0, 3, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`w_id`),
  KEY `pid` (`pid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`w_id`, `pid`, `uid`) VALUES
(1, 9, 3),
(2, 22, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
