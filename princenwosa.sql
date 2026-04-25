
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `loginname` varchar(255) NOT NULL,
  `loginpwd` varchar(255) NOT NULL,
  `dateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `loginname`, `loginpwd`, `dateUpdated`) VALUES
(1, 'admin', '4461f92fdd0fe6ca048f5c5e1b402a56', '2025-09-24 18:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articleID` int NOT NULL,
  `articleTitle` varchar(100) NOT NULL,
  `articleDesc` longtext NOT NULL,
  `articleURL` mediumtext,
  `previewPhoto` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_photos`
--

CREATE TABLE `article_photos` (
  `photoID` int NOT NULL,
  `articleID` int NOT NULL,
  `photoName` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `bookID` int NOT NULL,
  `bookTitle` varchar(100) DEFAULT NULL,
  `bookDesc` longtext NOT NULL,
  `publishedYear` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bookAuthor` int NOT NULL,
  `coAuthors` varchar(100) DEFAULT NULL,
  `bookURL` varchar(100) DEFAULT NULL,
  `bookCover` varchar(150) NOT NULL,
  `freeBook` varchar(155) DEFAULT NULL,
  `phyical_path` varchar(255) NOT NULL,
  `pagesNumber` int DEFAULT NULL,
  `fileSize` varchar(15) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `bookTitle`, `bookDesc`, `publishedYear`, `bookAuthor`, `coAuthors`, `bookURL`, `bookCover`, `freeBook`, `phyical_path`, `pagesNumber`, `fileSize`, `dateUpdated`) VALUES
(1, ' managing projects successfully', '<p>The Book:</p><p><b>Managing Projects Successfully: Efficient Strategies for HighImpact Delivery</b> is more than a project management guide—its a masterclass in realworld project delivery across industries, regions, and multisector</p><p>Drawing from over 25 years of practical experience managing complex, highprofile projects around the world, Dr Prince N Nwosa offers a handson roadmap to achieving project success</p><p>Through compelling insights, relatable case studies, and actionable strategies, this book dives deep into the real reasons projects fail—and more importantly, what it takes to make them succeed</p><p>Whether you are leading a mega construction project, developing an oil and gas facility, rolling out an IT solution, or managing a manufacturing expansion, you’ll discover proven tools to deliver sustainable results—on time, within budget, and with lasting value</p><p>Managing Projects Successfully: Efficient Strategies for HighImpact Delivery is your essential guide to navigating leadership challenges, stakeholder complexities, and the unpredictable realities of project environments</p><p>If you are ready to drive meaningful, impactful projects—this book will show you how</p><p><br></p>', '2025', 1, '', '-managing-projects-successfully', 'b3a827b0d0a0c287d30bb02b99100dd9.png', '9e53e9b7862100a53d5650cb7b2c1ed8.pdf', 'https://www.princenwosa.com/app/freeBook/', 34, '142.3 kb', '2025-05-12 12:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `authorID` int NOT NULL,
  `academicTitle` varchar(10) DEFAULT NULL,
  `authorName` varchar(30) NOT NULL,
  `authorBio` longtext NOT NULL,
  `authorPhoto` varchar(255) DEFAULT NULL,
  `ln` varchar(50) DEFAULT NULL,
  `fb` varchar(50) DEFAULT NULL,
  `tw` varchar(50) DEFAULT NULL,
  `other` varchar(50) DEFAULT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`authorID`, `academicTitle`, `authorName`, `authorBio`, `authorPhoto`, `ln`, `fb`, `tw`, `other`, `dateUpdated`) VALUES
