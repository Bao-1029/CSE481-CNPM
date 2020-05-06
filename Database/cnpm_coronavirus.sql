-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 06, 2020 lúc 01:27 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnpm_coronavirus`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_news` (IN `title` VARCHAR(300) CHARSET utf8mb4, IN `link` VARCHAR(3000) CHARSET utf8mb4, IN `source` TINYTEXT CHARSET utf8mb4, IN `imgUri` VARCHAR(3000) CHARSET utf8mb4)  Begin
    Declare id tinyint(3);
    Set id = f_get_source_id(source);
    Insert into news (title, link, sourceId, imgUri) Value (title, link, id, imgUri);
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_news` (`num_offset` SMALLINT, `num_limit` SMALLINT)  Begin
    Select title, link, source, imgUri From news_detail
        Order by id Desc Limit num_limit Offset num_offset;
End$$

--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_latest_title_news` () RETURNS VARCHAR(300) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci Begin
	Declare tt varchar(300);
    Set tt = (Select title From news_detail
        Where id = (Select MAX(id) From news_detail));
    Return tt;
End$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_source_id` (`source` TINYTEXT) RETURNS TINYINT(3) Begin
    Declare id tinyint(3);

    Select n.id Into id From news_source as n
        Where n.source = source;

    If id IS NULL THEN
        Begin
            Insert into news_source (source) Value (source);
            Set id = (SELECT LAST_INSERT_ID());
        End;
    End if;

    return id;
End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hospital_hotlines`
--

CREATE TABLE `hospital_hotlines` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hospital_hotlines`
--

INSERT INTO `hospital_hotlines` (`id`, `name`, `phone_number`) VALUES
(1, 'Bá»‡nh viá»‡n Báº¡ch Mai', '0969.851.616'),
(2, 'Bá»‡nh viá»‡n Nhiá»‡t Ä‘á»›i Trung Æ°Æ¡ng', '0969.241.616'),
(3, 'Bá»‡nh viá»‡n E', '0912.168.887'),
(4, 'Bá»‡nh viá»‡n Nhi trung Æ°Æ¡ng', '0372.884.712'),
(5, 'Bá»‡nh viá»‡n Phá»•i trung Æ°Æ¡ng', '0967.941.616'),
(6, 'Bá»‡nh viá»‡n Viá»‡t Nam â€“ Thá»¥y Äiá»ƒn UÃ´ng BÃ­', '0966.681.313'),
(7, 'Bá»‡nh viá»‡n Äa khoa trung Æ°Æ¡ng ThÃ¡i NguyÃªn', '0913.394.495'),
(8, 'Bá»‡nh viá»‡n Trung Æ°Æ¡ng Huáº¿', '0965.301.212'),
(9, 'Bá»‡nh viá»‡n Chá»£ Ráº«y', '0969.871.010'),
(10, 'Bá»‡nh viá»‡n Äa khoa trung Æ°Æ¡ng Cáº§n ThÆ¡', '0907.736.736'),
(11, 'Bá»‡nh viá»‡n Xanh PÃ´n HÃ  Ná»™i', '0904.138.502'),
(12, 'Bá»‡nh viá»‡n Vinmec HÃ  Ná»™i', '0934.472.768'),
(13, 'Bá»‡nh viá»‡n ÄÃ  Náºµng', '0903.583.881'),
(14, 'Bá»‡nh viá»‡n Nhiá»‡t Ä‘á»›i TP.HCM', '0967.341.010 ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sourceId` tinyint(3) UNSIGNED NOT NULL,
  `imgUri` varchar(3000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `link`, `sourceId`, `imgUri`) VALUES
