-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 31, 2021 lúc 07:38 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `elaravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(10) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_slug` varchar(255) NOT NULL,
  `brand_desc` text NOT NULL,
  `brand_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_slug`, `brand_desc`, `brand_status`) VALUES
(1, 'Kokomi', 'kokomi', 'chất lượng cao', 0),
(2, 'Gấu đỏ', 'gau-do', 'chất lượng cao', 0),
(3, 'ViFon', 'vifon', 'chất lượng cao', 0),
(4, 'Vinamilk', 'vinamilk', 'chất lượng cao', 0),
(5, 'Wincofood', 'wincofood', 'sua-bot-wincofood-goldcare-gain-huong-vani-lon-900g-danh-cho-nguoi-gay', 0),
(6, 'Milo', 'milo', 'chất lượng cao', 0),
(7, 'Coca Cola', 'coca-cola', '<p>chất lượng cao</p>', 0),
(8, 'Pepsi', 'Pepsi', 'chất lượng cao', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `slug`, `status`, `type`) VALUES
(3, 'Đồ uống các loại', 'do-uong-cac-loai', 0, 0),
(4, 'Mì cháo phở ăn liền', 'mi-chao-pho-an-lien', 0, 0),
(5, 'Sữa các loại', 'sua-cac-loai', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug_category_product` varchar(255) NOT NULL,
  `category_desc` text NOT NULL,
  `category_status` int(10) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `slug_category_product`, `category_desc`, `category_status`, `id`) VALUES
(1, 'Mì ăn liền', 'mi', 'ngon, bổ, rẻ', 0, 4),
(2, 'Cháo ăn liền', 'chao-an-lien', '<p>ngon, bổ, rẻ</p>', 0, 4),
(3, 'Phở ăn liền', 'pho', 'ngon,bổ, rẻ', 0, 4),
(4, 'Sữa', 'sua', 'ngon, bổ, rẻ', 0, 5),
(5, 'Nước giải khát', 'nuoc-giai-khat', '<p>ngon, bổ, rẻ</p>', 0, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `coupon_id` int(10) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_time` int(50) NOT NULL,
  `coupon_condition` int(11) NOT NULL,
  `coupon_number` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_coupon`
--

INSERT INTO `tbl_coupon` (`coupon_id`, `coupon_name`, `coupon_time`, `coupon_condition`, `coupon_number`, `coupon_code`) VALUES
(1, 'Giảm giá 30/4', 6, 1, 10, 'HDH375Y'),
(2, 'GIAM GIA', 0, 2, 100000, 'COVID99'),
(3, 'Giam Gia Mua He', 15, 2, 50000, 'NLN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`) VALUES
(1, 'A', 'A@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456798'),
(3, 'B', 'B@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1234567891'),
(5, 'C', 'C@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456'),
(6, 'D', 'D@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(10) NOT NULL,
  `news_name` varchar(255) NOT NULL,
  `news_slug` varchar(255) NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_desc` text NOT NULL,
  `news_content` longtext NOT NULL,
  `news_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `news_name`, `news_slug`, `news_image`, `news_desc`, `news_content`, `news_status`) VALUES
