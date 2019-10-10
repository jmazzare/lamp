<?php
require_once __DIR__ . '/../lib/data.php';

$dao = \data\dao();
$dao->exec("
CREATE TABLE user (
    id       INTEGER PRIMARY KEY,
    email    TEXT,
    name     TEXT,
    password TEXT
  )
");
