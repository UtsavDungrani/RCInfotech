-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 04:19 AM
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
(4, 'new', '$2y$10$KyGBxvc.PeFpwiM5cq4otuJ8ZCauODSXtTFouVQBmU0zVH/XKiHHe', '2025-04-11 02:58:30'),
(5, 'admin', '$2y$10$d96Md9kmfKajGxV9WTjo0eWFDVaaQfEcRsQduo62R6CeeFbpAeHhm', '2025-04-11 02:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `bookser`
--

CREATE TABLE `bookser` (
  `id` int(11) NOT NULL,
  `fname` text DEFAULT NULL,
  `lname` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `booked_by_email` varchar(55) DEFAULT NULL,
  `mobile` bigint(11) NOT NULL DEFAULT current_timestamp(),
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('approved','rejected','pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookser`
--

INSERT INTO `bookser` (`id`, `fname`, `lname`, `email`, `booked_by_email`, `mobile`, `subject`, `description`, `booking_time`, `status`) VALUES
(7, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 2147483647, 'General services', 'hi', '2025-04-18 04:42:04', 'pending'),
(8, 'Ayush', 'Joshi', 'ayushjoshi876@gmail.com', 'ayushjoshi876@gmail.com', 1234567890, 'Web development', 'hi', '2025-04-18 04:48:06', 'pending'),
(9, 'Jasmin', 'Dungarani', 'ayushjoshi876@gmail.com', 'ayushjoshi876@gmail.com', 2147483647, 'Laptop repairing', 'hi', '2025-04-18 04:48:52', 'pending'),
(10, 'Jasmin', 'Dungarani', 'purusharthengineering9@gmail.com', 'ayushjoshi876@gmail.com', 2147483647, 'Laptop repairing', 'hi', '2025-04-18 04:52:55', 'pending'),
(12, 'Utsav', 'Dungrani', 'utsavdungrani117@gmail.com', 'utsavdungrani7@gmail.com', 2147483647, 'Laptop repairing', 'hi', '2025-04-18 04:57:38', 'pending'),
(13, 'Utsav', 'Dungrani', 'utsav7@gmail.com', 'utsavdungrani7@gmail.com', 2147483647, 'General services', 'hi', '2025-04-18 05:25:37', 'approved'),
(14, 'Utsav', 'Dungrani', 'utsav7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'General services', 'hi', '2025-04-18 05:28:51', 'pending'),
(15, 'lin', 'eve', '', 'lineviv529@f5url.com', 9173283815, 'Computer Repair', 'hi', '2025-04-19 04:45:08', 'rejected'),
(16, 'AMD', '`123', '', 'lineviv529@f5url.com', 1234567890, 'Laptop repairing', 'need new service', '2025-04-19 05:43:24', 'rejected'),
(17, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'lineviv529@f5url.com', 9173283815, 'Data Recovery', 'hi', '2025-04-20 05:15:58', 'pending'),
(18, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'lineviv529@f5url.com', 9173283815, 'Software development', 'i need person', '2025-04-20 11:02:29', 'approved'),
(19, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Laptop repairing', 'hi', '2025-04-23 05:25:17', 'approved'),
(20, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Computer Repair', 'hi1', '2025-04-23 05:48:08', 'pending'),
(21, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Network Solutions', 'hello', '2025-04-23 05:52:59', 'approved'),
(22, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Web development', 'the new service', '2025-04-24 18:47:24', 'approved'),
(23, 'Utsav', 'Dungrani', 'dahedo3148@ingitel.com', 'dahedo3148@ingitel.com', 9173283815, 'Network Solutions', 'hi', '2025-04-27 06:24:42', 'approved'),
(24, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'App development', 'hgvgvhg', '2025-05-01 04:24:37', 'pending'),
(25, 'Utsav', 'Dungrani', 'wejole9158@harinv.com', 'wejole9158@harinv.com', 9173283815, 'Web development', 'ijjoijoijoijoijoijso[\'iqdju2oiwqkdnweokmc', '2025-05-01 04:29:16', 'pending'),
(26, 'Ayush', 'Joshi', 'ayushjoshi876@gmail.com', 'ayushjoshi876@gmail.com', 1234567890, 'App development', 'new service', '2025-05-01 04:33:58', 'pending'),
(27, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Software development', 'hi', '2025-05-03 02:50:53', 'approved'),
(28, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Software Installation', 'hi', '2025-05-06 05:18:13', 'pending'),
(29, 'Jasmin', 'Dungarani', 'purusharthengineering9@gmail.com', 'utsavdungrani7@gmail.com', 9824123815, 'Laptop repairing', 'hi', '2025-05-06 05:20:22', 'pending'),
(30, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Computer Repair', 'hi', '2025-05-06 05:22:17', 'pending'),
(31, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Laptop repairing', 'hi', '2025-05-06 05:23:19', 'pending'),
(32, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Web development', 'hi', '2025-05-06 05:27:23', 'pending'),
(33, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Network solutions', 'hi', '2025-05-24 04:29:30', 'approved'),
(34, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'utsavdungrani7@gmail.com', 9173283815, 'Network solutions', 'hi', '2025-05-24 04:31:32', 'approved'),
(35, 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', 'new@gmail.com', 9173283815, 'Network solutions', 'i need a service in 1 day..', '2025-05-25 14:14:28', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(55) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
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

INSERT INTO `orders` (`id`, `user_email`, `first_name`, `last_name`, `email`, `phone`, `shipping_address`, `total_amount`, `product_names`, `quantities`, `prices`, `order_date`, `status`, `placed_at`) VALUES
(1, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2306.00, 'Power cable desktop,Wireless mouse', '3,1', '519,700', '2025-04-20 15:41:52', 'shipped', '2025-04-20 10:11:52'),
(2, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2306.00, 'Power cable desktop,Wireless mouse', '3,1', '519,700', '2025-04-20 15:44:12', 'processing', '2025-04-20 10:14:12'),
(3, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1087.00, 'Power cable desktop', '2', '519', '2025-04-20 15:56:46', 'processing', '2025-04-20 10:26:46'),
(4, 'lineviv529@f5url.com', 'Utsav', 'Dungrani', 'lineviv529@f5url.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1087.00, 'Power cable desktop', '2', '519', '2025-04-20 15:59:21', 'processing', '2025-04-20 10:29:21'),
(5, 'lineviv529@f5url.com', 'Utsav', 'Dungrani', 'lineviv529@f5url.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 568.00, 'Power cable desktop', '1', '519', '2025-04-20 16:26:42', 'pending', '2025-04-20 10:56:42'),
(6, 'lineviv529@f5url.com', 'Utsav', 'Dungrani', 'lineviv529@f5url.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-04-20 16:31:04', 'shipped', '2025-04-20 11:01:04'),
(7, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 848.00, 'Charging cable laptop', '1', '799', '2025-04-23 09:52:42', 'pending', '2025-04-23 04:22:42'),
(8, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1628.00, 'Wireless keyboard,Wireless mouse', '1,1', '879,700', '2025-04-23 10:53:26', 'processing', '2025-04-23 05:23:26'),
(9, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 928.00, 'Wireless keyboard', '1', '879', '2025-04-25 00:28:28', 'shipped', '2025-04-24 18:58:28'),
(10, 'dahedo3148@ingitel.com', 'Utsav', 'Dungrani', 'dahedo3148@ingitel.com', '09173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 4591.00, 'Power cable desktop,Laptop ram DDR1', '4,2', '519,1233', '2025-04-27 11:57:04', 'delivered', '2025-04-27 06:27:04'),
(11, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 2149.00, 'Wireless mouse', '3', '700', '2025-05-03 08:24:44', 'shipped', '2025-05-03 02:54:44'),
(12, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1606.00, 'Power cable desktop', '3', '519', '2025-05-06 10:48:57', 'pending', '2025-05-06 05:18:57'),
(13, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1807.00, 'Wireless keyboard', '2', '879', '2025-05-24 10:17:46', 'shipped', '2025-05-24 04:47:46'),
(14, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1088.00, 'Gaming keyboard', '1', '1039', '2025-05-24 10:19:09', 'pending', '2025-05-24 04:49:09'),
(15, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 4244.00, 'Gaming mouse', '5', '839', '2025-05-24 10:19:59', 'processing', '2025-05-24 04:49:59'),
(16, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 1606.00, 'Power cable desktop', '3', '519', '2025-05-25 19:10:45', 'processing', '2025-05-25 13:40:45'),
(17, 'utsavdungrani7@gmail.com', 'Utsav', 'Dungrani', 'utsavdungrani7@gmail.com', '9173283815', 'C-2071 Ocean Park, Bhavnagar, Bhavnagar, Gujarat - 364002', 3164.00, 'Power cable desktop,Gaming keyboard', '4,1', '519,1039', '2025-05-25 20:15:55', 'processing', '2025-05-25 14:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `old_price` int(11) NOT NULL,
  `new_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description_small` varchar(500) NOT NULL,
  `description_large` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `old_price`, `new_price`, `stock`, `description_small`, `description_large`) VALUES
(1, 'Charging cable laptop', 'uploads/67e623d2db78d_O_1.jpeg', 999, 799, 15, 'This is a polarized power cable designed to connect a wall socket and your Laptop/notebook power brick. The female connector plugs directly into the device while the male connector plugs into a standard outlet. Fits most branded- Laptop Adapter/ Chargers: Universal AU 3-Prong AC Power Cord 3 Pin Adapter Cable.', 'A laptop charging cable is a power cord designed to connect a laptop to an electrical outlet for recharging its battery. It typically has a connector at one end that plugs into the laptop and a standard electrical plug at the other end for connection to a power source.\r\n\r\nThis is a polarized power cable designed to connect a wall socket and your Laptop/notebook power brick. The female connector plugs directly into the device while the male connector plugs into a standard outlet. Fits most branded- Laptop Adapter/ Chargers: Universal AU 3-Prong AC Power Cord 3 Pin Adapter Cable.'),
(2, 'Power cable desktop', 'uploads/1738582152_O_2.png', 649, 519, 13, 'A power cable, also known as a mains cable, electrical cable, or flex, is a cable that supplies electrical power to a desktop computer. It connects a computer\'s power supply unit (PSU) to a power source, such as an electrical outlet. The PSU then distributes the power to the computer\'s components.', 'A power cable is made of an insulated electrical cable with one or both ends molded with connectors. One end is usually a male connector or plug that goes into the electrical outlet. The other end is a female connector that attaches to the appliance or to another male connector. Power cables are also used with printers, monitors, external speakers, and other peripheral devices that can\'t get enough power through their data cables.\r\n\r\nA power cable, also known as a mains cable, electrical cable, or flex, is a cable that supplies electrical power to a desktop computer. It connects a computer\'s power supply unit (PSU) to a power source, such as an electrical outlet. The PSU then distributes the power to the computer\'s components.'),
(3, 'Wireless keyboard', 'uploads/1738582340_O_3.jpg', 1099, 879, 10, 'A wireless keyboard is a computer keyboard that allows the user to communicate with computers, tablets, or laptops with the help of radio frequency (RF), such as WiFi and Bluetooth or with infrared (IR) technology. It is common for wireless keyboards available these days to be accompanied by a wireless mouse.', 'Wireless keyboards based on infrared technology use light waves to transmit signals to other infrared-enabled devices. But, in case of radio frequency technology, a wireless keyboard communicates using signals which range from 27 MHz to up to 2.4 GHz. Most wireless keyboards today work on 2.4 GHz radio frequency.[citation needed] Bluetooth is another technology that is being widely used by wireless keyboards. These devices connect and communicate to their parent device via the bluetooth protocol.\n\nA wireless keyboard is a computer keyboard that allows the user to communicate with computers, tablets, or laptops with the help of radio frequency (RF), such as WiFi and Bluetooth or with infrared (IR) technology. It is common for wireless keyboards available these days to be accompanied by a wireless mouse.'),
(4, 'Wired keyboard', 'uploads/1738582413_O_4.png', 700, 576, 15, 'A wired keyboard is a keyboard that connects to a computer using a wire. The wire ends in a USB plug that goes into a USB port on the computer.', 'A wired keyboard means there is a wire connecting your keyboard to your computer. At the end of the wire is a USB plug that goes into a USB port on your computer. Wired keyboards are extremely reliable—there is little that could go wrong with this direct connection.\n\nA wired keyboard is a keyboard that connects to a computer using a wire. The wire ends in a USB plug that goes into a USB port on the computer.'),
(5, 'Gaming keyboard', 'uploads/1738582668_O_5.jpeg', 1299, 1039, 14, 'On gaming keyboards, which are mostly mechanical, the key switches require less depression and result in faster action for games. There may also be extra keys that are user configurable for macros.', 'Crafted with strong components and quality materials.\n\"BUILT & SUPPORT \": Does not support IPAD TABLET MOBILE Gaming model for long gaming, High quality backlit mouse, Soft wheel in rubber material, Corded, full-size comfort mouse.\n\"ERGONOMICAL\": Ergonomically designed, quality keys and soft clicks make for an incredible typing experience.\n\nOn gaming keyboards, which are mostly mechanical, the key switches require less depression and result in faster action for games. There may also be extra keys that are user configurable for macros.'),
(6, 'Wireless mouse', 'uploads/1738582903_O_6.png', 875, 700, 11, 'Wireless mice transmit radio signals to a receiver connected to your computer. The computer accepts the signal and decodes how the cursor was moved or what buttons were clicked. While the freedom or range with wireless models is convenient, there are some drawbacks.', 'benefits of wireless mouse: Comfortable, space-saving design.\nSturdy build quality.\nMultiple color options.\nEasy setup.\nSupports Windows Swift Pair.\nLong rated battery life.\nAffordable.\nWireless mice transmit radio signals to a receiver connected to your computer. The computer accepts the signal and decodes how the cursor was moved or what buttons were clicked. While the freedom or range with wireless models is convenient, there are some drawbacks.'),
(7, 'Wired mouse', 'uploads/1738583081_O_7.png', 475, 380, 15, 'A wired mouse connects to a computer or laptop via a USB port or PS/2 port. The cord transmits information, providing fast response times and minimal latency. Wired mice are preferred by gamers for their speed and lack of lag and interference.', 'A wired mouse connects directly to your desktop or laptop, usually through a USB port, and transmits information via the cord. The cord connection provides several key advantages. For starters, wired mice provide fast response times, as the data is transmitted directly through the cable.\n\nA wired mouse connects to a computer or laptop via a USB port or PS/2 port. The cord transmits information, providing fast response times and minimal latency. Wired mice are preferred by gamers for their speed and lack of lag and interference.'),
(8, 'Gaming mouse', 'uploads/1738583239_O_8.png', 1049, 839, 10, 'A gaming mouse is a computer mouse designed for gaming.', 'Description\nReviews (2)\nA gaming mouse is a computer mouse designed for gaming. It\'s different from a regular mouse because it has features like:\n\nSensitivity: Gaming mice have adjustable sensitivity, which is configurable as the number of dots per inch (DPI). The greater the DPI, the farther the cursor moves on screen with the same amount of mouse movement.\n\nButtons: Gaming mice have customizable buttons, including a clickable scroll wheel, a button for adjusting sensitivity, and two buttons where your thumb rests.\n\nDesign: Gaming mice are ergonomically designed.\n\nResponse time: Gaming mice have faster response times.\n\nEngine: Gaming mice are usually equipped with a professional game engine, which makes them perform better and react faster.'),
(9, 'Hard disk H.D.D', 'uploads/1738583333_O_9.png', 5420, 4341, 15, 'A hard disk drive (HDD) is a computer storage device that uses magnetic disks to store data permanently. HDDs are also known as hard disks, hard drives, or fixed disks.', 'HDDs can have storage capacities ranging from 16 GB to over 2 TB. The capacity of a personal computer hard disk is typically between 160 GB and 2 TB. HDDs are electro-mechanical devices that use magnetic storage to store and retrieve data. HDDs are different from solid-state drives (SSDs), which use flash memory and have no moving parts.\n\nA hard disk drive (HDD) is a computer storage device that uses magnetic disks to store data permanently. HDDs are also known as hard disks, hard drives, or fixed disks.'),
(10, 'S.S.D', 'uploads/1738583397_O_10.jpeg', 6799, 5439, 15, 'A solid-state drive (SSD) is a storage device that uses flash memory to store data. SSDs are non-volatile, meaning they can store data permanently. They are used in computers and perform the same basic functions as a hard disk drive (HDD).', 'SSDs are more expensive than HDDs, but the price difference has decreased since SSDs first came out. SSDs store data permanently inside an integrated circuit. The flash memory inside an SSD means data is written, transferred, and erased electronically and silently.\n\nA solid-state drive (SSD) is a storage device that uses flash memory to store data. SSDs are non-volatile, meaning they can store data permanently. They are used in computers and perform the same basic functions as a hard disk drive (HDD).'),
(11, 'NVME', 'uploads/1738583642_O_11.png', 8799, 3919, 15, 'Non-Volatile Memory Express (NVMe) is a protocol that connects solid-state drive (SSD) storage to CPUs or servers using the PCI Express (PCIe) bus. NVMe was created in 2008 by a group of large IT providers to improve performance and speed.', 'NVMe is a storage interface and transfer protocol for PCIe-based SSDs. It allows for efficient data storage and increased data transfer rates. NVMe is a protocol for highly parallel data transfer with reduced system overheads per input/output (I/O). It takes advantage of the parallel I/O in PCI Express and low latency of SSDs.\n\nNon-Volatile Memory Express (NVMe) is a protocol that connects solid-state drive (SSD) storage to CPUs or servers using the PCI Express (PCIe) bus. NVMe was created in 2008 by a group of large IT providers to improve performance and speed.'),
(12, 'M.2 NVME', 'uploads/1738583723_O_12.png', 4723, 3778, 15, 'M.2. NVMe is a communication protocol designed to work with flash memory using the PCIe interface.', 'NVMe M.2 SSDs are much more performance driven compared to SATA M.2 SSDs. By leveraging the PCIe bus, NVMe M.2 SSDs have theoretical transfer speeds of up to 20Gbps which is already faster compared to SATA M.2 SSDs with 6Gbps. PCIe buses can support 1x, 4x, 8x, and 16x lanes.\n\nM.2. NVMe is a communication protocol designed to work with flash memory using the PCIe interface.'),
(13, 'Desktop ram DDR1', 'uploads/1738583779_O_13.png', 4723, 3778, 15, 'DDR1 RAM typically has 184 pins and operates at a voltage of 2.5V. It has a maximum rated clock of 400 MHz and a 64-bit (8 bytes) data bus. However, DDR1 is becoming obsolete and is not being produced in large quantities.', 'DDR1, or Double Data Rate, is the second generation of Synchronous DRAM (SDRAM). DDR1 RAM has a bus frequency of 100 MHz and transfers data at a rate of 64 bits per time. It uses double pumping, which is the transmission of data at both the upper and lower edges of the clock signal.\n\nDDR1 RAM typically has 184 pins and operates at a voltage of 2.5V. It has a maximum rated clock of 400 MHz and a 64-bit (8 bytes) data bus. However, DDR1 is becoming obsolete and is not being produced in large quantities.'),
(14, 'Desktop ram DDR2', 'uploads/1738583839_O_14.png', 3280, 2620, 15, 'DDR2 was introduced in 2003 and operates twice as fast as DDR due to an improved bus signal.', 'DDR2 was introduced in 2003 and operates twice as fast as DDR due to an improved bus signal. DDR2 uses the same internal clock speed as DDR, however, the transfer rates are faster due to the enhanced input/output bus signal.'),
(15, 'Desktop ram DDR3', 'uploads/1738587519_O_15.png', 4042, 3233, 15, 'DDR3 modules can transfer data at a rate of 800–2133 MT/s using both rising and falling edges of a 400–1066 MHz I/O clock.', 'DDR3 modules can transfer data at a rate of 800–2133 MT/s using both rising and falling edges of a 400–1066 MHz I/O clock. This is twice DDR2\'s data transfer rates (400–1066 MT/s using a 200–533 MHz I/O clock) and four times the rate of DDR (200–400 MT/s using a 100–200 MHz I/O clock).'),
(16, 'Desktop ram DDR4', 'uploads/1738587590_O_16.png', 2456, 1964, 15, 'DDR4 RAM is a type of system memory used in computers, laptops, and other devices. It\'s the latest internal computing update designed to improve performance. DDR4 RAM is short for \"double data rate fourth generation synchronous dynamic random-access memory\".', 'Speed and efficiency: DDR4 RAM has higher speed and efficiency due to increased transfer rates and decreased voltage. Power consumption: DDR4 RAM has less voltage and overall power consumption.\n\nPerformance and bandwidth: DDR4 RAM has 50% better performance and bandwidth than DDR3, and it cuts back voltage by 40%. Signals per cycle: DDR4 can carry two signals per cycle (per Hz).\n\nData: DDR4-3200 RAM can carry up to 25600 MB/s of data, which is faster than your SSD or hard drive.'),
(17, 'Laptop ram DDR1', 'uploads/1738587703_O_17.png', 1542, 1233, 13, 'DDR-1 (Double Data Rate 1) is the first generation of DDR Synchronous Dynamic Random Access Memory (SDRAM) in laptop.', 'DDR-1 (Double Data Rate 1) is the first generation of DDR Synchronous Dynamic Random Access Memory (SDRAM). It was an improvement over traditional SDRAM, allowing data to be transferred on both the rising and falling edges of the clock signal, effectively doubling the data transfer rate. DDR-1 memory modules were widely used in computers around the early 2000s, providing faster and more efficient data access compared to its predecessor.'),
(18, 'Laptop ram DDR2', 'uploads/1738587834_O_18.png', 3028, 2422, 15, 'DDR2 (Double Data Rate 2) is the second generation of DDR Synchronous Dynamic Random Access Memory. It brought further improvements over DDR1 by increasing the data transfer rates and providing better power efficiency.', 'DDR2 (Double Data Rate 2) is the second generation of DDR Synchronous Dynamic Random Access Memory. It brought further improvements over DDR1 by increasing the data transfer rates and providing better power efficiency. DDR2 RAM modules have a higher bandwidth and are capable of reaching higher speeds compared to DDR1. They were commonly used in computers from the mid-2000s, offering enhanced performance and efficiency in comparison to the earlier DDR technology.'),
(19, 'Laptop ram DDR3', 'uploads/1738587907_O_19.png', 4042, 3233, 15, 'DDR3 (Double Data Rate 3) is the third generation of DDR Synchronous Dynamic Random Access Memory. It continued the trend of increasing data transfer rates and efficiency.', 'DDR3 (Double Data Rate 3) is the third generation of DDR Synchronous Dynamic Random Access Memory. It continued the trend of increasing data transfer rates and efficiency. DDR3 RAM modules provided higher bandwidth and lower power consumption compared to DDR2. Introduced in the mid-2000s, DDR3 became widely adopted in computer systems, contributing to improved overall performance and better multitasking capabilities.'),
(20, 'Laptop ram DDR4', 'uploads/1738589065_O_20.png', 3036, 2436, 15, 'DDR4 (Double Data Rate 4) is the fourth generation of DDR Synchronous Dynamic Random Access Memory. It brought further advancements over DDR3, offering higher data transfer rates, increased module capacity, and improved energy efficiency.', 'DDR4 (Double Data Rate 4) is the fourth generation of DDR Synchronous Dynamic Random Access Memory. It brought further advancements over DDR3, offering higher data transfer rates, increased module capacity, and improved energy efficiency. DDR4 RAM modules are commonly found in modern computers and servers, providing enhanced performance and supporting higher memory capacities. Introduced in the early 2010s, DDR4 has become the standard for new systems, contributing to faster and more efficient memory access.'),
(21, 'Cabinate', 'uploads/1738589154_O_21.jpeg', 5549, 4439, 15, 'A computer cabinet, often referred to as a computer case or chassis, is an enclosure that houses the internal components of a computer.', 'A computer cabinet, often referred to as a computer case or chassis, is an enclosure that houses the internal components of a computer. It provides protection, cooling, and organization for the essential hardware components such as the motherboard, CPU, storage devices, and power supply. Computer cabinets come in various sizes and designs to accommodate different form factors and preferences.'),
(22, 'Gaming cabinate', 'uploads/1738589254_O_22.png', 56549, 45239, 15, 'A gaming computer cabinet, or gaming case, is a specialized enclosure designed to house high-performance components for gaming PCs.', 'A gaming computer cabinet, or gaming case, is a specialized enclosure designed to house high-performance components for gaming PCs. These cases often feature enhanced cooling systems, RGB lighting, and ergonomic designs. Gaming cabinets are tailored to accommodate powerful graphics cards, cooling solutions, and additional features for optimal gaming performance and aesthetics.'),
(23, 'Graphics card', 'uploads/1738589329_O_23.jpeg', 3299, 2639, 150, 'A graphics card, also known as a GPU (Graphics Processing Unit), is a crucial component in a computer that specializes in rendering images and videos.', 'A graphics card, also known as a GPU (Graphics Processing Unit), is a crucial component in a computer that specializes in rendering images and videos. It processes and accelerates graphics data, enhancing visual performance for tasks like gaming, video editing, and graphic design. The graphics card connects to the motherboard and often has its own dedicated video memory for faster and more efficient rendering.'),
(24, 'Motherboard', 'uploads/1738589400_O_24.jpeg', 6559, 5247, 20, 'A graphics card, also known as a GPU (Graphics Processing Unit), is a crucial component in a computer that specializes in rendering images and videos.', 'A graphics card, also known as a GPU (Graphics Processing Unit), is a crucial component in a computer that specializes in rendering images and videos. It processes and accelerates graphics data, enhancing visual performance for tasks like gaming, video editing, and graphic design. The graphics card connects to the motherboard and often has its own dedicated video memory for faster and more efficient rendering.');

-- --------------------------------------------------------

--
-- Table structure for table `rg`
--

CREATE TABLE `rg` (
  `id` int(3) NOT NULL,
  `catagory` text NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text NOT NULL,
  `price` varchar(60) NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `rg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rg`
--

INSERT INTO `rg` (`id`, `catagory`, `product_name`, `product_description`, `price`, `product_image`, `rg_date`) VALUES
(39, 'choise', '', '', '', 'wallpaperflare.com_wallpaper (2).jpg', '0000-00-00 00:00:00'),
(40, 'choise', '', '', '', 'wallpaperflare.com_wallpaper (2).jpg', '0000-00-00 00:00:00'),
(41, 'NVME', 'hgf', 'sdc', '250', 'wallpaperflare.com_wallpaper (2).jpg', '0000-00-00 00:00:00'),
(42, 'NVME', '1.mouse', 'gaming mouse', '34550', 'latitude and longitude.jpg', '0000-00-00 00:00:00');

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
(2, 'Computer repairing', 'The process of identifying, troubleshooting, and resolving problems with computer hardware or software problems.Computer repair technicians are responsible for diagnosing and fixing problems with computers and other electronic equipment.', '-The process of identifying, troubleshooting, and resolving problems with computer hardware, software, or network/Internet problems.\n\n-Computer repair technicians are responsible for diagnosing and fixing problems with computers and other electronic equipment.\n\n-Computer repair technicians may also install, repair, and maintain different computer equipment.\n\n-They may also be responsible for maintaining internet connectivity, running diagnostic tests, maintaining servers, and providing technical support.', 'uploads/1739200811_Service_2.png'),
(3, 'Network solutions', 'Network solutions are technologies, services, and products that help with communication and connectivity within computer networks. They aim to improve the security, reliability, and efficiency of data exchange between systems and devices.', '-Network solutions are technologies, services, and products that help with communication and connectivity within computer networks.\n\n-They aim to improve the security, reliability, and efficiency of data exchange between systems and devices.\n\n-Network Solutions is also a technology company that helps entrepreneurs start, grow, and manage their businesses online.\n\n-Their solutions include: Domain names, Hosting, Website design, Online marketing, E-commerce, Website security.\n\n-Network Solutions also provides technical expertise in the following areas: Networking, Servers, Data storage, Operating systems.\n\n-Network Solutions\' goal is to migrate standalone systems to a cloud computing environment.', 'uploads/1739201407_Service_3.jpeg'),
(5, 'Laptop repairing', 'Laptop repair is a broad field that involves identifying, troubleshooting, and resolving issues with a laptop\'s hardware, software, or network/Internet problems.', '-Laptop repair is a broad field that involves identifying, troubleshooting, and resolving issues with a laptop\'s hardware, software, or network/Internet problems.\r\n\r\nHere are some aspects of laptop repair:--\r\n\r\nMotherboard repairs:-\r\n\r\n- A dead laptop motherboard can sometimes be fixed with motherboard components, ICs, or IO controller.\r\n\r\n-Chip-level repairs can also be performed to save on the cost of a motherboard replacement.\r\n\r\nChip-level repairs:-\r\n\r\n-If your laptop shuts down unexpectedly, it could be a battery issue.\r\n\r\n-Check to make sure your laptop is plugged in and charging, then turn it on after it\'s had some time to recharge.', 'uploads/1739417044_Service_5.jpg'),
(6, 'Web development', 'Web development is the process of creating, building, and maintaining websites and web applications. It can also include web design, web programming, and database management.', '-Web development is the process of creating, building, and maintaining websites and web applications.\r\n\r\n-It can also include web design, web programming, and database management.\r\n\r\n-Web developers are responsible for ensuring that websites are visually appealing, easy to navigate, and perform well.\r\n\r\n-They may also be responsible for the website\'s performance and capacity, such as its speed and how much traffic it can handle.', 'uploads/1739417247_Service_6.jpeg'),
(8, 'Web-App development', 'Mobile application development is the process of making software for smartphones, tablets and digital assistants, most commonly for the Android and iOS operating systems.', '-Mobile app development is rapidly growing.\r\n\r\n-From retail, telecommunications and e-commerce to insurance, healthcare and government, organizations across industries must meet user expectations for real-time, convenient ways to conduct transactions and access information.\r\n\r\n-Today, mobile devices—and the mobile applications that unlock their value—are the most popular way for people and businesses to connect to the internet.\r\n\r\nWeb developers may also:-\r\n\r\n-Mobile application development is the process of making software for smartphones, tablets and digital assistants, most commonly for the Android and iOS operating systems.', 'uploads/68342275d0d7b_technology-stack-for-web-application-main.jpg'),
(9, 'General services', 'General services are support services that require specialized knowledge, experience, or expertise, Pest control, Janitorial services, Laundry services, Catering services, Security services, Lawn maintenance services, Equipment maintenance.', '-General services are support services that require specialized knowledge, experience, or expertise.\n\n-These services include: Pest control, Janitorial services, Laundry services, Catering services, Security services, Lawn maintenance services, Equipment maintenance.\n\nGeneral services roles include:-\n\n-Administrative, Secretarial, Clerical support, Building maintenance.\n\n-A general services department\'s mission is to provide leadership and best practices in managing.', 'uploads/1739417751_Service_7.jpeg'),
(11, 'Printer toner refill', 'Toner cartridge refill is the process of replenishing used laser printer cartridges with toner powder to restore printing capability. Worn-out parts like the wiper blade or PCR (Primary Charge Roller) may be replaced for better performance.', 'Toner Cartridge Refill\n-Toner cartridge refill is the process of replenishing used laser printer cartridges with toner powder to restore printing capability.\n\nHere are some aspects of toner cartridge refill:--\n\nToner Powder Refill:\n-The cartridge is opened carefully, and residual toner is removed to prevent mixing with new powder.\n-High-quality toner powder is added using a funnel or refill tool specific to the cartridge model.\n-It\'s important to match the toner type with the printer model to avoid compatibility issues.\n\nCleaning and Maintenance:\n-The drum unit and rollers are cleaned to prevent smudges, streaks, or faded prints.\n-Worn-out parts like the wiper blade or PCR (Primary Charge Roller) may be replaced for better performance.', 'uploads/6815b0ed4d9c5.png');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Contact no` bigint(30) NOT NULL,
  `photo_dir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `Name`, `Address`, `Contact no`, `photo_dir`) VALUES
(1, 'A.M Solution', 'Ashtavinayak 7, G-2, Opp. Muktalaxmi Girls High School, Bhavnagar, Gujarat, India', 9327181052, 'uploads/67de61306e65e.jpg'),
(2, 'Advance Computer', '107, EVA Complex, Gulista Ground, Opp. Gulista Ground, Bhavnagar, Gujarat, India', 9574183636, 'uploads/67de61abb8817.jpg'),
(3, 'Akshar Infoware Sales And Services', 'F/F 6 Victory Prime, Near Kaliyabid Water Tank, Bhavnagar, Gujarat, India', 9375307306, 'uploads/67de61f7c0da5.png'),
(4, 'Alphabet Computer Consultancy', '105/106, Shilpgram Complex, St. Kanvarra Chowk, Kalvibid, Bhavnagar, Gujarat, India', 7947137065, 'uploads/67de631ae7240.jpeg'),
(5, 'AM Solution', 'G-2, Ashtavinayak 7, Nawa Para, Opposite Muktalaxmi Girls High School, Bhavnagar, Gujarat, India', 9327181052, 'uploads/67de61453ed19.jpg'),
(6, 'Apex Computer', 'Shop No 2, Ashish Jyot Complex, Bhavnagar, 364001', 7942685500, 'uploads/67de64b3b85b6.jpg'),
(7, 'Atmiya Enterprise', 'No 32, Virbhadra Shopping Center, Nilambag Circle, Bhavnagar, Gujarat, India', 9376737373, 'uploads/67de65f18a623.jpg'),
(8, 'Bapa Sitaram Computers', 'Office No:101, First Floor, Sagar Complex, Kaliyabid, Bhavnagar, Gujarat, India', 9426241180, 'uploads/67de6688ad545.jpg'),
(9, 'Bansi Computer And Technology', 'Shop No 111, 1st Floor, Surabhi Mall, Waghawadi Road, Bhavnagar, Gujarat, India', 9377630063, 'uploads/67de661a3fc64.jpg'),
(10, 'The Computer Shop', 'Jewels Cir, Vijayrajnagar, Bhavnagar, Gujarat 364002', 9825212018, 'uploads/67de67a5aef0f.png'),
(11, 'Croma', 'Sun Exotica, Opp. Victoria Park Road, ISCON Mega City, Bhavnagar, Gujarat, India', 7069100328, 'uploads/67de66d903e07.jpg'),
(12, 'Darshak Computer', 'Shop No. C2 Shivam Barso, Mahadev Vadi, Blue Hill, Bhavnagar, Gujarat, India', 9376981818, 'uploads/67de827413bc0.jpg'),
(13, 'Dell Exclusive Store', '3, Saket, Opp. Vadodariya Park, Hill Drive, Bhavnagar, Gujarat, India', 8047027727, 'uploads/67de82c92cd30.png'),
(14, 'HP Infocom', 'F/2 Swastik Complex, Beside Shell Petrol Pump, Moksha, Bhavnagar, Gujarat, India', 6353767071, 'uploads/67de8b45474ad.png'),
(15, 'HP World', 'Shop No 8, Safal Complex, Atabhai Rupani Rd, Bhavnagar, Gujarat, India', 8657568481, 'uploads/67de8b57555d8.png'),
(16, 'HSPL Computer Service', 'First Floor, Girikandra Plaza, Sanskar Mandal Rd, Bhavnagar, Gujarat, India', 7947109046, 'uploads/67de8ae334209.png'),
(17, 'Kishan Technology', 'Q4GX+HJJ, Vora Bazar, Bhavnagar, 364001', 8320286969, 'uploads/67de89421f223.png'),
(18, 'Mahadev Computers', 'Panwadi, Bhavnagar, Gujarat - 364002, India', 9825472744, 'uploads/67de8919e6c68.png'),
(19, 'Micro Pc World', 'EVA 1 Complex, Atabhai Rd, Hill Drive, Bhavnagar, Gujarat, India', 9429963563, 'uploads/67de886dc9aa5.png'),
(20, 'Nik Computer', 'Near Meera Park, 14, Radhavallabh Park, Akhilesh Road, Bhavnagar, Gujarat, India', 9662408163, 'uploads/67de87671c5b1.png'),
(21, 'Om Computers', '21, Suyamani Complex, Near Chitra Petrol Pump, Desainagar, Bhavnagar, Gujarat, India', 9998609613, 'uploads/67de872a7e047.png'),
(22, 'Paras Computer', 'Shoppers Plaza, Parimal Chowk, 214-215, Waghawadi Road, Bhavnagar, Gujarat, India', 2782221155, 'uploads/67de86aae65d0.png'),
(23, 'Parshwa Computer Media', '128, Madhav Darshan Complex, Waghawadi Rd., Pragati Nagar, Bhavnagar, Gujarat, India', 9925141232, 'uploads/67de8683eff28.png'),
(24, 'Reliance Digital', 'No 1F, Himalaya Mall, 120 Feet Road, Opp. Victoria Park, Bhavnagar, Gujarat, India', 8591404291, 'uploads/67de860e322eb.png'),
(25, 'Rozi Infotech', 'G-2, Shivranjani Complex, Bhagwati Circle, Kaliyabid, Bhavnagar, Gujarat, India', 8238015273, 'uploads/67de85cfa6c84.png'),
(26, 'Shakti Computer', '2a Ridhi Siddhi Complex, Limadiyu, Near Ghogha Circle, Bhavnagar, Gujarat, India', 7698889888, 'uploads/67de85a4a5bc9.png'),
(27, 'Shubh Computers', 'P4RV+JRV, Ramnagar, Kaliyabid, Bhavnagar, 364002', 9898633432, 'uploads/67de843dac47b.png'),
(28, 'Ved Computer', 'Alekh Complex, Leela Circle, F-101, Sidsar Rd, Kalvibid, Bhavnagar, Gujarat, India', 9898208672, 'uploads/67de67e87962f.jpg'),
(29, 'Vivek Computers', 'Shoppers Point, Parimal Chowk, 101 FF, Waghawadi Road, Bhavnagar, Gujarat, India', 9825449199, 'uploads/67de68327707b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `reg_date`) VALUES
(1, 'Utsav', 'utsavdungrani7@gmail.com', '$2y$10$LND.Odw1uSmR3h/3S8SX2emJeFzs.LZGSFVyHDE9EBzG8JHJLom3m', '2025-04-06'),
(2, 'Ayush', 'ayushjoshi876@gmail.com', '$2y$10$HteGavqH1uuVV83uqmcbB.Zy89t3jgtsB.4r55Um6ISdGI5adWN5y', '2025-04-15'),
(4, 'lineviv529', 'lineviv529@f5url.com', '$2y$10$pLGthWwQoGHxStt8ZDXckuaFUpgrYXzJtFH2L0WvZtGI4LKdakdkG', '2025-04-19'),
(5, 'dahedo', 'dahedo3148@ingitel.com', '$2y$10$9Rjdqz.UDloJGPlrDEq0We76VMEaF/MD8QRDZ4kfzLw9WCYicWiSS', '2025-04-27'),
(7, 'wejole', 'wejole9158@harinv.com', '$2y$10$uS5R.KinqpyiR1/f0HJeuOgFiH4HSAWE0D7ROmRZPuovj8DWF50nu', '2025-05-01'),
(8, 'new', 'new@gmail.com', '$2y$10$hmGb4mOs6hEqUpMCrVjM6.zTHdnjCkf9vk.I.td79kh6EbyIKcDge', '2025-05-25');

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
-- Indexes for table `rg`
--
ALTER TABLE `rg`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rg`
--
ALTER TABLE `rg`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
