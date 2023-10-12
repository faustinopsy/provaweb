-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 06/10/2023 às 00:31
-- Versão do servidor: 8.0.33
-- Versão do PHP: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aulafatec`
--

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `AtualizarEndereco`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AtualizarEndereco` (IN `pId` INT, IN `pCep` VARCHAR(255), IN `pRua` VARCHAR(255), IN `pBairro` VARCHAR(255), IN `pCidade` VARCHAR(255), IN `pUf` VARCHAR(2))   BEGIN
    UPDATE endereco SET cep = pCep, rua = pRua, bairro = pBairro, cidade = pCidade, uf = pUf WHERE id = pId;
END$$

DROP PROCEDURE IF EXISTS `AtualizarProduto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AtualizarProduto` (IN `pId` INT, IN `pNome` VARCHAR(255), IN `pPreco` DECIMAL(10,2), IN `pQuantidade` INT)   BEGIN
    UPDATE produtos SET nome = pNome, preco = pPreco, quantidade = pQuantidade WHERE id = pId;
END$$

DROP PROCEDURE IF EXISTS `AtualizarUsuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AtualizarUsuario` (IN `pId` INT, IN `pNome` VARCHAR(255), IN `pEmail` VARCHAR(255), IN `pSenha` VARCHAR(255))   BEGIN
    UPDATE usuarios SET nome = pNome, email = pEmail, senha = pSenha WHERE id = pId;
END$$

DROP PROCEDURE IF EXISTS `DecrementarQuantidadeProduto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DecrementarQuantidadeProduto` (IN `pProdutoId` INT, IN `pQuantidade` INT)   BEGIN
    UPDATE produtos SET quantidade = quantidade - pQuantidade WHERE id = pProdutoId;
END$$

DROP PROCEDURE IF EXISTS `ExcluirEndereco`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ExcluirEndereco` (IN `pId` INT)   BEGIN
    DELETE FROM endereco WHERE id = pId;
END$$

DROP PROCEDURE IF EXISTS `ExcluirProduto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ExcluirProduto` (IN `pId` INT)   BEGIN
    DELETE FROM produtos WHERE id = pId;
END$$

DROP PROCEDURE IF EXISTS `ExcluirUsuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ExcluirUsuario` (IN `pId` INT)   BEGIN
    DELETE FROM usuarios WHERE id = pId;
END$$

DROP PROCEDURE IF EXISTS `IncrementarQuantidadeProduto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `IncrementarQuantidadeProduto` (IN `pProdutoId` INT, IN `pQuantidade` INT)   BEGIN
    UPDATE produtos SET quantidade = quantidade + pQuantidade WHERE id = pProdutoId;
END$$

DROP PROCEDURE IF EXISTS `InserirEndereco`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InserirEndereco` (IN `pCep` VARCHAR(255), IN `pRua` VARCHAR(255), IN `pBairro` VARCHAR(255), IN `pCidade` VARCHAR(255), IN `pUf` VARCHAR(2), IN `pIdUsuario` INT)   BEGIN
    INSERT INTO endereco (cep, rua, bairro, cidade, uf, iduser) VALUES (pCep, pRua, pBairro, pCidade, pUf, pIdUsuario);
END$$

DROP PROCEDURE IF EXISTS `InserirProduto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InserirProduto` (IN `pNome` VARCHAR(255), IN `pPreco` DECIMAL(10,2), IN `pQuantidade` INT)   BEGIN
    INSERT INTO produtos (nome, preco, quantidade, criado) VALUES (pNome, pPreco, pQuantidade, NOW());
END$$

DROP PROCEDURE IF EXISTS `InserirUsuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InserirUsuario` (IN `pNome` VARCHAR(255), IN `pEmail` VARCHAR(255), IN `pSenha` VARCHAR(255))   BEGIN
    INSERT INTO usuarios (nome, email, senha, criado) VALUES (pNome, pEmail, pSenha, NOW());
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cep` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `iduser` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `rua`, `bairro`, `cidade`, `uf`, `iduser`) VALUES
(1, '12345-678', 'Rua dos Pinheiros', 'Centro', 'São Paulo', 'SP', 1),
(2, '98765-432', 'Av. das Acácias', 'Jardim Flores', 'Rio de Janeiro', 'RJ', 2),
(3, '45678-901', 'Travessa dos Coqueiros', 'Bela Vista', 'Belo Horizonte', 'MG', 3),
(4, '65432-109', 'Rua das Mangueiras', 'Laranjeiras', 'Curitiba', 'PR', 4),
(5, '32109-876', 'Alameda dos Eucaliptos', 'Floresta', 'Porto Alegre', 'RS', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

DROP TABLE IF EXISTS `itens_venda`;
CREATE TABLE IF NOT EXISTS `itens_venda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_venda` int DEFAULT NULL,
  `id_produto` int DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_venda` (`id_venda`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Acionadores `itens_venda`
--
DROP TRIGGER IF EXISTS `trg_itens_venda_after_delete`;
DELIMITER $$
CREATE TRIGGER `trg_itens_venda_after_delete` AFTER DELETE ON `itens_venda` FOR EACH ROW BEGIN
    CALL IncrementarQuantidadeProduto(OLD.id_produto, OLD.quantidade);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_itens_venda_after_insert`;
DELIMITER $$
CREATE TRIGGER `trg_itens_venda_after_insert` AFTER INSERT ON `itens_venda` FOR EACH ROW BEGIN
    CALL DecrementarQuantidadeProduto(NEW.id_produto, NEW.quantidade);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_itens_venda_after_update`;
DELIMITER $$
CREATE TRIGGER `trg_itens_venda_after_update` AFTER UPDATE ON `itens_venda` FOR EACH ROW BEGIN
    DECLARE diff_quantity INT;

    SET diff_quantity = NEW.quantidade - OLD.quantidade;

    CALL DecrementarQuantidadeProduto(NEW.id_produto, diff_quantity);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `quantidade` int DEFAULT '0',
  `criado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `quantidade`, `criado`) VALUES
