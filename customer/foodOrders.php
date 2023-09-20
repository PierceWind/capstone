CREATE TABLE `foodOrder` (
  'prodImg' //dunno 
  `prodId` int(30) NOT NULL,
  `prodPrice` int(30) NOT NULL,
  'prodDescription' string,
  `quantity` int(30) NOT NULL,
  `order_date` date NOT NULL,
  `order_id` varchar(50) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `food_orders`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `food_orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

