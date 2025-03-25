# Web project
# ANANAS

1. git clone https://github.com/duongminhthuan2003/WebDev_241.git
```bash
WEBDEV_241/
├── public/
│   ├── index.php            # File khởi động chính của ứng dụng
│   └── assets/              # Thư mục chứa các tài nguyên tĩnh dùng chung
│       ├── css/
│       ├── js/
│       └── images/
├── src/ 
│   ├── controllers/         # Chứa các controller xử lý logic ứng dụng
│   │   ├── Customer/
│   │   └── Admin/
│   ├── models/              # Chứa các model để tương tác với cơ sở dữ liệu
│   │   ├── Customer/
│   │   └── Admin/
│   ├──views/                # Chứa các view cho từng phần của ứng dụng
│   │   ├── Customer/
│   │   ├── Admin/
│   │   └── Layout/
│   └── routes.php           # File quản lý các URL của ứng dụng
├── config/ 
│   └── config.php           # File cấu hình cơ sở dữ liệu và cài đặt chung
├── database/                # Thư mục chứa các file SQL tạo bảng và seed dữ liệu
├── .env                     # File chứa thông tin bảo mật (như mật khẩu cơ sở dữ liệu)
└── vendor
```

public -> controller -> model -> view