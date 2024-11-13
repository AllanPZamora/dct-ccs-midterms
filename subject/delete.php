<?php
session_start();
$pageTitle = "Delete Subject";
include '../header.php';
include '../functions.php';
?>

<div class="container mt-5">
    <!-- Page Title and Breadcrumb Navigation -->
    <h2>Delete a Subject</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="add.php">Add Subject</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delete Subject</li>
        </ol>
    </nav>

    <!-- Subject Deletion Confirmation Card -->
    <div class="card shadow-sm mx-auto mt-4" style="max-width: 500px;">
        <div class="card-body text-center">
            <h5>Are you sure you want to delete the following subject record?</h5>
            <ul class="list-unstyled mt-3">
                <li><strong>Subject Code:</strong></li>
                <li><strong>Subject Name:</strong></li>
            </ul>
            <form method="post" class="d-flex justify-content-center mt-4">
                <input type="hidden" name="subject_code" value="<!-- Hidden Subject Code Here -->">
                <button type="button" class="btn btn-secondary mx-2" onclick="window.location.href='add.php';">Cancel</button>
                <button type="submit" class="btn btn-danger mx-2">Delete Subject Record</button>
            </form>
        </div>
    </div>
</div>


<?php
include '../footer.php';
?>