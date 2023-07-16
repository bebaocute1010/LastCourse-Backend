<?php

namespace Database\Factories;

use App\Models\Comment;
use Faker\Provider\vi_VN\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;
    protected $bill_details = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Person($this->faker));

        $customer_reviews = [
            "Sản phẩm rất tốt, chất liệu mềm mại và thoải mái khi mặc. Tôi rất hài lòng với kiểu dáng và phong cách của nó.",
            "Áo thun in gấu Brosie có form rộng phù hợp với mọi người. Chất liệu cotton cao cấp tạo nên sự thoải mái và vẻ ngoài trẻ trung.",
            "Bộ đồ đi chơi quần đùi thun cotton rất mát và thoải mái trong mùa hè. Tôi thích mẫu thêu đẹp trên áo.",
            "Áo thun in hình 3 chú gấu nổi chữ làm cho sản phẩm thêm dễ thương và đáng yêu. Chất liệu cotton cao cấp cung cấp sự thoải mái và thoáng khí.",
            "Set áo li cột nơ và chân váy có quần vừa đẹp vừa sang chảnh. Chất liệu và kiểu dáng tạo nên sự lịch lãm và nổi bật.",
            "Bộ đồ nữ bigsize quần short cotton SOTIDO rất thoải mái và thêu đẹp. Tôi cảm thấy tự tin và thoải mái khi mặc nó.",
            "Set gấu dâu phối tay bigsize của Nguyễn Diệu Linh thật phù hợp với tôi. Chất lượng tốt và màu sắc đẹp.",
            "Bộ đồ đùi thun xốp bigsize tôn dáng eo và rất mát trong mùa hè. Tôi cảm thấy thoải mái và tự tin khi mặc nó.",
            "Set đồ nữ đi chơi quần đùi sang chảnh bigsize mùa hè thật đẹp và thoải mái. Chất liệu và kiểu dáng tạo nên vẻ ngoài thời trang và phong cách.",
            "Váy voan be xếp li ngang ngực tay bồng dáng xòe là một lựa chọn tuyệt vời cho các dịp đặc biệt. Chất liệu và thiết kế đẹp mắt, tạo nên vẻ nữ tính và quyến rũ.",
            "Tai nghe mèo Bluetooth P47 dễ thương có thời lượng pin lâu và âm thanh tốt. Tôi thích thiết kế và độ kín đáo của nó.",
            "Bộ quần áo thể thao nam với hình thêu sắc nét và phong cách cao cấp. Chất liệu thoáng khí và thoải mái khi vận động.",
            "Bộ thể thao nam nữ áo tay ngắn quần short thời trang và rất thoải mái. Tôi cảm thấy tự tin và năng động khi mặc nó.",
            "Chân váy dáng A tafta big size cạp cao và váy xòe phồng là một lựa chọn hoàn hảo cho các dịp đặc biệt. Chất liệu cao cấp và kiểu dáng tạo nên vẻ ngoài sang trọng và quyến rũ.",
            "Dép đi trong nhà đế dày chống trượt với họa tiết vịt hoạt hình dễ thương là sự lựa chọn tuyệt vời cho sự thoải mái và an toàn khi di chuyển trong nhà.",
            "JOFANNY dép cá mập ba chiều eva size lớn cho phái nữ làm tăng chiều cao và mang đến sự thoải mái. Thiết kế đơn giản nhưng thời trang.",
            "JOFANNY dép nam nữ cánh hoa chống trượt là sự kết hợp hoàn hảo giữa phong cách và an toàn. Đế cao tạo nên sự tự tin và thoải mái khi đi.",
            "JOFANNY giày phong cách Anh cổ điển lolita đơn oxford làm tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp.",
            "Đồ bộ nam cổ bẻ chất vải cotton cao cấp thoáng mát là lựa chọn tuyệt vời cho mùa hè. Thiết kế và chất liệu mang đến sự thoải mái và phong cách.",
            "Set đầm cặp áo xoắn tay dài mịn đẹp là sự kết hợp tinh tế và độc đáo giữa áo và váy. Tạo nên vẻ ngoài ấn tượng và quyến rũ.",
            "Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét và phong cách cao cấp. Tạo nên sự năng động và tự tin khi vận động.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang là sự kết hợp hoàn hảo giữa phong cách và thoải mái. Tôi cảm thấy tự tin và thoải mái khi mặc nó.",
            "Chân váy dáng A tafta big size cạp cao và váy xòe phồng thật tuyệt vời. Thiết kế sang chảnh và phù hợp cho các dịp đặc biệt. Chất liệu cao cấp và đường may tỉ mỉ tạo nên vẻ đẹp sang trọng và cuốn hút.",
            "Dép đi trong nhà đế dày chống trượt với họa tiết vịt hoạt hình dễ thương là sự lựa chọn tuyệt vời cho sự thoải mái và an toàn khi di chuyển trong nhà. Thiết kế đáng yêu và chất liệu êm ái.",
            "JOFANNY dép cá mập ba chiều eva size lớn cho phái nữ làm tăng chiều cao và mang đến sự thoải mái. Thiết kế đơn giản nhưng thời trang, phù hợp cho nhiều dịp.",
            "JOFANNY dép nam nữ cánh hoa chống trượt là sự kết hợp hoàn hảo giữa phong cách và an toàn. Đế cao tạo nên sự tự tin và thoải mái khi đi. Màu sắc tươi sáng và đa dạng lựa chọn.",
            "JOFANNY giày phong cách Anh cổ điển lolita đơn oxford làm tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp. Chất liệu cao cấp và đường may tỉ mỉ.",
            "Đồ bộ nam cổ bẻ chất vải cotton cao cấp thoáng mát là lựa chọn tuyệt vời cho mùa hè. Thiết kế cổ bẻ trẻ trung và chất liệu mềm mại.",
            "Set đầm cặp áo xoắn tay dài mịn đẹp là sự kết hợp tinh tế và độc đáo giữa áo và váy. Tạo nên vẻ ngoài ấn tượng và quyến rũ. Chất liệu mịn màng và đường may tỉ mỉ.",
            "Bộ quần áo thể thao nam mùa hè unisex với hình thêu sắc nét và phong cách cao cấp. Tạo nên sự năng động và tự tin khi vận động. Chất liệu thoáng khí và thoải mái.",
            "Bộ thể thao nam nữ áo tay ngắn quần short dáng rộng thời trang là sự kết hợp hoàn hảo giữa phong cách và thoải mái. Tôi cảm thấy tự tin và thoải mái khi mặc nó.",
            "Chân váy dáng A tafta big size cạp cao và váy xòe phồng thật tuyệt vời. Thiết kế sang chảnh và phù hợp cho các dịp đặc biệt. Chất liệu cao cấp và đường may tỉ mỉ tạo nên vẻ đẹp sang trọng và cuốn hút.",
            "Dép đi trong nhà đế dày chống trượt với họa tiết vịt hoạt hình dễ thương là sự lựa chọn tuyệt vời cho sự thoải mái và an toàn khi di chuyển trong nhà. Thiết kế đáng yêu và chất liệu êm ái.",
            "JOFANNY dép cá mập ba chiều eva size lớn cho phái nữ làm tăng chiều cao và mang đến sự thoải mái. Thiết kế đơn giản nhưng thời trang, phù hợp cho nhiều dịp.",
            "JOFANNY dép nam nữ cánh hoa chống trượt là sự kết hợp hoàn hảo giữa phong cách và an toàn. Đế cao tạo nên sự tự tin và thoải mái khi đi. Màu sắc tươi sáng và đa dạng lựa chọn.",
            "JOFANNY giày phong cách Anh cổ điển lolita đơn oxford làm tăng chiều cao và tạo nên vẻ đẹp thanh lịch và đẳng cấp. Chất liệu cao cấp và đường may tỉ mỉ.",
            "Đồ bộ nam cổ bẻ chất vải cotton cao cấp thoáng mát là lựa chọn tuyệt vời cho mùa hè. Thiết kế cổ bẻ trẻ trung và chất liệu mềm mại.",
            "Set đầm cặp áo xoắn tay dài mịn đẹp là sự kết hợp tinh tế và độc đáo giữa áo và váy. Tạo nên vẻ ngoài ấn tượng và quyến rũ. Chất liệu mịn màng và đường may tỉ mỉ.",
        ];

        $random_number = $this->faker->numberBetween(1, 5);
        $images = [];
        $comment_images = [
            "https://storage.googleapis.com/cdn.nhanh.vn/store/25618/artCT/87825/ao_thun_unisex_nam_1.jpg",
            "https://storage.googleapis.com/cdn.nhanh.vn/store/25618/artCT/87825/ao_thun_unisex_nam_2.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVcAk-mybOPU1Zey2t_UC9LIrZ31lb2-oR-lSlQ7eN2UTDuCPaes_FohAFr_12rEnQSCU&usqp=CAU",
            "https://cf.shopee.vn/file/077c826170aaf376def0aeca0ff6061a",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrb88NQQbFpMb9P1GhlxZ-w23-fK-hLiEBljEFoUcKdYHUtEoTVKlVb1xYljl_3Zsut_I&usqp=CAU",
            "https://salt.tikicdn.com/cache/w1200/ts/product/cb/d2/a0/c2bd00e68910e5162272f0dc2ef165f1.jpg",
            "https://bizweb.dktcdn.net/100/386/478/products/6062613d-70ad-4f61-918f-1f14d1d3a48e.jpg?v=1648116718603",
            "https://shop.dazlinn.com/wp-content/uploads/2022/08/ao-thun-fromm-r-ng-n-ao-thun-ki-u-n-han-qu-c-v-i-cotton-thoang-mat-ao-phong.jpg",
            "https://cdn.gumac.vn/image/01/onpage/bai-39/ao-phong-nu-mau-vang270320191106274172.jpg",
            "https://ghp-garment.com/wp-content/uploads/2022/09/ao-phong-nu-form-rong-famous-in-hinh-gau-ao-thun-nu-cotton-oversize-tay-ngan-co-tron-1-scaled.jpg",
        ];
        for ($i = 0; $i < $random_number; $i++) {
            $images[] = $this->faker->randomElement($comment_images);
        }
        return [
            "bill_id" => $this->faker->numberBetween(1, 1000),
            "product_id" => $this->faker->numberBetween(1, 320),
            "user_id" => $this->faker->numberBetween(1, 50),
            "images" => $images,
            "content" => $this->faker->randomElement($customer_reviews),
            "rating" => $this->faker->numberBetween(3, 5),
        ];
    }
}
