-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2019 at 09:10 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LEO_RUAN`
--
CREATE DATABASE IF NOT EXISTS `LEO_RUAN` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `LEO_RUAN`;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
CREATE TABLE `Comments` (
  `CommentId` int(11) NOT NULL,
  `UserName` text DEFAULT NULL,
  `UserRating` float DEFAULT NULL,
  `UserComment` text DEFAULT NULL,
  `BelongStore` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`CommentId`, `UserName`, `UserRating`, `UserComment`, `BelongStore`, `UserId`) VALUES
(1, 'Baljeet Kaur', 8.9, 'We had an office function the other day and we brought in two platters of assorted sandwiches from Subway and everybody enjoyed it. This is a great place to do a late catering job at the office. We received excellent service.', 4, 1),
(2, 'Mehakpreet Kaur', 1, 'Bad experience there were 2 girls Rajdeep Sandhu and Navdeep they both don\'t know what is customer service .Me and My friend ordered their, they were talking to us like a forcefuly. Am \r\n also working  but am not behaving like this .they should know how to deal  in front of customers . I said thanku she was like OK .Srsly Worst experience second time. But this Time it was poor service.', 4, 1),
(3, 'Sandi Hildebrant', 9, 'Went in for coffee.Inexpensive hot and fresh. The server was available immediately and I was on my way.', 4, 1),
(4, 'Manny Dhaliwal', 7, 'Good food. But there\'s Always homeless people waiting at the end of drive through. There\'s also too many weird people that eat inside', 3, 1),
(5, 'Rae Lynch', 6.3, 'This is one my my better experiences at McDonalds. Alright food with very cheap prices. \r\nThis location is so busy that the line can take a bit. \r\nThankfully our orders were fulfilled with no error', 3, 1),
(9, '123ismyname', 10, '123', 3, 5),
(10, '123', 9, '', 1, 4),
(11, 'test2', 10, 'This is a nice place to get some exercises! Highly recommended!', 2, 10),
(19, 'leo1', 1, 'Too pricy.', 2, 12),
(21, 'leo1', 8, 'This place is good enough for a decent meal', 7, 12),
(22, 'leo1', 0, 'This place is very dirty, they do not clean the place!!', 13, 12),
(23, 'leo1', 7.2, 'Not a bad place to visit and have meatballs', 14, 12),
(24, 'leo1', 9.9, 'My goto bestbuy in town. ', 16, 12);

-- --------------------------------------------------------

--
-- Table structure for table `Merchandise`
--

DROP TABLE IF EXISTS `Merchandise`;
CREATE TABLE `Merchandise` (
  `MerchandiseId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `StoreId` int(11) NOT NULL,
  `weeklyEarning` float DEFAULT NULL,
  `MerchandiseName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders` (
  `OrderId` int(11) NOT NULL,
  `OrderEmail` text DEFAULT NULL,
  `OrderName` varchar(255) DEFAULT NULL,
  `OrderNumber` varchar(255) DEFAULT NULL,
  `OrderAddress` text DEFAULT NULL,
  `OrderProcessed` bit(1) DEFAULT NULL,
  `OrderComplete` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Rewards`
--

DROP TABLE IF EXISTS `Rewards`;
CREATE TABLE `Rewards` (
  `RewardId` int(11) NOT NULL,
  `RewardName` varchar(255) NOT NULL,
  `RewardDescription` text DEFAULT NULL,
  `RewardImage` text DEFAULT NULL,
  `RewardPoints` int(11) DEFAULT NULL,
  `RewardQuantityLeft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rewards`
--

INSERT INTO `Rewards` (`RewardId`, `RewardName`, `RewardDescription`, `RewardImage`, `RewardPoints`, `RewardQuantityLeft`) VALUES
(1, 'IPhone 11', 'The newest IPhone made by apple', 'src/Rewards/iphone.png', 200000, 1),
(2, 'Amazon Gift Card', 'A $25 amazon gift card', 'src/Rewards/amazon.png', 1000, 10),
(3, 'White Mug', 'A white mug that you can engrave anything on for free', 'src/Rewards/mug.png', 500, 999),
(4, 'Google Cardboard', 'An easy to setup VR device created by Google', 'src/Rewards/googleCardboard.png', 1200, 5),
(5, 'Portable AC', 'Easy to install portable air conditioner', 'src/Rewards/ac.png', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Store`
--

DROP TABLE IF EXISTS `Store`;
CREATE TABLE `Store` (
  `StoreId` int(11) NOT NULL,
  `StoreName` varchar(255) NOT NULL,
  `StoreAddress` varchar(255) DEFAULT NULL,
  `StoreImage` text DEFAULT NULL,
  `StoreHours` text DEFAULT NULL,
  `StoreRatings` float DEFAULT NULL,
  `StorePointsPerDollar` int(11) DEFAULT NULL,
  `StorePriceAverage` int(11) DEFAULT NULL,
  `StoreLink` text DEFAULT NULL,
  `StoreType` varchar(31) DEFAULT NULL,
  `StoreDes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Store`
--

INSERT INTO `Store` (`StoreId`, `StoreName`, `StoreAddress`, `StoreImage`, `StoreHours`, `StoreRatings`, `StorePointsPerDollar`, `StorePriceAverage`, `StoreLink`, `StoreType`, `StoreDes`) VALUES
(1, 'Costco', '7423 King George Blvd, Surrey, BC V3W 5A8', 'src/Stores/Costco', '09:00am_05:00pm 09:00am_08:30pm 09:00am_08:30pm 09:00am_08:30pm 09:00am_08:30pm 09:00am_08:30pm 09:00am_06:00pm \r\n\r\n', 9, 5, -1, 'https://www.costco.ca/warehouse-locations/surrey-BC-55.html', 'Shop', 'Members-only warehouse selling a huge variety of items including bulk groceries, electronics & more.'),
(2, 'Guildford Recreation Centre', '15105 105 Ave, Surrey, BC V3R 7G8', 'src/Stores/GuildfordRecreationCentre', '08:00am_08:00pm 06:00am_10:00pm 06:00am_10:00pm 06:00am_10:00pm 06:00am_10:00pm 06:00am_10:00pm 08:00am_08:00pm', 5.5, 2, 7, 'https://www.surrey.ca/culture-recreation/1876.aspx', 'Activity', 'Visit the pool, weight room, gym and indoor track for all your fitness needs in Guildford!\r\n'),
(3, 'McDonald\'s', '10240 King George Blvd, Surrey, BC V3T 2W5', 'src/Stores/McDonald\'s', '12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm \r\n12:00am_11:59pm ', 7.8, 2, 12, 'https://www.mcdonalds.com/ca/en-ca/restaurant-locator.html', 'Food', 'Classic, long-running fast-food chain known for its burgers, fries & shakes.'),
(4, 'Subway', '10153 King George Boulevard Central City Mall, Surrey, BC V3T 2W1', 'src/Stores/Subway', '09:30am_06:30pm 07:00am_06:30pm 07:00am_06:30pm 07:00am_09:30pm 07:00am_09:30pm 07:00am_09:30pm 08:00am_06:30pm \r\n', 6.3, 2, 12, 'https://www.subway.com/en-CA', 'Food', 'Casual counter-serve chain for build-your-own sandwiches & salads.'),
(6, 'Tong Louie Family YMCA', '14988 57 Ave, Surrey, BC V3S 7S6', 'src/Stores/TongYMCA', '07:00am_09:00pm 05:00am_10:00pm 05:00am_10:00pm 05:00am_10:00pm 05:00am_10:00pm 05:00am_10:00pm 07:00am_09:00pm ', 10, 3, 7, 'https://gv.ymca.ca/Locations/Surrey/Newton/Tong-Louie-Family-YMCA', 'Activity', 'Non-profit organization in Surrey, British Columbia.'),
(7, 'Bubble 88', '10209 King George Blvd #102, Surrey, BC V3T 2W6', 'src/Stores/Bubble88', '11:00am_10:30pm 11:00am_10:30pm 11:00am_10:30pm 11:00am_10:30pm 11:00am_10:30pm 11:00am_11:30pm 11:00am_11:30pm ', 8, 4, 10, 'http://www.bubble88.com/', 'Food', 'Contemporary site with a full menu of Taiwanese eats, combos & creative bubble tea drinks.'),
(8, 'Save-On-Foods', '10312 King George Blvd, Surrey, BC V3T 2W5', 'src/Stores/SaveOn', '07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm \r\n', 10, 3, -1, 'https://www.saveonfoods.com/store/king-george/', 'Shop', 'Save-On-Foods committed to our customers – in fact, we go so far as to pledge that we’ll go the extra mile, each and every day.'),
(9, 'Round-Up Cafe', '10449 King George Blvd, Surrey, BC V3T 1Z8', 'src/Stores/RoundupCafe', '07:00am_05:00pm 07:00am_05:00pm 07:00am_05:00pm 07:00am_05:00pm 07:00am_05:00pm 07:00am_05:00pm 07:00am_05:00pm \r\n', 10, 2, 20, 'https://www.whalleyroundupcafe.com/', 'Food', 'Easygoing \'50s-style diner serving Canadian & Ukrainian cuisine such as eggs, pies & sandwiches.'),
(10, 'Bon Ga Korean Restaurant', '10356 Whalley Blvd, Surrey, BC V3T 4H4', 'src/Stores/Bonga', 'Closed_Closed 10:00am_08:00pm 10:00am_11:00pm 10:00am_08:00pm 10:00am_11:00pm 10:00am_11:00pm 10:00am_11:00pm \r\n', 10, 4, 15, 'https://www.bongakoreanrestaurant.com/', 'Food', 'Bon Ga Korean Restaurant is a Korean restaurant located in Surrey, British Columbia. Our loyal customers continue to return due to our outstanding Korean cuisine, excellent service, and friendly staff.'),
(11, 'Club16 Trevor Linden Fitness', 'Central City Mall, 10153 King George Blvd #3400, Surrey, BC V3T 2W1', 'src/Stores/Club16', '08:00am_05:00pm 05:00am_10:00pm 05:00am_10:00pm 05:00am_10:00pm 05:00am_10:00pm 05:00am_09:00pm 08:00am_05:00pm \r\n', 10, 6, 8, 'trevorlindenfitness.com/surrey-central-city/', 'Activity', 'Premium Quality Value Priced Fitness Clubs'),
(12, 'Real Canadian Superstore', '14650 104 Ave, Surrey, BC V3R 1M3', 'src/Stores/Superstore', '07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm \r\n', 10, 3, -1, 'https://www.realcanadiansuperstore.ca/store-locator/?storeId=1556&utm_source=G&utm_medium=LPM&utm_campaign=Loblaws', 'Shop', NULL),
(13, 'Burger King', '10344 King George Blvd, Surrey, BC V3T 2W5', 'src/Stores/BurgerKing', '06:00am_11:59pm 05:30am_11:59pm 05:30am_11:59pm 05:30am_11:59pm 05:30am_11:59pm 05:30am_11:59pm 06:00am_11:59pm \r\n', 0, 2, 10, 'https://locations.burgerking.ca/bc/surrey/10344-king-george-blvd.html', 'Food', 'Well-known fast-food chain serving grilled burgers, fries & shakes, plus breakfast.'),
(14, 'IKEA Coquitlam', '1000 Lougheed Hwy, Coquitlam, BC V3K 3T5', 'src/Stores/Ikea', '10:00am_07:00pm 10:00am_07:00pm 10:00am_09:00pm 10:00am_09:00pm 10:00am_09:00pm 10:00am_09:00pm 10:00am_08:00pm \r\n', 7.2, 5, -1, 'https://www.ikea.com/ca/en/stores/coquitlam-store-index-pub99c18e3a', 'Shop', 'Furniture store in Coquitlam, British Columbia'),
(16, 'Best Buy', '10153 King George Blvd Unit 3200, Surrey, BC V3T 2W1', 'src/Stores/BestBuy', '11:00am_06:00pm 10:00am_06:00pm 10:00am_09:00pm 10:00am_09:00pm 10:00am_09:00pm 10:00am_09:00pm 10:00am_09:00pm \r\n', 9.9, 1, -1, 'https://stores.bestbuy.ca/en-ca/bc/surrey/10153-king-george-highway-unit-3200', 'Shop', 'Chain retailer with a large array of brand-name electronics, computers, appliances & more.'),
(17, 'Walmart', '2151 - 10153 King George Blvd Unit 802, Surrey, BC V3T 2W3', 'src/Stores/Walmart', '07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm 07:00am_11:00pm \r\n', 10, 2, -1, 'https://www.walmart.ca/en/stores-near-me/surrey-store-1205?utm_source=SurreySupercentre&utm_medium=GMB', 'Shop', 'Department store in Surrey, British Columbia'),
(18, 'PoCo Bowl', '2263 McAllister Ave, Port Coquitlam, BC V3C 2A9', 'src/Stores/PoCo', '09:00am_11:00pm 09:00am_10:00pm 09:00am_10:00pm 09:00am_10:00pm 09:00am_10:00pm 09:00am_11:00pm 09:00am_11:00pm ', 10, 2, 20, 'http://www.pcbowl.shawbiz.ca/index.html', 'Activity', 'Bowling alley in Port Coquitlam, British Columbia'),
(19, 'QianDao hotpot', 'T&T Parking Entrance, 10153 King George Blvd Unit1A #3000, Surrey, BC V3T 2W1', 'src/Stores/QianDao', '11:30am_09:30pm 11:30am_09:30pm 11:30am_09:30pm 11:30am_09:30pm 11:30am_09:30pm 11:30am_09:30pm 11:30am_09:30pm ', 10, 5, 20, 'https://www.yelp.ca/biz/qiandao-hotpot-%E7%AD%BE%E9%81%93-surrey', 'Food', NULL),
(20, 'T&T Supermarket', 'Central City Shopping Centre 3000 Central City, 10153 King George Blvd, Surrey, BC V3T 2W1', 'src/Stores/tnt', '09:00am_09:00pm 09:00am_09:00pm 09:00am_09:00pm 09:00am_09:00pm 09:00am_09:00pm 09:00am_09:00pm 09:00am_09:00pm ', 10, 3, -1, 'https://www.tnt-supermarket.com/', 'Shop', 'Asian grocery store'),
(21, 'Central City Liquor Store', '13450 102 Ave, Surrey, BC V3T 5X4', 'src/Stores/CentralLiquor', '09:00am_11:00pm 09:00am_11:00pm 09:00am_11:00pm 09:00am_11:00pm 09:00am_11:00pm 09:00am_11:00pm 09:00am_11:00pm ', 10, 4, -1, 'https://centralcity.ca/store/central-city-liquor-store/', 'Shop', NULL),
(22, 'Church\'s Chicken', '10542 King George Blvd, Surrey, BC V3T 2X2', 'src/Stores/Churchs', '12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm 12:00am_11:59pm \r\n12:00am_11:59pm ', 10, 3, 10, 'https://www.churchschicken.ca/british-columbia/locations/', 'Food', 'Fast-food chain offering fried chicken, sandwiches, wings & Southern-influenced sides.'),
(23, 'North Surrey Recreation Centre', '10275 City Pkwy, Surrey, BC V3T 4C3', 'src/Stores/NorthSurreyRec', '08:00am_08:00pm 06:00am_09:00pm 06:00am_09:00pm 06:00am_09:00pm 06:00am_10:00pm 06:00am_09:00pm \r\n07:00am_08:00pm ', 10, 4, 7, 'https://www.surrey.ca/culture-recreation/5048.aspx', 'Activity', 'Recreation center in Surrey, British Columbia');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `UserEmail` text DEFAULT NULL,
  `UserPassword` text DEFAULT NULL,
  `UserFavoriteStoreId` text DEFAULT NULL,
  `IsAdmin` bit(1) NOT NULL,
  `StorePoints` int(11) DEFAULT NULL,
  `IsMerchandise` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `UserName`, `UserEmail`, `UserPassword`, `UserFavoriteStoreId`, `IsAdmin`, `StorePoints`, `IsMerchandise`) VALUES
(7, 'Admin', 'Admin@rewardX.com', 'c6754975cfeef58ef452da205e21fa0c075452dadbf20c5d614faae8cefd75c8c4cb06ec67eed8249eca49bde0a8c699d25c271f8584400d2e78a0e18c3c7ec0', NULL, b'1', 0, b'0'),
(8, 'testuser', 'test@test.com', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', NULL, b'0', 100000000, b'0'),
(9, '123', 'celia@sfu.ca', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '3', b'0', 0, b'0'),
(10, 'test2', 'test2@test.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '1,2', b'0', 0, b'0'),
(11, '123', 'test3@sfu.ca', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, b'0', 0, b'0'),
(12, 'leo1', 'leoleoleo@sfu.ca', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '2,4', b'0', 500, b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentId`),
  ADD KEY `BelongStore` (`BelongStore`);

--
-- Indexes for table `Merchandise`
--
ALTER TABLE `Merchandise`
  ADD PRIMARY KEY (`MerchandiseId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- Indexes for table `Rewards`
--
ALTER TABLE `Rewards`
  ADD PRIMARY KEY (`RewardId`);

--
-- Indexes for table `Store`
--
ALTER TABLE `Store`
  ADD PRIMARY KEY (`StoreId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Merchandise`
--
ALTER TABLE `Merchandise`
  MODIFY `MerchandiseId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Rewards`
--
ALTER TABLE `Rewards`
  MODIFY `RewardId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Store`
--
ALTER TABLE `Store`
  MODIFY `StoreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`BelongStore`) REFERENCES `Store` (`StoreId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
