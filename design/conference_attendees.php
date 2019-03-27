<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Conference Attendees</h2>
        <?php

            # Function Description: Get the list of names depending on the table name or group name.
            # Parameters: tbOne (The first table to join.), tbTwo (The second table to join.), 
            # tbColOne (The column name in the table one.), tbColTwo (The name of the column in table two.), 
            # pdo (The database connection)
            # Returns: listNames (The names from the table.) # Throws: None

            function getDesiredNames($sessAttend, $tbTwo, $sessAttendID, $tbColTwo, $pdo) {
               $listNames = $pdo->query("select FirstName, LastName from 
                                            (select Distinct $sessAttendID from $sessAttend) as A
                                            inner join $tbTwo on
                                            A.$sessAttendID=$tbTwo.$tbColTwo");
                return $listNames;
            }

            # Function Description: Display a list of names.
            # Parameters: compName (The job positions held in a PDO object)
            # Returns: None # Throws: None

            function displaySubCom($names, $listNamesType){
                echo "<h2>",$listNamesType," Attending</h2>";
                echo "<ol>";
                foreach($names as $n){
                    echo "<li>",$n[0],"</li>";
                }
                    echo "</ol>";
                }

            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                            'root',
                            '');

            $students = getDesiredNames("Student_Session_Schedule", "Students", "AttendeeID", "StudentID", $dbh); 
            $sponsors = getDesiredNames("Sponsor_Session_Schedule", "Sponsor_Attendee", "SponsorID", "SponsorID", $dbh);
            $professi = getDesiredNames("Professional_Session_Schedule", "Professionals", "ProfessionalID", "ProfessionalID", $dbh);
            displaySubCom($students, "Students");
            displaySubCom($sponsors, "Sponsors");
            displaySubCom($professi, "Professional");
            $dbh = Null;
        ?>
    </div>
</body>
</html>