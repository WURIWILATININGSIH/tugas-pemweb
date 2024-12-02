<?php
session_start();

if (!isset($_SESSION['registration_data'])) {
    header("Location: form.php");
    exit();
}

$data = $_SESSION['registration_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h2>Registration Results</h2>

    <div class="section">
        <h3>Personal Information</h3>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><?php echo htmlspecialchars($data['fullname']); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo htmlspecialchars($data['email']); ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><?php echo htmlspecialchars($data['phone']); ?></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><?php echo htmlspecialchars($data['age']); ?></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Biography Content</h3>
        <table>
            <tr>
                <th>Content</th>
            </tr>
            <tr>
                <td><?php echo nl2br(htmlspecialchars($data['bio_content'])); ?></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>System Information</h3>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Browser/User Agent</td>
                <td><?php echo htmlspecialchars($data['browser_info']['user_agent']); ?></td>
            </tr>
            <tr>
                <td>IP Address</td>
                <td><?php echo htmlspecialchars($data['browser_info']['ip_address']); ?></td>
            </tr>
            <tr>
                <td>Request Time</td>
                <td><?php echo date('Y-m-d H:i:s', $data['browser_info']['request_time']); ?></td>
            </tr>
        </table>
    </div>

    <a href="form.php">Back to Form</a>
</body>
</html>