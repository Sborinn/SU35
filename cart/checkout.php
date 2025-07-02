<?php
$page_title = "Checkout";
include 'includes/header.php'; // Includes session_start() and cart_functions.php
include_once 'includes/cart_functions.php'; // Ensure cart functions are available

// Get cart items and total from session
$cartItems = getCartItems(); //
$cartTotal = getCartTotal(); //

// Redirect to cart if it's empty
if (empty($cartItems)) {
    header('Location: cart.php?empty_checkout=1');
    exit;
}

// Initialize form data for sticky form fields
$form_data = [
    'full_name' => $_POST['full_name'] ?? '',
    'address' => $_POST['address'] ?? '',
    'city' => $_POST['city'] ?? '',
    'zip_code' => $_POST['zip_code'] ?? '',
    'country' => $_POST['country'] ?? 'Cambodia',
    'card_name' => $_POST['card_name'] ?? '',
    'payment_method' => $_POST['payment_method'] ?? 'visa' // Default to Visa
];

$errors = [];
$success_message = '';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    // Basic validation for shipping details
    if (empty(trim($_POST['full_name'] ?? ''))) {
        $errors['full_name'] = 'Full Name is required.';
    }
    if (empty(trim($_POST['address'] ?? ''))) {
        $errors['address'] = 'Address is required.';
    }
    if (empty(trim($_POST['city'] ?? ''))) {
        $errors['city'] = 'City is required.';
    }
    if (empty(trim($_POST['country'] ?? ''))) {
        $errors['country'] = 'Country is required.';
    }

    $payment_method = $_POST['payment_method'] ?? '';

    if ($payment_method === 'visa') {
        // IMPORTANT: For card details, you would typically NOT validate or process them directly here.
        // Instead, a JavaScript SDK from your payment gateway would handle this securely on the client-side,
        // returning a token. Your server would only receive that token.
        // For demonstration, these are just placeholder inputs.
        if (empty(trim($_POST['card_number'] ?? '')) || empty(trim($_POST['expiry_date'] ?? '')) || empty(trim($_POST['cvv'] ?? '')) || empty(trim($_POST['card_name'] ?? ''))) {
            $errors['payment'] = 'All card details are required.';
        }
        // Here, you'd process the Visa card payment via your payment gateway's server-side API.
        // E.g., using a token obtained from client-side JS.
        // $payment_successful = $gateway->chargeVisa($paymentToken, $cartTotal);
    } elseif ($payment_method === 'khqr') {
        // Here, you'd initiate a KHQR payment via your payment gateway's/bank's API.
        // This might involve generating a QR code on the fly and waiting for a webhook confirmation.
        // $payment_successful = $gateway->initiateKhqrPayment($cartTotal);
        // For this example, we'll assume it's "successful" for the flow.
    } else {
        $errors['payment_method'] = 'Please select a valid payment method.';
    }


    if (empty($errors)) {
        // --- THIS IS WHERE SECURE PAYMENT GATEWAY INTEGRATION SUCCESS LOGIC WOULD GO ---
        // For this example, we'll simulate a successful order placement:
        clearCart(); // Clear the cart after order is "placed"
        header('Location: order_confirmation.php'); // Redirect to a confirmation page (you'd need to create this page)
        exit;
    } else {
        // Populate form data with submitted values if there are errors, to retain user input
        $form_data = [
            'full_name' => $_POST['full_name'] ?? '',
            'address' => $_POST['address'] ?? '',
            'city' => $_POST['city'] ?? '',
            'zip_code' => $_POST['zip_code'] ?? '',
            'country' => $_POST['country'] ?? 'Cambodia',
            'card_name' => $_POST['card_name'] ?? '',
            'payment_method' => $_POST['payment_method'] ?? 'visa'
        ];
        // Note: Card details are not re-populated for security reasons.
    }
}

?>

