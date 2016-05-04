<?php

header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
require('templates.php');
require_once '../settins.php';
$context = null;
$link = db_connect();


$post = null;
if ($_GET['type'] == 'edit') {
    $post = get_one($link, $_GET['id']);
}
if (isset($_POST['go'])) {
    $context = $_POST['context'];
    $name = $_POST['name'];
    $data = date("Y-m-d H:i:s");

    if ($_GET['type'] == 'add') {
        mysqli_query($link, "INSERT INTO posts SET context='" . $context . "',name='" . $name . "',data='" . $data . "',author='" . $_SESSION['LOGIN'] . "'");
    } else if ($_GET['type'] == 'edit') {
        mysqli_query($link, "UPDATE posts SET context='" . $context . "',name='" . $name . "',data='" . $data . "' WHERE id='" . $_GET['id'] . "'");
    }

header("Location: check.php");
    exit();
}
$parse->get_tpl('../res/tpl/head.tpl');
print $parse->template;?>
<link href="../res/css/style.css" rel="stylesheet">
<?php
$parse->get_tpl('../res/tpl/header.tpl');
print $parse->template;
Menu();
?>
<div class="content2">
    <div class="Page">
        <form method="POST">
            Title: <br>
            <input name="name" type="text" required maxlength="30" value=<?= $post['name'] ?>><br>
            Context:<br>
            <textarea name="context" required id="context"><?= $post['context'] ?></textarea>
            <br>
            <input name="go" type="submit" value="GO">
        </form>
    </div>
    <script src="../res/js/jquery-1.12.3.js" type="text/javascript"></script>
    <script src="../res/js/index.js" type="text/javascript"></script>
    <?php
    $parse->get_tpl('../res/tpl/footer.tpl');
    print $parse->template;?>
</div>