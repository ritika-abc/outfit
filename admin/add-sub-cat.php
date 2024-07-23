<?php
//  isert and check the details

include "config.php";

if (isset($_POST['submit'])) {
    $sub_cat_name = $_POST['sub_cat_name'];
    $cat_id = $_POST['cat_id'];

    $sub_cat_image = $_FILES["sub_cat_image"]["name"];
    $fld1 = "extra_image/" . $sub_cat_image;
    // $fld2 = "upload/" . $image;
    move_uploaded_file($_FILES["sub_cat_image"]['tmp_name'], $fld1);
    $sql = "SELECT  * from  `sub_cat`  WHERE 
     `sub_cat_name`='$sub_cat_name' and `cat_id`='$cat_id'";

    $emailresult = mysqli_query($con, $sql);

    $user_matched = mysqli_num_rows($emailresult);
    if ($user_matched > 0) {
        echo "<script> alert('Already Exists')</script>";
    } else {
        $insrt = mysqli_query($con, "INSERT INTO 
        `sub_cat`(`sub_cat_name`,`sub_cat_image`,`cat_id`) VALUES ('$sub_cat_name','$fld1','$cat_id')");
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
                        <div class="col-4 "><label for="">Sub Category Name</label></div>
                        <div class="col-8 ">
                            <input type="text" name="sub_cat_name" class="form-control  " placeholder="Add Sub Category... ">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-4 "><label for="">Sub Category Image</label></div>
                        <div class="col-8 ">
                            <input type="file" name="sub_cat_image" class="form-control  " >
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
                                    // $cat_id = $row['cat_id'];
                                ?>
                                    <option value="<?php echo $row['cat_id'] ?>" class="text-capitalize"> <?php echo $row['cat_name']  ?> </option>
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
                <h4>View Sub Category</h4>
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
                        $sel = "SELECT * FROM `sub_cat` ORDER BY sub_id  DESC";
                        $qu = mysqli_query($con, $sel);
                        $sno = 1;
                        while ($row = mysqli_fetch_array($qu)) {
                        ?>
                            <tr>
                                <td><?php echo  $sno ?></td>
                                <td><img src="<?php echo  $row['sub_cat_image'] ?>" height="50px" width="100px" alt="category image"></td>
                                <td><?php echo  $row['sub_cat_name'] ?></td>
                                <td><a href="update-sub-cat.php?sub_id=<?php echo $row['sub_id'] ?>" class="btn btn-success">Edit</a><a href="" class="btn btn-danger">Delete</a></td>
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