(1, 'Cùng đổi gió cuối tuần với món rau muống xào chao lạ miệng', 'cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng', 'cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-2020041208261469592281.png', '<h2>Rau muống l&agrave; một loại rau phổ biến, thường xuất hiện tr&ecirc;n m&acirc;m cơm của mỗi gia đ&igrave;nh. Rau muống chứa nhiều chất dinh dưỡng hỗ trợ cho tim mạch, giảm mức mỡ trong m&aacute;u v&agrave; c&ograve;n l&agrave; loại rau giảm lượng đường huyết trong m&aacute;u rất tốt. Ngo&agrave;i m&oacute;n rau muống x&agrave;o tỏi m&agrave; ai ai cũng m&ecirc;, th&igrave; m&oacute;n rau muống x&agrave;o chao dưới đ&acirc;y l&agrave; một c&aacute;ch chế biến kh&aacute;c cho loại rau th&acirc;n thiện với sức khỏe n&agrave;y nh&eacute;!</h2>', '<h1>C&ugrave;ng đổi gi&oacute; cuối tuần với m&oacute;n rau muống x&agrave;o chao lạ miệng</h1>\r\n\r\n<h2>Rau muống l&agrave; một loại rau phổ biến, thường xuất hiện tr&ecirc;n m&acirc;m cơm của mỗi gia đ&igrave;nh. Rau muống chứa nhiều chất dinh dưỡng hỗ trợ cho tim mạch, giảm mức mỡ trong m&aacute;u v&agrave; c&ograve;n l&agrave; loại rau giảm lượng đường huyết trong m&aacute;u rất tốt. Ngo&agrave;i m&oacute;n rau muống x&agrave;o tỏi m&agrave; ai ai cũng m&ecirc;, th&igrave; m&oacute;n rau muống x&agrave;o chao dưới đ&acirc;y l&agrave; một c&aacute;ch chế biến kh&aacute;c cho loại rau th&acirc;n thiện với sức khỏe n&agrave;y nh&eacute;!</h2>\r\n\r\n<p>Xem nhanh</p>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-1248487#hmenuid1\">1. Nguy&ecirc;n liệu</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-1248487#hmenuid2\">2. C&aacute;ch l&agrave;m m&oacute;n rau muống x&agrave;o chao</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-1248487#hmenuid3\">3. Th&agrave;nh quả</a></h5>\r\n\r\n<p>Rau muống v&agrave; chao l&agrave; hai m&oacute;n ăn d&acirc;n d&atilde; dễ t&igrave;m. Đ&atilde; bao giờ bạn thử kết hợp hai m&oacute;n n&agrave;y xem khẩu vị sẽ như thế n&agrave;o chưa? Từng cọng rau muống gi&ograve;n v&agrave; ngọt quyện c&ugrave;ng với vị chao b&eacute;o ngậy. H&atilde;y để B&aacute;ch H&oacute;a Xanh m&aacute;ch bạn c&aacute;ch kết hợp hai nguy&ecirc;n liệu n&agrave;y để l&agrave;m m&oacute;n rau muống x&agrave;o chao đơn giản để bổ sung v&agrave;o thực đơn cho những ng&agrave;y ăn chay hoặc những ng&agrave;y loay hoay kh&ocirc;ng biết phải nấu m&oacute;n g&igrave; nh&eacute;!</p>\r\n\r\n<h3>Nguy&ecirc;n liệu</h3>\r\n\r\n<ul>\r\n	<li>1 b&oacute; rau muống sạch</li>\r\n	<li>1 hũ&nbsp;<a href=\"https://www.bachhoaxanh.com/tuong-chao\" target=\"_blank\">chao</a>&nbsp;nhỏ</li>\r\n	<li>Một &iacute;t tỏi,&nbsp;<a href=\"https://www.bachhoaxanh.com/dau-an\" target=\"_blank\">dầu ăn</a>, gia vị</li>\r\n</ul>\r\n\r\n<h3>C&aacute;ch l&agrave;m m&oacute;n rau muống x&agrave;o chao</h3>\r\n\r\n<p><strong>Bước 1: Sơ chế nguy&ecirc;n liệu</strong></p>\r\n\r\n<p><img alt=\"\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248487/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-202004120822583087.jpg\" /></p>\r\n\r\n<p>Sơ chế rau muống v&agrave; pha chao. Rau muống sau khi mua về, bạn nhặt lấy cọng non. Để đảm bảo an to&agrave;n, bạn n&ecirc;n rửa sạch rau với nước khoảng 3, 4 lần cho hết bụi bẩn rồi ng&acirc;m rau v&agrave;o nước&nbsp;<a href=\"https://www.bachhoaxanh.com/muoi-an\" target=\"_blank\">muối</a>&nbsp;pha lo&atilde;ng khoảng 10 ph&uacute;t, sau đ&oacute; vớt rau ra rổ để cho r&aacute;o nước. Tỏi đem đi b&oacute;c vỏ v&agrave; băm nhỏ ra. M&uacute;c chao ra ch&eacute;n, trộn v&agrave;o khoảng &frac12; th&igrave;a c&agrave; ph&ecirc;&nbsp;<a href=\"https://www.bachhoaxanh.com/duong\" target=\"_blank\">đường</a>, c&oacute; thể cho th&ecirc;m đường t&ugrave;y khẩu vị, d&ugrave;ng th&igrave;a t&aacute;n nhuyễn chao ra.</p>\r\n\r\n<p><strong>Bước 2: Luộc rau muống.</strong></p>\r\n\r\n<p><img alt=\"Bước 2: Luộc rau muống.\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248487/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-202004120825467844.jpg\" title=\"Bước 2: Luộc rau muống.\" /></p>\r\n\r\n<p>Bắc một nồi nước s&ocirc;i, cho v&agrave;o nồi một ch&uacute;t muối v&agrave; dầu ăn gi&uacute;p rau xanh v&agrave; mướt hơn khi x&agrave;o, sau đ&oacute; cho rau muống v&agrave;o chần sơ qua. Kh&ocirc;ng n&ecirc;n luộc qu&aacute; kỹ v&igrave; rau sẽ bị n&aacute;t, khi x&agrave;o l&ecirc;n sẽ kh&ocirc;ng ngon v&igrave; mất đi vị dai c&oacute; sẵn của rau muống.</p>\r\n\r\n<p><strong>Lưu &yacute;:</strong>&nbsp;Với những rau khi luộc xong nước luộc rau c&oacute; m&agrave;u xanh nhạt, nhưng khi nguội lại c&oacute; m&agrave;u đen v&agrave; kết tủa, đ&oacute; ch&iacute;nh l&agrave; rau đ&atilde; được b&oacute;n qu&aacute; nhiều ph&acirc;n b&oacute;n, cần c&acirc;n nhắc khi sử dụng.</p>\r\n\r\n<p><strong>Bước 3: Chần rau</strong></p>\r\n\r\n<p><img alt=\"Bước 3: Chần rau\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248487/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-202004120826146959.png\" title=\"Bước 3: Chần rau\" /></p>\r\n\r\n<p>Vớt rau đ&atilde; luộc ra. Sau khi chần rau tới độ ch&iacute;n vừa đủ, bạn rớt rau ra v&agrave; tr&aacute;ng qua với nước c&oacute; đ&aacute; lạnh, để khoảng 2 ph&uacute;t cho rau giảm độ n&oacute;ng, vớt rau ra rổ cho r&aacute;o nước. Việc n&agrave;y sẽ gi&uacute;p rau xanh c&oacute; độ gi&ograve;n, ngon ngọt hơn.</p>\r\n\r\n<p><strong>Bước 4: X&agrave;o rau muống c&ugrave;ng chao</strong></p>\r\n\r\n<p><img alt=\"Xào rau muống cùng chao\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248487/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-202004120827201300.jpg\" title=\"Xào rau muống cùng chao\" /></p>\r\n\r\n<p>L&agrave;m n&oacute;ng chảo, sau đ&oacute; cho dầu v&agrave; tỏi v&agrave;o phi dậy m&ugrave;i thơm. Một lưu &yacute; nhỏ l&agrave; kh&ocirc;ng n&ecirc;n phi tỏi v&agrave;ng qu&aacute;, v&igrave; khi x&agrave;o tiếp với rau tỏi sẽ bị ch&aacute;y, ăn kh&ocirc;ng ngon. Tiếp đến, cho rau muống v&agrave;o v&agrave; đảo đều tay tr&ecirc;n lửa lớn, th&ecirc;m chao v&agrave;o đảo c&ugrave;ng. Tiến h&agrave;nh n&ecirc;m nếm cho vừa khẩu vị, v&igrave; chao đ&atilde; mặn n&ecirc;n khi x&agrave;o c&aacute;c bạn c&oacute; thể kh&ocirc;ng cần th&ecirc;m nhiều gia vị. Khi rau ch&iacute;n, nhấc ra khỏi bếp v&agrave; đổ rau ra dĩa, th&ecirc;m v&agrave;o &iacute;t ti&ecirc;u cho m&oacute;n ăn thơm ngon hơn.</p>\r\n\r\n<h3>Th&agrave;nh quả</h3>\r\n\r\n<p><img alt=\"Thành quả rau muống xào chao\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248487/cung-doi-gio-cuoi-tuan-voi-mon-rau-muong-xao-chao-la-mieng-202004120828087555.jpg\" title=\"Thành quả rau muống xào chao\" /></p>\r\n\r\n<p>Rau muống x&agrave;o c&oacute; m&agrave;u xanh mướt do đ&atilde; ng&acirc;m rau c&ugrave;ng với nước đ&aacute;. Rau c&oacute; vị gi&ograve;n ngọt, thơm m&ugrave;i tỏi v&agrave; h&ograve;a quyện c&ugrave;ng với chao rất vừa miệng. Chỉ cần th&ecirc;m một ch&eacute;n cơm n&oacute;ng, bạn đ&atilde; c&oacute; ngay một bữa cơm ngon l&agrave;nh đầy chất dinh dưỡng. M&oacute;n rau muống x&agrave;o chao th&iacute;ch hợp cho cả bữa ăn chay v&agrave; ăn mặn.</p>\r\n\r\n<p>Những m&oacute;n rau lu&ocirc;n mang lại nhiều chất xơ tốt cho hệ ti&ecirc;u h&oacute;a của cơ thể v&agrave; đồng thời kh&ocirc;ng g&acirc;y tăng c&acirc;n. Ăn nhiều rau xanh thải đi nhiều độc tố c&oacute; hại cho l&agrave;n da, gi&uacute;p cho l&agrave;n da hồng h&agrave;o rạng rỡ. Cho những ng&agrave;y bận rộn hoặc ch&aacute;n ng&aacute;n những m&oacute;n ăn thường nấu, bạn h&atilde;y thử bắt tay v&agrave;o l&agrave;m m&oacute;n rau muống x&agrave;o chao để thay đổi khẩu vị m&agrave; vẫn đảm bảo tốt cho cơ thể bạn nh&eacute;!</p>\r\n\r\n<p>Xem lại:&nbsp;<a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/bi-quyet-cho-dia-rau-muong-xao-toi-xanh-gion-nhu-o-tiem-1073877\" target=\"_blank\">C&aacute;ch l&agrave;m rau muống x&agrave;o tỏi xanh mướt, gi&ograve;n ngon</a></p>', 0),
(2, 'Những mẹo vặt hay chỉ với chai nước ngọt có gas bạn uống hàng ngày', 'nhung-meo-vat-hay-chi-voi-chai-nuoc-ngot-co-gas-ban-uong-hang-ngay-1248356', 'vitamin-d3-khac-voi-vitamin-d-nhu-the-nao-6_760x367-600x40066.jpg', '<h2>Vitamin D3 hay c&ograve;n gọi l&agrave; Cholecalciferol, l&agrave; một dạng tự nhi&ecirc;n của vitamin D, được cơ thể hấp thụ v&agrave; tạo ra nhờ &aacute;nh s&aacute;ng mặt trời qua da,&nbsp;đ&oacute;ng vai tr&ograve; quan trọng trong việc tổng hợp v&agrave; chuyển h&oacute;a canxi cho cơ thể.</h2>', '<h1>Vitamin D3 l&agrave; g&igrave;? N&oacute; c&oacute; kh&aacute;c với vitamin D kh&ocirc;ng?</h1>\r\n\r\n<h2>Vitamin D3 hay c&ograve;n gọi l&agrave; Cholecalciferol, l&agrave; một dạng tự nhi&ecirc;n của vitamin D, được cơ thể hấp thụ v&agrave; tạo ra nhờ &aacute;nh s&aacute;ng mặt trời qua da,&nbsp;đ&oacute;ng vai tr&ograve; quan trọng trong việc tổng hợp v&agrave; chuyển h&oacute;a canxi cho cơ thể.</h2>\r\n\r\n<p>Xem nhanh</p>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/vitamin-d3-la-gi-no-co-khac-voi-vitamin-d-khong-1000801#hmenuid1\">1. Vitamin D3 c&oacute; giống với vitamin D?</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/vitamin-d3-la-gi-no-co-khac-voi-vitamin-d-khong-1000801#hmenuid2\">2. Vai tr&ograve; của vitamin D3 đối với sức khỏe</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/vitamin-d3-la-gi-no-co-khac-voi-vitamin-d-khong-1000801#hmenuid3\">3. L&agrave;m thế n&agrave;o để bổ sung vitamin D3?</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/vitamin-d3-la-gi-no-co-khac-voi-vitamin-d-khong-1000801#hmenuid4\">4. Nhu cầu ti&ecirc;u thụ vitamin D3 của mỗi người</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/vitamin-d3-la-gi-no-co-khac-voi-vitamin-d-khong-1000801#hmenuid5\">5. Một số lưu &yacute; khi ti&ecirc;u thụ vitamin D3</a></h5>\r\n\r\n<h3>Vitamin D3 c&oacute; giống với vitamin D?</h3>\r\n\r\n<p>Thực chất, vitamin D l&agrave; một vitamin phức tạp, được xem l&agrave; một t&ecirc;n gọi chung cho c&aacute;c loại vitamin D2 v&agrave; D3, đ&acirc;y l&agrave; 2 nh&aacute;nh lớn của n&oacute;.</p>\r\n\r\n<p>Vitamin D v&agrave; vitamin D3 c&oacute; một số đặc t&iacute;nh giống nhau đ&oacute; l&agrave; c&ugrave;ng tổng hợp canxi cho cơ thể.</p>\r\n\r\n<p>Điểm kh&aacute;c ở đ&acirc;y l&agrave; vitamin D c&oacute; thể được bổ sung từ nhiều nguồn kh&aacute;c nhau. Tuy nhi&ecirc;n, vitamin D3 chỉ được hấp thụ khi cơ thể tiếp x&uacute;c với &aacute;nh nắng mặt trời.</p>\r\n\r\n<p><img alt=\"Vitamin D3 có giống với vitamin D?\" src=\"https://cdn.tgdd.vn/Files/2017/07/08/1000801/vitamin-d3-khac-voi-vitamin-d-nhu-the-nao-9_800x400.jpg\" title=\"Vitamin D3 có giống với vitamin D?\" /></p>\r\n\r\n<h3>Vai tr&ograve; của vitamin D3 đối với sức khỏe</h3>\r\n\r\n<p><strong>Đối với trẻ em v&agrave; người lớn tuổi</strong></p>\r\n\r\n<p>Vitamin D3 gi&uacute;p trẻ em cao lớn, xương chắc khỏe, điều trị v&agrave; ngăn ngừa bệnh lo&atilde;ng xương ở người gi&agrave;.</p>\r\n\r\n<p>Vitamin D3 cũng hỗ trợ trong sự điều chỉnh của tế b&agrave;o, k&iacute;ch hoạt phản ứng miễn dịch của cơ thể v&agrave; diệt vi khuẩn.</p>\r\n\r\n<p>C&oacute; khả năng ngăn ngừa ung thư v&agrave; hạ đường huyết.</p>\r\n\r\n<p><img alt=\"Đối với trẻ em và người lớn tuổi\" src=\"https://cdn.tgdd.vn/Files/2017/07/08/1000801/vitamin-d3-khac-voi-vitamin-d-nhu-the-nao-_800x400.jpg\" title=\"Đối với trẻ em và người lớn tuổi\" /></p>\r\n\r\n<p><strong>Đối với phụ nữ mang thai</strong></p>\r\n\r\n<p>Ph&aacute;t triển hệ sinh sản ở nữ giới, v&igrave; thế gi&uacute;p cho qu&aacute; tr&igrave;nh mang thai diễn ra thuận lợi hơn.</p>\r\n\r\n<p>Gi&uacute;p xương v&agrave; răng của thai nhi ph&aacute;t triển khỏe mạnh, đặc biệt vitamin D3 gi&uacute;p l&agrave;m cứng xương hộp sọ để bảo vệ sự ph&aacute;t triển về tr&iacute; n&atilde;o cho thai nhi.</p>\r\n\r\n<p>Gi&uacute;p ngăn ngừa biến chứng trong qu&aacute; tr&igrave;nh mang thai, giảm nguy cơ đẻ non l&agrave;m nguy hại đến t&iacute;nh mạng cả mẹ v&agrave; em b&eacute;.</p>\r\n\r\n<p><img alt=\"Đối với phụ nữ mang thai\" src=\"https://cdn.tgdd.vn/Files/2017/07/08/1000801/vitamin-d3-khac-voi-vitamin-d-nhu-the-nao-3_800x400.jpg\" title=\"Đối với phụ nữ mang thai\" /></p>\r\n\r\n<h3>L&agrave;m thế n&agrave;o để bổ sung vitamin D3?</h3>\r\n\r\n<p>Bạn kh&ocirc;ng thể chắc chắn được cơ thể m&igrave;nh sẽ hấp thụ được bao nhi&ecirc;u phần trăm vitamin D3 khi phơi nắng, điều tốt nhất l&agrave; bạn n&ecirc;n bổ sung nguồn vitamin cần thiết n&agrave;y từ những bữa ăn hằng ng&agrave;y.</p>\r\n\r\n<p>Vitamin D3 l&agrave; nguồn vitamin sản sinh ra từ tự nhi&ecirc;n, tuy nhi&ecirc;n một số thực phẩm cũng chứa một lượng lớn loại vitamin n&agrave;y v&agrave; chuyển h&oacute;a ch&uacute;ng trong khi ti&ecirc;u h&oacute;a.</p>\r\n\r\n<p><a href=\"https://www.bachhoaxanh.com/sua-bot-cong-thuc\" target=\"_blank\">Sữa c&ocirc;ng thức</a>&nbsp;l&agrave; một nguồn dinh dưỡng dồi d&agrave;o vitamin D3 cung cấp cho cơ thể, n&oacute; kh&ocirc;ng chỉ sử dụng đơn giản, m&agrave; qu&aacute; tr&igrave;nh hấp thụ vitamin D3 từ sữa cũng dễ d&agrave;ng v&agrave; nhanh ch&oacute;ng hơn. Một cốc sữa chứa đến 100 IU vitamin D3.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, trứng g&agrave;, c&aacute; hồi, t&ocirc;m, gan b&ograve; v&agrave; c&aacute;c&nbsp;<a href=\"https://www.bachhoaxanh.com/bot-ngu-coc\" rel=\"nofollow\" target=\"_blank\" title=\"loại ngũ cốc\">loại ngũ cốc</a>&nbsp;v&agrave; c&aacute;c loại&nbsp;<a href=\"https://www.bachhoaxanh.com/cac-loai-hat\" rel=\"nofollow\" target=\"_blank\" title=\"hạt\">hạt</a>&nbsp;cũng chứa một lượng lớn loại vitamin n&agrave;y. Tuy nhi&ecirc;n, để nhanh ch&oacute;ng hấp thụ v&agrave;o cơ thể, bạn cần một ch&uacute;t &aacute;nh s&aacute;ng để x&uacute;c tiến qu&aacute; tr&igrave;nh n&agrave;y.</p>\r\n\r\n<p><img alt=\"Làm thế nào để bổ sung vitamin D3?\" src=\"https://cdn.tgdd.vn/Files/2017/07/08/1000801/vitamin-d3-khac-voi-vitamin-d-nhu-the-nao-2_800x400.jpg\" title=\"Làm thế nào để bổ sung vitamin D3?\" /></p>\r\n\r\n<h3>Nhu cầu ti&ecirc;u thụ vitamin D3 của mỗi người</h3>\r\n\r\n<p>Người b&igrave;nh thường cần 400 IU D3 mỗi ng&agrave;y để gi&uacute;p duy tr&igrave; nồng độ canxi trong m&aacute;u.</p>\r\n\r\n<p>Đối với những người thiếu canxi th&igrave; liều lượng D3 được bổ sung sẽ theo chỉ định của b&aacute;c sĩ v&agrave; t&ugrave;y thuộc v&agrave;o độ tuổi của từng người.</p>\r\n\r\n<p><img alt=\"Khi thiếu hụt hoặc dư thừa canxi sẽ gây ra những triệu chứng gì?\" src=\"https://cdn.tgdd.vn/Files/2017/07/08/1000801/vitamin-d3-khac-voi-vitamin-d-nhu-the-nao-10_800x400.jpg\" title=\"Khi thiếu hụt hoặc dư thừa canxi sẽ gây ra những triệu chứng gì?\" /></p>\r\n\r\n<h3>Một số lưu &yacute; khi ti&ecirc;u thụ vitamin D3</h3>\r\n\r\n<p>Để bổ sung được vitamin D3 một c&aacute;ch tối đa, bạn n&ecirc;n&nbsp;<strong>ra ngo&agrave;i đường h&iacute;t thở kh&ocirc;ng kh&iacute; trong l&agrave;nh trước 8 giờ s&aacute;ng v&agrave; hạn chế thoa kem chống nắng</strong>, mũ n&oacute;n hay &aacute;o kho&aacute;c để da được tiếp x&uacute;c với &aacute;nh mặt trời v&agrave; chuyển h&oacute;a th&agrave;nh D3.</p>\r\n\r\n<p>Th&ecirc;m v&agrave;o đ&oacute;, n&ecirc;n chọn những sản phẩm sữa chất lượng v&agrave; rau quả, thực phẩm tươi ở c&aacute;c địa điểm mua b&aacute;n uy t&iacute;n để chăm s&oacute;c sức khỏe cả nh&agrave; một c&aacute;ch tối ưu nhất.</p>\r\n\r\n<p><em>Như vậy, vitamin D3 c&oacute; rất nhiều c&ocirc;ng dụng đối với việc hấp thu v&agrave; chuyển h&oacute;a canxi cho cơ thể, gi&uacute;p xương chắc khỏe hơn. Cần lưu &yacute; để bổ sung đầy đủ vitamin D3 bạn nh&eacute;!</em></p>', 0),
(3, 'Điều gì sẽ xảy ra khi bạn bị thiếu Vitamin D cùng tìm hiểu xem nhé', 'dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-1248486', 'dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-2020041208155556458.jpg', '<h2>Vitamin D l&agrave; một trong những loại chất cần thiết cho sự ph&aacute;t triển của cơ thể. Nếu thiếu hụt vitamin D, cơ thể sẽ mắc nhiều loại bệnh nguy hiểm!</h2>', '<h1>Điều g&igrave; sẽ xảy ra khi bạn bị thiếu Vitamin D c&ugrave;ng t&igrave;m hiểu xem nh&eacute;</h1>\r\n\r\n<h2>Vitamin D l&agrave; một trong những loại chất cần thiết cho sự ph&aacute;t triển của cơ thể. Nếu thiếu hụt vitamin D, cơ thể sẽ mắc nhiều loại bệnh nguy hiểm!</h2>\r\n\r\n<p>Xem nhanh</p>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-1248486#hmenuid1\">1. Suy giảm tr&iacute; nhớ ở người gi&agrave;</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-1248486#hmenuid2\">2. Ung thư tuyến tiền liệt</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-1248486#hmenuid3\">3. Rối loạn cương dương</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-1248486#hmenuid4\">4. Bệnh t&acirc;m thần ph&acirc;n liệt</a></h5>\r\n\r\n<h5><a href=\"https://www.bachhoaxanh.com/kinh-nghiem-hay/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-1248486#hmenuid5\">5. Bệnh tim mạch</a></h5>\r\n\r\n<p>Vitamin D được biết đến l&agrave; th&agrave;nh phần quan trọng v&agrave; cần thiết để x&acirc;y dựng v&agrave; duy tr&igrave; cấu tr&uacute;c xương, l&agrave;m cho xương khỏe mạnh v&agrave; chắc khỏe. Nếu thiếu vitamin D, ngo&agrave;i việc g&acirc;y ra c&aacute;c vấn đề ở xương th&igrave; cơ thể c&ograve;n mắc một số bệnh nghi&ecirc;m trọng. C&ugrave;ng t&igrave;m hiểu xem 5 loại bệnh nguy hiểm v&igrave; thiếu vitamin D trong b&agrave;i viết dưới đ&acirc;y để kịp thời bổ sung nh&eacute;!</p>\r\n\r\n<h3>1Suy giảm tr&iacute; nhớ ở người gi&agrave;</h3>\r\n\r\n<p><img alt=\"Suy giảm trí nhớ ở người già\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248486/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-202004120811488767.png\" title=\"Suy giảm trí nhớ ở người già\" /></p>\r\n\r\n<p>Theo nghi&ecirc;n cứu của tạp ch&iacute; Neurology,&nbsp;<strong>người gi&agrave; thiếu vitamin D sẽ c&oacute; nguy cơ mắc bệnh mất tr&iacute; nhớ cao gấp đ&ocirc;i người b&igrave;nh thường</strong>. Đ&acirc;y l&agrave; một căn bệnh nguy hiểm, ảnh hưởng trực tiếp đến suy nghĩ, h&agrave;nh vi v&agrave; tr&iacute; nhớ trong cuộc sống của người bệnh.</p>\r\n\r\n<p>Cũng theo c&aacute;c nh&agrave; khoa học, nếu thiếu vitamin D, con người sẽ c&oacute; 50% nguy cơ mắc bệnh mất tr&iacute; nhớ v&agrave; thiếu vitamin D ở mức trầm trọng th&igrave; con số sẽ l&ecirc;n đến 125%. Để tr&aacute;nh thiếu hụt vitamin D, bạn n&ecirc;n ăn uống đầy đủ, tập thể dục đều đặn v&agrave; quan t&acirc;m đến sức khỏe đời sống tinh thần.</p>\r\n\r\n<h3>2Ung thư tuyến tiền liệt</h3>\r\n\r\n<p><img alt=\"Ung thư tuyến tiền liệt\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248486/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-202004120813224164.jpg\" title=\"Ung thư tuyến tiền liệt\" /></p>\r\n\r\n<p>Nghi&ecirc;n cứu l&acirc;m s&agrave;ng về ung thư được thực hiện bởi c&aacute;c chuy&ecirc;n gia y tế đ&atilde; chỉ ra mối quan hệ của nồng độ vitamin D v&agrave; ung thư tuyến tiền liệt ở đ&agrave;n &ocirc;ng u Mỹ v&agrave; người Mỹ gốc Phi. Theo nhiều chuy&ecirc;n gia,&nbsp;<strong>việc thiếu vitamin D c&oacute; thể l&agrave; một trong những nguy&ecirc;n nh&acirc;n dẫn đến ung thư tuyến tiền liệt</strong>. Mặc d&ugrave; chưa c&oacute; b&aacute;o c&aacute;o cụ thể về mối quan hệ n&agrave;y nhưng bạn h&atilde;y bổ sung đầy đủ vitamin D để giảm nguy cơ mắc bệnh nh&eacute;!</p>\r\n\r\n<h3>3Rối loạn cương dương</h3>\r\n\r\n<p><img alt=\"Rối loạn cương dương\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248486/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-202004120813403717.jpg\" title=\"Rối loạn cương dương\" /></p>\r\n\r\n<p>Rối loạn cương dương l&agrave; vấn đề thường gặp ở nam giới. Loại bệnh n&agrave;y sẽ ảnh hưởng trực tiếp tới sức khỏe, t&acirc;m sinh l&yacute; v&agrave; đời sống t&igrave;nh dục của người đ&agrave;n &ocirc;ng. Theo nhiều nghi&ecirc;n cứu,&nbsp;<strong>nguy&ecirc;n nh&acirc;n g&acirc;y rối loạn cương dương ở đ&agrave;n &ocirc;ng l&agrave; do mắc bệnh tiểu đường, ung thư tuyến tiền liệt, huyết &aacute;p cao v&agrave; thiếu hụt vitamin D</strong>. H&atilde;y bổ sung c&aacute;c loại sữa v&agrave; ngũ cốc chứa nhiều vitamin D v&agrave; thực hiện một chế độ ăn uống l&agrave;nh mạnh để c&oacute; sức khỏe tốt.</p>\r\n\r\n<h3>4Bệnh t&acirc;m thần ph&acirc;n liệt</h3>\r\n\r\n<p><img alt=\"Bệnh tâm thần phân liệt\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248486/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-202004120813553350.jpg\" title=\"Bệnh tâm thần phân liệt\" /></p>\r\n\r\n<p>Bệnh t&acirc;m thần ph&acirc;n liệt cũng l&agrave; một trong những loại bệnh do thiếu vitamin D. Loại bệnh n&agrave;y thường xảy ra ở độ tuổi từ 16-30 với những triệu chứng như g&acirc;y ảo gi&aacute;c, n&oacute;i nhảm v&agrave; kh&oacute; tập trung. Theo một cuộc đ&aacute;nh gi&aacute; của c&aacute;c nha khoa hoc tr&ecirc;n tạp ch&iacute; Nghi&ecirc;n cứu l&acirc;m s&agrave;ng về nội tiết tố v&agrave; trao đổi chất,&nbsp;<strong>những người thiếu vitamin D th&igrave; nguy cơ mắc bệnh t&acirc;m thần ph&acirc;n liệt cũng cao gấp đ&ocirc;i người thường.</strong></p>\r\n\r\n<h3>5Bệnh tim mạch</h3>\r\n\r\n<p><img alt=\"Bệnh tim mạch\" src=\"https://cdn.tgdd.vn/Files/2020/04/12/1248486/dieu-gi-se-xay-ra-khi-ban-bi-thieu-vitamin-d-cung-tim-hieu-xem-nhe-202004120814540889.jpg\" title=\"Bệnh tim mạch\" /></p>\r\n\r\n<p><strong>Thiếu vitamin D c&oacute; thể g&acirc;y ra một số vấn đề về tim như huyết &aacute;p cao, tiểu đường, đột quỵ v&agrave; xơ vữa động mạch.</strong>&nbsp;Để bảo vệ cơ thể v&agrave; giảm nguy cơ mắc bệnh, bạn nền bổ sung đầy đủ vitamin D cho cơ thể.</p>\r\n\r\n<p>Tr&ecirc;n đ&acirc;y l&agrave; 5 loại bệnh nguy hiểm v&igrave; thiếu vitamin D. Bạn c&oacute; thể t&igrave;m thấy vitamin D ở sữa, l&ograve;ng đỏ trứng, gan b&ograve; v&agrave; c&aacute; b&eacute;o&hellip;Ngo&agrave;i ra, bạn cũng c&oacute; thể hấp thụ &aacute;nh nắng mặt trời để nạp vitamin D đấy. H&atilde;y ch&uacute; &yacute; v&agrave; bổ sung đầy đủ vitamin D để tranh những loại bệnh nguy hiểm nh&eacute;!</p>', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `shipping_id` int(10) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_status` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `shipping_id`, `order_code`, `order_status`, `created_at`, `updated_at`) VALUES
(262, 1, 269, 'e912b', 4, '2020-05-26 07:54:43', NULL),
(263, 1, 270, '0ab70', 3, '2020-05-26 08:06:15', '2020-05-26 08:07:11'),
(264, 1, 271, '29bc3', 3, '2020-05-27 07:22:32', '2020-05-27 08:25:11'),
(265, 1, 272, '9e33b', 1, '2020-05-27 07:23:31', NULL),
(266, 1, 273, '51efc', 1, '2020-06-03 08:03:23', NULL),
(267, 1, 274, '0f622', 1, '2020-06-04 03:19:54', NULL),
(268, 1, 275, '5e394', 1, '2020-06-04 03:20:53', NULL),
(269, 1, 276, '56a6c', 1, '2020-06-04 03:22:28', NULL),
(270, 1, 277, 'b7aac', 2, '2020-06-04 03:26:59', NULL),
(271, 1, 278, '3ea92', 2, '2020-06-04 03:38:18', NULL),
(272, 1, 279, 'd613a', 3, '2020-06-07 10:02:34', '2020-06-07 10:03:30'),
(273, 1, 280, '37b7d', 3, '2020-06-07 10:27:52', '2020-06-07 10:29:58'),
(274, 5, 281, 'd88d0', 3, '2020-06-07 11:01:08', '2020-06-07 11:03:27'),
(275, 5, 282, '3ccd0', 3, '2020-06-07 11:30:16', '2020-06-07 11:32:14'),
(276, 5, 283, 'dfe5f', 3, '2020-06-07 11:45:55', '2020-06-07 11:47:14'),
(277, 5, 284, '42376', 3, '2020-06-07 11:56:08', '2020-06-07 11:57:55'),
(278, 5, 285, '63930', 3, '2020-06-07 12:27:48', '2020-06-07 12:30:43'),
(279, 5, 286, '7562b', 3, '2020-06-07 12:44:49', '2020-06-07 12:47:12'),
(280, 5, 287, '01223', 3, '2020-06-07 12:55:59', '2020-06-07 12:57:44'),
(281, 5, 288, '9fe85', 3, '2020-06-07 13:11:22', '2020-06-07 13:13:11'),
(282, 5, 289, 'e6878', 3, '2020-06-07 13:20:54', '2020-06-07 13:22:47'),
(283, 5, 290, '8c31a', 3, '2020-06-08 02:59:08', '2020-06-08 03:01:04'),
(284, 1, 291, 'd4927', 3, '2020-06-08 04:03:37', '2020-06-08 04:05:38'),
(285, 1, 292, 'f6637', 1, '2020-06-08 04:24:37', NULL),
(286, 1, 293, 'bc609', 1, '2020-06-08 04:34:00', NULL),
(287, 1, 294, '54e6c', 1, '2020-06-08 08:19:03', NULL),
(288, 1, 295, '62c1d', 3, '2020-06-09 05:37:05', '2020-06-12 11:31:44'),
(289, 1, 296, 'b1943', 2, '2020-06-12 07:01:52', NULL),
(290, 1, 297, '890bc', 3, '2020-06-12 10:59:13', '2020-06-12 13:19:24'),
(291, 1, 298, '2db84', 4, '2020-06-30 03:21:33', NULL),
(292, 1, 299, '57ad0', 1, '2020-06-30 08:43:30', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` int(10) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sales_price` varchar(255) NOT NULL,
  `product_sales_quantity` int(10) NOT NULL,
  `product_coupon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `order_code`, `product_id`, `product_name`, `product_sales_price`, `product_sales_quantity`, `product_coupon`, `created_at`) VALUES
