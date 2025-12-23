<?php
session_start();

include('db.php');

function validateAge($age) {
    if ($age < 16 ) {
        return "Age must be more than 16.";
    }
    return true;
}

function validateEmail($email, $conn) {
    $parts = explode('@', $email);
    if (count($parts) != 2 || $parts[1] !== 'gmail.com' || strlen($parts[0]) != 6) {
        return "Invalid email format. Must be 6 digits followed by @gmail.com.";
    }
    $result = $conn->query("SELECT id FROM user WHERE email = '$email'");
    if ($result->num_rows > 0) {
        return "Email already exists.";
    }
    return true;
}

function validatePassword($password) {
    $hasDigit = false;
    $hasUpper = false;
    $hasSpecial = false;
    $specialChars = ['$', '@', '!', '#'];

    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];
        if (ctype_digit($char)) {
            $hasDigit = true;
        } elseif (ctype_upper($char)) {
            $hasUpper = true;
        } elseif (in_array($char, $specialChars)) {
            $hasSpecial = true;
        }
    }

    if (!$hasDigit) {
        return "Password must contain at least one digit.";
    }
    if (!$hasUpper) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!$hasSpecial) {
        return "Password must contain at least one special character ($, @, !, or #).";
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    $emailValidation = validateEmail($email, $conn);
    $passwordValidation = validatePassword($password);
    $ageValidation = validateAge($age);

    if ($emailValidation === true && $passwordValidation === true && $ageValidation === true) {

        $query = "INSERT INTO user (email, name, password, age) VALUES ('$email', '$name', '$password', $age)";

        if ($conn->query($query) === TRUE) {
            $userId = $conn->insert_id;

            $_SESSION['userid'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['age'] = $age;
            header("Location: home.php"); 
            exit();
        } else {
            echo '<div class="alert alert-danger">Error inserting user: ' . $conn->error . '</div>';
        }
    } else {
        if ($emailValidation !== true) {
            echo '<div class="alert alert-danger">' . $emailValidation . '</div>';
        }
        if ($passwordValidation !== true) {
            echo '<div class="alert alert-danger">' . $passwordValidation . '</div>';
        }
        if ($ageValidation !== true) {
            echo '<div class="alert alert-danger">' . $ageValidation . '</div>';
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4 rounded-lg" style="width: 400px;">
            <h2 class="text-center mb-4">Create an Account</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                <p class="text-center mt-3">
                    <small>Already have an account? <a href="index.php">Log in here</a></small>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
