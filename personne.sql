
--
-- Structure de la table `personne`
--
DROP TABLE IF EXISTS `personne`;

CREATE TABLE IF NOT EXISTS `personne` (
`idP` int(11)  PRIMARY KEY AUTO_INCREMENT NOT NULL ,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateN` date NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL
);

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`idP`, `nom`, `prenom`, `dateN`, `telephone`, `adresse`) VALUES
(1, 'Devignes', 'Michel','1976-03-01','06 01 13 01 01','28 Rue Alain, 14000 Caen'),
(2, 'Chambeaux', 'Jean-Marc','1972-12-01','06 01 01 01 01','14000 Caen'),
(3, 'Bernard', 'Jean-Luc','1972-03-21','07 01 10 01 01','80000 Amiens'),
(4, 'Lefevre', 'François','1975-03-11','02 31 23 45 19','Paris');

