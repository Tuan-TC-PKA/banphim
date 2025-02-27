# Giới thiệu
**Ứng dụng quản lý bán bàn phím**
👨‍💻 **Tiêu Công Tuấn**
##

## Mô tả

Ứng dụng quản lý bán bàn phím là một giải pháp toàn diện cho việc quản lý kinh doanh các loại bàn phím. Hệ thống cung cấp các công cụ để theo dõi quản lý đơn hàng và thống kê doanh thu một cách hiệu quả.

Được xây dựng trên nền tảng Laravel, ứng dụng mang đến giao diện thân thiện với người dùng cùng khả năng tùy biến linh hoạt theo nhu cầu kinh doanh cụ thể. Phần mềm hỗ trợ nhiều tính năng độc đáo.

Giải pháp này phù hợp cho các cửa hàng bàn phím chuyên dụng, doanh nghiệp phân phối thiết bị điện tử, hoặc bất kỳ đơn vị nào cần một hệ thống quản lý bán hàng chuyên nghiệp.

## Yêu cầu hệ thống

- PHP >= 8.0
- Composer
- Node.js & NPM
- Cơ sở dữ liệu

## Cài đặt

```bash
# Sao chép mã nguồn
git clone <https://github.com/Tuan-TC-PKA/banphim.git>
cd banphim

# Cài đặt các gói phụ thuộc
composer install
npm install

# Thiết lập môi trường
cp .env.example .env
php artisan key:generate

# Chạy migrations
php artisan migrate
```

## Cấu hình

Chỉnh sửa tệp `.env` để cấu hình:
- Kết nối cơ sở dữ liệu
- Cài đặt email
- URL ứng dụng
- Các cài đặt đặc thù khác

## Sử dụng

```bash
# Khởi động máy chủ phát triển
php artisan serve
```

## Tính năng
### Admin
- **Quản lý đơn hàng**: Theo dõi trạng thái đơn hàng, xử lý đặt hàng mới, cập nhật thông tin vận chuyển, và quản lý hoàn trả sản phẩm. Hệ thống hiển thị lịch sử đơn đặt hàng và cho phép tìm kiếm nhanh.

- **Thống kê**: Tạo báo cáo chi tiết về doanh thu theo ngày, tuần, tháng và năm. Phân tích xu hướng bán hàng, sản phẩm bán chạy và hiệu suất kinh doanh. Biểu đồ trực quan giúp theo dõi sự tăng trưởng và đưa ra quyết định kinh doanh.

- **Quản lý sản phẩm**: Thêm, sửa và xóa thông tin sản phẩm. Quản lý danh mục, giá cả, hình ảnh và tồn kho. Theo dõi số lượng tồn kho và thiết lập cảnh báo khi hàng sắp hết.
### User
- **Quản lý đơn hàng**: Theo dõi trạng thái các đơn hàng đã đặt, xem lịch sử mua sắm và chi tiết từng đơn. Nhận thông báo khi đơn hàng được cập nhật và quản lý việc trả lại hoặc hoàn tiền nếu cần.

- **Giỏ hàng**: Thêm sản phẩm vào giỏ hàng, điều chỉnh số lượng, áp dụng mã giảm giá và tính toán tổng chi phí trước khi thanh toán. Giỏ hàng được lưu tự động cho các lần truy cập sau.

- **Xem sản phẩm**: Duyệt danh sách sản phẩm với hình ảnh chi tiết, mô tả đầy đủ, thông số kỹ thuật và đánh giá từ khách hàng khác. Xem các sản phẩm liên quan và gợi ý phụ kiện đi kèm.

- **Mua sản phẩm**: Quy trình thanh toán đơn giản với nhiều phương thức thanh toán. Chọn địa chỉ giao hàng và phương thức vận chuyển phù hợp. Nhận xác nhận đơn hàng qua email.

- **Lọc sản phẩm và tìm kiếm**: Tìm kiếm nhanh chóng bằng từ khóa hoặc lọc sản phẩm theo nhiều tiêu chí như giá cả, thương hiệu, loại switch, kết nối và bố cục. Sắp xếp kết quả theo mức độ phổ biến, giá cả hoặc đánh giá.

## Đóng góp

Vui lòng đọc hướng dẫn đóng góp trước khi gửi pull request.

## Giấy phép

Dự án này được cấp phép theo [Giấy phép MIT](LICENSE).