(1, 'dr', 'Prince N. Nwosa', '<p>Prince Nwosa (Ph.D) is a distinguished project management expert with over 25 years of experience delivering successful projects across Africa, the Middle East, Europe, and the United States.</p><p>He has led and supported major project initiatives in oil and gas, construction, energy, and technology sectors, earning a reputation for excellence in project delivery, leadership, and stakeholder management.</p><p>Dr. Nwosa is a graduate of Boston University in Boston, Massachusetts, USA  the University of Salford in Greater Manchester, United Kingdom  and University College Birmingham, among other notable academic institutions.</p><p>He is a certified Project Management Professional (PMP) by the Project Management Institute (PMI), USA, and a Chartered Member of the CIPMN.</p><p>Blending academic rigor with real-world practical experience, Dr. Nwosa has dedicated his career to bridging the gap between theory and practice, mentoring professionals, fostering capacity development, and empowering multinational organizations to deliver sustainable projects successfully.</p><p>Managing Projects Successfully: Efficient Strategies for High-Impact Delivery is a reflection of his professional commitment to excellence, impact, and leadership in the project management profession.</p>', '7d93810745ea21b22f1b36f854a3181a.png', '', '', '', '', '2025-04-25 10:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `book_lunching`
--

CREATE TABLE `book_lunching` (
  `lunchID` int NOT NULL,
  `bookTitle` varchar(30) DEFAULT NULL,
  `bookDesc` longtext NOT NULL,
  `luncDate` date NOT NULL,
  `lunchVenue` varchar(70) NOT NULL,
  `bookCover` varchar(150) NOT NULL,
  `flyerDesign` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `reviewID` int NOT NULL,
  `bookID` int DEFAULT NULL,
  `reviewedBy` varchar(100) NOT NULL,
  `otherDetails` varchar(100) DEFAULT NULL,
  `reviewText` longtext NOT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filelink`
--

CREATE TABLE `filelink` (
  `linkID` int NOT NULL,
  `bookID` int NOT NULL,
  `random_string` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `filelink`
--

INSERT INTO `filelink` (`linkID`, `bookID`, `random_string`, `expiry`) VALUES
(1, 15, 'e8551e4f56f903e937202d4bcb9c515a', '2025-04-21 11:23:00'),
(2, 15, '660dcc606648f9e313844172bd61b7e2', '2025-04-21 11:24:00'),
(3, 15, '67af2aec5c24fcc1e2ad9ea8baf8e5fa', '2025-04-21 11:14:00'),
(4, 15, '674d63e61c16684b734ec1ea838bc854', '2025-04-21 12:34:00'),
(5, 1, 'f19153310cec11e3aa1e824c7e9713b2', '2025-04-26 10:37:00'),
(6, 1, '4a55725511fcebb947490a48eae204b2', '2025-12-26 02:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `image_gallery`
--

CREATE TABLE `image_gallery` (
  `photoID` int NOT NULL,
  `eventTitle` varchar(150) DEFAULT NULL,
  `foto` varchar(150) NOT NULL,
  `dateUpdated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image_gallery`
--

INSERT INTO `image_gallery` (`photoID`, `eventTitle`, `foto`, `dateUpdated`) VALUES
(1, 'Academic Photos', 'e3de583dd371f49de28c403e87a00a9e.jpg', '2025-04-29 17:51:45'),
(2, 'Academic Photos', '46057a5d44ffb9190ea902441814a2ce.jpg', '2025-04-29 17:51:45'),
(3, 'Academic Photos', '7c0bb6da2580497b709b478e292e2469.jpg', '2025-04-29 17:51:45'),
(4, 'Academic Photos', '82341a6c6f03e3af261a95ba81050c0a.jpg', '2025-04-29 17:51:45'),
(5, 'Academic Photos', '9e75a89ca4bf3c8a45e59fc112d98c56.jpg', '2025-04-29 17:51:45'),
(6, 'Academic Photos', '653f3fcd32b2901991a25841b7e08ab7.jpg', '2025-04-29 17:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `listID` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`listID`, `name`, `email`, `dateUpdated`) VALUES
(1, 'SirBen', 'akawuben@gmail.com', '2025-04-14 12:24:50'),
(2, 'Benjamin Akawu', 'akawuben@gmail.com', '2025-04-14 12:28:56'),
(3, 'admin', 'admin@gmail.com', '2025-04-15 09:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` varchar(17) DEFAULT NULL,
  `messageSubject` varchar(60) NOT NULL,
  `message` mediumtext,
  `contactDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `readDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `IsRead` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indexes for table `image_gallery`
--
ALTER TABLE `image_gallery`
  ADD PRIMARY KEY (`photoID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`listID`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article_photos`
--
ALTER TABLE `article_photos`
  MODIFY `photoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `authorID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_lunching`
--
ALTER TABLE `book_lunching`
  MODIFY `lunchID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_review`
--
ALTER TABLE `book_review`
  MODIFY `reviewID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filelink`
--
ALTER TABLE `filelink`
  MODIFY `linkID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `image_gallery`
--
ALTER TABLE `image_gallery`
  MODIFY `photoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `listID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
