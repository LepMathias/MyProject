-- 'restaurant' Database
DROP DATABASE IF EXISTS restaurant;
CREATE DATABASE restaurant;
USE restaurant;
-- --------------------------------------------------------

-- 'categoriesMeal' table
CREATE TABLE categoriesMeal (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(50) NOT NULL
);

-- Insert categories
INSERT INTO categoriesMeal (id, name) VALUES
(1, 'starter'),
(2, 'main course'),
(3, 'dessert');
-- --------------------------------------------------------

-- 'meals' table
CREATE TABLE meals(
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title varchar(50) NOT NULL,
  description varchar(250) DEFAULT NULL,
  price char(3) NOT NULL,
  categoryId int(1) NOT NULL,
  FOREIGN KEY (categoryId) REFERENCES categoriesMeal(id)
);

-- Insert meals
INSERT INTO meals (id, title, description, price, categoryId) VALUES
(1, 'Terrine de cochon', 'Aux noisettes et abricots secs, sucrine et gel de pommes', '22', 1),
(2, 'Millefeuille de gorgonzola', 'Au mascarpone aux poiresde Savoie et noix de pécan', '20', 1),
(3, 'Foie gras de canard', 'Mariné au cognac et Porto, confit d\'oignon au balsamique', '29', 1),
(4, 'Suprême de poulet fermier', 'condiments rougaille et guacamole, accras de légumes et patate douce', '32', 2),
(5, 'Poitrine de cochon confite', 'Oeufs parfait meurette, champignons, truffes', '35', 2),
(6, 'Tartare de boeuf', 'Charolais assaisonné en cuisine', '26', 2),
(7, 'Rafraichie d\'agrumes', 'grenade à la citronelle et gingembre, sorbet citron', '12', 3),
(8, 'Poire de Savoie', 'Pochée façon belle Hélène', '12', 3),
(9, 'Panna cotta fruit de la passion', 'Ananas mariné à la vanille et citron vert', '12', 3);
-- --------------------------------------------------------

-- 'menus' table'
CREATE TABLE menus (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title varchar(50) NOT NULL,
  description varchar(250) NOT NULL,
  availability varchar(150) NOT NULL,
  price char(3) NOT NULL
);

-- Insert menus
INSERT INTO menus (id, title, description, availability, price) VALUES
(1, 'Menu du jour', 'Entrée, Plat, Dessert (unique, sans choix)', 'Le midi du mercredi au vendredi', '28'),
(2, 'Menu Fraicheur', 'Entrée, Plat, dessert (au choix, à la carte)', 'Le soir du mercredi au vendredi, le midi de samedi à dimanche', '60');
-- --------------------------------------------------------

