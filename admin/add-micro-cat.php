<?php
//  isert and check the details

include "config.php";

if (isset($_POST['submit'])) {
    $micro_name = $_POST['micro_name'];
    $sub_id = $_POST['sub_id'];
    $cat_id = $_POST['cat_id'];
    $inner_cat_id = $_POST['inner_cat_id'];

    $micro_cat_image = $_FILES["micro_cat_image"]["name"];
    $fld1 = "extra_image/" . $micro_cat_image;
    // $fld2 = "upload/" . $image;
    move_uploaded_file($_FILES["micro_cat_image"]['tmp_name'], $fld1);
    $sql = "SELECT  * from  `micro`  WHERE 
     `micro_name`='$micro_name' and `sub_id`='$sub_id'";

    $emailresult = mysqli_query($con, $sql);

    $user_matched = mysqli_num_rows($emailresult);
    if ($user_matched > 0) {
        echo "<script> alert('Already Exists')</script>";
    } else {
        $insrt = mysqli_query($con, "INSERT INTO 
        `micro`(`micro_name`,`micro_cat_image`,`sub_id`,`cat_id`,`inner_cat_id`) VALUES ('$micro_name','$fld1','$sub_id','$cat_id','$inner_cat_id')");
    }
}




?>
<?php


include_once "include/header.php";

?>


<!-- new data -->
<div class="right_col" role="main">
    <div class="container mt-5">
        <div class="row  justify-content-center">
            <div class="col-8 shadow-sm p-3 mb-5 ">
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="row my-3">
                        <div class="col-4 "><label for="">Micro Category Name</label></div>
                        <div class="col-8 ">
                            <input type="text" name="micro_name" class="form-control  " placeholder="Add Micro Category... ">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-4 "><label for="">Micro Category Image</label></div>
                        <div class="col-8 ">
                            <input type="file" name="micro_cat_image" class="form-control  " >
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-4 "><label for=""> Category </label></div>
                        <div class="col-8 ">
                            <select name="cat_id" class="form-control" id="">
                                <option value="">------ Select Category -----</option>
                                <?php
                                $sel = "SELECT * FROM `category`";
                                $query = mysqli_query($con, $sel);
                                while ($row = mysqli_fetch_array($query)) {
                                    // $sub_id = $row['sub_id'];
                                ?>
                                    <option value="<?php echo $row['cat_id'] ?>" class="text-capitalize"> <?php echo $row['cat_name']  ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-4 "><label for="">Add Sub Category </label></div>
                        <div class="col-8 ">
                            <select name="sub_id" class="form-control" id="">
                                <option value="">------ Select Sub Category -----</option>
                                <?php
                                $sel = "SELECT * FROM `sub_cat`";
                                $query = mysqli_query($con, $sel);
                                while ($row = mysqli_fetch_array($query)) {
                                    // $sub_id = $row['sub_id'];
                                ?>
                                    <option value="<?php echo $row['sub_id'] ?>" class="text-capitalize"> <?php echo $row['sub_cat_name']  ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="row my-3">
                        <div class="col-4 "><label for="">Inner Category </label></div>
                        <div class="col-8 ">
                            <select name="inner_cat_id" class="form-control" id="">
                                <option value="">------ Select  Inner Cetegory -----</option>
                                <?php
                                $sel = "SELECT * FROM `inner_cat`";
                                $query = mysqli_query($con, $sel);
                                while ($row = mysqli_fetch_array($query)) {
                                    // $sub_id = $row['sub_id'];
                                ?>
                                    <option value="<?php echo $row['inner_cat_id'] ?>" class="text-capitalize"> <?php echo $row['inner_cat_name']  ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>





                    <button class="btn btn-success mt-2 px-3" name="submit" type="submit">Submit</button>
                    <button class="btn btn-success mt-2 px-3" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>View Micro Category</h4>
                <table class="table table-bordered text-capitalize">
                    <thead>
                        <tr>
                            <td>S no</td>
                            <td>Sub Category image</td>                         
                            <td>Sub Category</td>                         
                            <td>Edit</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "config.php";
                        $sel = "SELECT * FROM `micro` ORDER BY micro_id  DESC";
                        $qu = mysqli_query($con, $sel);
                        $sno = 1;
                        while ($row = mysqli_fetch_array($qu)) {
                        ?>
                            <tr>
                                <td><?php echo  $sno ?></td>
                                <td><img src="<?php echo  $row['micro_cat_image'] ?>" height="50px" width="100px" alt="category image"></td>
                                <td><?php echo  $row['micro_name'] ?></td>
                                <td><a href="edit_micro_cat.php?micro_id=<?php echo $row['micro_id'] ?>" class="btn btn-success">Edit</a><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php
                            $sno++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- /page content -->
<?php
include_once "include/footer.php";
?>