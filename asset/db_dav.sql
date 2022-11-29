-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 31 jan. 2020 à 18:11
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_dav`
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `libelle_cat`) VALUES
(1, 'Chemises'),
(2, 'Robes'),
(3, 'Jupe'),
(4, 'Tunique'),
(5, 'ceinture'),
(6, 'fhf'),
(7, 'fr'),
(8, 'te'),
(9, 'zz'),
(10, 'Chemise'),
(11, 'Chemise'),
(12, 'Chemise'),
(13, 'ds'),
(14, 'dsss'),
(15, 'z');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `noms_client` varchar(255) DEFAULT NULL,
  `prenoms_client` varchar(50) DEFAULT NULL,
  `num_client` varchar(20) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `commune` varchar(25) DEFAULT NULL,
  `quartier` varchar(25) DEFAULT NULL,
  `rue` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `noms_client`, `prenoms_client`, `num_client`, `ville`, `commune`, `quartier`, `rue`) VALUES
(1, 'dgdsfg', 'dfgdfg', 'dgsdg', 'dgd', 'dgd', 'dgdsg', 'sdgsdg'),
(2, 'Sylla', 'KONE', '065887744', 'Brazzaville', 'poto poto', '34', '113 rue des martyrs'),
(3, 'APC', 'As', '065887744', 'Brazzaville', 'poto poto', '34', '113 rue des martyrs');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_cmd` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `nbre_tissus` int(11) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `montant` int(11) DEFAULT '0',
  `avance` int(11) NOT NULL,
  `date_depot` date DEFAULT NULL,
  `date_retrait` date NOT NULL,
  `remarques` text,
  `caissiere` varchar(250) NOT NULL,
  PRIMARY KEY (`id_cmd`),
  KEY `fk_commande_clients1_idx` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_cmd`, `id_client`, `nbre_tissus`, `modele`, `montant`, `avance`, `date_depot`, `date_retrait`, `remarques`, `caissiere`) VALUES
(1, 2, 1, 'col', 20000, 20000, '2020-01-20', '2020-01-24', '...', 'admin'),
(2, 2, 1, 'col', 20000, 20000, '2020-01-20', '2020-01-24', '...', 'admin'),
(3, 1, 1, '...', 5000, 5000, '2020-01-21', '2020-01-24', '...', 'admin'),
(4, 1, 1, '...', 5000, 5000, '2020-01-21', '2020-01-24', '...', 'admin'),
(5, 2, 1, '..', 1000, 500, '2020-01-21', '2020-01-24', '...', 'admin'),
(6, 2, 1, '..', 1000, 500, '2020-01-21', '2020-01-24', '...', 'admin'),
(7, 2, 1, '...', 2000, 2000, '2020-01-24', '2020-01-31', '...', 'admin'),
(8, 2, 1, '...', 2000, 2000, '2020-01-24', '2020-01-31', '...', 'admin'),
(9, 2, 1, '...', 2000, 2000, '2020-01-24', '2020-01-31', '...', 'admin'),
(10, 2, 1, '...', 40000, 40000, '2020-01-24', '2020-01-26', '...', 'admin'),
(11, 1, 1, '...', 6000, 6000, '2020-01-24', '2020-01-31', '...', 'admin'),
(12, 1, 1, '...', 8000, 8000, '2020-01-24', '2020-01-25', '...', 'admin'),
(13, 3, 1, '...', 90000, 90000, '2020-01-24', '2020-01-29', '...', 'admin'),
(14, 3, 1, '...', 90000, 90000, '2020-01-24', '2020-01-29', '...', 'admin'),
(15, 3, 1, '...', 90000, 90000, '2020-01-24', '2020-01-29', '...', 'admin'),
(16, 3, 1, '...', 90000, 90000, '2020-01-24', '2020-01-29', '...', 'admin'),
(17, 3, 1, '...', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(18, 3, 1, '...', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(19, 3, 1, '...', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(20, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(21, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(22, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(23, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(24, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(25, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(26, 3, 1, '01', 95000, 95000, '2020-01-24', '2020-01-30', '...', 'admin'),
(27, 3, 1, 'mode', 20000, 20000, '2020-01-24', '2020-01-31', '...', ''),
(28, 3, 1, 'mode', 20000, 20000, '2020-01-24', '2020-01-31', '...', ''),
(29, 3, 1, 'mode', 20000, 20000, '2020-01-24', '2020-01-31', '...', ''),
(30, 3, 1, 'mode', 5000, 5000, '2020-01-24', '2020-01-31', '...', 'admin');

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
-- Structure de la table `details_entree`
--

DROP TABLE IF EXISTS `details_entree`;
CREATE TABLE IF NOT EXISTS `details_entree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entree` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `libelle` varchar(25) NOT NULL,
  `qte` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `pt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_entree`
--

INSERT INTO `details_entree` (`id`, `id_entree`, `id_cat`, `libelle`, `qte`, `pu`, `pt`) VALUES
(1, 1, 1, 'Chemise enfant', 10, 20000, 200000),
(2, 2, 1, 'Chemise enfant', 1, 20000, 20000);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_recette`
--

