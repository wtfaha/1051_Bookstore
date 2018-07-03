-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-12-15 15:04:59
-- 伺服器版本: 10.1.19-MariaDB
-- PHP 版本： 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `1051_finalproject`
--

-- --------------------------------------------------------

--
-- 資料表結構 `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `login`
--

INSERT INTO `login` (`username`, `password`, `status`) VALUES
('book', 'book', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `ISBN` bigint(15) NOT NULL,
  `Book_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `Author_name` varchar(255) NOT NULL,
  `Translator_name` varchar(255) DEFAULT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `published_date` year(4) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `book`
--

INSERT INTO `book` (`ISBN`, `Book_name`, `category`, `Author_name`, `Translator_name`, `publisher_name`, `published_date`, `price`) VALUES
(9789571456324, '畢達哥拉斯的復仇', 'math', 'Arturo Sangalli', '蔡聰明', '三民書局股分有限公司', 2015, 250),
(9789571456325, '網頁程式設計', 'Chinese', 'Arturo Sangalli', '蔡聰明', '三民書局股分有限公司', 2000, 400);

-- --------------------------------------------------------

--
-- 資料表結構 `publisher`
--

CREATE TABLE `publisher` (
  `publisher_name` varchar(255) NOT NULL,
  `publisher_address` varchar(255) NOT NULL,
  `publisher_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `publisher`
--

INSERT INTO `publisher` (`publisher_name`, `publisher_address`, `publisher_phone`) VALUES
('三民書局股分有限公司', '台北復興北路386號', '(02)25006600'),
('呵呵書局股分有限公司', '桃園市中正路386號', '(03)1234567'),
('海洋書局股分有限公司', '基隆市中正路2號', '(02)22225252');

-- --------------------------------------------------------

--
-- 資料表結構 `sales`
--

CREATE TABLE `sales` (
  `ID` int(5) NOT NULL,
  `ISBN` bigint(15) NOT NULL,
  `buyORsale` tinyint(1) NOT NULL,
  `price` int(5) NOT NULL,
  `number` int(10) NOT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `sales`
--

INSERT INTO `sales` (`ID`, `ISBN`, `buyORsale`, `price`, `number`, `total`) VALUES
(1, 9789571456324, 0, 250, 25, 6250);
-- 買->0
-- 賣->1

-- --------------------------------------------------------

--
-- 資料表結構 `stock`
--

CREATE TABLE `stock` (
  `ISBN` bigint(15) NOT NULL,
  `inventory_level` int(10) NOT NULL,
  `location` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `stock`
--

INSERT INTO `stock` (`ISBN`, `inventory_level`, `location`) VALUES
(9789571456324, 25, '3A-9'),
(9789571456325, 0, '2C-1');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `price` (`price`),
  ADD KEY `publisher_name` (`publisher_name`),
  ADD KEY `publisher_name_2` (`publisher_name`);

--
-- 資料表索引 `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_name`);

--
-- 資料表索引 `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `price` (`price`),
  ADD KEY `ISBN` (`ISBN`);

--
-- 資料表索引 `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ISBN`);

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`publisher_name`) REFERENCES `publisher` (`publisher_name`);

--
-- 資料表的 Constraints `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
