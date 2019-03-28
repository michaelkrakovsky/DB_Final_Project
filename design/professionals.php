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
                echo "<form method='post'>";
                echo "<input type='text' name='firstName' value='First Name'>";
                echo "<input type='text' name='lastName' value='Last Name'>";
                echo "<input type='submit' name='insertProf' value='Insert Attendee'>";
                echo "</form>";
            }

            # Function Description: Return a valid new professional id. (The highest ID + 7)
            # Parameters: pdo (The database connection) # Throws: None 
            # Returns: newID (The new ID to insert into the proffesional table)

            function getNewID($pdo) {
                $pdo->query("Select max(ProfessionalID from Professionals)");
                $newID = gettype($pdo[0]);
                echo "<p>$newID</p>"
            }

            # Function Desciption: Insert a new professional.
            # Parameters: newProfessional (The new professional to be inserted), pdo (The database connection)
            # Throws: None # Returns: None

            function insertNewProfessional($newProfessional, $pdo) {
                $pdo->query("INSERT INTO Professionals ()");
            }

            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                    'root',
                    '');
                    
            insertNewProfTags();
            if(isset($_POST['insertProf'])) {
                getNewID($dbh);
               # insertNewProfessional($_POST['firstName'], $_POST['lastName'], $dbh);
            }
        ?>
    </div>
</body>
</html>