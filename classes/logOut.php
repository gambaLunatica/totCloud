<?php
// Unset all session variables
$_SESSION = array();

// If you want to destroy the session completely, delete the session cookie as well
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),     // Session name
        '',                 // Empty value
        time() - 42000,     // Expire in the past
        $params["path"],    // Path
        $params["domain"],  // Domain
        $params["secure"],  // Secure
        $params["httponly"] // HTTP only
    );
}

// Finally, destroy the session
session_destroy();
header("Location: ../index.php");