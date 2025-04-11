-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 05:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinewise`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'ashish0018', 'ashish0018');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) DEFAULT NULL,
  `cust_contactno` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_contactno`) VALUES
(10, 'Rishabh Mandavlia', '8949472986'),
(11, 'Renish Amipara', '8696195653'),
(12, 'Ashish Sahu', '1234567890'),
(16, 'Jenish Bro', '4561237890'),
(18, 'Sumit Bathmi', '8949472987'),
(19, 'Ashish Sahu', '7742156429'),
(20, 'Ashish Sahu', '8646756891'),
(21, 'Harish Prajapat', '4567891234'),
(22, 'Sanjay Mandavlia', '8949476614'),
(23, 'Sumit Bathmi', '7742156428'),
(24, 'Ankit Chouhan', '8005156613'),
(25, 'Bhavya Dhimmar', '8619215970'),
(26, 'Mahek patel', '9687012628'),
(27, 'Akisha Patel', '9484484125'),
(28, 'Akanksha Shree', '8849861453'),
(29, 'Renish Amipara', '7894561230'),
(30, 'CustomerOne', '1234567891'),
(31, 'CustomerTwo', '1234568792'),
(32, 'CustomerThree', '1234567893'),
(33, 'CustomerFive', '1234567895'),
(34, 'CustomerSix', '1234567896'),
(35, 'CustomerSeven', '1234567897');

-- --------------------------------------------------------

--
-- Table structure for table `customer_visit`
--

CREATE TABLE `customer_visit` (
  `visit_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `no_of_person` int(11) DEFAULT NULL,
  `visiting_datetime` datetime DEFAULT NULL,
  `visit_finished` tinyint(1) DEFAULT 0,
  `have_seated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_visit`
--

INSERT INTO `customer_visit` (`visit_id`, `cust_id`, `no_of_person`, `visiting_datetime`, `visit_finished`, `have_seated`) VALUES
(122, 10, 5, '2024-04-15 23:13:24', 1, 0),
(124, 10, 16, '2024-04-16 00:03:01', 1, 0),
(132, 10, 10, '2024-04-16 21:36:29', 1, 0),
(133, 12, 5, '2024-04-16 21:37:05', 1, 0),
(134, 30, 5, '2024-04-16 21:37:35', 1, 0),
(135, 31, 6, '2024-04-16 21:37:55', 1, 0),
(136, 32, 10, '2024-04-16 21:38:13', 1, 0),
(137, 33, 5, '2024-04-16 21:41:40', 1, 0),
(138, 34, 5, '2024-04-16 21:42:06', 1, 0),
(139, 35, 3, '2024-04-16 21:42:36', 1, 0),
(142, 10, 5, '2024-04-22 13:40:54', 1, 0),
(143, 10, 10, '2024-04-22 13:54:04', 1, 0),
(144, 10, 10, '2024-04-22 13:54:42', 1, 0),
(145, 12, 10, '2024-04-22 13:55:29', 1, 0),
(146, 12, 6, '2024-04-22 14:33:28', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`category_id`, `category_name`, `category_image`) VALUES
(17, 'Beverages', '../item/item-image/590176633_lemon-s.png'),
(18, 'Pizzas', '../item/item-image/362361388_margherita.jpeg'),
(19, 'Sandwiches', '../item/item-image/927313366_paneer_sandwich.jpeg'),
(20, 'Burgers', '../item/item-image/257871141_burger.jpeg'),
(22, 'Breakfast', '../item/item-image/484689357_Idli sambhar.jpeg'),
(23, 'Noodles', '../item/item-image/605546308_hakka-noodles-recipe.jpg'),
(24, 'Manchurian', '../item/item-image/284352675_maxresdefault.jpg'),
(27, 'Pastas', '../item/item-image/518939725_masala-pasta.jpg'),
(28, 'Rajasthani', '../item/item-image/345049048_Dal Bati.jpg'),
(29, 'Ice-creams', '../item/item-image/684076419_lemon-s.png');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `mgr_id` int(11) NOT NULL,
  `mgr_firstname` varchar(50) NOT NULL,
  `mgr_lastname` varchar(50) NOT NULL,
  `mgr_emailid` varchar(255) NOT NULL,
  `mgr_phone_number` varchar(10) NOT NULL,
  `mgr_gender` char(1) NOT NULL,
  `mgr_address` varchar(95) NOT NULL,
  `mgr_password` varchar(35) NOT NULL,
  `mgr_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`mgr_id`, `mgr_firstname`, `mgr_lastname`, `mgr_emailid`, `mgr_phone_number`, `mgr_gender`, `mgr_address`, `mgr_password`, `mgr_status`) VALUES
