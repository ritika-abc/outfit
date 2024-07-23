<?php 

// print_r($_POST);
// echo $category_id;
include "config.php";


$sql = "SELECT * FROM `sub_cat` WHERE cat_id = {$_POST['cat_id']}";

$result = mysqli_query($con, $sql) or die("query failed");

$data = "";

// $row[] = mysqli_fetch_assoc($result);


// echo "<pre>";
// print_r($row);
// echo "</pre>";



// die();

if(mysqli_num_rows($result) > 0){ 
    while($row = mysqli_fetch_assoc($result)){
        $data.="<option value='{$row['sub_id']}' class='text-capitalize'>{$row['sub_cat_name']}</option>";
    }
    }
    else{
        $data.="<option readonly selected>No record found</option>";
    }
    echo $data;
    
    // die();

// die();

?>