INSERT INTO `details_recette` (`id`, `id_recette`, `id_cat`, `libelle`, `qte`, `pu`, `pt`) VALUES
(1, 1, 1, 'Chemise enfant', 1, 20000, 20000),
(2, 2, 1, 'Chemise enfant', 1, 20000, 20000);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

DROP TABLE IF EXISTS `entree`;
CREATE TABLE IF NOT EXISTS `entree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) DEFAULT NULL,
  `avance` int(11) NOT NULL,
  `date_entree` date DEFAULT NULL,
  `heure_entree` time NOT NULL,
  `mois_entree` varchar(25) NOT NULL,
  `annee_entree` year(4) NOT NULL,
  `caissiere` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`id`, `montant`, `avance`, `date_entree`, `heure_entree`, `mois_entree`, `annee_entree`, `caissiere`) VALUES
(1, 200000, 200000, '2020-01-13', '14:34:44', 'janvier', 2020, 'admin'),
(2, 20000, 20000, '2020-01-14', '10:31:19', 'janvier', 2020, 'admin');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `type_genre` varchar(25) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

DROP TABLE IF EXISTS `mesures`;
CREATE TABLE IF NOT EXISTS `mesures` (
  `id_mesures` int(11) NOT NULL AUTO_INCREMENT,
  `id_cmd` int(11) NOT NULL,
  `epaule` float DEFAULT NULL,
  `poitrine` float DEFAULT NULL,
  `ventre` float DEFAULT NULL,
  `bassin` float DEFAULT NULL,
  `ceinture` float DEFAULT NULL,
  `cuisse` float DEFAULT NULL,
  `bas_pied` float DEFAULT NULL,
  `longueur_manche` float DEFAULT NULL,
  `tour_manche` float DEFAULT NULL,
  `tour_poignet` float DEFAULT NULL,
  `tour_taille` float DEFAULT NULL,
  `col` float DEFAULT NULL,
  `contour_tete` float DEFAULT NULL,
  `longueur_chemise` float DEFAULT NULL,
  `longueur_pantalon` float DEFAULT NULL,
  `sens_seins` float DEFAULT NULL,
  `pince` float DEFAULT NULL,
  `longueur_haut` float DEFAULT NULL,
  `longueur_juppe` float DEFAULT NULL,
  `longueur_robe` float DEFAULT NULL,
  `longueur_culotte` float DEFAULT NULL,
  `longueur_fente` float DEFAULT NULL,
  `id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_mesures`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mesures`
--

INSERT INTO `mesures` (`id_mesures`, `id_cmd`, `epaule`, `poitrine`, `ventre`, `bassin`, `ceinture`, `cuisse`, `bas_pied`, `longueur_manche`, `tour_manche`, `tour_poignet`, `tour_taille`, `col`, `contour_tete`, `longueur_chemise`, `longueur_pantalon`, `sens_seins`, `pince`, `longueur_haut`, `longueur_juppe`, `longueur_robe`, `longueur_culotte`, `longueur_fente`, `id_genre`) VALUES
(1, 26, 10, 3, 6, 7, 6, 6, 8, 3, 7, 2, 8, 10, 3, 2, 4, 3, 20, 6, 6, 87, 4, 35, 1),
(2, 27, 2, 3, 6, 7, 6, 6, 8, 3, 7, 2, 8, 1, 3, 2, 4, 3, 20, 6, 6, 87, 4, 35, 1),
(3, 28, 2, 3, 6, 7, 6, 6, 8, 3, 7, 2, 8, 1, 3, 2, 4, 3, 20, 6, 6, 87, 4, 35, 1),
(4, 29, 2, 3, 6, 7, 6, 6, 8, 3, 7, 2, 8, 1, 3, 2, 4, 3, 20, 6, 6, 87, 4, 35, 1),
(5, 30, 10, 3, 6, 7, 6, 6, 8, 3, 1, 2, 8, 10, 3, 2, 4, 3, 20, 6, 6, 87, 4, 35, 1);

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
  `mvt` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

