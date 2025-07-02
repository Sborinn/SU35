<?php
$page_title = "Register Account"; // Set the page title
include 'includes/header.php'; // Include the header
?>

<main class="main-content">
    <section class="section">
        <div class="container">
            <h1 class="section-title">Create Your Account</h1>
            <p class="section-subtitle">Join the PlantLover community and start your green journey!</p>

            <?php
            // Example: Display a success/error message
            if (isset($_GET['success'])) {
                echo '<div class="success-message">Registration successful! Please <a href="account.php">sign in</a>.</div>';
            }
            if (isset($_GET['error'])) {
                // In a real application, you'd show more specific errors based on the type of error
                echo '<div class="error-message">There was an error during registration. Please try again.</div>';
            }
            ?>

            <div class="account-form">
                <h3>Sign Up</h3>
                <form method="POST" action="process_register.php"> <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            placeholder="Enter your full name"
                        >
                    </div>

                    <div class="form-group">
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
                            placeholder="Create a password"
                        >
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password *</label>
                        <input
                            type="password"
                            id="confirm_password"
                            name="confirm_password"
                            required
                            placeholder="Confirm your password"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <p style="text-align: center; margin-top: 1.5rem;">
                    Already have an account? <a href="account.php" style="color: #4CAF50; text-decoration: none; font-weight: 500;">Sign In here</a>
                </p>
            </div>
        </div>
    </section>
</main>

<?php
include 'includes/footer.php'; // Include the footer
?>  