CREATE TABLE `orders` (
  `order_ID` int PRIMARY KEY,
  `brand` varchar(255),
  `model` varchar(255),
  `size` varchar(255),
  `fuel` varchar(255),
  `color` varchar(255),
  `parkingS` bool,
  `abs` bool,
  `conditioning` bool
);
