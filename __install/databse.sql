-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Úte 21. srp 2012, 12:59
-- Verze MySQL: 5.5.16
-- Verze PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databáze: `brejk`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `id_match` int(11) unsigned NOT NULL,
  `update` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `round` tinyint(2) unsigned NOT NULL,
  `id_team_home` int(11) unsigned NOT NULL,
  `id_team_away` int(11) unsigned NOT NULL,
  `score_home` tinyint(3) unsigned NOT NULL,
  `score_away` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `id_player` int(11) unsigned NOT NULL,
  `id_team` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `country` char(2) COLLATE utf8_czech_ci NOT NULL,
  `position` char(2) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_player`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `player_update`
--

CREATE TABLE IF NOT EXISTS `player_update` (
  `id_player_update` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_player` int(11) NOT NULL,
  `age` tinyint(3) unsigned NOT NULL,
  `update` date NOT NULL,
  `g` tinyint(3) unsigned NOT NULL,
  `o` tinyint(3) unsigned NOT NULL,
  `u` tinyint(3) unsigned NOT NULL,
  `s` tinyint(3) unsigned NOT NULL,
  `t` tinyint(3) unsigned NOT NULL,
  `h` tinyint(3) unsigned NOT NULL,
  `a` tinyint(3) unsigned NOT NULL,
  `p` tinyint(3) unsigned NOT NULL,
  `k` tinyint(3) unsigned NOT NULL,
  `gr` tinyint(3) unsigned NOT NULL,
  `ga` tinyint(3) unsigned NOT NULL,
  `sd` tinyint(3) unsigned NOT NULL,
  `sz` tinyint(3) unsigned NOT NULL,
  `kr` tinyint(3) unsigned NOT NULL,
  `kv` tinyint(3) unsigned NOT NULL,
  `z` tinyint(3) unsigned NOT NULL,
  `ea` tinyint(3) unsigned NOT NULL,
  `ec` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_player_update`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id_team` int(11) unsigned NOT NULL,
  `name_team` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `id_manager` int(11) unsigned NOT NULL,
  `name_manager` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_czech_ci NOT NULL,
  `created` date NOT NULL,
  `loaded_matches` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_team`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `team_update`
--

CREATE TABLE IF NOT EXISTS `team_update` (
  `id_team_update` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `id_team` int(11) unsigned NOT NULL,
  `update` date NOT NULL,
  `league` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `coefficient` float NOT NULL,
  `fans_min` tinyint(4) NOT NULL,
  `fans` float(11,2) NOT NULL,
  `stadium` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `stadium_capacity` int(5) NOT NULL,
  PRIMARY KEY (`id_team_update`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;