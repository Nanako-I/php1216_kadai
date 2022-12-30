-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-12-29 18:56:52
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_map_table`
--

CREATE TABLE `gs_map_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `URL` text NOT NULL,
  `comment` text NOT NULL,
  `lat` int(128) NOT NULL,
  `lng` int(128) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_map_table`
--

INSERT INTO `gs_map_table` (`id`, `name`, `URL`, `comment`, `lat`, `lng`, `date`) VALUES
(1, '豊岡小学校', 'http://www2.city.toyooka.hyogo.jp/edu/school/toyooka-es/', 'aaa', 0, 0, '2022-12-25 23:19:33'),
(2, '豊岡小学校', 'http://www2.city.toyooka.hyogo.jp/edu/school/toyooka-es/', '111', 0, 0, '2022-12-27 00:29:21'),
(3, '豊岡小学校', 'http://www2.city.toyooka.hyogo.jp/edu/school/toyooka-es/', '111', 0, 0, '2022-12-27 00:29:31');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_map_table`
--
ALTER TABLE `gs_map_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_map_table`
--
ALTER TABLE `gs_map_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
