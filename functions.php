<?php

function getUsers() {
    return [
        ["email" => "admin1@example.com", "password" => "admin1"],
        ["email" => "admin2@example.com", "password" => "admin2"],
        ["email" => "admin3@example.com", "password" => "admin3"],
        ["email" => "admin4@example.com", "password" => "admin4"],
        ["email" => "admin5@example.com", "password" => "admin5"]
    ];
}

function validateLoginCredentials($email, $password) {
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email.";
    } else {

        $users = getUsers();
        $emailExists = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $emailExists = true;
                break;
            }
        }

        if (!$emailExists) {
            $errors[] = "Invalid Email.";
        }
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    return $errors;
}


function checkLoginCredentials($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

function checkUserSessionIsActive() {

    if (isset($_SESSION['email']) && basename($_SERVER['PHP_SELF']) == 'index.php') {
        header("Location: dashboard.php");
        exit;
    }
}



function guard() {
    if (empty($_SESSION['email']) && basename($_SERVER['PHP_SELF']) != 'index.php') {
        header("Location: index.php"); 
        exit;
    }
}


function displayErrors($errors) {

    $output = "<ul>";
    foreach ($errors as $error) {
        $output .= "<li>" . htmlspecialchars($error) . "</li>";
    }
    $output .= "</ul>";
    return $output;
}
?>