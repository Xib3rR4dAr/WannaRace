SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_race`
--
CREATE DATABASE IF NOT EXISTS `db_race` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_race`;

-- --------------------------------------------------------

--
-- Table structure for table `moneyz`
--

CREATE TABLE `moneyz` (
  `balance` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moneyz`
--

INSERT INTO `moneyz` (`balance`) VALUES
(5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_card_vouchers`
--

CREATE TABLE `tbl_card_vouchers` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(4) NOT NULL,
  `is_used` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_card_vouchers`
--

INSERT INTO `tbl_card_vouchers` (`id`, `voucher_no`, `amount`, `is_used`) VALUES
(1, 'aaaaaaaaaaaaaaab', 100, 0),
(2, 'aaaaaaaaaaaaaaac', 100, 0),
(3, 'aaaaaaaaaaaaaaad', 100, 0),
(4, 'aaaaaaaaaaaaaaae', 100, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_card_vouchers`
--
ALTER TABLE `tbl_card_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_card_vouchers`
--
ALTER TABLE `tbl_card_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
