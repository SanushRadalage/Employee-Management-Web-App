<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EmployeeAttendanceInfo</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="text-center">   
                    <br>
                <h1 style="font-family:verdana;">Employee Attendance Details  <i class="fa fa-calendar-check-o" style="font-size:48px;color:black"></i></h1>
                <br>
                <br>
                <script>
                            function calcu() 
                            {
                              var txt1 = document.getElementById("timepicker1").value;
                              var txt2 = document.getElementById("timepicker2").value;

                              var hours = parseFloat(txt2) - parseFloat(txt1);

                              if(!isNaN(hours))
                              {
                                document.getElementById("Hours").value = hours; 
                              }
                              else
                              {
                                document.getElementById("Hours").value = 0; 
                              }
                               
                            }
                </script>

                <form method = 'post' class="form-horizontal">
                <br>
                Office Number
                <input type="text" class="form-control" id="OfcNumber" name="OfcNumber"  placeholder ="Enter Office ID or select from table"/>
                            <br>
                            <table class='table table-dark'>
                            <tr>
                            <td>
                            <input id="LeaveDates" width="276" placeholder ="Choose a date"/>
                              <script>
                                  $('#LeaveDates').datepicker({
                                      uiLibrary: 'bootstrap4'
                                  });
                              </script>
                              </td>
                              <td>
                              <select id="week" class="form-control" name = "week">
                              <option>Monday</option>
                              <option>Tuesday</option>
                              <option>Wednesday</option>
                              <option>Thursday</option>
                              <option>Friday</option>
                              <option>Saturday</option>
                              <option>Sunday</option>
                              </select>
                              </td>
                          </table>
                          <br>
                          <table class='table table-dark'>
                          <tr>
                          <td>
                          <input type="text" id="timepicker1" width="276"  placeholder ="Attend Time"  class="form-control"/>
                            <script>
                                $('#timepicker1').timepicker({
                                    uiLibrary: 'bootstrap4'
                                });
                              </script>
                              </td>
                              <td>
                              <input type="text" id="timepicker2" width="276"  placeholder ="Left Time"  class="form-control"/>
                              <script>
                              $('#timepicker2').timepicker({
                                  uiLibrary: 'bootstrap4'
                              });
                          </script>
                          </td>
                          <td>
                          <input type="text" class="form-control" placeholder="Working Hours" id="Hours" name="Hours"/>
                          </td>
                          <td>
                          <button onclick = "calcu();" class="btn btn-success" type="button">Calculate Working Hours</button>
                          </td>
                          </tr>
                          </table>
                          <input  formaction = "index.php?op=add" class="btn btn-success" type="submit" value="Add Working Hours"/>
                          <input  formaction = "index.php?op=leave" class="btn btn-primary" type="submit" value="Get Leave"/>
                    </form>

                    <?php

                        include_once './EmployeeAttendanceController.php';

                        $model = new EmployeeAttendanceController();
                        $data = $model->TableActivity();

                            echo "<table class='table table-dark' id = 'table'>";
                            echo "<th>ID</th>
                                <th>Working Hours</th>
                                <th>Worked Weekdays</th>
                                <th>Worked Weekends</th>";

                            while($row = mysqli_fetch_assoc($data))
                            {
                                echo"<tr>
                                        <td>{$row['OfcNumber']}</td>
                                        <td>{$row['Hours']}</td>
                                        <td>{$row['WorkedWeekDays']}</td>
                                        <td>{$row['WorkedWeekEnds']}</td>
                                </tr>";
                            }
                        echo "</table>";
                    ?>

                <script>

                var table = document.getElementById('table'),rIndex;

                for(var i = 0; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                        rIndex = this.rowIndex;
                        document.getElementById("OfcNumber").value = this.cells[0].innerHTML;
                    }
                }

                </script>

             </div>
          </div>
      </div>
  </div>
</body>
</html>