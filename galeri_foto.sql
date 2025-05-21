-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 11:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri_foto`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `file_name`, `content`, `user_id`, `created_at`) VALUES
(56, 'img_6829ba8731f365.84229245.jpg', 'hai', 3, '2025-05-19 08:27:03'),
(57, 'img_6827c707c3b289.90976541.jpg', 'ihh ganteng', 11, '2025-05-19 10:42:35'),
(58, 'img_6827c707c3b289.90976541.jpg', 'sayang  ku', 11, '2025-05-19 10:42:46'),
(59, 'img_6827c707c3b289.90976541.jpg', 'asjcpdo', 11, '2025-05-19 10:42:53'),
(60, 'img_682a9f06c1da61.88319606.jpg', 'ganteng kuh muachh', 11, '2025-05-19 11:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `photo_id` int NOT NULL,
  `user_id` int NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `upload_time` datetime NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `likes` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photo_id`, `user_id`, `description`, `upload_time`, `file_name`, `likes`) VALUES
(62, 3, 'zayn malik', '2025-05-16 21:44:41', 'img_6827414918ad59.03091443.jpg', 0),
(63, 3, 'zayn malik', '2025-05-16 21:45:03', 'img_6827415fa24080.55275690.jpg', 0),
(64, 3, 'zayn malik', '2025-05-16 21:45:24', 'img_68274174f41039.61722395.jpg', 0),
(65, 3, 'zayn malik', '2025-05-16 22:50:00', 'img_682750982044b4.79830298.jpg', 0),
(66, 3, 'zayn malik', '2025-05-16 22:50:29', 'img_682750b54b2dc3.81568077.jpg', 0),
(67, 3, 'zayn malik', '2025-05-16 22:51:17', 'img_682750e50b53e1.31489016.jpg', 0),
(68, 3, 'zayn malik', '2025-05-16 22:51:56', 'img_6827510c6248f1.55785714.jpg', 0),
(69, 3, 'the weekend', '2025-05-16 22:52:17', 'img_68275121b49622.39988138.jpg', 0),
(70, 3, 'the weekend', '2025-05-16 22:52:26', 'img_6827512aa9b478.30993004.jpg', 0),
(71, 3, 'the weekend', '2025-05-16 22:52:42', 'img_6827513aae9004.41786987.jpg', 0),
(72, 3, 'the weekend', '2025-05-16 22:52:57', 'img_68275149831622.11802426.jpg', 0),
(73, 3, 'the weekend', '2025-05-16 22:53:16', 'img_6827515c27e6f6.73147606.jpg', 0),
(74, 3, 'the weekend', '2025-05-16 22:53:51', 'img_6827517f450c83.98742096.jpg', 0),
(75, 3, 'the weekend', '2025-05-16 22:54:26', 'img_682751a2b83e74.72797810.jpg', 0),
(76, 3, 'the weekend', '2025-05-16 22:54:36', 'img_682751acea2731.98445077.jpg', 0),
(77, 3, 'the weekend', '2025-05-16 22:55:04', 'img_682751c8a02948.36505715.jpg', 0),
(78, 3, 'Messi', '2025-05-16 22:55:26', 'img_682751de634be1.48346901.jpg', 0),
(79, 3, 'Messi', '2025-05-16 22:55:51', 'img_682751f7486472.02217315.jpg', 0),
(80, 3, 'Messi', '2025-05-16 22:56:34', 'img_682752222325b6.42702475.jpg', 0),
(81, 3, 'Messi', '2025-05-16 22:56:52', 'img_682752345e8f13.74303157.jpg', 0),
(82, 3, 'Messi', '2025-05-16 22:57:06', 'img_68275242c56a74.18408497.jpg', 0),
(83, 3, 'Messi', '2025-05-16 22:57:27', 'img_682752573b7774.40493413.jpg', 0),
(84, 3, 'Messi', '2025-05-16 22:57:41', 'img_6827526513be16.58217981.jpg', 0),
(86, 3, 'Messi', '2025-05-16 22:58:31', 'img_68275297ea1f09.09558288.jpg', 0),
(87, 9, 'Messi', '2025-05-16 22:59:07', 'img_682752bbb27341.74282445.jpg', 0),
(88, 9, 'Messi', '2025-05-16 22:59:43', 'img_682752df5a2416.46904134.jpg', 0),
(89, 9, 'Justin Bieber', '2025-05-16 23:00:39', 'img_68275317426091.20424853.jpg', 0),
(90, 9, 'Justin Bieber', '2025-05-16 23:00:54', 'img_682753264a3ae7.18910487.jpg', 0),
(91, 9, 'Justin Bieber', '2025-05-16 23:01:10', 'img_6827533687f868.84373860.jpg', 0),
(92, 9, 'Justin Bieber', '2025-05-16 23:01:33', 'img_6827534d6e6a22.67284038.jpg', 0),
(93, 9, 'Justin Bieber', '2025-05-16 23:01:49', 'img_6827535de75a22.50051640.jpg', 0),
(94, 9, 'Justin Bieber', '2025-05-16 23:02:05', 'img_6827536db0d1c6.37784189.jpg', 0),
(95, 9, 'Justin Bieber', '2025-05-16 23:02:32', 'img_68275388ad4444.58668267.jpg', 0),
(96, 9, 'Rei Ive', '2025-05-16 23:03:30', 'img_682753c2ad1ae0.19378317.jpg', 0),
(97, 9, 'Rei Ive', '2025-05-16 23:03:45', 'img_682753d1999f87.02584700.jpg', 0),
(98, 9, 'Rei Ive', '2025-05-16 23:04:03', 'img_682753e3a64bf0.57434069.jpg', 0),
(99, 9, 'Rei Ive', '2025-05-16 23:04:19', 'img_682753f3aaf5a0.52517813.jpg', 1),
(100, 9, 'Rei Ive', '2025-05-16 23:05:05', 'img_682754211a1f15.22939426.jpg', 0),
(101, 9, 'Rei Ive', '2025-05-16 23:05:19', 'img_6827542f618050.66269391.jpg', 0),
(102, 9, 'Rei Ive', '2025-05-16 23:05:38', 'img_6827544241a8c5.07201823.jpg', 0),
(104, 9, 'Hanni njz', '2025-05-16 23:07:01', 'img_68275495ec4bf7.86389165.jpg', 0),
(105, 9, 'Hanni njz', '2025-05-16 23:07:24', 'img_682754aca356a9.34183266.jpg', 0),
(106, 9, 'Hanni njz', '2025-05-16 23:07:49', 'img_682754c5d2a189.80706744.jpg', 0),
(107, 9, 'Hanni njz', '2025-05-16 23:08:10', 'img_682754da4cbef2.11778024.jpg', 0),
(108, 9, 'Hanni njz', '2025-05-16 23:08:21', 'img_682754e5de5d79.00904172.jpg', 0),
(109, 9, 'Hanni njz', '2025-05-16 23:08:43', 'img_682754fb87ea58.74194178.jpg', 0),
(110, 9, 'Hanni njz', '2025-05-16 23:08:58', 'img_6827550adb10e3.26238526.jpg', 0),
(111, 9, 'Hanni njz', '2025-05-16 23:09:15', 'img_6827551b2739b8.55743224.jpg', 0),
(112, 9, 'Hanni njz', '2025-05-16 23:11:04', 'img_68275588959df3.17157212.jpg', 0),
(113, 9, 'Kazuha lesserafim', '2025-05-16 23:11:34', 'img_682755a61f1801.56961031.jpg', 0),
(114, 9, 'Kazuha lesserafim', '2025-05-16 23:12:13', 'img_682755cd4de9e2.42210947.jpg', 0),
(115, 9, 'Kazuha lesserafim', '2025-05-16 23:12:37', 'img_682755e5aee8b6.01389892.jpg', 0),
(116, 9, 'Kazuha lesserafim', '2025-05-16 23:12:48', 'img_682755f03dd625.51569447.jpg', 0),
(118, 9, 'Kazuha lesserafim', '2025-05-16 23:13:29', 'img_682756194f87f3.82342546.jpg', 0),
(119, 9, 'Kazuha lesserafim', '2025-05-16 23:14:11', 'img_6827564376f4d1.09514130.jpg', 0),
(120, 9, 'Minji njz', '2025-05-16 23:14:38', 'img_6827565eed2043.40435603.jpg', 0),
(121, 9, 'Minji njz', '2025-05-16 23:14:52', 'img_6827566c56d509.58558779.jpg', 0),
(122, 9, 'Minji njz', '2025-05-16 23:15:09', 'img_6827567d9f91b4.04034598.jpg', 0),
(123, 9, 'Minji njz', '2025-05-16 23:15:26', 'img_6827568ea21701.19784128.jpg', 0),
(124, 9, 'Minji njz', '2025-05-16 23:15:58', 'img_682756aed2e196.26620789.jpg', 0),
(125, 9, 'Minji njz', '2025-05-16 23:16:21', 'img_682756c5ba7708.99778272.jpg', 0),
(126, 9, 'Car', '2025-05-16 23:16:37', 'img_682756d54050a5.65747957.jpg', 0),
(127, 9, 'Car', '2025-05-16 23:16:54', 'img_682756e61e5f27.49469682.jpg', 0),
(128, 9, 'Car', '2025-05-16 23:17:03', 'img_682756ef1cf8f3.10761548.jpg', 0),
(129, 9, 'Car', '2025-05-16 23:17:22', 'img_68275702b6ed98.57721552.jpg', 0),
(130, 9, 'Car', '2025-05-16 23:17:33', 'img_6827570db7d894.47937074.jpg', 0),
(131, 9, 'Car', '2025-05-16 23:17:50', 'img_6827571ed0dcd3.84161864.jpg', 0),
(132, 9, 'Car', '2025-05-16 23:18:01', 'img_68275729d186d9.75471148.jpg', 0),
(133, 9, 'Minji njz', '2025-05-16 23:18:16', 'img_68275738e75c08.85942358.jpg', 0),
(136, 9, 'Car', '2025-05-16 23:20:03', 'img_682757a3182106.04209920.jpg', 0),
(137, 10, 'the weekend', '2025-05-17 06:58:50', 'img_6827c32a2ba2b4.57791742.jpg', 0),
(138, 10, 'Hanni njz', '2025-05-17 07:00:00', 'img_6827c3702fef51.76801073.jpg', 1),
(139, 10, 'Car', '2025-05-17 07:01:03', 'img_6827c3af8f2be8.49447423.jpg', 0),
(140, 10, 'Car', '2025-05-17 07:01:12', 'img_6827c3b8247c44.18167219.jpg', 0),
(141, 10, 'Justin Bieber', '2025-05-17 07:02:59', 'img_6827c4231c4d25.34032441.jpg', 0),
(142, 10, 'Justin Bieber', '2025-05-17 07:03:10', 'img_6827c42ee20619.73872189.jpg', 0),
(143, 10, 'Justin Bieber', '2025-05-17 07:03:23', 'img_6827c43bc69265.16865665.jpg', 0),
(144, 10, 'Food', '2025-05-17 07:06:05', 'img_6827c4dd53c527.36935194.jpg', 0),
(145, 10, 'Food', '2025-05-17 07:06:27', 'img_6827c4f31446c0.78106198.jpg', 0),
(146, 10, 'Food', '2025-05-17 07:06:36', 'img_6827c4fce1bce0.96990011.jpg', 0),
(147, 10, 'Food', '2025-05-17 07:06:56', 'img_6827c510972a65.07020490.jpg', 0),
(148, 10, 'Food', '2025-05-17 07:07:19', 'img_6827c527171763.30605597.jpg', 0),
(149, 10, 'Food', '2025-05-17 07:07:36', 'img_6827c5386a5c22.98796671.jpg', 0),
(150, 10, 'Food', '2025-05-17 07:07:48', 'img_6827c5441420c7.98911005.jpg', 0),
(151, 10, 'Food', '2025-05-17 07:08:08', 'img_6827c558375f87.26212712.jpg', 0),
(152, 10, 'Bilie Eilish', '2025-05-17 07:08:43', 'img_6827c57b5bb221.96792356.jpg', 0),
(153, 10, 'Bilie Eilish', '2025-05-17 07:09:19', 'img_6827c59f2ec876.26273360.jpg', 0),
(154, 10, 'Bilie Eilish', '2025-05-17 07:09:41', 'img_6827c5b52d80b1.11515116.jpg', 0),
(155, 10, 'Bilie Eilish', '2025-05-17 07:09:59', 'img_6827c5c76dcbc8.91662230.jpg', 0),
(156, 10, 'Bilie Eilish', '2025-05-17 07:10:25', 'img_6827c5e1584756.24070877.jpg', 0),
(157, 10, 'Bilie Eilish', '2025-05-17 07:10:50', 'img_6827c5fae8e237.63847300.jpg', 0),
(159, 10, 'Bilie Eilish', '2025-05-17 07:12:13', 'img_6827c64d875a49.88215096.jpg', 0),
(160, 10, 'Bilie Eilish', '2025-05-17 07:12:20', 'img_6827c65440c567.93418920.jpg', 0),
(161, 10, 'Bilie Eilish', '2025-05-17 07:12:28', 'img_6827c65c1c60f3.26479659.jpg', 0),
(162, 10, 'Bilie Eilish', '2025-05-17 07:12:35', 'img_6827c6634a0697.51900905.jpg', 0),
(163, 11, 'zayn malik', '2025-05-17 07:15:19', 'img_6827c707c3b289.90976541.jpg', 2),
(164, 11, 'zayn malik', '2025-05-17 07:16:04', 'img_6827c734be6ee7.53527298.jpg', 0),
(166, 11, 'zayn malik', '2025-05-17 07:16:24', 'img_6827c7480bda84.11574140.jpg', 0),
(168, 11, 'Olivia Rodrigo', '2025-05-17 07:18:59', 'img_6827c7e3231911.88003718.jpg', 0),
(169, 11, 'Olivia Rodrigo', '2025-05-17 07:19:27', 'img_6827c7ff4600c8.39395449.jpg', 0),
(170, 11, 'Olivia Rodrigo', '2025-05-17 07:19:43', 'img_6827c80f7b4390.34114224.jpg', 0),
(171, 11, 'Olivia Rodrigo', '2025-05-17 07:20:07', 'img_6827c827503540.23212907.jpg', 0),
(172, 11, 'Olivia Rodrigo', '2025-05-17 07:20:22', 'img_6827c836280de4.38932080.jpg', 0),
(173, 11, 'Olivia Rodrigo', '2025-05-17 07:20:34', 'img_6827c842db1448.77177588.jpg', 0),
(174, 11, 'Olivia Rodrigo', '2025-05-17 07:20:53', 'img_6827c855c686a0.56060426.jpg', 0),
(175, 11, 'Olivia Rodrigo', '2025-05-17 07:21:11', 'img_6827c8675a6979.34828414.jpg', 0),
(176, 11, 'ART', '2025-05-17 07:22:09', 'img_6827c8a137cbd4.84302434.jpg', 0),
(177, 11, 'ART', '2025-05-17 07:22:33', 'img_6827c8b9240878.78002646.jpg', 0),
(178, 11, 'ART', '2025-05-17 07:22:46', 'img_6827c8c6c4d839.96832123.jpg', 0),
(180, 11, 'Wallpaper', '2025-05-17 07:23:37', 'img_6827c8f9301146.28392399.jpg', 0),
(181, 11, 'ART', '2025-05-17 07:23:46', 'img_6827c902c92ea1.06434430.jpg', 0),
(182, 11, 'ART', '2025-05-17 07:23:58', 'img_6827c90e37ed11.99784466.jpg', 0),
(183, 11, 'ART', '2025-05-17 07:24:17', 'img_6827c921e84393.18101052.jpg', 0),
(184, 11, 'Wallpaper', '2025-05-17 07:24:33', 'img_6827c931e4a064.09791440.jpg', 0),
(185, 11, 'Wallpaper', '2025-05-17 07:24:44', 'img_6827c93c406418.21128993.jpg', 0),
(186, 11, 'Wallpaper', '2025-05-17 07:24:54', 'img_6827c9462c88b5.32071273.jpg', 0),
(187, 11, 'Wallpaper', '2025-05-17 07:25:07', 'img_6827c9533585f8.97764834.jpg', 0),
(189, 11, 'Wallpaper', '2025-05-17 07:25:44', 'img_6827c9783ec061.89103270.jpg', 0),
(190, 11, 'Wallpaper', '2025-05-17 07:26:27', 'img_6827c9a3823710.40066687.jpg', 0),
(191, 11, 'ART', '2025-05-17 07:27:23', 'img_6827c9db9a4c35.85534427.jpg', 0),
(192, 11, 'ART', '2025-05-17 07:27:30', 'img_6827c9e2b6d813.21357231.jpg', 0),
(194, 11, 'ART', '2025-05-17 07:28:14', 'img_6827ca0eed5803.02568322.jpg', 0),
(195, 11, 'ART', '2025-05-17 07:28:45', 'img_6827ca2dd89b86.28749371.jpg', 0),
(196, 11, 'Olivia Rodrigo', '2025-05-17 07:30:43', 'img_6827caa39739d5.39384258.jpg', 0),
(197, 11, 'Olivia Rodrigo', '2025-05-17 07:30:51', 'img_6827caab00d8e3.39145561.jpg', 0),
(198, 11, 'Olivia Rodrigo', '2025-05-17 07:30:57', 'img_6827cab155a5f7.46876672.jpg', 0),
(199, 11, 'Kazuha Lesserafim', '2025-05-17 07:33:24', 'img_6827cb4455aac1.31007504.jpg', 0),
(200, 11, 'Kazuha Lesserafim', '2025-05-17 07:33:38', 'img_6827cb5247afc8.42087837.jpg', 0),
(201, 11, 'Kazuha Lesserafim', '2025-05-17 07:33:46', 'img_6827cb5a48f224.34259168.jpg', 0),
(202, 11, 'Kazuha Lesserafim', '2025-05-17 07:35:04', 'img_6827cba8830740.19067606.jpg', 0),
(203, 11, 'Kazuha Lesserafim', '2025-05-17 07:35:13', 'img_6827cbb175cf94.51629200.jpg', 0),
(204, 12, 'Bruno Mars', '2025-05-18 18:43:32', 'img_6829b9d48bf129.84490321.jpg', 0),
(205, 12, 'Bruno Mars', '2025-05-18 18:43:42', 'img_6829b9de1fcd47.62718356.jpg', 0),
(206, 12, 'Bruno Mars', '2025-05-18 18:43:49', 'img_6829b9e58a3150.73442980.jpg', 0),
(207, 12, 'Bruno Mars', '2025-05-18 18:43:57', 'img_6829b9ed760d21.13028864.jpg', 0),
(208, 12, 'Bruno Mars', '2025-05-18 18:44:08', 'img_6829b9f818e560.56332499.jpg', 0),
(209, 12, 'Bruno Mars', '2025-05-18 18:44:14', 'img_6829b9fea1e4e2.23577234.jpg', 0),
(210, 12, 'Bruno Mars', '2025-05-18 18:45:11', 'img_6829ba3751e256.13407792.jpg', 0),
(211, 12, 'Bruno Mars', '2025-05-18 18:45:19', 'img_6829ba3fa72757.32340365.jpg', 0),
(212, 12, 'Bruno Mars', '2025-05-18 18:46:23', 'img_6829ba7f2f1a91.31891148.jpg', 0),
(213, 12, 'Bruno Mars', '2025-05-18 18:46:31', 'img_6829ba8731f365.84229245.jpg', 1),
(215, 11, 'the weekend', '2025-05-19 11:01:26', 'img_682a9f06c1da61.88319606.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unduh`
--

CREATE TABLE `unduh` (
  `unduh_id` int NOT NULL,
  `user_id` int NOT NULL,
  `photo_id` int NOT NULL,
  `download_time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `avatar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `avatar`) VALUES
(3, 'ibnu1', 'ibnu1@gmail.com', '$2y$10$9VVgODQ4QhOcfakfyLMbEeMfxUGN/o6m2BWtDik8ZTHA0M7qJhIa2', 'user', '682a9899408b4.png'),
(6, 'Kazama*', 'Kazama@gmail.com', '$2y$10$tuRUPp.mdjBHBAdJVVnQfObI9RhgjV3aVI8WMa.TlkK8y8egTcdFu', 'admin', '681f39e1ce39f.png'),
(9, 'Messi', 'Messi@gmail.com', '$2y$10$nLThBvd/NnxhiH9dPp68devid/nmpXtDkaaZ9M22EWKnQpSfMH11m', 'user', '6823e483f247b.png'),
(10, 'Otis', 'otis@gmail.com', '$2y$10$aFDMA.L0x.Yh452f2DOSXuFNnidYKs/SjZxRh17diRkB8aOb93aOq', 'user', '6827c312134ae.png'),
(11, 'Nicky', 'Nicky@gmail.com', '$2y$10$M3/LtYakpqfxFdxFBhayOOwlbQzKPUhBrQk/dbSykDj3xXIQiQfDq', 'user', '6827c6d61ba63.png'),
(12, 'Bruno', 'bruno@gmail.com', '$2y$10$sWL79hLwhcb3tLwq5fFl2OA03iv3Hz8S1HcY6VVjODaOz1H3x/hUq', 'user', '6829b9c17da56.png'),
(13, 'es', 'es@hgmail.com', '$2y$10$MMvuFsQK1z2ZuiUVOQ0OK.0UahqNlwfs2i4Em5LesHCi3LpWX4Tx6', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `unduh`
--
ALTER TABLE `unduh`
  ADD PRIMARY KEY (`unduh_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `unduh`
--
ALTER TABLE `unduh`
  MODIFY `unduh_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
