<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <script>
         function showSuccessPopup() {
        alert("Course added successfully!");
        window.location.replace("index.php");
    }


        function validateForm() {
            const title = document.forms["courseForm"]["title"].value;
            const description = document.forms["courseForm"]["description"].value;
            const image = document.forms["courseForm"]["image"].value;

            const errors = [];

            if (title.trim() === "") {
                errors.push("Title is required");
            }

            if (description.trim() === "") {
                errors.push("Description is required");
            }

            if (image.trim() === "") {
                errors.push("Image is required");
            } else {
                const allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                const fileExtension = image.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(fileExtension)) {
                    errors.push("Invalid image format. Supported formats: JPG, JPEG, PNG, GIF");
                }
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }

           
            showSuccessPopup();

            return true;
        }
    </script>
</head>
<body>
<h1>Add Course</h1>

<form name="courseForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
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
