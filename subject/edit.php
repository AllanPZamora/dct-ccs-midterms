<?php
session_start();
$pageTitle = "Edit Subject";
include '../header.php';
include '../functions.php';

// Ensure the user is logged in
if (empty($_SESSION['email'])) {
    header("Location: ../index.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache");

// Session and page access guard
checkUserSessionIsActive();
guard();

$errors = [];
$subjectToEdit = null;
$subjectIndex = null;

// Retrieve the subject by subject code
if (isset($_GET['subject_code'])) {
    $subject_code = $_GET['subject_code'];
    $subjectIndex = getSelectedSubjectIndex($subject_code);

    if ($subjectIndex !== null) {
        $subjectToEdit = $_SESSION['subject_data'][$subjectIndex];
    } else {
        header("Location: add.php");
        exit;
    }
} else {
    header("Location: add.php");
    exit;
}

// Handle form submission for updating subject details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject_code'])) {
    $updatedData = [
        'subject_code' => $_POST['subject_code'],
        'subject_name' => $_POST['subject_name']
    ];

    // Validate input
    $errors = validateSubjectData($updatedData);

    // Update session data if no errors
    if (empty($errors) && $subjectIndex !== null) {
        $_SESSION['subject_data'][$subjectIndex] = $updatedData;
        header("Location: add.php");
        exit;
    }
}
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
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>System Errors</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Edit Subject Form -->
    <?php if ($subjectToEdit): ?>
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="subject_code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="subject_code" name="subject_code" 
                               value="<?= htmlspecialchars($subjectToEdit['subject_code']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="subject_name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name" 
                               value="<?= htmlspecialchars($subjectToEdit['subject_name'] ?? '') ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Subject</button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p class="text-danger text-center">Subject not found.</p>
        <div class="text-center">
            <a href="add.php" class="btn btn-primary">Back to Subject List</a>
        </div>
    <?php endif; ?>
</div>



<?php
include '../footer.php';
?>