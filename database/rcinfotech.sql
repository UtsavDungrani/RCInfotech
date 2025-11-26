-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 05:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rcinfotech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'new', '$2y$10$KyGBxvc.PeFpwiM5cq4otuJ8ZCauODSXtTFouVQBmU0zVH/XKiHHe', '2025-04-10 21:28:30'),
(5, 'admin', '$2y$10$d96Md9kmfKajGxV9WTjo0eWFDVaaQfEcRsQduo62R6CeeFbpAeHhm', '2025-04-10 21:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `bookser`
--

CREATE TABLE `bookser` (
  `id` int(11) NOT NULL,
  `fname` text DEFAULT NULL,
  `lname` text NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `mobile` bigint(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('approved','rejected','pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookser`
--

INSERT INTO `bookser` (`id`, `fname`, `lname`, `email`, `mobile`, `address`, `subject`, `description`, `booking_time`, `status`) VALUES
(7, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 2147483647, '', 'General services', 'hi', '2025-04-17 23:12:04', 'pending'),
(8, 'Ayush', 'Joshi', 'ayushjoshi876@gmail.com', 1234567890, '', 'Web development', 'hi', '2025-04-17 23:18:06', 'pending'),
(9, 'Jasmin', 'Dungarani', 'ayushjoshi876@gmail.com', 2147483647, '', 'Laptop repairing', 'hi', '2025-04-17 23:18:52', 'pending'),
(10, 'Jasmin', 'Dungarani', 'ayushjoshi876@gmail.com', 2147483647, '', 'Laptop repairing', 'hi', '2025-04-17 23:22:55', 'pending'),
(12, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 2147483647, '', 'Laptop repairing', 'hi', '2025-04-17 23:27:38', 'approved'),
(13, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 2147483647, '', 'General services', 'hi', '2025-04-17 23:55:37', 'approved'),
(14, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'General services', 'hi', '2025-04-17 23:58:51', 'approved'),
(15, 'lin', 'eve', 'lineviv529@f5url.com', 9173283815, '', 'Computer Repair', 'hi', '2025-04-18 23:15:08', 'rejected'),
(16, 'AMD', '`123', 'lineviv529@f5url.com', 1234567890, '', 'Laptop repairing', 'need new service', '2025-04-19 00:13:24', 'rejected'),
(17, 'Utsav', 'Dungrani', 'lineviv529@f5url.com', 9173283815, '', 'Data Recovery', 'hi', '2025-04-19 23:45:58', 'pending'),
(18, 'Utsav', 'Dungrani', 'lineviv529@f5url.com', 9173283815, '', 'Software development', 'i need person', '2025-04-20 05:32:29', 'approved'),
(19, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Laptop repairing', 'hi', '2025-04-22 23:55:17', 'approved'),
(20, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Computer Repair', 'hi1', '2025-04-23 00:18:08', 'pending'),
(21, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network Solutions', 'hello', '2025-04-23 00:22:59', 'approved'),
(22, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Web development', 'the new service', '2025-04-24 13:17:24', 'approved'),
(23, 'Utsav', 'Dungrani', 'dahedo3148@ingitel.com', 9173283815, '', 'Network Solutions', 'hi', '2025-04-27 00:54:42', 'approved'),
(24, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'App development', 'hgvgvhg', '2025-04-30 22:54:37', 'pending'),
(25, 'Utsav', 'Dungrani', 'wejole9158@harinv.com', 9173283815, '', 'Web development', 'ijjoijoijoijoijoijso[\'iqdju2oiwqkdnweokmc', '2025-04-30 22:59:16', 'pending'),
(26, 'Ayush', 'Joshi', 'ayushjoshi876@gmail.com', 1234567890, '', 'App development', 'new service', '2025-04-30 23:03:58', 'pending'),
(27, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Software development', 'hi', '2025-05-02 21:20:53', 'approved'),
(28, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Software Installation', 'hi', '2025-05-05 23:48:13', 'approved'),
(29, 'Jasmin', 'Dungarani', 'utsavdungrani7@gmail.com', 9824123815, '', 'Laptop repairing', 'hi', '2025-05-05 23:50:22', 'rejected'),
(30, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Computer Repair', 'hi', '2025-05-05 23:52:17', 'approved'),
(31, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Laptop repairing', 'hi', '2025-05-05 23:53:19', 'approved'),
(32, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Web development', 'hi', '2025-05-05 23:57:23', 'approved'),
(33, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'hi', '2025-05-23 22:59:30', 'approved'),
(34, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'hi', '2025-05-23 23:01:32', 'approved'),
(35, 'Utsav', 'Dungrani', 'new@gmail.com', 9173283815, '', 'Network solutions', 'i need a service in 1 day..', '2025-05-25 08:44:28', 'approved'),
(36, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Laptop repairing', 'hi', '2025-06-06 03:35:00', 'approved'),
(37, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Laptop repairing', '<script>alert(\"this is me\");</script>', '2025-06-06 21:00:10', 'rejected'),
(38, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'hi1', '2025-08-11 02:48:01', 'pending'),
(39, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Printer toner refill', 'neno', '2025-08-11 02:48:48', 'pending'),
(70, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Laptop repairing', '1230', '2025-08-11 02:50:02', 'pending'),
(71, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Web development', 'nwkldmwlk', '2025-08-11 02:50:41', 'pending'),
(72, 'hdlk', 'jfoq', 'utsavdungrani7@gmail.com', 9173283815, '', 'General services', 'lkjndwejkn', '2025-08-11 02:53:18', 'pending'),
(73, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Computer repairing', 'hi', '2025-08-11 02:55:29', 'pending'),
(74, 'jqwbi', 'ijiji', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'hqiwqnskqjwn d', '2025-08-11 02:56:01', 'approved'),
(75, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 6666666666, '', 'Laptop repairing', 'lwkjbdoweiduwh', '2025-08-11 02:57:55', 'pending'),
(76, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', '`12knenw2dpoewnd', '2025-08-12 03:44:27', 'approved'),
(77, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'General services', 'shjsn', '2025-08-13 18:57:24', 'rejected'),
(78, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'jasjkaskjkasj', '2025-08-14 07:39:25', 'pending'),
(79, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Web development', 'kjnkasn', '2025-08-14 07:41:46', 'pending'),
(80, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Laptop repairing', 'helllo', '2025-08-14 07:43:37', 'approved'),
(81, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'jnkjnkjn', '2025-08-14 07:44:30', 'approved'),
(82, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'General services', 'l;kns;lkdms;lkmd', '2025-08-14 07:47:33', 'rejected'),
(83, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Web development', 'jkhjhkj', '2025-08-14 07:50:24', 'approved'),
(84, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Printer toner refill', 'hii', '2025-08-14 08:49:23', 'rejected'),
(85, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 9173283815, '', 'Network solutions', 'kjndskjndkjsandkjsandkjsandkj', '2025-08-14 10:13:31', 'approved'),
(86, 'Utsav', 'Dungrani', 'utsavdungrani17@gmail.com', 9173283815, 'C-2071 Ocean Park, Bhavnagar, Ocean Park-2', 'Computer repairing', 'hi', '2025-11-26 03:39:20', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `shipping_address` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `product_names` text NOT NULL,
  `quantities` text NOT NULL,
  `prices` text NOT NULL,
  `order_date` datetime NOT NULL,
  `status` enum('pending','processing','shipped','delivered') DEFAULT 'pending',
  `placed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `email`, `first_name`, `last_name`, `phone`, `shipping_address`, `total_amount`, `product_names`, `quantities`, `prices`, `order_date`, `status`, `placed_at`) VALUES
(1, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2306.00, 'Power cable desktop,Wireless mouse', '3,1', '519,700', '2025-04-20 15:41:52', 'shipped', '2025-04-20 04:41:52'),
(2, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2306.00, 'Power cable desktop,Wireless mouse', '3,1', '519,700', '2025-04-20 15:44:12', 'processing', '2025-04-20 04:44:12'),
(3, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1087.00, 'Power cable desktop', '2', '519', '2025-04-20 15:56:46', 'processing', '2025-04-20 04:56:46'),
(4, 'lineviv529@f5url.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1087.00, 'Power cable desktop', '2', '519', '2025-04-20 15:59:21', 'processing', '2025-04-20 04:59:21'),
(5, 'lineviv529@f5url.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 568.00, 'Power cable desktop', '1', '519', '2025-04-20 16:26:42', 'pending', '2025-04-20 05:26:42'),
(6, 'lineviv529@f5url.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-04-20 16:31:04', 'shipped', '2025-04-20 05:31:04'),
(7, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 848.00, 'Charging cable laptop', '1', '799', '2025-04-23 09:52:42', 'pending', '2025-04-22 22:52:42'),
(8, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1628.00, 'Wireless keyboard,Wireless mouse', '1,1', '879,700', '2025-04-23 10:53:26', 'processing', '2025-04-22 23:53:26'),
(9, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-04-25 00:28:28', 'shipped', '2025-04-24 13:28:28'),
(10, 'dahedo3148@ingitel.com', 'Utsav', 'Dungrani', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 4591.00, 'Power cable desktop,Laptop ram DDR1', '4,2', '519,1233', '2025-04-27 11:57:04', 'delivered', '2025-04-27 00:57:04'),
(11, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2149.00, 'Wireless mouse', '3', '700', '2025-05-03 08:24:44', 'shipped', '2025-05-02 21:24:44'),
(12, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1606.00, 'Power cable desktop', '3', '519', '2025-05-06 10:48:57', 'shipped', '2025-05-05 23:48:57'),
(13, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1807.00, 'Wireless keyboard', '2', '879', '2025-05-24 10:17:46', 'shipped', '2025-05-23 23:17:46'),
(14, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1088.00, 'Gaming keyboard', '1', '1039', '2025-05-24 10:19:09', 'pending', '2025-05-23 23:19:09'),
(15, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 4244.00, 'Gaming mouse', '5', '839', '2025-05-24 10:19:59', 'processing', '2025-05-23 23:19:59'),
(16, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1606.00, 'Power cable desktop', '3', '519', '2025-05-25 19:10:45', 'processing', '2025-05-25 08:10:45'),
(17, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 3164.00, 'Power cable desktop,Gaming keyboard', '4,1', '519,1039', '2025-05-25 20:15:55', 'shipped', '2025-05-25 09:15:55'),
(18, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 7966.00, 'Graphics card', '3', '2639', '2025-06-07 14:10:28', 'shipped', '2025-06-07 03:10:28'),
(19, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-08-11 08:27:01', 'shipped', '2025-08-11 02:57:01'),
(20, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 3565.00, 'Wireless keyboard', '4', '879', '2025-08-14 00:28:18', 'processing', '2025-08-13 18:58:18'),
(21, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-08-14 13:48:47', 'shipped', '2025-08-14 08:18:47'),
(22, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 749.00, 'Wireless mouse', '1', '700', '2025-08-14 14:26:59', 'processing', '2025-08-14 08:56:59'),
(23, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2149.00, 'Wireless mouse', '3', '700', '2025-08-14 14:28:58', 'processing', '2025-08-14 08:58:58'),
(24, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-08-14 14:56:57', 'pending', '2025-08-14 09:26:57'),
(25, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2686.00, 'Wireless keyboard', '3', '879', '2025-08-14 15:44:15', 'shipped', '2025-08-14 10:14:15'),
(26, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Ocean Park-2, Bhavnagar, Gujarat - 364002', 2149.00, 'Wireless mouse', '3', '700', '2025-11-26 09:01:58', 'processing', '2025-11-26 03:31:58'),
(27, 'utsavdungrani17@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Ocean Park-2, Bhavnagar, Gujarat - 364002', 568.00, 'Power cable desktop', '1', '519', '2025-11-26 09:04:05', 'shipped', '2025-11-26 03:34:05'),
(28, 'utsavdungrani17@gmail.com', 'Utsav', 'Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Ocean Park-2, Bhavnagar, Gujarat - 364002', 4390.00, 'Hard disk H.D.D', '1', '4341', '2025-11-26 09:12:26', 'shipped', '2025-11-26 03:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `old_price` int(11) NOT NULL,
  `new_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description_small` varchar(500) NOT NULL,
  `description_large` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image_path`, `old_price`, `new_price`, `stock`, `description_small`, `description_large`) VALUES
(1, 'Charging cable laptop', 'uploads/products/product_1_1764081093.jpg', 999, 799, 15, 'This is a polarized power cable designed to connect a wall socket and your Laptop/notebook power brick. The female connector plugs directly into the device while the male connector plugs into a standard outlet. Fits most branded- Laptop Adapter/ Chargers: Universal AU 3-Prong AC Power Cord 3 Pin Adapter Cable.', 'A laptop charging cable is a power cord designed to connect a laptop to an electrical outlet for recharging its battery. It typically has a connector at one end that plugs into the laptop and a standard electrical plug at the other end for connection to a power source.\r\n\r\nThis is a polarized power cable designed to connect a wall socket and your Laptop/notebook power brick. The female connector plugs directly into the device while the male connector plugs into a standard outlet. Fits most branded- Laptop Adapter/ Chargers: Universal AU 3-Prong AC Power Cord 3 Pin Adapter Cable.'),
(2, 'Power cable desktop', 'uploads/products/product_2_1764081093.jpg', 649, 519, 9, 'A power cable, also known as a mains cable, electrical cable, or flex, is a cable that supplies electrical power to a desktop computer. It connects a computer\'s power supply unit (PSU) to a power source, such as an electrical outlet. The PSU then distributes the power to the computer\'s components.', 'A power cable is made of an insulated electrical cable with one or both ends molded with connectors. One end is usually a male connector or plug that goes into the electrical outlet. The other end is a female connector that attaches to the appliance or to another male connector. Power cables are also used with printers, monitors, external speakers, and other peripheral devices that can\'t get enough power through their data cables.\r\n\r\nA power cable, also known as a mains cable, electrical cable, or flex, is a cable that supplies electrical power to a desktop computer. It connects a computer\'s power supply unit (PSU) to a power source, such as an electrical outlet. The PSU then distributes the power to the computer\'s components.'),
(3, 'Wireless keyboard', 'uploads/products/product_3_1764081093.jpg', 1099, 879, 1, 'A wireless keyboard is a computer keyboard that allows the user to communicate with computers, tablets, or laptops with the help of radio frequency (RF), such as WiFi and Bluetooth or with infrared (IR) technology. It is common for wireless keyboards available these days to be accompanied by a wireless mouse.', 'Wireless keyboards based on infrared technology use light waves to transmit signals to other infrared-enabled devices. But, in case of radio frequency technology, a wireless keyboard communicates using signals which range from 27 MHz to up to 2.4 GHz. Most wireless keyboards today work on 2.4 GHz radio frequency.[citation needed] Bluetooth is another technology that is being widely used by wireless keyboards. These devices connect and communicate to their parent device via the bluetooth protocol.\r\n\r\nA wireless keyboard is a computer keyboard that allows the user to communicate with computers, tablets, or laptops with the help of radio frequency (RF), such as WiFi and Bluetooth or with infrared (IR) technology. It is common for wireless keyboards available these days to be accompanied by a wireless mouse.'),
(4, 'Wired keyboard', 'uploads/products/product_4_1764081093.jpg', 700, 576, 15, 'A wired keyboard is a keyboard that connects to a computer using a wire. The wire ends in a USB plug that goes into a USB port on the computer.', 'A wired keyboard means there is a wire connecting your keyboard to your computer. At the end of the wire is a USB plug that goes into a USB port on your computer. Wired keyboards are extremely reliable—there is little that could go wrong with this direct connection.\r\n\r\nA wired keyboard is a keyboard that connects to a computer using a wire. The wire ends in a USB plug that goes into a USB port on the computer.'),
(5, 'Gaming keyboard', 'uploads/products/product_5_1764081093.jpg', 1299, 1039, 14, 'On gaming keyboards, which are mostly mechanical, the key switches require less depression and result in faster action for games. There may also be extra keys that are user configurable for macros.', 'Crafted with strong components and quality materials.\r\n\"BUILT & SUPPORT \": Does not support IPAD TABLET MOBILE Gaming model for long gaming, High quality backlit mouse, Soft wheel in rubber material, Corded, full-size comfort mouse.\r\n\"ERGONOMICAL\": Ergonomically designed, quality keys and soft clicks make for an incredible typing experience.\r\n\r\nOn gaming keyboards, which are mostly mechanical, the key switches require less depression and result in faster action for games. There may also be extra keys that are user configurable for macros.'),
(6, 'Wireless mouse', 'uploads/products/product_6_1764081093.jpg', 875, 700, 4, 'Wireless mice transmit radio signals to a receiver connected to your computer. The computer accepts the signal and decodes how the cursor was moved or what buttons were clicked. While the freedom or range with wireless models is convenient, there are some drawbacks.', 'benefits of wireless mouse: Comfortable, space-saving design.\r\nSturdy build quality.\r\nMultiple color options.\r\nEasy setup.\r\nSupports Windows Swift Pair.\r\nLong rated battery life.\r\nAffordable.\r\nWireless mice transmit radio signals to a receiver connected to your computer. The computer accepts the signal and decodes how the cursor was moved or what buttons were clicked. While the freedom or range with wireless models is convenient, there are some drawbacks.'),
(7, 'Wired mouse', 'uploads/products/product_7_1764081093.jpg', 475, 380, 15, 'A wired mouse connects to a computer or laptop via a USB port or PS/2 port. The cord transmits information, providing fast response times and minimal latency. Wired mice are preferred by gamers for their speed and lack of lag and interference.', 'A wired mouse connects directly to your desktop or laptop, usually through a USB port, and transmits information via the cord. The cord connection provides several key advantages. For starters, wired mice provide fast response times, as the data is transmitted directly through the cable.\r\n\r\nA wired mouse connects to a computer or laptop via a USB port or PS/2 port. The cord transmits information, providing fast response times and minimal latency. Wired mice are preferred by gamers for their speed and lack of lag and interference.'),
(8, 'Gaming mouse', 'uploads/products/product_8_1764081093.jpg', 1049, 839, 10, 'A gaming mouse is a computer mouse designed for gaming.', 'Description\r\nReviews (2)\r\nA gaming mouse is a computer mouse designed for gaming. It\'s different from a regular mouse because it has features like:\r\n\r\nSensitivity: Gaming mice have adjustable sensitivity, which is configurable as the number of dots per inch (DPI). The greater the DPI, the farther the cursor moves on screen with the same amount of mouse movement.\r\n\r\nButtons: Gaming mice have customizable buttons, including a clickable scroll wheel, a button for adjusting sensitivity, and two buttons where your thumb rests.\r\n\r\nDesign: Gaming mice are ergonomically designed.\r\n\r\nResponse time: Gaming mice have faster response times.\r\n\r\nEngine: Gaming mice are usually equipped with a professional game engine, which makes them perform better and react faster.'),
(9, 'Hard disk H.D.D', 'uploads/products/product_9_1764081093.jpg', 5420, 4341, 14, 'A hard disk drive (HDD) is a computer storage device that uses magnetic disks to store data permanently. HDDs are also known as hard disks, hard drives, or fixed disks.', 'HDDs can have storage capacities ranging from 16 GB to over 2 TB. The capacity of a personal computer hard disk is typically between 160 GB and 2 TB. HDDs are electro-mechanical devices that use magnetic storage to store and retrieve data. HDDs are different from solid-state drives (SSDs), which use flash memory and have no moving parts.\r\n\r\nA hard disk drive (HDD) is a computer storage device that uses magnetic disks to store data permanently. HDDs are also known as hard disks, hard drives, or fixed disks.'),
(10, 'S.S.D', 'uploads/products/product_10_1764081093.jpg', 6799, 5439, 15, 'A solid-state drive (SSD) is a storage device that uses flash memory to store data. SSDs are non-volatile, meaning they can store data permanently. They are used in computers and perform the same basic functions as a hard disk drive (HDD).', 'SSDs are more expensive than HDDs, but the price difference has decreased since SSDs first came out. SSDs store data permanently inside an integrated circuit. The flash memory inside an SSD means data is written, transferred, and erased electronically and silently.\r\n\r\nA solid-state drive (SSD) is a storage device that uses flash memory to store data. SSDs are non-volatile, meaning they can store data permanently. They are used in computers and perform the same basic functions as a hard disk drive (HDD).'),
(11, 'NVME', 'uploads/products/product_11_1764081093.jpg', 8799, 3919, 15, 'Non-Volatile Memory Express (NVMe) is a protocol that connects solid-state drive (SSD) storage to CPUs or servers using the PCI Express (PCIe) bus. NVMe was created in 2008 by a group of large IT providers to improve performance and speed.', 'NVMe is a storage interface and transfer protocol for PCIe-based SSDs. It allows for efficient data storage and increased data transfer rates. NVMe is a protocol for highly parallel data transfer with reduced system overheads per input/output (I/O). It takes advantage of the parallel I/O in PCI Express and low latency of SSDs.\r\n\r\nNon-Volatile Memory Express (NVMe) is a protocol that connects solid-state drive (SSD) storage to CPUs or servers using the PCI Express (PCIe) bus. NVMe was created in 2008 by a group of large IT providers to improve performance and speed.'),
(12, 'M.2 NVME', 'uploads/products/product_12_1764081093.jpg', 4723, 3778, 15, 'M.2. NVMe is a communication protocol designed to work with flash memory using the PCIe interface.', 'NVMe M.2 SSDs are much more performance driven compared to SATA M.2 SSDs. By leveraging the PCIe bus, NVMe M.2 SSDs have theoretical transfer speeds of up to 20Gbps which is already faster compared to SATA M.2 SSDs with 6Gbps. PCIe buses can support 1x, 4x, 8x, and 16x lanes.\r\n\r\nM.2. NVMe is a communication protocol designed to work with flash memory using the PCIe interface.'),
(13, 'Desktop ram DDR1', 'uploads/products/product_13_1764081093.jpg', 4723, 3778, 15, 'DDR1 RAM typically has 184 pins and operates at a voltage of 2.5V. It has a maximum rated clock of 400 MHz and a 64-bit (8 bytes) data bus. However, DDR1 is becoming obsolete and is not being produced in large quantities.', 'DDR1, or Double Data Rate, is the second generation of Synchronous DRAM (SDRAM). DDR1 RAM has a bus frequency of 100 MHz and transfers data at a rate of 64 bits per time. It uses double pumping, which is the transmission of data at both the upper and lower edges of the clock signal.\r\n\r\nDDR1 RAM typically has 184 pins and operates at a voltage of 2.5V. It has a maximum rated clock of 400 MHz and a 64-bit (8 bytes) data bus. However, DDR1 is becoming obsolete and is not being produced in large quantities.'),
(14, 'Desktop ram DDR2', 'uploads/products/product_14_1764081093.jpg', 3280, 2620, 15, 'DDR2 was introduced in 2003 and operates twice as fast as DDR due to an improved bus signal.', 'DDR2 was introduced in 2003 and operates twice as fast as DDR due to an improved bus signal. DDR2 uses the same internal clock speed as DDR, however, the transfer rates are faster due to the enhanced input/output bus signal.'),
(15, 'Desktop ram DDR3', 'uploads/products/product_15_1764081093.jpg', 4042, 3233, 15, 'DDR3 modules can transfer data at a rate of 800–2133 MT/s using both rising and falling edges of a 400–1066 MHz I/O clock.', 'DDR3 modules can transfer data at a rate of 800–2133 MT/s using both rising and falling edges of a 400–1066 MHz I/O clock. This is twice DDR2\'s data transfer rates (400–1066 MT/s using a 200–533 MHz I/O clock) and four times the rate of DDR (200–400 MT/s using a 100–200 MHz I/O clock).'),
(16, 'Desktop ram DDR4', 'uploads/products/product_16_1764081093.jpg', 2456, 1964, 15, 'DDR4 RAM is a type of system memory used in computers, laptops, and other devices. It\'s the latest internal computing update designed to improve performance. DDR4 RAM is short for \"double data rate fourth generation synchronous dynamic random-access memory\".', 'Speed and efficiency: DDR4 RAM has higher speed and efficiency due to increased transfer rates and decreased voltage. Power consumption: DDR4 RAM has less voltage and overall power consumption.\r\n\r\nPerformance and bandwidth: DDR4 RAM has 50% better performance and bandwidth than DDR3, and it cuts back voltage by 40%. Signals per cycle: DDR4 can carry two signals per cycle (per Hz).\r\n\r\nData: DDR4-3200 RAM can carry up to 25600 MB/s of data, which is faster than your SSD or hard drive.'),
(17, 'Laptop ram DDR1', 'uploads/products/product_17_1764081093.jpg', 1542, 1233, 13, 'DDR-1 (Double Data Rate 1) is the first generation of DDR Synchronous Dynamic Random Access Memory (SDRAM) in laptop.', 'DDR-1 (Double Data Rate 1) is the first generation of DDR Synchronous Dynamic Random Access Memory (SDRAM). It was an improvement over traditional SDRAM, allowing data to be transferred on both the rising and falling edges of the clock signal, effectively doubling the data transfer rate. DDR-1 memory modules were widely used in computers around the early 2000s, providing faster and more efficient data access compared to its predecessor.');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `page_des` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `page_des`, `description`, `image_path`) VALUES
(2, 'Computer repairing', 'The process of identifying, troubleshooting, and resolving problems with computer hardware or software problems.Computer repair technicians are responsible for diagnosing and fixing problems with computers and other electronic equipment.', '-The process of identifying, troubleshooting, and resolving problems with computer hardware, software, or network/Internet problems.\r\n\r\n-Computer repair technicians are responsible for diagnosing and fixing problems with computers and other electronic equipment.\r\n\r\n-Computer repair technicians may also install, repair, and maintain different computer equipment.\r\n\r\n-They may also be responsible for maintaining internet connectivity, running diagnostic tests, maintaining servers, and providing technical support.', 'uploads/services/service_1764085277_8487.jpg'),
(3, 'Network solutions', 'Network solutions are technologies, services, and products that help with communication and connectivity within computer networks. They aim to improve the security, reliability, and efficiency of data exchange between systems and devices.', '-Network solutions are technologies, services, and products that help with communication and connectivity within computer networks.\r\n\r\n-They aim to improve the security, reliability, and efficiency of data exchange between systems and devices.\r\n\r\n-Network Solutions is also a technology company that helps entrepreneurs start, grow, and manage their businesses online.\r\n\r\n-Their solutions include: Domain names, Hosting, Website design, Online marketing, E-commerce, Website security.\r\n\r\n-Network Solutions also provides technical expertise in the following areas: Networking, Servers, Data storage, Operating systems.\r\n\r\n-Network Solutions\' goal is to migrate standalone systems to a cloud computing environment.', 'uploads/services/service_3_1764081093.jpg'),
(5, 'Laptop repairing', 'Laptop repair is a broad field that involves identifying, troubleshooting, and resolving issues with a laptop\'s hardware, software, or network/Internet problems.', '-Laptop repair is a broad field that involves identifying, troubleshooting, and resolving issues with a laptop\'s hardware, software, or network/Internet problems.\r\n\r\nHere are some aspects of laptop repair:--\r\n\r\nMotherboard repairs:-\r\n\r\n- A dead laptop motherboard can sometimes be fixed with motherboard components, ICs, or IO controller.\r\n\r\n-Chip-level repairs can also be performed to save on the cost of a motherboard replacement.\r\n\r\nChip-level repairs:-\r\n\r\n-If your laptop shuts down unexpectedly, it could be a battery issue.\r\n\r\n-Check to make sure your laptop is plugged in and charging, then turn it on after it\'s had some time to recharge.', 'uploads/services/service_5_1764081093.jpg'),
(6, 'Web development', 'Web development is the process of creating, building, and maintaining websites and web applications. It can also include web design, web programming, and database management.', '-Web development is the process of creating, building, and maintaining websites and web applications.\r\n\r\n-It can also include web design, web programming, and database management.\r\n\r\n-Web developers are responsible for ensuring that websites are visually appealing, easy to navigate, and perform well.\r\n\r\n-They may also be responsible for the website\'s performance and capacity, such as its speed and how much traffic it can handle.', 'uploads/services/service_6_1764081093.jpg'),
(9, 'General services', 'General services are support services that require specialized knowledge, experience, or expertise, Pest control, Janitorial services, Laundry services, Catering services, Security services, Lawn maintenance services, Equipment maintenance.', '-General services are support services that require specialized knowledge, experience, or expertise.\r\n\r\n-These services include: Pest control, Janitorial services, Laundry services, Catering services, Security services, Lawn maintenance services, Equipment maintenance.\r\n\r\nGeneral services roles include:-\r\n\r\n-Administrative, Secretarial, Clerical support, Building maintenance.\r\n\r\n-A general services department\'s mission is to provide leadership and best practices in managing.', 'uploads/services/service_9_1764081093.jpg'),
(11, 'Printer toner refill', 'Toner cartridge refill is the process of replenishing used laser printer cartridges with toner powder to restore printing capability. Worn-out parts like the wiper blade or PCR (Primary Charge Roller) may be replaced for better performance.', 'Toner Cartridge Refill\r\n-Toner cartridge refill is the process of replenishing used laser printer cartridges with toner powder to restore printing capability.\r\n\r\nHere are some aspects of toner cartridge refill:--\r\n\r\nToner Powder Refill:\r\n-The cartridge is opened carefully, and residual toner is removed to prevent mixing with new powder.\r\n-High-quality toner powder is added using a funnel or refill tool specific to the cartridge model.\r\n-It\'s important to match the toner type with the printer model to avoid compatibility issues.\r\n\r\nCleaning and Maintenance:\r\n-The drum unit and rollers are cleaned to prevent smudges, streaks, or faded prints.\r\n-Worn-out parts like the wiper blade or PCR (Primary Charge Roller) may be replaced for better performance.', 'uploads/services/service_11_1764081093.jpg'),
(13, 'Web-App development', 'Mobile application development is the process of making software for smartphones, tablets and digital assistants, most commonly for the Android and iOS operating systems.', '-Mobile app development is rapidly growing.\r\n\r\n-From retail, telecommunications and e-commerce to insurance, healthcare and government, organizations across industries must meet user expectations for real-time, convenient ways to conduct transactions and access information.\r\n\r\n-Today, mobile devices—and the mobile applications that unlock their value—are the most popular way for people and businesses to connect to the internet.\r\n\r\nWeb developers may also:-\r\n\r\n-Mobile application development is the process of making software for smartphones, tablets and digital assistants, most commonly for the Android and iOS operating systems.', 'uploads/services/service_13_1764081093.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Contact no` bigint(30) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `Name`, `Address`, `Contact no`, `image_path`) VALUES
(1, 'A.M Solution', 'Ashtavinayak 7, G-2, Opp. Muktalaxmi Girls High School, Bhavnagar, Gujarat, India', 9327181052, 'uploads/shop/shop_1_1764081093.jpg'),
(2, 'Advance Computer', '107, EVA Complex, Gulista Ground, Opp. Gulista Ground, Bhavnagar, Gujarat, India', 9574183636, 'uploads/shop/shop_2_1764081093.jpg'),
(3, 'Akshar Infoware Sales And Services', 'F/F 6 Victory Prime, Near Kaliyabid Water Tank, Bhavnagar, Gujarat, India', 9375307306, 'uploads/shop/shop_3_1764081093.jpg'),
(4, 'Alphabet Computer Consultancy', '105/106, Shilpgram Complex, St. Kanvarra Chowk, Kalvibid, Bhavnagar, Gujarat, India', 7947137065, 'uploads/shop/shop_4_1764081093.jpg'),
(5, 'AM Solution', 'G-2, Ashtavinayak 7, Nawa Para, Opposite Muktalaxmi Girls High School, Bhavnagar, Gujarat, India', 9327181052, 'uploads/shop/shop_5_1764081093.jpg'),
(6, 'Apex Computer', 'Shop No 2, Ashish Jyot Complex, Bhavnagar, 364001', 7942685500, 'uploads/shop/shop_6_1764081093.jpg'),
(7, 'Atmiya Enterprise', 'No 32, Virbhadra Shopping Center, Nilambag Circle, Bhavnagar, Gujarat, India', 9376737373, 'uploads/shop/shop_7_1764081093.jpg'),
(8, 'Bapa Sitaram Computers', 'Office No:101, First Floor, Sagar Complex, Kaliyabid, Bhavnagar, Gujarat, India', 9426241180, 'uploads/shop/shop_8_1764081093.jpg'),
(9, 'Bansi Computer And Technology', 'Shop No 111, 1st Floor, Surabhi Mall, Waghawadi Road, Bhavnagar, Gujarat, India', 9377630063, 'uploads/shop/shop_9_1764081093.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `phone`, `address`, `photo_path`, `created_at`, `password`, `reg_date`) VALUES
(1, 'Utsav', 'utsavdungrani7@gmail.com', 'Utsav Dungrani', '9173283815', 'C-2071 Ocean Park, Bhavnagar\r\nOcean Park-2', 'uploads/profiles/profile_1_1764081093.jpg', '2025-08-06 02:57:27', '$2y$10$LND.Odw1uSmR3h/3S8SX2emJeFzs.LZGSFVyHDE9EBzG8JHJLom3m', '2025-04-06 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookser`
--
ALTER TABLE `bookser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookser`
--
ALTER TABLE `bookser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
