<?php

session_start();

// Check if user is logged in and has the necessary permissions
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

include __DIR__ . '/../../connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update the account status
    $sql = "UPDATE users SET Account_status='Disabled' WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Account disabled successfully.";
    } else {
        echo "Failed to disable the account.";
    }

    $stmt->close();
} else {
    echo "No user ID provided.";
}

$conn->close();

// Redirect back to the table view
header("Location: ../../Dashboard.php");
exit();