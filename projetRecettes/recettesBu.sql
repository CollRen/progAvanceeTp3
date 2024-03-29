CREATE DATABASE recettes;

CREATE TABLE auteur(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45),
prenom VARCHAR(45)
);

CREATE TABLE recette_categorie(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45)
);

CREATE TABLE recette(
id INT AUTO_INCREMENT PRIMARY KEY,
titre VARCHAR(60),
description TEXT,
temps_preparation DOUBLE,
temps_cuisson DOUBLE,
recette_categorie_id INT NOT NULL,
auteur_id INT
);

CREATE TABLE ingredient_categorie(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45)
);

CREATE TABLE unite_mesure(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(20)
);

CREATE TABLE ingredient(
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(45) NOT NULL UNIQUE,
ingredient_categorie_id INT NOT NULL
);

CREATE TABLE recette_has_ingredient(
id INT AUTO_INCREMENT PRIMARY KEY,
recette_id INT,
ingredient_id INT,
quantite VARCHAR(45),
unite_mesure_id INT,
CONSTRAINT fk_recette_id FOREIGN KEY (recette_id) REFERENCES recette (id),
CONSTRAINT fk_ingredient_id FOREIGN KEY (ingredient_id) REFERENCES ingredient (id),
CONSTRAINT fk_unite_mesure_id FOREIGN KEY (unite_mesure_id) REFERENCES unite_mesure (id)
);

INSERT INTO `recettes`.`ingredient_categorie`
(`nom`)
VALUES ('Les épices'),
('Fromage'),
('Viande'),
('Fines herbes'),
('Fruit'),
('Légume');


INSERT INTO `recettes`.`ingredient`
(
`nom`,
`ingredient_categorie_id`)
VALUES (
'Sel de célerie',
1);

INSERT INTO `recettes`.`recette_categorie` (`id`, `nom`) VALUES 
(NULL, 'Dessert'),
(NULL, 'Plats principaux');

INSERT INTO `recettes`.`auteur` (`nom`, `prenom`) VALUES 
('de Montigny', 'René'),
('Dallair', 'Ismael'),
('Young', 'Robert'),
('Martel', 'Didier'),
('Larrivée', 'Ricardo'),
('Dubé', 'Nancy');

INSERT INTO `recettes`.`recette` (`id`, `titre`, `description`, `temps_preparation`, `temps_cuisson`, `recette_categorie_id`, `auteur_id`) VALUES 
(NULL, 'Dessert cool','Ceci décrivant celà', 11, 11, 1, 1),
(NULL, 'Ceci décrivant celà', 'Dessert cool', 10, 10, 1, 1);

INSERT INTO `unite_mesure` (`id`, `nom`) VALUES
(1, 'tsp'),
(2, 'Tbs'),
(3, 'ml'),
(4, '---'),
(5, 'lb'),
(6, 'gr'),
(7, '---'),
(8, 'oz'),
(9, 'Cup');

INSERT INTO `recettes`.`recette_has_ingredient`
(`recette_id`,
`ingredient_id`,
`quantite`,
`unite_mesure_id`)
VALUES
(1,
1,
2,
1);

INSERT INTO `recettes`.`recette_has_ingredient`
(`recette_id`,
`ingredient_id`,
`quantite`,
`unite_mesure_id`)
VALUES
(1,1,1,1);



CREATE TABLE recettes.user (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `privilege_id` INT NOT NULL,
  `create_at` TIMESTAMP
);

CREATE TABLE recettes.privilege (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `privilege` VARCHAR(50) NOT NULL
);

INSERT INTO recettes.privilege (`privilege`) VALUES
('Admin'),
('Manager'),
('Auteur');


CREATE TABLE recettes.journal(
id INT AUTO_INCREMENT PRIMARY KEY,
ip_address VARCHAR(45),
date TIMESTAMP(6),
username VARCHAR(50),
page_visited VARCHAR(125),
user_id INT,
CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES user (id)
);

INSERT INTO `recettes` .`user` (`id`, `name`, `username`, `password`, `email`, `privilege_id`) VALUES
(0, 'guest', 'guest@guest.com', '$2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy', 'guest@guest.com', 0),
(1, 'René', 'rensax@me.com', '$2y$10$GQsG5y6T2GDmQlwB7u8ui.FCyEnHDtlJ6rZJ.xr3ofA2kB.olsBXy', 'rensax@me.com', 1),
(2, 'manager', 'manager@me.com', '$2y$10$lw8CfdVUs1MfC94mp4v0WuwptDgPogUI8SkitBQKUMXvLr6ipqIl.', 'manager@me.com', 2),
(3, 'auteur', 'auteur@me.com', '$2y$10$7i65cP/wEtdbijq3rW3.mObL/OUuH6UbK42K7tOoys7t9O4DimY/i', 'auteur@me.com', 3),
(4, 'admin', 'admin@me.com', '$2y$10$BtF.zfwv297COxJf5uk91eQfNh07mEjzMAcdyLfKWB32KRMidE.jK', 'admin@me.com', 1);


INSERT INTO `recettes`. `privilege` (`id`, `privilege`) VALUES
(0, 'guest');