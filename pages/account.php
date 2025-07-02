<?php
$page_title = "Account Login"; // Set the page title
include 'includes/header.php'; // Include the header
?>

<main class="main-content">
    <section class="section">
        <div class="container">
            <h1 class="section-title">Sign In to Your Account</h1>
            <p class="section-subtitle">Access your personalized plant collection and order history.</p>

            <?php
            // Example: Display a message if coming from a redirect or if there's an error
            if (isset($_GET['registered'])) {
                echo '<div class="success-message">Registration successful! Please sign in.</div>';
            }
            if (isset($_GET['error'])) {
                // In a real application, you'd show more specific errors
                echo '<div class="error-message">Invalid credentials or an error occurred. Please try again.</div>';
            }
            ?>

            <div class="account-form">
                <h3>Welcome Back!</h3>
                <form method="POST" action="process_login.php"> <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            placeholder="your.email@example.com"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="Enter your password"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>
                <p style="text-align: center; margin-top: 1.5rem;">
                    Don't have an account? <a href="register.php" style="color: #4CAF50; text-decoration: none; font-weight: 500;">Register here</a>
                </p>
                <p style="text-align: center; margin-top: 0.5rem;">
                    <a href="forgot_password.php" style="color: #666; text-decoration: none;">Forgot your password?</a>
                </p>
            </div>
        </div>
    </section>
</main>

<?php
include 'includes/footer.php'; // Include the footer
?>