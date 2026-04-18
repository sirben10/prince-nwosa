-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 01:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `princenwosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `loginname` varchar(255) NOT NULL,
  `loginpwd` varchar(255) NOT NULL,
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `loginname`, `loginpwd`, `dateUpdated`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2025-04-08 14:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articleID` int(11) NOT NULL,
  `articleTitle` varchar(100) NOT NULL,
  `articleDesc` longtext NOT NULL,
  `articleURL` mediumtext DEFAULT NULL,
  `previewPhoto` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleID`, `articleTitle`, `articleDesc`, `articleURL`, `previewPhoto`, `dateUpdated`) VALUES
(1, 'calabar municipal lions club empowers young minds through reading action program -rap-', 'On the 4th of February nthe Calabar Municipal Lions Club successfully carried out its Reading Action Program (RAP) Project at Sugarland Montessori School, inspiring young learners through the power of books and storytellingThe event featured engaging reading sessions, storytelling, and interactive Q&amp A segments, all anchored by Lion Dr Emmanuel Adams The pupils actively participated, fostering a love for reading and literacyAs part of the clubâ€™s commitment to education, writing materials were donated to the pupils, ensuring they have the tools to continue their learning journeyThe project was graced by the presence of Lion Emana Otu, Chairperson, Region 5, and Lion (Mbonka) Tina Effiok, District RAP Coordinator, whose support and leadership contributed to the success of the initiativeKudos to the Calabar Municipal Lions Club for promoting literacy and lifelong learning!', 'calabar-municipal-lions-club-empowers-young-minds-through-reading-action-program--rap-', 'cd51ae52680f1c7d34da9a1d506ccc54.jpg', '2025-04-12 12:27:35'),
(2, 'the best way to predict the future is to build it', 'No matter where you stand on the various political, social, geographical, and economic divides facing us, it’s hard to ignore the waves of doom and gloom It’s time for a bit of optimism and a reminder that we do have the power to invent, build, and shape the futureTo help foster that sense of assurance and add a dose of optimism, we’re serializing the audio and eBook of “A Brief History of a Perfect Future: Inventing the World We Can Proudly Leave Our Kids by 2050” by Paul Carroll, Tim Andrews, and me You can find the first part here, and all subsequent parts each week at my Future Perfect NewsletterWe are fortunate to have inherited the immense creativity and incredible tools developed by those who came before us It’s our responsibility to build a world we can proudly leave to our children and their childrenHappy reading and listening Please help spread the optimism by sharing it with others and writing an Amazon reader reviewThank You!', 'the-best-way-to-predict-the-future-is-to-build-it', '5f9870c880aa17719320c313556d83ec.png', '2025-04-15 11:03:58'),
(3, 'region 7 lions combat hunger with compassion', 'In a remarkable display of community spirit, Lions Clubs of Region 7 embarked on a Hunger Relief Project, bringing sustenance and hope to individuals and families struggling to make ends meetThe Region Chairperson, Lion Elder Emmanuel Jacobs, led the team of Lions and Leos in distributing essential food items across two different locations According to Lion Jacobs, this selfless initiative addressed the pressing issue of hunger, fostering a sense of community and social responsibilityLion Jacobs pledged to continue this magnitude of selfless service every month, demonstrating the Lions unwavering dedication to creating a better world, one act of kindness at a timeOne of the beneficiaries in Ikot Udoma, Eket, Akwa Ibom State, overwhelmed with gratitude, thanked the Lions for providing relief when there seemed to be none I had no hope of feeding my two children this weekend, the beneficiary said tearfully', 'region-7-lions-combat-hunger-with-compassion', 'e2d40c649bb03a385ecd009c999b80a2.jpg', '2025-04-15 16:27:56'),
(4, 'port harcourt new garden city lions club - hunger relief', 'On the 7th September, 2024, Port Harcourt New Garden City Lions Club in partnership with the Oro Mgba Royal Women s Meeting Association, carried out a Hunger Relief Project in Rumurolu community Obio Akpor LGA Rivers State 100 households received various food items The traditional ruler of the community, HRH Eze Dr GN Chukumgba JP gave his support to the project by providing the venue, his palace &amp security He &amp his wife were made honorary members of Port Harcourt New Garden City Lions Club', 'port-harcourt-new-garden-city-lions-club---hunger-relief', '131d13f9238bfdec6709e4c5eca42bdf.jpg', '2025-04-15 16:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `article_photos`
--

CREATE TABLE `article_photos` (
  `photoID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `photoName` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article_photos`
--

INSERT INTO `article_photos` (`photoID`, `articleID`, `photoName`, `dateUpdated`) VALUES
(1, 1, 'f469e17255fdf9777e16ac32747af4e2.jpg', '2025-04-12 12:27:35'),
(2, 1, 'a0e4aa2e401bc6432c26ae9bf0479de4.jpg', '2025-04-12 12:27:35'),
(3, 1, '697ee26626067d416aa7df089e2e5d0b.png', '2025-04-12 12:27:35'),
(4, 2, '5805c85d632adcc0fdf996cbb5de11b8.jpg', '2025-04-15 11:03:58'),
(5, 2, '7c2c0d95e1b46ea9fbd5ae7e83ac18f2.jpg', '2025-04-15 11:03:58'),
(6, 2, 'b8ab7f2a51c7921da3fb2e2ef6e1c0aa.jpg', '2025-04-15 11:03:58'),
(7, 3, '5f9870c880aa17719320c313556d83ec.png', '2025-04-15 16:27:56'),
(8, 3, 'f469e17255fdf9777e16ac32747af4e2.jpg', '2025-04-15 16:27:56'),
(9, 3, 'a0e4aa2e401bc6432c26ae9bf0479de4.jpg', '2025-04-15 16:27:56'),
(10, 4, 'f9e5b6d0b4a5054a40f70d937cebf04f.jpg', '2025-04-15 16:30:48'),
(11, 4, '5f9870c880aa17719320c313556d83ec.png', '2025-04-15 16:30:48'),
(12, 4, '5805c85d632adcc0fdf996cbb5de11b8.jpg', '2025-04-15 16:30:48'),
(13, 4, '7c2c0d95e1b46ea9fbd5ae7e83ac18f2.jpg', '2025-04-15 16:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `bookTitle` varchar(100) DEFAULT NULL,
  `bookDesc` longtext NOT NULL,
  `publishedYear` varchar(10) NOT NULL,
  `bookAuthor` int(11) NOT NULL,
  `coAuthors` varchar(100) DEFAULT NULL,
  `bookURL` varchar(100) DEFAULT NULL,
  `bookCover` varchar(150) NOT NULL,
  `freeBook` varchar(155) DEFAULT NULL,
  `phyical_path` varchar(255) NOT NULL,
  `pagesNumber` int(11) DEFAULT NULL,
  `fileSize` varchar(15) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `bookTitle`, `bookDesc`, `publishedYear`, `bookAuthor`, `coAuthors`, `bookURL`, `bookCover`, `freeBook`, `phyical_path`, `pagesNumber`, `fileSize`, `dateUpdated`) VALUES
(8, 'Successfully Managing Projects', '“Delightedly fresh, insightful and downright useful This is the best business book I’ve read in very many years It absolutely nails how to and how not to innovate”', '2025', 1, '', 'Successfully-Managing-Projects', 'cd51ae52680f1c7d34da9a1d506ccc54.jpg', '1f4973ddee270e832e8e31b5a27f0519.pdf', 'C:/xampp/htdocs/princenwosa/bookCover/', 66, '964.5 kb', '2025-04-14 14:59:00'),
(9, 'shigidi and the brass head of obalufon', 'From the boisterous streets of Lagos to the rooftop bars of Singapore and the secret spaces of London, the former nightmare god Shigidi and his sortof succubus lover Nneoma encounter strange creatures, rival gods and manipulative magicians as they are drawn into a spectacular heist that will take them to the very heart of the British Museum', '2025', 1, '', 'shigidi-and-the-brass-head-of-obalufon', 'e0e8908a4f63b346ce85e500b56aca1e.jpg', '1f4973ddee270e832e8e31b5a27f0519.pdf', 'C:/xampp/htdocs/princenwosa/bookCover/', 66, '964.5 kb', '2025-04-16 10:23:59'),
(10, 'incomplete solutions', 'From the bustling streets of Lagos to the icy moons of Jupiter, this debut collection of twenty stories from the vivid imagination of the awardwinning Wole Talabi explores what it means to be human in a world of accelerating technology, diverse beliefs, and unlimited potential, from a uniquely Nigerian perspective', '2024', 1, '', 'incomplete-solutions', '153fca6a06cafef561815d04137f085c.jpg', '88491fad5e0bc2749e5212ea758d4b63.pdf', 'C:/xampp/htdocs/princenwosa/bookCover/', 98, '1.3393 mb', '2025-04-16 10:27:28'),
(11, 'convergence problems', 'From the Hugo, Nebula, Locus and Nommo award nominated author of&nbspShigidi and The Brass Head Of Obalufon&nbspcomes a stunning new collection of stories that investigate the rapidly changing role of technology and belief in our lives as we search for meaning, for knowledge, for justice constantly converging on our future selves', '2022', 1, '', 'convergence-problems', '28dba008251e2b1cdbdc48487bfe630b.jpg', '396e4692e98b2180213453a9aa441c3d.pdf', 'C:/xampp/htdocs/princenwosa/bookCover/', 66, '4.1901 mb', '2025-04-16 10:32:40'),
(12, 'dear ijeawele, or a feminist manifesto in fifteen suggestions', 'From the bestselling author of Americanah and We Should All Be Feminists comes to a powerful new statement about feminism today—written as a letter to a friendHere are fifteen invaluable suggestions–compelling, direct, wryly funny, and perceptive–for how to empower a daughter to become a strong, independent woman Offering advice such as teaching a young girl to read widely and recognize the role of language in reinforcing unhealthy cultural norms encouraging her to choose a helicopter, and not only a doll, as a toy if she so desires having open conversations with her about appearance, identity, and sexuality and debunking the myths that women are somehow biologically designed to be in the kitchen, and that men can “allow” women to have full careers, Dear Ijeawele goes right to the heart of sexual politics in the twentyfirst century It will start a new and urgently needed conversation about what it really means to be a woman todayDear Ijeawele, Or a Feminist Manifesto in Fifteen Suggestions is licensed for publication in 19 languages', 'March 2024', 1, '', 'dear-ijeawele,-or-a-feminist-manifesto-in-fifteen-suggestions', 'd43f52cd9ee96dca705be8b62117c892.jpg', '4fb5404f503ee528f6843f4f7bba40f0.pdf', 'C:/xampp/htdocs/princenwosa/bookCover/', 66, '230.7 kb', '2025-04-16 11:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `authorID` int(11) NOT NULL,
  `academicTitle` varchar(10) DEFAULT NULL,
  `authorName` varchar(30) NOT NULL,
  `authorBio` longtext NOT NULL,
  `authorPhoto` varchar(255) DEFAULT NULL,
  `ln` varchar(50) DEFAULT NULL,
  `fb` varchar(50) DEFAULT NULL,
  `tw` varchar(50) DEFAULT NULL,
  `other` varchar(50) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`authorID`, `academicTitle`, `authorName`, `authorBio`, `authorPhoto`, `ln`, `fb`, `tw`, `other`, `dateUpdated`) VALUES
(1, 'dr', 'Prince N. Nwosa', '<p style= font-family: &quot Open Sans&quot , sans-serif  text-rendering: optimizelegibility  line-height: 26px  font-size: 15px  color: rgb(85, 85, 85)  -webkit-font-smoothing: antialiased !important  >before retiring from active service has been a Secondary School Biology Teacher, Block Extension Supervisor, Akwa Ibom Agriculture Development Programe, Member - Food and Nutrition Committee, Ministry of Health-Akwa lbom State, Agric Officer- Oil Palm Development Unit-Ministry of Agriculture - Akwa Ibom State, Schedule officer, Rubber Unit -Ministry of Agriculture - Akwa Ibom State, Pioneer Scheme Manager-Akwa Ibom State Integrated Farmers Scheme, Coordinator Akwa Ibom State Community Plantation Development Scheme, Secretary Presidential Initiative on Cocoa Development, Senior Special Assistant, Corporate Matters South-South Zone, Force Headquarters, Abuja.</p><p style= font-family: &quot Open Sans&quot , sans-serif  text-rendering: optimizelegibility  line-height: 26px  font-size: 15px  color: rgb(85, 85, 85)  -webkit-font-smoothing: antialiased !important  >Currently he is the Chairman, Uyo Area Command of Police Community Relation Committee,(PCRC) Akwa Ibom State. A retired Permanent Secretary, Akwa Ibom State Universal Basic Education Board. Member: Nigerian Institute of Management, National Agricultural Society of Nigeria and Allied Matters.</p>', '7d93810745ea21b22f1b36f854a3181a.png', '', '', '', '', '2025-04-09 16:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `book_lunching`
--

CREATE TABLE `book_lunching` (
  `lunchID` int(11) NOT NULL,
  `bookTitle` varchar(30) DEFAULT NULL,
  `bookDesc` longtext NOT NULL,
  `luncDate` date NOT NULL,
  `lunchVenue` varchar(70) NOT NULL,
  `bookCover` varchar(150) NOT NULL,
  `flyerDesign` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_lunching`
