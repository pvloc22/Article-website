<?php
class LogoutController
{
    public function index()
    {
        session_start(); // Bắt đầu session

        // Hủy bỏ tất cả các session
        $_SESSION = array();

        // Nếu session được lưu bằng cookie, xóa cookie session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Hủy bỏ session
        session_destroy();

        // Chuyển hướng người dùng về trang chủ hoặc trang đăng nhập
        header("Location: index.php");
        exit;
    }
}
?>