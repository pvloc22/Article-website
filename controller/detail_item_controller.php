
<?php
    class DetailItemController{
        public function index(){
            $paperId = $_REQUEST['paper-id'];
            $dataAuthor = DetailPageModel::getAuthorsAttendPapers($paperId);
            $datapaper = DetailPageModel::getInfoPaper($paperId);

            $DECORATE = "view/css/detail.css";
            $VIEW = "view/detail_item.php";
            require_once"view/template/template.php";
    }
}
?>