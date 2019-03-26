<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Students</h2>
        <h3>Hotel Room Student List</h3>
        <form method='post'>
          <?php

            # Function Description: Displays the students in a specific hotel room.
            # Parameters: roomNum (The room number), room (The PDO object with the SQL Information)
            # Returns: None
            # Throws: Displays an error if the room does not exist.
            
            function displayRoom($roomNum, $room){
              echo "<h2>",$roomNum,"</h2>";
              echo "<table>";
              echo "<tr><th>First Name</th><th>Last Name</th></tr>";
              foreach($room as $member){
                echo "<tr><td>",$member[0],"</td><td>",$member[1],"</td></tr>";
              }
              echo "</table>";
            }

            # Function Description: Queries for the given hotel room in database.
            # Parameters: roomNum (The room number), dbh (The database connection)
            # Returns: students (The query with the students located in the hotel room.)
            # Throws: Displays an error if the room does not exist.

            function hotelRoom($roomNum, $dbh){
              $students = $dbh->query("Select FirstName,LastName From Students
                                       Where HotelRoom = '$roomNum'");
              return $students;
            }
            
            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',      # Connect to a database.
                           'root',
                           '');

            echo "HotelRoom:<input type='text' value='' name='RoomNum'><br>";     # Get user's input.
            echo "<input type='submit' name='getRoom' value='List Students'>";

            if(isset($_POST['getRoom'])){                       # Check to see if room exists.
              if($_POST['RoomNum'] != ''){
                $room = hotelRoom($_POST['RoomNum'], $dbh);
                if($room->rowCount()==0){
                  echo "<p>The following Room Number ",$_POST['RoomNum']
                        ," does not exist. :(";
                }
                else{
                  displayRoom($_POST['RoomNum'], $room);
                  unset($_POST['RoomNum']);
                }
              }
            }
          ?>
        </form>
    </div>
</body>
</html>
