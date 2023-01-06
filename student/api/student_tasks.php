<?php
session_start();

require_once('../../classes/API_AutoLoader.php');

$student_id = $_GET['student_id'];

$get_task = new Task();
$tasks = $get_task->getTaskByStudent($student_id);

if($tasks){
    echo json_encode($tasks);
} else {
    echo 'error';
}