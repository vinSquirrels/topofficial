-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 10 2012 г., 13:02
-- Версия сервера: 5.5.16
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `topofficial`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `CityID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ParentCityID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `criteriatype`
--

CREATE TABLE IF NOT EXISTS `criteriatype` (
  `CriteriaTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `IsPositive` int(11) DEFAULT '1',
  PRIMARY KEY (`CriteriaTypeID`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `declaration`
--

CREATE TABLE IF NOT EXISTS `declaration` (
  `DeclarationID` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(255) NOT NULL,
  `OfficialID` int(11) NOT NULL,
  PRIMARY KEY (`DeclarationID`),
  KEY `FK_Declaration_Official_idx` (`OfficialID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `estimate`
--

CREATE TABLE IF NOT EXISTS `estimate` (
  `EstimateID` int(11) NOT NULL AUTO_INCREMENT,
  `Value` int(11) NOT NULL,
  `IpAddress` varchar(45) NOT NULL,
  `CriteriaTypeID` int(11) NOT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `OfficialID` int(11) NOT NULL,
  `AuthorName` varchar(45) DEFAULT NULL,
  `AuthorEmail` varchar(45) DEFAULT NULL,
  `Review` text NOT NULL,
  PRIMARY KEY (`EstimateID`),
  KEY `FK_Estimate_Official_idx` (`OfficialID`),
  KEY `FK_Estimate_CriteriaType_idx` (`CriteriaTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `official`
--

CREATE TABLE IF NOT EXISTS `official` (
  `OfficialID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `MiddleName` varchar(45) NOT NULL,
  `ImageFileName` varchar(45) DEFAULT NULL,
  `Post` varchar(255) DEFAULT NULL,
  `Description` text,
  `Departament` varchar(255) DEFAULT NULL,
  `CityID` int(11) NOT NULL,
  `RegionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`OfficialID`),
  UNIQUE KEY `OfficialID_UNIQUE` (`OfficialID`),
  KEY `FK_Official_City_idx` (`CityID`),
  KEY `FK_Official_Region_idx` (`RegionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `RegionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`RegionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `declaration`
--
ALTER TABLE `declaration`
  ADD CONSTRAINT `FK_Declaration_Official` FOREIGN KEY (`OfficialID`) REFERENCES `official` (`OfficialID`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `estimate`
--
ALTER TABLE `estimate`
  ADD CONSTRAINT `FK_Estimate_CriteriaType` FOREIGN KEY (`CriteriaTypeID`) REFERENCES `criteriatype` (`CriteriaTypeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Estimate_Official` FOREIGN KEY (`OfficialID`) REFERENCES `official` (`OfficialID`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `official`
--
ALTER TABLE `official`
  ADD CONSTRAINT `FK_Official_City` FOREIGN KEY (`CityID`) REFERENCES `city` (`CityID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Official_Region` FOREIGN KEY (`RegionID`) REFERENCES `region` (`RegionID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
