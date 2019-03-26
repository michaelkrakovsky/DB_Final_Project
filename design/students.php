<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Students</h2>
        <!--
        LIST ALL THE MEMBERS OF A SPECIFIC SUB COMMITEE
        ##########################################################
        START
        -->
        <h3>LIST ALL MEMBERS OF A SPECIFIC HOTEL ROOM</h3>
        <form method='post'>
          <?php
            /*
            Displays the students in a specific
            hotel room
            */
            function displayRoom($roomNum, $room){
              echo "<h2>",$roomNum,"</h2>";
              echo "<table>";
              echo "<tr><th>First Name</th><th>Last Name</th></tr>";
              foreach($room as $member){
                echo "<tr><td>",$member[0],"</td><td>",$member[1],"</td></tr>";
              }
              echo "</table>";
            }

            /*
            Queries for the given hotel room
            in database
            */
            function hotelRoom($roomNum, $dbh){
              $students = $dbh->query("Select FirstName,LastName From Students
                                       Where HotelRoom = '$roomNum'");
              return $students;
            }

            $dbh = new PDO('mysql:host=192.168.64.2;dbname=Assn_1_Committee_And_Attendees',
                           'root',
                           'temp');

            echo "HotelRoom:<input type='text' value='' name='RoomNum'><br>";
            echo "<input type='submit' name='getRoom' value='List Students'>";

            if(isset($_POST['getRoom'])){
              if($_POST['RoomNum'] != ''){
                $room = hotelRoom($_POST['RoomNum'], $dbh);
                if($room->rowCount()==0){
                  echo "<p>ERROR: The following Room Number -> ",$_POST['RoomNum']
                        ," does not exist";
                }
                else{
                  displayRoom($_POST['RoomNum'], $room);
                  unset($_POST['RoomNum']);
                }
              }
            }
          ?>
        </form>
        <!--
        END
        ##########################################################
        -->
        <p></p>
    </div>
</body>
</html>
