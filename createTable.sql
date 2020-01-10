CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(255) NOT NULL,
  `id_covoiturage` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_utilisateur`) References utilisateur(id),
  FOREIGN KEY (`id_covoiturage`) References covoiturage(id)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `nb_place` int(255) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `covoiturage` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `localisation_depart` varchar(255) NOT NULL,
  `depart_date` datetime NOT NULL,
  `localisation_arrive` varchar(255) NOT NULL,
  `prix` int(255) NOT NULL,
  `nb_place` int(255) NOT NULL,
  `id_createur` int(255) NOT NULL,
  `id_evenement` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_createur`) References utilisateur(id),
  FOREIGN KEY (`id_evenement`) References evenement(id)
) ENGINE=InnoDB;
