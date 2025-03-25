<?php
// Tải file cấu hình và routes
require_once '../src/config/config.php'; 
require_once '../src/routes.php';
require_once '../src/controllers/admin/VisitController.php';

// Lấy URL từ request
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/'); // Loại bỏ dấu gạch chéo ở cuối

// Phân tách URL thành các phần
$urlParts = explode('/', $url);

// Tách route chính 
$baseRoute = implode('/', array_slice($urlParts, 0, 2));

// Tách alias nếu có
$alias = $urlParts[2] ?? null;

// Kiểm tra xem route chính có nằm trong danh sách routes đã định nghĩa không
if (isset($routes[$baseRoute])) {
    $controllerName = $routes[$baseRoute]['controller'];
    $action = $routes[$baseRoute]['action'];

    // Xây dựng đường dẫn tới file controller tương ứng
    $controllerCustomerPath = __DIR__ . "/../src/controllers/customer/{$controllerName}.php";
    $controllerAdminPath = __DIR__ . "/../src/controllers/admin/{$controllerName}.php";
    
    // Kiểm tra xem file controller có tồn tại không
    if (file_exists($controllerCustomerPath)) {
        require_once $controllerCustomerPath;
        
        // Khởi tạo controller
        $controller = new $controllerName();

        // Kiểm tra xem action có tồn tại trong controller không
        if (method_exists($controller, $action)) {
            // Gọi action tương ứng và truyền alias (nếu có)
            $visitController = new VisitController();
            $visitController->recordVisit();
            $controller->$action($alias);
        } else {
            // Nếu action không tồn tại, hiển thị lỗi 404
            echo "404 Not Found: Action '{$action}' không tồn tại trong '{$controllerName}'";
        }
    } elseif (file_exists($controllerAdminPath)){
        require_once $controllerAdminPath;
        
        // Khởi tạo controller
        $controller = new $controllerName();

        // Kiểm tra xem action có tồn tại trong controller không
        if (method_exists($controller, $action)) {
            // Gọi action tương ứng và truyền alias (nếu có)
            $controller->$action($alias);
        } else {
            // Nếu action không tồn tại, hiển thị lỗi 404
            echo "404 Not Found: Action '{$action}' không tồn tại trong '{$controllerName}'";
        }
    } else {
        // Nếu file controller không tồn tại, hiển thị lỗi 404
        echo "404 Not Found: Controller '{$controllerName}' không tìm thấy";
    }
} else {
    // Nếu route không tồn tại trong danh sách routes, hiển thị lỗi 404
    echo "404 Not Found";
}
