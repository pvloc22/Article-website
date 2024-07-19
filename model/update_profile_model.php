<?php
class updateProfileModel
{
    // require_once ("../config/config.inc.php");

    public static function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST["btnUpload"])) {
            $upload_folder = "view/images";

            // Kiểm tra và tạo thư mục nếu nó không tồn tại
            if (!file_exists($upload_folder)) {
                mkdir($upload_folder, 0777, true);
            }


            $file = $_FILES["uploaded_file"];
            $parts = explode(".", $file["name"]);
            $lastPart = end($parts);
            $name_image = str_replace(' ','',$_POST['name']);
            $saved_name = basename($name_image.".".$lastPart);
            
            $destination = "$upload_folder/$saved_name";

            // Kiểm tra quyền ghi vào thư mục
            if (!is_writable($upload_folder)) {
                die("Error: Cannot write to the upload folder.");
            }

            // Cập nhật thông tin trong cơ sở dữ liệu
            $name = $_POST['name'];
            $email = $_POST['email'];
            $profile_json = json_decode($_POST['profile_json'], true);

            // Kết nối cơ sở dữ liệu và cập nhật thông tin
            // Giả sử bạn có một hàm để cập nhật thông tin người dùng
            $userId = $_SESSION['user_id'];
            // Xử lý upload file
            if (move_uploaded_file($file["tmp_name"], $destination)) {
                // echo "File has been uploaded and updated!<br>";

                // Lấy user ID từ session
                updateProfile($userId, $email, $name, $profile_json, $destination);

                // echo "Profile information has been updated!";
            } else {
                updateProfile($userId, $email, $name, $profile_json, $_SESSION['image_path']);
                // echo "Sorry, there was an error uploading your file.";
            }
        }
    }


}
function updateProfile($userId, $email, $name, $profileJson, $imagePath)
{
    // require_once ("../config/config.inc.php");

    // Kết nối cơ sở dữ liệu (sử dụng PDO hoặc MySQLi)
    // Ví dụ với MySQLi
    $mysqli = connect();
    $mysqli->query("SET NAMES utf8");

    // Kiểm tra kết nối
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Chuẩn bị và thực thi truy vấn cập nhật
    $profileJsonString = json_encode($profileJson);
    $name_website = str_replace(' ', '', $name);
    // $profileJsonString = str_replace('"', '\"', $profileJsonString);

    // $query = "UPDATE AUTHORS SET full_name = \'$name\', website = CONCAT(\"http://\", \"$name\",\".com\"), profile_json_text = \'$profileJsonString.\', image_path =\'$imagePath\' WHERE user_id = {$userId}";
    $query = "
    UPDATE AUTHORS 
    SET 
    full_name = '$name', 
    website = CONCAT('http://', '$name_website','.com'), 
    profile_json_text = '$profileJsonString', 
    image_path = '/$imagePath' 
WHERE user_id = $userId;
    ";
    $result = $mysqli->query($query);

    if ($result) {
        $_SESSION['email'] = $email;
        $_SESSION['full_name'] = $name;
        $_SESSION['bio'] = $profileJson['bio'];
        $_SESSION['interests'] = implode(',', $profileJson['interests']);
        $_SESSION['image_path'] = $imagePath;

        // echo "Profile updated successfully.";
    } else {
        // echo "Error updating profile: ";
    }

    $mysqli->close();
}
?>