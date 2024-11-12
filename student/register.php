<?php
session_start();
$pageTitle = "Register Student";
include '../header.php';
include '../functions.php';


?>

<div class="container mt-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register Student</li>
        </ol>
    </nav>

    <h2>Register a New Student</h2>

    <form action="register_student.php" method="post">
        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>

    <h3 class="mt-5">Student List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP code to fetch and display students here -->
            <tr>
                <td colspan="4">No student records found.</td>
            </tr>
        </tbody>
    </table>
</div>

<?php
include '../footer.php';
?>