<?php

require_once('../config/Database.class.php');

class OTPVerify extends Database{
    public function verify($otp, $email){
        if(empty($otp) || empty($email)){
            return 'Please fill in all fields';
        }else{
            $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id INNER JOIN tbl_otp ON tbl_user.user_id = tbl_otp.user_id WHERE tbl_user.user_email = ? AND tbl_otp.otp_code = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $otp]);
            $result = $stmt->fetch();
            
            if($result){
                $sql = "UPDATE tbl_user SET user_status = ? WHERE user_id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute(['Verified', $result['user_id']]);

                $sql = "DELETE FROM tbl_otp WHERE user_id = :user_id";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([':user_id' => $result['user_id']]);

                $this->SendMail($result['user_email'], 'OJT RMS', 'Account Verification successful', 'Your account has been verified. You can now login to your account.');

                return $result['user_id'];
            }else{
                return 'Incorrect OTP';
            }
        }
    }

    public function verifyEmail($email){
        if(empty($email)){
            return 'Email is required';
        }else{
            $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            
            if($result){
                return $result['user_id'];
            }else{
                return 'Email not found';
            }
        }
    }

    public function changePassword($user_id, $password){
        if(empty($user_id) || empty($password)){
            return 'Please fill in all fields';
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE tbl_user SET user_password = ? WHERE user_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$password, $user_id]);

            return 'Password changed';
        }
    }
}