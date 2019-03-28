-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Mar-2019 às 20:57
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `argila_mais`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador`
--

CREATE TABLE `colaborador` (
  `matricula` smallint(6) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nascimento` date NOT NULL,
  `rg` varchar(10) NOT NULL,
  `ctps` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaborador`
--

INSERT INTO `colaborador` (`matricula`, `cpf`, `nome`, `senha`, `nascimento`, `rg`, `ctps`) VALUES
(10553, '12859896430', 'MATHEUS SILVA DO NASCIMENTO', '96401318', '1998-10-28', '39344142', '0000000'),
(10554, '06102208455', 'ALESSANDRO BENTO DOS SANTOS', 'recife', '1974-02-06', '40711536', '000000000'),
(10555, '13041477467', 'MATEUS DA FRANÇA JUCÁ', 'argilamais', '2001-11-10', '40009173', '000000000'),
(10558, '10240061403', 'RUBENS DOS SANTOS SILVA', 'argilamais', '2001-04-05', '39605795', '000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` tinyint(4) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `produto_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` tinyint(4) NOT NULL,
  `contato` varchar(14) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor_produto`
--

CREATE TABLE `fornecedor_produto` (
  `fornecedor_id` tinyint(4) NOT NULL,
  `produto_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` tinyint(4) NOT NULL,
  `preco_venda` decimal(7,2) NOT NULL,
  `preco_custo` decimal(7,2) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `preco_venda`, `preco_custo`, `nome`) VALUES
(105, '10.00', '0.00', 'Argila Verde 90g'),
(112, '10.00', '0.00', 'Argila Branca 90g');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `matricula` smallint(6) NOT NULL,
  `token` varchar(20) NOT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_session`
--

INSERT INTO `user_session` (`id`, `matricula`, `token`, `active`) VALUES
(73, 10553, 'bhfFqRdQKy3QJy6uVyvT', 1),
(74, 10553, 'RcagnWRaoXan2aFhjq8f', 1),
(75, 10553, 'Ag1BpSFiG0FqxPdKtSAa', 1),
(76, 10553, 'RD8Oa7AgKWF1Ru52Kqtw', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `codigo` tinyint(4) NOT NULL,
  `matricula_vendedor` smallint(6) NOT NULL,
  `codigo_produto` tinyint(4) DEFAULT NULL,
  `valor` decimal(7,2) DEFAULT NULL,
  `data` date NOT NULL,
  `quantidade` tinyint(30) NOT NULL,
  `comissao` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`codigo`, `matricula_vendedor`, `codigo_produto`, `valor`, `data`, `quantidade`, `comissao`) VALUES
(1, 10558, 112, '90.00', '2019-03-28', 9, '27'),
(2, 10558, 105, '50.00', '2019-03-28', 9, '15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`matricula`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor_produto`
--
ALTER TABLE `fornecedor_produto`
  ADD KEY `fornecedor_id` (`fornecedor_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricula` (`matricula`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `matricula_vendedor` (`matricula_vendedor`),
  ADD KEY `codigo_produto` (`codigo_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `matricula` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10559;

--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `codigo` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `fornecedor_produto`
--
ALTER TABLE `fornecedor_produto`
  ADD CONSTRAINT `fornecedor_produto_ibfk_1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`),
  ADD CONSTRAINT `fornecedor_produto_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `user_session`
--
ALTER TABLE `user_session`
  ADD CONSTRAINT `user_session_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `colaborador` (`matricula`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`matricula_vendedor`) REFERENCES `colaborador` (`matricula`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`codigo_produto`) REFERENCES `produto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;