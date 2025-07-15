<?php
// Database configuration
$host = 'sql305.infinityfree.com'; // use the actual host
$dbname = 'if0_39464272_db'; // your actual db name
$username = 'epiz_12345678'; // your hosting username
$password = 'f0_39464272'; 

// Session configuration for CSRF protection
session_start();

// Generate CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}