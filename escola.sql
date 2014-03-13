-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `escola`
--
CREATE DATABASE `escola` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `escola`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `matricula` int(11) NOT NULL AUTO_INCREMENT,
  `aluno` varchar(45) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(15) NOT NULL,
  `email` varchar(115) NOT NULL,
  `turma_id_turma` int(11) NOT NULL,
  PRIMARY KEY (`matricula`),
  KEY `fk_aluno_turma1_idx` (`turma_id_turma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `aluno`, `data_nascimento`, `cpf`, `email`, `turma_id_turma`) VALUES
(1, 'Tiago FranÃ§a', '1992-09-23', '', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `curso` varchar(45) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `curso`) VALUES
(1, 'Analise e Desenvolvimento de Sistemas'),
(2, 'EduacaÃ§Ã£o FÃ­sica'),
(3, 'Pedagogia'),
(4, 'Recursos Humanos'),
(5, 'AdministraÃ§Ã£o'),
(7, 'CiÃªncias ContÃ¡beis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `disciplina` varchar(45) NOT NULL,
  `curso_id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `fk_disciplina_curso1_idx` (`curso_id_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `disciplina`, `curso_id_curso`) VALUES
(1, 'Projetos e Sistemas para WEB', 1),
(3, 'GestÃ£o de SeguranÃ§a da InfomaÃ§Ã£o', 1),
(4, 'Banco de Dados', 1),
(5, 'ProgramaÃ§Ã£o WEB', 1),
(6, 'LÃ³gica de ProgramaÃ§Ã£o', 1),
(7, 'InformÃ¡tica BÃ¡sica', 1),
(8, 'Fundamentos da EduaÃ§Ã£o FÃ­sica', 2),
(9, 'PrincÃ­pio PedagÃ³gico', 3),
(10, 'GestÃ£o em T.I.', 1),
(12, 'Fundamentos da MatemÃ¡tica', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_professor`
--

CREATE TABLE IF NOT EXISTS `disciplina_professor` (
  `disciplina_id_disciplina` int(11) NOT NULL,
  `professor_id_professor` int(11) NOT NULL,
  PRIMARY KEY (`disciplina_id_disciplina`,`professor_id_professor`),
  KEY `fk_disciplina_has_professor_professor1_idx` (`professor_id_professor`),
  KEY `fk_disciplina_has_professor_disciplina1_idx` (`disciplina_id_disciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplina_professor`
--

INSERT INTO `disciplina_professor` (`disciplina_id_disciplina`, `professor_id_professor`) VALUES
(3, 1),
(5, 1),
(4, 2),
(1, 3),
(6, 5),
(7, 5),
(10, 23),
(3, 24),
(4, 24),
(5, 24),
(6, 24),
(10, 24),
(12, 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int(11) NOT NULL AUTO_INCREMENT,
  `professor` varchar(45) NOT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `professor`) VALUES
(1, 'Evandro Mohr'),
(2, 'Rodrigo Lazari'),
(3, 'DrÃ¡ulio Filho'),
(5, 'AntÃ´nio Filho'),
(23, 'MÃ¡rcio Henrique'),
(24, 'Pedir Mais Cedo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `turma` varchar(45) NOT NULL,
  `curso_id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_turma`),
  KEY `fk_turma_curso_idx` (`curso_id_curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `turma`, `curso_id_curso`) VALUES
(1, '270153', 1),
(3, '3939393', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `senha_alterada` tinyint(1) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `email`, `senha`, `senha_alterada`, `ativo`, `admin`) VALUES
(1, 'tiago', 'tiago@sistema.com.br', '202cb962ac59075b964b07152d234b70', 0, 1, 1),
(2, 'teste', 'tiagojp_@hotmail.com', '76d80224611fc919a5d54f0ff9fba446', 0, 1, 0),
(3, 'neto.fontenele', 'netofontenelenf@hotmail.com', 'cf76cc47224ffe7c928a2093f39490a8', 1, 1, 0);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_turma1` FOREIGN KEY (`turma_id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_curso1` FOREIGN KEY (`curso_id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `disciplina_professor`
--
ALTER TABLE `disciplina_professor`
  ADD CONSTRAINT `fk_disciplina_has_professor_disciplina1` FOREIGN KEY (`disciplina_id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disciplina_has_professor_professor1` FOREIGN KEY (`professor_id_professor`) REFERENCES `professor` (`id_professor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_curso` FOREIGN KEY (`curso_id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
