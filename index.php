<!doctype html>
<html>
  <head>
    <title>PHP/MySQL</title>
    <style>
      label {
        display:block;
        padding: 20px 10px;
      }
    </style>
  </head>
  <body>
    <form action="./form-handler.php" method="POST">
      <h1>Simple Form</h1>
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
