<?php
include '../configuration.php';

$email = '';
$error_message = '';
$success_message = '';

if (isset($_GET['email'])) {
    $email = urldecode($_GET['email']);
} else {
    header("Location: forgotpassword.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // Hash the new password
        // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE staff SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);

        if ($stmt->execute()) {
            $success_message = "Your password has been changed successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .modal-dialog {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .modal-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        .success-message {
            color: green;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .gray-text {
            color: #666;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #aaa;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="modal-dialog">
            <div class="modal-header">
                <span class="modal-title">Change Password</span>
            </div>
            <div class="modal-body">
                <?php if (!empty($error_message)) : ?>
                    <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>

                <?php if (!empty($success_message)) : ?>
                    <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
                    <p><a href="staffLogin.php">Go to Login</a></p>
                <?php else : ?>
                    <form method="post">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                        <button type="submit" name="change" class="btn">Change Password</button>
                    </form>
                <?php endif; ?>
                <!-- <p class="gray-text">For security reasons we don't store your password. Your password will be reset and a new one will be sent.</p> -->
            </div>
        </div>
    </div>
</body>

</html>
