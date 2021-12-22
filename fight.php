<?php
  // Connect to database 
  $con = mysqli_connect("localhost","root","",'LeagueDB');
  // Make Query to get All Champion(name)s in database
  $sql = "SELECT * FROM AttackComparison";
  $all_champs = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Champion Comparison LvL 1</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Champion Autoattack Fights</h1>
          </div>
          <div class="panel-body">
            <form action="fighting.php" method="post">
              
              <label for="champName1">Champion Name 1 :</label>
              <select name="champName1">
                <?php 
                    $all_champs = mysqli_query($con,$sql);
                    // use a while loop to fetch data 
                    // from the $all_champs variable 
                    // and individually display as an option
                    while ($champs = mysqli_fetch_array(
                            $all_champs,MYSQLI_ASSOC)):; 
                ?>
                    <option value="<?php echo $champs["champName"];
                    ?>">
                        <?php echo $champs["champName"];
                            // To show the category name to the user
                        ?>
                    </option>
                <?php 
                    endwhile; 
                ?>
            </select>
            <label for="champName2">Champion Name 2 :</label>
              <select name="champName2">
                <?php 
                   $all_champs = mysqli_query($con,$sql);
                    // use a while loop to fetch data 
                    // from the $all_champs variable 
                    // and individually display as an option
                    while ($champs = mysqli_fetch_array(
                            $all_champs,MYSQLI_ASSOC)):; 
                ?>
                    <option value="<?php echo $champs["champName"];
                    ?>">
                        <?php echo $champs["champName"];
                            // To show the category name to the user
                        ?>
                    </option>
                <?php 
                    endwhile; 
                ?>
            </select>
            <label for="fightlength">How many seconds are they going to fight?:</label>
            <input type="text" id="fightlength" name="fightlength"><br><br>
            <input type="submit" value="Submit">
            </form>
          </div>
          <div class="panel-footer text-right">
            <small>&copy; Funchy Punchy</small>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>