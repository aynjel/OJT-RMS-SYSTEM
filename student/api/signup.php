<?php

require_once('../../classes/API_AutoLoader.php');
require_once('../../classes/phpmailer/PHPMailerAutoload.php');

class CreateStudent extends Database{
    public function createStudent($email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $password, $organization_id, $school_year, $start_date, $total_training_hours){
        $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id WHERE tbl_user.user_email = ? AND tbl_student.student_id_number = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email, $student_id_number]);
        $result = $stmt->fetch();

        if($result){
            $data = array(
                'message' => 'error'
            );

            echo json_encode($data);
        }else{
            $otp = rand(100000, 999999);
            $date_enrolled = date('F d, Y');
            $end_date = date('F d, Y', strtotime($start_date. ' + '.$total_training_hours.' hours'));

            $sql = "INSERT INTO tbl_user (user_email, user_password) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT)]);

            $user_id = $this->connection->lastInsertId();

            $sql = "INSERT INTO tbl_student (student_id, student_id_number, first_name, last_name, course_id, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$user_id, $student_id_number, $first_name, $last_name, $course_id, $contact_number, $address]);

            $sql = "INSERT INTO tbl_otp (user_id, otp_code) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$user_id, $otp]);

            $sql = "INSERT INTO tbl_enrollment (school_year, student_id, date_enrolled, organization_id, start_date, end_date, total_training_hours) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$school_year, $user_id, $date_enrolled, $organization_id, $start_date, $end_date, $total_training_hours]);

            $this->SendMail($email, 'OJT RMS ACCOUNT VERIFICATION', 'Account Created', $first_name . ' ' . $last_name, $otp);

            $data = array(
                'message' => 'success'
            );

            echo json_encode($data);
        }
    }

    public function getCourseByCourseCode($course_code){
        $sql = "SELECT * FROM tbl_course WHERE course_code = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$course_code]);
        $result = $stmt->fetch();

        return $result;
    }

    public function getOrganizationByOrganizationName($organization_name){
        $sql = "SELECT * FROM tbl_organization WHERE organization_name = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_name]);
        $result = $stmt->fetch();

        return $result;
    }

    public function SendMail($to, $fromName, $subject, $full_name, $otp)
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
                    '.$otp.'
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

$create_student = new CreateStudent();

// $email = 'kobeortega76@gmail.com';
// $student_id_number = '2018-0001';
// $first_name = 'Kobe';
// $last_name = 'Bryant';
// $contact_number = '09123456789';
// $course_code = 'BSIT';
// $course_id = $create_student->getCourseByCourseCode($course_code)['course_id'];
// $address = 'Brgy. 1, City of San Fernando, La Union';
// $password = 'password';
// $organization_name = 'Consolatrix College of Toledo City';
// $organization_id = $create_student->getOrganizationByOrganizationName($organization_name)['organization_id'];
// $school_year = '2018-2019';
// $start_date = '2018-06-01';
// $total_training_hours = '1000';

$email = $_POST['email'];
$student_id_number = $_POST['student_id_number'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$contact_number = $_POST['contact_number'];
$course_code = $_POST['course_id'];
$course_id = $create_student->getCourseByCourseCode($course_code)['course_id'];
$address = $_POST['address'];
$password = $_POST['password'];
$organization_name = $_POST['organization_id'];
$organization_id = $create_student->getOrganizationByOrganizationName($organization_name)['organization_id'];
$school_year = $_POST['school_year'];
$start_date = $_POST['start_date'];
$total_training_hours = $_POST['total_training_hours'];

$create_student->createStudent($email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $password, $organization_id, $school_year, $start_date, $total_training_hours);
