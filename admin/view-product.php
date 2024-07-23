<?php


include_once "include/header.php";

?>
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row">
        <div class="col-12">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="my-5  d-flex">
                <input type="search" placeholder="Search Here By Product Name / Company Name" name="search_query" class="form-control w-75 rounded float-end">
                <input type="submit" name="search" class="btn-sm btn-success">
            </form>
        </div>
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the search query
            $search_query = $_POST["search_query"];

            // Connect to your database (replace these variables with your actual database credentials)
            include "config.php";

            // Create connection





        ?>

            <div class="col-12 my-4">
                <table class="table  table-striped table-success table text-capitalize">

                    <tbody class=" ">
                        <thead>
                            <th>S.No.</th>
                            <th>product image</th>
                            <th>Logo</th>
                            <th>product name</th>
                            <th>product price</th>
                            <th>product description</th>
                            <th>company name</th>
                            <th>moq</th>
                            <th>date</th>
                        </thead>
                        <?php

                        // SQL query to search for data in your database (replace 'table_name' with your actual table name and 'column_name' with the column you want to search)
                        $sql = "SELECT * FROM product WHERE product_name LIKE '%" . $search_query . "%'" . " or company_name LIKE '%" . $search_query . "%'";
                        $result = $con->query($sql);

                        // Display the results
                        if ($result->num_rows > 0) {
                            echo "<h3>Search Results:</h3>";
                            echo "<ul>";
                            while ($row = $result->fetch_assoc()) {
                                // echo "<li>" . $row["product_name"] . "</li>"; // Display the result here
                        ?>
                                <tr>

                                    <td class='id'><img src="" height="50px" width="50px" alt=""> <img src="" height="50px" width="50px" alt=""> <img src="" height="50px" width="50px" alt=""></td>
                                    <td class='id'><img src="" height="50px" width="50px" alt=""> </td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['product_description']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['moq']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                </tr>
                    <?php
                            }
                            echo "</ul>";
                        } else {
                            echo "No results found";
                        }

                        // Close the connection
                        $con->close();
                    }
                    ?>
                    </tbody>
                </table>
            </div>



            <div class="col-12">
                <div class="col-md-12">
                    <?php
                    include "config.php"; // database configuration
                    /* Calculate Offset Code */
                    $limit = 15;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    /* select query of user table with offset and limit */
                    $sql = "SELECT * FROM product ORDER BY pro_id DESC LIMIT {$offset},{$limit}";
                    $result = mysqli_query($con, $sql) or die("Query Failed.");
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="table  table-striped table-light table text-capitalize w-100">
                            <thead>
                                <th>S.No.</th>
                                <th>product image</th>
                                <th>Company Logo</th>
                                <th>product price</th>
                                <th>product description</th>
                                <th>company name</th>
                                <th>moq</th>
                                <th>date</th>
                                <th>edit</th>
                            </thead>
                            <tbody>
                                <?php
                                $serial = $offset + 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td>
                                            <div class="img_box" style="width: 150px;height:150px;">
                                                <img src="<?php echo $row['product_image1'] ?>" height="50px" width="50px" alt=""> <img src="<?php echo $row['product_image2'] ?>" height="50px" width="50px" alt=""> <img src="<?php echo $row['product_image3'] ?>" height="50px" width="50px" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="img_box" style="width: 150px;height:150px;">
                                                <img src="<?php echo $row['company_logo'] ?>" height="50px" width="50px" alt="">
                                            </div>
                                        </td>
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td>
                                            <div class="content_box  border" style="width: 150px;height:150px;overflow:scroll">
                                                <?php echo $row['product_description']; ?>
                                            </div>
                                        </td>
                                        <td><?php echo $row['company_name']; ?></td>
                                        <td><?php echo $row['moq']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><a href="update-product.php?pro_id=<?php echo $row['pro_id'] ?>">Edit</a></td>
                                    </tr>
                                <?php
                                    $serial++;
                                } ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<h3>No Results Found.</h3>";
                    }
                    // show pagination
                    $sql1 = "SELECT * FROM `product`";
                    $result1 = mysqli_query($con, $sql1) or die("Query Failed.");

                    if (mysqli_num_rows($result1) > 0) {

                        $total_records = mysqli_num_rows($result1);

                        $total_page = ceil($total_records / $limit);

                        echo '<ul class="pagination ">';
                        if ($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="view-product.php?page=' . ($page - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "activebtn";
                            } else {
                                $active = " ";
                            }
                            echo '<li class="page-item' . $active . '"><a class="page-link"  href="view-product.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($total_page > $page) {
                            echo '<li class="page-item"><a class="page-link" href="view-product.php?page=' . ($page + 1) . '">Next</a></li>';
                        }

                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
    </div>
</div>
<br />
</div>




<!-- /page content -->
<?php
include_once "include/footer.php";
?>