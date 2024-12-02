<?php
session_start();

// Validation functions
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    // Validate fullname
    if (empty($_POST['fullname'])) {
        $errors[] = "Full name is required";
    } else {
        $fullname = validateInput($_POST['fullname']);
        if (strlen($fullname) < 3 || strlen($fullname) > 50) {
            $errors[] = "Full name must be between 3 and 50 characters";
        }
    }

    // Validate email
    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    } else {
        $email = validateInput($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    }

    // Validate phone
    if (empty($_POST['phone'])) {
        $errors[] = "Phone number is required";
    } else {
        $phone = validateInput($_POST['phone']);
        if (!preg_match("/^[0-9]{10,13}$/", $phone)) {
            $errors[] = "Invalid phone number format";
        }
    }

    // Validate age
    if (empty($_POST['age'])) {
        $errors[] = "Age is required";
    } else {
        $age = validateInput($_POST['age']);
        if ($age < 18 || $age > 100) {
            $errors[] = "Age must be between 18 and 100";
        }
    }

    // Validate and process file upload
    if (isset($_FILES['bio']) && $_FILES['bio']['error'] == 0) {
        $file = $_FILES['bio'];
        $file_type = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $file_size = $file['size'];

        if ($file_type != "txt") {
            $errors[] = "Only TXT files are allowed";
        }
        if ($file_size > 1048576) { // 1MB
            $errors[] = "File is too large (max 1MB)";
        }

        if (empty($errors)) {
            $file_content = file_get_contents($file['tmp_name']);
        }
    } else {
        $errors[] = "Bio file is required";
    }

    if (empty($errors)) {
        // Store data in session
        $_SESSION['registration_data'] = [
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'age' => $age,
            'bio_content' => $file_content,
            'browser_info' => [
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'request_time' => $_SERVER['REQUEST_TIME']
            ]
        ];
        
        header("Location: result.php");
        exit();
    } else {
        // Store errors in session and redirect back to form
        $_SESSION['errors'] = $errors;
        header("Location: form.php");
        exit();
    }
}
?>