--

INSERT INTO `book_lunching` (`lunchID`, `bookTitle`, `bookDesc`, `luncDate`, `lunchVenue`, `bookCover`, `flyerDesign`, `dateUpdated`) VALUES
(1, 'Successfully Managing Projects', 'Effective Strategies for High Impact Delivery', '2025-05-03', 'golden tulip hotel port harcourt', 'b3a827b0d0a0c287d30bb02b99100dd9.png', 'cd51ae52680f1c7d34da9a1d506ccc54.jpg', '2025-04-10 15:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `book_review`
--

CREATE TABLE `book_review` (
  `reviewID` int(11) NOT NULL,
  `bookID` int(11) DEFAULT NULL,
  `reviewedBy` varchar(100) NOT NULL,
  `otherDetails` varchar(100) DEFAULT NULL,
  `reviewText` longtext NOT NULL,
  `dateUpdated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_review`
--

INSERT INTO `book_review` (`reviewID`, `bookID`, `reviewedBy`, `otherDetails`, `reviewText`, `dateUpdated`) VALUES
(2, 8, 'benjamin akawu', '', '\"Prose as lush as the Nigerian landscape that it powerfully evokesAdichies understanding of a young girls heart is so acute that her story ultimately rises above its setting and makes her little part of Nigeria seem as close and vivid as Eudora Weltys Mississippi\"', '2025-04-17 15:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `filelink`
--

CREATE TABLE `filelink` (
  `linkID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `random_string` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filelink`
--

INSERT INTO `filelink` (`linkID`, `bookID`, `random_string`, `expiry`) VALUES
(4, 8, '8f409bb7112d14949da96bf7261efd84', '2025-04-14 20:22:53'),
(6, 5, '9c23a21f9906d9edfd40d788fde4708d', '2025-04-15 17:51:53'),
(7, 8, '1b0a5d1c0e9d8c1d533eeefa1971f839', '2025-04-17 11:51:15'),
(8, 8, 'cdd3c2ca4de8ec35f0adcdd5f0a3e3f4', '2025-04-17 11:51:38'),
(9, 8, '65cf5217bb7f1b3297d9e8df6d11aa66', '2025-04-17 11:53:05'),
(10, 8, 'b45bd21633146c381c6c83d40309cb93', '2025-04-17 11:53:19'),
(11, 8, '5942d963460190808e32968949a31c9a', '2025-04-17 11:53:46'),
(12, 8, '9b715a51f94a4994c86a12a4ed098a00', '2025-04-17 11:54:19'),
(13, 8, '9d65932abf43de1e29163fc86563ad7a', '2025-04-17 11:57:53'),
(14, 8, '1c9bfaf96f6c527338a07091cec8556a', '2025-04-17 12:00:46'),
(15, 8, '89f66c7cbb2198de5c4765222e687765', '2025-04-17 12:01:07'),
(16, 8, '1f78d72156b3b8808aa8ec1b51c4cc0f', '2025-04-17 12:01:31'),
(17, 8, '7ce138a16c9349bf6d973ada06c6a0ec', '2025-04-17 12:02:09'),
(18, 8, '96986e5700ef10a0921436e441c73a08', '2025-04-17 12:03:16'),
(19, 8, '2dad52e2dedcb762ae5c3479724ced58', '2025-04-17 12:03:51'),
(20, 8, '451c5d56be46c1618e434f1527f71e10', '2025-04-17 12:05:22'),
(21, 8, '127d3ddfb8fb287d9bfe452b7fb1545c', '2025-04-17 12:06:20'),
(22, 8, 'c4c0cb517681dafeb5eb344f7e05b2af', '2025-04-17 12:11:35'),
(23, 8, '487118310a4a3023b9974930ea59f114', '2025-04-17 12:12:00'),
(24, 8, 'b7f9cd969ae564f9e8c257e40a68d253', '2025-04-17 12:12:42'),
(25, 8, '25ec77b154a4ec80d79b6bf0a8f8ff98', '2025-04-17 12:13:26'),
(26, 8, '7a511455eb835eacc7f974957e61a050', '2025-04-17 12:15:17'),
(27, 8, '712176cdba2cbfc2f098d09408607c21', '2025-04-17 12:29:30'),
(28, 8, 'ceaf363b2fce20d2e3a70636d32d1d6d', '2025-04-17 12:30:26'),
(29, 8, '766447ac77c670bf9fd17af41c08e916', '2025-04-17 12:32:05'),
(30, 8, 'da9e65c496ce4ef609b05d6b970aadfb', '2025-04-17 12:32:55'),
(31, 8, 'b1b540169f4021453f0a7af4f030548f', '2025-04-17 12:34:59'),
(32, 11, '082261fbde999f013475c70946055d04', '2025-04-17 12:36:42'),
(33, 9, '67b9ac36b4353d01f357d90abdeb16df', '2025-04-17 12:40:02'),
(34, 8, '5244b8cba9505fd7f250a6e05dd8a1a1', '2025-04-17 12:42:01'),
(35, 11, '2761888041d21afdf862bb4d44f61578', '2025-04-17 12:45:38'),
(36, 11, 'd6d0a432277e0493bc352d6450bdc4f0', '2025-04-17 12:46:57'),
(37, 11, 'e8f0c9f2524f70c5323dc0a28a485883', '2025-04-17 12:51:23'),
(38, 9, '0d164cbe3dff456d1f18c8b92be187f0', '2025-04-17 12:53:12'),
(39, 8, '492276416c5a37e13d33a967bca4549b', '2025-04-17 12:54:42'),
(40, 8, '9574a39bb6b41907f774bfd407215c2b', '2025-04-17 12:58:25'),
(41, 11, '273be720aa57541bc8b2989c44c7f773', '2025-04-17 13:01:07'),
(42, 8, '78fbd853071b324fa6741ebdffbad8d5', '2025-04-17 13:03:00'),
(43, 8, 'd297f4c13447ae7e60ebe9390c636392', '2025-04-17 13:05:09'),
(44, 11, '2257ea7818edee624a4daff44dba583b', '2025-04-17 13:06:40'),
(45, 11, '52aa596b8cce92b6992b67d90955de9b', '2025-04-17 13:11:08'),
(46, 11, 'e0c901be72e081ae22b519027358a3d8', '2025-04-17 13:13:31'),
(47, 9, 'f6ca834d66b21d00d650bb6e0309b1bd', '2025-04-17 13:14:37'),
(48, 8, '3bdb5b4abef390b4f476819ba9a92a1a', '2025-04-17 13:16:04'),
(49, 8, '5b546abeb473c45400f1d25f3c151e68', '2025-04-17 13:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `listID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`listID`, `name`, `email`, `dateUpdated`) VALUES
(1, 'SirBen', 'akawuben@gmail.com', '2025-04-14 12:24:50'),
(2, 'Benjamin Akawu', 'akawuben@gmail.com', '2025-04-14 12:28:56'),
(3, 'admin', 'admin@gmail.com', '2025-04-15 09:59:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleID`);

--
-- Indexes for table `article_photos`
--
ALTER TABLE `article_photos`
  ADD PRIMARY KEY (`photoID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`authorID`);

--
-- Indexes for table `book_lunching`
--
ALTER TABLE `book_lunching`
  ADD PRIMARY KEY (`lunchID`);

--
-- Indexes for table `book_review`
--
ALTER TABLE `book_review`
  ADD PRIMARY KEY (`reviewID`);

--
-- Indexes for table `filelink`
--
ALTER TABLE `filelink`
  ADD PRIMARY KEY (`linkID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`listID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `article_photos`
--
ALTER TABLE `article_photos`
  MODIFY `photoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `authorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_lunching`
--
ALTER TABLE `book_lunching`
  MODIFY `lunchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_review`
--
ALTER TABLE `book_review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filelink`
--
ALTER TABLE `filelink`
  MODIFY `linkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `listID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
