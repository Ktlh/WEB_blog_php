<?php
header("Content-Type: text/html; charset=utf-8;");
header("Content-Encoding: utf-8");
require('templates.php');
require_once '../settins.php';
require_once("../model/pagination.php");
define('Per_Page', 5);

$page = !empty($_GET['page'])?(int)$_GET['page'] : 1;
//Total
$total = count_all(db_connect());

$pagination = new Pagination($page,Per_Page,$total);
$content=null;
$link=db_connect();
$content = articles_all_page($link,$pagination);
$parse->get_tpl('../res/tpl/head.tpl');
print $parse->template;?>

<link href="../res/css/style.css" rel="stylesheet">
<?php
$parse->get_tpl('../res/tpl/header.tpl');
print $parse->template;
Menu();?>
<div class="content">
    <button class="de"> <a href="editMode.php?type=add"> Add New Post</a></button>
<div class="Page">
<?php

//$result = mysqli_query($link, "SELECT * FROM posts ORDER BY `id` DESC LIMIT 0, 3");
//while ($res = mysqli_fetch_array($content))

    foreach($content as $res)
    {
        $material = $res['context'];
        if (strlen($material) > 190)
        {
            $material=substr($material,0,140);
            $material = $material . "...";
        }
    echo '<a href="material.php?id=' . $res['id'] . '"><div class="ChatBlock"><span>Added: ' . $res['data'] . ' by: ' . $_SESSION['LOGIN'] . '  </span> <p class="spanPost">' . $res['name'] . '</p><br>' . $material . '</div></a>';
}?>
    <div style="text-align: center; ">
        <ul >
            <?php
            if ($pagination->count_pages() > 1) {
                if ($pagination->has_previous_page()) {
                    echo "<li><a href=\"userPage.php?page=";
                    echo $pagination->previous_page();
                    echo "\">&laquo; Previous </a></li>";
                    echo "<li><a href=\"userPage.php?page=1";
                    echo "\">First</a></li>";
                    if ($page > 2) {
                        echo "<li><span>...</span></li>";
                    }
                }

                $pagesArr = array();
                for ($i = 1; $i <= $pagination->count_pages(); $i++) {
                    $pagesArr[$i] = $i;
                }

                /*  for ($i = 1; $i <= count($pagesArr); $i++) {

                          if ($i == $page) {
                              echo "<li class='active'><span class='selected'>$i</span></li>";
                          }else{
                            echo " <li><a href='index.php?page={$i}'>$pagesArr[$i]</a></li>";}

                      }*/
                $p1 = $page;
                $p2 = $page + 1;
                $p3 = $page + 2;
                switch ($page) {
                    case $page: {
                        if ($page == 1) {

                            echo " <li class='active'><a href='userPage.php?page={$p1}'>$p1</a></li>";
                            echo " <li><a href='userPage.php?page={$p2}'>$p2</a></li>";
                            echo " <li><a href='userPage.php?page={$p3}'>$p3</a></li>";

                        }
                        if ($page == 2) {
                            $p1--;
                            $p2--;
                            $p3--;
                            echo " <li><a href='userPage.php?page={$p1}'>$p1</a></li>";
                            echo " <li class='active'><a href='userPage.php?page={$p2}'>$p2</a></li>";
                            echo " <li><a href='userPage.php?page={$p3}'>$p3</a></li>";

                        }
                        if ($page > 2 && $page < count($pagesArr)) {
                            $p1--;
                            $p2--;
                            $p3--;
                            echo " <li><a href='userPage.php?page={$p1}'>$p1</a></li>";
                            echo " <li class='active'><a href='userPage.php?page={$p2}'>$p2</a></li>";
                            echo " <li><a href='userPage.php?page={$p3}'>$p3</a></li>";

                        }
                        if ($page > $pagesArr[count($pagesArr) - 1]) {

                            $p1 = $pagesArr[count($pagesArr) - 2];
                            $p2 = $pagesArr[count($pagesArr) - 1];
                            $p3 = $pagesArr[count($pagesArr)];

                            if ($page == $pagesArr[count($pagesArr)]) {
                                echo " <li><a href='userPage.php?page={$p1}'>$p1</a></li>";
                            } else {
                                echo " <li class='active'><a href='userPage.php?page={$p1}'>$p1</a></li>";
                            }
                            echo " <li><a href='userPage.php?page={$p2}'>$p2</a></li>";
                            if ($page == $pagesArr[count($pagesArr)]) {
                                echo " <li class='active'><a href='userPage.php?page={$p3}'>$p3</a></li>";
                            } else {
                                echo " <li><a href='userPage.php?page={$p3}'>$p3</a></li>";
                            }
                        }

                        break;
                    }
                }

                if ($pagination->has_next_page()) {
                    if ($page < $pagination->count_pages() - 1) {
                        echo "<li><span>...</span></li>";
                    }
                    echo " <li><a href=\"userPage.php?page=";
                    echo $pagination->count_pages();
                    echo "\">Last</a></li>";
                    echo " <li><a href=\"userPage.php?page=";
                    echo $pagination->next_page();
                    echo "\">Next &raquo;</a></li>";
                }
            }
            ?>
        </ul>
    </div>
    <script src="../res/js/jquery-1.12.3.js" type="text/javascript"></script>
    <script src="../res/js/index.js" type="text/javascript"></script>
<?php
$parse->get_tpl('../res/tpl/footer.tpl');
print $parse->template;
?>
</div>
</div>

