<?php
require_once __DIR__ . '/../lib/data.php';

$dao = \data\dao();
$dao->exec("DROP TABLE todo");
