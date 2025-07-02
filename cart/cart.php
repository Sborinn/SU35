<?php
$page_title = "Shopping Cart";
include 'includes/header.php';
include_once 'includes/cart_functions.php';

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
                if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
                    updateCartQuantity($_POST['product_id'], (int)$_POST['quantity']);
                }
                break;
            case 'remove':
                if (isset($_POST['product_id'])) {
                    removeFromCart($_POST['product_id']);
                }
                break;
            case 'clear':
                clearCart();
                break;
        }
    }
    // Redirect to prevent form resubmission
    header('Location: cart.php');
    exit;
}

$cartItems = getCartItems();
$cartTotal = getCartTotal();
$cartCount = getCartItemCount();
?>

<main class="main-content">
    <section class="section">
        <div class="container">
            <h1 class="section-title">Shopping Cart</h1>
            
            <?php if (empty($cartItems)): ?>
                <div class="empty-cart">
                    <h3>Your cart is empty</h3>
                    <p>Add some beautiful plants to your cart to get started!</p>
                    <a href="products.php" class="btn">Continue Shopping</a>
                </div>
            <?php else: ?>
                <div class="cart-content">
                    <div class="cart-items">
                        <?php foreach ($cartItems as $productId => $item): ?>
                            <div class="cart-item">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image">
                                <div class="cart-item-details">
                                    <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                                    <p class="cart-item-price">$<?php echo number_format($item['price'], 2); ?></p>
                                </div>
                                <div class="cart-item-quantity">
                                    <form method="POST" class="quantity-form">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="99" class="quantity-input">
                                        <button type="submit" class="btn-small">Update</button>
                                    </form>
                                </div>
                                <div class="cart-item-total">
                                    $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                </div>
                                <div class="cart-item-remove">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <button type="submit" class="btn-remove">Remove</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="cart-summary">
                        <h3>Order Summary</h3>
                        <div class="summary-row">
                            <span>Items (<?php echo $cartCount; ?>):</span>
                            <span>$<?php echo number_format($cartTotal, 2); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>$<?php echo number_format($cartTotal, 2); ?></span>
                        </div>
                        
                        <div class="cart-actions">
                            <form action="checkout.php" method="GET" style="margin-bottom: 1rem;">
    <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
</form>
                            <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
                            <form method="POST" style="margin-top: 1rem;">
                                
                                <input type="hidden" name="action" value="clear">
                                <button type="submit" class="btn-clear" onclick="return confirm('Are you sure you want to clear your cart?')">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>