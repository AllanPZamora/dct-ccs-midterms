<?php
session_start();
$pageTitle = "Add Subject";
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

$errors = [];
$subject_data = [];

// Initialize session data array for subjects if not set
if (!isset($_SESSION['subject_data'])) {
    $_SESSION['subject_data'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject_data = [
        'subject_code' => $_POST['subject_code'],
        'subject_name' => $_POST['subject_name']
    ];

    // Validate the subject data
    $errors = validateSubjectData($subject_data);

    // Check for duplicates in subject code and name
    foreach ($_SESSION['subject_data'] as $existingSubject) {
        if ($existingSubject['subject_code'] === $subject_data['subject_code'] || $existingSubject['subject_name'] === $subject_data['subject_name']) {
            $errors[] = "Duplicate Subject";
            break;
        }
    }

    // If no errors, add the new subject to the session and refresh
    if (empty($errors)) {
        $_SESSION['subject_data'][] = $subject_data;
        header("Location: add.php");
        exit;
    }
}
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
                <?php if (!empty($_SESSION['subject_data'])): ?>
                    <?php foreach ($_SESSION['subject_data'] as $subject): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                            <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                            <td>
                                <a href="edit.php?subject_code=<?php echo urlencode($subject['subject_code']); ?>" class="btn btn-info btn-sm">Edit</a>
                                <a href="delete.php?subject_code=<?php echo urlencode($subject['subject_code']); ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No subjects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include '../footer.php';
?>