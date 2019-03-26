<!DOCTYPE html>
<html>

<script src="sidebar.js"></script>

<body>
    <div class="main">
        <h2>Subcommitees</h2>
        <p></p>
        <h3>SELECT A SUB-COMMITTEE TO DSIPLAY MEMBERS</h3>
        <div class="dropdown">
          <form method="post">
            <?php
              echo "<select name='SubCommitteeName'>";

              /*
              Creates a table displaying all
              all the committee members in a given sub
              committee.
              */
              function displaySubCom($name, $members){
                echo "<h2>",$name," Sub-Committee Members</h2>";
                echo "<table>";
                echo "<tr><th>First Name</th><th>Last Name</th></tr>";
                foreach($members as $member){
                  echo "<tr><td>",$member[0],"</td><td>",$member[1],"</td></tr>";
                }
                echo "</table>";
              }

              /*
              Sends a query to the database to
              get all the members of a given sub committee.
              */
              function subComMem($subName, $dbh){
                $subCom = $dbh->query("Select * From Committee_Members
                                       Where MemberID = Any(
                                        Select MemberID From Membership
                                        Where SubCommittee = '$subName'
                                     )");
                return $subCom;
              }

              /*
              Gets all the sub committee names
              from data base.
              */
              function getSubCommittees($dbh){
                $subComNames = $dbh->query("Select SubCommittee From Committee_List");
                return $subComNames;
              }

              $dbh = new PDO('mysql:host=localhost;dbname=Assn_1_Committee_And_Attendees',
                             'root',
                             '');
              $subComNames = getSubCommittees($dbh);

              echo "<option value='Null'>Select Sub-Committee</option>";

              foreach($subComNames as $name){
                echo "<option value='",$name[0],"'>",$name[0],"</option>";
              }

              echo "</select>";
              echo "<input type='submit' name = 'getSubMem' value ='List Members'>";
              if(isset($_POST['getSubMem'])){
                $Members = subComMem($_POST["SubCommitteeName"], $dbh);
                if($_POST["SubCommitteeName"] != 'Null'){
                  displaySubCom($_POST["SubCommitteeName"], $Members);
                  unset($_POST["SubCommitteeName"]);
                }
              }
              $dbh = Null;
            ?>
          </form>
        </div>
        <!--
        END
        ##########################################################
        -->
    </div>
</body>
</html>
