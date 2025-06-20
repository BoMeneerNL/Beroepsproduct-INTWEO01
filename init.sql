
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON pizzeria.* TO 'user'@'%';
FLUSH PRIVILEGES;

CREATE TABLE `User` (
  username VARCHAR(255) PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  address VARCHAR(255),
  role VARCHAR(50) NOT NULL
);

CREATE TABLE ProductType (
  name VARCHAR(255) PRIMARY KEY
);

CREATE TABLE Ingredient (
  name VARCHAR(255) PRIMARY KEY
);

CREATE TABLE Product (
  name VARCHAR(255) PRIMARY KEY,
  price DECIMAL(10,2) NOT NULL,
  type_id VARCHAR(255) NOT NULL,
  FOREIGN KEY (type_id) REFERENCES ProductType(name)
);

CREATE TABLE Product_Ingredient (
  product_name VARCHAR(255),
  ingredient_name VARCHAR(255),
  PRIMARY KEY (product_name, ingredient_name),
  FOREIGN KEY (product_name) REFERENCES Product(name),
  FOREIGN KEY (ingredient_name) REFERENCES Ingredient(name)
);

CREATE TABLE Pizza_Order (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  client_username VARCHAR(255),
  client_name VARCHAR(255) NOT NULL,
  personnel_username VARCHAR(255) NOT NULL,
  datetime DATETIME NOT NULL,
  status INT,
  address VARCHAR(255),
  FOREIGN KEY (client_username) REFERENCES `User`(username),
  FOREIGN KEY (personnel_username) REFERENCES `User`(username)
);

CREATE TABLE Pizza_Order_Product (
  order_id INT,
  product_name VARCHAR(255),
  quantity INT NOT NULL,
  PRIMARY KEY (order_id, product_name),
  FOREIGN KEY (order_id) REFERENCES Pizza_Order(order_id),
  FOREIGN KEY (product_name) REFERENCES Product(name)
);

ALTER TABLE `Product` ADD FOREIGN KEY (`type_id`) REFERENCES `ProductType` (`name`);
ALTER TABLE `Product_Ingredient` ADD FOREIGN KEY (`product_name`) REFERENCES `Product` (`name`);
ALTER TABLE `Product_Ingredient` ADD FOREIGN KEY (`ingredient_name`) REFERENCES `Ingredient` (`name`);
ALTER TABLE `Pizza_Order` ADD FOREIGN KEY (`client_username`) REFERENCES `User` (`username`);
ALTER TABLE `Pizza_Order` ADD FOREIGN KEY (`personnel_username`) REFERENCES `User` (`username`);
ALTER TABLE `Pizza_Order_Product` ADD FOREIGN KEY (`order_id`) REFERENCES `Pizza_Order` (`order_id`);
ALTER TABLE `Pizza_Order_Product` ADD FOREIGN KEY (`product_name`) REFERENCES `Product` (`name`);

INSERT INTO `User` (username, `password`, first_name, last_name, `role`) VALUES
('jdoe', 'wachtwoord', 'John', 'Doe', 'Client'),
('mvermeer', 'wachtwoord', 'Maria', 'Vermeer', 'Client'),
('rdeboer', 'wachtwoord', 'Rik', 'de Boer', 'Personnel'),
('sbakker', 'wachtwoord', 'Sophie', 'Bakker', 'Personnel'),
('fholwerda', 'wachtwoord', 'Fenna', 'Holwerda', 'Client'),
('kdijkstra', 'wachtwoord', 'Klaas', 'Dijkstra', 'Client'),
('lheineken', 'wachtwoord', 'Lucas', 'Heineken', 'Personnel'),
('mvandam', 'wachtwoord', 'Mila', 'van Dam', 'Personnel'),
('gkoolstra', 'wachtwoord', 'Gert', 'Koolstra', 'Client'),
('evisscher', 'wachtwoord', 'Emma', 'Visscher', 'Client'),
('tjanssen', 'wachtwoord', 'Tom', 'Janssen', 'Personnel'),
('abrouwer', 'wachtwoord', 'Anna', 'Brouwer', 'Personnel'),
('wbos', 'wachtwoord', 'Willem', 'Bos', 'Client'),
('tvandermeer', 'wachtwoord', 'Tessa', 'van der Meer', 'Client'),
('rkramer', 'wachtwoord', 'Rob', 'Kramer', 'Personnel'),
('mnijland', 'wachtwoord', 'Maud', 'Nijland', 'Personnel'),
('dschouten', 'wachtwoord', 'David', 'Schouten', 'Client'),
('hdeleeuw', 'wachtwoord', 'Hanna', 'de Leeuw', 'Client'),
('pvanveen', 'wachtwoord', 'Peter', 'van Veen', 'Personnel'),
('adekhane', 'wachtwoord', 'Ahmed', 'Dekhane', 'Client'), 
('mbouaziz', 'wachtwoord', 'Mouna', 'Bouaziz', 'Client'), 
('tbayrak', 'wachtwoord', 'Tarik', 'Bayrak', 'Personnel'), 
('ayildiz', 'wachtwoord', 'Aylin', 'Yildiz', 'Personnel'), 
('rnarsingh', 'wachtwoord', 'Rajesh', 'Narsingh', 'Client'), 
('sdurga', 'wachtwoord', 'Shanti', 'Durga', 'Client'), 
('mkassem', 'wachtwoord', 'Mohammed', 'Kassem', 'Personnel'), 
('lsaleh', 'wachtwoord', 'Lina', 'Saleh', 'Personnel'), 
('aghebre', 'wachtwoord', 'Amanuel', 'Ghebre', 'Client'), 
('mtsega', 'wachtwoord', 'Miriam', 'Tsega', 'Client'), 
('pkowalski', 'wachtwoord', 'Piotr', 'Kowalski', 'Personnel'), 
('aivanov', 'wachtwoord', 'Alexei', 'Ivanov', 'Personnel'), 
('mkarimi', 'wachtwoord', 'Mina', 'Karimi', 'Client'), 
('hradman', 'wachtwoord', 'Hassan', 'Radman', 'Client'), 
('lbaloyi', 'wachtwoord', 'Lerato', 'Baloyi', 'Personnel'), 
('dpetrov', 'wachtwoord', 'Dmitri', 'Petrov', 'Personnel'), 
('ibrahimovic', 'wachtwoord', 'Ismail', 'Brahimovic', 'Client'), 
('snovak', 'wachtwoord', 'Sanja', 'Novak', 'Client'), 
('yabebe', 'wachtwoord', 'Yonas', 'Abebe', 'Personnel'), 
('ngebre', 'wachtwoord', 'Nardos', 'Gebre', 'Personnel'); 

