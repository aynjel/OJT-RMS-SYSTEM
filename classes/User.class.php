<?php

require_once('./../config/Database.class.php');

class User extends Database
{
  public function getAdminUser($id)
  {
    $sql = "SELECT * FROM tbl_user WHERE user_id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  public function getUsers()
  {
    $sql = "SELECT * FROM tbl_user ORDER BY user_id DESC";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function getUser($id)
  {
    $sql = "SELECT * FROM tbl_user WHERE user_id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  public function getUserByTask($id)
  {
    $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id WHERE tbl_student.student_id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  public function getUserByEmail($email)
  {
    $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    return $result;
  }

  public function getUserByEmailAndPassword($email, $password)
  {
    $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch();

    if ($result) {
      if (password_verify($password, $result['user_password'])) {
        return $result;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
