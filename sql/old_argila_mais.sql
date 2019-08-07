-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Abr-2019 às 10:14
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

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

DROP TABLE IF EXISTS `colaborador`;
CREATE TABLE IF NOT EXISTS `colaborador` (
  `matricula` smallint(6) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nascimento` date NOT NULL,
  `rg` varchar(10) NOT NULL,
  `ctps` varchar(9) NOT NULL,
  `cargo` enum('vendedor','programador','gerente','') NOT NULL,
  PRIMARY KEY (`matricula`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=10559 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colaborador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `produto_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id`, `quantidade`, `produto_id`) VALUES
(1, 15, 105);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `contato` varchar(14) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor_produto`
--

DROP TABLE IF EXISTS `fornecedor_produto`;
CREATE TABLE IF NOT EXISTS `fornecedor_produto` (
  `fornecedor_id` tinyint(4) NOT NULL,
  `produto_id` tinyint(4) NOT NULL,
  KEY `fornecedor_id` (`fornecedor_id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `preco_venda` decimal(7,2) NOT NULL,
  `preco_custo` decimal(7,2) NOT NULL,
  `nome` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `user_session`;
CREATE TABLE IF NOT EXISTS `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` smallint(6) NOT NULL,
  `token` varchar(20) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matricula` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_session`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE IF NOT EXISTS `venda` (
  `codigo` tinyint(4) NOT NULL AUTO_INCREMENT,
  `matricula_vendedor` smallint(6) NOT NULL,
  `codigo_produto` tinyint(4) DEFAULT NULL,
  `valor` decimal(7,2) DEFAULT NULL,
  `data` date NOT NULL,
  `quantidade` tinyint(30) NOT NULL,
  `comissao` decimal(7,2) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `matricula_vendedor` (`matricula_vendedor`),
  KEY `codigo_produto` (`codigo_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`codigo`, `matricula_vendedor`, `codigo_produto`, `valor`, `data`, `quantidade`, `comissao`) VALUES
(1, 10558, 112, '90.00', '2019-03-28', 9, '27.00'),
(2, 10558, 105, '50.00', '2019-03-28', 9, '15.00');

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
