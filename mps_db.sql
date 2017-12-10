-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2017 às 02:30
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mps_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_acesso`
--

CREATE TABLE `log_acesso` (
  `idlog_acesso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `data_acesso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `log_acesso`
--

INSERT INTO `log_acesso` (`idlog_acesso`, `idusuario`, `data_acesso`) VALUES
(39, 4, '2017-12-10 02:17:52'),
(40, 4, '2017-12-10 02:17:59'),
(41, 4, '2017-12-10 02:29:12'),
(42, 4, '2017-12-10 02:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `senha`, `ativo`) VALUES
(4, 'yuri', '123', NULL),
(5, 'fernanda', '123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_acesso`
--
ALTER TABLE `log_acesso`
  ADD PRIMARY KEY (`idlog_acesso`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_acesso`
--
ALTER TABLE `log_acesso`
  MODIFY `idlog_acesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `log_acesso`
--
ALTER TABLE `log_acesso`
  ADD CONSTRAINT `log_acesso_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
