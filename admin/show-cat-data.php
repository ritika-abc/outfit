<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>

<body>
    <table class="table table-hover w-75 m-auto text-capitalize">

        <tr>
            <td>cat name</td>
            <td>sub cat name</td>
            <td>inner cat name</td>
            <td>micro cat name</td>
            <td>product name</td>
        </tr>
        <?php
        // $con = mysqli_connect("localhost", "root", "", "cat");
        include "config.php";
        $select = "SELECT 
            c.cat_name, 
            s.sub_cat_name, 
            i.inner_cat_name, 
            m.micro_name ,
             p.product_name
        FROM 
            category c
        JOIN 
            sub_cat s  ON c.cat_id = s.cat_id
        JOIN 
            inner_cat i ON s.sub_id = i.sub_id
        JOIN 
            micro  m  ON i.inner_cat_id = m.inner_cat_id
        JOIN 
            product p  ON m.micro_id = p.micro_id ";

        $qu = mysqli_query($con, $select);
        $s_no = 1;
        while ($row = mysqli_fetch_array($qu)) {

        ?>
            <tr>

                <td><?php echo $row['cat_name'] ?></td>
                <td><?php echo $row['sub_cat_name'] ?></td>
                <td><?php echo $row['inner_cat_name'] ?></td>
                <td><?php echo $row['micro_name'] ?></td>
                <td><?php echo $row['product_name'] ?></td>
            </tr>
        <?php $s_no++;
        } ?>
    </table>

    <div class="container">
        <div class="row">
            <?php
            // $con = mysqli_connect("localhost", "root", "", "cat");
            include "config.php";
            $select = "SELECT 
            c.cat_name, 
            s.sub_cat_name, 
            i.inner_cat_name, 
            m.micro_name ,
             p.product_name
        FROM 
            category c
        JOIN 
            sub_cat s  ON c.cat_id = s.cat_id
        JOIN 
            inner_cat i ON s.sub_id = i.sub_id
        JOIN 
            micro  m  ON i.inner_cat_id = m.inner_cat_id
        JOIN 
            product p  ON m.micro_id = p.micro_id ";

            $qu = mysqli_query($con, $select);
            $s_no = 1;
            while ($row = mysqli_fetch_array($qu)) {

            ?>
                <div class="col-4">
                    <h1>cat</h1>
                    <p></p>
                </div>
            <?php $s_no++;
            } ?>
        </div>
    </div>
</body>

</html>