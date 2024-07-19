
<?php
    class WelcomeController{
        public function index(){
            session_start();

            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if (!isset($_SESSION["email"])) {
                header("Location: index.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
                exit();
            }
            
            // Lấy thông tin người dùng từ session hoặc cơ sở dữ liệu (tùy theo thiết kế của bạn)
            $email = $_SESSION["email"];

            $DECORATE = "view/css/welcome_faild.css";
            $VIEW = "view/welcome.php";
            require_once"view/template/template.php";
    }
}
?>