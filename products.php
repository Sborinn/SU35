<?php 
$page_title = "Products";
include 'includes/header.php'; 

// Static product data with unique IDs
$products = [
    [
        'id' => 'monstera-deliciosa',
        'name' => 'Monstera Deliciosa',
        'image' => 'https://images.pexels.com/photos/4751978/pexels-photo-4751978.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Large, glossy leaves with natural splits. Perfect for adding tropical vibes to any room.',
        'price' => 45.99
    ],
    [
        'id' => 'snake-plant',
        'name' => 'Snake Plant',
        'image' => 'https://images.pexels.com/photos/6208086/pexels-photo-6208086.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Hardy and low-maintenance plant that purifies air. Ideal for beginners and busy lifestyles.',
        'price' => 29.99
    ],
    [
        'id' => 'fiddle-leaf-fig',
        'name' => 'Fiddle Leaf Fig',
        'image' => 'https://images.pexels.com/photos/4503273/pexels-photo-4503273.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Stunning statement plant with large, violin-shaped leaves. A modern home favorite.',
        'price' => 79.99
    ],
    [
        'id' => 'peace-lily',
        'name' => 'Peace Lily',
        'image' => 'https://images.pexels.com/photos/4425875/pexels-photo-4425875.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Elegant white flowers and dark green foliage. Excellent air purifier for indoor spaces.',
        'price' => 34.99
    ],
    [
        'id' => 'rubber-plant',
        'name' => 'Rubber Plant',
        'image' => 'https://images.pexels.com/photos/7728020/pexels-photo-7728020.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Glossy, thick leaves that add sophistication to any space. Easy to care for and fast-growing.',
        'price' => 39.99
    ],
    [
        'id' => 'zz-plant',
        'name' => 'ZZ Plant',
        'image' => 'https://images.pexels.com/photos/4751965/pexels-photo-4751965.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Drought-tolerant with waxy, dark green leaves. Perfect for low-light conditions.',
        'price' => 32.99
    ],
    [
        'id' => 'boston-fern',
        'name' => 'Boston Fern',
        'image' => 'https://images.pexels.com/photos/4425869/pexels-photo-4425869.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Lush, feathery fronds that create a soft, natural atmosphere. Great for hanging baskets.',
        'price' => 24.99
    ],
    [
        'id' => 'aloe-vera',
        'name' => 'Aloe Vera',
        'image' => 'https://images.pexels.com/photos/6208067/pexels-photo-6208067.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Succulent with healing properties. Low maintenance and perfect for sunny windowsills.',
        'price' => 19.99
    ],
    [
        'id' => 'spider-plant',
        'name' => 'Spider Plant',
        'image' => 'https://images.pexels.com/photos/7728093/pexels-photo-7728093.jpeg?auto=compress&cs=tinysrgb&w=500&h=750&dpr=2',
        'description' => 'Easy-to-grow plant with arching leaves and baby plantlets. Great for beginners.',
        'price' => 18.99
    ]
];

// Check for success/error messages
$message = '';
if (isset($_GET['added'])) {
    $message = '<div class="success-message">Product added to cart successfully!</div>';
} elseif (isset($_GET['error'])) {
    $message = '<div class="error-message">Error adding product to cart. Please try again.</div>';
}
?>

<main class="main-content">
    <section class="section">
        <div class="container">
            <h1 class="section-title">Our Plant Collection</h1>
            <p class="section-subtitle">Discover our wide variety of beautiful, healthy plants perfect for your home or office</p>
            
            <?php echo $message; ?>
            
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                        <div class="product-info">
                            <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                            <form method="POST" action="add_to_cart.php" class="add-to-cart-form">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                                <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                                <input type="hidden" name="redirect" value="products.php">
                                <button type="submit" class="btn">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>