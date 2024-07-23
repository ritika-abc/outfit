<?php
include "config.php";

if (isset($_GET['micro_id'])) {
    $micro_cat_id = $_GET['micro_id'];

    // Fetch micro category details from database
    $query = "SELECT * FROM `micro` WHERE micro_id = $micro_cat_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Display edit form
    include_once "include/header.php";
    ?>

    <div class="right_col" role="main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-8 shadow-sm p-3 mb-5 ">
                    <form action=" " enctype="multipart/form-data" method="post">
                        <input type="hidden" name="micro_id" value="<?php echo $micro_cat_id; ?>">
                        <div class="row my-3">
                            <div class="col-4"><label for="">Micro Category Name</label></div>
                            <div class="col-8">
                                <input type="text" name="micro_name" class="form-control" placeholder="Edit Micro Category..." value="<?php echo $row['micro_name']; ?>">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4"><label for="">Micro Category Image</label></div>
                            <div class="col-8">
                                <input type="file" name="micro_cat_image" class="form-control">
                                <img src="<?php echo $row['micro_cat_image']; ?>" height="50px" width="100px" alt="micro category image">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4"><label for="">Category</label></div>
                            <div class="col-8">
                                <select name="cat_id" class="form-control">
                                    <option value="">------ Select Category -----</option>
                                    <?php
                                    $sel = "SELECT * FROM `category`";
                                    $query = mysqli_query($con, $sel);
                                    while ($cat_row = mysqli_fetch_array($query)) {
                                        $selected = ($cat_row['cat_id'] == $row['cat_id']) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $cat_row['cat_id'] ?>" <?php echo $selected; ?>><?php echo $cat_row['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4"><label for="">Sub Category</label></div>
                            <div class="col-8">
                                <select name="sub_id" class="form-control">
                                    <option value="">------ Select Sub Category -----</option>
                                    <?php
                                    $sel = "SELECT * FROM `sub_cat`";
                                    $query = mysqli_query($con, $sel);
                                    while ($sub_row = mysqli_fetch_array($query)) {
                                        $selected = ($sub_row['sub_id'] == $row['sub_id']) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $sub_row['sub_id'] ?>" <?php echo $selected; ?>><?php echo $sub_row['sub_cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-4"><label for="">Inner Category</label></div>
                            <div class="col-8">
                                <select name="inner_cat_id" class="form-control">
                                    <option value="">------ Select Inner Category -----</option>
                                    <?php
                                    $sel = "SELECT * FROM `inner_cat`";
                                    $query = mysqli_query($con, $sel);
                                    while ($inner_row = mysqli_fetch_array($query)) {
                                        $selected = ($inner_row['inner_cat_id'] == $row['inner_cat_id']) ? "selected" : "";
                                        ?>
                                        <option value="<?php echo $inner_row['inner_cat_id'] ?>" <?php echo $selected; ?>><?php echo $inner_row['inner_cat_name'] ?></option>
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
    // Redirect or show an error if micro_cat_id is not provided
    header("Location: add-micro-cat.php");
    exit();
}
?>
<?php
include "config.php";

if (isset($_POST['submit'])) {
    $micro_cat_id = $_POST['micro_id'];
    $micro_name = $_POST['micro_name'];
    $sub_id = $_POST['sub_id'];
    $cat_id = $_POST['cat_id'];
    $inner_cat_id = $_POST['inner_cat_id'];

    // Handle image update if a new image is uploaded
    if ($_FILES["micro_cat_image"]["name"]) {
        $micro_cat_image = $_FILES["micro_cat_image"]["name"];
        $fld1 = "extra_image/" . $micro_cat_image;
        move_uploaded_file($_FILES["micro_cat_image"]["tmp_name"], $fld1);
        // Update query with image
        $sql = "UPDATE `micro` SET `micro_name`='$micro_name', `micro_cat_image`='$fld1', `sub_id`='$sub_id', `cat_id`='$cat_id', `inner_cat_id`='$inner_cat_id' WHERE `micro_id`='$micro_cat_id'";
    } else {
        // Update query without image
        $sql = "UPDATE `micro` SET `micro_name`='$micro_name', `sub_id`='$sub_id', `cat_id`='$cat_id', `inner_cat_id`='$inner_cat_id' WHERE `micro_id`='$micro_cat_id'";
    }

    // Execute the update query
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: add-micro-cat.php"); // Redirect back to micro category listing page
        exit();
    } else {
        echo "Error updating micro category: " . mysqli_error($con);
    }
} else {
    // Redirect if form not submitted properly
    header("Location: add-micro-cat.php");
    exit();
}
?>
