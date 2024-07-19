<?php
function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "PublicationDB";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Couldn't connect MYSQL". $conn->connect_error);
    }
    return $conn;
}
?>