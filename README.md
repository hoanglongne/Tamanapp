#### Hướng dẫn chạy dự án Tamanapp - webapp quản lý nhân viên và tasks:

1. Clone dự án về máy:
```
git clone https://github.com/hoanglongne/Tamanapp.git
```

2. Mở Docker Engine

3. Di chuyển vào thư mục dự án:
```
cd Tamanapp
```

4. Copy file env mẫu sau:
```
cp .env.example .env
```

Sau đó sửa đổi: 
```
DB_DATABASE=task_management
```

5. Tải các dependencies PHP thông qua Composer:
```
composer install
```

6. Tải các dependencies Javascript thông qua npm:
```
npm install
```

7. Tạo key cho ứng dụng:
```
php artisan key:generate
```

8. Chạy docker compose:
```
docker-compose up -d
```

9. Migrate database và tạo sẵn dữ liệu giả:
```
php artisan migrate --seed
```

10. Chạy server Laravel:
```
php artisan serve
```

11. Chạy UI: 
```
npm run dev
```

12. Mở dự án trên browser: http://localhost:8000

### Tài khoản đăng nhập

1. Username: test@example.com
2. Mật khẩu: password