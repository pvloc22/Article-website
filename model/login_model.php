<?php
class LoginModel
{
    public static function login($email, $password)
    {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");

        // Truy vấn thông tin người dùng dựa trên email
        $query = "SELECT * FROM USERS U JOIN AUTHORS A ON U.user_id = A.user_id WHERE email = \"$email\" AND password = \"$password\"";
        $result = $mysqli->query($query);
        if ($result->num_rows === 1) {
            $result = $result->fetch_assoc();
            session_start();
            $profile_json_text = json_decode($result['profile_json_text']);
            
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['full_name'] = $result['full_name'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['user_type'] = $result['user_type'];
            $_SESSION['status'] = $result['status'];
            $_SESSION['bio'] = $profile_json_text->bio;
            $_SESSION['interests'] = implode(',', $profile_json_text->interests);
            $_SESSION['image_path'] = $result['image_path'];
            $mysqli->close();
            return true;
        }
        $mysqli->close();
        return false;

    }
}
?>