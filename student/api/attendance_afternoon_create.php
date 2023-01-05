<?php

require_once('../../classes/API_AutoLoader.php');
require_once('../../classes/phpmailer/PHPMailerAutoload.php');

class Attendance extends Database{
    public function AttendanceTimeIn($student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id){
        $sql = "INSERT INTO tbl_attendance (student_id, attendance_date, attendance_time_in, attendance_log, coordinator_id, organization_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id]);
        return $result;
    }

    public function AttendanceTimeOut($attendance_id, $attendance_time_out){
        $sql = "UPDATE tbl_attendance SET attendance_time_out = ? WHERE attendance_id = ? AND attendance_log = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$attendance_time_out, $attendance_id, 'afternoon']);
        return $result;
    }

    public function getAttendance($attendance_id){
        $sql = "SELECT * FROM tbl_attendance WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$attendance_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAttendanceByStudentId($student_id, $attendance_date){
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ? AND attendance_date = ? AND attendance_log = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id, $attendance_date, 'Afternoon']);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
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

$attendance = new Attendance();

$attendance_log = $_GET['attendance_log'];
$student_id = $_GET['student_id'];
$attendance_date = $_GET['attendance_date'];
$attendance_time = $_GET['attendance_time'];
$coordinator_id = $_GET['coordinator_id'];
$organization_id = $_GET['organization_id'];

$check = $attendance->getAttendanceByStudentId($student_id, $attendance_date);

if($check['attendance_log'] == 'Afternoon'){
    $result = $attendance->AttendanceTimeOut($check['attendance_id'], $attendance_time);
    if($result){
        echo 'success afternoon out';
    }else{
        echo 'error afternoon out';
    }
}else{
    $result = $attendance->AttendanceTimeIn($student_id, $attendance_date, $attendance_time, $attendance_log, $coordinator_id, $organization_id);
    if($result){
        echo 'success afternoon in';
    }else{
        echo 'error afternoon in';
    }
}