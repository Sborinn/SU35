<footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>🌱 PlantLover Shop</h3>
                    <p>Your trusted partner in creating green, beautiful spaces. We provide high-quality plants and expert care advice.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="account.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'account.php' ? 'active' : ''; ?>">Account</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <p>📧 SU35@gmail.com</p>
                    <p>📞 (855) 123-4567</p>
                    <p>📍No. 86A, Street 110, Russian Federation Boulevard,
Sangkat Teuk Laak I, Khan Toul Kork, Phnom Penh, Cambodia</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> PlantLover Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.nav-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
    </script>
</body>
</html>