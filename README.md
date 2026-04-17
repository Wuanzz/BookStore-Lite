## **📚 Bookstore Lite - Hệ thống Quản trị Cửa hàng Sách trực tuyến**

**Bookstore Lite** là một ứng dụng web được phát triển trên nền tảng **Framework Laravel (PHP)**, được xây dựng với mục đích demo cho nội dung **“Framework Laravel và RESTful API”**.

Dự án được xây dựng dựa trên kiến trúc **MVC (Model - View - Controller)** chuẩn mực, đồng thời tích hợp hệ thống cung cấp dữ liệu qua chuẩn **RESTful API**, sẵn sàng mở rộng và kết nối với các ứng dụng bên thứ ba (như Mobile App hoặc Web Client).

---

## **✨ Tính năng nổi bật**

### **🖥️ Khu vực Giao diện Quản trị (Web Dashboard)**

* **Bảo mật & Phân quyền:** Hệ thống đăng nhập (Authentication) dành riêng cho Quản trị viên (Admin) để bảo vệ dữ liệu nội bộ.
* **Quản lý Thể loại (Category CRUD):** Thêm mới, chỉnh sửa, xóa và tra cứu danh sách các Thể loại sách.
* **Quản lý Sách (Book CRUD):** Thao tác toàn diện với kho sách. Tích hợp thanh công cụ lọc và tìm kiếm dữ liệu trực tiếp trên giao diện.
* **Ràng buộc Dữ liệu:** Quản lý chặt chẽ mối quan hệ 1-N (Một thể loại - Nhiều cuốn sách) thông qua Khóa ngoại (Foreign Key).

### **📡 Cổng giao tiếp RESTful API (Dành cho Lập trình viên)**

Hệ thống cung cấp các điểm cuối (Endpoints) trả về dữ liệu định dạng **JSON**:

* **API Sách:** Hỗ trợ lấy toàn bộ danh sách kho sách (Kèm thông tin thể loại) và tiếp nhận dữ liệu thêm sách mới từ bên ngoài.
* **API Thể loại:** Hỗ trợ truy xuất danh mục thể loại và thêm thể loại mới độc lập.

---

## **🛠️ Công nghệ sử dụng**

* **Backend:** PHP 8.x / Framework Laravel 11.x

* **Cơ sở dữ liệu:** MySQL & Eloquent ORM

* **Frontend:** 

  * HTML5, CSS3
  * Giao diện Bootstrap 5 (Sử dụng qua CDN)

* **Kiểm thử API:** Thunder Client (VS Code) / Postman

---

## **🚀 Hướng dẫn Cài đặt & Khởi chạy**

Để chạy dự án trên máy cá nhân, vui lòng thực hiện theo các bước sau:

**Bước 1: Clone dự án** Mở Terminal/Command Prompt và tải mã nguồn về:

```plaintext
git clone https://github.com/Wuanzz/BookStore-Lite.git
cd bookstore-lite
```

**Bước 2: Cài đặt thư viện phụ thuộc** Sử dụng Composer để tải lõi framework và các thư viện cần thiết:

```plaintext
composer install
```

**Bước 3: Tạo database** Mở XAMPP (hoặc công cụ tương đương), truy cập `phpMyAdmin` và tạo một database trống với tên `bookstore_lite_db`.

**Bước 4: Cấu hình Môi trường & Database** Nhân bản file `.env.example` thành file `.env`. Mở file `.env` và cập nhật chuỗi kết nối Database:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore_lite_db
DB_USERNAME=root
DB_PASSWORD=
```

Sau đó, chạy lệnh tạo khóa bảo mật:

```plaintext
php artisan key:generate
```

**Bước 5: Khởi tạo dữ liệu (Migration & Seeder)** Chạy lệnh sau để hệ thống tự động tạo các bảng và nạp sẵn dữ liệu tài khoản quản trị:

```plaintext
php artisan migrate --seed
```

**Bước 6: Chạy ứng dụng** Khởi chạy máy chủ ảo của Laravel bằng lệnh:

```plaintext
php artisan serve
```

Dự án sẽ hoạt động tại địa chỉ: `http://localhost:8000`

---

## **👥 Tài khoản Test mặc định**

Sau khi đã cài đặt môi trường và nạp dữ liệu (seed) xong, bạn có thể truy cập `http://localhost:8000/login` và đăng nhập bằng tài khoản Admin mặc định sau:

* **Quản trị viên:** `admin@gmail.com`
* **Mật khẩu:** `123456`

---

## **📖 Kiểm thử API&#xA0;**

Dành cho việc kiểm thử qua Thunder Client:

* `GET http://localhost:8000/api/books` : Lấy danh sách toàn bộ sách.

* `POST http://localhost:8000/api/books` : Thêm sách mới (Body JSON cần có: `title`, `price`, `category_id`).

  * Ví dụ: 

    ```plaintext
    {
       "title": "Sherlock Holmes",
       "price": 150000,
       "category_id": 1
    }
    ```

* `GET http://localhost:8000/api/categories` : Lấy danh sách thể loại.

* `POST http://localhost:8000/api/categories` : Thêm thể loại mới (Body JSON cần có: `name`).

  * Ví dụ:

    ```plaintext
    {
       "name": "Trinh thám"
    }
    ```