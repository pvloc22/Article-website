<?php
class LoginController
{
    public function index()
    {
        $DECORATE = "view/css/login.css";
        $VIEW = "./view/login.php";
        require_once "view/template/template.php";
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Thực hiện kiểm tra đăng nhập
        if ($dataCheck = LoginModel::login($email, $password)) {
                // Đăng nhập thành công, chuyển hướng đến trang chào mừng
                header("Location: index.php?action=welcome&email=" . urlencode($email));
                exit();

            } else {
                // Đăng nhập thất bại, hiển thị lại form đăng nhập với thông báo lỗi
                header("Location: index.php?action=faild" );

            }
        } else {
            // Hiển thị form đăng nhập
            include 'views/login.php';
        }
    }
}
?>