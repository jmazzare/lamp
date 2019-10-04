<!doctype html>
<html>
  <head>
    <title>cs-401</title>
  </head>
  <body>
    <form action="./form-handler.php" method="GET">
      Simple Form
      <label>
        Choose your birth year
        <select name="birth-year">
          <option value="">select year</option>
          <?php
          $year = date('Y');
          for($i = 1950; $i <= $year; $i++) {
              echo "<option>$i</option>";
          }
          ?>
        </select>
      </label>
      <label>
        Enter your telephone number
        <input type="text" name="telephone" />
      </label>
      <input type="submit" value="Submit Form" />
    </form>
  </body>
</html>
