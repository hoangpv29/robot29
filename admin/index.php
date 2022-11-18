<?php
include "../dao/pdo.php";
include "../dao/category_dao.php";
include "../dao/product_dao.php";

include "header.php";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'adddm':
            //kiểm tra xem người dùng có click vào add danh mục k
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tenloai = $_POST['tenloai'];
                $anhloai = $_FILES['anhloai']['name'];
                $target_dir = "../upload";
                $target_file = $target_dir . basename($_FILES["anhloai"]["name"]);
                insert_dm($tenloai, $anhloai);
                $thongbao = "them thành công";
            }
            include "category/add.php";
            break;
        case 'listdm':
            $listdm = loadAll_dm();
            include "category/list.php";
            break;
        case 'xoadm':
            if ($_GET['id'] && $_GET['id'] > 0) {
                delete_dm($_GET['id']);
            }
            $listdm = loadAll_dm();
            include "category/list.php";
            break;
        case 'suadm':
            if ($_GET['id'] && $_GET['id'] > 0) {
                $dm = loadOne_dm($_GET['id']);
            }
            $listdm = loadAll_dm();
            include "category/update.php";
            break;

        case 'updatedm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $tenloai = $_POST['tenloai'];
                $anhloai = $_FILES['anhloai']['name'];
                $target_dir = "../upload";
                $target_file = $target_dir . basename($_FILES["anhloai"]["name"]);
                update_dm($id, $tenloai, $anhloai);
                $thongbao = "cập nhật thành công";
            }
            $listdm = loadAll_dm();

            include "category/list.php";

            break;
            case 'addpro':
                if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $categoryid = $_POST['categoryid'];
                    $productName = $_POST['productName'];
                    $productPrice = $_POST['productPrice'];
                    $productDesc = $_POST['productDesc'];
                    $quatity = $_POST['quatity'];
                    $productImage = $_FILES['productImage']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
                    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
                    } else {
                    }
                    insert_product($productName, $productPrice, $productImage, $productDesc, $quatity, $categoryid);
                    $thongbao = "Thêm thành công";
                }
                $listdm = loadAll_dm();
                include "product/addpro.php";
                break;
    
            case 'listpro':
                // if (isset($_POST['listok']) && ($_POST['listok'])) {
                //     $kyw = $_POST['kyw'];
                //     $categoryid = $_POST['categoryid'];
                // } else {
                //     $kyw = '';
                //     $categoryid = 0;
                // }
                $listdm = loadAll_dm();
                $listproduct = loadall_product();
                include "product/list.php";
                break;
            case 'xoapro':
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    delete_product($_GET['id']);
                }
                $listproduct = loadall_product("", 0);
                include "product/list.php";
                break;
    
            case 'suapro':
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $product = loadone_product($_GET['id']);
                }
                $listdm = loadAll_dm();
                include "product/update.php";
                break;
            case 'updatepro':
                if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                    $id = $_POST['id'];
                    $categoryid = $_POST['categoryid'];
                    $productName = $_POST['productName'];
                    $productPrice = $_POST['productPrice'];
                    $productDesc = $_POST['productDesc'];
                    $productImage = $_FILES['productImage']['name'];
                    $quatity = $_POST['quatity'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
                    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
                        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                    update_product($id, $categoryid, $productName, $productPrice, $productImage, $productDesc, $quatity);
                    $thongbao = "Cập nhật thành công";
                }
                $listdm = loadAll_dm();
                $listproduct = loadall_product("", 0);
                include "product/list.php";
                break;
    
        default:
            include "home.php";
            break;
    }
}
include "home.php";
include "footer.php";
