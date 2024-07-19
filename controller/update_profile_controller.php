<?php
class UpdateProfileController
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION["email"])) {
            header("Location: index.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
            exit();
        }
        // Lấy thông tin người dùng từ session hoặc cơ sở dữ liệu (tùy theo thiết kế của bạn)
        $email = $_SESSION["email"];

        $DECORATE = "view/css/update_profile.css";
        $VIEW = "view/update_profile.php";
        require_once "view/template/template.php";
    }
    public function updateProfile()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION["email"])) {
            header("Location: index.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
            exit();
        }
        $user_id = $_SESSION['user_id'];

        updateProfileModel::index();
        $data_info = ProfileModel::getInformation($user_id);
        $data = ProfileModel::getMypapers($user_id);
        $data_info->profile_json_text = json_decode($data_info->profile_json_text);

        // Lấy thông tin người dùng từ session hoặc cơ sở dữ liệu (tùy theo thiết kế của bạn)
        $email = $_SESSION["email"];

        $DECORATE = "view/css/profile.css";
        $VIEW = "view/profile.php";
        require_once "view/template/template.php";
    }
}
?>