(232, 'e912b', 14, '6 chai nước ngọt Pepsi Cola 390ml', '23490', 8, 'no', '2020-05-26 07:54:43'),
(233, 'e912b', 13, '6 lon nước ngọt Coca Cola 250ml', '31500', 8, 'no', '2020-05-26 07:54:43'),
(234, '0ab70', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 15, 'no', '2020-05-26 08:06:15'),
(235, '29bc3', 14, '6 chai nước ngọt Pepsi Cola 390ml', '23490', 25, 'no', '2020-05-27 07:22:32'),
(236, '29bc3', 1, 'Cháo Komi vị thịt bằm gói 50g', '3332', 18, 'no', '2020-05-27 07:22:32'),
(237, '9e33b', 13, '6 lon nước ngọt Coca Cola 250ml', '31500', 8, 'no', '2020-05-27 07:23:32'),
(238, '51efc', 14, '6 chai nước ngọt Pepsi Cola 390ml', '23490', 2, 'no', '2020-06-03 08:03:24'),
(239, '0f622', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 10, 'COVID99', '2020-06-04 03:19:54'),
(240, '5e394', 3, 'Thùng 12 tô phở bò Vifon 120g', '221000', 10, 'no', '2020-06-04 03:20:53'),
(241, '56a6c', 2, 'Thùng 50 gói cháo Komi vị thịt bằm 50g', '144000', 10, 'COVID99', '2020-06-04 03:22:28'),
(242, 'b7aac', 4, 'Thùng 30 gói mì Gấu Đỏ vị gà sợi phở 63g', '70500', 10, 'HDH375Y', '2020-06-04 03:26:59'),
(243, '3ea92', 7, 'Thùng 50 gói cháo Gấu Đỏ vị thịt bằm 50g', '153000', 2, 'COVID99', '2020-06-04 03:38:18'),
(244, 'd613a', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 10, 'NLN', '2020-06-07 10:02:34'),
(245, '37b7d', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 8, 'NLN', '2020-06-07 10:27:52'),
(246, 'd88d0', 12, 'Lốc 6 lon thức uống lúa mạch uống liền Milo Active Go 240ml', '57000', 10, 'NLN', '2020-06-07 11:01:09'),
(247, '3ccd0', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 5, 'NLN', '2020-06-07 11:30:16'),
(248, 'dfe5f', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 45, 'NLN', '2020-06-07 11:45:56'),
(249, '42376', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 5, 'no', '2020-06-07 11:56:08'),
(250, '63930', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 40, 'NLN', '2020-06-07 12:27:48'),
(251, '7562b', 9, 'Thùng 24 ly mì Gấu Đỏ Vip vị lẩu Thái tôm 65g', '125600', 1, 'NLN', '2020-06-07 12:44:49'),
(252, '7562b', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 2, 'NLN', '2020-06-07 12:44:49'),
(253, '01223', 6, 'Thùng 30 gói mì Gấu Đỏ vị tôm chua cay 63g', '70500', 12, 'NLN', '2020-06-07 12:55:59'),
(254, '9fe85', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 1, 'NLN', '2020-06-07 13:11:22'),
(255, 'e6878', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 2, 'NLN', '2020-06-07 13:20:54'),
(256, '8c31a', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 1, 'NLN', '2020-06-08 02:59:08'),
(257, 'd4927', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 1, 'NLN', '2020-06-08 04:03:37'),
(258, 'f6637', 14, '6 chai nước ngọt Pepsi Cola 390ml', '23490', 1, 'no', '2020-06-08 04:24:37'),
(259, 'bc609', 14, '6 chai nước ngọt Pepsi Cola 390ml', '23490', 1, 'no', '2020-06-08 04:34:00'),
(260, '54e6c', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 1, 'no', '2020-06-08 08:19:03'),
(261, '62c1d', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 1, 'no', '2020-06-09 05:37:06'),
(262, 'b1943', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 2, 'no', '2020-06-12 07:01:52'),
(263, '890bc', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 1, 'no', '2020-06-12 10:59:13'),
(264, '890bc', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 1, 'no', '2020-06-12 10:59:14'),
(265, '2db84', 14, '6 chai nước ngọt Pepsi Cola 390ml', '23490', 1, 'COVID99', '2020-06-30 03:21:33'),
(266, '2db84', 11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', '126850', 1, 'COVID99', '2020-06-30 03:21:33'),
(267, '57ad0', 15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', '46000', 1, 'no', '2020-06-30 08:43:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `order_status_id` int(10) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`order_status_id`, `status_name`) VALUES
(1, 'Đang xử lý'),
(2, 'Đã xử lý'),
(3, 'Đã giao hàng'),
(4, 'Hủy đơn hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_producer`
--

CREATE TABLE `tbl_producer` (
  `producer_id` int(10) NOT NULL,
  `producer_name` varchar(255) NOT NULL,
  `producer_address` varchar(255) NOT NULL,
  `producer_phone` varchar(50) NOT NULL,
  `producer_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_producer`
--

INSERT INTO `tbl_producer` (`producer_id`, `producer_name`, `producer_address`, `producer_phone`, `producer_email`) VALUES
(1, 'Cty thực phẩm ABC', '123/456 Đường 30/4 ', '09123456789', 'ABC@gmail.com'),
(2, 'Cty thực phẩm BCD', '456/789 đường 30/4', '09987654321', 'BCD@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `brand_id` int(10) NOT NULL,
  `product_desc` text NOT NULL,
  `product_content` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_number` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` int(10) NOT NULL,
  `expiry_date` varchar(50) NOT NULL,
  `product_origin_id` int(11) NOT NULL,
  `producer_id` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `product_condition_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_slug`, `category_id`, `brand_id`, `product_desc`, `product_content`, `product_price`, `product_number`, `product_image`, `product_status`, `expiry_date`, `product_origin_id`, `producer_id`, `promotion`, `product_condition_id`) VALUES
(1, 'Cháo Komi vị thịt bằm gói 50g', 'chao-komi-vi-thit-bam-goi-50g', 2, 1, '<p>Ch&aacute;o Komi vị thịt bằm g&oacute;i 50g</p>', '<p>Vị Thịt bằm Khối lượng 50g Th&agrave;nh phần Ph&ocirc;i ch&aacute;o - Gạo. S&Uacute;P - Dầu thực vật, muối I-ốt, chất điều vị (621, 635, disodium succinate), đường, h&agrave;nh t&iacute;m, bột chiết xuất thịt heo 8 g/kg, bột l&ograve;ng đỏ trứng, thịt heo 2 g/kg, gia vị hỗn hợp. ng&ograve; gai, c&agrave; rốt sấy, nước mắm, h&agrave;nh l&aacute; sấy, chất chống đ&ocirc;ng v&oacute;n (551), hương tổng hợp, hạt điều m&agrave;u, m&agrave;u thực phẩm (160c), chất chống oxy ho&aacute; (320, 321). Sản phẩm c&oacute; chứa c&aacute;c nguy&ecirc;n liệu c&oacute; nguồn gốc từ đậu n&agrave;nh, thuỷ sản, trứng. C&aacute;ch nấu Cho ph&ocirc;i ch&aacute;o, g&oacute;i dầu, g&oacute;i n&ecirc;m v&agrave;o t&ocirc;. Chế nước s&ocirc;i 350 ml, trộn đều v&agrave; đậy nắp lại, chờ trong 3 ph&uacute;t, sau đ&oacute; d&ugrave;ng ngay. Bảo quản Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp. N&ecirc;n pha chế ngay sau khi mở bao b&igrave;. Tr&aacute;nh để gần ho&aacute; chất hay sản phẩm c&oacute; m&ugrave;i mạnh. Thương hiệu Komi (Việt Nam) Sản xuất tại Việt Nam</p>', '3400', 4, 'chao46.jpg', 0, '6 tháng', 1, 1, 2, 2),
(2, 'Thùng 50 gói cháo Komi vị thịt bằm 50g', 'chao-komi-masan-thit-bam-50g-thung', 2, 1, '<p>Th&ugrave;ng 50 g&oacute;i ch&aacute;o Komi vị thịt bằm 50g</p>', '<p>Vị Thịt bằm Khối lượng 50g Th&agrave;nh phần PH&Ocirc;I CH&Aacute;O - Gạo. S&Uacute;P - Dầu thực vật, muối I-ốt, chất điều vị (621, 635, disodium succinate), đường, h&agrave;nh t&iacute;m, bột chiết xuất thịt heo 8 g/kg, bột l&ograve;ng đỏ trứng, thịt heo 2 g/kg, gia vị hỗn hợp. ng&ograve; gai, c&agrave; rốt sấy, nước mắm, h&agrave;nh l&aacute; sấy, chất chống đ&ocirc;ng v&oacute;n (551), hương tổng hợp, hạt điều m&agrave;u, m&agrave;u thực phẩm (160c), chất chống oxy ho&aacute; (320, 321). Sản phẩm c&oacute; chứa c&aacute;c nguy&ecirc;n liệu c&oacute; nguồn gốc từ đậu n&agrave;nh, thuỷ sản, trứng. C&aacute;ch nấu Cho ph&ocirc;i ch&aacute;o, g&oacute;i dầu, g&oacute;i n&ecirc;m v&agrave;o t&ocirc;. Chế nước s&ocirc;i 350 ml, trộn đều v&agrave; đậy nắp lại, chờ trong 3 ph&uacute;t, sau đ&oacute; d&ugrave;ng ngay. Bảo quản Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp. N&ecirc;n pha chế ngay sau khi mở bao b&igrave;. Tr&aacute;nh để gần ho&aacute; chất hay sản phẩm c&oacute; m&ugrave;i mạnh. Thương hiệu Komi (Việt Nam) Sản xuất tại Việt Nam</p>', '160000', 33, 'chao-komi-masan-thit-bam-50g-thung-2-org91.jpg', 0, '6 tháng', 1, 1, 10, 1),
(3, 'Thùng 12 tô phở bò Vifon 120g', 'thung-pho-bo-vifon-to-120g-12-to', 3, 3, '<p>Th&ugrave;ng 12 t&ocirc; phở b&ograve; Vifon 120g</p>', '<p>Vị Thịt b&ograve; Loại Phở nước Sợi phở Sợi dẹp, to Khối lượng 120g / t&ocirc; Th&agrave;nh phần VẮT PHỞ - Gạo (39.5%), chất ổn định (1404, 412), đường tinh luyện, muối I-ốt, chất điều vị (mononatri glutamat). G&Oacute;I THỊT B&Ograve; - Thịt b&ograve; (20.5%), nước, dầu cọ tinh luyện, h&agrave;nh t&iacute;m, chất điều vị (mononatri glutamat), chất l&agrave;m d&agrave;y (1422), đường tinh luyện, gừng, muối I-ốt, gia vị phở (quế, đinh hương, hồi), phẩm m&agrave;u tự nhi&ecirc;n (caroten tự nhi&ecirc;n (chiết xuất từ thực vật)), chất chống oxy ho&aacute; (mixed tocopherol (vitamin E)). G&Oacute;I GIA VỊ - Muối I-ốt, chất điều vị (mononatri glutamat, dinatri 5&#39; - guanylat, dinatri 5&#39; - inosinat), đường tinh luyện, rau sấy (h&agrave;nh l&aacute;, ớt), hương b&ograve; tổng hợp, gừng, đạm thực vật thuỷ ph&acirc;n từ đậu n&agrave;nh, h&agrave;nh t&iacute;m, gia vị phở (quế, đinh hương, hồi), bột đường thắng, ti&ecirc;u, chất chống đ&ocirc;ng v&oacute;n (551). G&Oacute;I TƯƠNG ỚT - Nước, ớt, đường tinh luyện, tỏi, muối I-ốt, c&agrave; chua c&ocirc; đặc, chất l&agrave;m d&agrave;y (1422), chất điều chỉnh độ acid (260, acid citric), chất bảo quản (kali sorbat). C&aacute;ch nấu Mở nắp, cắt g&oacute;i gia vị c&ugrave;ng với vắt phở cho v&agrave;o t&ocirc;. Chế nước s&ocirc;i đến vạch (khoảng 400 ml), đậy nắp trong 3 ph&uacute;t. Mở nắp, cắt g&oacute;i thịt b&ograve;, g&oacute;i tương ớt cho v&agrave;o, trộn đều l&agrave; c&oacute; thể d&ugrave;ng được ngay. Bảo quản Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng mặt trời Thương hiệu Vifon (Việt Nam) Sản xuất tại Việt Nam</p>', '260000', 27, 'pho12.jpg', 0, '6 tháng', 1, 1, 15, 1),
(4, 'Thùng 30 gói mì Gấu Đỏ vị gà sợi phở 63g', 'mi-gau-do-vi-ga-soi-pho-goi-64g-thung-30-goi', 1, 2, 'Thùng 30 gói mì Gấu Đỏ vị gà sợi phở 63g', 'Loại mì Mì nước\r\nVị mì Gà\r\nSợi mì Sợi mì dạng phở\r\nKhối lượng 63g / gói\r\nThành phần Bột mì, dầu thực vật tinh luyện, tinh bột khoai mì biến tính (1412, 1420), muối I-ốt, đường, chất điều vị (621, 627, 631, 364 (ii)), hành (15 g/kg), chiết xuất nấm men, bột thịt gà (1,5 g/kg), bột tôm, rau sấy, tiêu, tỏi, ớt, chất tạo xốp (452 (i), 500(i)), chất ổn định (466, 501(i)), chất nhũ hoá (322(i), 420(i)), hương tổng hợp dùng trong thực phẩm, chất ngọt tổng hợp (420(ii), 950, 951), màu tự nhiên (160b(i), 160c), chất chống oxy hoá (320, 321). Sản phẩm chứa các nguyên liệu có nguồn gốc từ lúa mì, thuỷ sản.\r\nCách dùng Cho vắt mì và các gói gia vị vào tô. Chế khoảng 320 ml nước sôi, đậy nắp trong 3 phút. Mở nắp, trộn đều bạn sẽ có tô mì ngon tuyệt.\r\nBảo quản Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp. Không để gần hóa chất hoặc sản phẩm có mùi mạnh.\r\nThương hiệu Gấu Đỏ (Việt Nam)\r\nSản xuất tại Việt Nam', '70500', 36, 'thung-30-goi-mi-gau-do-vi-ga-soi-pho-63g-202002201400068888_300x30031.jpg', 0, '6 tháng', 1, 1, 0, 1),
(5, 'Thùng 30 gói mì Gấu Đỏ vị thịt bằm 63g', 'mi-gau-do-bo-thit-bam-hanh-phi-64g-thung-30-goi', 1, 2, 'Thùng 30 gói mì Gấu Đỏ vị thịt bằm 63g', 'Loại mì Mì nước\r\nVị mì Thịt bằm\r\nSợi mì Sợi tròn, nhỏ\r\nKhối lượng 63g / gói\r\nThành phần Bột mì, dầu thực vật tinh luyện, tinh bột khoai mì biến tính (1412, 1420), muối I-ốt, đường, chất điều vị (621, 627, 631, 364(ii)), hành (15 g/kg), chiết xuất nấm men, bột chiết xuất thịt heo (1,6 g/kg), rau sấy, tỏi, tiêu, ớt, chất tạo xốp (452(i), 500(i)), chất ổn định (466, 501(i)), chất nhũ hoá (322(i), 420(i)), hương tổng hợp dùng trong thực phẩm, chất ngọt tổng hợp (420(ii), 950, 951), màu tự nhiên (160b(i), 160c), chất chống oxy hoá (320, 321). Sản phẩm có chứa các nguyên liệu có nguồn gốc từ lúa mì.\r\nCách dùng Cho vắt mì và các gói gia vị vào tô. Chế khoảng 320 ml nước sôi, đậy nắp trong 3 phút. Mở nắp, trộn đều bạn sẽ có tô mì ngon tuyệt\r\nBảo quản Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp. Không để gần hóa chất hoặc sản phẩm có mùi mạnh.\r\nThương hiệu Gấu Đỏ (Việt Nam)\r\nSản xuất tại Việt Nam', '70500', 50, 'thung-30-goi-mi-gau-do-vi-thit-bam-63g-202002201359079158_300x30073.jpg', 0, '6 tháng', 1, 1, 0, 1),
(6, 'Thùng 30 gói mì Gấu Đỏ vị tôm chua cay 63g', 'thung-mi-gau-do-tom-chua-cay-goi-65g-30-goi', 1, 2, 'Thùng 30 gói mì Gấu Đỏ vị tôm chua cay 63g', 'Loại mì Mì nước\r\nVị mì Tôm chua cay\r\nSợi mì Sợi tròn, nhỏ\r\nKhối lượng 63g / gói\r\nThành phần Bột mì, dầu thực vật tinh luyện, tinh bột khoai mì biến tính (1412, 1420), muối I-ốt, đường, chất điều vị (621, 627, 631), hành (5 g/kg), chiết xuất nấm men, bột tôm (1,6 g/kg), ớt, tiêu, tỏi, rau sấy, chất điều chỉnh độ axit (296, 330), chất tạo xốp (452(i), 500(i)), chất ổn định (466, 501(i)), chất nhũ hoá (322(i), 420(i)), hương tổng hợp dùng trong thực phẩm, chất ngọt tổng hợp (420(ii), 950, 951), màu tự nhiên (160b(i), 160c), chất chống oxy hoá (320, 321).\r\nCách dùng Cho vắt mì và các gói gia vị vào tô. Chế khoảng 320 ml nước sôi, đậy nắp trong 3 phút. Mở nắp, trộn đều bạn sẽ có tô mì ngon tuyệt.\r\nBảo quản Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp. Không để gần hóa chất hoặc sản phẩm có mùi mạnh.\r\nThương hiệu Gấu Đỏ (Việt Nam)\r\nSản xuất tại Việt Nam', '70500', 38, 'thung-30-goi-mi-gau-do-tom-chua-cay-63g-20200109125243344438.jpg', 0, '6 tháng', 1, 1, 0, 1),
(7, 'Thùng 50 gói cháo Gấu Đỏ vị thịt bằm 50g', 'chao-gau-do-thit-bam-50g-thung-30-goi', 2, 2, 'Thùng 50 gói cháo Gấu Đỏ vị thịt bằm 50g', 'Vị Thịt bằm\r\nKhối lượng 50g\r\nThành phần HẠT CHÁO - Gạo thơm.\r\nGÓI GIA VỊ - Dầu thực vật tinh luyện, muối I-ốt, chất điều vị (621, 627, 631), đường, hành (15 g/kg), bột chiết xuất thịt heo (2 g/kg), tỏi, bột nước tương, rau sấy, tiêu, hương rau tổng hợp, hương thịt giống tự nhiên, màu caramel (150d). Sản phẩm chứa các nguyên liệu có nguồn gốc từ đậu nành.\r\nCách nấu Cho hạt cháo và các gói gia vị vào tô. Chế khoảng 320 ml nước sôi, khuấy đều và đậy nắp trong 3 phút. Mở nắp, khuấy đều bạn sẽ có một tô cháo ngon tuyệt.\r\nBảo quản Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp, không để gần hoá chất hay sản phẩm có mùi mạnh.\r\nThương hiệu Gấu Đỏ (Việt Nam)\r\nSản xuất tại Việt Nam', '153000', 48, 'thung-50-goi-chao-gau-do-vi-ca-50g-202002221201132669_300x30062.jpg', 0, '6 tháng', 1, 1, 0, 1),
(8, 'Mì Gấu Đỏ vị thịt bằm gói 63g', 'mi-gau-do-bo-thit-bam-hanh-phi-64g', 1, 2, 'Mì Gấu Đỏ vị thịt bằm gói 63g', 'Loại mì Mì nước\r\nVị mì Thịt bằm\r\nSợi mì Sợi tròn, nhỏ\r\nKhối lượng 63g\r\nThành phần Bột mì, dầu thực vật tinh luyện, tinh bột khoai mì biến tính (1412, 1420), muối I-ốt, đường, chất điều vị (621, 627, 631, 364(ii)), hành (15 g/kg), chiết xuất nấm men, bột chiết xuất thịt heo (1,6 g/kg), rau sấy, tỏi, tiêu, ớt, chất tạo xốp (452(i), 500(i)), chất ổn định (466, 501(i)), chất nhũ hoá (322(i), 420(i)), hương tổng hợp dùng trong thực phẩm, chất ngọt tổng hợp (420(ii), 950, 951), màu tự nhiên (160b(i), 160c), chất chống oxy hoá (320, 321). Sản phẩm có chứa các nguyên liệu có nguồn gốc từ lúa mì.\r\nCách dùng Cho vắt mì và các gói gia vị vào tô. Chế khoảng 320 ml nước sôi, đậy nắp trong 3 phút. Mở nắp, trộn đều bạn sẽ có tô mì ngon tuyệt.\r\nBảo quản Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp. Không để gần hóa chất hoặc sản phẩm có mùi mạnh.\r\nThương hiệu Gấu Đỏ (Việt Nam)\r\nSản xuất tại Việt Nam', '2800', 50, 'mi-gau-do-vi-thit-bam-goi-63g-202002191407042827_300x30023.jpg', 0, '6 tháng', 1, 1, 0, 1),
(9, 'Thùng 24 ly mì Gấu Đỏ Vip vị lẩu Thái tôm 65g', 'mi-ly-gau-do-vip-lau-thai-tom-65gr-thung-24', 1, 2, '<p>Th&ugrave;ng 24 ly m&igrave; Gấu Đỏ Vip vị lẩu Th&aacute;i t&ocirc;m 65g</p>', '<p>Loại m&igrave; M&igrave; nước Vị m&igrave; Lẩu Th&aacute;i t&ocirc;m Sợi m&igrave; Sợi tr&ograve;n, nhỏ Khối lượng 65g / ly Th&agrave;nh phần VẮT M&Igrave; - Bột m&igrave;, dầu thực vật tinh luyện, tinh bột khoai m&igrave; biến t&iacute;nh (1412, 1420), muối, đường, chất điều vị (621, 627, 631), chiết xuất nấm men, bột đậu xanh (1 g/kg), chất tạo xốp (452(i), 500(i), 500(ii)), chất ổn định (466, 501(i)), chất nhũ ho&aacute; (322(i), 420(i)), m&agrave;u tự nhi&ecirc;n (160b(i)), chất chống oxy ho&aacute; (321). G&Oacute;I GIA VỊ S&Uacute;P LẨU TH&Aacute;I T&Ocirc;M - Dầu thực vật tinh luyện, đường, muối, chất điều vị (621, 627, 631), tỏi, riềng, sả, rau sấy, bột t&ocirc;m (6 g/kg), h&agrave;nh ( 5 g/kg), ớt, vi&ecirc;n đậu n&agrave;nh, chất điều chỉnh độ axit (260, 296, 330), hương rau tổng hợp, chất tạo ngọt tổng hợp (951), m&agrave;u tự nhi&ecirc;n (160c), chất chống oxy ho&aacute; (321), chất bảo quản (202). Sản phẩm chứa c&aacute;c nguy&ecirc;n liệu c&oacute; nguồn gốc từ l&uacute;a m&igrave;, đậu n&agrave;nh, thuỷ sản. C&aacute;ch d&ugrave;ng Mở nắp đến đường c&oacute; mũi t&ecirc;n. Chế nước s&ocirc;i đến vạch của ly, đậy nắp v&agrave; chờ 3 ph&uacute;t. Trộn đều l&agrave; d&ugrave;ng được ngay. Bảo quản Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp. Kh&ocirc;ng để gần h&oacute;a chất hoặc sản phẩm c&oacute; m&ugrave;i mạnh. Thương hiệu Gấu Đỏ (Việt Nam) Sản xuất tại Việt Nam</p>', '157000', 49, 'thung-24-ly-mi-gau-do-vip-vi-lau-thai-tom-65g-202002201534427788_300x30089.jpg', 0, '6 tháng', 1, 1, 20, 1),
(10, 'Lốc 4 hộp sữa tươi có đường Vinamilk 100% Sữa Tươi 110ml', 'sttt-vinamilk-dan-bo-cd-110ml-loc', 4, 4, '<p>Lốc 4 hộp sữa tươi c&oacute; đường Vinamilk 100% Sữa Tươi 110ml</p>', '<p>Loại sữa Sữa tươi c&oacute; đường Dung t&iacute;ch 110ml Ph&ugrave; hợp với Trẻ từ 1 tuổi trở l&ecirc;n Th&agrave;nh phần Sữa b&ograve; tươi (95,9%), đường tinh luyện (3,8%), chất ốn đinh (471, 460(i), 407,466), vitamin (natri ascorbat, A, D3), kho&aacute;ng chất (natri selenit), hương liệu tổng hợp d&ugrave;ng cho thực phẩm Thương hiệu Vinamilk (Việt Nam) Sản xuất tại Việt Nam</p>', '18000', 9, 'loc-4-hop-sua-tuoi-co-duong-vinamilk-100-sua-tuoi-110ml-202002281049106071_300x30017.jpg', 0, '6 tháng', 1, 1, 10, 1),
(11, 'Sữa bột Wincofood GoldCare Gain hương vani lon 900g (dành cho người gầy)', 'sua-bot-wincofood-goldcare-gain-huong-vani-lon-900g-danh-cho-nguoi-gay', 4, 5, '<p>Sữa bột Wincofood GoldCare Gain hương vani lon 900g (d&agrave;nh cho người gầy)</p>', '<p>Hương vị Hương vani Trọng lượng 900g Độ tuổi Người gầy v&agrave; trẻ từ 1 tuổi trở l&ecirc;n, trẻ thiếu c&acirc;n Ph&ugrave; hợp Tăng c&acirc;n, tăng cường thể lực Th&agrave;nh phần Sữa bột, non dairy cream, mantodextrin, dextro, lysine, canxi, DHA, vitamin (A, B1, B2, B12, B6, D, E, C, K1, H). Kho&aacute;ng chất (natri, kali, sắt, iod, kẽm, magi&ecirc;, acid folic, acid linoleic, acid pantothenic, nicotinamid, phospho, clorid), xơ h&ograve;a tan Khuy&ecirc;n d&ugrave;ng N&ecirc;n d&ugrave;ng 2 - 3 ly mỗi ng&agrave;y. Lưu &yacute; Uống ngay sau khi pha. Nếu kh&ocirc;ng uống ngay, n&ecirc;n đậy k&iacute;n v&agrave; cho v&agrave;o tủ lạnh từ 4 - 6 độ C v&agrave; d&ugrave;ng trong v&ograve;ng 24 giờ. Hạn sử dụng 30 ng&agrave;y sau khi mở nắp Thương hiệu Wincofood (Việt Nam) Sản xuất Việt Nam</p>', '215000', 5, 'sua-bot-wincofood-goldcare-gain-huong-vani-lon-900g-danh-cho-nguoi-gay-20190925151404806536.jpg', 0, '6 tháng', 1, 1, 41, 2),
(12, 'Lốc 6 lon thức uống lúa mạch uống liền Milo Active Go 240ml', 'loc-6-lon-thuc-uong-lua-mach-milo-active-go-240ml', 4, 6, '<p>Lốc 6 lon thức uống l&uacute;a mạch uống liền Milo Active Go 240ml</p>', '<p>Thương hiệu Milo (Thụy Sĩ) Hương vị Cacao l&uacute;a mạch Ph&ugrave; hợp D&ugrave;ng cho thanh thiếu ni&ecirc;n (từ 12 tuổi trở l&ecirc;n) Th&agrave;nh phần Nước, sữa bột t&aacute;ch kem, đường, protomal 2,4% (chiết xuất từ mầm l&uacute;a mạch), bột ca cao, chất b&eacute;o sữa, dầu thực vật, bột whey từ sữa, siro glucose, chất ổn định (471, 407, 401), c&aacute;c kho&aacute;ng chất (magnesi carbonat, dicalci phosphat, dinatri phosphat, sắt pyrophosphat), chất nhũ h&oacute;a 322(i) - chiết xuất từ đậu n&agrave;nh, c&aacute;c vitamin (B3, D, B6, B2), chất tạo ngọt tổng hợp, hương vani tổng hợp Trọng lượng/ Thể t&iacute;ch 240ml Sản xuất tại Việt Nam</p>', '60000', 35, 'loc-6-lon-thuc-uong-lua-mach-uong-lien-milo-active-go-240ml-201906141416457207_300x30022.jpg', 0, '6 tháng', 1, 1, 5, 1),
(13, '6 lon nước ngọt Coca Cola 250ml', '6-lon-nuoc-ngot-coca-cola-250ml', 5, 7, '<p>6 lon nước ngọt Coca Cola 250ml</p>', '<p>Thương hiệu Coca Cola (Mỹ) Lượng ga C&oacute; ga Lượng đường C&oacute; đường Thể t&iacute;ch 250ml Sản xuất tại Việt Nam Sử dụng Ngon hơn khi uống lạnh</p>', '35000', 0, '6-lon-nuoc-ngot-coca-cola-250ml-201912021059137681_300x30031.jpg', 1, '6 tháng', 1, 1, 10, 3),
(14, '6 chai nước ngọt Pepsi Cola 390ml', '6-chai-nuoc-ngot-pepsi-cola-390ml', 5, 8, '<p>6 chai nước ngọt Pepsi Cola 390ml</p>', '<p>Thương hiệu Pepsi (Mỹ) Lượng ga C&oacute; ga Lượng đường C&oacute; đường Thể t&iacute;ch 390ml Sản xuất tại Việt Nam Sử dụng Ngon hơn khi uống lạnh</p>', '29000', 4, '6-chai-nuoc-ngot-pepsi-cola-390ml-201912031356123908_300x30066.jpg', 0, '6 tháng', 1, 1, 19, 2),
(15, 'Lốc 6 lon nước ngọt Pepsi Cola 330ml', 'nuoc-ngot-lon-pepsi-cola-sleek-330ml-loc-4', 5, 8, '<p>Lốc 6 lon nước ngọt Pepsi Cola 330ml</p>', '<p>Thương hiệu Pepsi (Mỹ) Lượng ga C&oacute; ga Lượng đường C&oacute; đường Thể t&iacute;ch 330ml Sản xuất tại Việt Nam Sử dụng Ngon hơn khi uống lạnh</p>', '46000', 14, 'loc-6-lon-nuoc-ngot-pepsi-cola-330ml-201912201430519165751.jpg', 0, '6 tháng', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_condition`
--

CREATE TABLE `tbl_product_condition` (
  `product_condition_id` int(10) NOT NULL,
  `product_condition_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_condition`
--

INSERT INTO `tbl_product_condition` (`product_condition_id`, `product_condition_name`) VALUES
(1, 'Còn hàng'),
(2, 'Sắp hết hàng'),
(3, 'Hết hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_origin`
--

CREATE TABLE `tbl_product_origin` (
  `product_origin_id` int(10) NOT NULL,
  `product_origin_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_origin`
--

INSERT INTO `tbl_product_origin` (`product_origin_id`, `product_origin_name`) VALUES
(1, 'Việt Nam'),
(2, 'Hàn Quốc'),
(3, 'Mỹ'),
(4, 'Nhật Bản');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` int(10) NOT NULL,
  `shipping_name` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_email` varchar(255) NOT NULL,
  `shipping_notes` text NOT NULL,
  `shipping_method` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `shipping_name`, `shipping_address`, `shipping_phone`, `shipping_email`, `shipping_notes`, `shipping_method`) VALUES
(269, 'fdf', 'lll', 'kkk', 'hghg', 'kkk', 0),
(270, 'jkjkjkj', 'kjkjk', 'jkjk', 'kjkjkjk', 'jkj', 0),
(271, 'á', 'sa', 'sa', 'á', 'sa', 0),
(272, 'á', 'á', 'á', 'á', 'á', 0),
(273, 'áds', 'dsad', 'ád', 'ád', 'ád', 1),
(274, 'kjk', 'jkj', 'kjkj', 'kj', 'kjk', 1),
(275, 'lkl', 'klk', 'kl', 'klk', 'lk', 1),
(276, 'kjkjk', 'jkj', 'jjk', 'jkj', 'jk', 0),
(277, 'uiu', 'iui', 'uiui', 'iu', 'uiu', 0),
(278, 'jhjh', 'jhjh', 'jhjh', 'hjh', 'jhjhjh', 0),
(279, 'A', '123/456A', '123456', 'A@gmail.com', 'GIAO HANG NHANh', 1),
(280, 'A', '123//456A', '123456', 'A@gmail.ocm', 'Nhanh', 1),
(281, 'C', '123/456BCD', '123456789', 'C@gmail.com', 'NHANH', 1),
(282, 'C', '123/456BCD', '1234567', 'C@gmail.com', 'Nhanh', 1),
(283, 'C', '123/456BCD', '1234567', 'C@gmail.com', 'GIAO HÀNG NHANH', 1),
(284, 'C', '123/456BCD', '1234567', 'C@gmail.com', 'nhanh', 0),
(285, 'C', '123/456A', '123456', 'C@gmail.com', 'nhanh', 1),
(286, 'C', '123/456A', '123456', 'C@gmail.com', 'nhanh', 1),
(287, 'C', '123/456A', '123456', 'C@gmail.com', 'nhanh', 1),
(288, 'C', '123/456A', '123456', 'C@gmail.com', 'nhanh', 1),
(289, 'C', '123/456A', '123456', 'C@gmail.com', 'nhanh', 1),
(290, 'C', '123/456BCD', '123456', 'C@gmaiil.com', 'nhanh', 1),
(291, 'C', '123/456BCD', '123456', 'C@gmaiil.com', 'nhanh', 1),
(292, 'A', '123/456 ABC', '0909087678', 'A@gmaiil.com', 'GIAO HANG NHANH', 1),
(293, 'A', '123/456ABC', '0909084657', 'A@gmail.com', 'Giao hang nhanh', 1),
(294, 'A', '123/456ABC', '0909234566', 'A@gmail.com', 'NHANH', 1),
(295, 'hg', 'hgh', 'ghg', 'ghg', 'hgh', 1),
(296, 'A', '123/456 ABC', '123456798', 'A@gmail.com', 'nhanh', 1),
(297, 'A', '123/456 ABC', '123456798', 'A@gmail.com', 'nhanh', 1),
(298, 'A', '123/456A', '123456798', 'A@gmail.com', 'giao hàng nhanh', 1),
(299, 'A', ',m,m', '123456798', 'A@gmail.com', ',m', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(10) NOT NULL,
  `slider_name` varchar(255) NOT NULL,
  `slider_status` int(10) NOT NULL,
  `slider_image` varchar(100) NOT NULL,
  `slider_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_name`, `slider_status`, `slider_image`, `slider_desc`) VALUES
(1, 'MIỄN PHÍ VẬN CHUYỂN', 0, '216.jpg', 'Giảm giá bất ngờ'),
(5, 'Bách hóa online', 0, 'an370.jpg', 'Thân thiện-an toàn-uy tín'),
(6, 'Mua sắm thả ga', 0, 'an270.jpg', 'Săn ngay quà khủng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(0, 'Có hạn dùng'),
(1, 'Có hạn bảo hành'),
(2, 'Có hạn đổi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Chỉ mục cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Chỉ mục cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shipping_id` (`shipping_id`),
  ADD KEY `order_status` (`order_status`);

--
-- Chỉ mục cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_code`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Chỉ mục cho bảng `tbl_producer`
--
ALTER TABLE `tbl_producer`
  ADD PRIMARY KEY (`producer_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `product_origin_id` (`product_origin_id`),
  ADD KEY `product_condition_id` (`product_condition_id`),
  ADD KEY `producer_id` (`producer_id`);

--
-- Chỉ mục cho bảng `tbl_product_condition`
--
ALTER TABLE `tbl_product_condition`
  ADD PRIMARY KEY (`product_condition_id`);

--
-- Chỉ mục cho bảng `tbl_product_origin`
--
ALTER TABLE `tbl_product_origin`
  ADD PRIMARY KEY (`product_origin_id`);

--
-- Chỉ mục cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Chỉ mục cho bảng `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `coupon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT cho bảng `tbl_producer`
--
ALTER TABLE `tbl_producer`
  MODIFY `producer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_product_condition`
--
ALTER TABLE `tbl_product_condition`
  MODIFY `product_condition_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_product_origin`
--
ALTER TABLE `tbl_product_origin`
  MODIFY `product_origin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD CONSTRAINT `tbl_category_ibfk_1` FOREIGN KEY (`type`) REFERENCES `tbl_type` (`type_id`);

--
-- Các ràng buộc cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD CONSTRAINT `tbl_category_product_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_category` (`id`);

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `tbl_shipping` (`shipping_id`),
  ADD CONSTRAINT `tbl_order_ibfk_3` FOREIGN KEY (`order_status`) REFERENCES `tbl_order_status` (`order_status_id`);

--
-- Các ràng buộc cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`),
  ADD CONSTRAINT `tbl_order_details_ibfk_3` FOREIGN KEY (`order_code`) REFERENCES `tbl_order` (`order_code`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category_product` (`category_id`),
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brand` (`brand_id`),
  ADD CONSTRAINT `tbl_product_ibfk_3` FOREIGN KEY (`product_condition_id`) REFERENCES `tbl_product_condition` (`product_condition_id`),
  ADD CONSTRAINT `tbl_product_ibfk_4` FOREIGN KEY (`product_origin_id`) REFERENCES `tbl_product_origin` (`product_origin_id`),
  ADD CONSTRAINT `tbl_product_ibfk_5` FOREIGN KEY (`product_condition_id`) REFERENCES `tbl_product_condition` (`product_condition_id`),
  ADD CONSTRAINT `tbl_product_ibfk_6` FOREIGN KEY (`producer_id`) REFERENCES `tbl_producer` (`producer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