INSERT INTO ProductType (`name`) VALUES
('Pizza'),
('Maaltijd'),
('Specerij'),
('Voorgerecht'),
('Drank');

INSERT INTO Ingredient (`name`) VALUES
('Tomaat'),
('Kaas'),
('Pepperoni'),
('Champignon'),
('Ui'),
('Sla'),
('Spek'),
('Saus');

INSERT INTO Product (`name`, price, type_id) VALUES
('Margherita Pizza', 9.99, 'Pizza'),
('Pepperoni Pizza', 11.99, 'Pizza'),
('Vegetarische Pizza', 10.99, 'Pizza'),
('Hawaiian Pizza', 12.99, 'Pizza'),
('Combinatiemaaltijd', 15.99, 'Maaltijd'),
('Knoflookbrood', 4.99, 'Voorgerecht'),
('Coca Cola', 2.49, 'Drank'),
('Sprite', 2.49, 'Drank');

INSERT INTO Product_Ingredient (product_name, ingredient_name) VALUES
('Margherita Pizza', 'Tomaat'),
('Margherita Pizza', 'Kaas'),
('Pepperoni Pizza', 'Tomaat'),
('Pepperoni Pizza', 'Kaas'),
('Pepperoni Pizza', 'Pepperoni'),
('Vegetarische Pizza', 'Tomaat'),
('Vegetarische Pizza', 'Kaas'),
('Vegetarische Pizza', 'Champignon'),
('Vegetarische Pizza', 'Ui'),
('Hawaiian Pizza', 'Tomaat'),
('Hawaiian Pizza', 'Kaas'),
('Hawaiian Pizza', 'Pepperoni'),
('Hawaiian Pizza', 'Ui'),
('Hawaiian Pizza', 'Sla'),
('Hawaiian Pizza', 'Spek'),
('Hawaiian Pizza', 'Saus'),
('Combinatiemaaltijd', 'Tomaat'),
('Combinatiemaaltijd', 'Kaas'),
('Combinatiemaaltijd', 'Pepperoni'),
('Combinatiemaaltijd', 'Champignon'),
('Combinatiemaaltijd', 'Ui'),
('Combinatiemaaltijd', 'Sla'),
('Combinatiemaaltijd', 'Spek'),
('Combinatiemaaltijd', 'Saus');

