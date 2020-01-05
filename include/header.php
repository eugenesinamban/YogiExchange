<section class="section">
    <div class="tabs is-centered">
        <ul>
            <li <?php echo basename($_SERVER['PHP_SELF']) === "index.php" ? "class='is-active'" : null; ?>><a href="index.php">Home</a></li>
            <li <?php echo basename($_SERVER['PHP_SELF']) === "supported.php" ? "class='is-active'" : null; ?>><a href="supported.php">Supported</a></li>
            <li <?php echo basename($_SERVER['PHP_SELF']) === "about.php" ? "class='is-active'" : null; ?>><a href="about.php">About</a></li>
            <li <?php echo basename($_SERVER['PHP_SELF']) === "contact.php" ? "class='is-active'" : null; ?>><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>
</section>