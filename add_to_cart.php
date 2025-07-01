<?php
include 'includes/cart_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $name = $_POST['name'] ?? '';
    $price = (float)($_POST['price'] ?? 0);
    $image = $_POST['image'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 1);
    
    if ($productId && $name && $price > 0) {
        addToCart($productId, $name, $price, $image, $quantity);
        
        // Return JSON response for AJAX requests
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Product added to cart!',
                'cartCount' => getCartItemCount()
            ]);
            exit;
        }
        
        // Redirect back to the referring page
        $redirect = $_POST['redirect'] ?? 'products.php';
        header('Location: ' . $redirect . '?added=1');
        exit;
    }
}

// If we get here, there was an error
header('Location: products.php?error=1');
exit;
?>