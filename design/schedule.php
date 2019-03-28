<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Schedule</h2>
        <!--
        DISPLAYS THE CONFERENCE SCHEDULE FOR A GIVEN DAY
        ##########################################################
        START
        -->
        <h4>SELECT A DAY TO DISPLAY SCHEDULE</h4>
        <form method="post">
            <input type="radio"  name="day" value="day1" checked>Day 1<br>
            <input type="radio" name="day" value="day2">Day 2<br>
            <input type="submit" name="getSchedule" value="Get Schedule">
            <?php

              function getDays($dbh){
                $days = $dbh->query("Select Distinct day(StartTime) From Session");
                return $days;
              }

              function displaySchedule($day, $schedule){
                echo "<h2>",$day,"</h2>";
                echo "<table>";
                echo "<tr><th>Start Time</th><th>End Time</th>
                      <th>Room Location</th><th>Name</th>
                      <th>Session ID</th></tr>";
                foreach($schedule as $member){
                  echo "<tr><td>",$member[0],"</td><td>",$member[1],"</td>
                            <td>",$member[2],"</td><td>",$member[3],"</td>
                            <td>",$member[4],"</td></tr>";
                }
                echo "</table>";
              }

              function conSchedule($day, $dbh){
                $schedule = $dbh->query("Select * From Session
                                         Where day(StartTime) = $day");
                return $schedule;
              }
              $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                             'root',
                             '');
              $days = getDays($dbh);

              $i = 0;
              foreach($days as $day){
                if($i==0){
                  $day1 = $day[0];
                }
                else{
                  $day2 = $day[0];
                }
                $i = $i + 1;
              }
              if($day1 > $day2){
                $temp = $day1;
                $day1 = $day2;
                $day2 = $temp;
              }

              if(isset($_POST['getSchedule'])){
                if($_POST['day'] == 'day1'){
                  $schedule = conSchedule($day1, $dbh);
                }
                else{
                  $schedule = conSchedule($day2, $dbh);
                }
                displaySchedule($_POST['day'], $schedule);
                unset($_POST['getSchedule']);
              }
            ?>
        </form>
        <!--
        END
        ##########################################################
        -->
    </div>
</body>
</html>
