<?php
require_once ("./config/config.inc.php");

require_once ("./controller/home_controller.php");
require_once ("./controller/login_controller.php");
require_once ("./controller/welcome_controller.php");
require_once ("./controller/faild_controller.php");
require_once ("./controller/logout_controller.php");
require_once ("./controller/profile_controller.php");
require_once ("./controller/update_profile_controller.php");
require_once ("./controller/search_controller.php");
require_once ("./controller/detail_item_controller.php");
require_once ("./controller/new_paper_controller.php");



require_once ("./model/home_model.php");
require_once ("./model/login_model.php");
require_once ("./model/search_model.php");
require_once ("./model/profile_model.php");
require_once ("./model/update_profile_model.php");
require_once ("./model/detail_page_model.php");


$action = "";
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
}

switch ($action) {
    case "login-page":
        $controller = new LoginController();
        $controller->index();
        break;
    case "login":
        $controller = new LoginController();
        $controller->login();
        break;
    case "welcome":
        $controller = new WelcomeController();
        $controller->index();
        break;
    case "faild":
        $controller = new FaildController();
        $controller->index();
        break;
    case "logout":
        $controller = new LogoutController();
        $controller->index();
        break;
    case "profile":
        $controller = new ProfileController();
        $controller->index();
        break;
    case "page-update-profile":
        $controller = new UpdateProfileController();
        $controller->index();
        break;
    case "update-profile":
        $controller = new UpdateProfileController();
        $controller->updateProfile();
        break;
    case "search":
        $controller = new SearchController();
        $controller->index();
        break;
    case "detail-item":
        $controller = new DetailItemController();
        $controller->index();
        break;
    case "new-paper":
        $controller = new NewPaperController();
        $controller->index();
        break;
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}

?>