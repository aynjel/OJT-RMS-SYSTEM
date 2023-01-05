<?php

require_once('Database.class.php');
require_once('phpmailer/PHPMailerAutoload.php');

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

    public function createStudent($email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $password){
        $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if($result){
            echo 'exist';
        }else{
            $otp = rand(100000, 999999);

            $sql = "INSERT INTO tbl_user (user_email, user_password) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $password]);

            $user_id = $this->connection->lastInsertId();

            $sql = "INSERT INTO tbl_student (student_id, student_id_number, first_name, last_name, course_id, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$user_id, $student_id_number, $first_name, $last_name, $course_id, $contact_number, $address]);

            $sql = "INSERT INTO tbl_otp (user_id, otp_code) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$user_id, $otp]);

            $this->SendMail($email, 'OJT RMS ACCOUNT VERIFICATION', 'Account Created', $first_name . ' ' . $last_name, $password, $otp);

            echo 'success';
        }
    }

    public function SendMail($to, $fromName, $subject, $full_name, $password, $otp)
   {
      $mail = new PHPMailer;

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';

      $mail->Username = 'ronancolins38@gmail.com';
      $mail->Password = 'olujepniarizbvon';

      $mail->setFrom('ronancolins38@gmail.com', $fromName);
      $mail->addAddress($to);

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = '
            <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                <div style="margin:50px auto;width:70%;padding:20px 0">
                    <div style="border-bottom:1px solid #eee">
                        <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                        '.$subject.'
                        </a>
                    </div>
                    <p style="font-size:1.1em">
                    Hello, '.$full_name.'
                    </p>
                    <p>
                    Your account has been created. Please use the following credentials to login.
                    </p>
                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                    Password : '.$password.'
                    </h2>
                    <br />
                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                    OTP : '.$otp.'
                    </h2>
                    <p style="font-size:0.9em;">Regards,<br />
                    OJT RMS
                    </p><br /><br />
                    Please do not reply to this email. This is an automated email and you will not receive a response. If you have any questions, please contact us at 
                    <a href="mailto:ortegacanillo76@gmail.com">
                    Here
                    </a>
                    <hr style="border:none;border-top:1px solid #eee" />
                    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                        <p>
                        Grading System
                        </p>
                        <p>
                        6038, Toledo City, Cebu
                        </p>
                        <p>
                        Philippines
                        </p>
                    </div>
                </div>
            </div>
            ';

      if (!$mail->send()) {
         return false;
      } else {
         return true;
      }
   }

    public function updateStudent($student_id, $email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address){
        if(empty($email) || empty($student_id_number) || empty($first_name) || empty($last_name) || empty($contact_number) || empty($course_id) || empty($address)){
            $_SESSION['error'] = 'All fields are required.';
            header('Location: students.php');
            exit();
        }else{
            $sql = "UPDATE tbl_user SET user_email = ? WHERE user_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $student_id]);

            $sql = "UPDATE tbl_student SET student_id_number = ?, first_name = ?, last_name = ?, contact_number = ?, course_id = ?, address = ? WHERE student_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $student_id]);

            $_SESSION['success'] = 'Student successfully updated.';
            header('Location: student.php?student_id='.$student_id);
        }
    }

    public function deleteStudent($id){
        $sql = "DELETE FROM tbl_student WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $sql = "DELETE FROM tbl_user WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Student successfully deleted.';
        header('Location: students.php');
    }
}