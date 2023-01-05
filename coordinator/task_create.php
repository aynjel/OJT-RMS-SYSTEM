<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $task_deadline = date('F d, Y', strtotime($_POST['task_deadline']));
    $user_id = $_POST['user_id'];
    $organization_id = $_POST['organization_id'];

    $create_task = new Task();
    $result = $create_task->createTask($task_name, $task_description, $task_deadline, $user_id, $organization_id);
}