(1, 'Khen thÃ†Â°Ã¡Â»ÂŸng nhÃƒÂ³m nghiÃƒÂªn cÃ¡Â»Â©u Ã¡Â»Â©ng dÃ¡Â»Â¥ng khai bÃƒÂ¡o y tÃ¡ÂºÂ¿ NCOVI phÃƒÂ²ng chÃ¡Â»Â‘ng dÃ¡Â»Â‹ch Covid-19', 'https://news.google.com/articles/CBMifWh0dHBzOi8vdGhhbmhuaWVuLnZuL2dpb2ktdHJlL2toZW4tdGh1b25nLW5ob20tbmdoaWVuLWN1dS11bmctZHVuZy1raGFpLWJhby15LXRlLW5jb3ZpLXBob25nLWNob25nLWRpY2gtY292aWQtMTktMTIwOTAwMC5odG1s0gF-aHR0cHM6Ly9tLnRoYW5obmllbi52bi9naW9pLXRyZS9raGVuLXRodW9uZy1uaG9tLW5naGllbi1jdXUtdW5nLWR1bmcta2hhaS1iYW8teS10ZS1uY292aS1waG9uZy1jaG9uZy1kaWNoLWNvdmlkLTE5LTEyMDkwMDAuYW1w?hl=vi&gl=VN&ceid=VN%3Avi', 1, 'https://lh4.googleusercontent.com/proxy/8LpwjZ40sySaWgteSbaOc7d58sol29DivkfMgIzq9yMxgfneXMTbqqynC7UzvIaNOjtRN150SZ6kb352z6CU2nmgvMSfrglhJhJrd3nzs3ZNsiPfm8cqfZsiAWASWn4=-p-h100-w100'),
(2, 'ChÃ¡Â»Â‘ng Ã„Â‘Ã¡ÂºÂ¡i dÃ¡Â»Â‹ch COVID-19: BÃ¡ÂºÂ£n lÃ„Â©nh ViÃ¡Â»Â‡t Nam tÃ¡Â»Âa sÃƒÂ¡ng', 'https://news.google.com/articles/CBMiWGh0dHBzOi8vbGFvZG9uZy52bi90aG9pLXN1L2Nob25nLWRhaS1kaWNoLWNvdmlkLTE5LWJhbi1saW5oLXZpZXQtbmFtLXRvYS1zYW5nLTgwMDc4MC5sZG_SAQA?hl=vi&gl=VN&ceid=VN%3Avi', 3, 'https://lh4.googleusercontent.com/proxy/enonyR6kap37BeclA8_osg9lSgfdELuRJPF-OjuqznCxikaDK9qJg7VE_c5tucqZABv81-9Zi3VzDJwAu1ep9yCGzGOloMkD82ZAU6xW7BzMGTmttajXuj4SSkEFb8OT=-p-h100-w100'),
(3, 'DÃ¡Â»Â‹ch COVID-19 chiÃ¡Â»Âu 23-4: ViÃ¡Â»Â‡t Nam 0 ca nhiÃ¡Â»Â…m mÃ¡Â»Â›i, NhÃ¡ÂºÂ­t BÃ¡ÂºÂ£n vÃ†Â°Ã¡Â»Â£t mÃ¡Â»Â‘c 12.600 ca', 'https://news.google.com/articles/CBMidWh0dHBzOi8vdHVvaXRyZS52bi9kaWNoLWNvdmlkLTE5LWNoaWV1LTIzLTQtdmlldC1uYW0tMC1jYS1uaGllbS1tb2ktbmhhdC1iYW4tdnVvdC1tb2MtMTItNjAwLWNhLTIwMjAwNDIzMTM1ODEwMTIyLmh0bdIBAA?hl=vi&gl=VN&ceid=VN%3Avi', 2, 'https://lh4.googleusercontent.com/proxy/nZ7VNcTgJy-VAwFSAHimqCCu8EqhIVsYdEkrhDWWZdeTDBb4oltyrhuuXI0BVnX2R0LJtq8Cl1fAhsmXrS9YAIzUyknaoQDCM_fTjvVM06Wx64lhXygUT5bnhYDJ-fzwnwnVBqUkqGDR4MQ4zVdvTKJW18UMSpxx1j4qJMLhsy6SeS4pWyc04FXhycYIYGQ=-p-h100-w100'),
(4, 'ChÃ¡Â»Â‘ng Ã„Â‘Ã¡ÂºÂ¡i dÃ¡Â»Â‹ch COVID-19: BÃ¡ÂºÂ£n lÃ„Â©nh ViÃ¡Â»Â‡t Nam tÃ¡Â»Âa sÃƒÂ¡ng', 'https://news.google.com/articles/CBMiWGh0dHBzOi8vbGFvZG9uZy52bi90aG9pLXN1L2Nob25nLWRhaS1kaWNoLWNvdmlkLTE5LWJhbi1saW5oLXZpZXQtbmFtLXRvYS1zYW5nLTgwMDc4MC5sZG_SAQA?hl=vi&gl=VN&ceid=VN%3Avi', 3, 'https://lh4.googleusercontent.com/proxy/enonyR6kap37BeclA8_osg9lSgfdELuRJPF-OjuqznCxikaDK9qJg7VE_c5tucqZABv81-9Zi3VzDJwAu1ep9yCGzGOloMkD82ZAU6xW7BzMGTmttajXuj4SSkEFb8OT=-p-h100-w100'),
(5, 'Singapore: giÃ¡Â»Â¯a dÃ¡Â»Â‹ch corona, vÃƒÂ¬ tÃƒÂ´ sÃƒÂºp mÃƒ phÃ¡ÂºÂ£i... ngÃ¡Â»Â“i tÃƒÂ¹', 'https://news.google.com/articles/CBMiamh0dHBzOi8vY3VvaS50dW9pdHJlLnZuL3Rpbi10dWMvc2luZ2Fwb3JlLWdpdWEtZGljaC1jb3JvbmEtdmktdG8tc3VwLW1hLXBoYWktbmdvaS10dS0yMDIwMDQyNDkxNzE1NzUzLmh0bWzSAQA?hl=vi&gl=VN&ceid=VN%3Avi', 2, 'https://lh3.googleusercontent.com/proxy/96Aq1VJGr70acZoy1ZGts6iyCMlIbORgwS2Y6lkdSu3ErM4LqqN0LZN0Zs_10fx8u534SONoS5zGR1V6sbEj5Q-oGafBVnK537Bk-6PyVl8o1VoYwX4IQQ=-p-h100-w100'),
(6, 'Anh, PhÃƒÂ¡p nghi ngÃ¡Â»Â cÃƒÂ¡ch xÃ¡Â»Â­ lÃƒÂ½ cÃ¡Â»Â§a Trung QuÃ¡Â»Â‘c vÃ¡Â»Â dÃ¡Â»Â‹ch Covid-19', 'https://news.google.com/articles/CBMiZ2h0dHBzOi8vdGhhbmhuaWVuLnZuL3RoZS1naW9pL2FuaC1waGFwLW5naGktbmdvLWNhY2gteHUtbHktY3VhLXRydW5nLXF1b2MtdmUtZGljaC1jb3ZpZC0xOS0xMjEyMTY4Lmh0bWzSAWhodHRwczovL20udGhhbmhuaWVuLnZuL3RoZS1naW9pL2FuaC1waGFwLW5naGktbmdvLWNhY2gteHUtbHktY3VhLXRydW5nLXF1b2MtdmUtZGljaC1jb3ZpZC0xOS0xMjEyMTY4LmFtcA?hl=vi&gl=VN&ceid=VN%3Avi', 4, 'https://lh5.googleusercontent.com/proxy/csWWDvuguXnEZGZ69uRRNpkUs-geSMPTqVPkVFtf7-LkK7t15jMqwb4RDHI-pvkH0mIZVnz1eiDaMtaAdkL424lju1Pq9RLY1-rd8XYMZzx9W4_ggLXfBaoYGVrp=-p-h100-w100');

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `news_detail`
-- (See below for the actual view)
--
CREATE TABLE `news_detail` (
`id` smallint(5) unsigned
,`title` varchar(300)
,`source` tinytext
,`link` varchar(3000)
,`imgUri` varchar(3000)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_source`
--

CREATE TABLE `news_source` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `source` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news_source`
--

INSERT INTO `news_source` (`id`, `source`) VALUES
(1, 'BÃƒÂ¡o Thanh NiÃƒÂªn'),
(2, 'TuÃ¡Â»Â•i TrÃ¡ÂºÂ» Online'),
(3, 'BÃƒÂ¡o Lao Ã„ÂÃ¡Â»Â™ng'),
(4, 'Game - BÃƒÂ¡o Thanh NiÃƒÂªn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `userName` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `level`, `status`) VALUES
(1, 'admin', '$2y$10$gZfmlD/1e.dWoAnsHiJw1.5EuPBJgyXvg/5ze/WtZPSx.K30YvpOi', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `news_detail`
--
DROP TABLE IF EXISTS `news_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `news_detail`  AS  select `n`.`id` AS `id`,`n`.`title` AS `title`,`s`.`source` AS `source`,`n`.`link` AS `link`,`n`.`imgUri` AS `imgUri` from (`news` `n` join `news_source` `s`) where (`n`.`sourceId` = `s`.`id`) ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hospital_hotlines`
--
ALTER TABLE `hospital_hotlines`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sourceId` (`sourceId`);

--
-- Chỉ mục cho bảng `news_source`
--
ALTER TABLE `news_source`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hospital_hotlines`
--
ALTER TABLE `hospital_hotlines`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `news_source`
--
ALTER TABLE `news_source`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`sourceId`) REFERENCES `news_source` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
