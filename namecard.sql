-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 03:12 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `namecard`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `com_del` (IN `idnya` INT)  BEGIN
DELETE FROM alat WHERE com_id = idnya;
DELETE FROM certificate WHERE com_id = idnya;
DELETE FROM com_bf_relation WHERE com_id = idnya;
UPDATE personal SET com_id = '0', per_dir = '0' WHERE com_id = idnya;
DELETE FROM hasil_produk WHERE com_id = idnya;
DELETE FROM pengalaman WHERE com_id = idnya;
DELETE FROM licensed WHERE com_id = idnya;
DELETE FROM company WHERE com_id = idnya;
DELETE FROM additional_detail WHERE com_id = idnya;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `datacom` (IN `idnya` INT)  BEGIN
SELECT * FROM company c LEFT JOIN bussiness_services USING(bs_id) WHERE c.com_id = idnya;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dataper` (`idnya` INT)  BEGIN
SELECT *
FROM personal p
WHERE per_id = idnya;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_of` (`idnya` INT)  BEGIN
SELECT * FROM personal WHERE com_id = idnya;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `job_history` (IN `idnya` INT)  BEGIN
SELECT jh.*, c.com_name FROM job_history jh LEFT JOIN company c ON(c.com_id = jh.com_id_baru)
WHERE per_id = idnya
ORDER BY tgl_jabat DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `per_del` (IN `idnya` INT)  BEGIN
DELETE FROM job_history WHERE per_id = idnya;
DELETE FROM personal WHERE per_id = idnya;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `additional_detail`
--

CREATE TABLE `additional_detail` (
  `ad_id` int(11) NOT NULL,
  `item` varchar(200) DEFAULT NULL,
  `description` varchar(2500) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(200) DEFAULT NULL,
  `merk_type` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tahun_pembuatan` year(4) DEFAULT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `status_kepemilikan` varchar(100) DEFAULT NULL,
  `tech_desc` varchar(500) DEFAULT NULL,
  `a_file` varchar(100) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`a_id`, `a_name`, `merk_type`, `jumlah`, `tahun_pembuatan`, `kondisi`, `status_kepemilikan`, `tech_desc`, `a_file`, `com_id`) VALUES
(2, 'Welding Gauge', 'MG8 / KW06-521', 4, 2011, 'Baik', 'Milik sendiri', '', NULL, 32),
(5, ' GPSMAP 60CSX', 'Garmin', 1, 2010, 'Baik', 'Milik sendiri', '', '1533093198_32_5_Garmin  GPSMAP 60CSX_file.txt', 32);

-- --------------------------------------------------------

--
-- Table structure for table `bussiness_fields`
--

CREATE TABLE `bussiness_fields` (
  `bf_id` int(11) NOT NULL,
  `bf_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bussiness_fields`
--

INSERT INTO `bussiness_fields` (`bf_id`, `bf_name`) VALUES
(1, 'Refinery Plant'),
(2, 'Gas Processing Plant'),
(3, 'Mid Stream'),
(4, 'Petrochemical Plant'),
(5, 'Utility Plant'),
(6, 'Offsite Plant'),
(7, 'Common'),
(8, 'Gas to Liquid Plant'),
(9, 'Modular Unit'),
(10, 'Power Generation Plant');

-- --------------------------------------------------------

--
-- Table structure for table `bussiness_services`
--

CREATE TABLE `bussiness_services` (
  `bs_id` int(11) NOT NULL,
  `bs_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bussiness_services`
--

INSERT INTO `bussiness_services` (`bs_id`, `bs_name`) VALUES
(1, 'EPC'),
(2, 'Vendor'),
(3, 'Licensor'),
(4, 'Consultant'),
(5, 'Contractor'),
(6, 'Operation & Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_code` varchar(20) NOT NULL,
  `c_classification` varchar(150) NOT NULL,
  `c_qualification` varchar(100) NOT NULL,
  `com_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`c_id`, `c_name`, `c_code`, `c_classification`, `c_qualification`, `com_id`) VALUES
(122, 'SBU GAPENRI (Sertifikat Badan Usaha-Jasa Terintegrasi)', 'TI503', 'Jasa Terintegrasi', 'B2/Besar', 32);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(100) DEFAULT NULL,
  `com_address` varchar(250) DEFAULT NULL,
  `com_city` varchar(100) DEFAULT NULL,
  `com_country` varchar(50) DEFAULT NULL,
  `com_postal_code` varchar(20) DEFAULT NULL,
  `com_phone` varchar(20) DEFAULT NULL,
  `com_fax` varchar(20) DEFAULT NULL,
  `plant_address` varchar(250) DEFAULT NULL,
  `plant_city` varchar(100) DEFAULT NULL,
  `plant_country` varchar(50) DEFAULT NULL,
  `plant_postal_code` varchar(20) DEFAULT NULL,
  `plant_phone` varchar(20) DEFAULT NULL,
  `plant_fax` varchar(20) DEFAULT NULL,
  `com_website` varchar(50) DEFAULT NULL,
  `com_email` varchar(50) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `org_chart` varchar(200) DEFAULT NULL,
  `finance_capability` varchar(200) DEFAULT NULL,
  `saham_indo` float DEFAULT NULL,
  `saham_asing` float DEFAULT NULL,
  `akta_awal_no` int(11) DEFAULT NULL,
  `akta_awal_tgl` date DEFAULT NULL,
  `akta_awal_notaris` varchar(100) DEFAULT NULL,
  `akta_awal_kota` varchar(50) DEFAULT NULL,
  `akta_akhir_no` int(11) DEFAULT NULL,
  `akta_akhir_tgl` date DEFAULT NULL,
  `akta_akhir_notaris` varchar(100) DEFAULT NULL,
  `akta_akhir_kota` varchar(50) DEFAULT NULL,
  `jum_e_process_wni` int(11) DEFAULT NULL,
  `jum_e_process_wna` int(11) DEFAULT NULL,
  `jum_e_civil_wni` int(11) DEFAULT NULL,
  `jum_e_civil_wna` int(11) DEFAULT NULL,
  `jum_e_piping_wni` int(11) DEFAULT NULL,
  `jum_e_piping_wna` int(11) DEFAULT NULL,
  `jum_e_instrument_wni` int(11) DEFAULT NULL,
  `jum_e_instrument_wna` int(11) DEFAULT NULL,
  `jum_e_electrical_wni` int(11) DEFAULT NULL,
  `jum_e_electrical_wna` int(11) DEFAULT NULL,
  `jum_e_mechanical_wni` int(11) DEFAULT NULL,
  `jum_e_mechanical_wna` int(11) DEFAULT NULL,
  `jum_e_rotary_package_machinary_wni` int(11) DEFAULT NULL,
  `jum_e_rotary_package_machinary_wna` int(11) DEFAULT NULL,
  `jumlah_project_management_wni` int(11) DEFAULT NULL,
  `jumlah_project_management_wna` int(11) DEFAULT NULL,
  `jumlah_project_planning_control_wni` int(11) DEFAULT NULL,
  `jumlah_project_planning_control_wna` int(11) DEFAULT NULL,
  `jumlah_procurement_wni` int(11) DEFAULT NULL,
  `jumlah_procurement_wna` int(11) DEFAULT NULL,
  `jumlah_construction_management_wni` int(11) DEFAULT NULL,
  `jumlah_construction_management_wna` int(11) DEFAULT NULL,
  `jumlah_qc_wni` int(11) DEFAULT NULL,
  `jumlah_qc_wna` int(11) DEFAULT NULL,
  `bs_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `com_name`, `com_address`, `com_city`, `com_country`, `com_postal_code`, `com_phone`, `com_fax`, `plant_address`, `plant_city`, `plant_country`, `plant_postal_code`, `plant_phone`, `plant_fax`, `com_website`, `com_email`, `npwp`, `org_chart`, `finance_capability`, `saham_indo`, `saham_asing`, `akta_awal_no`, `akta_awal_tgl`, `akta_awal_notaris`, `akta_awal_kota`, `akta_akhir_no`, `akta_akhir_tgl`, `akta_akhir_notaris`, `akta_akhir_kota`, `jum_e_process_wni`, `jum_e_process_wna`, `jum_e_civil_wni`, `jum_e_civil_wna`, `jum_e_piping_wni`, `jum_e_piping_wna`, `jum_e_instrument_wni`, `jum_e_instrument_wna`, `jum_e_electrical_wni`, `jum_e_electrical_wna`, `jum_e_mechanical_wni`, `jum_e_mechanical_wna`, `jum_e_rotary_package_machinary_wni`, `jum_e_rotary_package_machinary_wna`, `jumlah_project_management_wni`, `jumlah_project_management_wna`, `jumlah_project_planning_control_wni`, `jumlah_project_planning_control_wna`, `jumlah_procurement_wni`, `jumlah_procurement_wna`, `jumlah_construction_management_wni`, `jumlah_construction_management_wna`, `jumlah_qc_wni`, `jumlah_qc_wna`, `bs_id`) VALUES
