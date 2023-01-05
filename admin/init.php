<?php
session_start();

if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == false) {
    header('Location: auth/signin.php');
}

$user_id = $_SESSION['admin_id'];

require_once('../classes/AutoLoader.php');

$get_organization = new Organization();
$organizations = $get_organization->getOrganizations();

$get_coordinator = new Coordinator();
$coordinators = $get_coordinator->getCoordinators();

$get_student = new Student();
$students = $get_student->getStudents();

$get_user = new User();
$users = $get_user->getUsers();
$user = $get_user->getUser($user_id);

$get_course = new Course();
$courses = $get_course->getCourses();

$get_enrollment = new Enrollment();
$enrollments = $get_enrollment->getEnrollments();
