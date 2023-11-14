

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `srms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `srms`;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `cid` int(11) NOT NULL,
  `cname` varchar(30) NOT NULL,
  PRIMARY KEY (`cname`),
  UNIQUE KEY `cid` (`cid`),
  KEY `cname` (`cname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`cid`, `cname`) VALUES
(101, 'int440'),
(201, 'int333'),
(301, 'int221');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `name` varchar(30) NOT NULL,
  `rno` int(3) NOT NULL,
  `class` varchar(30) NOT NULL,
  `p1` int(3) NOT NULL,
  `p2` int(3) NOT NULL,
  `p3` int(3) NOT NULL,
  `p4` int(3) NOT NULL,
  `p5` int(3) NOT NULL,
  `marks` int(3) NOT NULL,
  `percentage` int(11) NOT NULL,
  KEY `class` (`class`),
  KEY `name` (`name`,`rno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `rno` int(11) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `class` varchar(30) NOT NULL,
  PRIMARY KEY (`sname`,`rno`),
  KEY `class` (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(10) NOT NULL DEFAULT 'admin',
  `user_id` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `user_id`, `password`) VALUES
('admin', 'admin343', 'abcd'),
('ashish', 'via343', '82786'),
('Ayush', 'ayush343', 'abcd');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `r1` FOREIGN KEY (`class`) REFERENCES `class` (`cname`),
  ADD CONSTRAINT `r2` FOREIGN KEY (`name`, `rno`) REFERENCES `student` (`sname`, `rno`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `s1` FOREIGN KEY (`class`) REFERENCES `class` (`cname`),
  ADD CONSTRAINT `cname2` FOREIGN KEY (`class`) REFERENCES `class` (`cname`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
