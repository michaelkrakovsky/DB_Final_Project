<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Sponsors</h2>
        <h4>Complete Sponsor List</h4>
        <form method='post'>
          <?php
            # Function Description: Displays the sponsors (companies) and sponsor level
            # Parameters: spons (The PDO object with the SQL Information)
            # Returns: None # Throws: None

            function displaySpons($spons){
              echo "<table>";
              echo "<tr><th>Company Name</th><th>Company Level</th></tr>";
              foreach($spons as $s){
                echo "<tr><td>",$s[0],"</td><td>",$s[1],"</td></tr>";
              }
              echo "</table>";
            }
            # Function Description: Queries for the sponsors and their status.
            # Parameters: dbh (The connection objection)
            # Returns: spons (The query with the sponsor information.) # Throws: None
            function getSpons($dbh){
              $spons = $dbh->query("Select CompanyName, SponsorType From Sponsors");
              return $spons;
            }

            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                           'root',
                           '');

            $spons = getSpons($dbh);
            displaySpons($spons)
          ?>
        </form>
        <h4>List Positions</h4>
        <div class="dropdown">
          <form method="post">
            <select name='sponsorName'>
              <option value='Null'>Select Company</option>
              <option value='showAllJobs'>Show All Jobs</option>
              <?php
                # Function Description: Display all the options where the user can choose.
                # Parameters: compNames (The company names held in a PDO object)
                # Returns: None # Throws: None

                function displayCompOptions($compNames) {
                    foreach($compNames as $name) {
                        echo "<option value='",$name[0],"'>",$name[0],"</option>";
                    }
                }

                # Function Description: Display the jobs the company has available.
                # Parameters: compName (The job positions held in a PDO object)
                # Returns: None # Throws: None
                function displaySubCom($compName, $pos){
                  echo "<h2>",$compName," Available Jobs</h2>";
                  echo "<table>";
                  echo "<tr><th>Position Title</th></tr>";
                  foreach($pos as $p){
                    echo "<tr><td>",$p[0],"</td></tr>";
                  }
                  echo "</table>";
                }
                # Function Description: Retrieves all the company names to output.
                # Parameters: dbh (The connection objection)
                # Returns: spons (The query with the sponsor information.) # Throws: None
                function getSponsors($dbh) {
                  $spons = $dbh->query("Select CompanyName From Sponsors");
                  return $spons;
                }
                # Function Description: Get all the positions for the desired company.
                # Parameters: dbh (The connection objection), compName (The company name)
                # Returns: positions (The positions from the desired company.) # Throws: None
                function getPositions($dbh, $compName) {
                  $positions = $dbh->query("Select JobTitle From (select CompanyName, JobTitle
                                            from Sponsors inner join JobAdds on
                                            Sponsors.CompanyID=JobAdds.CompanyID) as A
                                            where A.CompanyName='$compName'");
                  return $positions;
                }
                # Function Description: Get all positions available.
                # Parameters: dbh (The connection objection)
                # Returns: allPositions (All available positions.) # Throws: None
                function getAllPositions($dbh) {
                  $allPositions = $dbh->query("select JobTitle from JobAdds");
                  return $allPositions;
                }
                $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                               'root',
                               '');

                function deleteCompany($dbh, $companyName){
                  $dbh->query("Delete From Sponsors Where CompanyName = '$companyName'");
                }

                $morespons = getSponsors($dbh);
                displayCompOptions($morespons);
                echo "</select>";
                echo "<input type='submit' name='getPos' value='List Jobs'>";
                echo "<input type ='submit' name='delComp' value='Delete'>";
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
                else if(isset($_POST['delComp'])){
                  if(($_POST["sponsorName"] != 'showAllJobs') && ($_POST["sponsorName"] != 'Null')){
                    deleteCompany($dbh, $_POST["sponsorName"]);
                    echo '<p2>',$_POST["sponsorName"],' has been deleted</p2>';
                    unset($_POST["sponsorName"]);
                  }
                }
                $dbh = Null;
                echo "</form>";
                echo "<h3>Insert A New Sponsor Representive</h3>";

              # Function Description: Provide the html to Insert a new Sponsor.
              # Parameters: sponsorsTwo (The list of companies to choose from) 
              # Returns: None # Throws: None

              function insertNewSponsTags($sponsorsTwo) {
                  echo "<form method='post'>";
                  echo "<h5>Input First Name</h5>";
                  echo "<input type='text' name='firstName' value='First Name'><br>";
                  echo "<h5>Input Last Name</h5>";
                  echo "<input type='text' name='lastName' value='Last Name'><br>";
                  echo "<h5>Input Your Company Name</h5>";
                  echo "<select name='companyName'><br>";
                  displayCompOptions($sponsorsTwo); 
                  echo "</select>";
                  echo "<input type='submit' name='insertCompany' value='Insert Attendee'>";
                  echo "</form>";
              }

              # Function Description: Return a valid new sponsor id. (The highest ID + 7)
              # Parameters: pdo (The database connection) # Throws: None 
              # Returns: newID (The new ID to insert into the proffesional table)

              function getNewID($pdo) {
                  $getMaxInt = $pdo->query("Select max(SponsorID) from Sponsor_Attendee");
                  foreach($getMaxInt as $i) {                 # Extract the ID from the PDO
                      $newid = $i[0];
                  }
                  $i[0] = $i[0] + 7;                  
                  return $i[0];
              }

              # Function Description: Provide the ID of the company to be inserted with the Sponsor.
              # Parameters: pdo (The database connection), compName (The name of the company)
              # Returns: compID (The ID of the company) # Throws: None

              function getCompanyID($pdo, $compName) {
                $comp = $pdo->query("Select CompanyID from Sponsors where CompanyName='$compName'");           
                if($comp->rowCount()==0) {
                  return Null;                # If no company exists, a null will be returned.
                }
                foreach($comp as $c) {
                  $compID = $c[0];
                }
                return $compID;
              }

              # Function Desciption: Insert a new sponsor.
              # Parameters: fName (The new student first name), lName (The new student last name), 
              # defaultSession (The default session to insert the student. Consider this the intro session.), 
              # companyName (The name of the supposed company), pdo (The database connection)
              # Throws: None # Returns: None

              function insertSponsors($fName, $lName, $companyName, $pdo) {
                  $newID = getNewID($pdo);
                  $compID = getCompanyID($pdo, $companyName);
                  if ($compID != Null) {            # Ensure the company exists, Insert If entry is legal.
                    $pdo->query("INSERT INTO Sponsor_Attendee Values ($newID, $compID, '$fName', '$lName')");
                    if (!$pdo) {
                        echo "The User Input was Invalid.\n";
                    } else {
                        $pdo->query("INSERT INTO Sponsor_Session_Schedule Values ($newID, $defaultSession)");
                        echo "<p>The Sponsor Attendee '",$fName," ",$lName,"' is now registered.</p>";      # Confirmation statement
                    }
                  } else {
                    echo "<p>The company you have entered does not exist!</p>";
                  }
              }

              $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                      'root',
                      '');
            
              $s = getSponsors($dbh);
              insertNewSponsTags($s);
              if(isset($_POST['insertCompany'])) {
                insertSponsors($_POST['firstName'], $_POST['lastName'], $_POST["companyName"], 123456, $dbh);
              }
              ?>
        </div>
    </div>
</body>
</html>
