-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2026 at 03:19 PM
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
-- Database: `sweetly_bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT '?',
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(7, 'Doughnut', '🍩', NULL, '2026-06-23 04:30:43', '2026-06-23 04:30:43'),
(8, 'Dubai Series', '🧆', NULL, '2026-06-23 04:43:04', '2026-06-23 04:43:04'),
(9, 'Cake', '🍰', NULL, '2026-06-23 04:56:56', '2026-06-23 04:56:56'),
(10, 'Waffle', '🧇', NULL, '2026-06-23 04:57:03', '2026-06-23 04:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_01_000001_create_users_table', 1),
(2, '2024_01_01_000002_create_categories_table', 1),
(3, '2024_01_01_000003_create_products_table', 1),
(4, '2024_01_01_000004_create_orders_table', 1),
(5, '2024_01_01_000005_create_order_items_table', 1),
(6, '2026_06_03_000001_add_image_to_products_table', 1),
(7, '2026_06_23_112415_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` varchar(255) NOT NULL DEFAULT '09:00',
  `note` text DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('pending','confirmed','process','ready','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` enum('transfer','cod','ewallet') NOT NULL DEFAULT 'transfer',
  `payment_status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `delivery_address`, `delivery_date`, `delivery_time`, `note`, `total_price`, `status`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 3, 'SWL-AY2AZWOB', 'lamlagang', '2026-06-25', '09:00', NULL, 68000, 'delivered', 'transfer', 'paid', '2026-06-23 05:36:47', '2026-06-23 05:37:09'),
(2, 3, 'SWL-NBLPX4RX', 'lamlagang', '2026-06-25', '09:00', NULL, 110000, 'delivered', 'transfer', 'paid', '2026-06-23 05:44:26', '2026-06-23 05:44:44'),
(3, 3, 'SWL-0W5WXPNL', 'lamlagang', '2026-06-25', '09:00', NULL, 55000, 'delivered', 'transfer', 'unpaid', '2026-06-23 05:45:33', '2026-06-23 05:46:00'),
(4, 3, 'SWL-YUDS6RHJ', 'lamlagang', '2026-06-25', '09:00', NULL, 55000, 'pending', 'transfer', 'unpaid', '2026-06-23 05:53:43', '2026-06-23 05:53:43'),
(5, 3, 'SWL-ASBW1XGC', 'lamlagang', '2026-06-25', '09:00', NULL, 275000, 'delivered', 'transfer', 'paid', '2026-06-23 05:54:06', '2026-06-23 05:54:24'),
(6, 3, 'SWL-R5MJG6VC', 'lamlagang', '2026-06-25', '09:00', NULL, 2600000, 'pending', 'transfer', 'unpaid', '2026-06-23 05:57:17', '2026-06-23 05:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `custom_note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`, `subtotal`, `custom_note`, `created_at`, `updated_at`) VALUES
(1, 1, 31, 1, 68000, 68000, NULL, '2026-06-23 05:36:47', '2026-06-23 05:36:47'),
(2, 2, 29, 2, 55000, 110000, NULL, '2026-06-23 05:44:26', '2026-06-23 05:44:26'),
(3, 3, 29, 1, 55000, 55000, NULL, '2026-06-23 05:45:33', '2026-06-23 05:45:33'),
(4, 4, 29, 1, 55000, 55000, NULL, '2026-06-23 05:53:43', '2026-06-23 05:53:43'),
(5, 5, 29, 5, 55000, 275000, NULL, '2026-06-23 05:54:06', '2026-06-23 05:54:06'),
(6, 6, 37, 13, 200000, 2600000, NULL, '2026-06-23 05:57:17', '2026-06-23 05:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `emoji` varchar(255) NOT NULL DEFAULT '?',
  `bg_color` varchar(255) NOT NULL DEFAULT '#fdf2f8',
  `stock` int(11) NOT NULL DEFAULT 10,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_custom_order` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `image`, `price`, `emoji`, `bg_color`, `stock`, `is_available`, `is_custom_order`, `created_at`, `updated_at`) VALUES
