<?php
session_start();
date_default_timezone_set('Asia/Manila');

require_once('../../classes/API_AutoLoader.php');
require_once('../../classes/phpmailer/PHPMailerAutoload.php');

// calculate total training hours of a student
function calculateTotalTrainingHours($student_id) {
    $get_student = new Student();
    $get_enrollment = new Enrollment();
    $get_attendance = new Attendance();

    $student = $get_student->getStudent($student_id);
    $enrollments = $get_enrollment->getEnrollmentByStudent($student_id);
    $total_training_hours = 0;
    foreach($enrollments as $enrollment) {
        $attendances = $get_attendance->getAttendanceByEnrollment($enrollment['enrollment_id']);
        foreach($attendances as $attendance) {
            $total_training_hours += $attendance['hours'];
        }
    }
    return $total_training_hours;
}
