<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_id = $_POST['student_id'];
    $attendance_date = date('F d, Y', strtotime($_POST['attendance_date']));
    $attendance_time = $_POST['attendance_time'];
    $attendance_log = $_POST['attendance_log'];
    $coordinator_id = $_POST['coordinator_id'];

    $create_attendance = new Attendance();
    $result = $create_attendance->createAttendance($student_id, $attendance_date, $attendance_time, $attendance_log, $coordinator_id);
}