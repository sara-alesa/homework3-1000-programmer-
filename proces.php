<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $age = trim($_POST["age"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $confirm_password = trim($_POST["confirm_password"] ?? '');
    $errors = [];

    if(empty($username)){
        $errors['username'] = "Username is required";
    }

    if(empty($email)){
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if(empty($age)){
        $errors['age'] = "Age is required";
    } elseif (!is_numeric($age)) {
        $errors['age'] = "Age must be a number";
    } elseif ($age < 18) {
        $errors['age'] = "You must be at least 18 years old";
    }

    if(empty($password)){
        $errors['password'] = "Password is required"; 
    } elseif (strlen($password) < 6) {  
        $errors['password'] = "Password must be at least 6 characters long";
    }

    if(empty($confirm_password)){
        $errors['confirm_password'] = "Confirm password is required";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    echo "<!DOCTYPE html><html><head><title>البيانات المدخلة:</title></head><body>";

    if (!empty($errors)) {
        echo "<h3 style='color:red;'>There were errors:</h3><ul>";
        foreach($errors as $error) {
            echo "<li style='color:red;'>$error</li>";
        }
        echo "</ul><a href='validation.php'>عد</a>";
    } else {
        echo "<ul>";
        echo "<li><strong>Username:</strong> " . htmlspecialchars($username) . "</li>";
        echo "<li><strong>Email:</strong> " . htmlspecialchars($email) . "</li>";
        echo "<li><strong>Age:</strong> " . htmlspecialchars($age) . "</li>";
        echo "</ul><a href='form.php'>Submit another</a>";
    }

    echo "</body></html>";
}
?>
