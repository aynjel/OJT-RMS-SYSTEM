<?php

require_once('Database.class.php');

class Enrollment extends Database{
    
        public function getEnrollments() {
            $sql = "SELECT * FROM tbl_enrollment";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getEnrollment($id) {
            $sql = "SELECT * FROM tbl_enrollment WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        public function getEnrollmentByStudents($student_id) {
            $sql = "SELECT * FROM tbl_enrollment WHERE student_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id]);
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getEnrollmentByStudent($student_id) {
            $sql = "SELECT * FROM tbl_enrollment WHERE student_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id]);
            $result = $stmt->fetch();
            return $result;
        }

        public function getEnrollmentByCourse($course_id) {
            $sql = "SELECT * FROM tbl_enrollment WHERE course_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$course_id]);
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getEnrollmentByOrganization($organization_id) {
            $sql = "SELECT * FROM tbl_enrollment WHERE organization_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$organization_id]);
            $result = $stmt->fetchAll();
            return $result;
        }

        public function createEnrollment($student_id, $organization_id, $school_year, $start_date, $total_training_hours) {
            $date_enrolled = date('F d, Y');

            // calculate end date
            $end_date = date('F d, Y', strtotime($start_date. ' + '.$total_training_hours.' hours'));

            $sql = "INSERT INTO tbl_enrollment (school_year, student_id, date_enrolled, organization_id, start_date, end_date, total_training_hours) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$school_year, $student_id, $date_enrolled, $organization_id, $start_date, $end_date, $total_training_hours]);
        }
}