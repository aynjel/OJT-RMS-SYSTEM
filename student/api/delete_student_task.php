<?php
session_start();

require_once('../../classes/API_AutoLoader.php');

$task_id = $_GET['task_id'];

$get_task = new Task();
$get_task->deleteTask($task_id);

if($get_task) {
    echo 'success';
} else {
    echo 'error';
}