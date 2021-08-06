-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 05:05 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a4rbookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `publishyear` varchar(10) NOT NULL,
  `count` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `descpt` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `slug`, `title`, `author`, `isbn`, `publishyear`, `count`, `cost`, `image`, `descpt`) VALUES
(1, 'creating-on-purpose', 'Creating on Purpose', 'Lion Goodman, Anodea Judith', '9781604078527', '2012', '45', '17.95', '610914494e124.jpg', 'With Creating on Purpose, innovative teachers Anodea Judith and Lion Goodman present a comprehensive, systematic method for realizing your highest aspirations. Shared with thousands in their popular nationwide workshops, this unique, step-by-step approach guides us through a rich study of the inner self, the outer world, and how to connect the two to make your dreams come true.'),
(2, 'bitcoin-and-blockchain-basic', 'Bitcoin and Blockchain Basic', 'Arthur T. Brooks', '2940163556410', '2019', '49', '3.99', '610914cf8db1e.jpg', 'This book will explain the basics of Blockchain Technology and Cryptocurrency in an easy to understand format. No technical jargon is used, and no previous experience is required. You will find clear and concise guidance on exactly how to buy, store, invest and trade with Bitcoin.'),
(3, 'education-in-a-time-between-worlds', 'Education in a Time Between Worlds', 'Zachary Stein', '9780986282676', '2019', '49', '24.00', '6109151c69128.jpg', 'Education in a Time Between Worlds seeks to reframe this historical moment as an opportunity to create a global society of educational abundance. Educational systems must be transformed beyond recognition if humanity is to survive the planetary crises currently underway. Human development and learning must be understood as the Earth\'s most valuable resources, with human potential serving as the open frontier into which energy and hope can begin to flow.'),
(4, 'edtech', 'Edtech for the K-12 Classroom', ' Iste Staff, Diana Fingal', '9781564846938', '2018', '50', '39.99', '6109158452fec.jpg', 'Edtech for the K-12 Classroom is designed to empower current and future teachers to use technology effectively in their classrooms and schools. Meant to supplement or replace edtech textbooks, this ebook introduces ways teachers can leverage technology for ongoing, just-in-time professional development while offering a deep understanding of the ISTE Standards, a roadmap for how to transform education with technology.'),
(5, 'better-off', 'Better Off', 'Eric Bende', '9780060570057', '2005', '50', '14.99', '610915d5be63f.jpg', 'Better Off is the story of their real-life experiment to see whether our cell phones, wide-screen TVs, and SUVs have made life easier — or whether life would be preferable without them. This smart, funny, and enlightening book mingles scientific analysis with the human story to demonstrate how a world free of technological excess can shrink stress — and waistlines — and expand happiness, health, and leisure.'),
(6, 'idisorder', 'iDisorder', 'Larry D. Rosen', '9781137000361', '2012', '50', '12.99', '61091612830fd.jpg', 'Rosen offers solid, proven strategies to help us overcome the iDisorder we all feel in our lives while still making use of all that technology offers. Our world is not going to change, and technology will continue to penetrate society even deeper leaving us little chance to react to the seemingly daily additions to our lives. Rosen teaches us how to stay human in an increasingly technological world'),
(7, 'make-it-real', 'Make It Real', 'Art Bardige', 'Rosen offers solid, proven strategies to help us overcome the iDisorder we all feel in our lives whi', '2019', '50', '58.20', '6109165576e18.jpg', 'What if technology could revolutionize education as it has communication, manufacturing, and business, making schools more effective, efficient, and relevant? What if digital learning could double the number of college graduates at half the cost enabling most of our kids to thrive in the digital age? What if the discovery that our math curriculum, was designed in the year 1202 could lead us to reinvent math education for the 21st century and envision the future of education? What if the simple act of making schools and tests open-web, with the internet tools we have at hand, could transform what as well as how we learn?'),
(8, 'on-the-edge-of-reality', 'On The Edge of Reality', 'J. Allen Hynek and Jacques Vallée', '9780809282098', '1975', '50', '17.99', '6109168e46a50.jpg', 'Join Colin and Synthia as they explore what is beyond this door. Examine the multitude of current changes--from the bases of society to the foundations of science--that indicate the unfolding of a new paradigm. Investigate non-ordinary reality and unexplained phenomena as interactions of consciousness.'),
(9, 'steam-kids', 'Steam Kids', ' Anne Carey', '9781537372044', '2016', '50', '24.99', '610916c5c77cd.jpg', 'year\'s worth of captivating STEAM (Science, Technology, Engineering, Art & Math) activities that will wow the boredom right out of kids!'),
(10, 'swipe-to-unlock', 'Swipe to Unlock', 'Aditya Agashe, Neel Mehta, and Parth Detroja', '9781976182198', '2017', '50', '26.79', '610916f050a14.jpg', 'This #1 Amazon Business Bestseller won a medal from the North American Book Awards and has been featured in The Wall Street Journal, Forbes, and Business Insider. Swipe to Unlock has been translated into 11 languages including Chinese, Korean, & Russian and was touted as \"our generation\'s Rosetta Stone for enabling anyone to peer into the technology changing everyday life\" by Jeremy Schifeling.'),
(11, 'the-earth-has-a-soul', 'The Earth has a Soul', 'Carl Jung', '9781556433795', '2002', '50', '18.95', '6109171d824e4.jpg', 'While never losing sight of the rational, cultured mind, Jung speaks for the natural mind, source of the evolutionary experience and accumulated wisdom of our species. Through his own example, Jung shows how healing our own living connection with Nature contributes to the whole.'),
(12, 'the-naval-war-of-1812', 'The Naval War of 1812', 'Theodore Roosevelt', '9788026878285', '2017', '50', '0.99', '6109177ba198f.jpg', 'The Naval War of 1812, written by the former president Theodore Roosevelt, deals with battles and naval technology used during the War of 1812 between the United States and the Great Britain. Roosevelt\'s history is considered as one of the best on this particular topic and it had a great impact on the formation of the modern day U.S. Navy. At the beginning, the author gives the insight of the political and social conditions in Great Britain and America prior to the war. Roosevelt, then, discusses the naval war on both the Atlantic Ocean and the Great Lakes. Finally, the last chapter covers the Battle of New Orleans, the final major battle of the War of 1812.'),
(13, 'the-widow', 'The Widow', 'Fiona Barton', '9781101990476', '2017', '50', '17.00', '61091819b39eb.jpg', 'Troubled marriages have always proven to be great fodder for psychological thrillers — Fiona Barton’s debut novel, The Widow, is a perfect illustration of this. When her husband was suspected of a twisted crime, Jean stood by him, filling the dark spaces of their marriage with the façade of being a dutiful and perfect wife. But now, with her husband dead, there’s no longer a reason to stay quiet about the secrets she’s held … and the lies she’s told herself.'),
(14, 'those-bones-are-not-my-child', 'Those Bones are not my Child', 'Toni Cade Bambara', '9780679774082', '2000', '49', '24', '61091869c79bf.jpg', 'Published posthumously, Toni Cade Bambara’s final novel, Those Bones Are Not My Child, is described as her magnum opus by her editor and close friend Toni Morrison. Inspired by the tragic rampage of Atlanta serial killer Wayne Williams — who James Baldwin’s The Evidence of Things Not Seen also examines — Those Bones Are Not My Child unfolds with the disappearance of a twelve-year-old boy and his mother’s tireless search to find him. Throughout the pages of the novel, Bambara envelops readers into the mindset of a community turned upside down by violence and grief. From beginning to end, Bambara’s words simultaneously offer her audience a heartrending portrayal of a family altered by tragedy and an unflinching excavation of America’s past. As poignant as ever, Those Bones Are Not My Child is a compelling and urgent story about love, justice, and loss.'),
(15, 'the-shining', 'The Shining', 'Stephen King', '9780345806789', '2013', '50', '17.95', '610943ae07b54.jpg', 'While Carrie and Salem’s Lot introduced Stephen King as a writer to watch, The Shining firmly situated him as one of his generation’s preeminent voices in horror literature. The Shining was King’s first hardcover bestseller and it made him the household name he is today. King’s story of a troubled man’s slow descent into madness while serving as the winter caretaker of an isolated and haunted hotel makes The Shining a truly unsettling, unforgettable thriller'),
(16, 'the-girl-on-the-train', 'The Girl On The Train', 'Paula Hawkins', '9780399588877', '2016', '50', '16.00', '610943ea5505b.jpg', 'In Paula Hawkins’ The Girl on the Train, the emotionally fraught Rachel Watson wrestles with her obsessive feelings for her ex-husband. As she tries to heal after their relationship dissolves, Rachel manages to sift through her thoughts and fears during her daily commute via train from Oxfordshire to London. Each day during the trek, the train passes the house she used to live in with her ex. In attempts to distract herself from the reality of their separation, Rachel shifts her attention to a home near her former home, occupied by a man and a woman who she imagines are happy and deeply in love. When the woman goes missing and her disappearance becomes fodder for the local tabloids, Rachel’s life is turned upside down. An exhilarating glimpse into one woman’s inability to cope with the past, The Girl on the Train articulates a distressing truth about violence and love.'),
(17, 'strangers', 'Strangers', 'Dean Koontz', '9780425181119', '2002', '50', '8.99', '6109443fac522.jpg', 'After over two decades in the trenches of sci-fi and horror fiction, Koontz earned his first hardcover bestseller with 1986’s Strangers, which revolves around a band of individuals who find themselves drawn to a motel in the Nevada desert from thousands of miles apart, united in an escalating sense of terror which manifests differently in each of them. This page-turner signifies the moment when Koontz announced himself to the mainstream as an indisputable authority on the art of building suspense.'),
(18, 'gone-girl', 'Gone Girl', 'Gillian Flynn', '9780307588371', '2014', '50', '17', '6109447d5cbf1.jpg', 'Gillian Flynn has made a name for herself with incredibly dark, twisting narratives centered on complex, seemingly unsympathetic female characters. With Gone Girl, Flynn brought readers deep inside a narrative hall of mirrors — a slow burn, noir-tinged maze built to keep the reader constantly off-balance.The story of Nick and Amy’s courtship, crumbling marriage, and Amy’s eventual disappearance is an extraordinary exercise in literary sleight-of-hand. It’s nearly impossible to put down until the final devastating page.'),
(19, 'enduring-love', 'Enduring Love', 'Ian McEwan', '9780385494144', '1998', '10', '15.95', '610944bad882e.jpg', 'In one of the most disturbing opening scenes in literature, two men are thrown together as part of a makeshift rescue team when a little boy is carried off in a runaway hot air balloon. But things only get more disturbing from there, when Jed becomes obsessed with Joe, his fellow rescuer. Based on a true story, McEwan’s penchant for detail and flair for obsession makes Enduring Love a perverse reverse-love story.'),
(20, 'eileen', 'Eileen', 'Ottessa Moshfegh', '9780143128755', '2016', '10', '16.00', '610944f224af0.jpg', 'Otessa Moshfegh’s chilling and award-winning novel is a somber yet mesmerizing successor to the works of literary titans like Shirley Jackson and Flannery O’Connor. At the end of the opening chapter, Moshfegh’s protagonist, who works as a counselor at a juvenile correctional facility for teen boys, reveals the conceit of the novel in an unnervingly straightforward way: “This is the story of how I disappeared.” Moshfegh’s prose possesses a similar directness, each sentence reaching for the jugular of its reader. Gritty, grim, and notably haunting, Eileen holds a mirror up to the darkness that exists inside of each of us and does so without apology. As beautiful as it is alarming, this novel is more than a thriller. It’s a meditation on humanity.'),
(21, 'dead-letters', 'Dead Letters', 'Caite Dolan-Leach', '9780399588877', '2018', '50', '16.00', '6109453378634.jpg', 'On the heels of her twin sister Zelda’s death, Ava leaves Paris to return to her hometown in New York. As she helps her parents plan Zelda’s funeral, Ava starts to question the details surrounding her sister’s death, which only multiply when she starts getting emails and DMs from the supposedly deceased Zelda. As Ava’s strange correspondence with her sister continues, she discovers that her twin faked her death as an attempt to escape a mountain of debt that she accrued due to substance abuse. Armed with clues to where her sister might be, Ava embarks on a journey that will change her life. Caite Dolan-Leach’s striking debut is an unpredictable examination of sisterhood, secrets, and intimacy.'),
(22, 'cuckoo-nest', 'One Flew Over the Cuckoo’s Nest', 'Ken Kesey', '9780670023233', '2012', '50', '28.00', '610945d1d09d4.jpg', 'Inspired in part by his experiences in the 1950s as an orderly in a mental health facility, Kesey’s novel left permanent scorch-marks on the American conscience, and as a result has been continually challenged in schools and libraries ever since. His anti-hero Randle McMurphy (played by Oscar-winner Jack Nicholson in the inevitable film adaptation) confronts institutional oppression head-on, and Kesey’s electric prose makes a strong case for the neglect of our inmate populations as a reflection on our society at large.'),
(23, 'house-of-leaves', 'House of Leaves', ' Mark Z. Danielewski', '9780375703768', '2000', '50', '19.49', '6109462e8d2bd.jpg', 'Put simply, House of Leaves is one of the most frightening books ever written. From a fairly standard horror premise (a house is revealed to be slightly larger on the inside than is strictly possible) Danielewski spins out a dizzying tale involving multiple unreliable narrators, typographic mysteries, and looping footnotes that manage to drag the reader into the story and then make them doubt their own perception of that story. It’s a trick no one else has managed to such dramatic effect, making this novel more of a participatory experience than any other work of literature—which, considering the dark madness at its core, isn’t necessarily a pleasant experience.'),
(24, 'lord-of-the-flies', 'Lord of The Flies', 'William Golding', '9780399501487', '2003', '10', '8.99', '61094670393b4.jpg', 'The great sage Pat Benatar once sang that hell is for children. Golding’s account of children stranded on an island without supplies or adult supervision is absolutely terrifying for one simple reason: there’s nothing supernatural going on. It’s a story about insufficiently socialized humans descending into savagery because that’s our fundamental nature. You look into the abyss at the center of this novel and the abyss looks back.'),
(25, 'rosemarys-baby', 'Rosemarys Baby', ' Ira Levin', '9780330021159', '1967', '50', '15.95', '610949f75263c.jpg', 'Rosemary\'s Baby is one of the greatest movies of the late 1960s and one of the best of all horror movies, an outstanding modern Gothic tale. An art-house fable and an elegant popular entertainment, it finds its home on the cusp between a cinema of sentiment and one of sensation. Michael Newton\'s study of the film traces its development at a time when Hollywood stood poised between the old world and the new, its dominance threatened by the rise of TV and cultural change, and the roles played variously by super producer Robert Evans, the film\'s producer William Castle, director Polanski and its stars including Mia Farrow and John Cassavetes.\n\nNewton\'s close textual analysis explores the film\'s meanings and resonances, and, looking beyond the film itself, he examines its reception and cultural impact, and its afterlife, in which Rosemary\'s Baby has become linked with the terrible murder of Polanski\'s wife and unborn child by members of the Manson cult, and with controversies surrounding the director.'),
(26, 'the-haunting-of-hill-house', 'The Haunting of Hill House', 'Shirley Jackson', '9780143039983', '1952', '10', '13.99', '61094a4579eef.jpg', 'When you think about clichés in horror fiction, the haunted house is at the top of the list, an idea done so often it’s frequently an unintentional parody. Shirley Jackson, however, was no ordinary writer, and she takes the concept of the haunted house and perfects it. The Haunting of Hill House is simply the best haunted house story ever written. The scares come not just from the malevolent actions of a house that seems sentient and angry, but from the claustrophobia we experience from the novel’s unreliable narrator, Eleanor, whose descent into madness is slow and excruciating and only begins after we’ve been lulled into a false sense of security by the seeming relatability of her early persona.'),
(27, 'we-need-to-talk-about-kevin', 'We Need to Talk About Kevin', 'Lionel Shriver', '9780062119049', '2011', '10', '14.99', '61094a8d3be1f.jpg', 'Another story centered on the terror of children, the horror inherent in this story comes from the fact that the human beings we create eventually become their own people—and possibly strangers to us. Not everyone has a close and loving relationship with their parents, and while the idea that your own kids might grow up to be criminals isn’t pleasant, most people assume they will at least recognize themselves in their kids. But what if you don’t? What if your child—your child—is a blank monster?'),
(28, 'hench', 'Hench:A Novel', ' Natalie Zina Walschots', '9780062978578', '2020', '10', '27.99', '61094ad273cd1.jpg', 'The Boys meets My Year of Rest and Relaxation in this smart, imaginative, and evocative novel of love, betrayal, revenge, and redemption, told with razor-sharp wit and affection, in which a young woman discovers the greatest superpower—for good or ill—is a properly executed spreadsheet.'),
(29, 'only-good-indians', 'Only Good Indians', 'Stephen Graham Jones', '9781982136451', '2020', '10', '26.99', '61094b04e0dc8.jpg', 'From USA TODAY bestselling author Stephen Graham Jones comes a “masterpiece” (Locus Magazine) of a novel about revenge, cultural identity, and the cost of breaking from tradition. Labeled “one of 2020’s buzziest horror novels” (Entertainment Weekly), this is a remarkable horror story that “will give you nightmares—the good kind of course” (BuzzFeed).'),
(30, 'harrow-the-ninth', 'Harrow the Ninth(The Locked Tomb Trilogy#2)', 'Tamsyn Muir', '9781250313225', '2020', '10', '26.99', '61094b4c9e5a1.jpg', 'Harrow the Ninth, an Amazon pick for Best SFF of 2020 and the New York Times and USA Today bestselling sequel to Gideon the Ninth, turns a galaxy inside out as one necromancer struggles to survive the wreckage of herself aboard the Emperor\'s haunted space station.'),
(31, 'piranesi', 'Piranesi', 'Susanna Clarke', '9781635575637', '2020', '20', '27.00', '61094b7c1cdb0.jpg', 'From the New York Times bestselling author of Jonathan Strange & Mr Norrell, an intoxicating, hypnotic new novel set in a dreamlike alternative reality.'),
(32, 'if-it-bleeds', 'If It Bleeds', 'Stephen King', '9781982137977', '2020', '10', '30.00', '61094bb015b2b.jpg', 'From #1 New York Times bestselling author, legendary storyteller, and master of short fiction Stephen King comes an extraordinary collection of four new and compelling novellas—Mr. Harrigan’s Phone, The Life of Chuck, Rat, and the title story If It Bleeds—each pulling you into intriguing and frightening places.'),
(33, 'the-resisters', 'The Resisters:A Novel', ' Gish Jen', '9780525657217', '2020', '5', '26.95', '61094bfa79e54.jpg', 'The provocative, moving, and paradoxically buoyant story of one family struggling to maintain their humanity in circumstances that threaten their every value.  '),
(34, 'sleep-donation', 'Sleep Donation(Vintage Contemporaries)', 'Karen Russell', '9780525566083', '2020', '15', '16.00', '61094c3f4b3b1.jpg', 'For the first time in paperback, a haunting novella from the uncannily imaginative author of the national bestsellers Swamplandia! and Orange World: the story of a deadly insomnia epidemic and the lengths one woman will go to to fight it.'),
(35, 'the-city-we-became', 'The City We Became: A Novel(The Great Cities Trilogy #1)', 'N. K. Jemisin', '9780316509848', '2020', '5', '28.00', '61094c7928f24.jpg', 'Three-time Hugo Award-winning and New York Times bestselling author N.K. Jemisin crafts her most incredible novel yet, a \"glorious\" story of culture, identity, magic, and myths in contemporary New York City.'),
(36, 'zed', 'Zed:A Novel', 'Joanna Kavenna', '9780385545471', '2020', '18', '27.95', '61094cb0e9713.jpg', 'From the winner of the Orange Award for New Writing comes a blistering, satirical novel about life under a global media and tech corporation that knows exactly what we think, what we want, and what we do—before we do.'),
(37, 'the-invisible-life', 'The Invisible Life of Addie LaRue', ' V. E. Schwab', '9780765387561', '2020', '15', '26.99', '61094cdfbeeee.jpg', 'In the vein of The Time Traveler’s Wife and Life After Life, The Invisible Life of Addie LaRue is New York Times bestselling author V. E. Schwab’s genre-defying tour de force.\n\nA Life No One Will Remember. A Story You Will Never Forget.\n');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE `orderhistory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderhistory`
--