-- 'schedules' table
CREATE TABLE schedules (
  id int(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  day varchar(8) NOT NULL,
  startDej char(7) DEFAULT NULL,
  endDej char(7) DEFAULT NULL,
  startDin char(7) DEFAULT NULL,
  endDin char(7) DEFAULT NULL
);

-- Insert schedules
INSERT INTO schedules (id, day, startDej, endDej, startDin, endDin) VALUES
(1, 'Lundi', '', '', '', ''),
(2, 'Mardi', '', '', '', ''),
(3, 'Mercredi', '12:00', '14:00', '19:00', '21:30'),
(4, 'Jeudi', '12:00', '14:00', '19:00', '21:30'),
(5, 'Vendredi', '12:00', '14:00', '19:00', '21:30'),
(6, 'Samedi', '12:00', '14:00', '19:00', '21:30'),
(7, 'Dimanche', '12:00', '14:00', '19:00', '21:30');
-- --------------------------------------------------------

-- 'settings' table
CREATE TABLE settings (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  content varchar(250) DEFAULT NULL
);

-- Insert settings
INSERT INTO settings (id, name, content) VALUES
(1, 'maxOfGuest', '12'),
(2, 'schedulesGap', '900'),
(3, 'schedulesFooter', 'du mercredi au dimanche de 12h00 à 14h00 et de 19h00 à 21h30');
-- --------------------------------------------------------

-- 'users' table
CREATE TABLE users (
  id char(36) NOT NULL PRIMARY KEY,
  lastname varchar(50) NOT NULL,
  firstname varchar(50) NOT NULL,
  birthdate char(10) DEFAULT NULL,
  email varchar(254) NOT NULL,
  phoneNumber varchar(20) DEFAULT NULL,
  password char(72) NOT NULL,
  defaultNbrGuest varchar(2) DEFAULT NULL,
  allergies varchar(150) DEFAULT NULL,
  status varchar(255) DEFAULT 'Normal',
  isAdmin int(1) DEFAULT 0
);

-- Insert Users
INSERT INTO users (id, lastname, firstname, birthdate, email, phoneNumber, password, defaultNbrGuest, allergies, isAdmin) VALUES

('ed499078-b079-11ed-9853-e0d55edaff0f', 'Admin', 'Master', '', 'admin@lqa.fr', '0102030405',
 '$2y$10$BqJaCj7EesNXfAEymSKpB.thi4Dn5eXjGVwvKs/jGVDcQvws7hFsO', '2', '', 2),
('ed499079-b079-11ed-9853-e0d55edaff0f', 'Admin', 'Second', '', 'adm@lqa.fr', '0102030405',
 '$2y$10$BqJaCj7EesNXfAEymSKpB.thi4Dn5eXjGVwvKs/jGVDcQvws7hFsO', '2', '', 1),
('ed513245-b079-11ed-9853-e0d55edaff0f', 'Dupont', 'Gérard', '', 'gerard@dpd.fr', '0102030405',
 '$2y$10$oqX8k.OI0DyX2hb/zAgkWuhdXcyT.aaJipkCtOnTlFz/8yUtS3Ium', '2', '', 0),
('ed594d90-b079-11ed-9853-e0d55edaff0f', 'Martinel', 'Jean', '', 'jean@mtl.fr', '0102030405',
 '$2y$10$fGGsY6McH.oYVEitBe59Wuvpgd/9ZHSgCIQSQyRaD1zq0BxsiNNai', '2', 'Gluten - Lactose', 0),
('4eb21005-d952-11ed-ad18-1cbfcea3a260', 'Jandre', 'Marlon', '', 'marlon@jdr.fr', '0102030506',
 '$2y$10$79V/pYZ1jdUAlFNlGyKe6uOQ2C83IpDBoVoCyv4okVAOGqQg9fa8a', '6', '', 0),
('f5e1b663-d953-11ed-ad18-1cbfcea3a260', 'Martinez', 'Diego', '', 'diego@mrt.fr', '0102050607',
 '$2y$10$g.ZPXwuy/wy6U9edaS/bXeuXSFwCOUIsx7P2IgZxDWgu.hByBL7Yu', '18', 'Arachides - Gluten', 0),
('afa9eda2-d954-11ed-ad18-1cbfcea3a260', 'Moscoso', 'Joao', '', 'joao@msc.fr', '0102030405',
 '$2y$10$poatPGLMXUT8ONqm.x8CDu2fikfZ4xWmGsWwt9l1YS1dG.LScn1hq', '5', 'fruits de mer', 0),
('f5b96a02-d950-11ed-ad18-1cbfcea3a260', 'Dupond', 'Martin', '', 'martin@dod.fr', '0102030405',
 '$2y$10$y1Njt1WXAkCxjmso2jQtPuDu5qabHrSIlnC3b1PLHYWlDNDyV1Dne', '4', 'Arachides', 0);
-- --------------------------------------------------------

-- 'reservations' table

CREATE TABLE reservations (
  userId char(36) DEFAULT NULL,
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  date char(10) NOT NULL,
  hour char(5) NOT NULL,
  nbrOfGuest char(3) NOT NULL,
  lastname varchar(50) DEFAULT NULL,
  firstname varchar(50) DEFAULT NULL,
  phoneNumber varchar(50) DEFAULT NULL,
  allergies varchar(150) DEFAULT NULL,
  FOREIGN KEY (userId) REFERENCES users(id)
);

-- insert reservations
INSERT INTO reservations (userId, id, date, hour, nbrOfGuest, lastname, firstname, phoneNumber, allergies) VALUES
   ('ed513245-b079-11ed-9853-e0d55edaff0f', 1, '2023-02-16', '12:00', '3', NULL, NULL, NULL, NULL),
   ('ed513245-b079-11ed-9853-e0d55edaff0f', 2, '2023-03-16', '19:15', '2', NULL, NULL, NULL, NULL),
   ('ed513245-b079-11ed-9853-e0d55edaff0f', 3, '2023-04-16', '12:15', '1', NULL, NULL, NULL, NULL),
   ('ed513245-b079-11ed-9853-e0d55edaff0f', 4, '2023-05-16', '20:45', '4', NULL, NULL, NULL, NULL),
   ('ed513245-b079-11ed-9853-e0d55edaff0f', 5, '2023-06-16', '19:15', '3', NULL, NULL, NULL, NULL),
   ('ed513245-b079-11ed-9853-e0d55edaff0f', 6, '2023-07-16', '20:15', '2', NULL, NULL, NULL, NULL),
   (NULL, 7, '2023-02-16', '12:15', '5', 'Dupond', 'Albert', '0203040506', 'Gluten'),
   ('ed594d90-b079-11ed-9853-e0d55edaff0f', 8, '2023-02-16', '12:45', '6', NULL, NULL, NULL, 'Gluten - Lactose'),
   ('ed594d90-b079-11ed-9853-e0d55edaff0f', 9, '2023-03-18', '19:30', '3', NULL, NULL, NULL, 'Gluten - Lactose'),
   ('ed594d90-b079-11ed-9853-e0d55edaff0f', 10, '2023-04-22', '20:30', '3', NULL, NULL, NULL, 'Gluten - Lactose'),
   ('ed594d90-b079-11ed-9853-e0d55edaff0f', 11, '2023-05-10', '20:00', '3', NULL, NULL, NULL, 'Gluten - Lactose'),
   ('ed594d90-b079-11ed-9853-e0d55edaff0f', 12, '2023-05-25', '19:30', '3', NULL, NULL, NULL, 'Gluten - Lactose'),
   (NULL, 13, '2023-02-16', '12:30', '2', 'Martin', 'Bernard', '0304050607', 'Lactose'),
   ('f5b96a02-d950-11ed-ad18-1cbfcea3a260', 14, '2023-02-16', '19:30', '3', NULL, NULL, NULL, NULL),
   (NULL, 15, '2023-02-16', '19:00', '2', 'Martin', 'Bernard', '0304050607', 'Lactose'),
   ('4eb21005-d952-11ed-ad18-1cbfcea3a260', 16, '2023-11-16', '19:15', '6', NULL, NULL, NULL, NULL),
   (NULL, 17, '2023-02-16', '19:45', '2', 'Dupond', 'Albert', '0203040506', 'Gluten'),
   ('afa9eda2-d954-11ed-ad18-1cbfcea3a260', 18, '2023-05-29', '20:30', '3', NULL, NULL, NULL, 'fruits de mer'),



   ('f5e1b663-d953-11ed-ad18-1cbfcea3a260', 19, '2023-10-13', '19:30', '18', NULL, NULL, NULL, 'gluten');
-- --------------------------------------------------------