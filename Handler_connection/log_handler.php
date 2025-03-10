<?php

include '../database/connectiondb.php';
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = verify_user($username, $password);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['errors'] = "Invalid username or password!";
            header("Location: ../Customer-login/log-in.php");
            exit;
        }

        if ($user) {
            // Generate a unique token
            $token = bin2hex(random_bytes(32));

            // Store the token in the session
            $_SESSION['access_token'] = $token;
            $_SESSION['user_role'] = $user['user_role']; // Assuming 'user_role' is a column in your users table

            if ($user['user_role'] == 'admin') {
                header("Location: ../designforSalon/home.php");
            } else {
                header("Location: ../BookingSite/HomeBooking.php");
            }
            exit;
        } else {
            $_SESSION['errors'] = "Invalid username or password!";
            header("Location: ../Customer-login/log-in.php");
            exit;
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Function to verify user credentials
function verify_user($username, $password)
{
    global $conn;

    $stmt = $conn->prepare("SELECT id, password, user_role FROM users WHERE username = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            return $row; // Return user info
        }
    }
    return false;
}

?>
