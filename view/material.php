<?php
header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
require('templates.php');
require_once '../settins.php';

$link = db_connect();
$post = get_one($link, $_GET['id']);

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
        <span>Added: <?= $post['data'] ?>by: <?= $_SESSION['LOGIN'] ?></span>

        <p id="titleSingle"><?= $post['name'] ?></p>
        <hr>
        <br>

        <textarea id="contextSingle" readonly><?= $post['context'] ?></textarea>

    </div>
</div>
</div>
<script src="../res/js/jquery-1.12.3.js" type="text/javascript"></script>
<script src="../res/js/index.js" type="text/javascript"></script>
<?php
$parse->get_tpl('../res/tpl/footer.tpl');
print $parse->template;
?>
