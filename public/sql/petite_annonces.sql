-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 avr. 2021 à 12:20
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petite_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(225) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`id_admin`, `email_admin`, `password_admin`) VALUES
(1, 'admin@admin.com', 'admin'),
(11, 'michael@admin.it', 'theAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `nom_annonce` varchar(225) NOT NULL,
  `description_annonce` text NOT NULL,
  `prix_annonce` decimal(10,0) NOT NULL,
  `photo_annonce` varchar(255) NOT NULL,
  `date_depot` datetime NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `regions_id` int(11) NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `Id de la catégorie` (`categorie_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `regions_id` (`regions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES
(10, 'Micro Ondes', 'Bonjour, je vend se micro-ondes grill Samsung blanc. bon etat', '4125', '../public/img/microonde.jpg', '2021-03-29 00:00:00', 2, 1, 13),
(11, 'Livre la Cabane Magique', 'Livre de la collections la cabane magique', '125', '../public/img/cabane.jpg', '2021-03-31 00:00:00', 8, 1, 13),
(13, 'Tableau de la Marine', 'Reproduction marine catalogne.\r\n44 x 34 cm', '1425', '../public/img/tableau.jpg', '2021-03-29 00:00:00', 9, 1, 13),
(14, 'Canari', 'Test des dernier element', '1245', '../public/img/carbu.jpg', '2021-03-31 00:00:00', 6, 1, 13),
(15, 'Toyota Yaris', 'Voiture de bonne facture', '2536', '../public/img/voit.jpg', '2021-03-31 00:00:00', 4, 1, 13),
(19, 'Ampli Guitare', 'Ampli famé série\r\nModèle 15\r\nOccasion', '745', '../public/img/ampli.jpg', '2021-03-31 00:00:00', 6, 1, 13),
(23, 'Carburateur auto', '1 carburateur complet dimension diamètre intérieur côté filtre à air 35 mm côté moteur dimensions à l\'intérieur 27 mm 5 € n\'est pas le prix faire offre merci', '745', '../public/img/carbu.jpg', '2021-03-31 00:00:00', 4, 1, 13),
(24, 'Bureau enfant', 'Petit bureau fille\r\nIdéal petite fille pour l\'intérieur comme pour l\'extérieur', '7452', '../public/img/buro.jpg', '2021-03-31 00:00:00', 6, 1, 13),
(25, 'Citoen C4', 'véhicule vendu avec contrôle technique courroie de distribution à jour kit complet disque d\'embrayage okvéhicule vendu avec aucun frais à prévoir juste nouveau chauffeur0749165372', '7452', '../public/img/c4.jpg', '2021-03-31 00:00:00', 4, 1, 13),
(26, 'Moto Yahama', 'Votre spécialiste de l\'occasion DYNAMIC MOTO à Andance vous propose aujourd\'hui une YAMAHA 1300 XJR de Mai 1999 totalisant 78664 kms au prix de 3290 €*.\r\n\r\nCette moto est à jour de ses entretiens et de tout consommables, elle sort de notre atelier et est prête à rouler.\r\n(Installation de durites aviation, entretien annuel, purges des freins, remplacement embrayage à 72000 kms,...)', '4512', '../public/img/moto.jpg', '2021-03-31 00:00:00', 4, 1, 13),
(27, 'Vélo', 'VTT bon état 26 vitesses', '122', '../public/img/velo.jpg', '2021-03-24 07:50:07', 1, 1, 13),
(28, 'Galaxy S5', 'Bonjour je met en vente un magnifique Galaxy Note 20, en 256go. Il es en excellent état. Vendu avec sa boîte et ses accessoires d\'origine.', '125', '../public/img/d5.jpg', '2021-04-01 00:00:00', 1, 2, 12),
(29, 'Location Maison', 'Appartement - 4 personnes - 3 pièces - 2 chambres - 97 m²\r\nTélévision - Terrasse - Vue montagne - place de parking en extérieur . . .\r\n\r\nCet appartement, situé à Morne-à-l\'Eau, est idéal pour 4 personnes. Vous aurez à votre disposition 2 chambres et une terrasse aménagée.\r\nSon salon offre un cadre parfait pour se détendre après une journée passée à découvrir la région. Installez-vous dans le canapé pour lire un bon livre ou profitez des équipements mis à votre disposition, comme une radio.', '45125', '../public/img/maison.jpg', '2021-04-01 00:00:00', 6, 2, 12),
(30, 'Chariot', 'Petit chariot de manutention', '1414', '../public/img/chariot.jpg', '2021-04-01 00:00:00', 4, 2, 12),
(31, 'Celica', 'Toyota celica 1800000 KM pas cher\r\n\r\n', '2544', '../public/img/voiture.jpg', '2021-04-01 00:00:00', 4, 3, 11),
(32, 'Pied de table', 'Suite au changement des pieds de nos tables, nous vendons les anciens groupés ou en individuel.\r\nEn acier, pieds en plastique.\r\nPas de livraison, à venir récupérer sur place.\r\n30€ l\'unité.', '30', '../public/img/pied.jpg', '2021-04-01 00:00:00', 3, 3, 11),
(33, 'Coupe de fruit', 'Coupe de fruit avec pied. hauteur totale 20cm, diamètre 22cm profondeur en contenance 12cm. Prix 8€ pas d\'envoi, remit en mains propres', '20', '../public/img/coupe.jpg', '2021-04-01 00:00:00', 6, 3, 11),
(34, 'Plaque de cuisson', '/!\\ DESTOCKAGE Plaque vitrocéramique 3 foyers CANDY CH63CT /!\\\r\n\r\n-Modèle d\'exposition-\r\n\r\nRéférence : 80171007\r\n\r\nInformations techniques disponibles dans les photos\r\n\r\nPrix initial : 259€\r\nPrix destockage*: 179€\r\n\r\n*Offre valable uniquement sur le site Leboncoin Leroy Merlin Amiens\r\n\r\nMe contacter par e-mail à l\'adresse suivante : cedrine.delacourt@leroymerlin.fr', '2000', '../public/img/plaque.jpg', '2021-04-01 00:00:00', 2, 4, 2),
(35, 'Meuble TC', 'Vend meuble TV en très bonne état. 1.8m sur 40cm', '412', '../public/img/tv.jpg', '2021-04-01 00:00:00', 3, 4, 2),
(36, 'Collection Marcel Pagnol', 'Marcel PAGNOL. 4 volumes. Editions Pastorelly.\r\nLa femme du boulanger....Le premier amour.....Manon des sources....Jean De Florette....\r\nPrix: 12 Euros.\r\nPour tout contact: Tel: 07 50 36 36 46.\r\nCordialement Christian.', '25', '../public/img/livre.jpg', '2021-04-01 00:00:00', 6, 4, 2),
(37, 'Location Perigeurx', 'Situés à 2,5Km du centre ville de Périgueux, dans un corps de ferme entièrement rénové, implantés sur une colline boisée à proximité du Val d\'Atur, nous mettons à disposition:\r\n- Un gîte de 54 M2.\r\nAu R.D.C. une pièce à vivre confortablement équipée, une salle de bain, WC et réduit de rangement. A l\'étage, une chambre équipée d\'un lit de 140 et une chambre équipée de 3 lits de 90 avec dressing. WIFI disponible.\r\nGarage pour 1 voiture , jardin privatif et accessoires de détente.\r\n450€/semaine ', '450', '../public/img/gite.jpg', '2021-04-01 00:00:00', 8, 5, 10),
(38, 'Sac bande', 'Vend sac bandoulière noir marque Armani Jeans, original et neuf avec étiquette, à 80 euros.\r\nPas de livraison.\r\nÀ venir récupérer sur place à Saint Denis centre ville.', '74', '../public/img/armani.jpg', '2021-04-01 00:00:00', 5, 5, 10),
(39, 'Poisson Japon', 'A vendre a contre cœur carme koï noir et orange 54cm et 17 cm de hauteur les mesure sont à peu près .\r\nAvant achat j aimerais avoir des photo de votre bassin si je la vend c pour qu\'elle trouve un plus grand bassin que le mien.', '741', '../public/img/poisson.jpg', '2021-04-01 00:00:00', 6, 5, 10),
(40, 'Velo Homme', 'Vélo homme cyclotourisme de marque Motobécane, gris argent en bon état, avec 2 pneus et chambre à air neuves.\r\nTaille L (je fais 1,78m)\r\nA prendre sur Bois Colombes 92270\r\n\r\nPour VOIR les autres objets que je VENDS, taper dans la page d’accueil d’offre :\r\nCTAMOY\r\nrubriques : toutes catégories', '1425', '../public/img/velohomme.jpg', '2021-04-01 00:00:00', 4, 6, 1),
(41, 'Boummoire Tefal', 'Bouilloire Tefal Uno neuve fermée\r\nJamais utilisée, carton jamais ouvert.\r\n\r\nPrix magasin : 30 euros', '30', '../public/img/tefal.jpg', '2021-04-01 00:00:00', 2, 6, 1),
(42, 'Bétonnière', 'Je donne une bétonnière, grosse contenance. Utilisée quelques fois il y a plusieurs années mais je ne peux pas garantir son fonctionnement. A venir chercher.\r\nPremier contact par mail, merci.', '0', '../public/img/beton.jpg', '2021-04-01 00:00:00', 6, 6, 1),
(43, 'Matériel Piscine', 'Enrouleur tuyau et divers produits possibilité de détailler,liste en PJ', '125', '../public/img/piscine.jpg', '2021-04-01 00:00:00', 7, 7, 3),
(44, 'Blouse enfant', 'blouse enfant 10 ans en coton', '15', '../public/img/blouse.jpg', '2021-04-01 00:00:00', 5, 7, 3),
(45, 'Tableau Maison', 'Tableau peint par moi-même', '15', '../public/img/tazb1.jpg', '2021-04-01 00:00:00', 9, 7, 3),
(46, 'Tableau Venise', 'Tableau peinture Venise.\r\nD\'autres tableaux à vendre prendre contact', '45', '../public/img/tab2.jpg', '2021-04-01 00:00:00', 9, 8, 4),
(47, 'Panier Superette', 'Ancien panier vintage en plastique rouge avec anse basculante typique des anciens paniers supérettes Prisunic\r\nDim. 43,5 cm x 29 cm x 29 cm', '45', '../public/img/panier.jpg', '2021-04-01 00:00:00', 6, 8, 4),
(48, 'Briques de jardin', 'Vends plusieurs m2 de briquettes de parement de couleur rouge très jolie et de très haut de gamme à poser avec ou sans joints paquet de 0,52 m2 soit 2 boites pour + 1m2 à 15e idéal grand mur intérieur, loft, maison à louer etc..1er arrivé 1er servi', '15', '../public/img/brique.jpg', '2021-04-01 00:00:00', 7, 8, 4),
(49, 'Jean Levis 501', 'Vend Jeans LEVI STRAUSS Bleu foncé neuf\r\njamais porté Taille W28 L32\r\nAcheté 119 Euros vendu 80 €', '125', '../public/img/jean.jpg', '2021-04-01 00:00:00', 5, 9, 5),
(50, 'I-phone 4', 'Iphone 4 en bonne état batterie a changer mais fonctionne quand même', '15', '../public/img/iphone.jpg', '2021-04-01 00:00:00', 1, 9, 5),
(51, 'Table de Jardin', 'Salon de jardin avec rallonge, de longueur 260 /93 de large. Idéal en période de Covid pour manger éloigné. Livré avec 8 chaises. Je peux livrer en fonction du lieu.', '745', '../public/img/jarfijkfr.jpg', '2021-04-01 00:00:00', 7, 9, 5),
(52, 'Selection de livres', 'Je vends 21 livres de la Sélection du Livre (grand format) en parfait état = 2 Euros pièce ou 40 Euros le tout\r\nChaque livre comporte 4 titres\r\nMes autres listes en tapant \"babelou\"\r\nEnvoi possible à vos frais\r\nPossibilité de retirer les jaquettes pour un très bel effet en vitrine ou étagère', '25', '../public/img/book.jpg', '2021-04-01 00:00:00', 8, 10, 6),
(53, 'Brosse et miroir', 'Brosse, miroir et peigne\r\n\r\nEtat neuf / avec boîte', '255', '../public/img/brosse.jpg', '2021-04-01 00:00:00', 5, 10, 6),
(54, 'Canapé cuir', 'CANAPE 3 places fixes . Mobilier de France.\r\n\r\nVachette fleur\r\nCouleur moka\r\n\r\nDimensions L189 h 98 P87\r\nToujours très bien entretenu . Parfait état', '501', '../public/img/canap.jpg', '2021-04-01 00:00:00', 3, 10, 6),
(55, 'Casque Moto', 'casque moto trés bon état, de marque SHOE.\r\ntaille 53 cm\r\n1er contact par mail', '74125', '../public/img/Casque.jpg', '2021-04-01 00:00:00', 4, 11, 7),
(56, 'Chaussure de Ski', 'Chaussures ski de randonnée Scarpa F1 Evo en 28/28.5 = 314 mm\r\n\r\nUtilisées 4 saisons (environ 30 sorties), chaussons en bon état, pas de détérioration, possibilité d\'envoi en France (environ 6.30€ via Mondial Relay).', '412', '../public/img/ski.jpg', '2021-04-01 00:00:00', 8, 11, 7),
(57, 'Monopoly Simpson', 'Bonjour vends Monopoly Simpson complet !!\r\n25€ prix ferme ce Monopoly n’est plus produit donc rare il se vends minimum 40€ d’occasion', '4512', '../public/img/mono.jpg', '2021-04-01 00:00:00', 8, 11, 7),
(58, 'I-Phone XS', 'À vendre iPhone XS Rose Gold 64go première main desimlocké tout opérateur dans sa boîte d’origine avec tous ses accessoires\r\nAucun défaut, rayure ou autre à signaler\r\nÉtat batterie : 82%\r\nAcheté neuf chez Orange en 12/2018 (facture à l’appui) il ne s’agit pas d’un téléphone reconditionné\r\nUne coque transparente arrière quasiment neuve sera fournie lors de la vente\r\nVisible sur Marcheprime ou Saint Médard en Jalles.\r\nRemise en main propre exclusivement dans le respect des gestes barrières.', '31425', '../public/img/iphone.jpg', '2021-04-01 00:00:00', 1, 12, 8),
(59, 'Lot de 31 couteaux suisse', 'Lot de 31 couteaux multifonctions 20 grands de différentes tailles et 11 petits certains en porte clés ,beaucoup sont neuves et indique rostfrei,50€ frais d’envoi à ma charge par mondial relay uniquement car assez lourd', '79', '../public/img/couteau.jpg', '2021-04-01 00:00:00', 6, 12, 8),
(60, 'Rollers Adulte', 'Rollers de marque FILA. Modèle Dynamic Flex.\r\nRoues 76mm /78A. Très confortables.\r\nSerrage par velcro et boucle micrométrique.\r\nFrein au pied droit\r\nPointure 46 (11.5 GB. 12.5 US).\r\nJe donne avec les rollers les protections genoux et coudes', '632', '../public/img/roller.jpg', '2021-04-01 00:00:00', 4, 12, 8),
(61, 'Ancienne Carte postale', 'SALMIECH\r\nAVEYRON\r\nTimbrée et écrite 1950', '2', '../public/img/carte.jpg', '2021-04-01 00:00:00', 9, 13, 9),
(62, 'Cocotte cuisson', 'Cocotte en fonte émaillée marque Beka\r\nTrès bon état, peu servit.\r\n\r\nIdéal pour des mets savoureux mijotés à l ancienne.\r\nConvient à tous type de chaleur y compris induction\r\n\r\n30 cm de diamètre\r\n5,2Litres\r\n\r\nSeul bémol l une des poignées est cassée, elle peu sans doute se re coller, je la met avec .\r\n\r\nPas d envoi, merci.', '225', '../public/img/cocote.jpg', '2021-04-01 00:00:00', 6, 13, 9),
(63, 'Cartouche Encre', 'HP CF280XC\r\nà rendement élevé\r\nNOIR\r\noriginale - LaserJet\r\ncartouche de toner (consommables d\'impression) (CF280XC)\r\npour LaserJet Pro 400 M401. MFP M425\r\n\r\nJe n\'ai plus cette imprimante', '525', '../public/img/cartouche.jpg', '2021-04-01 00:00:00', 1, 13, 9),
(64, 'Table Basse', 'Table basse blanche\r\nEnviron 85cm de long\r\n55cm de large\r\nHauteur 55cm', '440', '../public/img/table.jpg', '2021-04-01 00:00:00', 3, 14, 2),
(65, 'Bled Anglais', 'Bled anglais très bon état', '152', '../public/img/bookkssss.jpg', '2021-04-01 00:00:00', 8, 14, 12),
(66, 'Escabeau', 'Escabeau 5 marches', '100', '../public/img/eskabo.jpg', '2021-04-01 00:00:00', 7, 14, 3),
(67, 'Fiat 500 II', 'A vendre très belle FIAT 500 II (2) C 1.2 8V 69cv version LOUNGE d\'Avril 2018 totalisant 30.865km.\r\nNoir métallisé, intérieur cuir et tissus gris / blanc\r\nretour de leasing, sort de révision Fiat, double des clés TRES BON ÉTAT\r\nCrit\'Air 1 pour 115g/km de CO2, 4cv fiscaux\r\n\r\nGARANTIE 3 MOIS (extension possible jusqu\'à 60 mois)', '7853', '../public/img/fiat.jpg', '2021-04-01 00:00:00', 4, 15, 4),
(68, 'Robe Rouge', 'Robe rouge , état satisfaisant', '742', '../public/img/roberouge.jpg', '2021-04-01 00:00:00', 5, 15, 8),
(69, 'Petite robe noire', 'Petit robe the kooples', '100', '../public/img/robe noire.jpg', '2021-04-01 00:00:00', 5, 15, 6),
(77, 'Lego', 'Boite de légo complete', '451', '../public/img/lego.jpg', '2021-04-02 00:00:00', 8, 1, 13),
(78, 'retest', 'fefe', '4545', '../public/img/logo.png', '2021-04-02 00:00:00', 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `type_categorie`) VALUES
(1, 'Multimedias'),
(2, 'Electro-menager'),
(3, 'Meubles'),
(4, 'Véhicules'),
(5, 'Modes'),
(6, 'Divers'),
(7, 'Jardin'),
(8, 'Loisir'),
(9, 'Arts'),
(10, 'Jeux Vidéo'),
(11, 'Vacances'),
(12, 'Livres');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_regions` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) NOT NULL,
  PRIMARY KEY (`id_regions`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_regions`, `nom_region`) VALUES
(1, 'grand_est'),
(2, 'aquitaine'),
(3, 'ra_auvergne'),
(4, 'normandie'),
(5, 'bourgogne_fc'),
(6, 'bretagne'),
(7, 'centre'),
(8, 'corse'),
(9, 'ile_france'),
(10, 'occitanie'),
(11, 'haut_france'),
(12, 'pays_loire'),
(13, 'paca'),
(14, 'Réunion');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES
(1, '06 02 15 12 45', 'robert@ventetruc.fr', 'robert'),
(2, '04 12 45 36 21', 'laura@vendeuse.com', '123456'),
(3, '02 15 45 96 32', 'bob@brico.com', 'azerty'),
(4, '02 14 58 69 65', 'tony@aquitaine.com', '789'),
(5, '03 12 45 48 47', 'sophie@cool.fr', 'aszd'),
(6, '04 14 25 36 36', 'helene@laposte.net', 'laposte'),
(7, '01 25 36 35 36', 'laurent@hotmail.fr', 'laurent'),
(8, '07 14 25 36 25', 'james@cool.fr', 'james'),
(9, '06 25 35 32 32', 'matilde@jojo.fr', 'jojo'),
(10, '04 25 36 36 85', 'benoit@ventetruc.fr', 'robert'),
(11, '04 14 25 36 39', 'aline@vendeuse.com', '123456'),
(12, '08 25 25 36 36', 'marc@brico.com', 'azerty'),
(13, '09 25 14 36 25', 'gerard@aquitaine.com', '789'),
(14, '07 41 52 36 98', 'natasha@cool.fr', 'aszd'),
(15, '05 32 14 25 26', 'milene@laposte.net', 'laposte'),
(16, '08 25 24 14 47', 'bernard@hotmail.fr', 'laurent'),
(17, '03 25 21 24 25', 'thiery@cool.fr', 'james'),
(18, '06 35 32 32 14', 'celine@jojo.fr', 'jojo');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `annonces_ibfk_3` FOREIGN KEY (`regions_id`) REFERENCES `regions` (`id_regions`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
