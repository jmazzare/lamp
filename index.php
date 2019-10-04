<?php
ini_set('display_errors', 1);

  ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>
<html>
  <head>
    <title>LAMP Proof of Concept</title>
  </head>
  <body>
  <form action="./form-handler.php" method="GET">
  <label>
  choose your birth year
  <select name="year">
  <option value="">select year</option>
    <?php
      $year = date('Y');
      for($i = 1950; $i <= $year; $i++) {
        echo "<option>$i</option>";
      }
    ?>
    </select>
  </label>
  <br />
  <br />
      <input type="text" />
    <input type="submit" value="Submit Form" />
</form>

        
  
        </body>
</html>
