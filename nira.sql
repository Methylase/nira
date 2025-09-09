-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2025 at 07:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nira`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `type`, `title`, `description`, `image`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Travel', 'Travel Adventure to lebanon', 'Lebanon travel adventure is on of the most fascinating travel adventure that most people find interesting, because of the tourism attraction in that country.', 'phpFB9F.tmp.jpg', NULL, 1, '2025-07-29 11:58:25', '2025-08-07 11:26:00'),
(2, 'Food', 'Tofu: The Plant-Based Protein Powerhouse', 'Tofu, also known as bean curd, is a versatile and nutritious food made from condensed soy milk that\'s pressed into soft white blocks. Originating in China over 2,000 years ago, tofu is celebrated for its high protein content, mild flavor, and ability to absorb spices and sauces. It\'s a staple in vegetarian and vegan diets and can be grilled, stir-fried, blended, or baked, making it a go-to ingredient for both savory and sweet dishes.', 'php3374.tmp.jpg', 'delete', 1, '2025-07-29 12:08:48', '2025-07-29 14:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` int(10) UNSIGNED NOT NULL,
  `carousel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carousels`
--

INSERT INTO `carousels` (`id`, `carousel`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 'php164C.tmp.jpg', 1, 5, '2025-03-11 07:02:10', '2025-03-11 07:02:10'),
(2, 'phpC1AA.tmp.jpg', 1, 7, '2025-03-11 13:15:22', '2025-03-11 13:15:22'),
(3, 'php867B.tmp.jpg', 2, 8, '2025-04-09 13:03:55', '2025-04-09 13:03:55'),
(4, 'phpC1AA.tmp.jpg', 1, 9, '2025-04-10 12:41:10', '2025-04-10 12:41:10'),
(5, 'phpB32.tmp.jpg', 1, 12, '2025-04-10 13:19:33', '2025-04-10 13:19:33'),
(6, 'phpB32.tmp.jpg', 1, 1, '2025-04-07 07:24:29', '2025-04-13 07:24:29'),
(7, 'phpC1AA.tmp.jpg', 1, 1, '2025-04-14 07:52:21', '2025-04-14 07:52:21'),
(8, 'php867B.tmp.jpg', 2, 9, '2025-07-07 10:31:11', '2025-07-07 10:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `content`, `email`, `blog_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Adebola Farogbon', 'What a nice writeup', 'adefarogbon@yahoo.com', 1, NULL, '2025-07-31 06:05:37', '2025-07-31 06:05:37'),
(2, 'Dayo Amusa', 'Hmm, it is a nice writeup', 'dayoamusa@yahoo.com', 1, 1, '2025-07-31 06:46:45', '2025-07-31 06:46:45'),
(4, 'Awoniyi Abiola', 'This a great writeup', 'awoniyiabiola@gmail.com', 1, NULL, '2025-07-31 07:45:14', '2025-07-31 07:45:14'),
(5, 'Dayo Amusa', 'great', 'dayoamusa@yahoo.com', 1, 4, '2025-07-31 07:49:01', '2025-07-31 07:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
('Biola Alawiye', 'biola_alawiye@gmail.com', 'Awesome Experience', 'gggggg', '2025-07-07 12:59:10', '2025-07-07 12:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `contact_agents`
--

CREATE TABLE `contact_agents` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `property_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_agents`
--

INSERT INTO `contact_agents` (`id`, `name`, `email`, `comment`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 'Biola Alawiye', 'biola_alawiye@gmail.com', 'I am interested in this property', 1, 9, '2025-07-08 06:20:35', '2025-07-08 06:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'emails', '{\"uuid\":\"1053aa38-c6c0-415e-8708-dfb21bc6ef24\",\"displayName\":\"App\\\\Jobs\\\\SendAdminMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendAdminMail\",\"command\":\"O:22:\\\"App\\\\Jobs\\\\SendAdminMail\\\":9:{s:5:\\\"email\\\";s:20:\\\"methyl2007@yahoo.com\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";s:6:\\\"emails\\\";s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1744198752, 1744198752);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2024_01_20_112234_create_roles_table', 1),
(5, '2024_01_20_112954_create_role_user_table', 1),
(6, '2024_02_03_174757_create_profiles_table', 1),
(7, '2025_02_05_094043_create_jobs_table', 1),
(8, '2025_02_27_085732_create_blogs_table', 1),
(10, '2025_02_27_092750_create_contacts_table', 1),
(11, '2025_02_27_093128_create_properties_table', 1),
(12, '2025_03_01_144054_create_testimonials_table', 1),
(13, '2025_03_10_072238_create_carousels_table', 1),
(20, '2025_07_28_085825_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hobbies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localG` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `profile_image`, `firstname`, `middlename`, `lastname`, `marital_status`, `gender`, `phone_number`, `dob`, `hobbies`, `address_1`, `address_2`, `city`, `state`, `localG`, `country`, `postalCode`, `description`, `facebook`, `twitter`, `instagram`, `linkedin`, `user_id`) VALUES
(1, 'phpE9AF.tmp.jpg', 'Deola', 'Adunni', 'Sage', 'single', 'female', '08188373898', '1982-02-16', 'singing', '12 adeojo street', '', 'Ikeja', 'Lagos State', 'Ikeja', 'Nigeria', '10001', 'I am a very hardworking person, that push boundaries', 'https://fb.com/deolasage', 'https://x.com/deolasage', 'https://instagram.com/deolasage', 'https://linkedin.com/deolasage', 1),
(2, 'phpCDE4.tmp.jpg', 'Mutiu', 'Dayo', 'Adeoye', 'single', 'male', '08188373898', '1982-07-11', 'Coding and reading educative books', '20 Adeosinowo street', '', 'Ikeja', 'Lagos State', 'Ikeja', 'Nigeria', '100001', 'I like to code and play an adventurous game', '', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baths` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localG` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenities` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `garage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `address`, `amount`, `area`, `bed`, `baths`, `state`, `localG`, `postalCode`, `type`, `description`, `status`, `amenities`, `garage`, `image`, `video`, `map`, `delete_status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '203 Savage drive', '3000000', '345', '3', '3', 'Lagos State', 'Ikeja', '100001', 'house', 'clean property', 'sale', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\"}', '3', 'php5896.tmp.jpg', NULL, 'eeeeeeeeeeeee', 'delete', 1, '2025-03-10 14:19:11', '2025-07-05 14:08:42'),
(2, '101B Chevron, Lekki', '3000000', '600', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'house', 'Newly Built 5 Bedroom Duplex – Chevron, Lekki\r\nModern detached home with high end finishes.\r\n₦800 million ⋅ Chevron, Lekki, Lagos', 'sale', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"deck\":\"deck\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"parking\":\"parking\",\"concrete flooring\":\"concrete flooring\"}', '2', 'php3150.tmp.jpg', NULL, 'fffffff', NULL, 1, '2025-03-10 14:22:27', '2025-08-07 08:35:49'),
(3, '311 Kosi dirive', '3000000', '345', '3', '3', 'Lagos State', 'Ifako-Ijaiye', '100001', 'house', 'clean property', 'sale', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"deck\":\"deck\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"parking\":\"parking\",\"sun room\":\"sun room\"}', '4', 'phpFE1D.tmp.jpg', NULL, 'eeeeeeeeeeeee', NULL, 1, '2025-03-11 06:45:41', '2025-03-11 06:45:41'),
(4, '211B 5 Bedroom Detached Duplex – Chevron, Lekki', '600000000', '{600–800)', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'house', '211B Detached luxury duplex with boys’ quarter, water treatment, governor’s consent.\r\nAddress: Chevron, Lekki, Lagos ⋅ Price: ₦600 million', 'rent', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"internet\":\"internet\",\"parking\":\"parking\",\"concrete flooring\":\"concrete flooring\"}', '1', 'phpE9C0.tmp.jpg', NULL, 'fffffffffff', NULL, 1, '2025-03-11 06:53:48', '2025-08-06 19:11:36'),
(5, '411 Lekki Phase 1, Lekki', '500000000', '600', '5', '6', 'Lagos State', 'Ibeju-Lekki', '100001', 'house', '5 Bedroom Duplex – Lekki Phase 1, Lekki\r\nEnsuite bedrooms, reliable power, title documentation.\r\n₦500 million ⋅', 'sale', '{\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"deck\":\"deck\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"parking\":\"parking\",\"sun room\":\"sun room\",\"concrete flooring\":\"concrete flooring\"}', '2', 'php1DCA.tmp.jpg', NULL, 'fffffffffff', NULL, 1, '2025-03-11 07:02:10', '2025-08-07 09:11:47'),
(6, '311B, Cole Street Off Bourdillon Rd, Old Ikoyi', '300000000', '500', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'house', '5 Bedroom Penthouse –  311B, Cole Street Off Bourdillon Rd, Old Ikoyi\r\nUltra lux penthouse with top security and utilities.\r\n₦3,00 million ⋅ Old Ikoyi, Ikoyi, Lagos', 'rent', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"sun room\":\"sun room\",\"concrete flooring\":\"concrete flooring\"}', '1', 'php4120.tmp.jpg', NULL, 'fffffffffff', NULL, 1, '2025-03-11 13:09:52', '2025-08-07 08:20:36'),
(7, '203 Lawson Street Old Ikoyi, Ikoyi, Lagos', '200000000', '345', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'house', '5 Bedroom Detached Duplex with 2 BQ – Old Ikoyi\r\nFull service and serviced living.\r\n₦2,00 million ⋅ Old Ikoyi, Ikoyi, Lagos', 'rent', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"parking\":\"parking\",\"sun room\":\"sun room\",\"concrete flooring\":\"concrete flooring\"}', '2', 'phpE9B8.tmp.jpg', NULL, 'eeeeeeeeeeeee', NULL, 1, '2025-03-11 13:15:22', '2025-08-07 09:55:15'),
(8, '248 Dorothy Way Lekki, Lagos', '450', '500', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'office space', 'Well furnished office space with luxurious facility at the heart center of Lekki, Lagos.', 'rent', '{\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"deck\":\"deck\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"parking\":\"parking\",\"sun room\":\"sun room\",\"concrete flooring\":\"concrete flooring\"}', '1', 'php40E6.tmp.jpg', 'property_videos/1. Leadership – The Emotional Intelligence.mp4', '344', NULL, 2, '2025-04-09 13:03:55', '2025-08-07 15:30:57'),
(9, '223 Briggs Drive Ikate, Lekki, Lagos', '450000000', '600', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'house', '5 Bedroom Detached – Ikate, Lekki\r\nLarge compound home in serene setting.\r\n₦450 million ⋅ Ikate, Lekki, Lagos', 'sale', '{\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"deck\":\"deck\"}', '3', 'phpC6A4.tmp.jpg', 'Simple Queue Service (SQS) Basics - AWS Cloud Computing Tutorial for Beginners.mp4', '333333', NULL, 1, '2025-04-10 12:41:10', '2025-08-07 10:01:39'),
(10, '403 Lane Osapa London, Lekki', '600000000', '(600-700)', '5', '5', 'Lagos State', 'Ibeju-Lekki', '100001', 'office space', 'Office space – Osapa London, Lekki\r\nEnsuite offices, secure parking.\r\n₦600 million ⋅ Osapa London, Lekki, Lagos', 'rent', '{\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"tennis courts\":\"tennis courts\",\"internet\":\"internet\",\"parking\":\"parking\"}', '1', 'phpF339.tmp.jpg', 'Why is it So Hard to Make Decisions.mp4', '333333', NULL, 1, '2025-04-10 12:57:42', '2025-08-07 10:25:52'),
(11, '12A Akin Adesola, Victoria Island, Lagos', '800000000', '1000', '5', '5', 'Lagos State', 'Lagos Island', '100001', 'house', '5 Bedroom Detached Home on 1000 sqm Land – Victoria Island\r\nHuge land plot, sea breeze, lofty ceilings.\r\n₦120 million/year ⋅ Akin Adesola, Victoria Island, Lagos', 'sale', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"tennis courts\":\"tennis courts\"}', '2', 'php9D8C.tmp.jpg', 'Why is it So Hard to Make Decisions.mp4', '333333', NULL, 1, '2025-04-10 13:13:39', '2025-08-07 10:32:04'),
(12, 'Falomo, Ikoyi Lagos', '400000000', '600', '5', '5', 'Lagos State', 'Lagos Island', '100001', 'office space', 'Spacious office , luxurious with domestic staff quarters.\r\n₦500 million/year ⋅ Parkview Estate, Ikoyi,', 'sale', '{\"balcony\":\"balcony\",\"outdoor kitchen\":\"outdoor kitchen\",\"cable tv\":\"cable tv\",\"deck\":\"deck\",\"tennis courts\":\"tennis courts\"}', '1', 'phpECCF.tmp.jpg', 'Why is it So Hard to Make Decisions.mp4', '333333', NULL, 1, '2025-04-10 13:19:32', '2025-08-07 10:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ROLE_ADMIN', 'ROLE ADMIN', '2025-03-10 12:25:35', '2025-03-10 12:25:45'),
(2, 'ROLE_AGENT', 'ROLE AGENT', '2025-03-10 12:25:50', '2025-03-10 12:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-03-10 11:25:06', '2025-03-10 11:25:06'),
(2, 2, 2, '2025-04-09 10:39:06', '2025-04-09 10:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `subject`, `email`, `feedback`, `image`, `created_at`, `updated_at`) VALUES
(43, 'Biola Alawiye', 'Awesome Experience', 'biola_alawiye@gmail.com', 'I will like to thank the management of nira property, buying my house online was so easy and stree-free. The listings were accurate, and I found the perfect home at a great price', 'daniel-alexander-V2vuNvH6OmE-unsplash.jpg', '2025-07-07 01:48:08', '2025-07-07 02:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `check`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'methyl2007', 'methyl2007@gmail.com', 'approved', '2025-04-13 00:58:40', '$2y$10$4t9E4SJ/Hm3kl/WIi2ORxuz94YSUZsCrog6QiWRrubzjvzAn91aAW', NULL, '2025-03-10 11:25:06', '2025-03-10 11:25:06'),
(2, 'Adepoju', 'methyl2007@yahoo.com', 'approved', '2025-04-12 03:02:29', '$2y$10$OJ/ySmT4LA4wnxvTl6l3jOJ93BjVo.hepiORWn/e49tjJVnzdw8dC', NULL, '2025-04-09 10:39:06', '2025-04-12 15:02:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carousels_property_id_foreign` (`property_id`),
  ADD KEY `carousels_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_agents`
--
ALTER TABLE `contact_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_agents`
--
ALTER TABLE `contact_agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carousels`
--
ALTER TABLE `carousels`
  ADD CONSTRAINT `carousels_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carousels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
