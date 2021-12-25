-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2020 at 07:44 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `webd173`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(5) NOT NULL,
  `productid` int(5) NOT NULL,
  `sessionid` varchar(50) NOT NULL,
  `timeofentry` datetime NOT NULL,
  `qty` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`id`, `productid`, `sessionid`, `timeofentry`, `qty`) VALUES
(5, 1, '7c6080ee0bee290f494f5b9cb03b70cc', '2020-05-10 18:03:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `categorydesk` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `categorydesk`) VALUES
(1, 'Protein', 'Protein'),
(2, 'Creatine', 'Creatine'),
(3, 'Vitamines', 'Vitamines'),
(4, 'Lose weight', 'Lose weight'),
(5, 'Pre workout', 'Pre workout');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sku` varchar(14) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(50) NOT NULL,
  `desk` varchar(255) NOT NULL,
  `catid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `sku`, `price`, `image`, `desk`, `catid`) VALUES
(0, 'Whey', 'WHEY001', '19.99', 'image/hero.jpg', '24g of Pure, Quality Protein in Every Scoop width No Added Amino Acids or Filler Nutrients. A Pure Blend of High-Quality Protein ', 1),
(1, 'Platinum Creatine', 'PLACREO001', '29.99', 'image/creatine.jpg', '5g of Micronized Creatine to Support Lean Muscle and Increase Strength Ultra-Pure Micronized Creatine', 2),
(2, 'ENGN', 'ENGN001', '39.99', 'image/engn.jpg', 'Intense Pre-Workout Powder for Increased Energy, Power, & Focus Supports Cognitive Function, Enhances Mood, Expands Muscle ', 5),
(3, 'Pro JYM Protein', 'Projym001', '29.99', 'image/protein.jpg', '24g of Pure, Quality Protein in Every Scoop width No Added Amino Acids or Filler Nutrients. A Pure Blend of High-Quality Protein ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(5) NOT NULL,
  `rating` int(5) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `productid` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `rating`, `ipaddress`, `productid`) VALUES
(1, 3, '::1', 0),
(2, 5, '::1', 1),
(3, 1, '::1', 2),
(4, 4, '::1', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;