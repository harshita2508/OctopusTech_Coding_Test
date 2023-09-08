<?php
class CourseController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['image'];

            if (empty($errors)) {
                
                move_uploaded_file($image['tmp_name'], 'uploads/' . $image['name']);

                if ($this->model->addCourse($title, $description, $image['name'])) {
                    $success_message = "Course added successfully!";
                } else {
                    $errors[] = "An error occurred while adding the course.";
                }
            }
        }
        require_once 'views/add_course.php';
    }

    public function view() {
        $courses = $this->model->getAllCourses();
        require_once 'views/view_courses.php';
    }
}
?>
