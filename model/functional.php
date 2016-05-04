<?php

function Menu () {
    if($_SESSION['USER_LOGIN_IN']==1){
    if ($_SESSION['USER_ID'] == 22) $Menu = '<a href="../view/adminPage.php"><div class="Menu">Админ режим</div></a><a href="../view/login.php"><div class="Menu">Вход</div></a><a href="../view/register.php"><div class="Menu">Регистрация</div></a>';
    else $Menu = '<a href="../view/login.php"><div class="Menu">Вход</div></a><a href="../view/register.php"><div class="Menu">Регистрация</div></a>';
    echo '<div class="MenuHead"><a href="../index.php"><div class="Menu">Главная</div></a><a href="../view/userPage.php"><div class="Menu">Новости</div></a>'.$Menu.'<div id="exit" class="Menu">Виход</div></div>';
}
    else echo '<div class="MenuHead"><a href="../index.php"><div class="Menu">Главная</div></a><a href="../view/login.php"><div class="Menu">Вход</div></a><a href="../view/register.php"><div class="Menu">Регистрация</div></a></div>';
}
function generateCode($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}
function get_one($link, $id)
{
    $query = sprintf("SELECT * FROM posts WHERE id = %d",(int)$id);
    $result = mysqli_query($link, $query);
    if(!$result) die(mysqli_error($link));
    $post = mysqli_fetch_assoc($result);
    return $post;
}


function articles_all_page($link, Pagination $p)
{

    $query = "SELECT * FROM posts ORDER BY id DESC ";
    $query .= "LIMIT  {$p->per_page} ";
    $query .= "OFFSET {$p->offset()} ";
    $result = mysqli_query($link, $query);

    if (!$result)
        die(mysqli_error($link));

    $n = mysqli_num_rows($result);
    $articles = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $articles[] = $row;
    }
    return $articles;
}

function count_all($link){
    $query = "SELECT COUNT(*) AS total FROM posts";
    $result = mysqli_query($link,$query);
    $data =  mysqli_fetch_assoc($result);
    if(!$result)
        die(mysqli_error($link));

    return $data['total'];
}
?>