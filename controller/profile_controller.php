
<?php
    class ProfileController{
        public function index(){
            session_start();
            $user_id = $_SESSION['user_id'];

            $data_info = ProfileModel::getInformation($user_id);
            $data = ProfileModel::getMypapers($user_id);

            $data_info->profile_json_text = json_decode($data_info->profile_json_text);

            $DECORATE = "view/css/profile.css";
            $VIEW = "view/profile.php";
            require_once"view/template/template.php";
    }
}
?>