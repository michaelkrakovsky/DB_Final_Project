<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Home</h2>
        <?php

            # Function Description: Provide the html to Insert a new Professional.
            # Parameters: None # Returns: None # Throws: None

            function insertNewProfTags() {
                echo "<h2>Insert A New Professional</h2>";
                echo "<form method='post'>";
                echo "<h5>Input First Name</h5>";
                echo "<input type='text' name='firstName' value='First Name'><br>";
                echo "<h5>Input Last Name</h5>";
                echo "<input type='text' name='lastName' value='Last Name'><br>";
                echo "<input type='submit' name='insertProf' value='Insert Attendee'>";
                echo "</form>";
            }

            # Function Description: Return a valid new professional id. (The highest ID + 7)
            # Parameters: pdo (The database connection) # Throws: None 
            # Returns: newID (The new ID to insert into the proffesional table)

            function getNewID($pdo) {
                $getMaxInt = $pdo->query("Select max(ProfessionalID) from Professionals");
                foreach($getMaxInt as $i) {                 # Extract the ID from the PDO
                    $newid = $i[0];
                }
                $i[0] = $i[0] + 7;                  
                return $i;
            }

            # Function Desciption: Insert a new professional.
            # Parameters: fName (The new professional first name), lName (The new professional last name), 
            # defaultSession (The default session to insert the professional. Consider this the intro sessions), 
            # pdo (The database connection)
            # Throws: None # Returns: None

            function insertNewProfessional($fName, $lName, $defaultSession, $pdo) {
                $newID = getNewID($pdo);
                $pdo->query("INSERT INTO Professionals ($newID, '$fName', '$lName')");
                $pdo->query("INSERT INTO Professional_Session_Schedule ($newID, $defaultSession)");
            }

            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                    'root',
                    '');

            insertNewProfTags();
            if(isset($_POST['insertProf'])) {
                getNewID($dbh);
                insertNewProfessional($_POST['firstName'], $_POST['lastName'], 123456, $dbh);
            }
        ?>
    </div>
</body>
</html>