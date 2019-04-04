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
                    echo "<li>",$n[0]," ",$n[1],"</li>";
                }
                echo "</ol>";
            }

            $dbh = new PDO('mysql:host=192.168.64.2;dbname=Assn_1_Committee_And_Attendees',
                            'root',
                            'temp');

            $students = getDesiredNames("Student_Session_Schedule", "Students", "AttendeeID", "StudentID", $dbh);
            $sponsors = getDesiredNames("Sponsor_Session_Schedule", "Sponsor_Attendee", "SponsorID", "SponsorID", $dbh);
            $professi = getDesiredNames("Professional_Session_Schedule", "Professionals", "ProfessionalID", "ProfessionalID", $dbh);
            displaySubCom($students, "Students");
            displaySubCom($sponsors, "Sponsors");
            displaySubCom($professi, "Professionals");
            # Function Description: Display Intake stats to the user
            # Parameters: pdo (The data base connection)
            # Returns: None # Throws: None

            function getStats($pdo) {
                $sponsType = $pdo->query("Select count(CompanyID), SponsorType
                                       From Sponsors group by (SponsorType)
                                       order by SponsorType Desc");         # Get the sponsor money
                $studentsAttending = $pdo->query("Select count(Distinct AttendeeID)
                                                  From Student_Session_Schedule");      # Number of students attending
                $professionalAttending = $pdo->query("select count(Distinct ProfessionalID)
                                               From Professional_Session_Schedule");    # Number of sponsors attending
                echo "<h3>Intake Statistics:</h3>";
                $total = 0;
                $row = $studentsAttending->fetch(0);
                $row[0] = $row[0] * 50;
                $total = $total + $row[0];
                echo "<p>Student Entrance Money: ",$row[0],"</p>";
                $row = $professionalAttending->fetch(0);
                $row[0] = $row[0] * 100;
                $total = $total + $row[0];
                echo "<p>Professional Entrance Money: ",$row[0],"</p>";
                $row = $sponsType->fetch(0);
                $temp = $row[0];
                $temp = $temp * 3000;
                $total = $total + $temp;
                echo "<p>Sponsor Silver Entrance Money: ",$temp,"</p>";
                $row = $sponsType->fetch(1);
                $temp = $row[0];
                $temp = $temp * 10000;
                $total = $total + $temp;
                echo "<p>Sponsor Platinum Entrance Money: ",$temp,"</p>";
                $row = $sponsType->fetch(3);
                $temp = $row[0];
                $temp = $temp * 5000;
                $total = $total + $temp;
                echo "<p>Sponsor Gold Entrance Money: ",$temp,"</p>";
                $row = $sponsType->fetch(4);
                $temp = $row[0];
                $temp = $temp * 1000;
                $total = $total + $temp;
                echo "<p>Sponsor Bronze Entrance Money: ",$temp,"</p>";
                echo "<p>The Total Entry Money: ",$total,"</p>";
            }
            getStats($dbh);
            $dbh = Null;
        ?>
    </div>
</body>
</html>
