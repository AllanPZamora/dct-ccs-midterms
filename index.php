<?php
session_start();
$pageTitle = "Log In";

if (!empty($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit;
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include 'header.php';
include 'functions.php';

$errors = [];
$notification = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $errors = validateLoginCredentials($email, $password);

    if (empty($errors)) {
        $users = getUsers();
        if (checkLoginCredentials($email, $password, $users)) {
            $_SESSION['email'] = $email;
            $_SESSION['current_page'] = 'dashboard.php'; // Set the direct page for the user
            header("Location: dashboard.php");
            exit;
        } else {

            $notification = "<li>Invalid Email.</li>";
        }
    } else {

        $notification = displayErrors($errors);
    }
}

?>

<div class="container d-flex flex-column align-items-center mt-5">
        <?php if (!empty($notification)): ?>
            <div class="col-md-4 mb-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>System Errors</strong>
                    <?php echo $notification; ?>
                    <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

<br>
<div class="card p-4 mx-auto" style="width: 300px;">
    <h3 class="card-title text-center">Login</h3>
     <div class="container">
        <form method="POST">

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

    </div>
</div>

<?php
include("footer.php");
?>