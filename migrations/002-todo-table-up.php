<?php
require_once __DIR__ . '/../lib/data.php';

$dao = \data\dao();
$dao->exec("
CREATE TABLE todo (
    id   INTEGER PRIMARY KEY,
    text TEXT,
    created_at DATETIME,
    done_at DATETIME
  )
");
