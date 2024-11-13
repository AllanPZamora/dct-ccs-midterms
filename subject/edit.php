<?php
session_start();
$pageTitle = "Edit Subject";
include '../header.php';
include '../functions.php';

?>

<div class="container mt-5">
    <!-- Page Title and Breadcrumb Navigation -->
    <h2>Edit Subject</h2>
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="add.php">Add Subject</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
        </ol>
    </nav>
    <hr>

    <!-- Display errors if there are validation issues -->
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>System Errors</strong>
        <ul>
            <li>Example Error 1</li>
            <li>Example Error 2</li>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Edit Subject Form -->
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="subject_code" class="form-label">Subject Code</label>
                    <input type="text" class="form-control" id="subject_code" name="subject_code" value="SUBJECT_CODE" readonly>
                </div>
                <div class="mb-3">
                    <label for="subject_name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" id="subject_name" name="subject_name" value="SUBJECT_NAME">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Subject</button>
                </div>
            </form>
        </div>
    </div>

    <!-- If subject is not found -->
    <p class="text-danger text-center">Subject not found.</p>
    <div class="text-center">
        <a href="add.php" class="btn btn-primary">Back to Subject List</a>
    </div>
</div>



<?php
include '../footer.php';
?>