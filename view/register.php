<?php
header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
require('templates.php');
require_once '../settins.php';


$link = db_connect();

if (isset($_POST['submit'])) {
    $err = array();


    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if (strlen($_POST['password']) < 3 or strlen($_POST['password']) > 30) {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }


    $temp = mysqli_real_escape_string($link, $_POST['login']);
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login=('$temp')");
    if (mysqli_num_rows($query) > 0) {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }


    if (count($err) == 0) {

        $login = $_POST['login'];


        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link, "INSERT INTO users SET user_login='" . $login . "', user_password='" . $password . "'");
        header("Location: login.php");
        exit();
    } else {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
}
?>
<?php
$parse->get_tpl('../res/tpl/head.tpl');
print $parse->template;?>
<link href="../res/css/style.css" rel="stylesheet">
<?php
$parse->get_tpl('../res/tpl/header.tpl');
print $parse->template;
Menu();?>
<div class="content2">
    <div class="Page">
<div class="form">
    <form method="POST">
        Логін: <input name="login" type="text"><br>
        Пароль <input name="password" type="password"><br>
        <input name="submit" type="submit" value="Зарегистрироваться">

</form>
    <script src="../res/js/jquery-1.12.3.js" type="text/javascript"></script>
    <script src="../res/js/index.js" type="text/javascript"></script>
<?php
$parse->get_tpl('../res/tpl/footer.tpl');
print $parse->template;
?>
</div>
</div>