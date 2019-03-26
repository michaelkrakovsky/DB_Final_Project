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
    </div>
    </div>
</body>
</html>