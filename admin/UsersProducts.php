<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');
$sql = "SELECT 
    products.id AS id, 
    products.user_id AS user_id, 
    categories.name AS ct_name,
    products.name AS name,
    products.price AS price, 
    products.photo AS photo, 
    products.count AS count, 
    products.premium AS premium 
FROM products 
LEFT JOIN categories ON products.category_id = categories.id 
WHERE products.user_id != '{$_SESSION['user_id']}'";

$statement1 = $con->query($sql);
$products = $statement1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM categories";
$statement = $con->query($sql2);
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<div class="container-fluid">
    <div class="row m-3">
        <h1>User's Products</h1>
    </div>
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">Id</th>
                <th scope="col" style="width: 150px;">Category Name</th>
                <th scope="col" style="width: 150px;">Name</th>
                <th scope="col" style="width: 150px;">Price</th>
                <th scope="col" style="width: 80px;">Count</th>
                <th scope="col" style="width: 80px;">Premium</th>
                <th scope="col" style="width: 150px;">Photo</th>
                <th scope="col" style="width: 150px;">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($products as $product) { ?>
                <tr>
                    <th scope="row"><?= $product['id'] ?></th>
                    <td><?= $product['ct_name'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['count'] ?></td>
                    <td>
                        <?php
                        if ($product['premium'] == 1) {
                            echo "True";
                        } else {
                            echo 'False';
                        }
                        ?>
                    </td>
                    <td><img src="<?= $product['photo'] ?>" width="150px" alt=""></td>
                    <td>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="<?php echo '#UpdateModal' . $product['id'] ?>">
                            Update
                        </a>
                        <div class="modal fade" id="<?php echo 'UpdateModal' . $product['id'] ?>" tabindex="-1" aria-labelledby="UpdateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="UpdateUsersProducts.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="UpdateModalLabel">Update Product</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="mb-3">
                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                <input type="hidden" name="user_id" value="<?= $product['user_id'] ?>">
                                            </div>
                                            <div>
                                                <?php if ($product['premium'] == 1) { ?>
                                                    <label for="premium" class="form-label">Premium</label>
                                                    <input type="radio" name="premium" id="premium" value="1" checked><br>
                                                    <label for="notpremium" class="form-label">Not Premium</label>
                                                    <input type="radio" name="premium" id="notpremium" value="0">
                                                <?php } else { ?>
                                                    <label for="premium" class="form-label">Premium</label>
                                                    <input type="radio" name="premium" id="premium" value="1"><br>
                                                    <label for="notpremium" class="form-label">Not Premium</label>
                                                    <input type="radio" name="premium" id="notpremium" value="0" checked>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="ok" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="<?php echo '#DeleteModal' . $product['id'] ?>">
                            Delete
                        </a>
                        <div class="modal fade" id="<?php echo 'DeleteModal' . $product['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="ProductsDelete.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">product qo'shish</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                            <h1><?php echo $product['name'] . "ni o'chirishni hohlaysizmi?" ?></h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="ok" class="btn btn-primary">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>

</div>

<?php
include 'footer.php';
?>