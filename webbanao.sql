-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 06:45 AM
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
-- Database: `webbanao`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CustomerID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Size` varchar(10) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PassWord` varchar(255) DEFAULT NULL,
  `JoinDate` date DEFAULT NULL,
  `UserType` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FullName`, `PhoneNumber`, `Address`, `Email`, `PassWord`, `JoinDate`, `UserType`, `Status`) VALUES
(1000, 'Tính Đặng', '0833197999', '42/7 Trần Hưng Đạo', 'n.tinhs0521@gmail.com', '1234567890', '2024-04-14', 1, 1),
(1001, 'Nguyễn Văn An', '0123456789', '123 Lê Duẩn, Quận 1, TP. HCM', 'nguyenvanan@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1002, 'Trần Thị Bình', '0987654321', '456 Thạch Lam, Quận 2, TP. HCM', 'tranthibinh@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1003, 'Lê Văn Cường', '0321654987', '789 Trương Định, Quận 3, TP. HCM', 'levancuong@gmail.com', '1234567890', '2024-04-14', 0, 0),
(1004, 'Phạm Thị Dung', '0765432198', '012 Trần Chính, Quận 4, TP. HCM', 'phamthidung@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1005, 'Hoàng Văn Em', '0947382910', '345 An Dương Vương, Quận 5, TP. HCM', 'hoangvanem@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1006, 'Nguyễn Thị Phương', '0981726354', '86 Hậu Giang, Quận 6, TP. HCM', 'nguyenthiphuong@gmail.com', '1234567890', '2024-04-14', 0, 0),
(1007, 'Trần Văn Giang', '0349258176', '901 Nguyễn Văn Linh, Quận 7, TP. HCM', 'tranvangiang@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1008, 'Lê Thị Hạnh', '0782456193', '234 Xuân Hòa, Quận 8, TP. HCM', 'lethihanh@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1009, 'Hoàng Thị Thảo', '0934768215', '567 Lã Xuân Oai, Quận 9, TP. HCM', 'hoangthithao@gmail.com', '1234567890', '2024-04-14', 0, 1),
(1010, 'Trần Văn Khoa', '0875913462', '890 Thành Thái, Quận 10, TP. HCM', 'tranvankhoa@gmail.com', '1234567890', '2024-04-14', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` int(11) NOT NULL,
  `DeliverName` varchar(255) DEFAULT NULL,
  `DeliveryCost` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `DeliverName`, `DeliveryCost`) VALUES
(247001, 'Giao Hàng Tiết Kiệm', 12000.000),
(247002, 'Shopee Express', 16000.000),
(247003, 'Giao Hàng Nhanh', 15000.000),
(247004, 'Giao Hàng Tiết Kiệm', 12000.000),
(247005, 'Hỏa tốc', 50000.000);

-- --------------------------------------------------------

--
-- Table structure for table `detailorders`
--

CREATE TABLE `detailorders` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Size` varchar(10) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `DeliveryID` int(11) DEFAULT NULL,
  `Status` varchar(60) DEFAULT NULL,
  `Receiver` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `ReceivedDate` datetime DEFAULT NULL,
  `PriceTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `DeliveryID`, `Status`, `Receiver`, `PhoneNumber`, `Address`, `OrderDate`, `ReceivedDate`, `PriceTotal`) VALUES
