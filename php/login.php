<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM users WHERE login = '$login' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["login"] = $login;
        $_SESSION["permission_level"] = $row["permission_level"];
        header("location: dashboard.php");
    } else {
        header("location: ../login_error.html");
    }
}
?>
