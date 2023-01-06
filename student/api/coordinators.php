<?php
session_start();

require_once('../../classes/API_AutoLoader.php');

$organization_id = $_GET['organization_id'];

$get_coordinator = new Coordinator();
$coordinators = $get_coordinator->getCoordinatorByOrganization($organization_id);

if($coordinators){
    echo 'success';
} else {
    echo 'error';
}