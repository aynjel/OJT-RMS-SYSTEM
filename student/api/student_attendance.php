<?php
session_start();

require_once('../../classes/API_AutoLoader.php');

$student_id = $_GET['student_id'];

$get_attendance = new Attendance();
$attendances = $get_attendance->getAttendanceByStudent($student_id);

if($attendances){
    echo json_encode($attendances);
} else {
    echo 'error';
}