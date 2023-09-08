<?php
class Course {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function addCourse($title, $description, $image) {
        try {
            $query = "INSERT INTO courses (title, description, image) VALUES (:title, :description, :image)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();

            // Course added successfully
            return true;
        } catch (PDOException $e) {
            // Handle database errors here
            // You can log the error or return false to indicate failure
            return false;
        }
    }

    public function getAllCourses() {
        try {
            $query = "SELECT * FROM courses";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Fetch all courses as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database errors here
            // You can log the error or return an empty array to indicate failure
            return [];
        }
    }
}
?>
