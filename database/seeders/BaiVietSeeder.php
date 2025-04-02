<?php

namespace Database\Seeders;

use App\Models\BaiViet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = BaiViet::insert(
            [
                [
                    'user_id' => 1,
                    'tieu_de' => 'Chính sách bảo mật',
                    'danh_muc_id' => 1,
                    'noi_dung' => 'Chính sách xử lý và bảo vệ Thông tin cá nhân của khách hàng
                        (Chính sách bảo vệ thông tin cá nhân)

                        1. Giới thiệu
                        Chính sách xử lý và bảo vệ thông tin cá nhân của khách hàng này ("Chính Sách Bảo Vệ Thông Tin Cá Nhân”) giải thích phương thức Công ty TNHH Seven Star Việt Nam (“Công Ty” hoặc “Chúng Tôi”) thu thập, xử lý, sử dụng, bảo vệ và chia sẻ thông tin cá nhân khi quý khách hàng (“Khách Hàng” hoặc “Bạn”) sử dụng website có tên miền www.Seven Star.com/vn (“Website”) và ứng dụng di động Seven Star (“Ứng Dụng”), để mua sắm hoặc chia sẻ thông tin cá nhân của Bạn với Chúng Tôi. Chúng Tôi trân trọng quyền riêng tư của khách hàng và đánh giá cao sự tin tưởng của Bạn rằng Chúng Tôi sẽ tôn trọng quyền riêng tư của Bạn một cách cẩn trọng và đúng đắn.

                        Bằng cách truy cập vào Website và Ứng Dụng hoặc đăng ký là thành viên, Bạn đồng ý với Chúng Tôi về các điều khoản của Chính Sách Thông Tin Cá Nhân này. Vui lòng đọc kỹ Chính Sách Bảo Vệ Thông Tin Cá Nhân này. Hoạt động kinh doanh của Chúng Tôi không ngừng phát triển, các Chính Sách Bảo Vệ Thông Tin Cá Nhân, Website, Ứng Dụng và Điều Khoản Sử Dụng của Chúng Tôi cũng có thể được cập nhật. Việc Bạn tiếp tục sử dụng sản phẩm, dịch vụ của Chúng Tôi được hiểu là Bạn đã chấp nhận bản Chính Sách Bảo Vệ Thông Tin Cá Nhân được cập nhật. Trừ khi có quy định khác, Chính Sách Bảo Vệ Thông Tin Cá Nhân hiện tại của Chúng Tôi áp dụng cho tất cả thông tin mà Chúng Tôi có về Bạn và tài khoản của Bạn, bao gồm nhưng không giới hạn thông tin cá nhân của bạn, và hoặc bất cứ thông tin, dữ liệu nào từ bạn mà chúng tôi có thể có được thông qua Website và Ứng Dụng. Việc Bạn truy cập Website và Ứng Dụng của Chúng Tôi và mọi tranh chấp về quyền riêng tư đều tuân theo Chính Sách Bảo Vệ Thông Tin Cá Nhân này và Điều Khoản Sử Dụng của Website và Ứng Dụng.

                        2. Mục đích thu thập thông tin cá nhân
                        Chúng Tôi sử dụng thông tin về khách hàng cho các mục đích cụ thể mà thông tin được thu thập. Chúng Tôi có thể sử dụng thông tin cá nhân của Bạn cho, bao gồm nhưng không giới hạn, các mục đích sau:
                        2.1.     Để tạo và quản lý tài khoản trực tuyến của Bạn.
                        2.2.     Để thực hiện việc mua, đổi, trả hàng của Bạn, trực tuyến hoặc tại một trong các cửa hàng bán lẻ của Chúng Tôi.
                        2.3.     Để tạo điều kiện cho Bạn tham gia vào các cuộc thi hoặc chương trình khuyến mại.
                        2.4.    Để xử lý việc giao hàng đến cho Bạn, và việc nhận lại hàng trong trường hợp bạn đổi hoặc trả.
                        2.5.     Để xử lý việc nhận thanh toán từ và việc hoàn trả lại tiền đến Bạn.
                        2.6.     Để cung cấp cho Bạn thông tin về các sản phẩm hoặc dịch vụ mà Bạn yêu cầu từ Chúng Tôi hoặc, theo sự đồng ý trước của Bạn, thông tin mà Chúng Tôi cảm thấy Bạn có thể quan tâm, qua email hoặc tin nhắn văn bản.
                        2.7.     Để vận hành, đánh giá và cải thiện hoạt động kinh doanh của Chúng Tôi (bao gồm phát triển các sản phẩm và dịch vụ mới; phân tích và nâng cao các sản phẩm, dịch vụ, Website và Ứng Dụng của Chúng Tôi).
                        2.8.     Để hiểu khách hàng của Chúng Tôi, thực hiện phân tích dữ liệu, và xử lý khác (bao gồm nghiên cứu thị trường và người tiêu dùng, phân tích xu hướng, và việc ẩn danh).
                        2.9.     Để trả lời nhận xét hoặc câu hỏi của Bạn, hoặc tiếp nhận hồ sơ ứng tuyển (nếu có).
                        2.10.     Để chuyển, chia sẻ các nhận xét về hàng hóa trên Website và Ứng Dụng đến đơn vị liên kết của chúng tôi nhằm cân nhắc thể hiện trên website của họ, không bao gồm việc chuyển, chia sẻ thông tin định danh của bạn.
                        2.11.     Theo yêu cầu khác hoặc được pháp luật cho phép.

                        3. Phạm vi sử dụng thông tin cá nhân
                        Thông tin cá nhân được thu thập theo sự đồng ý rõ ràng của Bạn sẽ chỉ được sử dụng cho các hoạt động được nêu tại Chính Sách Bảo Vệ Thông Tin Cá Nhân này, ngoại trừ các trường hợp (i) một thỏa thuận riêng giữa Chúng Tôi và Bạn về việc sử dụng thông tin cá nhân cho các mục đích và phạm vi khác ngoài các mục đích và phạm vi được quy định rõ ràng ở đây, hoặc (ii) Chúng Tôi cung cấp các sản phẩm hoặc dịch vụ theo yêu cầu của Bạn, hoặc (iii) Chúng Tôi thực hiện nghĩa vụ của mình theo luật pháp và quy định hiện hành.

                        4. Thông tin cá nhân được tiếp nhận
                        Dưới đây là các loại thông tin Chúng Tôi tiếp nhận:
                        4.1. Thông tin tự động
                        Đối với mỗi khách hàng truy cập vào Website và Ứng Dụng của Chúng Tôi, máy chủ của Chúng Tôi tự động nhận dạng thông tin liên quan đến tên miền của khách hàng (hoặc nhà cung cấp quyền truy cập của khách truy cập) chứ không phải địa chỉ email. Chúng Tôi cũng có thể tự động thu thập thông tin cá nhân khác như loại trình duyệt Bạn đang sử dụng, địa chỉ website mà Bạn truy cập đã điều hướng đến trang của Chúng Tôi, hệ điều hành Bạn đang sử dụng, tên miền của nhà cung cấp dịch vụ Internet, các trang Bạn truy cập trên Website của Chúng Tôi và thời gian truy cập của Bạn.

                        4.2. Thông tin Bạn cung cấp cho Chúng Tôi
                        Chúng Tôi cũng tiếp nhận và tổng hợp thông tin do Khách Hàng tự nguyện cung cấp, ví dụ như khi Bạn giao tiếp điện tử với Chúng Tôi.

                        4.3. Cookies
                        Chúng Tôi có thể sử dụng cookies và web beacon (còn được gọi là web bug, thẻ pixel hoặc ảnh GIF nhìn rõ) để quản lý Website, Ứng Dụng và các tác vụ email. Cookies là một tệp nhỏ được lưu trên máy tính của Bạn khi Bạn truy cập một website hoặc ứng dụng. Mục đích của nó là quản lý trải nghiệm website và ứng dụng của Bạn và cho phép tùy chỉnh các website và ứng dụng được hiển thị cho Bạn khi Bạn quay lại trang đó. Web beacon là các đoạn mã máy tính nhỏ cho phép chủ sở hữu Website theo dõi hành động của người dùng trên Website và người nhận thư điện tử. Cookies và web beacon giúp Chúng Tôi hiểu cách người tiêu dùng sử dụng Website và Ứng Dụng và email để Chúng Tôi có thể thiết kế các dịch vụ tốt hơn trong tương lai. Chúng Tôi có thể sử dụng cookies và web beacon để đo lường hiệu quả của các sáng kiến quảng cáo trực tuyến của Chúng Tôi và xác định mối tương quan giữa khách hàng của Chúng Tôi và các website trực tuyến mà họ truy cập. Các công ty quảng cáo của bên thứ ba cũng có thể sử dụng cookies và web beacon để thu thập thông tin về các lượt truy cập của Bạn vào Website và Ứng Dụng của Chúng Tôi và các website khác (chẳng hạn như các website Bạn truy cập và liệu Bạn có nhấp vào quảng cáo hay không) để phân phối quảng cáo phù hợp hơn với Bạn, trên và ngoài Website và Ứng Dụng của Chúng Tôi.
                        Danh sách cookie',
                        'created_at' => now()
                ],
                [
                    'user_id' => 1,
                    'tieu_de' => 'FAQ',
                    'danh_muc_id' => 1,
                    'noi_dung' => 'Điều Khoản Sử Dụng

                    1.Giới thiệu

                    1.1. Chào mừng bạn đến với www.Seven Star.com/vn ("Website"). Chúng tôi cung cấp thông tin cho bạn (“Bạn” hoặc “Người Dùng”) trên Website theo các điều khoản và điều kiện tại văn bản này. Bằng cách truy cập, sử dụng Website, (các )sản phẩm và hoặc dịch vụ được cung cấp theo Website (“Sử Dụng”) được điều chỉnh bởi các điều kiện, điều khoản và thông báo dưới đây (“Điều Khoản Sử Dụng”). Bằng việc Sử Dụng Website, Bạn đồng ý tất cả Điều Khoản Sử Dụng và Chính sách bảo vệ thông tin cá nhân của khách hàng, có thể được điều chỉnh, cập nhật bởi chúng tôi tùy từng thời điểm mà không có thông báo trước. Bạn được khuyến nghị nên thường xuyên kiểm tra trang này để biết được những thay đổi đối với Điều Khoản Sử Dụng. Vui lòng hiểu rằng nếu bạn từ chối chấp thuận Điều Khoản Sử Dụng, bạn sẽ không thể sử dụng hoặc mua bất cứ sản phẩm nào tại Website.

                    1.2. Các Điều Khoản Sử Dụng này là cam kết giữa Bạn và Công Ty TNHH Seven Star Việt Nam ("Công Ty").Theo đó Công Ty sẵn sàng cấp cho Bạn quyền truy cập vào Website này.

                    1.3. Công Ty có quyền thay đổi các Điều Khoản Sử Dụng này tùy từng thời điểm .Các quyền của Bạn theo Điều Khoản Sử Dụng này sẽ là quyền theo nội dung được ghi nhận tại phiên bản mới nhất của Điều Khoản Sử Dụng được đăng trên Website tại thời điểm Bạn sử dụng. Bằng cách truy cập hoặc thực hiện bất cứ tác vụ nào trên Website sau khi chúng tôi đã công bố, bạn đồng ý với các nội dung của Điều Khoản Sử Dụng như đã sửa đổi tương ứng.

                    2. Quyền sử dụng và Truy cập Website

                    Công Ty cấp cho Bạn quyền giới hạn để truy cập và sử dụng Website này vì mục đích cá nhân và không được tải xuống hoặc sửa đổi Website, hoặc bất kỳ phần nào trong đó, trừ khi có sự đồng ý rõ ràng bằng văn bản từ Công Ty. Quyền sử dụng này không bao gồm bất kỳ việc bán lại hoặc sử dụng với mục đích thương mại Website hoặc nội dung Website; việc sưu tập, sử dụng bất kỳ danh sách sản phẩm, mô tả hoặc giá cả; bất kỳ việc sử dụng phái sinh nào của Website hoặc nội dung Website; hoặc bất kỳ việc sử dụng khai thác dữ liệu, rô-bốt hoặc các công cụ thu thập và trích xuất dữ liệu tương tự. Không được mô phỏng, sao chụp, sao chép, bán, bán lại, truy cập hoặc khai thác Website hoặc bất kỳ phần nào của Website vì bất kỳ mục đích thương mại nào mà không có sự đồng ý rõ ràng bằng văn bản từ Công Ty. Bạn không được làm giả hoặc sử dụng các kỹ thuật làm giả để đính kèm bất kỳ nhãn hiệu, biểu tượng hoặc thông tin độc quyền nào khác (bao gồm hình ảnh, văn bản, bố cục trang hoặc biểu mẫu) của Công Ty và các công ty liên kết(bao gồm cả Công Ty mẹ, "Công Ty Liên Kết") mà không có sự đồng ý rõ ràng bằng văn bản từ Công Ty.
                    Bất kỳ việc sử dụng trái phép nào đều chấm dứt quyền sử dụng do Công Ty cấp.',
                    'created_at' => now()
                ]
            ]
        );
        // BaiViet::factory()->count(20)->create();
    }
}
