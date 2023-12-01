# Hướng dẫn dùng project
* Chạy composer install
* Chạy php artisan key:generate để tạo APP_KEY
* Chạy php artisan migrate để tạo bảng CSDL


# Cách dùng laravel mix thay cho koala
* npm install
* npm run watch (danh cho dev)
* npm run prod (khi push)

# Yêu cầu bắt buộc để tối ưu page speed
* Thẻ a, input, button bắt buộc có thuộc tính aria-label
* Thẻ image bắt buộc sử dụng components 'web.general.components.image', có đủ thuộc tính width, height, alt, lazy nếu có
* Thẻ button bắt buộc có thuộc tính name
* Scss, js bắt buộc viết đúng chuẩn tách theo các components nhỏ và sử dụng build theo config webpack.mix.js
* Hình ảnh nằm trong khung nhìn đầu tiên không được đặt lazy
* Không sử dụng font icon mà sử dụng svg thay thế
