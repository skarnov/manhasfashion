-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2021 at 06:50 PM
-- Server version: 10.4.11-MariaDB
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
-- Database: `db_manha`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `pk_category_id` int(4) NOT NULL,
  `category_serial` int(3) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_type` tinyint(1) NOT NULL COMMENT '1 - Category | 2 - Subcategory | 3 - Subcategory Item',
  `category_relation` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`pk_category_id`, `category_serial`, `category_name`, `category_type`, `category_relation`) VALUES
(1, 0, 'Sample Category', 1, 0),
(2, 0, 'Sample Subcategory', 2, 1),
(3, 0, 'Sample Item', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `pk_notification_id` bigint(20) NOT NULL,
  `notification` text NOT NULL,
  `view_status` tinyint(1) NOT NULL COMMENT '0 - Unseen',
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordermeta`
--

CREATE TABLE `tbl_ordermeta` (
  `pk_ordermeta_id` bigint(20) NOT NULL,
  `fk_order_id` bigint(20) NOT NULL,
  `fk_product_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_sales_quantity` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `pk_order_id` bigint(20) NOT NULL,
  `fk_shipping_id` bigint(20) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `order_total` float(10,2) NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productmeta`
--

CREATE TABLE `tbl_productmeta` (
  `pk_productmeta_id` bigint(20) NOT NULL,
  `fk_product_id` int(10) NOT NULL,
  `product_meta_name` text NOT NULL,
  `product_meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_productmeta`
--

INSERT INTO `tbl_productmeta` (`pk_productmeta_id`, `fk_product_id`, `product_meta_name`, `product_meta_value`) VALUES
(6, 1, 'description', ''),
(7, 1, 'sizes', 'XL'),
(8, 1, 'colors', 'Red'),
(9, 1, 'build_material', 'Cotton'),
(10, 1, 'country_origin', ''),
(11, 1, 'product_image_2', ''),
(12, 1, 'product_image_3', ''),
(13, 1, 'product_image_4', ''),
(14, 1, 'product_image_5', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `pk_product_id` int(10) NOT NULL,
  `fk_category_id` int(3) DEFAULT NULL,
  `fk_subcategory_id` int(3) DEFAULT NULL,
  `fk_subcategory_item_id` int(3) DEFAULT NULL,
  `product_attribute` tinyint(1) NOT NULL COMMENT '1 - Best Seller | 2 - New Arrival',
  `product_name` varchar(100) NOT NULL,
  `product_image` text DEFAULT NULL,
  `product_image_thumb` text DEFAULT NULL,
  `product_old_price` float(10,2) DEFAULT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_status` tinyint(1) DEFAULT 1,
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`pk_product_id`, `fk_category_id`, `fk_subcategory_id`, `fk_subcategory_item_id`, `product_attribute`, `product_name`, `product_image`, `product_image_thumb`, `product_old_price`, `product_price`, `product_status`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 1, 2, 3, 2, 'Sample Product', '2336a6fd27ddeb8a5294cd02bc490512.png', '2336a6fd27ddeb8a5294cd02bc490512_thumb.png', NULL, 1.00, 1, 1, '2021-03-21 11:09:39', 1, '2021-03-21 11:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `pk_setting_id` int(5) NOT NULL,
  `setting` text NOT NULL,
  `setting_position` varchar(20) NOT NULL,
  `setting_data` text NOT NULL,
  `setting_style` text NOT NULL,
  `setting_type` tinyint(1) NOT NULL COMMENT '1 - Slider, 2 - Banner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`pk_setting_id`, `setting`, `setting_position`, `setting_data`, `setting_style`, `setting_type`) VALUES
(1, '6e61a070baf684b4564747579f6b200b.png', '', '', '', 1),
(2, '44bd6f232ae23b3098b48f497513b021.png', '', '', '', 1),
(3, '1a3d5b2859d531de8376bcd62251e577.png', '', '', '', 1),
(4, '43d560e6e2922fab8c89570c8e27454c.png', '', '', '', 1),
(5, '36d7da1bf3d4c3b3a49a89cd56a0f142.png', '', '', '', 1),
(6, '9a4373dfbb0a1a67ce22c637a689d0b3.png', 'Right Big', 'Best Quality Guaranteed', '', 2),
(7, '73cc8299ecd7f4da7d950faac5338a22.png', 'Left Medium', 'Latest Collection', '', 2),
(8, '16bc5f270c27349df8deb5ee1e728dec.png', 'Left Small Right', 'Women Shop', '', 2),
(9, 'ace3a7d45634540e911d69ae4753c55f.png', 'Left Small Left', 'Man Shop', '', 2),
(10, '6f6b0f737a1911e35d69181586b30c30.png', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shippings`
--

CREATE TABLE `tbl_shippings` (
  `pk_shipping_id` bigint(20) NOT NULL,
  `delivery_name` varchar(50) NOT NULL,
  `delivery_email` varchar(50) NOT NULL,
  `delivery_mobile` bigint(11) NOT NULL,
  `delivery_address` text NOT NULL,
  `billing_name` varchar(50) NOT NULL,
  `billing_email` varchar(50) NOT NULL,
  `billing_mobile` bigint(11) NOT NULL,
  `billing_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `pk_user_id` int(10) NOT NULL,
  `user_image` text DEFAULT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_mobile` bigint(11) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1 - Admin | 2 - Customer',
  `user_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`pk_user_id`, `user_image`, `user_fullname`, `user_email`, `user_password`, `user_mobile`, `user_address`, `user_type`, `user_status`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 'df7f2c06ec37aae42956dee938d5724b.png', 'Manha', 'admin@evis.com', '111111', 12345678963, NULL, 1, 1, NULL, NULL, 1, '2021-03-21 10:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_activities`
--

CREATE TABLE `tbl_user_activities` (
  `user_activity_id` int(10) NOT NULL,
  `user_activity_url` text COLLATE utf8_unicode_ci NOT NULL,
  `user_activity_type` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`pk_category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`pk_notification_id`);

--
-- Indexes for table `tbl_ordermeta`
--
ALTER TABLE `tbl_ordermeta`
  ADD PRIMARY KEY (`pk_ordermeta_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`pk_order_id`);

--
-- Indexes for table `tbl_productmeta`
--
ALTER TABLE `tbl_productmeta`
  ADD PRIMARY KEY (`pk_productmeta_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`pk_product_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`pk_setting_id`);

--
-- Indexes for table `tbl_shippings`
--
ALTER TABLE `tbl_shippings`
  ADD PRIMARY KEY (`pk_shipping_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`pk_user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `tbl_user_activities`
--
ALTER TABLE `tbl_user_activities`
  ADD PRIMARY KEY (`user_activity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `pk_category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `pk_notification_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ordermeta`
--
ALTER TABLE `tbl_ordermeta`
  MODIFY `pk_ordermeta_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `pk_order_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_productmeta`
--
ALTER TABLE `tbl_productmeta`
  MODIFY `pk_productmeta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `pk_product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `pk_setting_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_shippings`
--
ALTER TABLE `tbl_shippings`
  MODIFY `pk_shipping_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `pk_user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_activities`
--
ALTER TABLE `tbl_user_activities`
  MODIFY `user_activity_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
