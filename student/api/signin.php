<?php

require_once('../../classes/API_AutoLoader.php');
require_once('../../classes/phpmailer/PHPMailerAutoload.php');

class LoginStudent extends Database{
    public function login($email, $password){
        $get_user = new User();
        $get_student = new Student();
        $get_course = new Course();
        $get_enrollment = new Enrollment();
        $get_organization = new Organization();
        
        $user_details = $get_user->getUserByEmailAndPassword($email, $password);
        
        if($user_details){
            if($user_details['user_status'] == 'Verified'){
                $student = $get_student->getStudent($user_details['user_id']);
                $user = $get_user->getUser($user_details['user_id']);
                $student = $get_student->getStudent($student['student_id']);
                $course = $get_course->getCourse($student['course_id']);
                $enrollment = $get_enrollment->getEnrollmentByStudent($student['student_id']);
                $organization = $get_organization->getOrganization($enrollment['organization_id']);
                
                $this->SendMail($user['user_email'], 'OJT RMS', 'Login Notification', $student['first_name'].' '.$student['last_name']);
                
                $data = array(
                    'user' => $user,
                    'student' => $student,
                    'course' => $course,
                    'enrollment' => $enrollment,
                    'organization' => $organization,
                    'message' => 'success'
                );

                echo json_encode($data);
            }else{
                $data = array(
                    'user' => $user_details,
                    'message' => 'pending'
                );

                echo json_encode($data);
            }
        }else{
            $data = array(
                'message' => 'error'
            );

            echo json_encode($data);
        }
    }

    public function SendMail($to, $fromName, $subject, $full_name)
    {
    $date_time = date('F d, Y h:i:s A');
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
                    You have logged in to your account. Date and time of login is 
                    </p>
                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                    '.$date_time.'
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

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}


    $login = new LoginStudent();

    $email = $_POST['email'];
    $password = $_POST['password'];

    // $email = 'ortegacanillo76@gmail.com';
    // $password = 'password';

    $loggedInUser = $login->login($email, $password);