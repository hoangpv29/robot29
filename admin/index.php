<?php
include "../dao/pdo.php";
include "../dao/category_dao.php";
include "header.php";
if ((isset($_GET['act'])) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'adddm':
            include "category/add.php";
            break;
            case 'listdm':       
                include "category/list.php";
                break;
            default:
            include "home.php";
            break;
    }
}
include "home.php";
include "footer.php";
?>