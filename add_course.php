<?php
require_once 'config.php';
require_once 'classes/Database.php';
require_once 'classes/Course.php';

$errors = [];
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Validate title
    if (empty($title)) {
        $errors[] = "Title is required";
    }

    // Validate description
    if (empty($description)) {
        $errors[] = "Description is required";
    }

    // Validate image
    if (empty($image['name'])) {
        $errors[] = "Image is required";
    } elseif (!in_array(strtolower(pathinfo($image['name'], PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
        $errors[] = "Invalid image format. Supported formats: JPG, JPEG, PNG, GIF";
    }

    if (empty($errors)) {
        // No validation errors, proceed to upload image and add the course
        move_uploaded_file($image['tmp_name'], 'uploads/' . $image['name']);

        $database = new Database($db);
        $course = new Course($database);

        if ($course->addCourse($title, $description, $image['name'])) {
            // Course added successfully
            $success_message = "Course added successfully!";
            header('Location: view_courses.php');
            exit();
        } else {
            // Handle database error
            $errors[] = "An error occurred while adding the course.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
</head>
<body>
<h1>Add Course</h1>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div style="color: green;">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>"><br>

    <label>Description:</label>
    <textarea name="description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea><br>

    <label>Image:</label>
    <input type="file" name="image"><br>

    <input type="submit" value="Add Course">
</form>
</body>
</html>