(17, 7, 'Alca Pone', 'Donat empuk dengan lapisan cokelat dan taburan almond renyah yang memberikan kombinasi rasa manis dan gurih yang nikmat.', 'products/K10CmkOtxbjKI7sNGYzqvDkFS7nzliBuW1nvPogw.webp', 11000, '🎂', '#fdf2f8', 15, 1, 0, '2026-06-23 04:32:41', '2026-06-23 04:34:28'),
(18, 7, 'Caviar Chocolate', 'Donat empuk dengan lapisan cokelat dan taburan caviar cokelat renyah yang menambah sensasi manis di setiap gigitan', 'products/Hq5qw1ODhhHUOoXkh143sFiXiCbd4Xduf1b1CSAV.webp', 11000, '🎂', '#fdf2f8', 11, 1, 0, '2026-06-23 04:34:13', '2026-06-23 04:34:13'),
(19, 7, 'Copa Banana', 'Donat empuk dengan topping krim pisang yang manis dan lembut, memberikan rasa buah yang nikmat di setiap gigitan.', 'products/tI8KJqG3cGwr9KZJr8X4aTFoERfrzTYP5jQbLtX6.webp', 11000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 04:35:34', '2026-06-23 04:35:34'),
(20, 7, 'Matcha Donat', 'Donat empuk dengan topping krim matcha yang lembut, menghadirkan rasa teh hijau yang khas dan nikmat di setiap gigitan', 'products/etsmbMKp00jcFQ9bwpQei5iEL43ZQqueJnSPWDFp.jpg', 11000, '🎂', '#fdf2f8', 12, 1, 0, '2026-06-23 04:36:26', '2026-06-23 04:36:26'),
(21, 7, 'Oreo Crunchy', 'Donat empuk dengan topping krim dan remahan Oreo renyah yang memberikan rasa manis dan tekstur yang menggugah selera', 'products/XWWNkX2Pm409bc6NEgLUAwW9IgbIHbo0mjR8OvRU.png', 11000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 04:37:13', '2026-06-23 04:42:43'),
(22, 7, 'Don Mochino', 'Donat lembut dengan lapisan cokelat mocha yang kaya rasa, memadukan kelezatan cokelat dan aroma kopi yang khas. Cocok bagi pecinta cita rasa manis dengan sentuhan kopi yang lembut dan nikmat.', 'products/MgGaEzJgRqacYk876lqaaTjT8gxb0EnBqN8TYPem.webp', 11000, '🎂', '#fdf2f8', 16, 1, 0, '2026-06-23 04:41:53', '2026-06-23 04:41:53'),
(23, 8, 'Dubai Chewy Cookie', 'Cookies premium dengan tekstur lembut dan chewy di bagian dalam, dipadukan dengan isian serta topping khas Dubai yang kaya rasa. Menghadirkan perpaduan manis yang pas dengan sensasi gigitan yang lembut dan memanjakan di setiap potongannya.', 'products/RqlLpgGEINrDlrlD812aYZL8WH9RowLULLBlty9O.jpg', 40000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 04:44:32', '2026-06-23 04:44:32'),
(24, 8, 'Dubai Cake', 'Kue premium dengan tekstur lembut dan rasa yang kaya, terinspirasi dari cita rasa khas Dubai yang mewah. Dibuat dari bahan-bahan pilihan dan dipadukan dengan topping istimewa untuk menghadirkan pengalaman dessert yang elegan dan memanjakan lidah.', 'products/4288hNgb5hZtlXK8wQKKUWw6Xq84Mo11Cp7lzIqb.jpg', 80000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 04:46:05', '2026-06-23 04:47:51'),
(25, 8, 'Dubai Chocolate', 'Cokelat premium dengan rasa kaya dan sentuhan khas Dubai yang mewah, sempurna untuk dinikmati sebagai camilan istimewa.', 'products/kvaDUU5Y35pYBMhIRzjUWpZrRKVAOI8LIULUzoKc.jpg', 75000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 04:49:04', '2026-06-23 04:49:04'),
(26, 8, 'Dubai Strawberry Chocolate', 'Stroberi segar yang dibalut cokelat premium dengan sentuhan khas Dubai, menghadirkan perpaduan rasa manis dan segar yang memanjakan lidah.', 'products/5Dj3O14SU1w8iCAHfoggPVgK9hHdfrLDjtbo0exj.jpg', 60000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 04:51:13', '2026-06-23 04:51:26'),
(27, 8, 'Croissant Pistachio', 'Croissant berlapis yang renyah di luar dan lembut di dalam, diisi serta dipadukan dengan krim pistachio yang kaya rasa. Perpaduan tekstur yang ringan dan cita rasa kacang pistachio yang khas menghadirkan pengalaman menikmati pastry yang lezat dan premium.', 'products/cHsI1XGPFjXJrI3Rr2hLCjsguuimbBpJyiLbBgPz.jpg', 80000, '🎂', '#fdf2f8', 7, 1, 0, '2026-06-23 04:54:19', '2026-06-23 04:54:19'),
(28, 10, 'Waffle Nutella', 'Waffle hangat dengan tekstur renyah di luar dan lembut di dalam, disajikan dengan olesan Nutella yang kaya rasa cokelat dan hazelnut. Perpaduan rasa manis yang lezat menjadikannya pilihan sempurna untuk menemani waktu santai.', 'products/7izZG7GPqhU8Tcm9sTdnST8dMh3eqjSCS7q5AWpK.jpg', 40000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 05:03:11', '2026-06-23 05:03:11'),
(29, 10, 'Berry Waffle', 'Waffle renyah di luar dan lembut di dalam yang dipadukan dengan saus serta potongan buah beri yang segar. Perpaduan rasa manis dan sedikit asam dari buah beri menciptakan sensasi yang menyegarkan dan menggugah selera.', 'products/Y9NIa7n0rQygmWJhsL51BQmNhhmvSYohLTr9E9ni.jpg', 55000, '🎂', '#fdf2f8', 4, 1, 0, '2026-06-23 05:04:21', '2026-06-23 05:54:22'),
(30, 10, 'Waffle Cookies & Cream', 'Waffle renyah di luar dan lembut di dalam yang disajikan dengan krim manis serta taburan biskuit cookies yang renyah. Perpaduan tekstur creamy dan crunchy menciptakan cita rasa yang lezat dan disukai oleh berbagai kalangan.', 'products/CzTrq020DxNKmquJ3V5cydgajf7xJqxR6UDBqUcQ.jpg', 50000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 05:05:25', '2026-06-23 05:05:25'),
(31, 10, 'Waffle Red Velvet Berry', 'Waffle red velvet yang lembut dengan warna merah khas, dipadukan dengan krim lembut dan topping buah beri segar. Kombinasi rasa manis yang lembut dan kesegaran buah beri menciptakan sajian yang lezat dan menggugah selera.', 'products/6diKTyXWwSwtDqZTkznuExukrfS1GoTFoASgL9y8.jpg', 68000, '🎂', '#fdf2f8', 15, 1, 0, '2026-06-23 05:06:37', '2026-06-23 05:06:37'),
(32, 10, 'Waffle Nutella Ice Cream', 'Waffle hangat dengan tekstur renyah di luar dan lembut di dalam, dipadukan dengan Nutella yang lumer dan es krim yang lembut. Kombinasi hangat dan dingin menciptakan sensasi rasa yang istimewa dan memanjakan di setiap gigitan.', 'products/rraitlpzQNGa5Ht0gdQDjcgssMOUKGQSwOMhb3aV.jpg', 70000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 05:07:50', '2026-06-23 05:07:50'),
(33, 9, 'Jellycat Cake', 'Kue lembut dengan dekorasi menggemaskan yang terinspirasi dari karakter Jellycat, menghadirkan tampilan yang cantik dan menarik. Cocok untuk berbagai momen spesial dengan perpaduan rasa yang lezat dan tampilan yang memanjakan mata.', 'products/YclKcciuIEqpN30n4bX8bOEcBZHA6aawxYYI5sPr.jpg', 150000, '🎂', '#fdf2f8', 10, 1, 1, '2026-06-23 05:17:30', '2026-06-23 05:17:30'),
(34, 9, 'Fruit Cake', 'Kue lembut yang dihiasi aneka buah segar pilihan, menghadirkan perpaduan rasa manis yang ringan dan kesegaran alami dalam setiap gigitan. Cocok dinikmati sebagai hidangan penutup maupun untuk berbagai momen spesial.', 'products/y2PVna1ofORk7Hrbu2JXqT9DuEVrmbLnwzYl6Mnp.jpg', 200000, '🎂', '#fdf2f8', 10, 1, 1, '2026-06-23 05:18:17', '2026-06-23 05:18:17'),
(35, 9, 'Lotus Cheesecake', 'Cheesecake lembut dengan perpaduan krim keju yang creamy dan cita rasa khas biskuit Lotus Biscoff yang karamel dan harum. Teksturnya yang lembut serta rasa manis yang seimbang menjadikannya pilihan sempurna untuk para pencinta dessert.', 'products/DUjjgSkSv1Mc11am1GOTdpHOQmCN4sz0FQgrqVf8.jpg', 110000, '🎂', '#fdf2f8', 10, 1, 0, '2026-06-23 05:20:25', '2026-06-23 05:20:25'),
(36, 9, 'Pastel Petit Cake', 'Kue mini isi 8 dengan tampilan cantik bernuansa pastel dan tekstur yang lembut. Dibuat dengan perpaduan rasa yang manis dan ringan, menjadikannya pilihan sempurna untuk menemani momen spesial maupun sebagai hadiah yang berkesan.', 'products/LfQauJf1dOYQaxGNQwLjH0jsggWN2zVgYBMRAJ9D.jpg', 160000, '🎂', '#fdf2f8', 10, 1, 1, '2026-06-23 05:22:06', '2026-06-23 05:22:06'),
(37, 9, 'Strawbery Cake', 'Kue lembut yang dipadukan dengan krim ringan dan stroberi segar yang manis. Perpaduan rasa yang lembut dan kesegaran buah menciptakan sajian yang lezat, cocok untuk dinikmati di berbagai kesempatan.', 'products/9V8bbR29xlYWubonscimKqqUHHls24XEA8WdU3tF.jpg', 200000, '🎂', '#fdf2f8', 10, 1, 1, '2026-06-23 05:23:57', '2026-06-23 05:23:57'),
(38, 9, 'Ugly Cake', 'Kue dengan desain unik dan ekspresi lucu yang sedang tren, dibuat dengan tekstur lembut dan rasa yang lezat. Cocok untuk hadiah, perayaan ulang tahun, atau menyampaikan pesan spesial dengan cara yang kreatif dan berkesan.', 'products/2aTLpPVHPiK9R2HwnNNL3Oe1XFstipeigOPRymSz.jpg', 180000, '🎂', '#fdf2f8', 10, 1, 1, '2026-06-23 05:24:47', '2026-06-23 05:24:47'),
(39, 9, 'Vintage Princess Cake', 'Kue elegan dengan dekorasi vintage bernuansa pastel dan pita cantik yang menghadirkan sentuhan klasik, manis, dan berkesan untuk momen spesial', 'products/cL9J3LWMtpId42z7X5ypMl5U9P1feoICIfpb2ECK.jpg', 300000, '🎂', '#fdf2f8', 5, 1, 1, '2026-06-23 05:26:48', '2026-06-23 05:27:01'),
(40, 7, 'Avocado Dicaprio', 'Minuman alpukat creamy yang dipadukan dengan cokelat premium dan topping melimpah, menghadirkan perpaduan rasa manis, lembut, dan menyegarkan. Cocok dinikmati sebagai teman bersantai maupun pelepas dahaga di segala suasana.', 'products/oBMM5jFjPbB7yhaDOx3vhxIqS4bmAg8eYcHTJsW4.jpg', 11000, '🎂', '#fdf2f8', 14, 1, 0, '2026-06-23 05:36:05', '2026-06-23 05:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xp3CbndDRP0d5Jh0diTrq9QDFhfMgojIwRZJoJif', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJyTXl0YW84MTRGVU5UbW5SWVVkb3huMWs0VTNLQmI3dzJmQzFSRFY4IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDJcL2FkbWluXC91c2VycyIsInJvdXRlIjoiYWRtaW4udXNlcnMifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1782220741);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sweetly', 'admin@sweetly.com', '081234567890', 'Jl. Roti No.1 Jakarta', '$2y$12$TnnW4x6MJPlfJ97FB8Ss1.i9N/cALvrRwVC35pt.EmboYVLjeXIa2', 'admin', '2026-06-23 04:23:01', '2026-06-23 04:23:01'),
(3, 'Khalisa Humaira', 'khalisahumaira@gmail.com', '081359999941', 'lamlagang', '$2y$12$vDmpX3Zw4WlbfpXpRUfn..OdJRq2jQB7shNVGpX2o2seoLi1R3Dx.', 'customer', '2026-06-23 05:33:20', '2026-06-23 05:33:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
