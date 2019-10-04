<?php

$year = @$_POST['birth-year'];
$tele = @$_POST['telephone'];

if (empty($year)) {
  echo "You must provide a year.";
}
if (empty($telephone)) {
  echo "You must provide a telephone number.";
}

if (!preg_match('/^[\d -\(\)]+$/', $telephone)) {
  echo "Invalid phone number";
}
