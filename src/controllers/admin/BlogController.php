<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../models/admin/Blog.php';
class BlogController {
    private $db;
    private $blogModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->blogModel = new Blog($this->db);
    }

    public function getall() { 
        $data = $this->blogModel->getAll()->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '../../../views/admin/admin_blog.php';
    }
    
    public function getdetail() {
        $blog_id = $_GET['blog_id'];
        $data = $this->blogModel->getBlogByID($blog_id)->fetch(PDO::FETCH_ASSOC);
        include_once __DIR__ . '../../../views/admin/admin_edit_blog.php';
    }

    public function viewaddblog() {
        include_once __DIR__ . '../../../views/admin/admin_themblog.php';
    }
    
    public function createblog() {  
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $admin_id = $_SESSION['user_id'] ?? null;
    
        // Lấy dữ liệu từ POST request
        $blog_cate = $_POST['blog_cate'] ?? '';
        $blog_name = $_POST['blog_name'] ?? '';
        $main_content = $_POST['main_content'] ?? '';
        $summary = $_POST['summary'] ?? '';
        $description = $_POST['description'] ?? '';
        $alias = $_POST['alias'] ?? '';
        $status = $_POST['status'] ?? '';
        $alt_main_img = $_POST['alt_main_img'] ?? '';
        $alt_sub_img = $_POST['alt_sub_img'] ?? '';
        $keyword_1 = $_POST['keyword_1'] ?? '';
        $keyword_2 = $_POST['keyword_2'] ?? '';
        $keyword_3 = $_POST['keyword_3'] ?? '';
        $keyword_4 = $_POST['keyword_4'] ?? '';
        $keyword_5 = $_POST['keyword_5'] ?? '';
    
        // Kiểm tra dữ liệu đầu vào
        if (empty($blog_cate) || empty($blog_name) || empty($main_content) || empty($alias) || empty($status)) {
            $error = "Vui lòng điền đầy đủ thông tin bắt buộc.";
            include_once __DIR__ . '../../../views/admin/admin_themblog.php';
            return;
        }
    
        // Xử lý file upload
        $uploadDir = __DIR__ . '/../../../public/assets/images/blogs/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
    
        $main_image_path = null;
        $sub_image_path = null;
    
        // Xử lý main_image
        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
            $main_image = $_FILES['main_image'];
            $main_image_path = $this->handleFileUpload($main_image, $uploadDir);
            if (!$main_image_path) {
                $error = "Lỗi khi tải ảnh chính.";
                include_once __DIR__ . '../../../views/admin/admin_themblog.php';
                return;
            }
        } else {
            $error = "Không tìm thấy ảnh chính.";
            include_once __DIR__ . '../../../views/admin/admin_themblog.php';
            return;
        }
    
        // Xử lý sub_image (không bắt buộc)
        if (isset($_FILES['sub_image']) && $_FILES['sub_image']['error'] === UPLOAD_ERR_OK) {
            $sub_image = $_FILES['sub_image'];
            $sub_image_path = $this->handleFileUpload($sub_image, $uploadDir);
            if (!$sub_image_path) {
                $error = "Lỗi khi tải ảnh phụ.";
                include_once __DIR__ . '../../../views/admin/admin_themblog.php';
                return;
            }
        } else {
            $error = "Không tìm thấy ảnh chính.";
            include_once __DIR__ . '../../../views/admin/admin_themblog.php';
            return;
        }
    
        // Gửi dữ liệu tới model
        $result = $this->blogModel->createBlog(
            $admin_id,
            $blog_cate,
            $blog_name,
            $main_image_path,
            $alt_main_img,
            $sub_image_path,
            $alt_sub_img,
            $main_content,
            $summary,
            $description,
            $alias,
            $keyword_1,
            $keyword_2,
            $keyword_3,
            $keyword_4,
            $keyword_5,
            $status
        );
    
        // Xử lý phản hồi từ model
        if ($result['success']) {
            header('Location: /blog');
            exit();
        } else {
            $error = $result['message'];
            include_once __DIR__ . '../../../views/admin/admin_themblog.php';
        }
    }      
    
    public function updateblog() {  
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $admin_id = $_SESSION['user_id'] ?? null;

        $blog_id = $_GET['blog_id'] ?? null; 
    
        // Lấy dữ liệu từ POST request
        $blog_cate = $_POST['blog_cate'] ?? '';
        $blog_name = $_POST['blog_name'] ?? '';
        $main_content = $_POST['main_content'] ?? '';
        $summary = $_POST['summary'] ?? '';
        $description = $_POST['description'] ?? '';
        $alias = $_POST['alias'] ?? '';
        $status = $_POST['status'] ?? '';
        $alt_main_img = $_POST['alt_main_img'] ?? '';
        $alt_sub_img = $_POST['alt_sub_img'] ?? '';
        $keyword_1 = $_POST['keyword_1'] ?? '';
        $keyword_2 = $_POST['keyword_2'] ?? '';
        $keyword_3 = $_POST['keyword_3'] ?? '';
        $keyword_4 = $_POST['keyword_4'] ?? '';
        $keyword_5 = $_POST['keyword_5'] ?? '';
    
        // Kiểm tra dữ liệu đầu vào
        if (empty($blog_cate) || empty($blog_name) || empty($main_content) || empty($alias) || empty($status) || empty($alt_main_img) || 
            empty($alt_sub_img) || empty($keyword_1) || empty($keyword_2) || empty($keyword_3) || empty($keyword_4) || empty($keyword_5)) {
            $error = "Vui lòng điền đầy đủ thông tin bắt buộc.";
            include_once __DIR__ . '../../../views/admin/admin_edit_blog.php';
            return;
        }
    
        $data = $this->blogModel->getBlogByID($blog_id)->fetch(PDO::FETCH_ASSOC);
    
        $uploadDir = __DIR__ . '/../../../public/assets/images/blogs/';
    
        // Xử lý main_image
        
        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
            $main_image = $_FILES['main_image'];
            $new_main_image_path = $this->handleFileUpload($main_image, $uploadDir);

            if ($new_main_image_path) {
                // Xóa ảnh cũ nếu có
                $absolute_main_image_path = $uploadDir . basename($data['main_image']);
                if (!empty($data['main_image']) && file_exists($absolute_main_image_path)) {
                    unlink($absolute_main_image_path); // Xóa file cũ
                }
                $main_image_path = $new_main_image_path;
            }
        } else {
            $main_image_path = $data['main_image'] ?? null; 
        }
    
        // Xử lý sub_image
        
        if (isset($_FILES['sub_image']) && $_FILES['sub_image']['error'] === UPLOAD_ERR_OK) {
            $sub_image = $_FILES['sub_image'];
            $new_sub_image_path = $this->handleFileUpload($sub_image, $uploadDir);
            if ($new_sub_image_path) {
                // Xóa ảnh cũ nếu có
                $absolute_sub_image_path = $uploadDir . basename($data['sub_image']);
                if (!empty($data['sub_image']) && file_exists($absolute_sub_image_path)) {
                    unlink($absolute_sub_image_path); // Xóa file cũ
                }
                $sub_image_path = $new_sub_image_path;
            }
        } else {
            $sub_image_path = $data['sub_image'] ?? null; 
        }
    
        // Gửi dữ liệu tới model
        $result = $this->blogModel->updateBlog(
            $blog_id,
            $admin_id,
            $blog_cate,
            $blog_name,
            $main_image_path,
            $alt_main_img,
            $sub_image_path,
            $alt_sub_img,
            $main_content,
            $summary,
            $description,
            $alias,
            $keyword_1,
            $keyword_2,
            $keyword_3,
            $keyword_4,
            $keyword_5,
            $status
        );
    
        // Xử lý phản hồi từ model
        if ($result['success']) {
            header('Location: /blog');
            exit();
        } else {
            $error = $result['message'];
            include_once __DIR__ . '../../../views/admin/admin_edit_blog.php';
        }
    }

    public function deleteblog() {
        $blog_id = $_GET['blog_id'] ?? null;

        $data = $this->blogModel->getBlogByID($blog_id)->fetch(PDO::FETCH_ASSOC);
    
        $uploadDir = __DIR__ . '/../../../public/assets/images/blogs/';
    
        
        $absolute_main_image_path = $uploadDir . basename($data['main_image']);
        if (!empty($data['main_image']) && file_exists($absolute_main_image_path)) {
            unlink($absolute_main_image_path); // Xóa file cũ
        }
        
        $absolute_sub_image_path = $uploadDir . basename($data['sub_image']);
        if (!empty($data['sub_image']) && file_exists($absolute_sub_image_path)) {
            unlink($absolute_sub_image_path); // Xóa file cũ
        }

        $this->blogModel->deleteBlog($blog_id);
        header('Location: /blog');
    }

    /**
     * Hàm xử lý upload file
     * @param array $file Thông tin file từ $_FILES
     * @param string $uploadDir Thư mục lưu file
     * @return string|null Đường dẫn file nếu thành công, null nếu thất bại
     */
    private function handleFileUpload($file, $uploadDir) {
        // Debug input file
        echo '<pre>';
        print_r($file);
        echo '</pre>';
    
        // Kiểm tra thư mục upload
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        if (!is_writable($uploadDir)) {
            echo "Upload directory is not writable.";
            return null;
        }
    
        // Tạo tên file duy nhất
        $fileName = time() . '_' . uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;
    
        // Kiểm tra MIME type và extension
        $fileType = mime_content_type($file['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
    
        if (!in_array($fileType, $allowedTypes) || !in_array($fileExtension, $allowedExtensions)) {
            echo "Invalid file type or extension.";
            return null;
        }
    
        // Di chuyển file
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            echo "File uploaded successfully to: $uploadPath";
            return "/assets/images/blogs/" . $fileName;
        } else {
            echo "Failed to move uploaded file.";
            return null;
        }
    }
    
}
?>