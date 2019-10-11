<?php
require_once __DIR__ . '/../lib/data.php';

$dao = \data\dao();
$dao->exec("
CREATE TABLE user (
    id       INTEGER PRIMARY KEY AUTO_INCREMENT,
    email    TEXT,
    name     TEXT,
    password TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
  )
");
