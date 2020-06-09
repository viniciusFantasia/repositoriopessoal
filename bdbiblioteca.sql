-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Maio-2020 às 15:32
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdbiblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbemprestimos`
--

CREATE TABLE `tbemprestimos` (
  `id` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `datahoraemprestimo` datetime NOT NULL,
  `datahoradevolucao` datetime NOT NULL,
  `idobra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbobras`
--

CREATE TABLE `tbobras` (
  `id` int(11) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `ano` varchar(15) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpessoas`
--

CREATE TABLE `tbpessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `estudos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbpessoas`
--

INSERT INTO `tbpessoas` (`id`, `nome`, `email`, `senha`, `telefone`, `estudos`) VALUES
(1, 'José', 'jose@email.com', 'asfsakdf', '123 13123123123', '12334324'),
(2, 'Pedro', 'acordacedo@gmail.com', '98989', '1233333', 'mundo dos sonhos'),
(3, 'Marcos', 'marcos@123.com', 'weriwieur', '2342349009', 'fatec'),
(4, 'Marcos rrrr', 'marcos@kkkk.com', '123', '12345', 'fatec'),
(5, 'sdgfdg', 'sdfg@adfas.com', 'sdfgsdfg', 'sdfg', 'awerwerew'),
(6, 'fim da aula', 'atequeenfim@gmail.com', '123123', 'tente na proxima semana', '234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbemprestimos`
--
ALTER TABLE `tbemprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbobras`
--
ALTER TABLE `tbobras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpessoas`
--
ALTER TABLE `tbpessoas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbemprestimos`
--
ALTER TABLE `tbemprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbobras`
--
ALTER TABLE `tbobras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpessoas`
--
ALTER TABLE `tbpessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
