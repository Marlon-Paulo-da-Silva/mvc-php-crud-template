-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 11:09 PM
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
-- Database: `lojaapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwrd` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id_admin`, `username`, `passwrd`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'testeabc', '2022-08-02 08:54:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `id_client` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `client_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `passwrd` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authentication`
--

INSERT INTO `authentication` (`id_client`, `email`, `client_name`, `username`, `passwrd`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'marlon@paulo.com', 'Empresa São Paulo', 'testelogin', '$2y$10$aBDyLxhuvNNaI7D6z6BDr.FcyY9EKHJTd8wivVXD6.ewd5Y2oCcau', '2022-08-02 07:59:43', NULL, NULL),
(2, 'marlon2@paulo.com', 'Empresa Porto Alegre', 'testelogin2', 'testeabc', '2022-08-02 07:59:50', NULL, NULL),
(3, 'marlon3@paulo.com', 'Empresa Vitória', 'testelogin3', 'testeabc', '2022-08-02 07:59:55', NULL, NULL),
(4, 'marlon4@paulo.com', 'Empresa Sana Catarina', 'testelogin4', 'testeabc', '2022-08-12 10:28:25', '2022-08-12 10:28:25', NULL),
(6, 'marlon5@paulo.com', 'Empresa Marlon', 'testelogin5', 'testeabc', '2022-08-12 10:37:18', '2022-08-12 10:37:18', NULL),
(10, 'marlon6@paulo.com', 'Empresa Rio de Janeiro', 'testelogin6', 'testeabc', '2022-08-12 10:38:36', '2022-08-12 10:38:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `telefone`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 'marlon', 'marlon@gmail.com', '111222', '2022-07-08 13:05:58', '2022-07-08 13:05:58', '2022-07-15 11:33:05'),
(2, 'monica', 'monica@gmail.com', '111222', '2022-07-08 13:05:58', '2022-07-08 13:05:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_efetivacao` datetime DEFAULT NULL,
  `data_desligamento` datetime DEFAULT NULL,
  `data_iniciou` datetime DEFAULT NULL,
  `cargo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nome`, `data_efetivacao`, `data_desligamento`, `data_iniciou`, `cargo`) VALUES
(1, 'Marlon Paulo da Silva', '2022-07-18 07:48:20', NULL, '2022-07-18 07:48:20', 'CTO - Founder'),
(2, 'Monica Ap do Espírito Santo Barbosa', '2022-07-18 07:48:20', NULL, '2022-07-18 07:48:20', 'CFO'),
(3, 'João da Silva', '2022-07-18 07:50:19', NULL, '2022-07-18 07:50:19', 'Gerente'),
(4, 'Fernando Souza', NULL, NULL, '2022-07-18 07:50:19', 'Operador de caixa'),
(5, 'Roberto Saraiva', '2022-07-18 07:51:28', '2022-07-18 07:51:28', '2022-07-18 07:51:28', 'Operador de caixa'),
(6, 'Richard Monteiro', '2022-07-18 07:52:32', NULL, '2022-07-18 07:52:32', 'Operador de caixa');

-- --------------------------------------------------------

--
-- Table structure for table `depoimentos`
--

CREATE TABLE `depoimentos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depoimentos`
--

INSERT INTO `depoimentos` (`id`, `name`, `message`, `date`) VALUES
(1, 'Marlon Paulo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias vel architecto nobis quibusdam maxime ipsam magni aspernatur dolor hic ipsum. Quod, veritatis assumenda. Laborum fugiat itaque sapiente debitis! Reiciendis, ea?', '2022-09-30 10:54:22'),
(4, 'Marlon Paulo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias vel architecto nobis quibusdam maxime ipsam magni aspernatur dolor hic ipsum. Quod, veritatis assumenda. Laborum fugiat itaque sapiente debitis! Reiciendis, ea?', '2022-09-30 10:55:23'),
(5, 'Novo depoimento', 'Quod, veritatis assumenda. Laborum fugiat itaque sapiente debitis! Reiciendis, ea?', '2022-09-30 17:20:26'),
(7, 'Depoimento bacana', 'Segue depoimento', '2022-09-30 17:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) UNSIGNED NOT NULL,
  `nome_produto` varchar(50) DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome_produto`, `quantidade`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pregos', 100, '2022-07-08 13:09:37', '2022-07-08 13:09:37', NULL),
(2, 'parafusos', 0, '2022-07-08 13:11:07', '2022-07-08 13:11:07', NULL),
(3, 'alfinetes', 300, '2022-07-08 13:11:07', '2022-07-08 13:11:07', '2022-07-18 07:42:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depoimentos`
--
ALTER TABLE `depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id_client` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `depoimentos`
--
ALTER TABLE `depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
