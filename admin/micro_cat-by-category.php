<?php 

print_r($_POST);
echo $sub_id;
include "config.php";


$sql = "SELECT * FROM `micro` WHERE `sub_id` = {$_POST['sub_id']}";

$result = mysqli_query($con, $sql) or die("query failed");

$data = "";

// $row[] = mysqli_fetch_assoc($result);


// echo "<pre>";
// print_r($row);
// echo "</pre>";



// die();

if(mysqli_num_rows($result) > 0){ 
    while($row = mysqli_fetch_assoc($result)){
        $data.="<option value='{$row['micro_id']}' class='text-capitalize'>{$row['micro_name']}</option>";
    }
    }
    else{
        $data.="<option readonly selected>No record found</option>";
    }
    echo $data;
    
    // die();

// die();

?>