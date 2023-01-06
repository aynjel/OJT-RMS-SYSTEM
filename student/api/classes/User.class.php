<?php

require_once('../../classes/Database.class.php');

class User extends Database{
    public function getUser($id){
        $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id WHERE tbl_student.student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getUserByEmail($email){
        $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }
}