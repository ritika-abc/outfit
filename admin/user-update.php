<?php

ob_start();
include_once "include/header.php";


?>

<?php
include "config.php";

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query)) {
    # to select all the data
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];

    $user_phone = $row['user_phone'];
    $company_name = $row['company_name'];
    $plan = $row['plan'];
    $expire = $row['expire'];
    $company_address = $row['company_address'];
    $state = $row['state'];
    $city = $row['city'];
    $gst = $row['gst'];
    $image = $row['image'];
    $start_date = $row['start_date'];
}

?>

<?php


if (isset($_POST['submit'])) {

    $user_id = $_GET['user_id'];


    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];

    $user_phone = $_POST['user_phone'];
    $company_name = $_POST['company_name'];
    $plan = $_POST['plan'];
    $expire = $_POST['expire'];
    $company_address = $_POST['company_address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $gst = $_POST['gst'];
    $image = $_POST['image'];
    $start_date = $_POST['start_date'];

    // image
    //  $_FILES is a super global variable which can be used to upload files
    $image = $_FILES["image"]["name"];
    $fld1 = "logo/" . $image;
    // $fld2 = "upload/" . $image;
    move_uploaded_file($_FILES["image"]['tmp_name'], $fld1);

    if ($image == "") {
        $sql1 = "UPDATE `user` SET 
        `user_name`='$user_name',
        `user_phone`='$user_phone',
        `company_name`='$company_name',
        `plan`='$plan',
        `expire`='$expire',
        `company_address`='$company_address',
        `state`='$state',
        `city`='$city',
        `gst`='$gst',
        `state`='$state',
        `start_date`='$start_date',
        `user_email`='$user_email' 
        WHERE `user_id`='$user_id'";




        $query1 = mysqli_query($con, $sql1) or die("not working");
        // The die() function prints a message and exits the current script
        if ($query1) {
            header("location:view-user.php");
        }
    } else {
        $sql1 = "UPDATE `user` SET 
        `user_name`='$user_name',
        `user_phone`='$user_phone',
        `company_name`='$company_name',
        `plan`='$plan',
        `expire`='$expire',
        `company_address`='$company_address',
        `state`='$state',
        `city`='$city',
        `gst`='$gst',
        `state`='$state',
        `start_date`='$start_date',
        `image`='$fld1',
        `user_email`='$user_email' 
        WHERE `user_id`='$user_id'";
        $query1 = mysqli_query($con, $sql1) or die("dgdgdfgdfg");
        // The die() function prints a message and exits the current script
        if ($query1) {
            header("location:view-user.php");
        }
    }
}
?>
<!-- page content -->
<div class="right_col  text-capitalize bg-white" role="main">
    <!-- top tiles -->
    <h3 class="my-3">please update user / supplier information</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">name name</label>
                <input type="text" name="user_name" value="<?php echo $user_name ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">user email</label>
                <input type="text" name="user_email" value="<?php echo $user_email ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">user phone number</label>
                <input type="text" name="user_phone" value="<?php echo $user_phone ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">company name</label>
                <input type="text" name="company_name" value="<?php echo $company_name ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">plan</label>
                <select name="plan" class="form-control text-capitalize" id="">
                    <option value="not-active" <?php if($plan == 'not-active') echo "selected"; ?>>not active</option>
                    <option value="prime" <?php if($plan == 'prime') echo "selected"; ?>>Prime</option>
                    <option value="prime-pro" <?php if($plan == 'prime-pro') echo "selected"; ?>>prime-pro</option>
                    <option value="ultra" <?php if($plan == 'ultra') echo "selected"; ?>>ultra</option>
                    <option value="ultra-pro" <?php if($plan == 'ultra-pro') echo "selected"; ?>>ultra-pro</option>
                </select>
            </div>
            <div class="col-12 col-md-2 my-3 text-capitalize">
                <label for="">Plan start  Date</label>
                <input type="date" name="start_date" value="<?php echo $start_date ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-2 my-3 text-capitalize">
                <label for="">Plan Expire Date</label>
                <input type="date" name="expire" value="<?php echo $expire ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">company address</label>
                <input type="text" name="company_address" value="<?php echo $company_address ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">state</label>
                <input type="text" name="state" value="<?php echo $state ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">city</label>
                <input type="text" name="city" value="<?php echo $city ?>" class="form-control mt-1">
            </div>
            <div class="col-12 col-md-4 my-3 text-capitalize">
                <label for="">gst</label>
                <input type="text" name="gst" value="<?php echo $gst ?>" class="form-control mt-1">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <img src="<?php echo $image ?>" height="auto" width="100%" class="my-2" alt=""> <br>
            </div>
            <div class="col-6">
                <label for="">logo image</label> <br>
                <input type="file" value="<?php echo $image ?>" class="form-control" name="image">

            </div>
        </div>
        <input type="submit" class="btn btn-success mt-4" name="submit">
    </form>
</div>
<br />
</div>




<!-- /page content -->
<?php
include_once "include/footer.php";
ob_end_flush();
?>