<?php
session_start();
header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
require('templates.php');
require_once '../settins.php';
?>
<?php
$link = db_connect();?>
<?php
if (isset($_POST['submitt'])) {


    $query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);



    if ($data['user_password'] === md5(md5($_POST['password']))) {

        $hash = md5(generateCode(10));


        $insip = ", user_ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')";


        mysqli_query($link, "UPDATE users SET user_hash='" . $hash . "' " . $insip . " WHERE user_id='" . $data['user_id'] . "'");


        setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30);
        setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
        setcookie("name", $data['user_login'], time() + 60 * 60 * 24 * 30);

        $_SESSION['USER_ID'] = $data['user_id'];
        $_SESSION['LOGIN'] =$_POST['login'];
       // fLogin($data);
        $_SESSION['USER_LOGIN_IN'] = 1;
        header("Location: check.php");
       exit();
    } else {
        print "Вы ввели неправильный логин или пароль";
    }
}
?>
<?php
$parse->get_tpl('../res/tpl/head.tpl');
print $parse->template;
?>

<link href="../res/css/style.css" rel="stylesheet">
<?php
$parse->get_tpl('../res/tpl/header.tpl');
print $parse->template;
Menu();?>
<div class="content2">
<div class="Page">
    <form method="POST">
        Логин <input name="login" type="text"><br>
        Пароль <input name="password" type="password"><br>
        <input name="submitt" type="submit" value="Войти">
    </form>
    <?php
    $parse->get_tpl('../res/tpl/footer.tpl');
    print $parse->template;
    ?>
    <script src="../res/js/jquery-1.12.3.js" type="text/javascript"></script>
    <script src="../res/js/index.js" type="text/javascript"></script>
</div>
</div>