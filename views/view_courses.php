<!DOCTYPE html>
<html>
<head>
    <title>View Courses</title>
</head>
<body>
<h1>View Courses</h1>
<ul>
<?php foreach ($courses as $course): ?>
            <li>
                <h2><?php echo $course['title']; ?></h2>
                <p><?php echo $course['description']; ?></p>
                <img src="uploads/<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
            </li>
        <?php endforeach; ?>
</ul>
</body>
</html>
