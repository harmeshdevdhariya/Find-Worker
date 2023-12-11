-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 03:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findworker`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `service_taker_title` varchar(255) DEFAULT NULL,
  `service_taker_content` text DEFAULT NULL,
  `provider_title` varchar(255) DEFAULT NULL,
  `provider_content` text DEFAULT NULL,
  `mission_content` text DEFAULT NULL,
  `vision_content` text DEFAULT NULL,
  `history_content` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `service_taker_title`, `service_taker_content`, `provider_title`, `provider_content`, `mission_content`, `vision_content`, `history_content`, `last_updated`) VALUES
(1, 'SERVICE TAKER SIDE', 'Here the service taker can be book your worker on this website formate.\r\n\r\nThe service taker plays a crucial role in requesting and scheduling services. They have the ability to interact with a calendar interface to select specific dates and request services on those dates. When they click on a date, a pop-up allows them to choose between various options, such as marking a date as \"Busy\" or \"Available.\" This system prevents double booking on the same date and ensures efficient scheduling for the service taker.', 'SERVICE PROVIDER SIDE', 'The service provider\'s role involves managing their availability and responding to service requests. When a service taker requests a date, the service provider can view their calendar, which displays booked, active, and busy dates using different colors for easy identification. The service provider can accept or decline service requests based on their availability. The system simplifies communication and scheduling between service takers and providers, creating a streamlined experience for both parties.\r\n\r\nEFFICIENT SCHEDULE MANAGEMENT:\r\nService providers can efficiently manage their schedules, ensuring they make the most of their available time.', 'Our project is driven by a clear and ambitious mission - to simplify the process of service scheduling and delivery, making it effortless for service takers to find the right service providers and for service providers to efficiently manage their schedules. We aim to revolutionize the way people access services by providing a user-friendly platform that fosters transparent communication and ensures service availability.', 'Our vision is to create a world where scheduling services is hassle-free and efficient. We envision a platform that connects service takers and service providers seamlessly, reducing scheduling conflicts and enhancing the overall experience for both parties. We aspire to be a trusted hub for service-related interactions, where users can easily find and book the services they need.', 'Our journey began with a simple idea - to bridge the gap between service takers and providers by developing a digital platform that streamlines the scheduling process. Over the years, we\'ve evolved and grown, driven by our commitment to improving the way services are accessed and delivered. Today, we stand as a testament to our dedication, with a robust system that benefits countless users in efficiently managing their service-related needs.', '2023-10-17 10:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `image`) VALUES
(1, 'harmesh', '2004', 'harmesh.jpeg'),
(2, 'ruchit', '1212', 'ruchit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `service_taker_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `service_provider_id`, `service_taker_id`, `date`, `status`) VALUES
(1, 1, 2, '2023-10-31', 'pending'),
(2, 1, 2, '2023-11-29', 'confirmed'),
(5, 41, 42, '2023-11-22', 'pending'),
(6, 42, 42, '2023-11-30', 'pending'),
(7, 39, 42, '2023-11-20', 'pending'),
(8, 33, 42, '2023-11-29', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `servicetype` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `servicetype`, `description`) VALUES
(1, '1.jpg', 'Agriculture', 'Find For Agriculturing  Worker'),
(2, '2.jpg', 'Furniture', 'Find A Furniture Specialist  '),
(3, '3.jpg', 'Plumber', 'Find A Plumber Near By You'),
(4, '4.jpg', 'Construction', 'Find For Constructors Labor'),
(5, '5.jpg', 'Painter', 'Find For Painting Contractore'),
(6, '6.jpg', 'Electrician', 'Find The Best Electrician Near By You'),
(7, '7.jpg', 'Driver', 'Find Your Personal Driver'),
(8, '8.jpg', 'Tiles/Marbels', 'Finds A Tiles/Marble Fitting Contractore'),
(9, '9.jpg', 'Pest-Control', 'Find A Pest-Control Cleaner At Your Home'),
(10, '10.jpg', 'Computer-Repairing', 'Find A Computer/Laptop Repairing Specialist'),
(11, '11.jpg', 'Car-Cleaning', 'Find A Car-Washing Near You '),
(12, '12.jpg', 'AC-Repairing', 'Find A Ac-Repairing Specialist '),
(13, '13.jpg', 'Home-Cleaner', 'Find A Home Cleaner Near You'),
(14, '14.jpg', 'Refregeratore-Specialist', 'Find For Repaire Your  Refregeratore'),
(16, '16.jpg', 'Hair-Artist', 'Find A Hair-Artist Near You'),
(17, '17.webp', 'All-Rounder', 'Books All Rounder Near You');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `firstname`, `lastname`, `email`, `phone`, `comment`) VALUES
(1, 'harmesh', 'devdhariya', 'harmeshdevdhari', 7863018932, 'hello find worker'),
(2, 'vijay', 'chauhan', 'ruchit@gmail.co', 9510461351, 'hello find worker this is the best plateform ever'),
(3, 'sandip', 'chavda', 'sandip@gmail.co', 1234567898, 'Hey ! FIND WORKER your plateform is such a great !'),
(4, 'sandip', 'chavda', 'sandip@gmail.co', 1234567898, 'Hey ! FIND WORKER your plateform is such a great !'),
(5, 'sandip', 'chavda', 'sandip@gmail.co', 1234567898, 'Hey ! FIND WORKER your plateform is such a great !');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider`
--

CREATE TABLE `serviceprovider` (
  `id` int(11) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `city` varchar(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `servicetype` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `experience` int(2) NOT NULL,
  `language` varchar(25) NOT NULL,
  `educationlevel` varchar(25) NOT NULL,
  `rupeecharge` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceprovider`
