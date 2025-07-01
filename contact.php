<?php 
$page_title = "Contact Us";

// Form processing
$errors = [];
$success = false;
$form_data = [
    'name' => '',
    'email' => '',
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_data['name'] = trim($_POST['name'] ?? '');
    $form_data['email'] = trim($_POST['email'] ?? '');
    $form_data['message'] = trim($_POST['message'] ?? '');
    
    // Validation
    if (empty($form_data['name'])) {
        $errors['name'] = 'Name is required';
    }
    
    if (empty($form_data['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }
    
    if (empty($form_data['message'])) {
        $errors['message'] = 'Message is required';
    } elseif (strlen($form_data['message']) < 10) {
        $errors['message'] = 'Message must be at least 10 characters long';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        $success = true;
    }
}

include 'includes/header.php'; 
?>

<main class="main-content">
    <section class="section">
        <div class="container">
            <h1 class="section-title">Contact Us</h1>
            <p class="section-subtitle">Have questions about plants or need care advice? We're here to help!</p>
            
            <?php if ($success): ?>
                <div class="success">
                    <h3>Thank you for your message!</h3>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($form_data['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($form_data['email']); ?></p>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($form_data['message']); ?></p>
                    <p>We'll get back to you as soon as possible!</p>
                </div>
            <?php endif; ?>
            
            <div class="contact-content">
                <div class="contact-form">
                    <h3>Send us a Message</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="<?php echo htmlspecialchars($form_data['name']); ?>"
                                <?php echo isset($errors['name']) ? 'style="border-color: #e74c3c;"' : ''; ?>
                            >
                            <?php if (isset($errors['name'])): ?>
                                <div class="error"><?php echo $errors['name']; ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Your Email *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="<?php echo htmlspecialchars($form_data['email']); ?>"
                                <?php echo isset($errors['email']) ? 'style="border-color: #e74c3c;"' : ''; ?>
                            >
                            <?php if (isset($errors['email'])): ?>
                                <div class="error"><?php echo $errors['email']; ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message *</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                <?php echo isset($errors['message']) ? 'style="border-color: #e74c3c;"' : ''; ?>
                            ><?php echo htmlspecialchars($form_data['message']); ?></textarea>
                            <?php if (isset($errors['message'])): ?>
                                <div class="error"><?php echo $errors['message']; ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
                
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <div class="contact-item">
                        <span>📧</span>
                        <div>
                            <strong>Email</strong><br>
                            info@plantlovershop.com<br>
                            support@plantlovershop.com
                        </div>
                    </div>
                    <div class="contact-item">
                        <span>📞</span>
                        <div>
                            <strong>Phone</strong><br>
                            (855) 123-4567<br>
                            Mon-Fri 9AM-6PM EST
                        </div>
                    </div>
                    <div class="contact-item">
                        <span>📍</span>
                        <div>
                            <strong>Address</strong><br>
                            📍Sangkat Teuk Laak I, Khan Toul Kork<br> Phnom Penh, Cambodia
                        </div>
                    </div>
                    <div class="contact-item">
                        <span>🕒</span>
                        <div>
                            <strong>Store Hours</strong><br>
                            Monday - Friday: 9AM - 7PM<br>
                            Saturday: 9AM - 6PM<br>
                            Sunday: 10AM - 5PM
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>