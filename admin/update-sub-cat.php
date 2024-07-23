<?php
   include "config.php";

    $sub_id = $_GET['sub_id'];

    $sql = "SELECT* FROM `sub_cat` WHERE `sub_id`='$sub_id'";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        # to select all the data
        $sub_cat_name = $row['sub_cat_name'];
      
        $sub_cat_image = $row['sub_cat_image'];
    }

    ?>
  <?php

//  update
 
if (isset($_POST['submit'])) {

    $sub_id = $_GET['sub_id'];

    $sub_cat_name = $_POST['sub_cat_name'];
    

// image
//  $_FILES is a super global variable which can be used to upload files
$sub_cat_image = $_FILES["sub_cat_image"]["name"];
$fld1 = "extra_image/" . $sub_cat_image;
// $fld2 = "upload/" . $image;
move_uploaded_file($_FILES["sub_cat_image"]['tmp_name'], $fld1);

 if($sub_cat_image == ""){
    $sql1 = "UPDATE `sub_cat` SET `sub_cat_name`='$sub_cat_name'  WHERE `sub_id`='$sub_id'";
        $query1 = mysqli_query($con, $sql1) or die( "dgdgdfgdfg");
        // The die() function prints a message and exits the current script
        if ($query) {
            header("location:add-sub-cat.php");
        }
 }else{
    $sql1 = "UPDATE `sub_cat` SET `sub_cat_name`='$sub_cat_name',`sub_cat_image`='$fld1' WHERE `sub_id`='$sub_id'";
        $query1 = mysqli_query($con, $sql1) or die( "dgdgdfgdfg");
        // The die() function prints a message and exits the current script
        if ($query) {
            header("location:add-sub-cat.php");
        }
 }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
         Sub cat name : <input type="text" value="<?php echo $sub_cat_name ?>" name="sub_cat_name"> <br>
    
         image : <input type="file" value="<?php echo $sub_cat_image ?>" name="sub_cat_image"> <br>
         <input type="submit" name="submit">

     </form>
</body>
</html>