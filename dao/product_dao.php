<?php
    function insert_product($productName, $productPrice, $productImage, $productDesc, $quatity, $categoryid)
     {
        $sql = "insert into products(productName, productPrice, productImage, productDesc, quatity, categoryid) values('$productName', '$productPrice', '$productImage', '$productDesc', '$quatity', '$categoryid')";
        pdo_execute($sql);
    }
    function loadall_product(){
        $sql = "select * from products where 1 order by id desc";
        // if ($kyw != "") {
        //     $sql .= " and name like '%" . $kyw . "%'";
        // }
        // if ($categoryid > 0) {
        //     $sql .= " and categoryid = '" . $categoryid . "'";
        // }
        // $sql .= ' order by id desc';
        $listproduct = pdo_query($sql);
        return $listproduct;
    }

function delete_product($id)
{
    $sql = "delete from products where id =" . $id;
    pdo_execute($sql);
}

function loadall_product_home()
{
    $sql = "select * from products where 1 order by id desc limit 0,9";
    $listproduct = pdo_query($sql);
    return $listproduct;
}

function load_ten_dcategory($categoryid)
{
    if($categoryid > 0){
    $sql = "select * from categorys where id =" . $categoryid;
    $category = pdo_query_one($sql);
    extract($category);
    return $categoryName;
    }else{
        return "";
    }
}
function loadone_product($id)
{
    $sql = "select * from products where id =" . $id;
    $pro = pdo_query_one($sql);
    return $pro;
}
function load_product_cungloai($id, $categoryid)
{
    $sql = "select * from products where categoryid = ".$categoryid." AND id <>" . $id;
    $listproduct = pdo_query($sql);
    return $listproduct;
}

function update_product($id, $categoryid, $productName, $productPrice, $productImage, $productDesc, $quatity)
{
    if ($productImage != "")
        $sql = "UPDATE products set categoryid = '" . $categoryid . "',productName = '" . $productName . "',productPrice = '" . $productPrice . "',productImage = '" . $productImage . "',productDesc = '" . $productDesc . "', quatity = '".$quatity."' where id = " . $id;
    else
        $sql = "UPDATE products set categoryid = '" . $categoryid . "',productName = '" . $productName . "',productPrice = '" . $productPrice . "',productDesc = '" . $productDesc . "', quatity = '".$quatity."' where id = " . $id;
    pdo_execute($sql);
}

?>