(1, 1001, 247001, 'Đang giao hàng', 'Chúa tể boom hàng', '0869423197', 'Phú Gia Thôn', '2024-04-14', NULL, 700000.00),
(2, 1002, 247002, 'Đã giao hàng', 'Bình', '0987654321', '40 Trần Tấn, Tân Phú', '2024-04-15', '2024-04-15 00:00:00', 800000.00),
(3, 1003, 247003, 'Chờ xác nhận', 'Người nhận 3', '0123456789', 'Số 456, Đường DEF, Quận UVW', '2024-04-16', NULL, 900000.00),
(4, 1004, 247004, 'Đang giao hàng', 'Trrrrrrr', '0932465871', '123/45 Đường GHI, Quận JKL', '2024-04-17', NULL, 1000000.00),
(5, 1005, 247005, 'Đã giao hàng', 'Người nhận 5', '0765432198', '678/90 Đường MNO, Quận PQR', '2024-04-18', '2024-04-18 00:00:00', 1100000.00),
(16, 1002, 247001, 'Chờ xác nhận', 'Trần Thị Bình', '0369852147', 'Số 789, Đường XYZ, Quận ABC', '2024-04-19', NULL, 1200000.00),
(17, 1001, 247001, 'Đang giao hàng', 'Nguyễn Văn An', '0928475631', '456/78 Đường DEF, Quận GHI', '2024-04-20', NULL, 700000.00),
(18, 1003, 247005, 'Đã giao hàng', 'Người nhận 3', '0857123649', '890/12 Đường JKL, Quận MNO', '2024-04-21', '2024-04-21 00:00:00', 500000.00),
(19, 1006, 247001, 'Chờ xác nhận', 'Nguyễn Thị Phương', '0495728361', '1234 Đường PQR, Quận STU', '2024-04-22', NULL, 700000.00),
(20, 1007, 247004, 'Đang giao hàng', 'Người nhận 7', '0684235719', '5678 Đường UVW, Quận XYZ', '2024-04-23', NULL, 1100000.00),
(21, 1001, 247004, 'Đã giao hàng', 'Chúa tể boom hàng', '0371852946', '9012 Đường IJK, Quận LMN', '2024-04-24', '2024-04-27 00:00:00', 1500000.00),
(22, 1007, 247001, 'Chờ xác nhận', 'Shipper 12', '0916375824', '3456 Đường OPQ, Quận RST', '2024-04-25', NULL, 1800000.00),
(23, 1003, 247002, 'Đang giao hàng', 'Lê Văn Cường', '0584927361', '7890 Đường UVW, Quận XYZ', '2024-04-26', NULL, 1200000.00),
(24, 1005, 247005, 'Đã giao hàng', 'Em iuu', '0765492831', '2345 Đường MNO, Quận PQR', '2024-04-27', '2024-04-30 00:00:00', 300000.00),
(25, 1002, 247002, 'Chờ xác nhận', 'Trần Thị Bình', '0938745612', '6789 Đường STU, Quận VWX', '2024-04-28', NULL, 900000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `TypeID` int(11) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `ImageHV` varchar(255) DEFAULT NULL,
  `SizeS` int(11) DEFAULT NULL,
  `SizeM` int(11) DEFAULT NULL,
  `SizeL` int(11) DEFAULT NULL,
  `SizeXL` int(11) DEFAULT NULL,
  `Price` decimal(10,3) DEFAULT NULL,
  `SalePrice` decimal(10,3) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `TypeID`, `ProductName`, `Image`, `ImageHV`, `SizeS`, `SizeM`, `SizeL`, `SizeXL`, `Price`, `SalePrice`, `Description`, `Status`) VALUES
