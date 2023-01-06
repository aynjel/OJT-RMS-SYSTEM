<?php

require_once('classes/API_AutoLoader.php');

$login = new Login();

// $email = $_POST['email'];
// $password = $_POST['password'];

$email = 'ortegacanillo76@gmail.com';
$password = 'asd';

$user = $login->login($email, $password);

if($user == 'User not found'){
    echo 'User not found';
}elseif($user == 'Account not verified'){
    echo 'Account not verified';
}elseif($user == 'Incorrect password'){
    echo 'Incorrect password';
}elseif($user == 'Please fill in all fields'){
    echo 'Please fill in all fields';
}else{
    $get_course = new Course();
    $get_enrollment = new Enrollment();
    $get_organization = new Organization();

    $course = $get_course->getCourse($user['course_id']);
    $enrollment = $get_enrollment->getEnrollment($user['student_id']);
    $organization = $get_organization->getOrganization($enrollment['organization_id']);

    $data = array(
        'user' => $user,
        'course' => $course,
        'enrollment' => $enrollment,
        'organization' => $organization
    );

    echo json_encode($data);
}