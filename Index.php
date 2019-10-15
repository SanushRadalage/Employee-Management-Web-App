<?php

include_once './Common/DataClass.php';
include_once 'EmployeeAttendanceController.php';

$stdCtrl = new EmployeeAttendanceController();
$stdCtrl->Run();
$data = $stdCtrl->TableActivity();

?>

