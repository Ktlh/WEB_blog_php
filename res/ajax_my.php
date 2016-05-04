<?php
require_once '../settins.php';
if(isset($_POST['q'])){
    $link = mysqli_connect("localhost", "root", "", "blog");
    mysqli_query($link, "DELETE FROM posts WHERE id='" . $_POST['q'] . "'");
}
if(isset($_POST['exit'])){
    setcookie("id", "",1);
    setcookie("hash", "",1);
    setcookie("name", "",1);
    session_unset();
    session_destroy();
}
?>
