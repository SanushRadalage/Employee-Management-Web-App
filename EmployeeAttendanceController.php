<?php

include_once './Model/AttendanceEntity.php';

class EmployeeAttendanceController{

    
    function Run()
    {
        if(isset($_REQUEST['op']) )
        {

           if($_REQUEST['op'] == "add")
           {
               $model =  new AttendanceEntity();
               $model->SetValues();
               $model->UpdateHours();
               $model->dateCount();
               $this->ShowAttendanceForm();
           }
           elseif ($_REQUEST['op'] == "leave") 
           {
                $model =  new EmployeeEntity();
                $model->SetValues();
                $model->UpdateEmployee();
                $this->ShowRegistrationForm();
           }
        }
        else
        {
            $this->ShowAttendanceForm();
        }
    }

    function ShowAttendanceForm()
    {
        include_once './Views/EmployeeAttendanceView.php';
    }

    function TableActivity()
    {
        $model = new AttendanceEntity();
        $data = $model->GetUserInfo();
        $this->ShowAttendanceForm();
        return $data;

    }
}

?>