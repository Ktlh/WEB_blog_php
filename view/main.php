<?php
header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
require('templates.php');
require_once '../settins.php';

$parse->get_tpl('../res/tpl/head.tpl');
print $parse->template;?>
    <link href="../res/css/style.css" rel="stylesheet">

<?php
$parse->get_tpl('../res/tpl/header.tpl');
print $parse->template;
Menu();
?>
    <div class="content2">
        <img src="../res/img/welcome-stagma-world1.jpg" style="width: 1000px; height: 600px;">
    <div class="Page">

    </div>
</div>
        <script src="../res/js/jquery-1.12.3.js" type="text/javascript"></script>
        <script src="../res/js/index.js" type="text/javascript"></script>
<?php
$parse->get_tpl('../res/tpl/footer.tpl');
print $parse->template;?>
