<?php
include "config.php";

if (isset($_POST['submit'])) {
    $inner_cat_id = $_POST['inner_cat_id'];
    $inner_cat_name = $_POST['inner_cat_name'];
    $sub_id = $_POST['sub_id'];

    // Handle image update if a new image is uploaded
    if ($_FILES["inner_cat_image"]["name"]) {
        $inner_cat_image = $_FILES["inner_cat_image"]["name"];
        $fld1 = "extra_image/" . $inner_cat_image;
        move_uploaded_file($_FILES["inner_cat_image"]["tmp_name"], $fld1);
        // Update query with image
        $sql = "UPDATE `inner_cat` SET `inner_cat_name`='$inner_cat_name', `inner_cat_image`='$fld1', `sub_id`='$sub_id' WHERE `inner_cat_id`='$inner_cat_id'";
    } else {
        // Update query without image
        $sql = "UPDATE `inner_cat` SET `inner_cat_name`='$inner_cat_name', `sub_id`='$sub_id' WHERE `inner_cat_id`='$inner_cat_id'";
    }

    // Execute the update query
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: add-inner-cat.php"); // Redirect back to inner category listing page
        exit();
    } else {
        echo "Error updating inner category: " . mysqli_error($con);
    }
} 
// else {
//     // Redirect if form not submitted properly
//     header("Location: inner_category.php");
//     exit();
// }
?>
<?php
include "config.php";

if (isset($_GET['inner_cat_id'])) {
    $inner_cat_id = $_GET['inner_cat_id'];

    // Fetch inner category details from database
    $query = "SELECT * FROM `inner_cat` WHERE inner_cat_id = $inner_cat_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Display edit form
    include_once "include/header.php";
    ?>

    <div class="right_col" role="main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-8 shadow-sm p-3 mb-5 ">
                    <form action="" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="inner_cat_id" value="<?php echo $inner_cat_id; ?>">
                        <div class="row my-3">
                            <div class="col-4"><label for="">Inner Category Name</label></div>
                            <div class="col-8">
                                <input type="text" name="inner_cat_name" class="form-control" placeholder="Edit Sub Category..." value="<?php echo $row['inner_cat_name']; ?>">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4"><label for="">Inner Category Image</label></div>
                            <div class="col-8">
                                <input type="file" name="inner_cat_image" class="form-control">
                                <img src="<?php echo $row['inner_cat_image']; ?>" height="50px" width="100px" alt="category image">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4"><label for="">Sub Category </label></div>
                            <div class="col-8">
                                <select name="sub_id" class="form-control">
                                    <option value="">------ Select Category -----</option>
                                    <?php
                                    $sel = "SELECT * FROM `sub_cat`";
                                    $query = mysqli_query($con, $sel);
                                    while ($sub_row = mysqli_fetch_array($query)) {
                                        $selected = ($sub_row['sub_id'] == $row['sub_id']) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $sub_row['sub_id'] ?>" class="text-capitalize" <?php echo $selected; ?>><?php echo $sub_row['sub_cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-success mt-2 px-3" name="submit" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once "include/footer.php";
} else {
    // Redirect or show an error if inner_cat_id is not provided
    header("Location: inner_category.php");
    exit();
}
?>