(1, 'Smartphone XYZ', 2499.90, 10, '2023-10-05 23:22:18'),
(2, 'Notebook ABC 15\"', 3999.00, 5, '2023-10-05 23:22:18'),
(3, 'Fone de Ouvido JKL', 299.90, 19, '2023-10-05 23:22:18'),
(4, 'Tablet GHI 10\"', 1599.90, 8, '2023-10-05 23:22:18'),
(5, 'Smartwatch MNO', 999.90, 15, '2023-10-05 23:22:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `token` varchar(45) DEFAULT NULL,
  `expira` datetime DEFAULT ((now() + interval 5 minute)),
  PRIMARY KEY (`id`),
  KEY `users_idx` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `token`
--

INSERT INTO `token` (`id`, `id_usuario`, `token`, `expira`) VALUES
(2, 3, 'dfssssssseeeeeeeeee', NULL);

--
-- Acionadores `token`
--
DROP TRIGGER IF EXISTS `set_expiry_date_before_insert`;
DELIMITER $$
CREATE TRIGGER `set_expiry_date_before_insert` BEFORE INSERT ON `token` FOR EACH ROW BEGIN
    SET NEW.expira = NOW() + INTERVAL 5 MINUTE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `criado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `criado`) VALUES
(1, 'Lucas Martins', 'lucas.martins@email.com', 'senha123!', '2023-10-05 23:22:03'),
(2, 'Mariana Soares', 'mariana.soares@email.com', 'mariana89!', '2023-10-05 23:22:03'),
(3, 'Carlos Silva', 'carlos.silva@email.com', 'carlosSecure$', '2023-10-05 23:22:03'),
(4, 'Juliana Castro', 'juliana.castro@email.com', 'juliCastro2023!', '2023-10-05 23:22:03'),
(5, 'Roberto Alves', 'roberto.alves@email.com', 'robAlves!2023', '2023-10-05 23:22:03');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `usuariosendereco`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `usuariosendereco`;
CREATE TABLE IF NOT EXISTS `usuariosendereco` (
`Nome` varchar(255)
,`Email` varchar(255)
,`Cidade` varchar(255)
,`UF` varchar(2)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE IF NOT EXISTS `venda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `data_venda` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id`, `id_usuario`, `data_venda`) VALUES
(1, 4, '2023-10-05 23:37:52');

-- --------------------------------------------------------

--
-- Estrutura para view `usuariosendereco`
--
DROP TABLE IF EXISTS `usuariosendereco`;

DROP VIEW IF EXISTS `usuariosendereco`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuariosendereco`  AS SELECT `usuarios`.`nome` AS `Nome`, `usuarios`.`email` AS `Email`, `endereco`.`cidade` AS `Cidade`, `endereco`.`uf` AS `UF` FROM (`usuarios` join `endereco` on((`usuarios`.`id` = `endereco`.`iduser`))) ;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `itens_venda_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `users` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Eventos
--
DROP EVENT IF EXISTS `limpa_tokens`$$
CREATE DEFINER=`root`@`localhost` EVENT `limpa_tokens` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-10-05 20:49:04' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM token WHERE expira < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
