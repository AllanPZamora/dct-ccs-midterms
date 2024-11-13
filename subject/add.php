<?php
session_start();
$pageTitle = "Add Subject";
include '../header.php';
include '../functions.php';

?>

<div class="container mt-5">
<h2>Add a New Subject</h2>
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
        </ol>
    </nav>
    <hr>
    <br>

    <!-- Error Message Display -->
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
        <strong>System Errors</strong>
        <ul id="error-list">
            <!-- Errors will be dynamically inserted here -->
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Subject Entry Form -->
    <div class="card shadow-sm p-4">
        <form method="post">
            <div class="form-group mb-3">
                <label for="subject_code" class="form-label">Subject Code</label>
                <input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="Enter Subject Code">
            </div>
            <div class="form-group mb-3">
                <label for="subject_name" class="form-label">Subject Name</label>
                <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter Subject Name">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Add Subject</button>
            </div>
        </form>
    </div>
    <hr>

    <!-- Subject List Table -->
    <h3 class="mt-5 text-center">Subject List</h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <!-- Placeholder for subject rows -->
                <tr>
                    <td colspan="3" class="text-center">No subjects found.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php
include '../footer.php';
?>