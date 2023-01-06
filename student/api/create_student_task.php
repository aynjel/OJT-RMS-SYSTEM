<?php
session_start();

require_once('../../classes/API_AutoLoader.php');

$task_name = $_POST['task_name'];
$task_description = $_POST['task_description'];
$task_deadline = $_POST['task_deadline'];
$user_id = $_POST['user_id'];
$organization_id = $_POST['organization_id'];

$get_task = new Task();
$get_task->createStudentTask($task_name, $task_description, $task_deadline, $user_id, $organization_id);

if($get_task) {
    echo 'success';
} else {
    echo 'error';
}