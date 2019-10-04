<?php

$year = @$_POST['birth-year'];
$tele = @$_POST['telephone'];

$errors = [];
if (empty($year)) {
  $errors[] = "You must provide a year.";
}
if (empty($tele)) {
  $errors[] = "You must provide a telephone number.";
  
} else if (!preg_match('/^[\d -\(\)]+$/', $tele)) {
  $errors[] = "Invalid phone number.";
}

if (!count($errors)) {
  echo "Success!";
} else {
  echo implode("<br />", $errors);
}
