-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2022 at 05:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controle_de_chaves`
--

-- --------------------------------------------------------

--
-- Table structure for table `chaves_cadastro`
--

CREATE TABLE `chaves_cadastro` (
  `codigo_chcad` int(22) NOT NULL,
  `codigo_cad` int(22) NOT NULL,
  `codigo_imo` int(22) NOT NULL,
  `local_pertence_chcad` varchar(20) NOT NULL,
  `descricao_chcad` varchar(120) NOT NULL,
  `observacao_chcad` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chaves_movimentacoes`
--

CREATE TABLE `chaves_movimentacoes` (
  `codigo_chmov` int(22) NOT NULL,
  `codigo_cad` int(22) NOT NULL,
  `codigo_chcad` int(22) NOT NULL,
  `codigo_usu` int(22) NOT NULL,
  `solicitante_retirada_chmov` int(22) NOT NULL,
  `visitante_chmov` int(22) NOT NULL,
  `perfil_pessoa_chmov` varchar(22) NOT NULL,
  `data_retirada_chmov` datetime NOT NULL,
  `data_previsao_entrega_chmov` datetime NOT NULL,
  `data_entrega_chmov` datetime NOT NULL,
  `status_chmov` varchar(2) NOT NULL,
  `observacao_chmov` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chaves_cadastro`
--
ALTER TABLE `chaves_cadastro`
  ADD PRIMARY KEY (`codigo_chcad`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chaves_cadastro`
--
ALTER TABLE `chaves_cadastro`
  MODIFY `codigo_chcad` int(22) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
