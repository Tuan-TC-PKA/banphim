# Giới thiệu
**Ứng dụng quản lý bán bàn phím**

👨‍💻 **Tiêu Công Tuấn**

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
- **Quản lý đơn hàng**: Theo dõi trạng thái các đơn hàng đã đặt, xem lịch sử mua sắm và chi tiết từng đơn.

- **Giỏ hàng**: Thêm sản phẩm vào giỏ hàng, điều chỉnh số lượng, áp dụng và tính toán tổng chi phí trước khi thanh toán. Giỏ hàng được lưu tự động cho các lần truy cập sau.

- **Xem sản phẩm**: Duyệt danh sách sản phẩm với hình ảnh chi tiết, mô tả đầy đủ, thông số kỹ thuật và đánh giá từ khách hàng khác. Xem các sản phẩm liên quan và gợi ý phụ kiện đi kèm.

- **Mua sản phẩm**: Quy trình thanh toán đơn giản với nhiều phương thức thanh toán. Chọn địa chỉ giao hàng và phương thức vận chuyển phù hợp. Nhận xác nhận đơn hàng qua email.

- **Lọc sản phẩm và tìm kiếm**: Tìm kiếm nhanh chóng bằng từ khóa hoặc lọc sản phẩm theo nhiều tiêu chí như giá cả, thương hiệu, loại switch, kết nối và bố cục. Sắp xếp kết quả theo mức độ phổ biến, giá cả hoặc đánh giá.

## Hình ảnh website
### Trang chủ
![image](https://github.com/user-attachments/assets/1cff7415-ed67-4fa5-89bd-6312890359c4)

### Trang shop
![image](https://github.com/user-attachments/assets/7edc4806-919e-4228-bbec-56e78226c6ba)

### Chi tiết sản phẩm
![image](https://github.com/user-attachments/assets/5b296312-0f43-4c0a-ac77-5c147ecd09a0)

### Giỏ hàng
![image](https://github.com/user-attachments/assets/5a6c4706-ca18-4f92-991e-7414d07097c2)

### Lịch sử mua hàng
![image](https://github.com/user-attachments/assets/2529b2ff-6882-44cb-910a-6c0e867313bd)

### Admin dashboard
![image](https://github.com/user-attachments/assets/cd1a818f-7a28-40fc-8320-f971ee27c304)

### All products
![image](https://github.com/user-attachments/assets/aedf76bb-2923-4302-a9b6-c8c88c11e77b)

### Keycaps
![image](https://github.com/user-attachments/assets/a75b7c6e-8611-47e7-beaa-8aedcf54f19c)

### Keyboards
![image](https://github.com/user-attachments/assets/eba69a46-e163-4b0b-9dda-30896095a658)

### Switch
![image](https://github.com/user-attachments/assets/34a7e204-2646-44d1-bdcc-1dcea6c211e2)

### Order
![image](https://github.com/user-attachments/assets/30f70c6d-1b41-49a1-82dc-15e5071f9574)


## Deployment
https://xiao.software

## Repo
https://github.com/Tuan-TC-PKA/banphim

## Video demo
https://drive.google.com/file/d/1rshb4BMEU-3toyNFDvV1eAIZXO_2hu4D/view?usp=sharing

Dự án này được cấp phép theo [Giấy phép MIT](LICENSE).
