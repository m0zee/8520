-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2018 at 12:30 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pak_material`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`) VALUES
(1, 'USD'),
(2, 'GBP'),
(3, 'RMB'),
(4, 'EUR'),
(5, 'AUD'),
(6, 'CAD'),
(7, 'CHF'),
(8, 'JPY'),
(9, 'HKD'),
(10, 'NZD'),
(11, 'SGD'),
(12, 'NTD'),
(13, 'QAR');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`) VALUES
(1, 'Acre/Acres'),
(2, 'Ampere/Amperes'),
(3, 'Bag/Bags'),
(4, 'Barrel/Barrels'),
(5, 'Blade/Blades'),
(6, 'Box/Boxes'),
(7, 'Bushel/Bushels'),
(8, 'Carat/Carats'),
(9, 'Carton/Cartons'),
(10, 'Case/Cases'),
(11, 'Centimeter/Centimete'),
(12, 'Chain/Chains'),
(13, 'Combo/Combos'),
(14, 'Cubic Centimeter/Cubic Centime'),
(15, 'Cubic Foot/Cubic Feet'),
(16, 'Cubic Inch/Cubic Inches'),
(17, 'Cubic Meter/Cubic Meters'),
(18, 'Cubic Yard/Cubic Yards'),
(19, 'Degrees Celsius'),
(20, 'Degrees Fahrenheit'),
(21, 'Dozen/Dozens'),
(22, 'Dram/Drams'),
(23, 'Fluid Ounce/Fluid Ounces'),
(24, 'Foot/Feet'),
(25, 'Forty-Foot Container'),
(26, 'Furlong/Furlongs'),
(27, 'Gallon/Gallons'),
(28, 'Gill/Gills'),
(29, 'Grain/Grains'),
(30, 'Gram/Grams'),
(31, 'Gross'),
(32, 'Hectare/Hectares'),
(33, 'Hertz'),
(34, 'Inch/Inches'),
(35, 'Kiloampere/Kiloamperes'),
(36, 'Kilogram/Kilograms'),
(37, 'Kilohertz'),
(38, 'Kilometer/Kilometers'),
(39, 'Kiloohm/Kiloohms'),
(40, 'Kilovolt/Kilovolts'),
(41, 'Kilowatt/Kilowatts'),
(42, 'Liter/Liters'),
(43, 'Long Ton/Long Tons'),
(44, 'Megahertz'),
(45, 'Meter/Meters'),
(46, 'Metric Ton/Metric Tons'),
(47, 'Mile/Miles'),
(48, 'Milliampere/Milliamperes'),
(49, 'Milligram/Milligrams'),
(50, 'Millihertz'),
(51, 'Milliliter/Milliliters'),
(52, 'Milliohm/Milliohms'),
(53, 'Millivolt/Millivolts'),
(54, 'Milliwatt/Milliwatts'),
(55, 'Nautical Mile/Nautical Miles'),
(56, 'Ohm/Ohms'),
(57, 'Ounce/Ounces'),
(58, 'Pack/Packs'),
(59, 'Pair/Pairs'),
(60, 'Pallet/Pallets'),
(61, 'Parcel/Parcels'),
(62, 'Perch/Perches'),
(63, 'Piece/Pieces'),
(64, 'Pint/Pints'),
(65, 'Plant/Plants'),
(66, 'Pole/Poles'),
(67, 'Pound/Pounds'),
(68, 'Quart/Quarts'),
(69, 'Quarter/Quarters'),
(70, 'Rod/Rods'),
(71, 'Roll/Rolls'),
(72, 'Set/Sets'),
(73, 'Sheet/Sheets'),
(74, 'Short Ton/Short Tons'),
(75, 'Square Centimeter/Square Centi'),
(76, 'Square Foot/Square Feet'),
(77, 'Square Inch/Square Inches'),
(78, 'Square Meter/Square Meters'),
(79, 'Square Mile/Square Miles'),
(80, 'Square Yard/Square Yards'),
(81, 'Stone/Stones'),
(82, 'Strand/Strands'),
(83, 'Ton/Tons'),
(84, 'Tonne/Tonnes'),
(85, 'Tray/Trays'),
(86, 'Twenty-Foot Container'),
(87, 'Unit/Units'),
(88, 'Volt/Volts'),
(89, 'Watt/Watts'),
(90, 'Wp'),
(91, 'Yard/Yards');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
