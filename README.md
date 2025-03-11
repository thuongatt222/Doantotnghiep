# Dự án Trang Web Bán Giày (Laravel)

## Mô tả

Dự án này là một trang web thương mại điện tử được xây dựng bằng Laravel, tập trung vào việc bán giày dép. Dự án cung cấp các tính năng sau:

* **Quản lý sản phẩm**: Cho phép người quản trị thêm, sửa, xóa sản phẩm, danh mục, thương hiệu.
* **Giỏ hàng và thanh toán**: Khách hàng có thể thêm sản phẩm vào giỏ hàng, tiến hành thanh toán trực tuyến.
* **Quản lý người dùng**: Hệ thống đăng ký, đăng nhập, quản lý thông tin người dùng.
* **Tìm kiếm và lọc sản phẩm**: Cho phép người dùng tìm kiếm sản phẩm theo tên, danh mục, thương hiệu, giá cả.
* **Quản lý đơn hàng**: Người quản trị có thể theo dõi và quản lý các đơn hàng.
* **Phản hồi và đánh giá**: Khách hàng có thể đánh giá và để lại bình luận về sản phẩm.
* **Giao diện người dùng thân thiện**: Thiết kế giao diện đẹp mắt, dễ sử dụng.

## Công nghệ sử dụng

* Laravel Framework
* PostgreSQL Database
* HTML, JavaScript
* Composer (quản lý thư viện PHP)
* npm (quản lý thư viện JavaScript)

## Cài đặt

1.  **Sao chép dự án**:

    ```bash
    git clone [https://github.com/thuongatt222/Doantotnghiep.git](https://github.com/thuongatt222/Doantotnghiep.git)
    cd Doantotnghiep
    ```

2.  **Cài đặt các thư viện PHP**:

    ```bash
    composer install
    ```

3.  **Sao chép file .env.example thành .env và cấu hình database**:

    ```bash
    cp .env.example .env
    ```

    * Cấu hình thông tin database PostgreSQL trong file .env.

4.  **Tạo key cho ứng dụng**:

    ```bash
    php artisan key:generate
    ```

5.  **Chạy migrate để tạo bảng database**:

    ```bash
    php artisan migrate
    ```

6.  **Cài đặt các thư viện JavaScript**:

    ```bash
    npm install
    ```

7.  **Biên dịch tài sản**:

    ```bash
    npm run dev
    ```

8.  **Khởi động server**:

    ```bash
    php artisan serve
    ```

## Cấu trúc thư mục

* `app/`: Chứa mã nguồn chính của ứng dụng.
* `database/`: Chứa các file migrations và seeders.
* `public/`: Chứa các file tĩnh như JavaScript, hình ảnh.
* `resources/views/`: Chứa các file giao diện người dùng (Blade templates).
* `routes/`: Chứa các file định tuyến (routes) của ứng dụng.

## Hướng dẫn sử dụng

* Truy cập vào `http://localhost:8000` để xem trang web.
* Sử dụng các chức năng tìm kiếm, lọc để tìm sản phẩm mong muốn.
* Thêm sản phẩm vào giỏ hàng và tiến hành thanh toán.
* Đăng ký tài khoản hoặc đăng nhập để quản lý đơn hàng.
* Để vào trang quản trị, cần thêm những thông tin đăng nhập dành cho admin.

## Đóng góp

* Nếu bạn muốn đóng góp cho dự án, hãy tạo một pull request.
* Mọi đóng góp đều được hoan nghênh.

## Giấy phép

* Dự án này được phát hành theo giấy phép MIT.

## Liên hệ

* Tên: Chu Thanh Thưởng
* Email: thuongatt2k3@gmail.com
