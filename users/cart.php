<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Mahsulotni savatchadan o'chirish
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    unset($_SESSION['cart'][$productId]);
}

// Mahsulot miqdorini yangilash
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);

    // Mahsulotni bazadan qidirish
    $stmt = $con->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $availableQuantity = $product['count']; // Mahsulotning mavjud miqdori

        // Kiritilgan miqdorni tekshirish
        if ($quantity > 0 && $quantity <= $availableQuantity) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity; // Miqdorni yangilash
        } else {
            echo "<script>alert('Mavjud bo\'lgan mahsulot miqdori etarli emas yoki 0 dan kam bo\'lishi mumkin emas!');</script>";
        }
    }
}

// Sotib olish tugmasi bosilganda mahsulotni sotilganlar sonidan ayirish
if (isset($_POST['buy'])) {
    foreach ($_SESSION['cart'] as $productId => $item) {
        $quantitySold = $item['quantity'];

        // Mahsulotni bazadan yangilash
        $stmt = $con->prepare("UPDATE products SET count = count - :quantity WHERE id = :id");
        $stmt->execute(['quantity' => $quantitySold, 'id' => $productId]);
    }
    // Savatchani tozalash
    $_SESSION['cart'] = [];
    echo "<script>alert('Sotib olish muvaffaqiyatli!');</script>";
}

$cartItems = $_SESSION['cart'];
$totalPrice = 0;

include 'header.php';
?>

<div class="container mt-5 mb-5">
    <h2>Your Shopping Cart</h2>
    <table class="table table-bordered" style="font-size: 17pt;">
        <thead>
            <tr>
                <th style="width:300px;">Product</th>
                <th style="width:200px;">Price</th>
                <th style="width:200px;">Quantity</th>
                <th style="width:200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($cartItems)): ?>
                <tr>
                    <td colspan="4" class="text-center">Your cart is empty.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($cartItems as $productId => $item): ?>
                    <?php
                    // Mahsulotni bazadan qidirish
                    $stmt = $con->prepare("SELECT * FROM products WHERE id = :id");
                    $stmt->execute(['id' => $productId]);
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Jami narxni hisoblash
                    $totalPrice += $product['price'] * $item['quantity'];
                    ?>
                    <tr>
                        <td>
                            <img src="../admin/<?= $product['photo'] ?>" alt="<?= $product['name'] ?>" style="width:100px; height:100px;">
                            <?= $product['name'] ?>
                        </td>
                        <td><?= $product['price'] ?> so'm</td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="product_id" value="<?= $productId ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $product['count'] ?>" required>
                                <button type="submit" style="font-size: 14pt; margin-top: -5px;" class="btn btn-primary">ok</button>
                            </form>
                        </td>
                        <td>
                            <a href="?remove=<?= $productId ?>" style=" font-size: 13pt" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="total-price">
        <h4>Total: <?= $totalPrice ?> so'm</h4>
    </div>

    <div class="row">
        <div class="col-2 offset-5" >
            <?php if (!empty($cartItems)): ?>
                <form method="POST" action="">
                    <button type="submit" style="width: 150px; height: 50px; border-radius:5px; font-size: 20pt; padding: 5px;" name="buy" class="btn btn-outline-primary">Buy</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>