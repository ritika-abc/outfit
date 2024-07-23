 <?php


    include_once "include/header.php";
    include "config.php";

    ?>
 <!-- insert query -->
 <?php
    // $sel = "SELECT * FROM `category`";
    // $query = mysqli_query($con, $sel);
    // while ($row = mysqli_fetch_array($query)) {
    //     $cat_name = $row['cat_name'];
    // }
    ?>
 <?php
    // if (isset($_POST['submit'])) {
    //     $product_name = $_POST['product_name'];

    //     $cat_id = $_POST['cat_id'];

    //     //  $cat_name = $_POST['cat_name'];
 

    //     $product_description = $_POST['product_description'];
    //     $price = $_POST['price'];

    //     $product_image1 = $_FILES["product_image1"]["name"];
    //     $fld1 = "extra_image/" . $product_image1;
        
    //     move_uploaded_file($_FILES["product_image1"]['tmp_name'], $fld1);



    //     $insert = "INSERT INTO `product`(`product_name`,`price`,`product_description`, `cat_id`,`product_image1`,`cat_name`) VALUES ('$product_name','$price','$product_description','$cat_id','$fld1' , '$cat_name ')";

    //     $query = mysqli_query($con, $insert);
    // }
    ?>








 <style>
     input[type='file'] {
         opacity: 0
     }
 </style>
 <div class="right_col" role="main">
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-10 bg-white p-4">
                 <form action="upload.php" method="post" enctype="multipart/form-data" class="text-capitalize">
                     <h5>Add products</h5>
                     <div class="row">
                         <div class="col-12 col-lg-6 my-2">
                             <label for="" class=" ">product name</label>
                             <input type="text" name="product_name" class="form-control">
                         </div>
                         <div class="col-12 col-lg-6 my-2">
                             <label for=""> Product image (Min 1 Product image)</label>
                             <div class="row">
                                 <div class="col-4">
                                     <div class="border">
                                         <input class="form-control" name="images[]" multiple type="file" id="formFile">
                                     </div>
                                 </div>
                                 <!-- <div class="col-4">
                                    <div class="border">
                                        <input class="form-control" name="product_image1" type="file" id="formFile">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border">
                                        <input class="form-control" name="product_image1" type="file" id="formFile">
                                    </div>
                                </div> -->
                             </div>
                         </div>
                         <div class="col-12 col-lg-6 my-2 text-capitalize">
                             <label for=""> add Category</label>
                             <select name="cat_id" class="form-control" id="category-dropdown">
                                 <option value="">------ Select Category -----</option>
                                 <?php
                                    $sel = "SELECT * FROM `category`";
                                    $query = mysqli_query($con, $sel);
                                    while ($row = mysqli_fetch_array($query)) {
                                        $cat_name = $row['cat_name'];
                                    ?>
                                     <option value="<?php echo $row['cat_id'] ?>" class="text-capitalize"> <?php echo $row['cat_name']  ?> </option>
                                 <?php } ?>
                             </select>
                         </div>


                         <div class="col-12">
                             <hr>
                         </div>
                         <h5 class="mt-3">Product Details</h5>
                         <div class="col-12 my-2">
                             <label for="">Product Description</label>
                             <textarea name="product_description" rows="5" class="form-control" id="">

                            </textarea>
                         </div>
                         <div class="col-12 col-md-2 my-2">
                             <label for="">Product Price </label>
                             <input class="form-control   " name="price" type="text" id="formFile">
                         </div>
                         <div class="col-12 col-md-2 my-2">
                             <label for="">Product moq</label>
                             <input class="form-control   " name="moq" type="text" id="formFile">
                         </div>
                         <div class="col-12 col-md-3 my-2">
                             <label for="">Product Feature</label>
                             <input class="form-control   " name="feature" type="text" id="formFile">
                         </div>
                         <div class="col-12 col-md-3 my-2">
                             <label for=""> packaging type</label>
                             <input class="form-control   " name="packaging_type" type="text" id="formFile">
                         </div>
                         <div class="col-12 col-md-2 my-2">
                             <label for="">Product life</label>
                             <input class="form-control   " name="product_life" type="text" id="formFile">
                         </div>
                     </div>

                     <input type="submit" name="submit" class="btn btn-danger  w-25">
                     <input type="reset" name="submit" class="btn btn-warning   ">
                 </form>
             </div>
         </div>
     </div>
 </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <!-- /page content -->
 <?php
    include_once "include/footer.php";
    ?>

 <!-- <div class="container">
    <div class="row">
        <div class="col-12 col-lg-3">
            <img src="" height="auto" width="100%" alt="">
            <h3>abc</h3>
        </div>
        <div class="col-12 col-lg-3">
            <img src="" height="auto" width="100%" alt="">
            <h3>abc</h3>
        </div>
        <div class="col-12 col-lg-3">
            <img src="" height="auto" width="100%" alt="">
            <h3>abc</h3>
        </div>
    </div>
</div> -->