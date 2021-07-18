-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2021 at 08:16 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `item` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` text COLLATE utf8_bin NOT NULL,
  `day` text COLLATE utf8_bin NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `item`, `date`, `day`, `total`) VALUES
(132, '9', '1619911129', '1619902800', 0),
(133, '8', '1620170329', '1619902800', 0),
(134, '7', '1620170329', '1619902800', 0),
(135, '5', '1620170329', '1619730000', 0),
(136, '4', '1620170329', '1619730000', 0),
(137, '9', '1620173760', '1619730000', 0),
(138, '8', '1620173760', '1619730000', 0),
(139, '8', '1620173760', '1619730000', 0),
(140, '7', '1620173760', '1619816400', 0),
(141, '4', '1620173760', '1619816400', 0),
(142, '6', '1620173760', '1619816400', 0),
(143, '3', '1620173760', '1619816400', 0),
(144, '1', '1620173760', '1619816400', 0),
(146, '9', '1620173973', '1620075600', 0),
(147, '8', '1620173973', '1620075600', 0),
(148, '10', '1620173973', '1620075600', 0),
(149, '5', '1620173973', '1619989200', 0),
(150, '7', '1620173973', '1620162000', 0),
(151, '1', '1620173973', '1620162000', 0),
(152, '6', '1620173973', '1620162000', 0),
(153, '5', '1620173973', '1620162000', 0),
(154, '7', '1620173973', '1620162000', 0),
(155, '9', '1620173973', '1620162000', 0),
(156, '10', '1620240128', '1620162000', 0),
(157, '9', '1620289962', '1620248400', 0),
(158, '9', '1620289962', '1620248400', 0),
(159, '9', '1620289962', '1620248400', 0),
(160, '9', '1620289962', '1620248400', 0),
(161, '9', '1620289962', '1620248400', 0),
(162, '9', '1620289962', '1620248400', 0),
(163, '9', '1620289962', '1620248400', 0),
(164, '9', '1620289962', '1620248400', 0),
(165, '9', '1620289962', '1620248400', 0),
(166, '9', '1620289962', '1620248400', 0),
(167, '9', '1620289962', '1620248400', 0),
(168, '9', '1620291034', '1620248400', 0),
(169, '10', '1620291034', '1620248400', 0),
(170, '11', '1620291034', '1620248400', 0),
(171, '9', '1620291034', '1620248400', 0),
(172, '10', '1620291034', '1620248400', 0),
(173, '10', '1620291034', '1620248400', 0),
(174, '11', '1620291034', '1620248400', 0),
(175, '9', '1620291034', '1620248400', 0),
(176, '10', '1620291034', '1620248400', 0),
(177, '9', '1620291034', '1620248400', 0),
(178, '10', '1620291034', '1620248400', 0),
(179, '11', '1620291034', '1620248400', 0),
(180, '10', '1620291034', '1620248400', 0),
(181, '11', '1620291034', '1620248400', 0),
(182, '10', '1620291034', '1620248400', 0),
(183, '9', '1620291034', '1620248400', 0),
(184, '9', '1620291034', '1620248400', 0),
(185, '9', '1620291034', '1620248400', 0),
(186, '10', '1620291034', '1620248400', 0),
(187, '11', '1620291034', '1620248400', 0),
(188, '11', '1620312721', '1620248400', 0),
(189, '10', '1620312721', '1620248400', 0),
(190, '6', '1620312721', '1620248400', 0),
(191, '11', '1620416963', '1620334800', 0),
(192, '9', '1620416963', '1620334800', 0),
(193, '1', '1620417620', '1620334800', 0),
(194, '5', '1620417620', '1620334800', 0),
(195, '10', '1620424081', '1620421200', 0),
(196, '9', '1620424081', '1620421200', 0),
(197, '9', '1620424874', '1620421200', 0),
(198, '10', '1620424874', '1620421200', 0),
(199, '10', '1620424991', '1620421200', 370),
(200, '11', '1620424991', '1620421200', 370),
(201, '12', '1620425226', '1620421200', 100),
(202, '9', '1620425574', '1620421200', 1370);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` varchar(50) COLLATE utf8_bin NOT NULL,
  `img` text COLLATE utf8_bin NOT NULL,
  `sales` int NOT NULL DEFAULT '0',
  `unique_sale` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `info`, `price`, `img`, `sales`, `unique_sale`) VALUES
(1, 'iPhone X', 'iPhone x Brand New', '600', 'https://www.ivory.co.il/files/catalog/org/1604916386z86XE.jpg', 5, 3),
(2, 'MacBook Pro', 'MacBook Pro Brand New', '2300', 'https://creatixcdn.azureedge.net/fetch/pc365/w_380,h_285,mode_pad,v_5/https://www.pc365.co.il/images/mbp-silver-select-202011.jpg', 2, 1),
(3, 'Samsung Galaxy S10', 'S10 Brand New', '500', 'https://d3m9l0v76dty0.cloudfront.net/system/photos/6138136/large/00acf03f9d044d3136d05ff839bc7151.jpg', 2, 1),
(4, 'iPad Pro', 'iPad Pro Brand New', '1200', 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/refurb-ipad-pro-12-wifi-spacegray-2019?wid=1000&hei=1000&fmt=jpeg&qlt=95&.v=1581985543977', 5, 3),
(5, 'Hp EliteBook G6', 'HP EliteBook Used', '1400', 'https://cashcow-cdn.azureedge.net/images/ad0e9a3f-92e3-4272-b5a3-9911357667d7.webp', 6, 3),
(6, 'Samsung PLS LED', 'PC Screen HDMI/VGA/..', '700', 'https://www.ivory.co.il/files/catalog/org/1550664856o56Sn.jpg', 7, 4),
(7, 'Gaming PC', 'מחשב נייח גיימינג', '2400', 'https://www.ivory.co.il/files/catalog/org/1617520480u80Sm.jpg', 16, 6),
(8, 'Lenovo Tab M7', 'Lenovo Tab M7 TB-7305F', '400', 'https://www.ivory.co.il/files/catalog/org/1594893934n34SM.jpg', 14, 4),
(9, 'Samsung Galaxy S8', 'Galaxy S8 New', '1300', 'https://www.gizmochina.com/wp-content/uploads/2018/02/Samsung-Galaxy-S8-Plus-G955F_2.jpg', 37, 10),
(10, 'Ulefone Note 9', 'Ulefone Note 9 New', '300', 'https://imgaz2.staticbg.com/thumb/large/oaupload/banggood/images/7C/C3/26d3b2fb-3d5f-46ad-884b-eacfa8e1defb.jpg.webp', 39, 11),
(11, 'SteelSeries Apex 7', 'Gaming Keyboard', '70', 'https://m.media-amazon.com/images/I/81yOuAUQAiL._AC_.jpg', 8, 6),
(12, 'Gaming Mouse 8D', 'Pro  Gaming Mouse', '30', 'https://ae01.alicdn.com/kf/Hdff22a91a7e7432396093b8d2530c0d7q/Pro-Gamer-Gaming-Mouse-8D-3200DPI-Adjustable-Wired-Optical-LED-Computer-Mice-USB-Cable-Silent-Mouse.jpg', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
