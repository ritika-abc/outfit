<?php
include "config.php";

if (isset($_POST['submit'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    
    // Handle image update if a new image is uploaded
    if ($_FILES["cat_image"]["name"]) {
        $cat_image = $_FILES["cat_image"]["name"];
        $fld1 = "extra_image/" . $cat_image;
        move_uploaded_file($_FILES["cat_image"]["tmp_name"], $fld1);
        // Update query with image
        $sql = "UPDATE `category` SET `cat_name`='$cat_name', `cat_image`='$fld1' WHERE `cat_id`='$cat_id'";
    } else {
        // Update query without image
        $sql = "UPDATE `category` SET `cat_name`='$cat_name' WHERE `cat_id`='$cat_id'";
         
         
    }
    
    // Execute the update query
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: add_category.php"); // Redirect back to category listing page
        exit();
    } else {
        echo "Error updating category: " . mysqli_error($con);
    }
} 
?>
<?php
include "config.php";

if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];

    // Fetch category details from database
    $query = "SELECT * FROM `category` WHERE cat_id = $cat_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Display edit form
    ?>
    <?php include_once "include/header.php"; ?>
    
    <div class="right_col" role="main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-7">
                    <form action="update_category.php" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                        <input type="text" name="cat_name" class="form-control my-3" placeholder="Edit Category..." value="<?php echo $row['cat_name']; ?>">
                        <input type="file" name="cat_image" class="form-control my-3" placeholder="Change Image... (Optional)">
                        <img src="<?php echo $row['cat_image']; ?>" height="50px" width="100px" alt="category image">
                        <button class="btn btn-success mt-2 px-3" name="submit" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "include/footer.php"; ?>

    <?php
} else {
    // Redirect or show an error if cat_id is not provided
    // header("Location: category.php");
    // exit();
}
?>
