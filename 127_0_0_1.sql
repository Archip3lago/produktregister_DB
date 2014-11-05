-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 22 okt 2014 kl 09:31
-- Serverversion: 5.6.11
-- PHP-version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



--
-- Tabellstruktur `produkter`
--

CREATE TABLE IF NOT EXISTS `produkter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namn` varchar(30) NOT NULL,
  `pris` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `produkter`
--

INSERT INTO `produkter` (`id`, `namn`, `pris`) VALUES
(1, 'Skål', 59),
(2, 'Sked', 19),
(3, 'Tallrik', 321),
(4, 'Tallrik', 321),
(5, 'Tallrik', 321);