(5, 'Rishabh', 'Mandavlia', 'rishabhmandavlia17@gmail.com', '8949472986', 'M', '102, Badi Holi, Udaipur, Rajasthan', '83c12ca099537d2552e1079507c40a77', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_image` varchar(259) NOT NULL,
  `item_description` text NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`item_id`, `category_id`, `item_name`, `item_image`, `item_description`, `price`, `status`) VALUES
(12, 20, 'Veg Burger', '../item/item-image/burger.jpeg', 'A vegetable burger, or veggie burger, is a burger patty made entirely from plant-based ingredients, offering a meat-free alternative to traditional burgers. It typically contains a variety of vegetables, legumes, and grains, seasoned with herbs and spices for flavor. Vegetable burgers are versatile, nutritious, and cater to vegetarian, vegan, and health-conscious diets. They are often served on buns with toppings and condiments, providing a satisfying and flavorful meal option.', 200, 0),
(13, 18, 'Cheese Pepperoni', '../item/item-image/pizza1.jpg', 'A savory delight featuring melted mozzarella cheese atop a thin, crispy crust, generously adorned with zesty pepperoni slices for a burst of flavor in every bite: Cheese Pepperoni Pizza, a classic favorite for pizza enthusiasts everywhere.', 1000, 0),
(14, 18, 'Paneer Pizza', '../item/item-image/Paneer-Pizza-7.jpg', 'Indulge in the rich flavors of a Paneer Pizza, where succulent cubes of paneer (Indian cottage cheese) are paired with vibrant bell peppers, onions, and a blend of aromatic spices, all atop a crispy crust, creating a delightful fusion of Indian and Italian cuisines.', 600, 0),
(16, 23, 'Chilly Noodles', '../item/item-image/6612e5f7d7798_hakka-noodles-5.jpeg', 'Delight your taste buds with Chilli Noodles, a tantalizing dish that combines stir-fried noodles with a medley of colorful vegetables and a spicy, savory sauce. Each bite offers a perfect balance of heat, sweetness, and umami, making it a favorite among fans of Asian cuisine. Whether enjoyed as a satisfying meal or a flavorful side dish, Chilli Noodles are sure to add a kick of excitement to your dining experience.', 150, 0),
(17, 17, 'Lemon Ice Tea', '../item/item-image/6612e835dcec9_lemon-s.png', 'Indulge in the refreshing zest of our Lemon Ice Tea, a delightful blend of premium tea leaves infused with the tangy essence of fresh lemon. Perfectly brewed to quench your thirst on a sunny day, it\'s the ideal companion for a rejuvenating break. Enjoy the crisp, citrusy flavor that leaves you feeling revitalized with every sip.', 80, 1),
(20, 20, 'Double Gorilla Burger', '../item/item-image/6612e8e48ead5_double-gorilla-burger.jpg', 'Savor the ultimate burger experience with our Double Gorilla Burger, a towering masterpiece crafted for the most adventurous appetites. Featuring not one, but two juicy beef patties, layered with melted cheese, crispy bacon, fresh lettuce, ripe tomatoes, and zesty pickles, all nestled between soft, toasted buns. Each bite is a symphony of flavors and textures, guaranteed to satisfy even the heartiest of cravings. Indulge in this mouthwatering delight and unleash your inner foodie with our Double Gorilla Burger today!', 300, 0),
(21, 23, 'Hakka Noodles', '../item/item-image/6612e94423a59_hakka-noodles-recipe.jpg', 'Indulge in the savory and aromatic delight of our Hakka Noodles, a fusion dish that blends the bold flavors of Chinese cuisine with the vibrant spices of India. Made with thin noodles stir-fried to perfection, tossed with a medley of colorful vegetables, and seasoned with fragrant sauces and spices, each bite is a burst of flavor and texture. Whether you\'re craving a satisfying meal or a quick snack, our Hakka Noodles offer a delightful balance of umami-rich flavors, crisp vegetables, and tender noodles, creating a culinary experience that\'s both comforting and invigorating. Experience the delicious harmony of East Asian and Indian flavors with every forkful of our Hakka Noodles.', 150, 0),
(24, 27, 'Masala Pasta', '../item/item-image/661d60ba314f9_masala-pasta.jpg', 'Masala pasta is a flavorful and spicy dish that combines cooked pasta with a variety of Indian spices and ingredients. Here\'s a typical description:  \"Masala pasta is a fusion dish that brings together the beloved Italian staple, pasta, with the aromatic spices and vibrant flavors of Indian cuisine. Cooked al dente, the pasta is tossed in a rich and aromatic masala sauce, which typically includes a blend of spices such as cumin, coriander, turmeric, and red chili powder.  The dish often incorporates a variety of vegetables such as bell peppers, onions, tomatoes, and green peas, adding both texture and color to the dish. Some variations may include protein options like chicken, paneer (Indian cottage cheese), or tofu, making it a versatile and satisfying meal.  Garnished with fresh cilantro leaves and a squeeze of lemon juice for a burst of freshness, masala pasta is a delicious and comforting dish that tantalizes the taste buds with its bold flavors and spicy kick. Whether enjoyed as a hearty lunch or dinner, masala pasta is sure to delight fans of both Italian and Indian cuisines alike.\"', 150, 0),
(25, 27, 'Spinach Alfredo Pasta', '../item/item-image/661d62962ae8e_Lighter-Spinach-Alfredo-Pasta-finished-500x500.jpg', 'Cheese spinach pasta is a delectable and creamy dish that combines tender pasta with savory cheese and nutritious spinach. Here\'s a description:  \"Cheese spinach pasta is a delightful culinary creation that marries the creamy richness of cheese with the earthy freshness of spinach, all enveloped in a blanket of perfectly cooked pasta. The dish begins with al dente pasta, such as penne or fusilli, cooked to perfection to provide a satisfying texture.  Next, a luscious sauce is prepared by blending creamy cheese, often varieties like Parmesan, mozzarella, or cream cheese, with a hint of garlic, butter, and sometimes a touch of cream or milk for added silkiness. This velvety sauce becomes the luxurious base that coats each strand of pasta, infusing it with rich flavor and irresistible creaminess.  To elevate both the taste and nutritional profile of the dish, generous handfuls of fresh spinach leaves are wilted into the sauce, adding a vibrant green hue and a dose of vitamins and minerals. The spinach brings a delightful earthiness and a subtle hint of sweetness to the dish, complementing the richness of the cheese sauce perfectly.  Garnished with a sprinkle of grated cheese and perhaps a dash of freshly ground black pepper or a pinch of nutmeg for added depth, cheese spinach pasta is a comforting and indulgent meal that satisfies both the palate and the soul. Whether enjoyed as a cozy weeknight dinner or presented as an elegant main course for guests, this dish never fails to impress with its creamy decadence and wholesome goodness.\"', 200, 0),
(26, 28, 'Dal Bati', '../item/item-image/661d63b6e7bc4_Dal Bati.jpg', 'Daal Bati or Bafla is a traditional meal of Dhar which is preferred in both urban and rural areas. It is easily available in most restaurants and hotels.  Dhar is a part of Malwa region. Dal Baati is comprising Dal (lentils) and Baati (hard wheat rolls). It is popular in other part of Madhya Pradesh also.  Dal is prepared using Tuvaar Dal, Chana Dal (prepared by removing skin of split chickpeas), Mung dal. The pulses or lentils are cooked together after being soaked in water for a few hours. First, a small amount of vegetable oil is heated in a frying pan and then the seasoning rai-jeera (mustard and cumin seeds) is added into the hot oil. Then green chilli, garlic and some spices including hing, red chilli, haldi, coriander, ginger are added. There may be a sweet and sour version of dal in some regions. Finally, the boiled Daal is added and cooked.  Baati is a hard bread made up of wheat flour commonly known as aata. Wheat flour is kneaded with little bit of salt, Dahi (yogurt) and water. Tennis ball-sized round balls of this dough are cooked in a well-heated traditional oven. When the Baati becomes golden brown in colour, it is greased with ghee and is then served with dal, rava ladoo, rice, pudina chutney, kairi (raw mango) chutney, green salad with lots of onion, and fresh buttermilk (chass).  Dal Bafla is a variation of Dal Baati, where the normal Bafla is boiled before baking it in traditional Baati oven. Batti is replaced by the Bafla, a softer version of it.', 200, 0),
(27, 17, 'Pepsi', '../item/item-image/661d64a0930eb_750ml-pepsi-cold-drink-500x500 (Large).jpeg', 'Indulge in the bold and invigorating taste of Pepsi, a beloved carbonated drink renowned for its distinctive flavor and refreshing fizz. With its unique blend of cola and citrus notes, Pepsi delivers a crisp and satisfying beverage experience that\'s perfect for any moment. Whether you\'re enjoying it with friends, pairing it with your favorite snack, or simply craving a refreshing pick-me-up, Pepsi is sure to delight your taste buds and leave you feeling refreshed and energized.', 100, 0),
(28, 17, 'Coca Cola', '../item/item-image/661d64f2d8c62_coca-cola (Large).jpeg', 'Coca-Cola is a globally recognized carbonated soft drink known for its refreshing taste and iconic branding. Created in 1886 by pharmacist John Pemberton, Coca-Cola has become one of the most popular and beloved beverages in the world. Its signature flavor, derived from a secret blend of natural flavors, includes notes of caramel and citrus, offering a satisfyingly sweet and effervescent experience. Coca-Cola is enjoyed by millions of people of all ages, whether as a standalone refreshment or as a versatile mixer in cocktails and mocktails. With its distinctive red-and-white logo and classic contour bottle, Coca-Cola continues to be synonymous with happiness, positivity, and shared moments of joy worldwide.', 45, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `order_datetime` datetime NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT 0,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `order_datetime`, `order_status`, `payment_status`) VALUES
(1, 10, '2024-04-08 11:19:14', 2, 1),
(2, 10, '2024-04-09 11:25:00', 2, 1),
(3, 10, '2024-04-08 00:00:00', 2, 1),
(4, 10, '2024-04-08 13:43:46', 2, 1),
(5, 10, '2024-04-09 09:44:19', 2, 1),
(6, 10, '2024-04-09 12:21:10', 2, 1),
(7, 10, '2024-04-09 13:57:17', 2, 1),
(8, 10, '2024-04-09 20:49:13', 0, 1),
(9, 10, '2024-04-10 00:29:33', 1, 1),
(10, 10, '2024-04-10 09:53:21', 0, 1),
(11, 10, '2024-04-10 10:09:14', 2, 0),
(12, 10, '2024-04-10 10:19:11', 2, 0),
(13, 26, '2024-04-10 11:31:07', 1, 0),
(14, 27, '2024-04-10 11:58:17', 2, 0),
(15, 28, '2024-04-10 14:06:34', 0, 0),
(16, 29, '2024-04-10 14:06:42', 2, 1),
(17, 10, '2024-04-14 23:28:58', 2, 1),
(18, 10, '2024-04-15 21:50:58', 2, 1),
(19, 10, '2024-04-20 22:14:50', 2, 1),
(20, 10, '2024-04-22 13:43:42', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `item_id`, `quantity`, `price_per_unit`) VALUES
(1, 12, 1, '200.00'),
(1, 17, 1, '80.00'),
(1, 18, 1, '20.00'),
(1, 19, 1, '40.00'),
(1, 20, 1, '300.00'),
(2, 13, 3, '1000.00'),
(2, 17, 4, '80.00'),
(2, 19, 1, '40.00'),
(2, 20, 2, '300.00'),
(2, 21, 3, '150.00'),
(3, 18, 5, '20.00'),
(4, 11, 1, '200.00'),
(4, 12, 1, '200.00'),
(4, 13, 1, '1000.00'),
(4, 14, 1, '600.00'),
(4, 16, 1, '150.00'),
(4, 17, 1, '80.00'),
(4, 18, 1, '20.00'),
(4, 19, 1, '40.00'),
(4, 20, 1, '300.00'),
(4, 21, 1, '150.00'),
(5, 13, 2, '1000.00'),
(5, 16, 2, '150.00'),
(5, 18, 4, '20.00'),
(6, 12, 1, '200.00'),
(7, 12, 1, '200.00'),
(7, 13, 1, '1000.00'),
(7, 16, 1, '150.00'),
(7, 17, 1, '80.00'),
(7, 19, 1, '40.00'),
(8, 17, 1, '80.00'),
(8, 18, 1, '20.00'),
(8, 19, 1, '40.00'),
(9, 16, 2, '150.00'),
(9, 20, 2, '300.00'),
(10, 12, 1, '200.00'),
(10, 13, 2, '1000.00'),
(10, 16, 2, '150.00'),
(10, 20, 2, '300.00'),
(10, 21, 2, '150.00'),
(11, 12, 1, '200.00'),
(11, 13, 1, '1000.00'),
(11, 16, 1, '150.00'),
(11, 17, 1, '80.00'),
(11, 18, 1, '20.00'),
(11, 19, 1, '40.00'),
(11, 20, 1, '300.00'),
(11, 21, 1, '150.00'),
(12, 17, 1, '80.00'),
(12, 18, 1, '20.00'),
(12, 19, 1, '40.00'),
(13, 17, 2, '80.00'),
(13, 18, 2, '20.00'),
(13, 19, 3, '40.00'),
(14, 12, 1, '200.00'),
(14, 18, 2, '20.00'),
(15, 12, 1, '200.00'),
(15, 17, 1, '80.00'),
(16, 17, 6, '80.00'),
(17, 12, 3, '200.00'),
(17, 17, 2, '80.00'),
(17, 18, 3, '20.00'),
(17, 19, 3, '40.00'),
(17, 20, 3, '300.00'),
(18, 17, 3, '80.00'),
(18, 19, 3, '40.00'),
(18, 20, 11, '300.00'),
(19, 12, 11, '200.00'),
(19, 17, 11, '80.00'),
(19, 20, 19, '300.00'),
(19, 27, 11, '100.00'),
(19, 28, 11, '45.00'),
(20, 12, 1, '200.00'),
(20, 16, 1, '150.00'),
(20, 17, 1, '80.00');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `table_seats` int(11) NOT NULL,
  `table_location` varchar(100) NOT NULL,
  `table_image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_number`, `table_seats`, `table_location`, `table_image`) VALUES
(10, 1, 4, 'Near stairs', NULL),
(11, 2, 5, 'Near stairs', NULL),
(12, 3, 6, 'Near stairs', NULL),
(25, 5, 12, 'Near stairs', NULL),
(26, 6, 10, 'Dining Hall', NULL),
(27, 4, 8, 'Dining Hall', NULL),
(29, 7, 16, 'Dining Hall', NULL),
(30, 12, 10, 'Dining Hall', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_allocated`
--

CREATE TABLE `table_allocated` (
  `visit_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `table_allocation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_allocated`
--

INSERT INTO `table_allocated` (`visit_id`, `table_id`, `table_allocation_time`) VALUES
(146, 12, '2024-04-22 14:34:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `customer_visit`
--
ALTER TABLE `customer_visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`mgr_id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`item_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `table_allocated`
--
ALTER TABLE `table_allocated`
  ADD PRIMARY KEY (`visit_id`,`table_id`),
  ADD KEY `table_id` (`table_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customer_visit`
--
ALTER TABLE `customer_visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `mgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_visit`
--
ALTER TABLE `customer_visit`
  ADD CONSTRAINT `customer_visit_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_allocated`
--
ALTER TABLE `table_allocated`
  ADD CONSTRAINT `table_allocated_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `customer_visit` (`visit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table_allocated_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `tables` (`table_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
