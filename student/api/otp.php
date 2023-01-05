<?php

require_once('../../classes/API_AutoLoader.php');
require_once('../../classes/phpmailer/PHPMailerAutoload.php');

class OTPVerify extends Database{
    public function verify($otp, $email){
        $get_user = new User();
        $get_student = new Student();
        $get_course = new Course();
        $get_enrollment = new Enrollment();
        $get_organization = new Organization();

        $sql = "SELECT * FROM tbl_user INNER JOIN tbl_otp ON tbl_user.user_id = tbl_otp.user_id WHERE tbl_user.user_email = :email AND tbl_otp.otp_code = :otp";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':email' => $email, ':otp' => $otp]);
        $result = $stmt->fetch();

        if($result){
            $sql = "UPDATE tbl_user SET user_status = 'Verified' WHERE user_id = :user_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':user_id' => $result['user_id']]);

            $sql = "DELETE FROM tbl_otp WHERE user_id = :user_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([':user_id' => $result['user_id']]);

            $student = $get_student->getStudent($result['user_id']);
            $user = $get_user->getUser($result['user_id']);
            $student = $get_student->getStudent($student['student_id']);
            $course = $get_course->getCourse($student['course_id']);
            $enrollment = $get_enrollment->getEnrollmentByStudent($student['student_id']);
            $organization = $get_organization->getOrganization($enrollment['organization_id']);
            
            $data = array(
                'user' => $user,
                'student' => $student,
                'course' => $course,
                'enrollment' => $enrollment,
                'organization' => $organization,
                'message' => 'success'
            );

            echo json_encode($data);
            
            $this->SendMail($result['user_email'], 'OJT RMS', 'Account Verification', $result['first_name'].' '.$result['last_name']);
        }else{
            $data = array(
                'message' => 'error'
            );

            echo json_encode($data);
        }
    }

    public function SendMail($to, $fromName, $subject, $full_name){
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
                        Your account has been verified
                        </a>
                    </div>
                    <p style="font-size:1.1em">
                    Hello, '.$full_name.'
                    </p>
                    <p>
                    Your account has been verified. You can now login to your account.
                    </p>
                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                    Thank you for using our system!
                    </h2>
                    <p style="font-size:0.9em;">Regards,<br />
                    OJT RMS
                    </p><br /><br />
                    <p style="font-size:0.9em;">This is a system generated email. Please do not reply.</p>
                    <a href="mailto:ortegacanillo76@gmail.com">
                    Contact us
                    </a>
                    <hr style="border:none;border-top:1px solid #eee" />
                    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                        <p>
                        OJT RMS
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
}

$otp = new OTPVerify();

$otp_code = $_POST['otp'];
$email = $_POST['email'];

// $email = 'ortegacanillo76@gmail.com';
// $otp_code = '124353';

$otp->verify($otp_code, $email);