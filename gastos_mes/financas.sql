-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Tempo de geração: 27-Nov-2024 às 17:50
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Definindo a codificação UTF-8
SET NAMES utf8mb4;

-- Criando o banco de dados `financas`
CREATE DATABASE IF NOT EXISTS `financas` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `financas`;

-- --------------------------------------------------------

-- Estrutura da tabela `despesas`
CREATE TABLE `despesas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ano` INT(4) DEFAULT NULL,
  `mes` VARCHAR(255) DEFAULT NULL,
  `nome` VARCHAR(255) DEFAULT NULL,
  `valor` DECIMAL(10,2) DEFAULT NULL,
  `salario` DECIMAL(10,2) DEFAULT NULL,
  `descricao` VARCHAR(255) DEFAULT NULL,
  `categoria` VARCHAR(255) DEFAULT NULL,
  `tipo` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserindo dados na tabela `despesas`
INSERT INTO `despesas` (`id`, `ano`, `mes`, `nome`, `valor`, `salario`, `descricao`, `categoria`, `tipo`) VALUES
(31, 0, '', 'tia maria', 1000.00, NULL, 'tia maria', NULL, 'e'),
(32, 0, '', 'mercado', 500.00, NULL, 'mercado', NULL, 'saida'),
(33, 2024, '1', 'bor do seu zé', 100.00, NULL, 'bor do seu zé', 'alimentação', NULL);

-- --------------------------------------------------------

-- Estrutura da tabela `saldos`
CREATE TABLE `saldos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ano` INT(11) NOT NULL,
  `mes` INT(11) NOT NULL,
  `saldo` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ano_mes` (`ano`, `mes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserindo dados na tabela `saldos`
INSERT INTO `saldos` (`id`, `ano`, `mes`, `saldo`) VALUES
(1, 0, 0, -1500.00);

COMMIT;