INSERT INTO `Pizza_Order` (client_username, client_name, personnel_username, datetime, status, address) VALUES
('jdoe', 'John Doe', 'rdeboer', '2024-06-12 18:45:00', 1, 'Bakkerstraat 1, 6811EG, Arnhem'),
('mvermeer', 'Maria Vermeer', 'sbakker', '2024-06-12 19:00:00', 2, 'Jansplein 2, 6811GD, Arnhem'),
('fholwerda', 'Fenna Holwerda', 'lheineken', '2024-06-12 19:15:00', 1, 'Willemsplein 3, 6811KD, Arnhem'),
('kdijkstra', 'Klaas Dijkstra', 'mvandam', '2024-06-12 19:30:00', 2, 'Kerkstraat 4, 6811DW, Arnhem'),
('gkoolstra', 'Gert Koolstra', 'tjanssen', '2024-06-12 19:45:00', 3, 'Rijnkade 5, 6811HA, Arnhem'),
(NULL, 'Pieter Post', 'abrouwer', '2024-06-12 20:00:00', 1, 'Grote Markt 6, 6511KB, Nijmegen'),
(NULL, 'Anna Smits', 'wbos', '2024-06-12 20:15:00', 2, 'Sint Annastraat 7, 6524EZ, Nijmegen'),
(NULL, 'Bert van Dijk', 'tvandermeer', '2024-06-12 20:30:00', 3, 'Oranjesingel 8, 6511NV, Nijmegen'),
(NULL, 'Sara de Vries', 'rkramer', '2024-06-12 20:45:00', 1, 'Van Welderenstraat 9, 6511MS, Nijmegen'),
(NULL, 'Jan Jansen', 'mnijland', '2024-06-12 21:00:00', 2, 'Molenstraat 10, 6511HJ, Nijmegen'),
('dschouten', 'David Schouten', 'hdeleeuw', '2024-06-13 18:45:00', 1, 'Velperweg 11, 6814AD, Arnhem'),
('evisscher', 'Emma Visscher', 'pvanveen', '2024-06-13 19:00:00', 2, 'Geitenkamp 12, 6815AP, Arnhem'),
('adekhane', 'Ahmed Dekhane', 'ayildiz', '2024-06-13 19:15:00', 1, 'IJssellaan 13, 6821DJ, Arnhem'),
('wbos', 'Willem Bos', 'tbayrak', '2024-06-13 19:30:00', 2, 'Broekstraat 14, 6822GD, Arnhem'),
('mnijland', 'Maud Nijland', 'mkassem', '2024-06-13 19:45:00', 3, 'Apeldoornsestraat 15, 6828AJ, Arnhem'),
(NULL, 'Els de Boer', 'lsaleh', '2024-06-13 20:00:00', 1, 'Marialaan 16, 6541RP, Nijmegen'),
(NULL, 'Tom Bakker', 'pkowalski', '2024-06-13 20:15:00', 2, 'Smetiusstraat 17, 6511EP, Nijmegen'),
(NULL, 'Mila Janssen', 'aivanov', '2024-06-13 20:30:00', 3, 'Van Oldenbarneveltstraat 18, 6511PA, Nijmegen'),
(NULL, 'Lars de Groot', 'mkarimi', '2024-06-13 20:45:00', 1, 'Hertogstraat 19, 6511RV, Nijmegen'),
(NULL, 'Rik Kramer', 'dpetrov', '2024-06-13 21:00:00', 2, 'Van Schaeck Mathonsingel 20, 6512AP, Nijmegen'),
(NULL, 'Sophie van der Meer', 'ibrahimovic', '2024-06-14 18:45:00', 1, 'Lange Hezelstraat 21, 6511CM, Nijmegen'),
('rdeboer', 'Rik de Boer', 'sbakker', '2024-06-14 19:00:00', 2, 'Waalkade 22, 6511XR, Nijmegen'),
('mvermeer', 'Maria Vermeer', 'lheineken', '2024-06-14 19:15:00', 1, 'Sint Jacobslaan 23, 6533BT, Nijmegen'),
('jdoe', 'John Doe', 'mvandam', '2024-06-14 19:30:00', 2, 'Van Broeckhuysenstraat 24, 6511PE, Nijmegen'),
(NULL, 'Henk de Wit', 'gkoolstra', '2024-06-14 19:45:00', 3, 'Ziekerstraat 25, 6511LH, Nijmegen');

INSERT INTO Pizza_Order_Product (order_id, product_name, quantity) VALUES
(1, 'Margherita Pizza', 2),
(1, 'Coca Cola', 3),
(2, 'Pepperoni Pizza', 1),
(2, 'Sprite', 2),
(3, 'Vegetarische Pizza', 1),
(3, 'Hawaiian Pizza', 1),
(4, 'Combinatiemaaltijd', 2),
(4, 'Knoflookbrood', 1),
(5, 'Pepperoni Pizza', 1),
(6, 'Margherita Pizza', 3),
(6, 'Hawaiian Pizza', 2),
(7, 'Combinatiemaaltijd', 2),
(8, 'Knoflookbrood', 2),
(8, 'Sprite', 1),
(9, 'Pepperoni Pizza', 1),
(10, 'Hawaiian Pizza', 2),
(10, 'Coca Cola', 2),
(11, 'Margherita Pizza', 2),
(12, 'Vegetarische Pizza', 1),
(13, 'Hawaiian Pizza', 3),
(13, 'Coca Cola', 1),
(14, 'Combinatiemaaltijd', 1),
(14, 'Knoflookbrood', 1),
(15, 'Pepperoni Pizza', 2),
(15, 'Sprite', 2),
(16, 'Margherita Pizza', 1),
(17, 'Vegetarische Pizza', 2),
(18, 'Hawaiian Pizza', 1),
(19, 'Combinatiemaaltijd', 2),
(19, 'Knoflookbrood', 1),
(20, 'Pepperoni Pizza', 3),
(21, 'Hawaiian Pizza', 2),
(21, 'Coca Cola', 1),
(22, 'Margherita Pizza', 2),
(22, 'Knoflookbrood', 1),
(23, 'Pepperoni Pizza', 1),
(24, 'Vegetarische Pizza', 2),
(25, 'Hawaiian Pizza', 2),
(25, 'Sprite', 1);