DROP TABLE IF EXISTS `production`;
CREATE TABLE IF NOT EXISTS `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pdt` int(11) NOT NULL,
  `qnte_init` int(11) DEFAULT '0',
  `qnte_ent` int(11) DEFAULT '0',
  `qnte_vend` int(11) DEFAULT '0',
  `qnte_rest` int(11) DEFAULT '0',
  `prix_uni` int(11) NOT NULL,
  `prix_tot` int(11) NOT NULL DEFAULT '0',
  `id_cat` int(11) NOT NULL,
  `date_production` date NOT NULL,
  `mois_production` varchar(20) NOT NULL,
  `an_production` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `production`
--

INSERT INTO `production` (`id`, `id_pdt`, `qnte_init`, `qnte_ent`, `qnte_vend`, `qnte_rest`, `prix_uni`, `prix_tot`, `id_cat`, `date_production`, `mois_production`, `an_production`, `user`) VALUES
(1, 2, 36, 0, 3, 33, 25000, 75000, 1, '2020-01-14', 'janvier', 2020, 'admin'),
(2, 1, 14, 0, 2, 12, 20000, 40000, 1, '2020-01-14', 'janvier', 2020, 'admin'),
(3, 2, 33, 0, 1, 32, 25000, 25000, 1, '2020-01-14', 'janvier', 2020, 'admin'),
(4, 1, 12, 0, 1, 11, 20000, 20000, 1, '2020-01-14', 'janvier', 2020, 'admin'),
(5, 3, 0, 10, 0, 10, 1500, 15000, 2, '2020-01-14', 'janvier', 2020, 'admin'),
(7, 3, 10, 0, 2, 8, 1500, 3000, 2, '2020-01-14', 'janvier', 2020, 'admin'),
(8, 2, 32, 0, 1, 31, 25000, 25000, 1, '2020-01-15', 'janvier', 2020, 'admin'),
(9, 1, 11, 0, 1, 10, 20000, 20000, 1, '2020-01-17', 'janvier', 2020, 'admin'),
(10, 1, 10, 1, 0, 11, 20000, 20000, 1, '2020-01-17', 'janvier', 2020, 'admin'),
(14, 1, 10, 0, 2, 8, 20000, 40000, 1, '2020-01-19', 'janvier', 2020, 'admin'),
(13, 2, 30, 0, 1, 29, 25000, 25000, 1, '2020-01-19', 'janvier', 2020, 'admin'),
(15, 3, 8, 0, 4, 4, 1500, 6000, 2, '2020-01-19', 'janvier', 2020, 'admin'),
(24, 2, 25, 0, 1, 24, 25000, 25000, 1, '2020-01-20', 'janvier', 2020, 'admin'),
(23, 1, 10, 0, 2, 6, 20000, 40000, 1, '2020-01-19', 'janvier', 2020, 'admin'),
(22, 2, 30, 0, 4, 25, 25000, 100000, 1, '2020-01-19', 'janvier', 2020, 'admin'),
(21, 3, 8, 0, 2, 2, 1500, 3000, 2, '2020-01-19', 'janvier', 2020, 'admin'),
(25, 1, 7, 1, 0, 8, 20000, 20000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(26, 3, 2, 3, 0, 5, 1500, 4500, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(27, 4, 0, 2, 0, 2, 5000, 10000, 3, '2020-01-24', 'janvier', 2020, 'admin'),
(28, 4, 0, 1, 0, 3, 5000, 5000, 3, '2020-01-24', 'janvier', 2020, 'admin'),
(29, 1, 7, 2, 0, 10, 20000, 40000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(30, 1, 7, 0, 1, 9, 20000, 20000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(31, 3, 2, 8, 0, 13, 1500, 12000, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(32, 1, 7, 0, 1, 8, 20000, 160000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(33, 3, 2, 0, 1, 12, 1500, 18000, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(34, 3, 2, 0, 1, 12, 1500, 18000, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(35, 3, 2, 0, 1, 11, 1500, 16500, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(36, 3, 2, 0, 1, 11, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(37, 3, 2, 0, 1, 10, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(38, 3, 2, 0, 1, 9, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(39, 3, 2, 0, 1, 9, 1500, 13500, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(40, 3, 2, 0, 1, 9, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(41, 3, 2, 0, 1, 9, 1500, 13500, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(42, 3, 2, 0, 1, 8, 1500, 12000, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(43, 3, 2, 0, 1, 8, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(44, 3, 2, 0, 1, 8, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(45, 3, 2, 0, 1, 8, 1500, 0, 2, '2020-01-24', 'janvier', 2020, 'admin'),
(46, 2, 22, 0, 1, 21, 25000, 0, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(47, 4, 0, 0, 1, 2, 5000, 0, 3, '2020-01-24', 'janvier', 2020, 'admin'),
(48, 4, 0, 0, 1, 2, 5000, 0, 3, '2020-01-24', 'janvier', 2020, 'admin'),
(49, 1, 7, 0, 2, 6, 20000, 0, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(50, 2, 22, 0, 1, 19, 25000, 475000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(51, 2, 22, 0, 2, 17, 25000, 425000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(52, 1, 7, 0, 1, 5, 20000, 100000, 1, '2020-01-24', 'janvier', 2020, 'admin'),
(53, 4, 0, 10, 0, 12, 5000, 60000, 3, '2020-01-24', 'janvier', 2020, 'admin'),
(54, 5, 0, 10, 0, 10, 20000, 200000, 4, '2020-01-24', 'janvier', 2020, 'admin'),
(55, 1, 5, 1, 0, 6, 20000, 120000, 1, '2020-01-29', 'janvier', 2020, 'admin'),
(56, 1, 5, 1, 0, 5, 20000, 100000, 1, '2020-01-29', 'janvier', 2020, 'admin'),
(57, 1, 5, 1, 0, 6, 20000, 120000, 1, '2020-01-31', 'janvier', 2020, 'admin'),
(58, 1, 5, 1, 0, 5, 20000, 100000, 1, '2020-01-31', 'janvier', 2020, 'admin'),
(59, 1, 5, 1, 0, 4, 20000, 80000, 1, '2020-01-31', 'janvier', 2020, 'admin'),
(60, 2, 17, 0, 1, 16, 25000, 400000, 1, '2020-01-31', 'janvier', 2020, 'admin');

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
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `fk_produits_categories_idx` (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_prod`, `description`, `id_cat`, `prix`, `stock`) VALUES
(1, 'Chemise enfant', 1, 20000, 4),
(2, 'Chemise homme', 1, 25000, 16),
(3, 'Robe', 2, 1500, 8),
(4, 'Jupe enfant', 3, 5000, 12),
(5, 'Tunique', 4, 20000, 10),
(6, 'trg', 2, 15000, 0),
(7, 'fwsdd', 2, 25000, 0);

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
  `id_client` int(11) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `avance` int(11) NOT NULL,
  `date_recette` date DEFAULT NULL,
  `heure_recette` time NOT NULL,
  `mois_recette` varchar(25) NOT NULL,
  `annee_recette` year(4) NOT NULL,
  `caissiere` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `id_client`, `montant`, `avance`, `date_recette`, `heure_recette`, `mois_recette`, `annee_recette`, `caissiere`) VALUES
(1, 1, 20000, 20000, '2020-01-14', '11:15:36', 'janvier', 2020, 'admin'),
(2, 1, 20000, 20000, '2020-01-14', '11:18:12', 'janvier', 2020, 'admin'),
(3, 1, 40000, 40000, '2020-01-14', '11:34:54', 'janvier', 2020, 'admin'),
(4, 1, 40000, 40000, '2020-01-14', '11:37:11', 'janvier', 2020, 'admin'),
(5, 1, 40000, 40000, '2020-01-14', '11:38:04', 'janvier', 2020, 'admin'),
(6, 1, 25000, 25000, '2020-01-14', '11:43:55', 'janvier', 2020, 'admin'),
(7, 1, 20000, 20000, '2020-01-14', '11:54:30', 'janvier', 2020, 'admin'),
(8, 1, 45000, 45000, '2020-01-14', '11:59:20', 'janvier', 2020, 'admin'),
(9, 1, 45000, 9, '2020-01-14', '12:00:03', 'janvier', 2020, 'admin'),
(10, 1, 45000, 14, '2020-01-14', '12:01:02', 'janvier', 2020, 'admin'),
(11, 1, 45000, 7422, '2020-01-14', '12:02:04', 'janvier', 2020, 'admin'),
(12, 1, 45000, 45000, '2020-01-14', '12:04:05', 'janvier', 2020, 'admin'),
(13, 1, 45000, 45000, '2020-01-14', '12:04:29', 'janvier', 2020, 'admin'),
(14, 1, 115000, 115000, '2020-01-14', '12:07:56', 'janvier', 2020, 'admin'),
(15, 1, 45000, 45000, '2020-01-14', '12:09:05', 'janvier', 2020, 'admin'),
(16, 1, 3000, 3000, '2020-01-14', '12:44:57', 'janvier', 2020, 'admin'),
(17, 1, 3000, 3000, '2020-01-14', '12:59:10', 'janvier', 2020, 'admin'),
(18, 1, 25000, 25000, '2020-01-15', '13:00:23', 'janvier', 2020, 'admin'),
(19, 1, 25000, 25000, '2020-01-15', '13:00:39', 'janvier', 2020, 'admin'),
(20, 1, 25000, 25000, '2020-01-15', '13:12:27', 'janvier', 2020, 'admin'),
(21, 1, 25000, 25000, '2020-01-15', '13:17:49', 'janvier', 2020, 'admin'),
(22, 1, 25000, 25000, '2020-01-15', '13:24:02', 'janvier', 2020, 'admin'),
(23, 1, 25000, 20000, '2020-01-15', '13:38:52', 'janvier', 2020, 'admin'),
(24, 1, 25000, 25000, '2020-01-15', '13:41:00', 'janvier', 2020, 'admin'),
(25, 1, 20000, 20000, '2020-01-17', '11:09:21', 'janvier', 2020, 'admin'),
(26, 2, 40000, 30000, '2020-01-19', '14:51:35', 'janvier', 2020, 'admin'),
(27, 2, 40000, 3000, '2020-01-19', '14:55:45', 'janvier', 2020, 'admin'),
(28, 2, 40000, 30000, '2020-01-19', '14:56:34', 'janvier', 2020, 'admin'),
(29, 2, 40000, 30000, '2020-01-19', '14:57:52', 'janvier', 2020, 'admin'),
(30, 2, 40000, 35000, '2020-01-19', '14:59:10', 'janvier', 2020, 'admin'),
(31, 2, 40000, 40000, '2020-01-19', '15:06:17', 'janvier', 2020, 'admin'),
(32, 2, 40000, 40000, '2020-01-19', '15:07:04', 'janvier', 2020, 'admin'),
(33, 2, 40000, 40000, '2020-01-19', '15:08:01', 'janvier', 2020, 'admin'),
(34, 2, 115000, 10000, '2020-01-19', '15:10:34', 'janvier', 2020, 'admin'),
(35, 2, 115000, 10000, '2020-01-19', '15:15:53', 'janvier', 2020, 'admin'),
(36, 2, 115000, 10000, '2020-01-19', '15:17:17', 'janvier', 2020, 'admin'),
(37, 2, 115000, 10000, '2020-01-19', '15:18:59', 'janvier', 2020, 'admin'),
(38, 2, 115000, 10000, '2020-01-19', '15:19:54', 'janvier', 2020, 'admin'),
(39, 2, 115000, 10000, '2020-01-19', '15:20:21', 'janvier', 2020, 'admin'),
(40, 2, 115000, 10000, '2020-01-19', '15:21:56', 'janvier', 2020, 'admin'),
(41, 2, 115000, 30000, '2020-01-19', '15:22:24', 'janvier', 2020, 'admin'),
(42, 2, 115000, 30000, '2020-01-19', '15:23:25', 'janvier', 2020, 'admin'),
(43, 2, 115000, 30000, '2020-01-19', '15:23:27', 'janvier', 2020, 'admin'),
(44, 2, 115000, 30000, '2020-01-19', '15:25:33', 'janvier', 2020, 'admin'),
(45, 2, 40000, 21, '2020-01-19', '15:26:05', 'janvier', 2020, 'admin'),
(46, 2, 40000, 12, '2020-01-19', '15:26:53', 'janvier', 2020, 'admin'),
(47, 2, 40000, 12, '2020-01-19', '15:27:36', 'janvier', 2020, 'admin'),
(48, 2, 40000, 40000, '2020-01-19', '15:28:34', 'janvier', 2020, 'admin'),
(49, 2, 71000, 10000, '2020-01-19', '15:30:21', 'janvier', 2020, 'admin'),
(50, 2, 71000, 10000, '2020-01-19', '15:30:50', 'janvier', 2020, 'admin'),
(51, 2, 71000, 10000, '2020-01-19', '15:31:02', 'janvier', 2020, 'admin'),
(52, 2, 98000, 60000, '2020-01-19', '15:34:19', 'janvier', 2020, 'admin'),
(53, 2, 98000, 60000, '2020-01-19', '15:35:36', 'janvier', 2020, 'admin'),
(54, 2, 98000, 60000, '2020-01-19', '15:36:42', 'janvier', 2020, 'admin'),
(55, 2, 98000, 60000, '2020-01-19', '15:37:13', 'janvier', 2020, 'admin'),
(56, 2, 98000, 30000, '2020-01-19', '15:37:32', 'janvier', 2020, 'admin'),
(57, 2, 3000, 3000, '2020-01-19', '15:39:38', 'janvier', 2020, 'admin'),
(58, 2, 3000, 3000, '2020-01-19', '15:43:00', 'janvier', 2020, 'admin'),
(59, 2, 125000, 125000, '2020-01-19', '15:43:54', 'janvier', 2020, 'admin'),
(60, 2, 125000, 125000, '2020-01-19', '15:44:13', 'janvier', 2020, 'admin'),
(61, 2, 40000, 40000, '2020-01-19', '15:45:20', 'janvier', 2020, 'admin'),
(62, 2, 40000, 40000, '2020-01-19', '15:45:53', 'janvier', 2020, 'admin'),
(63, 2, 125000, 125000, '2020-01-19', '15:47:19', 'janvier', 2020, 'admin'),
(64, 2, 1500, 1500, '2020-01-19', '15:48:04', 'janvier', 2020, 'admin'),
(65, 2, 186500, 186500, '2020-01-19', '15:50:00', 'janvier', 2020, 'admin'),
(66, 2, 186500, 186500, '2020-01-19', '15:50:32', 'janvier', 2020, 'admin'),
(67, 2, 186500, 186500, '2020-01-19', '15:51:33', 'janvier', 2020, 'admin'),
(68, 2, 186500, 186500, '2020-01-19', '15:52:34', 'janvier', 2020, 'admin'),
(69, 2, 143000, 143000, '2020-01-19', '15:56:01', 'janvier', 2020, 'admin'),
(70, 2, 25000, 25000, '2020-01-20', '10:35:01', 'janvier', 2020, 'admin'),
(71, 2, 20000, 20000, '2020-01-24', '17:07:17', 'janvier', 2020, 'admin'),
(72, 3, 20000, 20000, '2020-01-24', '18:00:17', 'janvier', 2020, 'admin'),
(73, 3, 26500, 26500, '2020-01-24', '18:01:42', 'janvier', 2020, 'admin'),
(74, 3, 26500, 26500, '2020-01-24', '18:02:20', 'janvier', 2020, 'admin'),
(75, 2, 26500, 26500, '2020-01-24', '18:02:36', 'janvier', 2020, 'admin'),
(76, 2, 26500, 26500, '2020-01-24', '18:03:17', 'janvier', 2020, 'admin'),
(77, 2, 26500, 26500, '2020-01-24', '18:03:35', 'janvier', 2020, 'admin'),
(78, 2, 26500, 26500, '2020-01-24', '18:05:45', 'janvier', 2020, 'admin'),
(79, 2, 26500, 26500, '2020-01-24', '18:06:06', 'janvier', 2020, 'admin'),
(80, 2, 26500, 26500, '2020-01-24', '18:06:17', 'janvier', 2020, 'admin'),
(81, 2, 26500, 26500, '2020-01-24', '18:06:50', 'janvier', 2020, 'admin'),
(82, 2, 26500, 26500, '2020-01-24', '18:07:53', 'janvier', 2020, 'admin'),
(83, 2, 26500, 26500, '2020-01-24', '18:08:33', 'janvier', 2020, 'admin'),
(84, 2, 26500, 26500, '2020-01-24', '18:09:06', 'janvier', 2020, 'admin'),
(85, 2, 26500, 26500, '2020-01-24', '18:09:50', 'janvier', 2020, 'admin'),
(86, 2, 26500, 26500, '2020-01-24', '18:10:27', 'janvier', 2020, 'admin'),
(87, 2, 26500, 26500, '2020-01-24', '18:11:00', 'janvier', 2020, 'admin'),
(88, 2, 26500, 26500, '2020-01-24', '18:13:00', 'janvier', 2020, 'admin'),
(89, 2, 26500, 26500, '2020-01-24', '18:14:17', 'janvier', 2020, 'admin'),
(90, 2, 26500, 20000, '2020-01-24', '18:15:04', 'janvier', 2020, 'admin'),
(91, 2, 26500, 20000, '2020-01-24', '18:15:12', 'janvier', 2020, 'admin'),
(92, 2, 26500, 20000, '2020-01-24', '18:15:16', 'janvier', 2020, 'admin'),
(93, 2, 26500, 25000, '2020-01-24', '18:15:41', 'janvier', 2020, 'admin'),
(94, 2, 26500, 25000, '2020-01-24', '18:17:24', 'janvier', 2020, 'admin'),
(95, 2, 26500, 25000, '2020-01-24', '18:17:58', 'janvier', 2020, 'admin'),
(96, 2, 26500, 25000, '2020-01-24', '18:18:23', 'janvier', 2020, 'admin'),
(97, 2, 26500, 25000, '2020-01-24', '18:19:58', 'janvier', 2020, 'admin'),
(98, 2, 26500, 25000, '2020-01-24', '18:20:55', 'janvier', 2020, 'admin'),
(99, 2, 26500, 25000, '2020-01-24', '18:21:35', 'janvier', 2020, 'admin'),
(100, 2, 26500, 25000, '2020-01-24', '18:23:17', 'janvier', 2020, 'admin'),
(101, 2, 26500, 25000, '2020-01-24', '18:24:27', 'janvier', 2020, 'admin'),
(102, 2, 26500, 25000, '2020-01-24', '18:24:58', 'janvier', 2020, 'admin'),
(103, 2, 26500, 25000, '2020-01-24', '18:25:18', 'janvier', 2020, 'admin'),
(104, 2, 26500, 25000, '2020-01-24', '18:25:50', 'janvier', 2020, 'admin'),
(105, 2, 26500, 25000, '2020-01-24', '18:26:16', 'janvier', 2020, 'admin'),
(106, 2, 26500, 25000, '2020-01-24', '18:27:10', 'janvier', 2020, 'admin'),
(107, 2, 26500, 25000, '2020-01-24', '18:27:24', 'janvier', 2020, 'admin'),
(108, 2, 26500, 25000, '2020-01-24', '18:28:03', 'janvier', 2020, 'admin'),
(109, 2, 26500, 25000, '2020-01-24', '18:29:37', 'janvier', 2020, 'admin'),
(110, 2, 26500, 25000, '2020-01-24', '18:30:11', 'janvier', 2020, 'admin'),
(111, 2, 26500, 25000, '2020-01-24', '18:31:37', 'janvier', 2020, 'admin'),
(112, 2, 26500, 25000, '2020-01-24', '18:32:15', 'janvier', 2020, 'admin'),
(113, 2, 26500, 25000, '2020-01-24', '18:33:06', 'janvier', 2020, 'admin'),
(114, 2, 26500, 25000, '2020-01-24', '18:33:21', 'janvier', 2020, 'admin'),
(115, 2, 45000, 45000, '2020-01-24', '18:37:18', 'janvier', 2020, 'admin'),
(116, 2, 45000, 45000, '2020-01-24', '18:38:01', 'janvier', 2020, 'admin'),
(117, 1, 25000, 25000, '2020-01-24', '18:39:38', 'janvier', 2020, 'admin'),
(118, 1, 25000, 25000, '2020-01-24', '18:40:21', 'janvier', 2020, 'admin'),
(119, 2, 25000, 25000, '2020-01-24', '18:42:45', 'janvier', 2020, 'admin'),
(120, 2, 70000, 70000, '2020-01-24', '18:44:04', 'janvier', 2020, 'admin');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `login`, `password`, `type`) VALUES
(1, 'admin', '0000', 'admin'),
(2, 'user', '1234', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
