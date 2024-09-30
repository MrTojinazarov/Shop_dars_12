<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = [
            'quantity' => 1, 
        ];
    }
}

$sql = "SELECT * FROM products";
$statement = $con->query($sql);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<div class="" style="margin-top: 30px;">
    <div class="fullwidth-template">
        <div class="vereesa-product produc-featured rows-space-40">
            <div class="container">
                <h3 class="custommenu-title-blog">Popular</h3>
                <ul class="row list-products auto-clear equal-container product-grid">
                    <?php
                    foreach ($products as $product) {
                        if ($product['premium'] == 1 && $product['count'] > 0) {
                    ?>
                            <li class="product-item col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <img src="../admin/<?= $product['photo'] ?>" style="width:250px; height:200px;" alt="img">
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="#"><?= $product['name'] ?></a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating">
                                                    <span class="star-4"></span>
                                                </div>
                                                <div class="count-star">(4)</div>
                                            </div>
                                            <div class="price">
                                                <del><?= $product['price'] * 1.2 ?></del>
                                                <ins><?= $product['price'] ?> so'm</ins>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loop-form-add-to-cart">
                                        <form class="cart" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <div class="single_variation_wrap">
                                                <div class="quantity">
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                        <input type="text" data-step="1" data-min="1" name="quantity" value="1" title="Qty" class="input-qty qty" size="4" readonly>
                                                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                                    </div>
                                                </div>
                                                <button class="single_add_to_cart_button button">Add to cart</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                    <?php }
                    } ?>
                </ul>
                <h3 class="custommenu-title-blog">Affordable</h3>
                <ul class="row list-products auto-clear equal-container product-grid">
                    <?php
                    foreach ($products as $product) {
                        if ($product['premium'] == 0  && $product['count'] > 0) {
                    ?>
                            <li class="product-item col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                <div class="product-inner equal-element">
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <img src="../admin/<?= $product['photo'] ?>" style="width:250px; height:200px;" alt="img">
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="#"><?= $product['name'] ?></a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating">
                                                    <span class="star-4"></span>
                                                </div>
                                                <div class="count-star">(4)</div>
                                            </div>
                                            <div class="price">
                                                <del><?= $product['price'] * 1.2 ?></del>
                                                <ins><?= $product['price'] ?> so'm</ins>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loop-form-add-to-cart">
                                        <form class="cart" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <div class="single_variation_wrap">
                                                <div class="quantity">
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                        <input type="text" data-step="1" data-min="1" name="quantity" value="1" title="Qty" class="input-qty qty" size="4" readonly>
                                                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                                    </div>
                                                </div>
                                                <button class="single_add_to_cart_button button">Add to cart</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                    <?php }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
