<?php
class SearchController
{
    public function index()
    {
        $q = $_REQUEST['q'];
        // $data = SearchModel::search($q,1,);
        // session_start();
        // $q = $_REQUEST['q'];

        // echo "Result for <b>$q</b>: <hr/>";
        // // Kiểm tra xem người dùng đã đăng nhập hay chưa
        // if (!isset($_SESSION["email"])) {
        //     header("Location: index.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
        //     exit();
        // }

        // Lấy thông tin người dùng từ session hoặc cơ sở dữ liệu (tùy theo thiết kế của bạn)
        // $email = $_SESSION["email"];

        // $DECORATE = "view/css/search.css";
        // $VIEW = "view/search.php";
        // require_once"view/search.php";
        // $q = isset($_REQUEST['q']) ? htmlspecialchars($_REQUEST['q']) : '';
        // $result = "Search results for: <b>$q</b>";
        // echo $result;
        echo require_once "view/search.php";

        // foreach ($data as $row) {
        //     echo $row->title . "<br>";
        // }
    }
}
?>