(32, 'PT. JGC INDONESIA', 'Jl. TB. Simatupang 7-B', 'Jakarta', 'Indonesia', '12340', '+62-21-29976500', '+62-21-29976599', '', '', '', '', '', '', 'www.jgc-indonesia.com', 'info@jgc-indonesia', '01.000.219.4-058.000', '1532680336_32_org_chart.pdf', '1532680336_32_finance_capability.pdf', 0.3, 99.7, 4, '1974-09-06', 'Tan Thong Kie', 'Jakarta', 9, '2018-07-06', 'Shella Falianti, SH', 'Jakarta', 1, 24, 2, 23, 3, 22, 4, 21, 5, 20, 6, 19, 7, 18, 8, 17, 9, 16, 10, 15, 11, 14, 12, 13, 1),
(33, 'UOP Honeywell', '25 E. Algonquin Road (Bldg A) P.O. Box 5017 Des Plaines', 'Illinois', 'America', '60017-5017', '+1 (800) 877-6184', '+1 (847) 391-2000', 'PT. UOP Indonesia Menara Prima 24th floor Unit G-H Jl. DR. Ide Anak Agung Gde Agung Blok 6.2', 'Jakarta', 'Indonesia', '12910', '+62-21-5794-8118', '+62-811-154-2421', 'www.uop.com', 'uop@gmail.com', '', NULL, NULL, 0, 100, 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(34, 'Institut Teknologi Sepuluh Nopember', 'Kampus Institut Teknologi Sepuluh Nopember Surabaya, Sukolilo', 'Surabaya', 'Indonesia', '60111', '+62 31-5994251', '+62 31-5923465', '', '', '', '', '', '', 'its.ac.id', 'its@gmail.com', '', '1533611238_34_org_chart.png', NULL, 0, 0, 0, '0000-00-00', '', '', 0, '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'A Mitsubishi Corporation', 'SENTRAL SENAYAN II, 18TH & 19TH FLOOR JL. ASIA AFRIKA NO.8', 'JAKARTA', 'INDONESIA', '10270', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `com_bf_relation`
--

CREATE TABLE `com_bf_relation` (
  `com_id` int(11) NOT NULL,
  `bf_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_bf_relation`
--

INSERT INTO `com_bf_relation` (`com_id`, `bf_id`) VALUES
(33, 1),
(33, 4),
(32, 1),
(32, 2),
(32, 3),
(32, 4),
(32, 5),
(32, 6),
(32, 7),
(32, 8),
(32, 9),
(32, 10);

-- --------------------------------------------------------

--
-- Table structure for table `detil_tabel`
--

CREATE TABLE `detil_tabel` (
  `dt_id` int(11) NOT NULL,
  `bs_id` int(11) DEFAULT NULL,
  `ccl_check` varchar(5) DEFAULT NULL,
  `lp_check` varchar(5) DEFAULT NULL,
  `ps_check` varchar(5) DEFAULT NULL,
  `ec_check` varchar(5) DEFAULT NULL,
  `da_check` varchar(5) DEFAULT NULL,
  `exp_check` varchar(5) DEFAULT NULL,
  `op_check` varchar(5) DEFAULT NULL,
  `tor_check` varchar(5) DEFAULT NULL,
  `additional_table` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_tabel`
--

INSERT INTO `detil_tabel` (`dt_id`, `bs_id`, `ccl_check`, `lp_check`, `ps_check`, `ec_check`, `da_check`, `exp_check`, `op_check`, `tor_check`, `additional_table`) VALUES
(1, 7, '', '', 'ok', 'ok', 'ok', '', '', 'ok', 'ok'),
(2, 8, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_produk`
--

CREATE TABLE `hasil_produk` (
  `shp_id` int(11) NOT NULL,
  `hasil_produksi` varchar(100) DEFAULT NULL,
  `jenis_produksi` varchar(500) DEFAULT NULL,
  `spesifikasi` varchar(500) DEFAULT NULL,
  `standar_produk` varchar(100) DEFAULT NULL,
  `sertifikat` varchar(100) DEFAULT NULL,
  `tkdn` float DEFAULT NULL,
  `kapasitas` varchar(50) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_produk`
--

INSERT INTO `hasil_produk` (`shp_id`, `hasil_produksi`, `jenis_produksi`, `spesifikasi`, `standar_produk`, `sertifikat`, `tkdn`, `kapasitas`, `com_id`) VALUES
(2, 'Pencil', 'ATK', 'Terbuat dari kayu terbaik', 'SNI', 'World Record', 17.83, '100/bulan', 32);

-- --------------------------------------------------------

--
-- Table structure for table `job_history`
--

CREATE TABLE `job_history` (
  `jobh_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `com_id_lama` int(11) DEFAULT NULL,
  `com_id_baru` int(11) DEFAULT NULL,
  `per_position_lama` varchar(100) DEFAULT NULL,
  `per_position_baru` varchar(100) DEFAULT NULL,
  `per_department_lama` varchar(100) DEFAULT NULL,
  `per_department_baru` varchar(100) DEFAULT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tgl_jabat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_history`
--

INSERT INTO `job_history` (`jobh_id`, `per_id`, `com_id_lama`, `com_id_baru`, `per_position_lama`, `per_position_baru`, `per_department_lama`, `per_department_baru`, `tgl`, `tgl_jabat`) VALUES
(90, 90, NULL, 24, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '( PROJECT& BUSINESS DEVELOPMENT)', '2018-07-18 10:47:18', '2018-07-18 10:47:18'),
(91, 91, NULL, 24, NULL, 'Executive Vice President', NULL, '', '2018-07-18 10:47:18', '2018-07-18 10:47:18'),
(92, 92, NULL, 24, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, 'LIVING ESSENTIALS GROUP (TEXTILE GENERAL MERCHANDISE)', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(93, 93, NULL, 24, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(94, 94, NULL, 24, NULL, 'MANAGER. FINANCE', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(95, 95, NULL, 24, NULL, 'ASSISTANT GENERAL MANAGER', NULL, 'OVERSEAS PROJECT TEAM B HEAVY MACHINERY & STEEL STRUCTURES UNIT', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(96, 96, NULL, 24, NULL, 'SENIOR TECHNICAL ADVISOR', NULL, 'BUSINESS DIVISION', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(97, 97, NULL, 24, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(98, 98, NULL, 24, NULL, '', NULL, '', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(99, 99, NULL, 24, NULL, 'JAKARTA REPRESENTATIVE OFFICE', NULL, 'MACHINERY GROUP', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(100, 100, NULL, 24, NULL, 'GENERAL MANAGER', NULL, '', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(101, 101, NULL, 24, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(102, 102, NULL, 24, NULL, 'MANAGER', NULL, 'COORDINATION & STRATEGY OFFICE NATURAL GAS BUSINESS DIV. A. B ENERGY BUSINESS GROUP', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(103, 103, NULL, 24, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'ENERGY & CHEMICAL PROJECTS UNIT', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(104, 104, NULL, 24, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(105, 105, NULL, 24, NULL, 'ASSISTANT MANAGER', NULL, 'MACHINERY GROUP', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(106, 106, NULL, 24, NULL, 'SENIOR MANAGER', NULL, 'MACHINERY GROUP', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(107, 107, NULL, 24, NULL, 'General Manager', NULL, 'Donggi-Senoro Project Unit Natural Gas Business Division B', '2018-07-18 10:47:19', '2018-07-18 10:47:19'),
(112, 51, 25, 32, 'Web Developer', 'Intern', 'IT', 'CBD', '2018-08-03 03:28:43', '2018-06-24 17:00:00'),
(115, 111, NULL, 0, NULL, 'Director', NULL, NULL, '2018-08-01 10:59:13', '2018-08-01 10:59:13'),
(116, 112, NULL, 0, NULL, 'Director', NULL, NULL, '2018-08-01 10:59:13', '2018-08-01 10:59:13'),
(118, 114, NULL, 0, NULL, 'Director', NULL, NULL, '2018-08-01 10:59:13', '2018-08-01 10:59:13'),
(121, 114, 0, 32, 'Director', 'Director', NULL, NULL, '2018-08-01 10:59:59', '2018-08-01 10:59:59'),
(123, 112, 0, 32, 'Director', 'Director', NULL, NULL, '2018-08-01 11:00:24', '2018-08-01 11:00:24'),
(124, 111, 0, 32, 'Director', 'Director', NULL, NULL, '2018-08-01 11:00:24', '2018-08-01 11:00:24'),
(127, 90, 24, 0, 'ASSISTANT TO REPRESENTATIVE', 'ASSISTANT TO REPRESENTATIVE', '( PROJECT& BUSINESS DEVELOPMENT)', '( PROJECT& BUSINESS DEVELOPMENT)', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(128, 91, 24, 0, 'Executive Vice President', 'Executive Vice President', '', '', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(129, 92, 24, 0, 'ASSISTANT TO REPRESENTATIVE', 'ASSISTANT TO REPRESENTATIVE', 'LIVING ESSENTIALS GROUP (TEXTILE GENERAL MERCHANDISE)', 'LIVING ESSENTIALS GROUP (TEXTILE GENERAL MERCHANDISE)', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(130, 93, 24, 0, 'ASSISTANT TO REPRESENTATIVE', 'ASSISTANT TO REPRESENTATIVE', '', '', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(131, 94, 24, 0, 'MANAGER. FINANCE', 'MANAGER. FINANCE', 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(132, 95, 24, 0, 'ASSISTANT GENERAL MANAGER', 'ASSISTANT GENERAL MANAGER', 'OVERSEAS PROJECT TEAM B HEAVY MACHINERY & STEEL STRUCTURES UNIT', 'OVERSEAS PROJECT TEAM B HEAVY MACHINERY & STEEL STRUCTURES UNIT', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(133, 96, 24, 0, 'SENIOR TECHNICAL ADVISOR', 'SENIOR TECHNICAL ADVISOR', 'BUSINESS DIVISION', 'BUSINESS DIVISION', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(134, 97, 24, 0, 'ASSISTANT TO REPRESENTATIVE', 'ASSISTANT TO REPRESENTATIVE', '', '', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(135, 98, 24, 0, '', '', '', '', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(136, 99, 24, 0, 'JAKARTA REPRESENTATIVE OFFICE', 'JAKARTA REPRESENTATIVE OFFICE', 'MACHINERY GROUP', 'MACHINERY GROUP', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(137, 100, 24, 0, 'GENERAL MANAGER', 'GENERAL MANAGER', '', '', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(138, 101, 24, 0, 'DEPUTY GENERAL MANAGER', 'DEPUTY GENERAL MANAGER', 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(139, 102, 24, 0, 'MANAGER', 'MANAGER', 'COORDINATION & STRATEGY OFFICE NATURAL GAS BUSINESS DIV. A. B ENERGY BUSINESS GROUP', 'COORDINATION & STRATEGY OFFICE NATURAL GAS BUSINESS DIV. A. B ENERGY BUSINESS GROUP', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(140, 103, 24, 0, 'DEPUTY GENERAL MANAGER', 'DEPUTY GENERAL MANAGER', 'ENERGY & CHEMICAL PROJECTS UNIT', 'ENERGY & CHEMICAL PROJECTS UNIT', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(141, 104, 24, 0, 'DEPUTY GENERAL MANAGER', 'DEPUTY GENERAL MANAGER', 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(142, 105, 24, 0, 'ASSISTANT MANAGER', 'ASSISTANT MANAGER', 'MACHINERY GROUP', 'MACHINERY GROUP', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(143, 106, 24, 0, 'SENIOR MANAGER', 'SENIOR MANAGER', 'MACHINERY GROUP', 'MACHINERY GROUP', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(144, 107, 24, 0, 'General Manager', 'General Manager', 'Donggi-Senoro Project Unit Natural Gas Business Division B', 'Donggi-Senoro Project Unit Natural Gas Business Division B', '2018-08-02 07:52:20', '2018-08-02 07:52:20'),
(148, 117, NULL, 32, NULL, 'President Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(149, 118, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(150, 119, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(152, 121, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(155, 124, NULL, 32, NULL, 'President Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(156, 125, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(157, 126, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(159, 128, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(160, 129, NULL, 32, NULL, 'saya', NULL, NULL, '2018-08-02 08:33:03', '2018-08-02 08:33:03'),
(162, 131, NULL, 32, NULL, 'President Director', NULL, NULL, '2018-08-02 08:34:19', '2018-08-02 08:34:19'),
(163, 132, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:34:19', '2018-08-02 08:34:19'),
(164, 133, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:34:19', '2018-08-02 08:34:19'),
(166, 135, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:34:19', '2018-08-02 08:34:19'),
(169, 138, NULL, 32, NULL, 'President Director', NULL, NULL, '2018-08-02 08:34:20', '2018-08-02 08:34:20'),
(170, 139, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:34:20', '2018-08-02 08:34:20'),
(171, 140, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:34:20', '2018-08-02 08:34:20'),
(173, 142, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 08:34:20', '2018-08-02 08:34:20'),
(175, 144, NULL, 32, NULL, 'President Director', NULL, NULL, '2018-08-02 09:01:02', '2018-08-02 09:01:02'),
(176, 145, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 09:01:02', '2018-08-02 09:01:02'),
(177, 146, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 09:01:02', '2018-08-02 09:01:02'),
(178, 147, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 09:01:02', '2018-08-02 09:01:02'),
(179, 148, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 09:01:02', '2018-08-02 09:01:02'),
(180, 149, NULL, 32, NULL, 'Director', NULL, NULL, '2018-08-02 09:01:02', '2018-08-02 09:01:02'),
(182, 150, 32, 32, 'Director', 'President Commissioner', NULL, '', '2018-08-02 09:14:29', '2018-08-02 09:14:29'),
(190, 51, NULL, 34, NULL, 'Mahasiswa', NULL, 'Informatika', '2018-08-03 06:35:27', '2016-08-25 17:00:00'),
(191, 151, NULL, 34, NULL, 'Mahasiswa', NULL, 'Informatika', '2018-08-08 00:46:12', '2016-08-25 17:00:00'),
(192, 151, NULL, 32, NULL, 'Intern', NULL, 'CBD', '2018-08-07 06:23:18', '2018-06-25 17:00:00'),
(194, 153, NULL, 35, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '( PROJECT& BUSINESS DEVELOPMENT)', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(195, 154, NULL, 35, NULL, 'Executive Vice President', NULL, '', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(196, 155, NULL, 35, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, 'LIVING ESSENTIALS GROUP (TEXTILE GENERAL MERCHANDISE)', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(197, 156, NULL, 35, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(198, 157, NULL, 35, NULL, 'MANAGER. FINANCE', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(199, 158, NULL, 35, NULL, 'ASSISTANT GENERAL MANAGER', NULL, 'OVERSEAS PROJECT TEAM B HEAVY MACHINERY & STEEL STRUCTURES UNIT', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(200, 159, NULL, 35, NULL, 'SENIOR TECHNICAL ADVISOR', NULL, 'BUSINESS DIVISION', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(201, 160, NULL, 35, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(202, 161, NULL, 35, NULL, '', NULL, '', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(203, 162, NULL, 35, NULL, 'JAKARTA REPRESENTATIVE OFFICE', NULL, 'MACHINERY GROUP', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(204, 163, NULL, 35, NULL, 'GENERAL MANAGER', NULL, '', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(205, 164, NULL, 35, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(206, 165, NULL, 35, NULL, 'MANAGER', NULL, 'COORDINATION & STRATEGY OFFICE NATURAL GAS BUSINESS DIV. A. B ENERGY BUSINESS GROUP', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(207, 166, NULL, 35, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'ENERGY & CHEMICAL PROJECTS UNIT', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(208, 167, NULL, 35, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(209, 168, NULL, 35, NULL, 'ASSISTANT MANAGER', NULL, 'MACHINERY GROUP', '2018-08-07 07:54:30', '2018-08-07 07:54:30'),
(210, 169, NULL, 35, NULL, 'SENIOR MANAGER', NULL, 'MACHINERY GROUP', '2018-08-07 07:54:31', '2018-08-07 07:54:31'),
(211, 170, NULL, 35, NULL, 'General Manager', NULL, 'Donggi-Senoro Project Unit Natural Gas Business Division B', '2018-08-07 07:54:31', '2018-08-07 07:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `licensed`
--

CREATE TABLE `licensed` (
  `l_id` int(11) NOT NULL,
  `l_process` varchar(150) DEFAULT NULL,
  `bf_id` int(11) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licensed`
--

INSERT INTO `licensed` (`l_id`, `l_process`, `bf_id`, `com_id`) VALUES
(2, 'Biofuel, Green Diesel', 1, 33),
(3, 'Biofuel, Green Jet Fuel', 1, 33),
(4, 'Catalytic Reforming', 1, 33),
(5, 'Coking', 1, 33),
(6, 'Deasphalting', 1, 33),
(7, 'Hydrocracking', 1, 33),
(8, 'Hydroprocessing - Resid', 1, 33),
(9, 'Isomerization', 1, 33),
(10, 'Treating - Pressure Swing Adsorption', 1, 33),
(11, 'Visbreaking', 1, 33),
(12, 'Aeromatics Extraction', 4, 33),
(13, 'BTX Extraction', 4, 33),
(14, 'Cumene', 4, 33),
(15, 'Ethylene', 4, 33),
(16, 'Linear Alkylbenze', 4, 33),
(17, 'm-Xylene', 4, 33),
(18, 'Mixed Xylenes', 4, 33),
(19, 'Normal Parafins, C10-C13', 4, 33),
(20, 'Paraxylene', 4, 33),
(21, 'Phenol', 4, 33),
(22, 'Propylene', 4, 33),
(23, 'Propylene & Ethylene', 4, 33),
(24, 'Xylene Isomerization', 4, 33),
(25, 'Alkylation', 1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman`
--

CREATE TABLE `pengalaman` (
  `p_id` int(11) NOT NULL,
  `nama_proyek` varchar(200) DEFAULT NULL,
  `lingkup_pekerjaan` varchar(500) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `periode` varchar(20) DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `p_field` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `on_off_shore` varchar(10) DEFAULT NULL,
  `p_cost` varchar(50) DEFAULT NULL,
  `p_status` varchar(10) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengalaman`
--

INSERT INTO `pengalaman` (`p_id`, `nama_proyek`, `lingkup_pekerjaan`, `lokasi`, `periode`, `client`, `p_field`, `capacity`, `on_off_shore`, `p_cost`, `p_status`, `com_id`) VALUES
(92, 'Penggantian Jalur Pipa Penerimaan Dan Penyaluran Avtur di DPPU Ngurah Rai', 'EPC', 'Ngurang Rai Airport, Denpasar - Bali, Indonesia', '2012', 'PERTAMINA Upms-V', 'REFINERY PLANT', '', 'Onshore', 'Rp 17,826,343', 'finish', 32),
(93, 'Installation for OSBL Piping and Rotating Equipment for Phase-V', 'EPC', 'Anyer - Banten, Indonesia', '2012', 'PT. Asahimas Chemical (ASC)', 'PETROCHEMICAL PLANT', '', 'Offshore', 'Rp 17,826,344', 'finish', 32),
(94, 'Onshore Engineering, Procurement and Construction Contract for the Excecute Phase of The Project Monas Indonesia', 'EPC', 'Merunda - Jakarta, Indonesia', '2013', 'PT. Shell Manufacturing Indonesia', 'LUBE OIL BLENDING PLANT', '', 'Onshore', 'Rp 17,826,345', 'finish', 32),
(95, 'Pekerjaan Pemasangan Pipa Hydrant System Di Bandara Kertajati', 'EPC', 'Majalengka, West Java, Indonesia', '2016', 'PT. Pertamina (Persero)', 'UTILITY PLANT', '', 'Offshore', 'Rp 17,826,346', 'finish', 32),
(96, 'Pekerjaan Pembangunan New Flare Kilang Balikpapan-1 Proyek RDMP RU V', 'EPC', 'Balikpapan, Kalimantan, Indonesia', '2017', 'PERTAMINA RU-V', 'REFINERY PLANT', '', 'Onshore', 'Rp 17,826,347', 'finish', 32),
(100, 'PMC Penggantian Vapour Line 28\", Furnace HVU II, Element APH HVU dan Slide Valve untuk TA RU III', 'PMC', 'Plaju, South Sumatra, Indonesia', '2016', 'PERTAMINA RU-III', 'REFINERY PLANT', '', 'Onshore', 'Rp 17,826,351', 'finish', 32),
(116, 'Pekerjaan Konsultan Perencanaan Pembangunan Open Access RU VII Kasim', 'E', 'Sorong, Papua Barat', '2017', 'PT. Pertamina RU-VII', 'GAS PROCESSING PLANT', '', 'Onshore', 'Rp 17,826,251', 'ongoing', 32),
(117, 'DED Proyek Integrasi Lingkungan Pertamina - Balongan', 'E', 'Balongan, West Java. Indonesia', '2017', 'PT. Pertamina RU-VI', 'REFINERY PLANT', '', 'Offshore', 'Rp 17,826,252', 'ongoing', 32),
(118, 'Block A Gas Project', 'EPC', 'Aceh, Indonesia', '2015', 'Medco E & P', 'GAS PROCESSING PLANT', '', 'Onshore', 'Rp 17,826,253', 'ongoing', 32),
(119, 'Cilacap Blue Sky Pj.', 'EPC', 'Cilacap, Centre of Java, Indonesia', '2015', 'PERTAMINA RU-IV', 'REFINERY PLANT', '', 'Offshore', 'Rp 17,826,254', 'ongoing', 32),
(120, 'EPCIC RGTEC', 'EPC', 'Malaysia', '2015', 'PT. Petronas Gas Berhard', 'REFINERY PLANT', '', 'Onshore', 'Rp 17,826,255', 'ongoing', 32),
(121, 'Pembangunan Hydrant System dan Topping Up di DPPU Juanda Airport Terminal 2 Surabaya Project(JT2 - Project)', 'EPC', 'Surabaya, Indonesia', '2016', 'PT. Pertamina (Persero)', 'GAS PROCESSING PLANT', '', 'Offshore', 'Rp 17,826,256', 'ongoing', 32),
(122, 'JTB Unitization Gas Project', 'EPC', 'Bojonegoro, East Java, Indonesia', '2017', 'Pertamina EP', 'GAS PROCESSING PLANT', '', 'Onshore', 'Rp 17,826,257', 'ongoing', 32);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `per_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `per_full_name` varchar(200) DEFAULT NULL,
  `per_first_name` varchar(100) DEFAULT NULL,
  `per_last_name` varchar(100) DEFAULT NULL,
  `born_place` varchar(100) DEFAULT NULL,
  `born_date` date DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `latest_education` varchar(100) DEFAULT NULL,
  `per_profile_picture` varchar(200) DEFAULT NULL,
  `per_position` varchar(100) DEFAULT NULL,
  `per_dir` tinyint(1) DEFAULT NULL,
  `per_department` varchar(100) DEFAULT NULL,
  `per_phone1` varchar(15) DEFAULT NULL,
  `per_phone2` varchar(15) DEFAULT NULL,
  `per_phone3` varchar(15) DEFAULT NULL,
  `per_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`per_id`, `com_id`, `per_full_name`, `per_first_name`, `per_last_name`, `born_place`, `born_date`, `sex`, `religion`, `address`, `latest_education`, `per_profile_picture`, `per_position`, `per_dir`, `per_department`, `per_phone1`, `per_phone2`, `per_phone3`, `per_email`) VALUES
(151, 32, 'Ibrahim Tamtama Adi', 'Ibrahim Tamtama', 'Adi', 'Indramayu', '1997-12-17', 'Male', 'Islam', 'Ds. Sidowayah RT 6/RW 3 Kec. Rembang, Kab. Rembang', 'Highschool', '1533610596_Ibrahim Tamtama Adi.jpg', 'Intern', 0, 'CBD', '085727000818', '', '', 'ibrahimtamtama17@gmail.com'),
(153, 35, 'TAKANORI SHINTOMO', 'TAKANORI', 'SHINTOMO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '( PROJECT& BUSINESS DEVELOPMENT)', '+62(21)5795-151', '+62(21)5795-180', '', 'takanori.shintomo@mitsubishicorp.com'),
(154, 35, 'Masayuki MIZUNO', 'Masayuki', 'MIZUNO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Executive Vice President', NULL, '', '+62(21)5795-111', '+62(21)5795-110', '', 'masayuki.mizuno@mitsubishicorp.com'),
(155, 35, 'KANEKO, Masatsugu', 'KANEKO', 'Masatsugu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, 'LIVING ESSENTIALS GROUP (TEXTILE GENERAL MERCHANDISE)', '+62(21)5795-132', '+62(21)5795-180', '', 'masatsugu.kaneko@mitsubishicorp.com'),
(156, 35, 'KOKI UCHINO', 'KOKI', 'UCHINO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '', '+62(21)5795-151', '+62(21)5795-180', '', 'koki.uchino@mitsubishicorp.com'),
(157, 35, 'YOSHITERU KAWAI', 'YOSHITERU', 'KAWAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANAGER. FINANCE', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '+81(3)3210-2519', '+81(3)3210-7059', '', 'yoshiteru.kawai@mitsubishicorp.com'),
(158, 35, 'SEIICHIRO ONISHI', 'SEIICHIRO', 'ONISHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASSISTANT GENERAL MANAGER', NULL, 'OVERSEAS PROJECT TEAM B HEAVY MACHINERY & STEEL STRUCTURES UNIT', '+81(3)3210-4439', '+81(3)3210-8188', '', 'seiichiro.onishi@mitsubishicorp.com'),
(159, 35, 'AKIYOSHI ANDY MIZOGUCHI', 'AKIYOSHI ANDY', 'MIZOGUCHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SENIOR TECHNICAL ADVISOR', NULL, 'BUSINESS DIVISION', '+81(3)6405-7211', '+81(3)6405-4258', '', 'akiyoshi.mizoguchi@mitsubishicorp.com'),
(160, 35, 'MOTOKI ITO', 'MOTOKI', 'ITO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASSISTANT TO REPRESENTATIVE', NULL, '', '+62(21)5795-151', '+62(21)5795-180', '', 'motoki.ito@mitsubishicorp.com'),
(161, 35, 'YOSHITO ISHIDA', 'YOSHITO', 'ISHIDA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '+62(21)5795-151', '+62(21)5795-180', '', 'yoshito.ishida@mitsubishicorp.com'),
(162, 35, 'KEI IIIZUMI', 'KEI', 'IIIZUMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JAKARTA REPRESENTATIVE OFFICE', NULL, 'MACHINERY GROUP', '+62-21-5795-151', '+62-21-5795-180', '', 'kei.iiizumi@mitsubishicorp.com'),
(163, 35, 'TOSHiO KASHIWAGI', 'TOSHiO', 'KASHIWAGI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GENERAL MANAGER', NULL, '', '(84-8)8294763.8', '(84-8)8294760', '', 'toshio.kashiwagi@mitsubishicorp.com'),
(164, 35, 'TAKUJI KONZO', 'TAKUJI', 'KONZO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '+81(3)3210-2134', '+81(3)3210-7059', '818010052989', 'takuji.konzo@mitsubishicorp.com'),
(165, 35, 'TAKAYUKI KAMEYAMA', 'TAKAYUKI', 'KAMEYAMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANAGER', NULL, 'COORDINATION & STRATEGY OFFICE NATURAL GAS BUSINESS DIV. A. B ENERGY BUSINESS GROUP', '+81(3)3210-6534', '+81(3)3210-7059', '818010111163', 'takayuki.kameyama@mitsubishicorp.com'),
(166, 35, 'TOSHIHIRO KISO', 'TOSHIHIRO', 'KISO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'ENERGY & CHEMICAL PROJECTS UNIT', '+81(3)6405-7215', '+81(3)6405-4258', '', 'toshihiro.kiso@mitsubishicorp.com'),
(167, 35, 'TAKASHI YOKOYAMA', 'TAKASHI', 'YOKOYAMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DEPUTY GENERAL MANAGER', NULL, 'DONGGI-SENORO PROJECT UNIT NATURAL GAS BUSINESS DIVISION B', '+81(3)3210-8426', '+81(3)3210-7059', '8180111345701ND', 'takashi.yokoyama@mitsubishicorp.com'),
(168, 35, 'AURELIA HIDAYAT', 'AURELIA', 'HIDAYAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ASSISTANT MANAGER', NULL, 'MACHINERY GROUP', '+62(21)5795-151', '+62(21)5795-180', '', 'aurelia.lie-bey@mitsubishicorp.com'),
(169, 35, 'U. WILLY Rh.', 'U. WILLY', 'Rh.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SENIOR MANAGER', NULL, 'MACHINERY GROUP', '+62(21)5795-151', '+62(21)57918-02', '', 'willy.ranuhandoko@mitsubishicorp.com'),
(170, 35, 'TAKANOBU SHIMURA', 'TAKANOBU', 'SHIMURA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'General Manager', NULL, 'Donggi-Senoro Project Unit Natural Gas Business Division B', '+81(3)3210-6925', '+81(3)3210-7059', '+81(90)3102-253', 'takanobu.shimura@mitsubishicorp.com');

--
-- Triggers `personal`
--
DELIMITER $$
CREATE TRIGGER `jobh_insert` AFTER INSERT ON `personal` FOR EACH ROW BEGIN
  insert into job_history(per_id, com_id_baru, per_position_baru, per_department_baru)
  VALUES(new.per_id, new.com_id, new.per_position, new.per_department);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `to_revenue`
--

CREATE TABLE `to_revenue` (
  `to_id` int(11) NOT NULL,
  `to_year` varchar(4) DEFAULT NULL,
  `to_value` varchar(20) DEFAULT NULL,
  `com_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `to_revenue`
--

INSERT INTO `to_revenue` (`to_id`, `to_year`, `to_value`, `com_id`) VALUES
(50, '2002', 'Rp 5,245,348', 32),
(51, '2003', 'Rp 3,414,214', 32),
(52, '2004', 'Rp 5,245,349', 32),
(53, '2005', 'Rp 3,414,215', 32),
(54, '2006', 'Rp 5,245,350', 32),
(55, '2007', 'Rp 3,414,216', 32),
(56, '2008', 'Rp 5,245,351', 32),
(57, '2009', 'Rp 3,414,217', 32),
(58, '2010', 'Rp 5,245,352', 32),
(59, '2011', 'Rp 3,414,218', 32),
(60, '2012', 'Rp 5,245,353', 32),
(61, '2013', 'Rp 3,414,219', 32),
(62, '2014', 'Rp 5,245,354', 32),
(63, '2015', 'Rp 3,414,220', 32),
(64, '2016', 'Rp 5,245,355', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_detail`
--
ALTER TABLE `additional_detail`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `bussiness_fields`
--
ALTER TABLE `bussiness_fields`
  ADD PRIMARY KEY (`bf_id`);

--
-- Indexes for table `bussiness_services`
--
ALTER TABLE `bussiness_services`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `com_index` (`com_id`,`com_name`,`com_address`,`com_city`,`plant_address`,`plant_city`,`com_country`,`plant_country`,`bs_id`) USING BTREE;

--
-- Indexes for table `detil_tabel`
--
ALTER TABLE `detil_tabel`
  ADD PRIMARY KEY (`dt_id`);

--
-- Indexes for table `hasil_produk`
--
ALTER TABLE `hasil_produk`
  ADD PRIMARY KEY (`shp_id`);

--
-- Indexes for table `job_history`
--
ALTER TABLE `job_history`
  ADD PRIMARY KEY (`jobh_id`);

--
-- Indexes for table `licensed`
--
ALTER TABLE `licensed`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `fk_com_id` (`com_id`),
  ADD KEY `per_index` (`per_id`,`per_full_name`,`per_first_name`,`per_last_name`,`per_position`,`per_department`);

--
-- Indexes for table `to_revenue`
--
ALTER TABLE `to_revenue`
  ADD PRIMARY KEY (`to_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_detail`
--
ALTER TABLE `additional_detail`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bussiness_fields`
--
ALTER TABLE `bussiness_fields`
  MODIFY `bf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bussiness_services`
--
ALTER TABLE `bussiness_services`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `detil_tabel`
--
ALTER TABLE `detil_tabel`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil_produk`
--
ALTER TABLE `hasil_produk`
  MODIFY `shp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_history`
--
ALTER TABLE `job_history`
  MODIFY `jobh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `licensed`
--
ALTER TABLE `licensed`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengalaman`
--
ALTER TABLE `pengalaman`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `to_revenue`
--
ALTER TABLE `to_revenue`
  MODIFY `to_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
