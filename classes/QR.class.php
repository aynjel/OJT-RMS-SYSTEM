<?php

require_once('Database.class.php');

class QR extends Database{
    public function getQRAttendance($id){
        $sql = "SELECT * FROM tbl_qr_attendance WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createQRAttendance($attendance_id, $token){
        $sql = "INSERT INTO tbl_qr_attendance (attendance_id, token) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);   
        $stmt->execute([$attendance_id, $token]);

        $_SESSION['success'] = "QR Attendance has been created successfully";
        header('Location: ../attendance.php');
    }
}