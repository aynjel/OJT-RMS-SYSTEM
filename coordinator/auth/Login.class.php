<?php

session_start();

require_once('../../classes/Database.class.php');

class Login extends Database{
    public function login($email, $password){
        if(empty($email) || empty($password)){
            $_SESSION['error'] = "All fields are required";
        }else{
            $sql = "SELECT * FROM tbl_user WHERE user_email = ? AND user_password = ? AND user_role = 'Coordinator'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $password]);
            $result = $stmt->fetch();

            if($result){
                $_SESSION['coordinator_id'] = $result['user_id'];

                if($result['user_status'] == 'Pending'){
                    $_SESSION['error'] = "Your account is still pending";
                    $_SESSION['verify'] = true;
                    header('refresh:1; url=verify.php');
                }else{
                    $_SESSION['success'] = "Welcome Coordinator";
                    header('refresh:1; url=../index.php');
                }
            } else {
                $_SESSION['error'] = "Invalid email or password";
            }
        }
    }
}