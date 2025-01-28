<?php
include("../connection/dbconnect.php");

if (isset($_POST['c_ID'])) {
    $c_id = $_POST['c_ID'];

    // Prepare the delete statement to avoid SQL injection
    if ($stmt = $db->prepare("DELETE FROM users WHERE U_ID = ?")) {
        $stmt->bind_param("i", $c_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>