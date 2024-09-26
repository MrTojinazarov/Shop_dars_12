<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');
$sql = "SELECT * FROM categories";
$statment = $con->query($sql);
$categories = $statment->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include 'header.php'; ?>

<div class="container-fluid">
    <h2>Add New Product</h2>
    <div class="row mt-3 mb-3 ms-1">
        <div class="col-2">
        <a href="ProductsTable.php" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <form action="addproduct.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']?>">
        
        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price">
        </div>

        <!-- Categories -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Choose category</label>
            <select class="form-select" id="category_id" name="category_id">
                <?php
                foreach ($categories as $category) { ?>
                    <option value="<?= $category['id']?>"><?= $category['name']?></option>
                <?php }
                ?>
            </select>
        </div>

        <!-- Product Image -->
        <div class="mb-3">
            <label for="photo" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>

        <!-- Product Count -->
        <div class="mb-3">
            <label for="count" class="form-label">Product Count</label>
            <input type="number" class="form-control" id="count" name="count" placeholder="Enter product count">
        </div>

        <div class="mb-3">
            <label for="premium" class="form-label">Premium</label>
            <input type="radio" name="premium" id="premium" value="1"><br>
            <label for="notpremium" class="form-label">Not Premium</label>
            <input type="radio" name="premium" id="notpremium" value="0">
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<?php include 'footer.php'; ?>