INSERT INTO `orderhistory` (`id`, `user_id`, `book_id`, `qty`, `date`) VALUES
(1, 7, 1, 1, '2021-08-04'),
(2, 7, 1, 1, '2021-08-04'),
(3, 7, 1, 1, '2021-08-04'),
(4, 7, 1, 1, '2021-08-05'),
(5, 7, 14, 1, '2021-08-05'),
(6, 7, 3, 1, '2021-08-05'),
(7, 7, 1, 1, '2021-08-05'),
(8, 7, 2, 1, '2021-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ordercode` int(11) NOT NULL,
  `line1` varchar(200) NOT NULL,
  `line2` varchar(200) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `user_id`, `order_id`, `ordercode`, `line1`, `line2`, `city`, `state`) VALUES
(8, 7, 4, 8075, '123', ' ', '123', '132'),
(9, 7, 5, 6014, '123', '123', '11113333', '1113332222'),
(10, 7, 6, 6014, '123', '123', '11113333', '1113332222'),
(11, 7, 7, 329, '123', '132', '132', '132'),
(12, 7, 8, 329, '123', '132', '132', '132');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `name`, `email`, `number`, `password`) VALUES
(2, 'admin', 'admin', 'admin@admin.com', '984356', '21232f297a57a5a743894a0e4a801fc3'),
(7, 'user', 'shrijal', 'shrijal@gmail.com', '9843564504', '24a3fa841d6b2a7bc1f17bf1cdb92864');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
