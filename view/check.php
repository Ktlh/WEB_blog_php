<?php
header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
?>
<?

$link = db_connect();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
        or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR']) and ($userdata['user_ip'] !== "0"))
    ) {
        setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
        setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/");
        header("Status: 404 Not Found");
        exit();
    } else {
        if ($userdata['user_login'] == "ADMIN") {
            header("Location: adminPage.php");
            exit();
        } else {
            header("Location: userPage.php");
            exit();
        }
    }
} else {
    print "Включите куки";
}
?>