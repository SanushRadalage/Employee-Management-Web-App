<?php

class AttendanceEntity {

    var $id;
    var $day;
    var $weekdayCount = 0;
    var $weekendCount = 0;
    var $hours;
    var $newHours;
    
    function SetValues()
    {
        if(isset($_REQUEST['OfcNumber']))
        {
            $this->id = $_REQUEST['OfcNumber'];
        }

        if(isset($_REQUEST['Hours']))
        {
            $this->hours = $_REQUEST['Hours'];
        }
        
        if(isset($_REQUEST['week']))
        {
            $this->day = $_REQUEST['week'];
        }
    }
    
    function UpdateHours()
    {   
        $currentHours = $this->GetCurrentWorkedHours();
        $this->dateCount();
        $this->newHours = $currentHours + $this->hours;

        $sql = "update attendanceinfo set Hours = '".$this->newHours."', WorkedWeekDays = '".$this->weekdayCount."', WorkedWeekEnds = '".$this->weekendCount."' where OfcNumber = '".$this->id."'";
        $data =  new DataClass();
        $data->sqliQueryExecution($sql);

        if($this->weekdayCount == 5 && $this->newHours < 45 )
        {
            echo "<div class='alert alert-danger'>
            <strong>Warning!</strong> You didn't complete 45 hours on this week.
            </div>";
        }   
        else
        {
            echo "<div class='alert alert-success'>
            <strong>Updated working hours!</strong>.
            </div>";
        }

    }

    function GetUserInfo()
    {
        $sql = "select * from attendanceinfo";
        $data =  new DataClass();
        $result = $data->sqliQueryExecution($sql);
        return $result;
    }

    function GetCurrentWorkedHours()
    {
        $sql = "select Hours from attendanceinfo where OfcNumber= '".$this->id."'";
        $data =  new DataClass();
        $result = $data->sqliQueryExecution($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Hours"];
    }

    function dateCount()
    {
        $this->getcurrentWorkedDays();

        if($this->day == "Saturday" || $this->day == "Sunday")
        {
            $this->weekendCount += 1;
        }
        else
        {
            $this->weekdayCount += 1;

        }
    }

    function getcurrentWorkedDays()
    {
        $sql = "select WorkedWeekDays, WorkedWeekEnds from attendanceinfo where OfcNumber= '".$this->id."'";
        $data =  new DataClass();
        $result = $data->sqliQueryExecution($sql);
        $row = mysqli_fetch_assoc($result);

        $this->weekdayCount = $row["WorkedWeekDays"];
        $this->weekendCount = $row["WorkedWeekEnds"];
    }
}

?>