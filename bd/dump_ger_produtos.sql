-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2016 at 01:16 PM
-- Server version: 5.6.27
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `estaleir_ger_produtos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cor`
--

CREATE TABLE IF NOT EXISTS `tb_cor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inativo/ 1-ativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_grupo`
--

CREATE TABLE IF NOT EXISTS `tb_grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_grupo_pai` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-Inativo/ 1-Ativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produto`
--

CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `id_tamanho` int(11) NOT NULL,
  `id_cor` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inativo/ 1-ativo',
  `data_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_cadastro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tamanho`
--

CREATE TABLE IF NOT EXISTS `tb_tamanho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
