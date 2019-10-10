<?php
require_once __dir__ . '/../lib/data.php';

$dao = \data\dao();
$hash = sha1("password");
$dao->exec("DELETE FROM user");
$dao->exec("DELETE FROM todo");
