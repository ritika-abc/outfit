<?php
//  isert and check the details

include "config.php";

if (isset($_POST['submit'])) {
    $cat_name = $_POST['cat_name'];

    $cat_image = $_FILES["cat_image"]["name"];
    $fld1 = "extra_image/" . $cat_image;
    // $fld2 = "upload/" . $image;
    move_uploaded_file($_FILES["cat_image"]['tmp_name'], $fld1);
    $sql = "SELECT  * from  `category`  WHERE 
     `cat_name`='$cat_name'";

    $emailresult = mysqli_query($con, $sql);

    $user_matched = mysqli_num_rows($emailresult);
    if ($user_matched > 0) {
        echo "<script> alert('Already Exists')</script>";
    } else {
        $insrt = mysqli_query($con, "INSERT INTO 
        `category`(`cat_name`,`cat_image`) VALUES ('$cat_name','$fld1')");
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
            <div class="col-7">
                <form action="" enctype="multipart/form-data" method="post">
                    <input type="text" name="cat_name" class="form-control my-3" placeholder="Add Category... ">
                    <input type="file" name="cat_image" class="form-control my-3" placeholder="Add Image... ">
                    <button class="btn btn-success mt-2 px-3" name="submit" type="submit">Submit</button>
                    <button class="btn btn-success mt-2 px-3" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>View Category</h4>
                <table class="table table-bordered text-capitalize">
                    <thead>
                        <tr>
                            <td>S no</td>
                            <td>Category Image</td>
                            <td>Category Name</td>
                            <td>Edit</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "config.php";
                        $sel = "SELECT * FROM `category` ORDER BY cat_id DESC";
                        $qu = mysqli_query($con, $sel);
                        $sno = 1;
                        while ($row = mysqli_fetch_array($qu)) {
                        ?>
                            <tr>
                                <td><?php echo  $sno ?></td>
                                <td><img src="<?php echo  $row['cat_image'] ?>" height="50px" width="100px" alt="category image"></td>
                                <td><?php echo  $row['cat_name'] ?></td>
                                <td><a href="update_category.php?cat_id=<?php echo $row['cat_id'] ?>" class="btn btn-success">aaEdit</a><a href="" class="btn btn-danger">Delete</a></td>
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