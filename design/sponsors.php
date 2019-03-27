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
            
            $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',      # Connect to a database.
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
                <option value='showAllJobs'>Show All or Select Company</option>
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

              $morespons = getSponsors($dbh); 
              displayCompOptions($morespons);

              echo "</select>";
              echo "<input type='submit' name='getPos' value='List Jobs'>";
              if(isset($_POST['getPos'])) {
                if($_POST["sponsorName"] != 'showAllJobs') {
                  $jobs = getPositions($dbh, $_POST["sponsorName"]);
                  displaySubCom($_POST["sponsorName"], $jobs);
                } else {
                  $allJobs = getAllPositions($dbh);
                  displaySubCom("Display All", $dbh);
                }
                unset($_POST["sponsorName"]);
              }
              $dbh = Null;
            ?>
          </form>
        </div>
    </div>
</body>
</html>