<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Conference Attendees</h2>
        <?php

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

            $students = getSponsors($dbh); 
            displayCompOptions($morespons);

            echo "</select>";
            echo "<input type='submit' name='getPos' value='List Jobs'>";
            if(isset($_POST['getPos'])) {
                if(($_POST["sponsorName"] != 'showAllJobs') && ($_POST["sponsorName"] != 'Null')) {
                   $jobs = getPositions($dbh, $_POST["sponsorName"]);
                   displaySubCom($_POST["sponsorName"], $jobs);
                } else if ($_POST["sponsorName"] == 'showAllJobs') {
                   $allJobs = getAllPositions($dbh);
                   displaySubCom("Display All", $allJobs);
                }
                unset($_POST["sponsorName"]);
                } 
            $dbh = Null;
        ?>
    </div>
</body>
</html>