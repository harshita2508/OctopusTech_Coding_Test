<?php
require_once 'config/config.php';
require_once 'models/CourseModel.php';
require_once 'controllers/CourseController.php';


$route = isset($_GET['route']) ? $_GET['route'] : '';


$model = new CourseModel($db);
$controller = new CourseController($model);


if ($route === 'add_course') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->add();
    } else {
        include 'views/add_course.php';
    }
} elseif ($route === 'view_courses') {
    $controller->view();
} else {
    
    include 'views/index.php';
}
?>
