<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="view/css/home.css" rel="stylesheet" type="text/css" /> -->
    <link href="view/css/template.css" rel="stylesheet" type="text/css" />
    <link href=<?php echo '"' . $DECORATE . '"' ?> id="css-decorate" rel="stylesheet" type="text/css" />

    <!-- <link href="view/css/login.css" rel="stylesheet" type="text/css" /> -->

    <title>Document</title>
</head>

<body>
    <div id="container">
        <header>
            <div class="header-left">
                <a href="index.php">Home</a>
                <a href="#">Topics</a>
                <a href="#">Authors</a>
                <a href="#">Contact</a>
            </div>
            <div class="header-right">
                <div class="search">
                    <input id="keyword" type="text" name="query">
                    <button type="submit" onclick="searchPaper()">Search</button>
                </div>

                <div class="user-options">
                    <?php if (!$is_logged_in): ?>
                        <a href="index.php?action=login-page"><button>Login</button></a>
                    <?php else: ?>
                        <div class="dropdown">
                            <select id="userDropdown" onchange="handleSelectChange()">
                                <option value=""><?php echo $_SESSION['username'] . " (" . $_SESSION['user_type'] . ")"; ?>
                                </option>
                                <option value="profile">Profile</option>
                                <option value="newPaper">New paper</option>
                                <option value="logout">Logout</option>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>
        <main>
            <?php 
                require_once($VIEW);
            ?>
        </main>

        <footer>
            <p>&copy; 2024 Your Company Name. All Rights Reserved.</p>
        </footer>
    </div>
    <script>
        // JavaScript for handling select option change
        function handleSelectChange() {
            var select = document.getElementById('userDropdown');
            var value = select.value;
            if (value === 'profile') {
                window.location.href = 'index.php?action=profile';
            } else if (value === 'settings') {
                window.location.href = 'index.php?action=search';
            } else if (value === 'logout') {
                window.location.href = 'index.php?action=logout';
            } else if (value == 'newPaper') {
                window.location.href = 'index.php?action=new-paper';
            }
        }
    </script>

    <script src="view/ajax/search.js"></script>
</body>

</html>