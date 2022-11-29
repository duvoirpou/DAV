-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 03 jan. 2020 à 19:09
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mie_dange`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `matricule` varchar(20) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `prenoms` varchar(50) NOT NULL,
  `date_nais` varchar(25) NOT NULL,
  `lieu_nais` varchar(25) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `nationalite` varchar(25) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `tele` varchar(25) NOT NULL,
  `sitfam` varchar(25) NOT NULL,
  `charge` int(11) NOT NULL,
  `date_eng` date NOT NULL,
  `contrat` varchar(25) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `salaire_base` int(11) NOT NULL,
  `prime_fct` int(11) NOT NULL,
  `prime_autre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `brouillon_agent`
--

DROP TABLE IF EXISTS `brouillon_agent`;
CREATE TABLE IF NOT EXISTS `brouillon_agent` (
  `code` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `noms` varchar(50) NOT NULL,
  `prenoms` varchar(50) NOT NULL,
  `date_nais` varchar(25) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bulletin`
--

DROP TABLE IF EXISTS `bulletin`;
CREATE TABLE IF NOT EXISTS `bulletin` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `matricule` varchar(20) CHARACTER SET utf8 NOT NULL,
  `salaire_base` int(11) NOT NULL,
  `prime_fonction` int(11) NOT NULL,
  `autre_prime` int(11) NOT NULL,
  `dette` int(11) NOT NULL,
  `periode` varchar(20) CHARACTER SET utf8 NOT NULL,
  `date_bulletin` varchar(20) CHARACTER SET utf8 NOT NULL,
  `mode_reglement` varchar(50) CHARACTER SET utf8 NOT NULL,
  `net_payer` int(11) NOT NULL,
  `annee` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_cat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `libelle_cat`) VALUES
(1, 'BOISSONS CHAUDES'),
(2, 'BOISSONS FRAICHES'),
(3, 'BOULANGERIE'),
(4, 'CUISINE'),
(5, 'PATISSERIE'),
(6, 'VIENNOISERIE');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_cl` int(11) NOT NULL AUTO_INCREMENT,
  `noms_cl` varchar(255) DEFAULT NULL,
  `tel_cl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_cl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_cmd` int(11) NOT NULL AUTO_INCREMENT,
  `id_cl` int(11) DEFAULT NULL,
  `date_cmd` date DEFAULT NULL,
  `montant` int(11) DEFAULT '0',
  PRIMARY KEY (`id_cmd`),
  KEY `fk_commande_clients1_idx` (`id_cl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `mt_lettre` varchar(50) NOT NULL,
  `date_dep` date DEFAULT NULL,
  `heure_dep` time NOT NULL,
  `mois_dep` varchar(20) NOT NULL,
  `annee_dep` int(11) NOT NULL,
  `benef` varchar(50) NOT NULL,
  `caissiere` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `details_recette`
--

DROP TABLE IF EXISTS `details_recette`;
CREATE TABLE IF NOT EXISTS `details_recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `libelle` varchar(25) NOT NULL,
  `qte` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `pt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_recette`
--

INSERT INTO `details_recette` (`id`, `id_recette`, `id_cat`, `libelle`, `qte`, `pu`, `pt`) VALUES
(1, 1, 3, 'PAIN COMPLET', 2, 200, 400),
(2, 1, 3, 'PAIN OBUS', 2, 100, 200),
(3, 1, 3, 'PAIN DORA', 3, 100, 300),
(4, 2, 3, 'PAIN COMPLET', 2, 200, 400),
(5, 3, 3, 'PAIN COMPLET', 2, 200, 400),
(6, 4, 3, 'PAIN OBUS', 2, 100, 200),
(7, 5, 3, 'PAIN OBUS', 2, 100, 200),
(8, 6, 3, 'PAIN COMPLET', 2, 200, 400),
(9, 7, 3, 'PAIN COMPLET', 2, 200, 400),
(10, 8, 3, 'PAIN OBUS', 2, 100, 200),
(11, 8, 3, 'PAIN COMPLET', 2, 200, 400),
(12, 9, 3, 'PAIN COMPLET', 3, 200, 600),
(13, 10, 3, 'PAIN DORA', 3, 100, 300),
(14, 11, 3, 'PAIN DORA', 3, 100, 300),
(15, 12, 3, 'PAIN DORA', 3, 100, 300),
(16, 13, 3, 'PAIN COMPLET', 5, 200, 1000),
(17, 14, 3, 'PAIN COMPLET', 2, 200, 400),
(18, 15, 3, 'PAIN COMPLET', 4, 200, 800),
(19, 16, 3, 'PAIN DORA', 4, 100, 400),
(20, 16, 3, 'PAIN COMPLET', 5, 200, 1000),
(21, 17, 3, 'PAIN DORA', 2, 100, 200),
(22, 17, 3, 'PAIN COMPLET', 5, 200, 1000),
(23, 18, 3, 'PAIN DORA', 2, 100, 200),
(24, 18, 3, 'PAIN COMPLET', 4, 200, 800),
(25, 19, 3, 'PAIN DORA', 3, 100, 300),
(26, 19, 3, 'PAIN COMPLET', 2, 200, 400),
(27, 20, 3, 'PAIN DORA', 6, 100, 600),
(28, 20, 3, 'PAIN COMPLET', 7, 200, 1400),
(29, 21, 3, 'PAIN DORA', 10, 100, 1000),
(30, 21, 3, 'PAIN COMPLET', 6, 200, 1200),
(31, 22, 3, 'PAIN DORA', 10, 100, 1000),
(32, 22, 3, 'PAIN COMPLET', 6, 200, 1200),
(33, 23, 3, 'PAIN DORA', 3, 100, 300),
(34, 24, 3, 'PAIN DORA', 2, 100, 200),
(35, 25, 3, 'PAIN DORA', 3, 100, 300),
(36, 25, 3, 'PAIN COMPLET', 3, 200, 600);

-- --------------------------------------------------------

--
-- Structure de la table `dette_agent`
--

DROP TABLE IF EXISTS `dette_agent`;
CREATE TABLE IF NOT EXISTS `dette_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_agent` varchar(20) NOT NULL,
  `mt_dette` int(11) NOT NULL,
  `libelle_dette` varchar(50) NOT NULL,
  `mois_engage` varchar(20) NOT NULL,
  `date_dette` date NOT NULL,
  `annee_engage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture_ach`
--

DROP TABLE IF EXISTS `facture_ach`;
CREATE TABLE IF NOT EXISTS `facture_ach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_liv` int(11) DEFAULT NULL,
  `id_prod` int(11) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `pu` int(11) DEFAULT NULL,
  `pt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facture_ach_produits1_idx` (`id_prod`),
  KEY `fk_facture_ach_livraison1_idx` (`id_liv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture_vent`
--

DROP TABLE IF EXISTS `facture_vent`;
CREATE TABLE IF NOT EXISTS `facture_vent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cmd` int(11) DEFAULT NULL,
  `id_prod` int(11) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `pu` int(11) DEFAULT NULL,
  `pt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facture_vent_produits1_idx` (`id_prod`),
  KEY `fk_facture_vent_commande1_idx` (`id_cmd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raison_sociale` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `raison_sociale`, `adresse`, `contact`, `responsable`) VALUES
(1, 'MARCHE POTO-POTO', 'POTO-POTO', '0', 'MARCHE POTO-POTO');

-- --------------------------------------------------------

--
-- Structure de la table `journal_caisse`
--

DROP TABLE IF EXISTS `journal_caisse`;
CREATE TABLE IF NOT EXISTS `journal_caisse` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `id_cmd` int(11) DEFAULT NULL,
  `id_cl` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `date_jour` date DEFAULT NULL,
  PRIMARY KEY (`ref`),
  KEY `fk_journal_caisse_clients1_idx` (`id_cl`),
  KEY `fk_journal_caisse_commande1_idx` (`id_cmd`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id_liv` int(11) NOT NULL AUTO_INCREMENT,
  `date_liv` date DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_liv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matiere_premiere`
--

DROP TABLE IF EXISTS `matiere_premiere`;
CREATE TABLE IF NOT EXISTS `matiere_premiere` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `montant` int(11) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY (`id_mat`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matiere_premiere`
--

INSERT INTO `matiere_premiere` (`id_mat`, `libelle`, `montant`, `fournisseur`, `id_cat`) VALUES
(1, 'FARINE', 0, 1, 3),
(2, 'LEVURE', 0, 1, 3),
(3, 'HUILE D\'ARACHIDE', 0, 1, 3),
(4, 'AMELIORANT', 0, 1, 3),
(5, 'SEL', 0, 1, 3),
(6, 'BEURRE EVITA', 0, 1, 3),
(7, 'OEUF', 0, 1, 3),
(8, 'SUCRE', 0, 1, 3),
(9, 'LAIT', 0, 1, 3),
(10, 'LAME GILETTE', 0, 1, 3),
(11, 'CHAMPIGNON', 0, 1, 4),
(12, 'OLIVE NOIR', 0, 1, 4),
(13, 'OLIVE VERT', 0, 1, 4),
(14, 'VINAIGRE', 0, 1, 4),
(15, 'POIVRE NOIR', 0, 1, 4),
(16, 'POIVRE BLANC', 0, 1, 4),
(17, 'FROMAGE EMENTAL', 0, 1, 4),
(18, 'SALAMI', 0, 1, 4),
(19, 'SAUCISSON A L\'AIL', 0, 1, 4),
(20, 'CORNICHON', 0, 1, 4),
(21, 'CHOUX', 0, 1, 4),
(22, 'RIZ', 0, 1, 4),
(23, 'SPAGUETTI', 0, 1, 4),
(24, 'TOMATE CONCENTREE', 0, 1, 4),
(25, 'SAUCISSE DE MERGUEZ', 0, 1, 4),
(26, 'COUSCOUS', 0, 1, 4),
(27, 'PAIN LIBANAI', 0, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `pt` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

DROP TABLE IF EXISTS `production`;
CREATE TABLE IF NOT EXISTS `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pdt` int(11) NOT NULL,
  `qnte_init` int(11) NOT NULL DEFAULT '0',
  `qnte_ent` int(11) NOT NULL DEFAULT '0',
  `qnte_vend` int(11) NOT NULL DEFAULT '0',
  `qnte_rest` int(11) NOT NULL DEFAULT '0',
  `prix_uni` int(11) NOT NULL,
  `prix_tot` int(11) NOT NULL DEFAULT '0',
  `id_cat` int(11) NOT NULL,
  `date_production` date NOT NULL,
  `mois_production` varchar(20) NOT NULL,
  `an_production` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `production`
--

INSERT INTO `production` (`id`, `id_pdt`, `qnte_init`, `qnte_ent`, `qnte_vend`, `qnte_rest`, `prix_uni`, `prix_tot`, `id_cat`, `date_production`, `mois_production`, `an_production`) VALUES
(1, 1, 0, 100, 0, 100, 200, 20000, 3, '2019-12-31', 'decembre', 2019),
(2, 1, 100, 0, 20, 80, 200, 4000, 3, '2019-12-31', 'decembre', 2019),
(3, 2, 0, 500, 0, 500, 100, 50000, 3, '2019-12-31', 'decembre', 2019),
(4, 2, 500, 0, 375, 125, 100, 37500, 3, '2019-12-31', 'decembre', 2019),
(5, 1, 80, 40, 0, 120, 200, 8000, 3, '2019-12-31', 'decembre', 2019),
(6, 1, 120, 0, 70, 50, 200, 14000, 3, '2019-12-31', 'decembre', 2019),
(7, 1, 50, 0, 15, 35, 200, 3000, 3, '2020-01-03', 'janvier', 2020),
(8, 1, 35, 0, 10, 25, 200, 2000, 3, '2020-01-03', 'janvier', 2020),
(9, 1, 25, 30, 0, 55, 200, 6000, 3, '2020-01-03', 'janvier', 2020),
(10, 1, 55, 15, 0, 70, 200, 3000, 3, '2020-01-03', 'janvier', 2020),
(11, 2, 125, 150, 0, 275, 100, 15000, 3, '2020-01-03', 'janvier', 2020),
(12, 3, 0, 250, 0, 250, 100, 25000, 3, '2020-01-03', 'janvier', 2020),
(13, 3, 250, 0, 87, 163, 100, 8700, 3, '2020-01-03', 'janvier', 2020),
(14, 5, 0, 25, 0, 25, 1000, 25000, 5, '2020-01-03', 'janvier', 2020),
(15, 5, 25, 0, 12, 13, 1000, 12000, 5, '2020-01-03', 'janvier', 2020),
(16, 10, 0, 100, 0, 100, 200, 20000, 5, '2020-01-03', 'janvier', 2020),
(17, 10, 100, 0, 48, 52, 200, 9600, 5, '2020-01-03', 'janvier', 2020),
(18, 13, 0, 20, 0, 20, 500, 10000, 5, '2020-01-03', 'janvier', 2020),
(19, 17, 0, 50, 0, 50, 500, 25000, 6, '2020-01-03', 'janvier', 2020),
(20, 17, 50, 0, 20, 30, 500, 10000, 6, '2020-01-03', 'janvier', 2020),
(21, 20, 0, 20, 0, 20, 500, 10000, 6, '2020-01-03', 'janvier', 2020),
(22, 20, 20, 0, 8, 12, 500, 4000, 6, '2020-01-03', 'janvier', 2020),
(23, 64, 0, 50, 0, 50, 500, 25000, 2, '2020-01-03', 'janvier', 2020),
(24, 64, 50, 0, 15, 35, 500, 7500, 2, '2020-01-03', 'janvier', 2020),
(25, 86, 0, 50, 0, 50, 900, 45000, 1, '2020-01-03', 'janvier', 2020),
(26, 86, 50, 0, 15, 35, 900, 13500, 1, '2020-01-03', 'janvier', 2020),
(27, 25, 0, 2, 0, 2, 2500, 5000, 4, '2020-01-03', 'janvier', 2020),
(28, 25, 2, 0, 2, 0, 2500, 5000, 4, '2020-01-03', 'janvier', 2020),
(29, 2, 2, 0, 1, 265, 1, 1000, 3, '2020-01-03', 'janvier', 2020),
(30, 1, 7, 0, 6, 64, 2, 1200, 3, '2020-01-03', 'janvier', 2020),
(31, 2, 2, 0, 3, 262, 1, 300, 3, '2020-01-03', 'janvier', 2020),
(32, 2, 2, 0, 2, 260, 100, 200, 3, '2020-01-03', 'janvier', 2020),
(33, 2, 2, 0, 3, 257, 100, 300, 3, '2020-01-03', 'janvier', 2020),
(34, 1, 6, 0, 3, 61, 200, 600, 3, '2020-01-03', 'janvier', 2020);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `fk_produits_categories_idx` (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_prod`, `description`, `id_cat`, `prix`) VALUES
(1, 'PAIN COMPLET', 3, 200),
(2, 'PAIN DORA', 3, 100),
(3, 'PAIN OBUS', 3, 100),
(4, 'PAIN PETIT BOULE', 3, 50),
(5, 'MOKA A LA VANILLE', 5, 1000),
(6, 'MOKA A LA FRAISE', 5, 1000),
(7, 'MOKA AU COCO', 5, 1000),
(8, 'MOKA EXOTIQUE', 5, 1000),
(9, 'QUATRE QUARTS', 5, 550),
(10, 'MADELEINE NATURE', 5, 200),
(11, 'MADELEINE AU COCO', 5, 250),
(12, 'MADELEINE AU CHOCOLAT', 5, 250),
(13, 'PUDDING', 5, 500),
(14, 'BOUTONNIERES', 6, 700),
(15, 'PATTE D\'OURSE', 5, 700),
(16, 'BISCUIT MIE D\'ANGE', 6, 200),
(17, 'CROISSANT AU BEURRE', 6, 500),
(18, 'CROISSANT AUX AMANDES', 6, 1000),
(19, 'PAIN AU CHOCOLAT', 6, 500),
(20, 'CHAUSSON AU COCO', 6, 500),
(21, 'CHAUSSON A LA POMME', 6, 500),
(22, 'PAIN AU RAISIN', 6, 500),
(23, 'SACRISTIN', 6, 250),
(24, 'HAMBURGER SIMPLE', 4, 1800),
(25, 'CHEESE BURGER AVEC FRITES', 4, 2500),
(26, 'ROYAL BURGER AVEC FRITES', 4, 2800),
(27, 'DOUBLE BURGER AVEC FRITES', 4, 3500),
(28, 'HAMBURGER POULET AVEC FRITES', 4, 2800),
(29, 'HAMBURGER MIE D\'ANGE', 4, 4000),
(30, 'SANDWICH AU JAMBON', 4, 1800),
(31, 'SANDWICH CRUDITE', 4, 1500),
(32, 'SANDWICH AU FROMAGE', 4, 1800),
(33, 'SANDWICH CRUDITE, OEUF', 4, 1800),
(34, 'SANDWICH VIANDE HACHEE', 4, 1800),
(35, 'SANDWICH AU POULET', 4, 1800),
(36, 'CHAWARMA POULET', 4, 1500),
(37, 'CHAWARMA VIANDE', 4, 1500),
(38, 'FRITES', 4, 1000),
(39, 'FILET DE POISSON CREME AUX CHAMPIGONS AVEC RIZ', 4, 7000),
(40, 'STEACK / RIZ', 4, 4000),
(41, 'ESCALOPE DE POULET AUTE / RIZ', 4, 4000),
(42, 'CUISSE DE POULET ROTI / FRITES', 4, 4000),
(43, 'AILES DE POULET SAUTEES SAUCE / RIZ', 4, 3500),
(44, 'STEACK CREME AUX CHAMPIGNONS / RIZ', 4, 700),
(45, 'RIA A LA MACEDOINE', 4, 3000),
(46, 'RIZ AUX PETITS POIS AVEC OEUFS', 4, 3000),
(47, 'COUSCOUS VEGETARIEN', 4, 3000),
(48, 'COUSCOUS MIXTE', 4, 4000),
(49, 'SPAGHETTI BOLOGNAISE', 4, 3500),
(50, 'SPAGHETTI A LA VIANDE', 4, 3500),
(51, 'SPAGHETTI STEACK', 4, 3500),
(52, 'SPAGHETTI ESCALOPE DE POULET', 4, 2500),
(53, 'SPAGHETTI A LA SAUCE TOMATE', 4, 2500),
(54, 'PIZZA MIE D\'ANGE (NORMALE)', 4, 4000),
(55, 'PIZZA MIE D\'ANGE (GM)', 4, 6000),
(56, 'PIZZA VEGETARIENNE (NORMALE)', 4, 4000),
(57, 'PIZZA VEGETARIENNE (GM)', 4, 6000),
(58, 'PIZZA MARGHERITA (NORMALE)', 4, 4000),
(59, 'PIZZA MARGHERITA (GM)', 4, 6000),
(60, 'PIZZA REINE (NORMALE)', 4, 4000),
(61, 'PIZZA REINE (GM)', 4, 6000),
(62, 'PIZZA MERGUEZ (NORMALE)', 4, 4000),
(63, 'PIZZA MERGUEZ (GM)', 4, 6000),
(64, 'FANTA (PM)', 2, 500),
(65, 'PULP ORANGE (PM)', 2, 500),
(66, 'COCA (PM)', 2, 500),
(67, 'PERRIER', 2, 1000),
(68, 'Jus en brique(GM)', 2, 1700),
(69, 'CERES (PM)', 2, 500),
(70, 'REAKTOR', 2, 700),
(71, 'ORANGINA', 2, 700),
(72, 'Heineken', 2, 700),
(73, 'REDBULL', 2, 1500),
(74, 'BAVARIA', 2, 1500),
(75, '33 EXPORT', 2, 700),
(76, 'MAYO (PM)', 2, 700),
(77, 'CLASS', 2, 700),
(78, 'BLACK', 2, 700),
(79, 'PRIMUS', 2, 700),
(80, 'NGOK', 2, 700),
(81, 'BOOSTER', 2, 700),
(82, 'DESPERADOS', 2, 700),
(83, 'POWER', 2, 700),
(84, 'NESPRESSO', 1, 900),
(85, 'THE', 1, 600),
(86, 'LAIT CHAUD', 1, 900),
(87, 'CHOCOLAT CHAUD', 1, 1500);

-- --------------------------------------------------------

--
-- Structure de la table `recap_recette`
--

DROP TABLE IF EXISTS `recap_recette`;
CREATE TABLE IF NOT EXISTS `recap_recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `qnte` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `pt` int(11) NOT NULL,
  `date_recette` date NOT NULL,
  `mois_recette` varchar(20) NOT NULL,
  `annee_recette` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) DEFAULT NULL,
  `date_recette` date DEFAULT NULL,
  `heure_recette` time NOT NULL,
  `mois_recette` varchar(25) NOT NULL,
  `annee_recette` year(4) NOT NULL,
  `caissiere` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `montant`, `date_recette`, `heure_recette`, `mois_recette`, `annee_recette`, `caissiere`) VALUES
(1, 900, '2020-01-02', '09:52:54', 'janvier', 2020, 'admin'),
(2, 400, '2020-01-02', '12:07:40', 'janvier', 2020, 'admin'),
(3, 400, '2020-01-02', '12:07:44', 'janvier', 2020, 'admin'),
(4, 200, '2020-01-02', '12:08:56', 'janvier', 2020, 'admin'),
(5, 200, '2020-01-02', '12:09:10', 'janvier', 2020, 'admin'),
(6, 400, '2020-01-02', '17:54:29', 'janvier', 2020, 'admin'),
(7, 400, '2020-01-03', '17:31:13', 'janvier', 2020, 'admin'),
(8, 600, '2020-01-03', '17:51:38', 'janvier', 2020, 'admin'),
(9, 600, '2020-01-03', '18:24:42', 'janvier', 2020, 'admin'),
(10, 300, '2020-01-03', '18:29:03', 'janvier', 2020, 'admin'),
(11, 300, '2020-01-03', '18:31:03', 'janvier', 2020, 'admin'),
(12, 300, '2020-01-03', '18:32:23', 'janvier', 2020, 'admin'),
(13, 1000, '2020-01-03', '18:33:40', 'janvier', 2020, 'admin'),
(14, 400, '2020-01-03', '18:35:45', 'janvier', 2020, 'admin'),
(15, 800, '2020-01-03', '18:38:26', 'janvier', 2020, 'admin'),
(16, 1400, '2020-01-03', '18:41:30', 'janvier', 2020, 'admin'),
(17, 1200, '2020-01-03', '18:45:10', 'janvier', 2020, 'admin'),
(18, 1000, '2020-01-03', '18:50:03', 'janvier', 2020, 'admin'),
(19, 700, '2020-01-03', '18:52:17', 'janvier', 2020, 'admin'),
(20, 2000, '2020-01-03', '18:55:22', 'janvier', 2020, 'admin'),
(21, 2200, '2020-01-03', '18:57:59', 'janvier', 2020, 'admin'),
(22, 2200, '2020-01-03', '18:59:59', 'janvier', 2020, 'admin'),
(23, 300, '2020-01-03', '19:02:18', 'janvier', 2020, 'admin'),
(24, 200, '2020-01-03', '19:04:20', 'janvier', 2020, 'admin'),
(25, 900, '2020-01-03', '19:05:43', 'janvier', 2020, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `ref` int(11) NOT NULL AUTO_INCREMENT,
  `id_mat` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `entree` int(11) DEFAULT NULL,
  `sortie` int(11) DEFAULT NULL,
  `solde` int(11) DEFAULT NULL,
  `date_st` date DEFAULT NULL,
  `mois_st` varchar(20) NOT NULL,
  `an_st` varchar(10) NOT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`ref`, `id_mat`, `id_cat`, `stock`, `entree`, `sortie`, `solde`, `date_st`, `mois_st`, `an_st`) VALUES
(1, 1, 3, NULL, 20, 0, 20, '2019-12-31', 'decembre', '2019');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `login`, `password`, `type`) VALUES
(1, 'admin', '0000', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
