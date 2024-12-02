<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            font-size: 0.9em;
            display: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Registration Form</h2>
    <form id="registrationForm" action="process.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" minlength="3" maxlength="50" required>
            <span class="error" id="fullname-error">Name must be between 3 and 50 characters</span>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span class="error" id="email-error">Please enter a valid email address</span>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10,13}" required>
            <span class="error" id="phone-error">Phone number must be between 10-13 digits</span>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="18" max="100" required>
            <span class="error" id="age-error">Age must be between 18 and 100</span>
        </div>

        <div class="form-group">
            <label for="bio">Biography File (txt only, max 1MB):</label>
            <input type="file" id="bio" name="bio" accept=".txt" required>
            <span class="error" id="bio-error">Please upload a valid text file (max 1MB)</span>
        </div>

        <button type="submit">Register</button>
    </form>

    <script>
        function validateForm() {
            let isValid = true;
            const errors = {
                fullname: document.getElementById('fullname-error'),
                email: document.getElementById('email-error'),
                phone: document.getElementById('phone-error'),
                age: document.getElementById('age-error'),
                bio: document.getElementById('bio-error')
            };

            // Reset errors
            Object.values(errors).forEach(error => error.style.display = 'none');

            // Validate fullname
            const fullname = document.getElementById('fullname').value;
            if (fullname.length < 3 || fullname.length > 50) {
                errors.fullname.style.display = 'block';
                isValid = false;
            }

            // Validate email
            const email = document.getElementById('email').value;
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                errors.email.style.display = 'block';
                isValid = false;
            }

            // Validate phone
            const phone = document.getElementById('phone').value;
            if (!/^[0-9]{10,13}$/.test(phone)) {
                errors.phone.style.display = 'block';
                isValid = false;
            }

            // Validate age
            const age = document.getElementById('age').value;
            if (age < 18 || age > 100) {
                errors.age.style.display = 'block';
                isValid = false;
            }

            // Validate bio file
            const bio = document.getElementById('bio').files[0];
            if (bio) {
                if (bio.size > 1048576) {
                    errors.bio.style.display = 'block';
                    isValid = false;
                }
            }

            return isValid;
        }
    </script>
</body>

</html>