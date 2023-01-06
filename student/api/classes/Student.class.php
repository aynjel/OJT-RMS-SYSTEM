<?php

require_once('../../classes/Database.class.php');


class Student extends Database{
    public function getStudents(){
        $sql = "SELECT * FROM tbl_student ORDER BY student_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStudent($id){
        $sql = "SELECT * FROM tbl_student WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getStudentByCourse($course_id){
        $sql = "SELECT * FROM tbl_student WHERE course_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$course_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStudentNotEnrolled(){
        //select all students that is not in organization table
        $sql = "SELECT * FROM tbl_student WHERE NOT EXISTS (SELECT * FROM tbl_enrollment WHERE tbl_enrollment.student_id = tbl_student.student_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}