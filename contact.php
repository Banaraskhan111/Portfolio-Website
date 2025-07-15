<?php
// Database configuration
$host = 'sql305.infinityfree.com'; // use the actual host
$dbname = 'if0_39464272_db'; // your actual db name
$username = 'epiz_12345678'; // your hosting username
$password = 'f0_39464272'; 

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create messages table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            subject VARCHAR(200),
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'];

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);

        // Send email notification (optional)
        $to = "your.email@example.com";
        $headers = "From: $email";
        mail($to, "New Portfolio Message: $subject", $message, $headers);

        // Redirect with success message
        header('Location: index.html#contact?status=success');
        exit();
    }
} catch (PDOException $e) {
    // Redirect with error message
    header('Location: index.html#contact?status=error');
    exit();
}
?>