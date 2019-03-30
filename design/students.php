<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Students</h2>
        <h3>Hotel Room Student List</h3>
        <form method='post'>
          <select name="hotelRoom">
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

              # Function Description: Display all the options where the hotel rooms.
              # Parameters: compNames (The company names held in a PDO object)
              # Returns: None # Throws: None

              function displayHotelOptions($roomNames) {
                foreach($roomNames as $room) {
                    echo "<option value='",$room[0],"'>",$room[0],"</option>";
                }
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

            # Function Description: Queries for all hotel rooms
            # Parameters: dbh (The database connection)
            # Returns: all rooms

            function getAllHotelRooms($dbh){
              $rooms = $dbh->query("Select distinct HotelRoom from Students");
              return $rooms;
            }
            
            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',      # Connect to a database.
                           'root',
                           '');

            $rooms = getAllHotelRooms($dbh);
            displayHotelOptions($rooms);
            echo "</select>";
            echo "<input type='submit' name='getRoom' value='List Students'>";

            if(isset($_POST['getRoom'])){                       # Check to see if room exists.
                $room = hotelRoom($_POST['hotelRoom'], $dbh);
                if($room->rowCount()==0){
                  echo "<p>The following Room Number ",$_POST['hotelRoom']
                        ," does not exist. :(";
                }
                else{
                  displayRoom($_POST['hotelRoom'], $room);
                  unset($_POST['hotelRoom']);
                }
              
            }
          ?>
        </form>
        <h3>Insert A New Student</h3>
        <?php

            # Function Description: Provide the html to Insert a new Student.
            # Parameters: None # Returns: None # Throws: None

            function insertNewStudTags() {
                echo "<form method='post'>";
                echo "<h5>Input First Name</h5>";
                echo "<input type='text' name='firstName' value='First Name'><br>";
                echo "<h5>Input Last Name</h5>";
                echo "<input type='text' name='lastName' value='Last Name'><br>";
                echo "<input type='submit' name='insertStud' value='Insert Attendee'>";
                echo "</form>";
            }

            # Function Description: Return a valid new student id. (The highest ID + 7)
            # Parameters: pdo (The database connection) # Throws: None 
            # Returns: newID (The new ID to insert into the proffesional table)

            function getNewID($pdo) {
                $getMaxInt = $pdo->query("Select max(StudentID) from Students");
                foreach($getMaxInt as $i) {                 # Extract the ID from the PDO
                    $newid = $i[0];
                }
                $i[0] = $i[0] + 7;                  
                return $i[0];
            }

            # Function Description: Provide the new hotel room that the student will be directed towards.
            # Parameters: pdo (The database connection)
            # Returns: newRoom (The hotel room) # Throws: None

            function getHotelRoom($pdo) {
              $roomInformation = $pdo->query("select * from 
                                              (select count(Students.HotelRoom) as NumStudents, HotelRoom.RoomNumber from
                                              Students right join HotelRoom on HotelRoom.RoomNumber=Students.HotelRoom
                                              group by HotelRoom.RoomNumber) as A
                                              where A.NumStudents < 4
                                              Order By A.NumStudents Desc
                                              Limit 1");            # Query that gets the hotel room to input the student
              if($roomInformation->rowCount()==0) {
                 return Null;                # If no rooms are available, a null will be returned.
              }
              foreach($roomInformation as $r) {
                $newRoom = $r[1];
              }
              return $newRoom;
            }

            # Function Desciption: Insert a new student.
            # Parameters: fName (The new student first name), lName (The new student last name), 
            # defaultSession (The default session to insert the student. Consider this the intro session.), 
            # pdo (The database connection)
            # Throws: None # Returns: None

            function insertNewStudent($fName, $lName, $defaultSession, $pdo) {
                $newID = getNewID($pdo);
                $newHotelRoom = getHotelRoom($pdo);
                if ($newHotelRoom != Null) {
                  $pdo->query("INSERT INTO Students Values ($newID, '$fName', '$lName', '$newHotelRoom')");
                  if (!$pdo) {
                      echo "The Query Was Invalid\n";
                  } else {
                      $pdo->query("INSERT INTO Student_Session_Schedule Values ($newID, $defaultSession)");
                      ob_start();
                      echo "<p>The Student '",$fName," ",$lName,"' is now in Room: ",$newHotelRoom,"</p>";      # Confirmation statement
                      ob_flush();
                      usleep(1500000);
                      header("Refresh: 0");
                  }
                } else {
                  echo "<p>There are no rooms available. Book Sooner Next Time!</p>";
                }
            }

            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                    'root',
                    '');

            insertNewStudTags();
            if(isset($_POST['insertStud'])) {
                insertNewStudent($_POST['firstName'], $_POST['lastName'], 123456, $dbh);
            }
            ?>
    </div>
</body>
</html>
