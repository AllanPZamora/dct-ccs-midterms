<?php
session_start();
$pageTitle = "Dashboard";

    if (empty($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }

include 'header.php'; 
include 'functions.php'; 

checkUserSessionIsActive();

guard();

?>


<br>
    <div class="container d-flex justify-content-between align-items-center col-md-7">
        <h4>Welcome to the System: <?php echo $_SESSION['email']; ?></h4>
        <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button>
    </div>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add a Subject
                </div>
                <div class="card-body">
                    <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                    <a href="subject/add.php" class="btn btn-primary btn-lg w-100">Add Subject</a>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Register a Student
                </div>
                <div class="card-body">
                    <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                   
                    <a href="student/register.php" class="btn btn-primary btn-lg w-100">Register</a>
                </div>
            </div>
        </div>
    </div>

<?php
include 'footer.php'; 
?>