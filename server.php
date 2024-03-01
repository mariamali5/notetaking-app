<?php
session_start();

$username = "";
$email = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', 'mariamaliali', 'register');

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 !== $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
        mysqli_query($db, $sql);
        $_SESSION['username'] = $username;
       
        header('location: note.php'); 
    }
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: note.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>