--

INSERT INTO `serviceprovider` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `gender`, `city`, `image`, `servicetype`, `description`, `experience`, `language`, `educationlevel`, `rupeecharge`) VALUES
(1, 'ruchit', 'kardani', 'ruchitkardani@gmail.com', '2003', 9510500107, 'M', 'Ahmedabad', '1.jpg', 'Agriculture', 'hii i am specialist for the agriculture', 5, 'Hindi,English,Gujarati', 'bachelors-degree', 50000),
(2, 'harmesh', 'devdhariya', 'harmeshdevdhariya04@gmail.com', '1212', 7863018932, 'M', 'Ahmedabad', '2.jpg', 'Furniture', 'hii i am specialist for the furnicture work', 5, 'Hindi,English,Gujarati', 'bachelors-degree', 60000),
(3, 'vijay', 'ghodadra', 'vijay@gmail.com', '1212', 5124369870, 'M', 'Ahmedabad', '3.jpg', 'Plumber', 'hii i am experienced for this work ', 8, 'Hindi,English,Gujarati', 'masters-degree', 40000),
(4, 'haskmukh', 'vaja', 'haskmukh@gmail.com', '1212', 5124369870, 'M', 'Ahmedabad', '4.jpg', 'Construction', 'hii i am experienced person into the construction', 2, 'Hindi,English,Gujarati', 'bachelors-degree', 20000),
(5, 'jayesh', 'malam', 'jayesh@gmail.com', '1212', 9510500107, 'M', 'Ahmedabad', '5.jpg', 'Painter', 'hii i am the master into painting.', 3, 'Hindi,English,Gujarati', 'bachelors-degree', 90000),
(6, 'yagnik', 'chudasma', 'yagnik@gmail.com', '1212', 5124369870, 'M', 'Ahmedabad', '6.jpg', 'Electrician', 'hii i am electrician', 1, 'Hindi,English,Gujarati', 'doctorate', 30000),
(7, 'jaydip', 'sagarka', 'jaydip@gmail.com', '1212', 9510500103, 'M', 'Ahmedabad', '7.jpg', 'Driver', 'hii i am experienced driver', 4, 'Hindi,English,Gujarati', 'high-school-diploma', 23000),
(8, 'avan', 'vadariya', 'avan@gmail.com', '1212', 9510500107, 'M', 'Ahmedabad', '8.jpg', 'Tiles/Marbels', 'hii i am professional worker on the siramic field', 3, 'Hindi,English,Gujarati', 'doctorate', 32000),
(9, 'ruchit', 'ladani', 'rladani@gmail.com', '1212', 9510500103, 'M', 'Surat', '9.jpg', 'Agriculture', 'hii i am agricultue worker', 7, 'Hindi,English,Gujarati', 'bachelors-degree', 12500),
(10, 'dvarkesh', 'vadariya', 'vadariya@gmail.com', '1212', 9510500107, 'M', 'Vadodara', '10.jpg', 'Agriculture', 'hii i am specialist for the agriculture', 2, 'Hindi,English,Gujarati', 'doctorate', 54000),
(11, 'kamy', 'ladani', 'kamy@gmail.com', '1212', 5124369870, 'M', 'Somanath', '11.jpg', 'Agriculture', 'hii i am specialist for the agriculture', 6, 'Hindi,English,Gujarati', 'bachelors-degree', 12000),
(12, 'swati', 'devdhariya', 'swatu@gmail.com', '1212', 7863018932, 'M', 'Vadodara', '12.jpg', 'Furniture', 'hii i am experienced in furniture work', 3, 'Hindi,English,Gujarati', 'doctorate', 12300),
(13, 'sarvesh', 'hinsu', 'sarvesh@gmail.com', '1212', 7863018932, 'M', 'Gandhinaga', '13.jpg', 'Pest-Control', 'hii i am full time specialist in pest-control', 5, 'Hindi,English,Gujarati', 'bachelors-degree', 4000),
(14, 'manav', 'girnara', 'manav@gmail.com', '1212', 9510500107, 'M', 'Bhavnagar', '14.jpg', 'Car-Cleaning', 'hii i am expert into the car-cleaning', 2, 'Hindi,English,Gujarati', 'bachelors-degree', 20000),
(15, 'param', 'vaja', 'param@gmail.com', '1212', 5124369870, 'M', 'Amreli', '15.jpg', 'AC-Repairing', 'hii i am the expert in as repairing', 3, 'Hindi,English,Gujarati', 'masters-degree', 50000),
(16, 'sona', 'devdhariya', 'sona@gmail.com', '1212', 7863018932, 'F', 'Gandhinaga', '16.jpg', 'Hair-Artist', 'i am the hair specialist', 2, 'Hindi,English,Gujarati', 'masters-degree', 12000),
(17, 'deep', 'delvadiya', 'deep@gmail.com', '1212', 5124369870, 'M', 'Bhavnagar', '17.jpg', 'Refregeratore-Specialist', 'hii i am the refregeratore specialist', 8, 'Hindi,English,Gujarati', 'high-school-diploma', 32100),
(18, 'shyam', 'rupareliya', 'shyam@gmail.com', '1212', 9510500107, 'M', 'Junagadh', '18.jpg', 'All-Rounder', 'hii i am the all rounder on the field', 4, 'Hindi,English,Gujarati', 'doctorate', 80000),
(19, 'deep', 'sarvaiya', 'dsarvaiya@gmail.com', '1212', 9510500103, 'M', 'Surat', '19.jpg', 'Furniture', 'hii i am the expert on the furniture work', 4, 'Hindi,English,Gujarati', 'bachelors-degree', 21500),
(20, 'mitanshu', 'bharda', 'mitanshu@gmail.com', '1212', 7863018932, 'M', 'Jamnagar', '20.jpg', 'Construction', 'hiii i am the contract base constructor', 2, 'Hindi,English,Gujarati', 'doctorate', 52000),
(21, 'meet', 'dodiya', 'meet@gmail.com', '1212', 5124369870, 'M', 'Vadodara', '21.jpg', 'Construction', 'hii i am the expert on the constuctor', 9, 'Hindi,English,Gujarati', 'masters-degree', 24000),
(22, 'ayush', 'nandaniya', 'ayush@gmail.com', '1212', 9510500107, 'M', 'Jamnagar', '22.jpg', 'Painter', 'hii i am the specialist on the painting', 4, 'Hindi,English,Gujarati', 'high-school-diploma', 20000),
(23, 'kripal', 'sisodiya', 'kripal@gmail.com', '1212', 7863018932, 'M', 'Junagadh', '23.jpg', 'Furniture', 'hii i am the expert on the furniture work', 2, 'Hindi,English,Gujarati', 'bachelors-degree', 31000),
(24, 'darshan', 'kardani', 'dk@gmail.com', '1212', 5124369870, 'M', 'Bhavnagar', '24.jpg', 'Furniture', 'hii i am the expert in furniture work', 6, 'Hindi,English,Gujarati', 'bachelors-degree', 14500),
(25, 'bhavik', 'kardani', 'bhavik@gmail.com', '1212', 9510500103, 'M', 'Somanath', '25.jpg', 'Painter', 'hii i am the expert painter', 3, 'Hindi,English,Gujarati', 'doctorate', 30000),
(26, 'vishal', 'vachani', 'vishal@gmail.com', '1212', 5124369870, 'M', 'Gandhinaga', '26.jpg', 'Plumber', 'hii i am specialist in the plumber work', 7, 'Hindi,English,Gujarati', 'masters-degree', 20000),
(27, 'khush', 'sodha', 'khush@gmail.com', '1212', 7863018932, 'M', 'Amreli', '27.jpg', 'Construction', 'hii i am the contract base constructor', 2, 'Hindi,English,Gujarati', 'bachelors-degree', 50000),
(28, 'kinjal', 'kamani', 'kinjal@gmail.com', '1212', 5124369870, 'F', 'Vadodara', '28.jpg', 'Electrician', 'hii i am the specialist on the electric field', 1, 'Hindi,English,Gujarati', 'bachelors-degree', 13000),
(29, 'hardik', 'butani', 'hardik@gmail.com', '1212', 5124369870, 'M', 'Junagadh', '29.jpg', 'Hair-Artist', 'hii i am the hair specialist', 2, 'Hindi,English,Gujarati', 'masters-degree', 51500),
(30, 'jenish', 'tank', 'jenish@gmail.com', '1212', 7863018932, 'M', 'Junagadh', '30.jpg', 'Furniture', 'hii i am the furniture specialist', 3, 'Hindi,English,Gujarati', 'high-school-diploma', 10500),
(31, 'heet', 'butani', 'heet@gmail.com', '1212', 9510500107, 'M', 'Surat', '31.jpg', 'Painter', 'hiii i am the expert on the painting', 1, 'Hindi,English,Gujarati', 'doctorate', 22000),
(32, 'viral', 'mehta', 'viral@gmail.com', '1212', 9510500103, 'M', 'Gandhinaga', '32.jpg', 'Agriculture', 'hii i am the expert on the agriculture field', 8, 'Hindi,English,Gujarati', 'bachelors-degree', 14500),
(33, 'jeet', 'kamani', 'jeet@gmail.com', '1212', 9510500103, 'M', 'Somanath', '33.jpg', 'Furniture', 'hii i am the specialist on the furniture', 1, 'Hindi,English,Gujarati', 'masters-degree', 35000),
(34, 'haru', 'shrma', 'haru@gmail.com', '1212', 9510500103, 'M', 'Ahmedabad', '34.jpg', 'Electrician', 'hii i am the expert on the electrical field', 2, 'Hindi,English,Gujarati', 'bachelors-degree', 16000),
(35, 'vasu', 'gami', 'vasu@gmail.com', '1212', 9510500103, 'M', 'Bhavnagar', '35.jpg', 'Home-Cleaner', 'hii i am specialist on home-cleaner', 2, 'Hindi,English,Gujarati', 'masters-degree', 41000),
(36, 'milan', 'vadhiya', 'minal@gmail.com', '1212', 9510500107, 'M', 'Ahmedabad', '36.jpg', 'All-Rounder', 'hii i am the all-rounder', 5, 'Hindi,English,Gujarati', 'doctorate', 80400),
(37, 'tirth', 'bhalodiya', 'tirth@gmail.com', '1212', 7863018932, 'M', 'Junagadh', '37.jpg', 'AC-Repairing', 'hii i am expert on the ac-reparing', 1, 'Hindi,English,Gujarati', 'primary schools completio', 10000),
(38, 'umang', 'savaniya', 'umang@gmail.com', '1212', 7863018932, 'M', 'Gandhinaga', '38.jpg', 'Driver', 'hii i am experienced driver', 5, 'Hindi,English,Gujarati', 'bachelors-degree', 50200),
(39, 'daya', 'gupta', 'daya@gmail.com', '1212', 9510500103, 'F', 'Jamnagar', '39.jpg', 'Agriculture', 'hii i am experienced on the agriculture ', 3, 'Hindi,English,Gujarati', 'high-school-diploma', 31200),
(40, 'yagnik', 'jadav', 'yjadav@gmail.com', '1212', 9510500107, 'M', 'Bhavnagar', '40.jpg', 'Refregeratore-Specialist', 'hii i am the refregeratore specialist', 2, 'Hindi,English,Gujarati', 'masters-degree', 20300),
(41, 'sukhdev', 'sarvaiya', 'sukhdev@gmail.com', '1212', 786301893, 'M', 'Ahmedabad', '', 'Agriculture', 'fsfsdfsdf', 42, 'Hindi,English,Gujarati', 'primary schools completio', 4444),
(42, 'milap', 'devdharuaya', 'milap@gmail.com', '1212', 1234567890, 'M', 'Ahmedabad', 'IMG_20231112_201125.jpg', 'Agriculture', 'fsfsf', 42, 'Hindi,English,Gujarati', 'technical-training', 4444),
(43, 'bhagu', 'fsfsd', 'bhagu@gmail.com', '1212', 786301893, 'M', 'Ahmedabad', '', 'Agriculture', 'wffefsfsdf', 42, 'Hindi,English,Gujarati', 'primary schools completio', 4444);