(1, 1, 'BUCKLE LIPS TEE', './assets/image/BUCKLE LIPS TEE.png', './assets/image/BUCKLE LIPS TEE - hover.webp', 45, 30, 35, 40, 360000.000, NULL, 'Form basic mới\nÁo bo cổ\nThiết kế 2 line dọc theo vai áo\nHoạ tiết chữ mặt trước sử dụng kỹ thuật thêu nổi\nNameplate inox đính ở mặt sau áo\nChất liệu: Cotton 2 chiều', 1),
(2, 1, 'OCEAN MEDITATION BOXY', './assets/image/OCEAN MEDITATION BOXY TEE.png', './assets/image/OCEAN MEDITATION BOXY TEE-Hover.webp', 35, 30, 25, 40, 320000.000, 299999.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(3, 2, 'SPIRIT BLACK', './assets/image/spirit black- tee.png', './assets/image/spirit black- tee-hover.webp', 30, 45, 99, 40, 280000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(4, 3, 'PARALLEL TEE', './assets/image/PARALLEL TEE.png', './assets/image/PARALLEL TEE-Hover.jpg', 26, 31, 30, 40, 200000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(5, 1, 'HOODIE SPACE', './assets/image/HOODIE SPACE.jpg', './assets/image/HOODIE SPACE -Hover.jpg', 30, 68, 55, 20, 320000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(6, 3, 'HEBREW BOXY HOODIE', './assets/image/HEBREW BOXY HOODIE.png', './assets/image/HEBREW BOXY HOODIE -Hover.webp', 30, 39, 31, 40, 340000.000, 310000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(7, 3, 'Double Pocket', './assets/image/Double Pocket - shirt.png', './assets/image/Double Pocket - shirt- Hover.webp', 39, 50, 80, 40, 350000.000, 320000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(8, 1, 'ROYAL HORSE SHIRT', './assets/image/ROYAL HORSE SHIRT.jpg', './assets/image/ROYAL HORSE SHIRT-Hover.jpg', 30, 34, 91, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(9, 2, 'Cyrus Shirt', './assets/image/Cyrus Shirt.png', './assets/image/Cyrus Shirt-Hover.jpg', 30, 70, 39, 41, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(10, 4, 'ROCKETMAN POLO', './assets/image/ROCKETMAN POLO.webp', './assets/image/ROCKETMAN POLO-Hover.jpg', 20, 310, 36, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(11, 1, 'BAD ROMANCE TEE', './assets/image/bad-romance-tee.png', './assets/image/bad-romance-tee-hover.webp', 68, 31, 48, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(12, 1, 'BUTTERFLY KISS TEE', './assets/image/BUTTERFLY KISS TEE.jpg', './assets/image/BUTTERFLY KISS TEE- hover.webp', 30, 37, 80, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(13, 1, 'NEIL MOON TEE', './assets/image/NEIL MOON TEE.jpg', './assets/image/NEIL MOON TEE-Hover.webp', 22, 38, 30, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(14, 1, 'TOURO GRIM TEE', './assets/image/TOURO GRIM TEE.jpg', './assets/image/TOURO GRIM TEE-Hover.webp', 30, 31, 38, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(15, 1, 'SONIE LINE TEE', './assets/image/SONIE LINE TEE.jpg', './assets/image/SONIE LINE TEE-Hover.webp', 30, 44, 39, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(16, 1, 'COMMONLY TEE', './assets/image/commonly -tee.jpg', './assets/image/commonly -tee-hover.jpeg', 31, 36, 30, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(17, 5, 'MAJOR PIECES JACKET', './assets/image/MAJOR PIECES JACKET.png', './assets/image/MAJOR PIECES JACKET-Hover.webp', 30, 25, 30, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(18, 1, 'MADNESS', './assets/image/madness - tee.jpg', './assets/image/madness - tee- hover.webp', 30, 31, 38, 40, 350000.000, 330000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(19, 1, 'CHILLING INSIDE', './assets/image/chilling inside - tee.jpg', './assets/image/chilling_inside_tee-hover.webp', 68, 30, 32, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(20, 1, 'VIETNAMESE TEE', './assets/image/vietnamese - tee.jpg', './assets/image/vietnamese - tee- hover.jpg', 30, 38, 30, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(21, 4, 'UNIFY POLO', './assets/image/UNIFY POLO.png', './assets/image/UNIFY POLO-hover.webp', 29, 39, 20, 50, 360000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(22, 4, 'COUNTERPART', './assets/image/counterpart - polo.png', './assets/image/counterpart - polo -Hover.webp', 45, 30, 35, 40, 360000.000, NULL, 'Form basic mới\nÁo bo cổ\nThiết kế 2 line dọc theo vai áo\nHoạ tiết chữ mặt trước sử dụng kỹ thuật thêu nổi\nNameplate inox đính ở mặt sau áo\nChất liệu: Cotton 2 chiều', 1),
(23, 4, 'ALLYSON ATHLETE JERSEY', './assets/image/ALLYSON ATHLETE JERSEY polo.png', './assets/image/ALLYSON ATHLETE JERSEY polo-hover.webp', 35, 30, 25, 40, 420000.000, 399000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(24, 1, 'HURDLES ON', './assets/image/HURDLES ON TEE.png', './assets/image/HURDLES ON TEE-Hover.jpg', 30, 39, 31, 20, 380000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(25, 4, 'GOOD VIBE POLO', './assets/image/good vibe - polo.png', './assets/image/good vibe - hover.webp', 30, 30, 60, 40, 699000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(26, 4, 'ESSENTIALS POLO', './assets/image/essentials polo.png', './assets/image/essentials polo- hover.webp', 30, 78, 32, 40, 480000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(27, 1, 'DECEITFUL TEE', './assets/image/DECEITFUL TEE.png', './assets/image/DECEITFUL TEE- Hover.webp', 39, 20, 37, 40, 340000.000, 320000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(28, 4, 'SPIKES SPORT JERSEY', './assets/image/SPIKES SPORT JERSEY POLO.png', './assets/image/SPIKES SPORT JERSEY POLO-Hover.webp', 30, 31, 30, 40, 340000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(29, 4, 'LILIES POLO', './assets/image/LILIES POLO.jpg', './assets/image/LILIES POLO-Hover.jpg', 79, 30, 51, 40, 240000.000, 220000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(30, 4, 'SPECIAL POLO', './assets/image/special - polo.jpg', './assets/image/special - polo-hover.webp', 60, 29, 30, 40, 340000.000, 320000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(31, 4, 'UNIFY POLO', './assets/image/UNIFY POLO.png', './assets/image/UNIFY POLO-hover.webp', 29, 39, 20, 50, 360000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(32, 4, 'COUNTERPART', './assets/image/counterpart - polo.png', './assets/image/counterpart - polo -Hover.webp', 45, 30, 35, 40, 360000.000, NULL, 'Form basic mới\nÁo bo cổ\nThiết kế 2 line dọc theo vai áo\nHoạ tiết chữ mặt trước sử dụng kỹ thuật thêu nổi\nNameplate inox đính ở mặt sau áo\nChất liệu: Cotton 2 chiều', 1),
(33, 4, 'ALLYSON ATHLETE JERSEY', './assets/image/ALLYSON ATHLETE JERSEY polo.png', './assets/image/ALLYSON ATHLETE JERSEY polo-hover.webp', 35, 30, 25, 40, 420000.000, 399000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(34, 1, 'HURDLES ON', './assets/image/HURDLES ON TEE.png', './assets/image/HURDLES ON TEE-Hover.jpg', 30, 39, 31, 20, 380000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(35, 4, 'GOOD VIBE POLO', './assets/image/good vibe - polo.png', './assets/image/good vibe - hover.webp', 30, 30, 60, 40, 699000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(36, 4, 'ESSENTIALS POLO', './assets/image/essentials polo.png', './assets/image/essentials polo- hover.webp', 30, 78, 32, 40, 480000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(37, 1, 'DECEITFUL TEE', './assets/image/DECEITFUL TEE.png', './assets/image/DECEITFUL TEE- Hover.webp', 39, 20, 37, 40, 340000.000, 320000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(38, 4, 'SPIKES SPORT JERSEY', './assets/image/SPIKES SPORT JERSEY POLO.png', './assets/image/SPIKES SPORT JERSEY POLO-Hover.webp', 30, 31, 30, 40, 340000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(39, 4, 'LILIES POLO', './assets/image/LILIES POLO.jpg', './assets/image/LILIES POLO-Hover.jpg', 79, 30, 51, 40, 240000.000, 220000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(40, 4, 'SPECIAL POLO', './assets/image/special - polo.jpg', './assets/image/special - polo-hover.webp', 60, 29, 30, 40, 340000.000, 320000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(61, 4, 'LIQUID POLO', './assets/image/LIQUID POLO.webp', './assets/image/LIQUID POLO-Hover.jpg', 30, 34, 68, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(62, 5, 'NEGATIVITY HIDE', './assets/image/NEGATIVITY HIDE jacket.png', './assets/image/NEGATIVITY HIDE jacket- hover.webp', 30, 39, 30, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(63, 5, 'FEEL ALIVE JACKET', './assets/image/FEEL ALIVE JACKET.webp', './assets/image/FEEL ALIVE JACKET-Hover.webp', 30, 37, 34, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(64, 5, 'DOMINATOR LEATHER JACKET', './assets/image/DOMINATOR LEATHER JACKET.webp', './assets/image/DOMINATOR LEATHER JACKET- Hover.webp', 30, 34, 55, 40, 650000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(65, 5, 'MONOGRAM CARDIGAN', './assets/image/MONOGRAM CARDIGAN- jacket.jpg', './assets/image/MONOGRAM CARDIGAN- jacket- hover.webp', 30, 48, 69, 40, 500000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(66, 4, 'WRAPPED POLO', './assets/image/WRAPPED POLO.png', './assets/image/WRAPPED POLO_hover.webp', 30, 37, 10, 40, 540000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(67, 3, 'Slim Jean Shirt', './assets/image/Slim Jean Shirt.png', './assets/image/Slim Jean Shirt-Hover.jpg', 30, 31, 38, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(68, 3, 'Signature Shirt', './assets/image/Signature Shirt.png', './assets/image/Signature Shirt-hover.webp', 30, 39, 30, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(69, 3, 'Mende Studio Shirt', './assets/image/Mende Studio Shirt.png', './assets/image/Mende Studio Shirt-Hover.jpeg', 30, 30, 30, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(70, 1, 'PERENNIAL HEART TEE', './assets/image/PERENNIAL HEART TEE.png', './assets/image/PERENNIAL HEART TEE-Hover.webp', 30, 37, 60, 40, 699000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(71, 3, 'Silky Caro', './assets/image/Silky Caro - shirt.png', './assets/image/Silky Caro - shirt-hover.webp', 30, 99, 35, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(72, 3, 'Silky Caro White', './assets/image/Silky Caro  white- shirt.png', './assets/image/Silky Caro  white- shirt-hover.png', 30, 39, 68, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(73, 3, 'Corduroy Shirt', './assets/image/Corduroy Shirt.png', './assets/image/Corduroy Shirt-Hover.webp', 30, 37, 34, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(74, 3, 'Original Shirt', './assets/image/Original Shirt.png', './assets/image/Original Shirt-Hover.jpg', 30, 34, 52, 40, 350000.000, 330000.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(75, 3, 'Ruku Shirt', './assets/image/Ruku Shirt.png', './assets/image/Ruku Shirt-Hover.webp', 37, 77, 33, 40, 500000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(76, 1, 'SAIGON VINTAGE', './assets/image/saigon vintage - tee.png', './assets/image/saigon vintage - tee-hover.webp', 30, 37, 10, 40, 540000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(77, 5, 'ALPHABETIC JEAN JACKET', './assets/image/ALPHABETIC JEAN JACKET.jpg', './assets/image/ALPHABETIC JEAN JACKET-hover.webp', 30, 39, 51, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(78, 5, 'HALMORT JACKET', './assets/image/HALMORT JACKET.webp', './assets/image/HALMORT JACKET-Hover.webp', 70, 35, 30, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(79, 5, 'smoke jaket', './assets/image/smoke jacket.jpg', './assets/image/smoke jacket-Hover.webp', 30, 99, 51, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(80, 2, 'LITHE BOXY HOODIE', './assets/image/LITHE BOXY HOODIE.png', './assets/image/LITHE BOXY HOODIE-Hover.webp', 30, 40, 37, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(81, 2, 'TUMBLEDOWN BOXY HOODIE', './assets/image/TUMBLEDOWN BOXY HOODIE.png', './assets/image/TUMBLEDOWN BOXY HOODIE-Hover.webp', 30, 99, 51, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(82, 2, 'LONER CLUB BOXY HOODIE', './assets/image/LONER CLUB BOXY HOODIE.png', './assets/image/LONER CLUB BOXY HOODIE-Hover.webp', 30, 91, 50, 40, 350000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(83, 2, 'QUADRATE BOXY HOODIE', './assets/image/QUADRATE BOXY HOODIE.png', './assets/image/QUADRATE BOXY HOODIE-Hover.webp', 30, 39, 33, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(84, 2, 'METAL TRUNKS BOXY HOODIE', './assets/image/METAL TRUNKS BOXY HOODIE.png', './assets/image/METAL TRUNKS BOXY HOODIE-Hover.webp', 30, 37, 34, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(85, 2, 'WAY ON CLOUD HOODIE', './assets/image/WAY ON CLOUD HOODIE.png', './assets/image/WAY ON CLOUD HOODIE-Hover.webp', 30, 34, 55, 40, 250000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(86, 2, 'CHRONICLE HOODIE', './assets/image/CHRONICLE HOODIE.png', './assets/image/CHRONICLE HOODIE- Hover.webp', 39, 33, 60, 40, 500000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(87, 5, 'LABEL EMBROIDERED JACKET', './assets/image/LABEL EMBROIDERED JACKET.webp', './assets/image/LABEL EMBROIDERED JACKET- Hover.jpg', 30, 37, 34, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(88, 5, 'ENFOLD JACKET', './assets/image/ENFOLD JACKET.webp', './assets/image/ENFOLD JACKET-Hover.webp', 30, 34, 54, 40, 450000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(89, 5, 'Legacy Line Jacket', './assets/image/Legacy Line Jacket.webp', './assets/image/Legacy Line Jacket- Hover.webp', 37, 38, 30, 40, 500000.000, 399999.000, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1),
(90, 5, 'Legacy Line United', './assets/image/Legacy Line United.webp', './assets/image/Legacy Line United- Hover.webp', 37, 38, 30, 40, 500000.000, NULL, 'Form boxy\nGraphic in kéo full bản ở mặt trước và mặt sau áo\nLogo Hades thêu nổi ở tay áo\nChất liệu: Cotton 2 chiều', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TypeID`, `TypeName`, `Status`) VALUES
(1, 'Áo Thun', 1),
(2, 'Áo Hoodie', 1),
(3, 'Áo Sơ mi', 1),
(4, 'Áo Polo', 1),
(5, 'Áo Khoác', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CustomerID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `detailorders`
--
ALTER TABLE `detailorders`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_CustomerID_Customer` (`CustomerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_TypeID_Type` (`TypeID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `detailorders`
--
ALTER TABLE `detailorders`
  ADD CONSTRAINT `detailorders_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `detailorders_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_CustomerID_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `FK_DeliveryID` FOREIGN KEY (`DeliveryID`) REFERENCES `delivery` (`DeliveryID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_TypeID_Type` FOREIGN KEY (`TypeID`) REFERENCES `type` (`TypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
