<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $products_name = [
            "[ IN NỔI ] Áo thun in gấu Brosie 3 màu From rộng Unisex",
            "Áo SICHT 23 Áo Thun Áo Phông Tay Lỡ From rộng KL Unisex ",
            "Áo thun tay lỡ form rộng - phông nam nữ cotton oversize  IN NỔI  Áo Phông Tay Lỡ From rộng Cừu Nhỏ [ THE GREA UNIMSU",
            "Bigsize SET ÁO LI CỘT NƠ VÀ CHÂN VÁY CÓ QUẦN",
            "Bộ Đồ Nữ Đi Chơi Quần Đùi Thun Cotton Sang Chảnh Mùa Hè Chất Vải Mát Bigsize Bộ Thêu Đẹp SOTIDO SN6",
            "[Mẫu Mới] Áo Thun IN NỔI HÌNH 3 CHÚ GẤU NỖI CHỮ Nổi Áo Phông Tay Lỡ From KL Unisex  ",
            "Đồ Bộ Bigsize Nữ Quần Short Cotton SOTIDO, Bộ Quần Áo Mùa Hè Thun Mát Thêu Đẹp, Set Bộ Nữ Đi Chơi Mặc Nhà SN8 ",
            "Đồ bộ nữ, Sét bộ bigsize Đồ Bộ Bigsize, Bộ Đùi Sọc thun gân ",
            "Set gấu dâu phối tay BIGSIZE 60kg - 110kg [ Nguyễn Diệu Linh bigsize ] ",
            "Sét Đồ Bộ Đùi Thun Xốp Bigsize 40-95kg, Tôn Dáng Eo",
            "Set Đồ Nữ Đi Chơi Quần Đùi Sang Chảnh Bigsize Mùa Hè Chất Thun Mát Bộ Thêu Đẹp SOTIDO SN2 ",
            "[Ảnh thật/Sẵn] Váy voan be xếp li ngang ngực tay bồng dáng xòe - Đầm trắng kỉ yếu, dự tiệc  ",
            "[Bảo Hành 6 Tháng] Tai Nghe Mèo Bluetooth P47 Dễ Thương 400mAh  ",
            "Bộ Đồ Thun Nam Phối Viền Áo Ngắn Tay Cổ Tròn Kết Hợp Quần Short Đùi Thể Thao sozo SET NAM 90000161C ",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp  ",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex ",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818 ",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm  ",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm  ",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách  ",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP  ",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp  ",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex  ",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818  ",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ  ",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm  ",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm  ",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao  ",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách  ",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP  ",
            "Set váy đầm hai dây kèm áo khoác chất đẹp phong cách Hàn Quốc MS4437  ",
            "Tai nghe Bluethoth Pro gen 2,Ap2,Pro, Ap3 không dây,Bass Căng Vuốt, dùng cho được mọi dòng máy,Bảo hành 12 tháng  ",
            "Tai Nghe Bluetooth PULIERDE Y08 Chip 5.2 TOPSTORE ,Tai Nghe Chụp Tai Âm Thanh HiFi Có Mic,Chống Ồn Hiệu Quả  ",
            "Tai Nghe Chụp Tai Bluetooth Y08, Tai Không Dây Có Mic, Có Thẻ Nhớ, Âm Bass Cực Chất, Nghe Nhạc Cực Hay Bảo Hành 1 Năm  ",
            "Váy đầm khóa ngực cổ polo ngắn dài nhiều màu kiểu mới mùa hè phong cách Hàn Quốc  ",
            "Váy Cổ Vuông Tay Trắng ⚡️ẢNH THẬT⚡️ Đầm Chất Voan Mát, Dài Tay Cho Nữ  ",
            "Chuột Quang Không Dây 2.4G 1600DPI Hình Chuột Hamster Siêu Dễ Thương  ",
        ];
        $product_descriptions = [
            "[ IN NỔI ] Áo thun in gấu Brosie 3 màu From rộng Unisex - Một chiếc áo thun in gấu Brosie với thiết kế từ rộng phổ biến cho cả nam và nữ. Áo được làm từ chất liệu thoáng mát và có in ấn độc đáo, mang đến sự thoải mái và phong cách cho mọi dịp.",
            "Áo SICHT 23 Áo Thun Áo Phông Tay Lỡ From rộng KL Unisex - Áo thun SICHT 23 có kiểu dáng từ rộng với tay lỡ, phù hợp cho cả nam và nữ. Chất liệu áo thun mềm mại và thoáng khí, mang đến sự thoải mái trong mọi hoạt động hàng ngày.",
            "Áo thun tay lỡ form rộng - phông nam nữ cotton oversize  IN NỔI  Áo Phông Tay Lỡ From rộng Cừu Nhỏ [ THE GREA UNIMSU - Áo thun tay lỡ form rộng IN NỔI với chất liệu cotton oversize. Thiết kế phông, nam tính và nữ tính, phù hợp cho cả hai giới. Sự kết hợp giữa phong cách và sự thoải mái.",
            "Bigsize SET ÁO LI CỘT NƠ VÀ CHÂN VÁY CÓ QUẦN - Bộ đồ gồm áo li cột nơ và chân váy với quần. Thiết kế phù hợp cho những người có kích thước lớn. Chất liệu cao cấp và kiểu dáng sang trọng, tạo nên vẻ đẹp nổi bật trong bất kỳ sự kiện nào.",
            "Bộ Đồ Nữ Đi Chơi Quần Đùi Thun Cotton Sang Chảnh Mùa Hè Chất Vải Mát Bigsize Bộ Thêu Đẹp SOTIDO SN6 - Bộ đồ nữ gồm quần đùi và áo thun đi chơi với chất liệu thun cotton mát mẻ. Thiết kế bigsize phù hợp cho mọi kích cỡ, được thêu tỉ mỉ, tạo nên một vẻ đẹp nổi bật trong mùa hè.",
            "[Mẫu Mới] Áo Thun IN NỔI HÌNH 3 CHÚ GẤU NỖI CHỮ Nổi Áo Phông Tay Lỡ From KL Unisex - Áo thun in hình 3 chú gấu nổi chữ. Kiểu dáng từ rộng, phù hợp cho cả nam và nữ. Chất liệu thoáng mát và in ấn chất lượng, mang đến sự thoải mái và phong cách.",
            "Đồ Bộ Bigsize Nữ Quần Short Cotton SOTIDO, Bộ Quần Áo Mùa Hè Thun Mát Thêu Đẹp, Set Bộ Nữ Đi Chơi Mặc Nhà SN8 - Bộ đồ bộ bigsize cho nữ gồm quần short và áo thun cotton. Chất liệu thun mát mẻ và thiết kế thêu đẹp tạo nên một vẻ đẹp sang trọng và thoải mái trong mùa hè.",
            "Đồ bộ nữ, Sét bộ bigsize Đồ Bộ Bigsize, Bộ Đùi Sọc thun gân - Sét bộ nữ gồm áo và quần đùi sọc thun gân. Thiết kế bigsize phù hợp cho các kích cỡ lớn. Chất liệu thoáng khí và thoải mái, mang đến sự tự tin và phong cách cho người mặc.",
            "Set gấu dâu phối tay BIGSIZE 60kg - 110kg [ Nguyễn Diệu Linh bigsize ] - Set gấu dâu phối tay dành cho người có kích cỡ từ 60kg đến 110kg. Thiết kế phong cách và thoải mái, tạo nên vẻ ngoài trẻ trung và cá tính.",
            "Sét Đồ Bộ Đùi Thun Xốp Bigsize 40-95kg, Tôn Dáng Eo - Sét đồ bộ đùi thun xốp bigsize phù hợp cho người có kích cỡ từ 40kg đến 95kg. Kiểu dáng tôn dáng eo và chất liệu thun xốp thoáng mát, mang đến sự thoải mái và phong cách.",
            "Set Đồ Nữ Đi Chơi Quần Đùi Sang Chảnh Bigsize Mùa Hè Chất Thun Mát Bộ Thêu Đẹp SOTIDO SN2 - Bộ đồ nữ gồm quần đùi đi chơi và áo thun sang chảnh. Chất liệu thun mát mẻ và thiết kế thêu đẹp tạo nên một vẻ đẹp nổi bật trong mùa hè.",
            "[Ảnh thật/Sẵn] Váy voan be xếp li ngang ngực tay bồng dáng xòe - Đầm trắng kỉ yếu, dự tiệc - Váy voan trắng xếp li ngang ngực với tay bồng dáng xòe. Thiết kế phù hợp cho các dịp đặc biệt như kỉ yếu hoặc dự tiệc. Chất liệu voan be xếp li ngang ngực tay bồng dáng xòe. Đây là chiếc váy trắng phù hợp cho các dịp đặc biệt như kỉ yếu hoặc dự tiệc. Chất liệu voan cao cấp mang lại vẻ đẹp và sự thoải mái cho người mặc.",
            "[Bảo Hành 6 Tháng] Tai Nghe Mèo Bluetooth P47 Dễ Thương 400mAh - Tai nghe Bluetooth P47 với thiết kế dễ thương hình mèo. Tai nghe có pin dung lượng cao 400mAh và được bảo hành trong 6 tháng. Mang đến trải nghiệm âm thanh tuyệt vời và phong cách cá nhân.",
            "Bộ Đồ Thun Nam Phối Viền Áo Ngắn Tay Cổ Tròn Kết Hợp Quần Short Đùi Thể Thao sozo SET NAM 90000161C - Bộ đồ thun nam với áo ngắn tay và quần short đùi thể thao. Thiết kế phối viền và cổ tròn, mang đến sự thoải mái và phong cách năng động cho nam giới.",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp - Bộ quần áo thể thao nam dành cho mùa hè với kiểu dáng unisex. Hình thêu sắc nét và phong cách cao cấp tạo nên sự năng động và trẻ trung trong mọi hoạt động thể thao.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex - Bộ thể thao nam nữ gồm áo tay ngắn và quần short dáng rộng. Thiết kế phối dây rút bản to tạo nên vẻ thời trang và thoải mái. Phù hợp cho cả nam và nữ.",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818 - Chân váy dáng A tafta big size với cạp cao và váy xòe phồng. Thiết kế sang chảnh và phù hợp cho các dịp đi chơi hay dự tiệc. Chất liệu cao cấp tạo nên sự thoải mái và nổi bật.",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ - Đôi dép đi trong nhà với đế dày chống trượt và họa tiết vịt hoạt hình dễ thương. Sản phẩm dành cho nữ, mang đến sự thoải mái và an toàn khi di chuyển trong nhà.",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm - Đôi dép cá mập ba chiều JOFANNY với size lớn và chất liệu eva. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho phái nữ.",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm - Đôi dép nam nữ JOFANNY với họa tiết cánh hoa và chống trượt. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho cả nam và nữ.",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao - Đôi giày JOFANNY phong cách Anh cổ điển với thiết kế đơn oxford. Giày búp bê nữ và bốt đế xuồng, tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp.",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách - Đồ bộ nam với cổ bẻ và chất liệu cotton cao cấp thoáng mát. Bộ quần áo thể thao mang đến sự thoải mái và phong cách trong mùa hè.",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP - Set đầm cặp gồm áo xoắn tay dài và váy mịn đẹp. Kiểu dáng phù hợp cho các dịp thời trang. Sự kết hợp tinh tế giữa áo và váy tạo nên một vẻ ngoài ấn tượng.",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp - Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét. Phong cách cao cấp và thiết kế đẹp mắt mang đến sự năng động và tự tin cho người mặc.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex - Bộ thể thao nam nữ gồm áo tay ngắn và quần short dáng rộng. Thiết kế phối dây rút bản to tạo nên vẻ thời trang và thoải mái. Phù hợp cho cả nam và nữ.",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818 - Chân váy dáng A tafta big size với cạp cao và váy xòe phồng. Thiết kế sang chảnh và phù hợp cho các dịp đi chơi hay dự tiệc. Chất liệu cao cấp tạo nên sự thoải mái và nổi bật.",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ - Đôi dép đi trong nhà với đế dày chống trượt và họa tiết vịt hoạt hình dễ thương. Sản phẩm dành cho nữ, mang đến sự thoải mái và an toàn khi di chuyển trong nhà.",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm - Đôi dép cá mập ba chiều JOFANNY với size lớn và chất liệu eva. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho phái nữ.",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm - Đôi dép nam nữ JOFANNY với họa tiết cánh hoa và chống trượt. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho cả nam và nữ.",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao - Đôi giày JOFANNY phong cách Anh cổ điển với thiết kế đơn oxford. Giày búp bê nữ và bốt đế xuồng, tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp.",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách - Đồ bộ nam với cổ bẻ và chất liệu cotton cao cấp thoáng mát. Bộ quần áo thể thao mang đến sự thoải mái và phong cách trong mùa hè.",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP - Set đầm cặp gồm áo xoắn tay dài và váy mịn đẹp. Kiểu dáng phù hợp cho các dịp thời trang. Sự kết hợp tinh tế giữa áo và váy tạo nên một vẻ ngoài ấn tượng.",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp - Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét. Phong cách cao cấp và thiết kế đẹp mắt mang đến sự năng động và tự tin cho người mặc.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex - Bộ thể thao nam nữ gồm áo tay ngắn và quần short dáng rộng. Thiết kế phối dây rút bản to tạo nên vẻ thời trang và thoải mái. Phù hợp cho cả nam và nữ.",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818 - Chân váy dáng A tafta big size với cạp cao và váy xòe phồng. Thiết kế sang chảnh và phù hợp cho các dịp đi chơi hay dự tiệc Sang Chảnh THUS8818 - Chân váy dáng A tafta big size với cạp cao và váy xòe phồng. Thiết kế sang chảnh và phù hợp cho các dịp đi chơi hay dự tiệc. Chất liệu cao cấp tạo nên sự thoải mái và nổi bật.",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ - Đôi dép đi trong nhà với đế dày chống trượt và họa tiết vịt hoạt hình dễ thương. Sản phẩm dành cho nữ, mang đến sự thoải mái và an toàn khi di chuyển trong nhà.",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm - Đôi dép cá mập ba chiều JOFANNY với size lớn và chất liệu eva. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho phái nữ.",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm - Đôi dép nam nữ JOFANNY với họa tiết cánh hoa và chống trượt. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho cả nam và nữ.",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao - Đôi giày JOFANNY phong cách Anh cổ điển với thiết kế đơn oxford. Giày búp bê nữ và bốt đế xuồng, tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp.",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách - Đồ bộ nam với cổ bẻ và chất liệu cotton cao cấp thoáng mát. Bộ quần áo thể thao mang đến sự thoải mái và phong cách trong mùa hè.",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP - Set đầm cặp gồm áo xoắn tay dài và váy mịn đẹp. Kiểu dáng phù hợp cho các dịp thời trang. Sự kết hợp tinh tế giữa áo và váy tạo nên một vẻ ngoài ấn tượng.",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp - Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét. Phong cách cao cấp và thiết kế đẹp mắt mang đến sự năng động và tự tin cho người mặc.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex - Bộ thể thao nam nữ gồm áo tay ngắn và quần short dáng rộng. Thiết kế phối dây rút bản to tạo nên vẻ thời trang và thoải mái. Phù hợp cho cả nam và nữ.",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818 - Chân váy dáng A tafta big size với cạp cao và váy xòe phồng. Thiết kế sang chảnh và phù hợp cho các dịp đi chơi hay dự tiệc. Chất liệu cao cấp tạo nên sự thoải mái và nổi bật.",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ - Đôi dép đi trong nhà với đế dày chống trượt và họa tiết vịt hoạt hình dễ thương. Sản phẩm dành cho nữ, mang đến sự thoải mái và an toàn khi di chuyển trong nhà.",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm - Đôi dép cá mập ba chiều JOFANNY với size lớn và chất liệu eva. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho phái nữ.",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm - Đôi dép nam nữ JOFANNY với họa tiết cánh hoa và chống trượt. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho cả nam và nữ.",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao - Đôi giày JOFANNY phong cách Anh cổ điển với thiết kế đơn oxford. Giày búp bê nữ và bốt đế xuồng, tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp.",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách - Đồ bộ nam với cổ bẻ và chất liệu cotton cao cấp thoáng mát. Bộ quần áo thể thao mang đến sự thoải mái và phong cách trong mùa hè.",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP - Set đầm cặp gồm áo xoắn tay dài và váy mịn đẹp. Kiểu dáng phù hợp cho các dịp thời trang. Sự kết hợp tinh tế giữa áo và váy tạo nên một vẻ ngoài ấn tượng.",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp - Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét. Phong cách cao cấp và thiết kế đẹp mắt mang đến sự năng động và tự tin cho người mặc.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex - Bộ thể thao nam nữ gồm áo tay ngắn và quần short dáng rộng. Thiết kế phối dây rút bản to tạo nên vẻ thời trang và thoải mái. Phù hợp cho cả nam và nữ.",
            "Chân Váy Dáng A Tafta BIG SIZE Cạp Cạp Cao, Váy Tacta Xòe Phồng Đi Chơi Dự Tiệc Sang Chảnh THUS8818 - Chân váy dáng A tafta big size với cạp cao và váy xòe phồng. Thiết kế sang chảnh và phù hợp cho các dịp đi chơi hay dự tiệc. Chất liệu cao cấp tạo nên sự thoải mái và nổi bật.",
            "Dép Đi Trong Nhà Đế Dày Chống Trượt Họa Tiết Vịt Hoạt Hình Dễ Thương Cho Nữ - Đôi dép đi trong nhà với đế dày chống trượt và họa tiết vịt hoạt hình dễ thương. Sản phẩm dành cho nữ, mang đến sự thoải mái và an toàn khi di chuyển trong nhà.",
            "JOFANNY dép cá mập ba chiều eva Size Lớn dép nữ chống trượt quai ngang bánh mì nữ đế cao 3cm - Đôi dép cá mập ba chiều JOFANNY với size lớn và chất liệu eva. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho phái nữ.",
            "JOFANNY dép nam nữ cánh hoa chống trượt quai ngang bánh mì nữ bốn màu tùy chọn đế cao 3cm - Đôi dép nam nữ JOFANNY với họa tiết cánh hoa và chống trượt. Thiết kế quai ngang và đế cao 3cm, mang đến sự thoải mái và phong cách cho cả nam và nữ.",
            "JOFANNY Phong cách Anh cổ điển giày lolita độn oxford búp bê nữ bốt đế xuồng bánh mì tăng chiều cao - Đôi giày JOFANNY phong cách Anh cổ điển với thiết kế đơn oxford. Giày búp bê nữ và bốt đế xuồng, tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp.",
            "Đồ Bộ Nam Cổ Bẻ Chất Vải Cotton Cao Cấp Thoáng Mát, Bộ Quần Áo Thể Thao Mùa Hè Phong Cách - Đồ bộ nam với cổ bẻ và chất liệu cotton cao cấp thoáng mát. Bộ quần áo thể thao mang đến sự thoải mái và phong cách trong mùa hè.",
            "SET ĐẦM CẶP ÁO XOẮN TAY DÀI MỊN ĐẸP - Set đầm cặp gồm áo xoắn tay dài và váy mịn đẹp. Kiểu dáng phù hợp cho các dịp thời trang. Sự kết hợp tinh tế giữa áo và váy tạo nên một vẻ ngoài ấn tượng.",
            "Bộ Quần Áo Thể Thao Nam Mùa Hè Unisex, Hình Thêu Sắc Nét, Phong Cách Cao Cấp - Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét. Phong cách cao cấp và thiết kế đẹp mắt mang đến sự năng động và tự tin cho người mặc.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang Phối Dây Rút bản to Thời Trang Unisex - Bộ thể thao nam nữ gồm áo tay ngắn và quần short dáng rộng. Thiết kế phối dây rút bản to tạo nên vẻ thời trang và thoải mái. Phù hợp cho cả nam và nữ.",
        ];
        $cat_ids = Category::all()->pluck("id")->toArray();
        $shop_id = fake()->numberBetween(1, 20);
        $name = fake()->randomElement($products_name);

        $image_ids = [];
        for ($i = 0; $i < 3; $i++) {
            $image_ids[] = fake()->unique()->numberBetween(23, 982);
        }

        return [
            "shop_id" => $shop_id,
            "cat_id" => fake()->randomElement($cat_ids),
            "condition_id" => fake()->numberBetween(1, 3),
            "warehouse_id" => $shop_id,
            "image_ids" => $image_ids,
            "is_variant" => null,
            "is_pre_order" => null,
            "is_buy_more_discount" => null,
            "is_hidden" => null,
            "name" => $name,
            "slug" => Str::slug($name . " " . Str::random(10)),
            "detail" => fake()->randomElement($product_descriptions),
            "brand" => "No brand",
            "inventory" => fake()->numberBetween(1, 2000),
            "sold" => fake()->numberBetween(1000, 3000),
            "price" => fake()->numberBetween(50000, 5000000),
            "rating" => fake()->randomFloat(1, 4, 5),
            "weight" => fake()->numberBetween(1, 10),
            "length" => fake()->numberBetween(1, 10),
            "width" => fake()->numberBetween(1, 10),
            "height" => fake()->numberBetween(1, 10),
        ];
    }
}
