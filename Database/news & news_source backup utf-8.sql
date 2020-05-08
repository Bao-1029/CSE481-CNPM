-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 06, 2020 lúc 08:13 PM
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

--
-- Đang đổ dữ liệu cho bảng `news_source`
--

INSERT INTO `news_source` (`id`, `source`) VALUES
(1, 'BÃƒÂ¡o Thanh NiÃƒÂªn'),
(2, 'TuÃ¡Â»Â•i TrÃ¡ÂºÂ» Online'),
(3, 'BÃƒÂ¡o Lao Ã„ÂÃ¡Â»Â™ng'),
(4, 'Game - BÃƒÂ¡o Thanh NiÃƒÂªn');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
