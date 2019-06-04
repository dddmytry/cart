-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 04 2019 г., 15:24
-- Версия сервера: 5.7.26
-- Версия PHP: 7.1.27-1+0~20190307202204.14+stretch~1.gbp7163d5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cart`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1559321609),
('m190531_155307_create_products_table', 1559325709),
('m190531_164431_create_product_photos_table', 1559325711),
('m190601_062122_add_main_photo_column_to_products_table', 1559370470),
('m190603_202451_create_orders_table', 1559595967),
('m190603_203010_create_order_items_table', 1559595970);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `main_photo` int(11) DEFAULT NULL,
  `summary` text,
  `body` text,
  `price` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `main_photo`, `summary`, `body`, `price`, `slug`, `status`, `created_at`, `updated_at`, `title`, `keywords`, `description`) VALUES
(1, 'Товар 1', 1, '<p>Lorem ipsum dolor sit amet, consectetur ...</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis auctor sapien eu malesuada. Cras id risus vitae sem aliquam interdum vel in sem. Praesent dignissim eleifend ante, eu bibendum nulla interdum a. Donec sed diam volutpat, placerat magna ut, semper velit. Mauris eget lacinia dui. Phasellus vitae lacinia tortor. Nullam in leo nisl. Ut magna tellus, fringilla vel nulla ut, ultrices vestibulum purus. Vestibulum at ligula dignissim metus convallis congue ultrices sed justo. Curabitur faucibus ornare sodales. Fusce mollis pulvinar ligula eu interdum. Aenean ut ipsum scelerisque, dignissim quam vulputate, luctus diam. Sed at dolor a augue dictum mattis. Suspendisse potenti. Integer nec mauris bibendum, tristique diam vitae, dapibus justo.</p>\r\n', 100, 'tovar-1', 'active', 1559407715, NULL, '', '', ''),
(2, 'Товар 2', 6, '<p>Lorem ipsum dolor sit amet, consectetur ...</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis auctor sapien eu malesuada. Cras id risus vitae sem aliquam interdum vel in sem. Praesent dignissim eleifend ante, eu bibendum nulla interdum a. Donec sed diam volutpat, placerat magna ut, semper velit. Mauris eget lacinia dui. Phasellus vitae lacinia tortor. Nullam in leo nisl. Ut magna tellus, fringilla vel nulla ut, ultrices vestibulum purus. Vestibulum at ligula dignissim metus convallis congue ultrices sed justo. Curabitur faucibus ornare sodales. Fusce mollis pulvinar ligula eu interdum. Aenean ut ipsum scelerisque, dignissim quam vulputate, luctus diam. Sed at dolor a augue dictum mattis. Suspendisse potenti. Integer nec mauris bibendum, tristique diam vitae, dapibus justo.</p>\r\n', 150, 'tovar-2', 'active', 1559416905, NULL, '', '', ''),
(3, 'Товар 3', 14, '<p>Lorem ipsum dolor sit amet, consectetur</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis auctor sapien eu malesuada. Cras id risus vitae sem aliquam interdum vel in sem. Praesent dignissim eleifend ante, eu bibendum nulla interdum a. Donec sed diam volutpat, placerat magna ut, semper velit. Mauris eget lacinia dui. Phasellus vitae lacinia tortor. Nullam in leo nisl. Ut magna tellus, fringilla vel nulla ut, ultrices vestibulum purus. Vestibulum at ligula dignissim metus convallis congue ultrices sed justo. Curabitur faucibus ornare sodales. Fusce mollis pulvinar ligula eu interdum. Aenean ut ipsum scelerisque, dignissim quam vulputate, luctus diam. Sed at dolor a augue dictum mattis. Suspendisse potenti. Integer nec mauris bibendum, tristique diam vitae, dapibus justo.</p>\r\n', 200, 'tovar-3', 'active', 1559417004, NULL, '', '', ''),
(4, 'Товар 4', 15, '<p>Lorem ipsum dolor sit amet, consectetur</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis auctor sapien eu malesuada. Cras id risus vitae sem aliquam interdum vel in sem. Praesent dignissim eleifend ante, eu bibendum nulla interdum a. Donec sed diam volutpat, placerat magna ut, semper velit. Mauris eget lacinia dui. Phasellus vitae lacinia tortor. Nullam in leo nisl. Ut magna tellus, fringilla vel nulla ut, ultrices vestibulum purus. Vestibulum at ligula dignissim metus convallis congue ultrices sed justo. Curabitur faucibus ornare sodales. Fusce mollis pulvinar ligula eu interdum. Aenean ut ipsum scelerisque, dignissim quam vulputate, luctus diam. Sed at dolor a augue dictum mattis. Suspendisse potenti. Integer nec mauris bibendum, tristique diam vitae, dapibus justo.</p>\r\n', 180, 'tovar-4', 'active', 1559417102, NULL, '', '', ''),
(5, 'Товар 5', 22, '<p>Lorem ipsum dolor sit amet, consectetur</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis auctor sapien eu malesuada. Cras id risus vitae sem aliquam interdum vel in sem. Praesent dignissim eleifend ante, eu bibendum nulla interdum a. Donec sed diam volutpat, placerat magna ut, semper velit. Mauris eget lacinia dui. Phasellus vitae lacinia tortor. Nullam in leo nisl. Ut magna tellus, fringilla vel nulla ut, ultrices vestibulum purus. Vestibulum at ligula dignissim metus convallis congue ultrices sed justo. Curabitur faucibus ornare sodales. Fusce mollis pulvinar ligula eu interdum. Aenean ut ipsum scelerisque, dignissim quam vulputate, luctus diam. Sed at dolor a augue dictum mattis. Suspendisse potenti. Integer nec mauris bibendum, tristique diam vitae, dapibus justo.</p>\r\n', 230, 'tovar-5', 'active', 1559417156, NULL, '', '', ''),
(6, 'Товар 6', 29, '<p>Lorem ipsum dolor sit amet, consectetur</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis auctor sapien eu malesuada. Cras id risus vitae sem aliquam interdum vel in sem. Praesent dignissim eleifend ante, eu bibendum nulla interdum a. Donec sed diam volutpat, placerat magna ut, semper velit. Mauris eget lacinia dui. Phasellus vitae lacinia tortor. Nullam in leo nisl. Ut magna tellus, fringilla vel nulla ut, ultrices vestibulum purus. Vestibulum at ligula dignissim metus convallis congue ultrices sed justo. Curabitur faucibus ornare sodales. Fusce mollis pulvinar ligula eu interdum. Aenean ut ipsum scelerisque, dignissim quam vulputate, luctus diam. Sed at dolor a augue dictum mattis. Suspendisse potenti. Integer nec mauris bibendum, tristique diam vitae, dapibus justo.</p>\r\n', 300, 'tovar-6', 'active', 1559417215, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `product_photos`
--

CREATE TABLE `product_photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `file`, `sort`) VALUES
(1, 1, 'nordmaster_CL_229в.jpg', 0),
(2, 1, 'nordmaster_CL_234В.jpg', 1),
(3, 1, 'nordmaster_CL_235В.jpg', 3),
(5, 1, 'nordmaster_CL_ К-353.jpg', 2),
(6, 2, 'planet_2Р_К-236.jpg', 0),
(7, 2, 'planet_2Р_К-248.jpg', 1),
(8, 2, 'planet_2Р_К-249.jpg', 2),
(9, 2, 'planet_2Р_К-250.jpg', 3),
(10, 3, 'EAG_UG_GW3_ROF.jpg', 1),
(11, 3, 'EFFIGRIP_COMPACT_OT.jpg', 2),
(12, 3, 'EFFIGRIP_PERF.jpg', 3),
(13, 3, 'EUG_GW3.jpg', 4),
(14, 3, 'UG_500.jpg', 0),
(15, 4, '749.jpg', 0),
(16, 4, '856.jpg', 1),
(17, 4, '857.jpg', 2),
(18, 4, '7400.jpg', 3),
(19, 4, 'CW-51.jpg', 4),
(20, 4, 'HP91.jpg', 5),
(21, 4, 'HS-51.jpg', 6),
(22, 5, 'HAKKA_BLACK.jpg', 0),
(23, 5, 'HAKKA_BLUE.jpg', 1),
(24, 5, 'HAKKA_BLUE_SUV.jpg', 2),
(25, 5, 'HAKKA_C_2.jpg', 3),
(26, 5, 'HAKKA_C_CARGO.jpg', 4),
(27, 5, 'HAKKA_C_VAN.jpg', 5),
(28, 5, 'HAKKA_GREEN.jpg', 6),
(29, 6, 'SQ-201.jpg', 0),
(30, 6, 'БЦ-26.jpg', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-order_items-order-id` (`order_id`),
  ADD KEY `idx-order_items-product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `idx-product-slug` (`slug`),
  ADD KEY `idx-main-photo` (`main_photo`);

--
-- Индексы таблицы `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-product_photos-product_id-id` (`product_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk-order_items-order-id-id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-order_items-product-id-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk-product-main-photo-id` FOREIGN KEY (`main_photo`) REFERENCES `product_photos` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_photos`
--
ALTER TABLE `product_photos`
  ADD CONSTRAINT `fk-product_photos-product_id-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
