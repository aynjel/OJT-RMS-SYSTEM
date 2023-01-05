<?php

require_once('Database.class.php');

class Attendance extends Database{
    public function getAttendances($id){
        $sql = "SELECT * FROM tbl_attendance INNER JOIN tbl_organization ON tbl_attendance.organization_id = tbl_organization.organization_id WHERE tbl_attendance.organization_id = ? ORDER BY tbl_attendance.attendance_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAttendance($id){
        $sql = "SELECT * FROM tbl_attendance WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getAttendanceByStudent($id){
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAttendanceByCoordinator($id){
        $sql = "SELECT * FROM tbl_attendance WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAttendanceByOrganization($id){
        $sql = "SELECT * FROM tbl_attendance WHERE organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAttendanceByOrganizationAndStudent($organization_id, $student_id){
        $sql = "SELECT * FROM tbl_attendance WHERE organization_id = ? AND student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_id, $student_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function createAttendanceTimeIn($student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id){
        $sql = "INSERT INTO tbl_attendance (student_id, attendance_date, attendance_time_in, attendance_log, coordinator_id, organization_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id]);
        return $result;
    }

    public function createAttendanceTimeOut($attendance_id, $attendance_time_out){
        $sql = "UPDATE tbl_attendance SET attendance_time_out = ? WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$attendance_time_out, $attendance_id]);
        return $result;
    }

    public function deleteAttendance($id){
        $sql = "DELETE FROM tbl_attendance WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$id]);
        return $result;
    }
}