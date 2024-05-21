<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])){

    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description']; // Corrected variable name
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];

    // Accessing image temp names
    $temp_image1 = $_FILES['product_image1']['tmp_name']; // Corrected variable name
    $temp_image2 = $_FILES['product_image2']['tmp_name']; // Corrected variable name

    // Checking empty condition
    if(empty($product_title) || empty($product_description) || empty($product_keywords) || empty($product_categories) || empty($product_brands) || empty($product_price) || empty($product_image1) || empty($product_image2)){
        echo "<script> alert('Please fill all the fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");

        // Insert query
        $insert_products = "INSERT INTO `products` (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_price', NOW(), '$product_status')";
        $result_query = mysqli_query($con, $insert_products);
        if($result_query) {
            echo "<script> alert('Successfully inserted the products')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert products</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- Description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-description" class="form-label">Product Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- Keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product Keywords" autocomplete="off" required="required">
            </div>
            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="form-select">
                    <option value="">Select a category</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
               <select name="product_brands" id="" class="form-select">
                <option value="">select a brand</option>
                <?php
                $select_query="select * from `brands`";
                $insert_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($insert_query)){
                    $brand_title=$row['brand_title'];
                    $brand_id=$row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
                
               </select> 
            </div>

            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="product_image1" class="form-lable">Product image 1</lable>
                <input type="file" name="product_image1" id="product_image 1" class="form-control" required="required">
            </div>

            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
            <lable for="product_image2" class="form-lable">Product image 2</lable>
            <input type="file" name="product_image2" id="product_image 2" class="form-control" required="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <lable for="product-price" class="form-lable">Product price</lable>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <!-- Insert product button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert products">
            </div>
        </form>
    </div>
</body>
</html>