-- --------------------------------------------------------

--
-- Table structure for table `servicetaker`
--

CREATE TABLE `servicetaker` (
  `id` int(11) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `city` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicetaker`
--

INSERT INTO `servicetaker` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `gender`, `city`, `image`) VALUES
(1, 'ruchit', 'kardani', 'ruchitkardani@gmail.com', '2003', 9510500107, 'M', 'Ahmedabad', '1.jpg'),
(2, 'harmesh', 'devdhariya', 'harmeshdevdhariya04@gmail.com', '1212', 7863018932, 'M', 'Ahmedabad', '2.jpg'),
(3, 'vijay', 'ghodadra', 'vijay@gmail.com', '1212', 5124369870, 'M', 'Ahmedabad', '3.jpg'),
(4, 'haskmukh', 'vaja', 'haskmukh@gmail.com', '1212', 5124369870, 'M', 'Ahmedabad', '4.jpg'),
(5, 'jayesh', 'malam', 'jayesh@gmail.com', '1212', 9510500107, 'M', 'Ahmedabad', '5.jpg'),
(6, 'yagnik', 'chudasma', 'yagnik@gmail.com', '1212', 5124369870, 'M', 'Ahmedabad', '6.jpg'),
(7, 'jaydip', 'sagarka', 'jaydip@gmail.com', '1212', 9510500103, 'M', 'Ahmedabad', '7.jpg'),
(8, 'avan', 'vadariya', 'avan@gmail.com', '1212', 9510500107, 'M', 'Ahmedabad', '8.jpg'),
(9, 'ruchit', 'ladani', 'rladani@gmail.com', '1212', 9510500103, 'M', 'Surat', '9.jpg'),
(10, 'dvarkesh', 'vadariya', 'vadariya@gmail.com', '1212', 9510500107, 'M', 'Vadodara', '10.jpg'),
(11, 'kamy', 'ladani', 'kamy@gmail.com', '1212', 5124369870, 'M', 'Somanath', '11.jpg'),
(12, 'swati', 'devdhariya', 'swatu@gmail.com', '1212', 7863018932, 'F', 'Vadodara', '12.jpg'),
(13, 'sarvesh', 'hinsu', 'sarvesh@gmail.com', '1212', 7863018932, 'M', 'Gandhinaga', '13.jpg'),
(14, 'manav', 'girnara', 'manav@gmail.com', '1212', 9510500107, 'M', 'Bhavnagar', '14.jpg'),
(15, 'param', 'vaja', 'param@gmail.com', '1212', 5124369870, 'M', 'Amreli', '15.jpg'),
(16, 'sona', 'devdhariya', 'sona@gmail.com', '1212', 7863018932, 'F', 'Gandhinaga', '16.jpg'),
(17, 'deep', 'delvadiya', 'deep@gmail.com', '1212', 5124369870, 'M', 'Bhavnagar', '17.jpg'),
(18, 'shyam', 'rupareliya', 'shyam@gmail.com', '1212', 9510500107, 'M', 'Junagadh', '18.jpg'),
(19, 'deep', 'sarvaiya', 'dsarvaiya@gmail.com', '1212', 9510500103, 'M', 'Surat', '19.jpg'),
(20, 'mitanshu', 'bharda', 'mitanshu@gmail.com', '1212', 7863018932, 'M', 'Jamnagar', '20.jpg'),
(21, 'meet', 'dodiya', 'meet@gmail.com', '1212', 5124369870, 'M', 'Vadodara', '21.jpg'),
(22, 'ayush', 'nandaniya', 'ayush@gmail.com', '1212', 9510500107, 'M', 'Jamnagar', '22.jpg'),
(23, 'kripal', 'sisodiya', 'kripal@gmail.com', '1212', 7863018932, 'M', 'Junagadh', '23.jpg'),
(24, 'darshan', 'kardani', 'dk@gmail.com', '1212', 5124369870, 'M', 'Bhavnagar', '24.jpg'),
(25, 'bhavik', 'kardani', 'bhavik@gmail.com', '1212', 9510500103, 'M', 'Somanath', '25.jpg'),
(26, 'vishal', 'vachani', 'vishal@gmail.com', '1212', 5124369870, 'M', 'Gandhinaga', '26.jpg'),
(27, 'khush', 'sodha', 'khush@gmail.com', '1212', 7863018932, 'M', 'Amreli', '27.jpg'),
(28, 'kinjal', 'kamani', 'kinjal@gmail.com', '1212', 5124369870, 'M', 'Vadodara', '28.jpg'),
(29, 'hardik', 'butani', 'hardik@gmail.com', '1212', 5124369870, 'M', 'Junagadh', '29.jpg'),
(30, 'jenish', 'tank', 'jenish@gmail.com', '1212', 7863018932, 'M', 'Junagadh', '30.jpg'),
(31, 'heet', 'butani', 'heet@gmail.com', '1212', 9510500107, 'M', 'Surat', '31.jpg'),
(32, 'viral', 'mehta', 'viral@gmail.com', '1212', 9510500103, 'M', 'Gandhinaga', '32.jpg'),
(33, 'jeet', 'kamani', 'jeet@gmail.com', '1212', 9510500103, 'M', 'Somanath', '33.jpg'),
(34, 'haru', 'shrma', 'haru@gmail.com', '1212', 9510500103, 'M', 'Ahmedabad', '34.jpg'),
(35, 'vasu', 'gami', 'vasu@gmail.com', '1212', 9510500103, 'M', 'Bhavnagar', '35.jpg'),
(36, 'milan', 'vadhiya', 'minal@gmail.com', '1212', 9510500107, 'M', 'Ahmedabad', '36.jpg'),
(37, 'tirth', 'bhalodiya', 'tirth@gmail.com', '1212', 7863018932, 'M', 'Junagadh', '37.jpg'),
(38, 'umang', 'savaniya', 'umang@gmail.com', '1212', 7863018932, 'M', 'Gandhinaga', '38.jpg'),
(39, 'daya', 'gupta', 'daya@gmail.com', '1212', 9510500103, 'M', 'Jamnagar', '39.jpg'),
(40, 'abhijit', 'shrma', 'abhijit@gmail.com', '1212', 9510500107, 'M', 'Surat', '40.jpg'),
(41, 'yagnik', 'jadav', 'yjadav@gmail.com', '1212', 9510500107, 'M', 'Bhavnagar', '41.jpg'),
(42, 'bhagu', 'fsfsd', 'bhagu@gmail.com', '1212', 786301893, 'M', 'Ahmedabad', '42.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_ibfk_1` (`service_provider_id`),
  ADD KEY `bookings_ibfk_2` (`service_taker_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider`
--
ALTER TABLE `serviceprovider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicetaker`
--
ALTER TABLE `servicetaker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `serviceprovider`
--
ALTER TABLE `serviceprovider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `servicetaker`
--
ALTER TABLE `servicetaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `serviceprovider` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_taker_id`) REFERENCES `servicetaker` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
