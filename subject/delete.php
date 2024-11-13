<?php
session_start();
$pageTitle = "Delete Subject";
include '../header.php';
include '../functions.php';

// Redirect if user is not logged in
if (empty($_SESSION['email'])) {
    header("Location: ../index.php");
    exit;
}

// Cache-control headers for no caching
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache");

// Session check and guard
checkUserSessionIsActive();  
guard(); 

// Get subject details for deletion if subject_code is provided
$subjectToDelete = null;
if (isset($_GET['subject_code'])) {
    $subject_code = $_GET['subject_code'];

    if (!empty($_SESSION['subject_data'])) {
        foreach ($_SESSION['subject_data'] as $subject) {
            if ($subject['subject_code'] === $subject_code) {
                $subjectToDelete = $subject;
                break;
            }
        }
    }
} else {
    // Redirect if no subject_code is provided
    header("Location: add.php");
    exit;
}

// Handle the deletion of the subject
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject_code'])) {
    $subject_code = $_POST['subject_code'];

    if (!empty($_SESSION['subject_data'])) {
        foreach ($_SESSION['subject_data'] as $key => $subject) {
            if ($subject['subject_code'] === $subject_code) {
                unset($_SESSION['subject_data'][$key]);
                $_SESSION['subject_data'] = array_values($_SESSION['subject_data']); 
                break;
            }
        }
    }
    // Redirect back to the subject list after deletion
    header("Location: add.php");
    exit;
}
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

    <  <!-- Subject Deletion Confirmation Card -->
    <div class="card shadow-sm mx-auto mt-4" style="max-width: 500px;">
        <div class="card-body text-center">
            <?php if ($subjectToDelete): ?>
                <h5>Are you sure you want to delete the following subject record?</h5>
                <ul class="list-unstyled mt-3">
                    <li><strong>Subject Code:</strong> <?= htmlspecialchars($subjectToDelete['subject_code']) ?></li>
                    <li><strong>Subject Name:</strong> <?= htmlspecialchars($subjectToDelete['subject_name']) ?></li>
                </ul>
                <form method="post" class="d-flex justify-content-center mt-4">
                    <input type="hidden" name="subject_code" value="<?= htmlspecialchars($subjectToDelete['subject_code']) ?>">
                    <button type="button" class="btn btn-secondary mx-2" onclick="window.location.href='add.php';">Cancel</button>
                    <button type="submit" class="btn btn-danger mx-2">Delete Subject Record</button>
                </form>
            <?php else: ?>
                <p class="text-danger">Subject not found.</p>
                <a href="add.php" class="btn btn-primary">Back to Subject List</a>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
include '../footer.php';
?>