
--
-- Database: `demo` and php web application user
CREATE DATABASE college;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON college.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE college;
--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `telNo` int(11) NOT NULL,
  `dob` DATE NOT NULL,
  `file_name` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `students` (`id`, `name`, `telNo`, `dob`) VALUES
(1, 'Roland Mendel', 1234567890, '1993-11-11'),
(2, 'Victoria Ashworth', 1345678901, '1994-10-10'),
(3, 'Martin Blank', 1562347895, '1995-09-09');

