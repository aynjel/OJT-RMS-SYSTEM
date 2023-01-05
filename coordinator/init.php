<?php
session_start();

if(!isset($_SESSION['coordinator_id']) || $_SESSION['coordinator_id'] == false) {
    header('Location: auth/signin.php');
}

$user_id = $_SESSION['coordinator_id'];

require_once('../classes/AutoLoader.php');

$get_coordinator = new Coordinator();
$coordinator = $get_coordinator->getCoordinator($user_id);
$coordinators = $get_coordinator->getCoordinatorByOrganization($coordinator['organization_id']);

$get_organization = new Organization();
$organization = $get_organization->getOrganization($coordinator['organization_id']);

$get_student = new Student();
$students = $get_student->getStudents();

$get_user = new User();
$user = $get_user->getUser($user_id);

$get_course = new Course();
$courses = $get_course->getCourses();

$get_enrollment = new Enrollment();
$enrollments = $get_enrollment->getEnrollmentByOrganization($organization['organization_id']);

$get_task = new Task();
$tasks = $get_task->getTaskByOrganization($organization['organization_id']);

$get_attendance = new Attendance();
$attendances = $get_attendance->getAttendanceByOrganization($organization['organization_id']);

$get_qr = new QR();
