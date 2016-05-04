<?php
session_start();
require_once 'model/functional.php';

define ('HOST', 'localhost');
define ('USER', 'root');
define ('PASS', '');
define('DB', 'blog');


function db_connect(){
    $link = mysqli_connect(HOST,USER,PASS,DB) or die("Error: ".mysqli_error($link));
    if(!mysqli_set_charset($link, "utf8")){
        printf("Error: ".mysqli_error($link));
    }
    return $link;
}
function fLogin($data){
    $_SESSION['LOGIN'] = $data['user_login'];
}
?>