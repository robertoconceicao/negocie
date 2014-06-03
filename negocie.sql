-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 03-Jun-2014 às 00:58
-- Versão do servidor: 5.5.34
-- versão do PHP: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `negocie`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `cdcategoria` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nmcategoria` varchar(100) NOT NULL,
  `sgcategoria` varchar(10) DEFAULT NULL,
  `icone` blob,
  `cdcategoriaparent` int(11) DEFAULT NULL,
  PRIMARY KEY (`cdcategoria`),
  UNIQUE KEY `cdcategoria` (`cdcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`cdcategoria`, `nmcategoria`, `sgcategoria`, `icone`, `cdcategoriaparent`) VALUES
(1, 'Eletrônicos e Informática', NULL, NULL, NULL),
(2, 'Para sua casa', NULL, NULL, NULL),
(3, 'Moda e Beleza', NULL, NULL, NULL),
(4, 'Esporte', NULL, NULL, NULL),
(5, 'Música, Arte e Lazer', NULL, NULL, NULL),
(6, 'Agropecuária', NULL, NULL, NULL),
(7, 'Empregos e Negócios', NULL, NULL, NULL),
(8, 'Animais', NULL, NULL, NULL),
(9, 'Imóveis', NULL, NULL, NULL),
(10, 'Bebês e Crianças', NULL, NULL, NULL),
(11, 'Celulares e Smartphones', NULL, NULL, 1),
(12, 'Tablets e iPads', NULL, NULL, 1),
(13, 'Acessórios e Outros', NULL, NULL, 1),
(14, 'Áudio', NULL, NULL, 1),
(15, 'Câmeras e Acessórios', NULL, NULL, 1),
(16, 'Computadores e Acessórios', NULL, NULL, 1),
(17, 'TV e Vídeo', NULL, NULL, 1),
(18, 'Video Games - Consoles', NULL, NULL, 1),
(19, 'Berços, Móveis e Decoração', NULL, NULL, 10),
(20, 'Brinquedos', NULL, NULL, 10),
(21, 'Carrinhos e Cadeirinhas', NULL, NULL, 10),
(22, 'Roupas e Calçados', NULL, NULL, 10),
(23, 'Outros', NULL, NULL, 10),
(24, 'Eletrodomésticos', NULL, NULL, 2),
(25, 'Jardinagem e Construção', NULL, NULL, 2),
(26, 'Móveis e Decoração', NULL, NULL, 2),
(27, 'Bijouterias, relógios e jóias', NULL, NULL, 3),
(28, 'Malas, mochilas e acessórios', NULL, NULL, 3),
(29, 'Roupas e calçados', NULL, NULL, 3),
(30, 'Saúde e Beleza', NULL, NULL, 3),
(31, 'Camping', NULL, NULL, 4),
(32, 'Ciclismo', NULL, NULL, 4),
(33, 'Fitness e Luta', NULL, NULL, 4),
(34, 'Skate e Patins', NULL, NULL, 4),
(35, 'Surf e Esportes Aquáticos', NULL, NULL, 4),
(36, 'Outros', NULL, NULL, 4),
(37, 'Arte - Coleções - Antiguidades', NULL, NULL, 5),
(38, 'Hobbies', NULL, NULL, 5),
(39, 'Instrumentos Musicais', NULL, NULL, 5),
(40, 'Livros, revistas, músicas e filmes', NULL, NULL, 5),
(41, 'Animais do Campo', NULL, NULL, 6),
(42, 'Máquinas e Tratores', NULL, NULL, 6),
(43, 'Produtos Agrículas', NULL, NULL, 6),
(44, 'Outros', NULL, NULL, 6),
(45, 'Currículos', NULL, NULL, 7),
(46, 'Indústria e Comércio', NULL, NULL, 7),
(47, 'Ofertas de emprego', NULL, NULL, 7),
(48, 'Serviços', NULL, NULL, 7),
(49, 'Acessórios', NULL, NULL, 8),
(50, 'Cachorros', NULL, NULL, 8),
(51, 'Outros animais', NULL, NULL, 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
