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

              # Function Description: Display all the session options.
              # Parameters: pdo (The database connection)
              # Returns: None # Throws: None

              function displayAllSessions($pdo) {
                $allSessions = $pdo->query("Select Name From Session");
                foreach($allSessions as $s) {
                    echo "<option value='",$s[0],"'>",$s[0],"</option>";
                }
              }

              # Function Description: Change the session to the new designated time 
              # Parameters: sessToChange (The session to change), newDate (The new date), newTime (The new session time), 
              # endTime (The new end time), newRoom (The new room), pdo (The database connection)
              # Returns: None # Throws: None
              
              function changeSessionInformation($sessToChange, $newDate, $newTime, $endTime, $newRoom, $pdo) {
                $newStartTime = "$newDate $newTime";
                $newEndTime = "$newDate $endTime";
                $updateTable = $pdo->query("UPDATE table SET
                                            StartTime = '$newStartTime',
                                            EndTime = '$newEndTime',
                                            RoomLocation = '$newRoom' WHERE
                                            Name='$sessToChange'");
                if($updateTable) {
                  echo "<p>The session was successfully updated.</p>";
                } else {
                  echo "<p>Sorry, the session has not been updated.</p>";
                }
              }

              echo "<form method='post'>";
              echo "<select name='sessionToChange'>";
              getSessions($dbh);
              echo "</select>";
              echo "<label for='dateForNew'>New Date</label>";
              echo "<input type='date' id='dateForNew' name='newDate' value='2019-02-22' min='2019-02-08' max='2019-02-09'>";
              echo "<label for='sessStartTime'>Choose New Session Start Time</label>";
              echo "<input type='time' id='sessStartTime' name='newSessionStartTime' min='5:00' max='23:00'>";
              echo "<label for='sessEndTime'>Choose New Session End Time</label>";
              echo "<input type='time' id='sessEndTime' name='newSessionEndTime' min='5:00' max='23:00'>";
              echo "<label for='newName'>Input New Room Name</label>";
              echo "<input type='text' id='newName' name='newConfRoom' value='Main Room'><br>";
              echo "<input type='submit' name='changeRoomName' value='Change Session Information'>";
              echo "</form>";

              if(isset($_POST['changeRoomName'])) {
                changeSessionInformation($_POST['sessionToChange'], $_POST['newDate'], $_POST['newSessionStartTime'], $_POST['newSessionEndTime'], $_POST['newConfRoom'], $dbh);
              }
            ?>
        </form>
    </div>
</body>
</html>
