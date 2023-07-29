
DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` varchar(10) NOT NULL,
  `nom_classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ;


DROP TABLE IF EXISTS `coefficients`;
CREATE TABLE IF NOT EXISTS `coefficients` (
  `id` varchar(10) NOT NULL,
  `classe_id` varchar(10) NOT NULL,
  `matiere_id` varchar(10) NOT NULL,
  `coeff` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matiere_id` (`matiere_id`),
  KEY `classe_id` (`classe_id`)
) ;


DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` varchar(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id`)
) ;


DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `id` varchar(10) NOT NULL,
  `nom_matiere` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etudiant_id` varchar(10) NOT NULL,
  `matiere_id` varchar(10) NOT NULL,
  `professeur_id` varchar(10) NOT NULL,
  `note` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`etudiant_id`),
  KEY `matiere_id` (`matiere_id`),
  KEY `professeur_id` (`professeur_id`)
);


DROP TABLE IF EXISTS `professeurs`;
CREATE TABLE IF NOT EXISTS `professeurs` (
  `id` varchar(10) NOT NULL,
  `matiere_id` varchar(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matiere_id` (`matiere_id`)
);
