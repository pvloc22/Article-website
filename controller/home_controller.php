
<?php
    class HomeController{
        public function index(){
            $data = HomeModel::listAll();
            // foreach ($data as $row) {
            //     // echo $row->topic_id . "<br>";
            //     foreach ($row->papers as $key) {
            //         echo $key->title . "<br>";
            //     }
            // }
            $DECORATE = "view/css/home.css";
            // $DECORATE = "view/css/template.css";
            $VIEW = "./view/home.php";
            require_once"view/template/template.php";
    }
}
?>