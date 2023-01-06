<?php

require_once('classes/API_AutoLoader.php');

$register = new Register();
$get_course = new Course();
$get_organization = new Organization();

// $email = 'aynjel76@gmail.com';
// $student_id_number = '20180001';
// $first_name = 'Kobe';
// $last_name = 'Bryant';
// $contact_number = '09123456789';
// $course_code = 'BSIT';
// $course_id = $get_course->getCourseByCourseCode($course_code)['course_id'];
// $address = 'Brgy. 1, City of San Fernando, La Union';
// $password = 'password';
// $organization_name = 'Consolatrix College of Toledo City';
// $organization_id = $get_organization->getOrganizationByOrganizationName($organization_name)['organization_id'];
// $school_year = '2018-2019';
// $start_date = '2018-06-01';
// $total_training_hours = '1000';

$email = $_POST['email'];
$student_id_number = $_POST['student_id_number'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$contact_number = $_POST['contact_number'];
$course_code = $_POST['course_id'];
$course_id = $get_course->getCourseByCourseCode($course_code)['course_id'];
$address = $_POST['address'];
$password = $_POST['password'];
$organization_name = $_POST['organization_id'];
$organization_id = $get_organization->getOrganizationByOrganizationName($organization_name)['organization_id'];
$school_year = $_POST['school_year'];
$start_date = $_POST['start_date'];
$total_training_hours = $_POST['total_training_hours'];

$result = $register->register($email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $password, $organization_id, $school_year, $start_date, $total_training_hours);

if($result == 'Email or Student ID Number already exists'){
    echo 'Email or Student ID Number already exists';
}else if($result == 'All fields are required'){
    echo 'All fields are required';
}else{
    echo 'Successfully registered';
}