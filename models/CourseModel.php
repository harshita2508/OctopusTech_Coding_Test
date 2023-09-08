<?php
class CourseModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addCourse($title, $description, $image) {
        try {
            $query = "INSERT INTO courses (title, description, image) VALUES (:title, :description, :image)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            
            return false;
        }
    }

    public function getAllCourses() {
        try {
            $query = "SELECT * FROM courses";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            return [];
        }
    }
}
?>