<main class="main-content">
    <section class="section">
        <div class="container">
            <h1 class="section-title">Proceed to Checkout</h1>
            <p class="section-subtitle">Please review your order and enter your details to complete the purchase.</p>
            
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <h3>Please correct the following errors:</h3>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="cart-content"> <div class="cart-items"> <h3>Your Order Summary</h3>
                    <?php if (!empty($cartItems)): ?>
                        <ul>
                            <?php foreach ($cartItems as $item): ?>
                                <li>
                                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                                        <span><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['quantity']; ?></span>
                                        <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="summary-row total" style="margin-top: 1rem; padding-top: 1rem;">
                            <span>Order Total:</span>
                            <span>$<?php echo number_format($cartTotal, 2); ?></span>
                        </div>
                    <?php else: ?>
                        <p>Your cart is empty. Please add items before checking out.</p>
                        <a href="products.php" class="btn">Continue Shopping</a>
                    <?php endif; ?>
                </div>

                <div class="cart-summary"> <h3>Shipping & Payment Information</h3>
                    <form action="" method="POST">
                        <h4>Shipping Address</h4>
                        <div class="form-group">
                            <label for="full_name">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($form_data['full_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address *</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($form_data['address']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City *</label>
                            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($form_data['city']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($form_data['zip_code']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="country">Country *</label>
                            <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($form_data['country']); ?>" required>
                        </div>

                        <h4>Choose Payment Method</h4>
                        <div class="payment-options-grid">
                            <div class="payment-option-card" id="visa_option_card">
                                <input type="radio" id="pay_visa" name="payment_method" value="visa" <?php echo ($form_data['payment_method'] === 'visa') ? 'checked' : ''; ?>>
                                <label for="pay_visa">
                                    <span class="icon">💳</span>
                                    Credit/Debit Card
                                    <small>(Visa/Mastercard)</small>
                                </label>
                            </div>
                            <div class="payment-option-card" id="khqr_option_card">
                                <input type="radio" id="pay_khqr" name="payment_method" value="khqr" <?php echo ($form_data['payment_method'] === 'khqr') ? 'checked' : ''; ?>>
                                <label for="pay_khqr">
                                    <span class="icon">🏦</span>
                                    KHQR
                                    <small>(Cambodian Bank Transfer)</small>
                                </label>
                            </div>
                        </div>

                        <div id="card_details_section" style="margin-top: 1rem; <?php echo ($form_data['payment_method'] === 'khqr') ? 'display:none;' : ''; ?>">
                            <div class="form-group">
                                <label for="card_number">Credit/Debit Card Number *</label>
                                <input type="text" id="card_number" name="card_number" placeholder="**** **** **** ****" minlength="16" maxlength="19" <?php echo ($form_data['payment_method'] === 'visa') ? 'required' : ''; ?>>
                            </div>
                            <div class="form-group" style="display: flex; gap: 1rem;">
                                <div style="flex: 1;">
                                    <label for="expiry_date">Expiry Date (MM/YY) *</label>
                                    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" minlength="5" maxlength="5" <?php echo ($form_data['payment_method'] === 'visa') ? 'required' : ''; ?>>
                                </div>
                                <div style="flex: 1;">
                                    <label for="cvv">CVV *</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="CVC" minlength="3" maxlength="4" <?php echo ($form_data['payment_method'] === 'visa') ? 'required' : ''; ?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="card_name">Name on Card *</label>
                                <input type="text" id="card_name" name="card_name" value="<?php echo htmlspecialchars($form_data['card_name']); ?>" <?php echo ($form_data['payment_method'] === 'visa') ? 'required' : ''; ?>>
                            </div>
                        </div>

                        <div id="khqr_details_section" style="margin-top: 1rem; text-align: center; <?php echo ($form_data['payment_method'] === 'visa') ? 'display:none;' : ''; ?>">
                            <p>
                                **For KHQR Payment:**
                                <br>
                                In a live system, a unique KHQR code for your order total would be generated here by your backend server interacting with a Cambodian bank's API (e.g., ABA PayWay).
                                You would then display the QR code image for the customer to scan with their mobile banking app.
                            </p>
                            <div style="border: 1px dashed #ccc; padding: 2rem; margin: 1.5rem auto; max-width: 300px; text-align: center;">
                                <img src="https://th.bing.com/th/id/OIP.51jYao4tEtAxNH5RzEWwpQHaHa?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" alt="KHQR Code Placeholder" style="max-width: 100%; height: auto; margin-bottom: 1rem;">
                                <p>Scan this QR code with your Cambodian banking app to complete payment.</p>
                                <p style="font-weight: bold; color: #2d5016;">Amount: $<?php echo number_format($cartTotal, 2); ?></p>
                                <p style="font-size: 0.9em; color: #666;">(Your order will be confirmed upon successful payment detection.)</p>
                            </div>
                        </div>

                        <button type="submit" name="submit_order" class="btn btn-primary">Place Order</button>
                        
                        <a href="cart.php" class="btn btn-secondary" style="margin-top: 1rem; display: block; text-align: center;">Back to Cart</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    // JavaScript to toggle visibility of payment sections and selected class
    document.addEventListener('DOMContentLoaded', function() {
        const payVisaRadio = document.getElementById('pay_visa');
        const payKhqrRadio = document.getElementById('pay_khqr');
        const visaOptionCard = document.getElementById('visa_option_card');
        const khqrOptionCard = document.getElementById('khqr_option_card');
        const cardDetailsSection = document.getElementById('card_details_section');
        const khqrDetailsSection = document.getElementById('khqr_details_section');

        // Get all card input fields
        const cardInputs = [
            document.getElementById('card_number'),
            document.getElementById('expiry_date'),
            document.getElementById('cvv'),
            document.getElementById('card_name')
        ];

        function togglePaymentSections() {
            // Remove 'selected' class from both cards
            visaOptionCard.classList.remove('selected');
            khqrOptionCard.classList.remove('selected');

            if (payVisaRadio.checked) {
                visaOptionCard.classList.add('selected');
                cardDetailsSection.style.display = 'block';
                khqrDetailsSection.style.display = 'none';

                // Add 'required' attribute to card fields
                cardInputs.forEach(input => input.setAttribute('required', 'required'));

            } else if (payKhqrRadio.checked) {
                khqrOptionCard.classList.add('selected');
                cardDetailsSection.style.display = 'none';
                khqrDetailsSection.style.display = 'block';

                // Remove 'required' attribute from card fields
                cardInputs.forEach(input => input.removeAttribute('required'));
            }
        }

        // Add event listeners to radio buttons
        payVisaRadio.addEventListener('change', togglePaymentSections);
        payKhqrRadio.addEventListener('change', togglePaymentSections);

        // Add event listeners to card elements to select radio button when card is clicked
        visaOptionCard.addEventListener('click', function() {
            payVisaRadio.checked = true;
            togglePaymentSections();
        });
        khqrOptionCard.addEventListener('click', function() {
            payKhqrRadio.checked = true;
            togglePaymentSections();
        });

        // Call on page load to set initial state based on PHP's default or submitted value
        togglePaymentSections();
    });
</script>

<?php include 'includes/footer.php'; ?>