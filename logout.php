<?php
require_once __DIR__ . '/lib/app.php';
\session\logout();
header('Location: /login.php');
