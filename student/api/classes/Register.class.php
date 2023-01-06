<?php 

require_once('../../classes/Database.class.php');

class Register extends Database{
    public function register($email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $password, $organization_id, $school_year, $start_date, $total_training_hours){
        if(empty($email) || empty($student_id_number) || empty($first_name) || empty($last_name) || empty($contact_number) || empty($course_id) || empty($address) || empty($password) || empty($organization_id) || empty($school_year) || empty($start_date) || empty($total_training_hours)){
            return 'All fields are required';
        }else{
            $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id WHERE tbl_user.user_email = ? OR tbl_student.student_id_number = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $student_id_number]);

            if($stmt->rowCount() > 0){
                return 'Email or Student ID Number already exists';
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

                $from = 'OJT RMS';
                $subject = 'OJT RMS - Account Verification';
                $body = '
                <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                    <div style="margin:50px auto;width:70%;padding:20px 0">
                        <div style="border-bottom:1px solid #eee">
                            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                            '.$subject.'
                            </a>
                        </div>
                        <p style="font-size:1.1em">
                        Hello, '.$first_name.' '.$last_name.'!
                        </p>
                        <p>
                        Your account has been created. Please verify your account by entering the following OTP:
                        </p>
                        <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                        '.$otp.'
                        </h2>
                        <p style="font-size:0.9em;">Regards,<br />
                        OJT RMS
                        </p><br /><br />
                        <p style="font-size:0.9em;">This is a system generated email. Please do not reply.</p>
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

                $this->SendMail($email, $from, $subject, $body);

                return 'Account created';
            }
        }
    }
}