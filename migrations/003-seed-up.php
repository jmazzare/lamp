<?php
require_once __dir__ . '/../lib/data.php';

$dao = \data\dao();
$hash = sha1("password");
$dao->exec("INSERT INTO user (id, email, password) VALUES(1, 'admin@example.com', '$hash')");
$dao->exec("INSERT INTO todo (id, text, created_at) VALUES(1, 'todo numero uno', '2018/12/01')");
$dao->exec("INSERT INTO todo (id, text, created_at) VALUES(2, 'second todo', '2018/12/02')");
$dao->exec("INSERT INTO todo (id, text, created_at) VALUES(3, 'yet another task', '2018/12/03')");
